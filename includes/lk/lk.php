<?php

if($user === false){
	header('Location:'. host .'?mode=auth');
}

if (isset($_GET['update']) and $_GET['update'] == 'ok')
echo '<b>Данные успешно обновлены!</b>';

if(isset($_POST['submit'])) {
	if(!empty($_POST['fullname']))
		$fullname = $_POST['fullname'];

	if(!empty($_POST['email'])) {
		if(emailValid($_POST['email']) === false)
			$err[] = 'Не правильно введен E-mail'."\n";
		else 
			$email = $_POST['email'];
	}

	if(!empty($_POST['password']) && !empty($_POST['password2'])) {
		if($_POST['password'] != $_POST['password2']) {
			$err[] = 'Пароли не совпадают';
		}
		else
			$password = $_POST['password'];
	}

	if(count($err) > 0)
		echo showErrorMessage($err);
	else {
		$sql = 'SELECT * 
				FROM `users`
				WHERE `id` = :id';

		$stmt = $db->prepare($sql);
		$stmt->bindValue(':id', $user_id, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($rows) > 0) {
			if(md5(md5($_POST['oldpassword']).$rows[0]['salt']) != $rows[0]['password']) {
				$err[] = 'Неверный пароль!';
			}
			if(count($err) > 0)
				echo showErrorMessage($err);
			else {
				if($password) {
					$salt = salt();
					$pass = md5(md5($_POST['password']).$salt);
				} 
				else {
					$salt = $rows[0]['salt'];
					$pass = $rows[0]['password'];
				}

				if(!$fullname)
					$fullname = $rows[0]['fullname'];

				if(!$email)
					$email = $rows[0]['email'];
				
				$sql = 'UPDATE `users`
						SET	password=:password, 
							salt=:salt, 
							fullname=:fullname, 
							email=:email
						WHERE `id` = :id';

				$stmt = $db->prepare($sql);
				$stmt->bindValue(':id', $user_id, PDO::PARAM_STR);
				$stmt->bindValue(':password', $pass, PDO::PARAM_STR);
				$stmt->bindValue(':salt', $salt, PDO::PARAM_STR);
				$stmt->bindValue(':fullname', $fullname, PDO::PARAM_STR);
				$stmt->bindValue(':email', $email, PDO::PARAM_STR);
				$stmt->execute();
				
				header('Location:'. host .'?mode=lk&update=ok');
				exit;
			}
		}
	}
}
