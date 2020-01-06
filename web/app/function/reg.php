<?php

if(isset($_POST['submit'])) {
	if(empty($_POST['fullname']))
		$err[] = 'Поле ФИО не должно быть пустым';

	if(empty($_POST['login']))
		$err[] = 'Поле Логин не должно быть пустым';

	if(empty($_POST['email']))
		$err[] = 'Поле Email не должно быть пустым!';
	else
	{
		if(emailValid($_POST['email']) === false)
	       $err[] = 'Не правильно введен E-mail'."\n";
	}

	if(empty($_POST['password']))
		$err[] = 'Поле Пароль не должно быть пустым';

	if(empty($_POST['password2']))
		$err[] = 'Поле Подтверждения пароля не должно быть пустым';

	if(count($err) > 0)
		echo showErrorMessage($err);
	else
	{
		if($_POST['password'] != $_POST['password2'])
			$err[] = 'Пароли не совпадают';

	    if(count($err) > 0)
			echo showErrorMessage($err);
		else
		{
			$sql = 'SELECT `login` 
					FROM `users`
					WHERE `login` = :login';

			$stmt = $db->prepare($sql);
			$stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if(count($rows) > 0)
				$err[] = 'К сожалению Логин: <b>'. $_POST['login'] .'</b> занят!';
			
			if(count($err) > 0)
				echo showErrorMessage($err);
			else
			{
				$salt = salt();
				$pass = md5(md5($_POST['password']).$salt);
				
				$sql = 'INSERT INTO `users`
						VALUES(
								"",
								:login,
								:password,
								:salt,
								:fullname,
								:email
								)';

				$stmt = $db->prepare($sql);
				$stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
				$stmt->bindValue(':password', $pass, PDO::PARAM_STR);
				$stmt->bindValue(':salt', $salt, PDO::PARAM_STR);
				$stmt->bindValue(':fullname', $_POST['fullname'], PDO::PARAM_STR);
				$stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
				$stmt->execute();
				
				header('Location:'. host .'?mode=auth');
				exit;
			}
		}
	}
}
