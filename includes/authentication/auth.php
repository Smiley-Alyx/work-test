<?php

if(isset($_GET['exit']) == true){
	session_destroy();
	header('Location:'. host .'?mode=auth');
	exit;
}

if(isset($_POST['submit']))
{
	//Проверяем на пустоту
	if(empty($_POST['login']))
		$err[] = 'Не введен Логин';

	if(empty($_POST['password']))
		$err[] = 'Не введен Пароль';

	if(count($err) > 0)
		echo showErrorMessage($err);
	else {
		$sql = 'SELECT * 
				FROM `users`
				WHERE `login` = :login';

		$stmt = $db->prepare($sql);
		$stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($rows) > 0) {
			if(md5(md5($_POST['password']).$rows[0]['salt']) == $rows[0]['password'])
			{	
				$_SESSION['user'] = true;
				$_SESSION['username'] = $_POST['login'];
				$_SESSION['user_id'] = $rows[0]['id'];
				
				header('Location:'. host .'?mode=auth');
				exit;
			}
			else
				echo showErrorMessage('Неверный пароль!');
		}
		else {
			echo showErrorMessage('Логин <b>'. $_POST['login'] .'</b> не найден!');
		}
	}
}
 
?>