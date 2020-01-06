<?php
 
//Выход из авторизации
if(isset($_GET['exit']) == true){
	//Уничтожаем сессию
	session_destroy();

	//Делаем редирект
	header('Location:'. host .'?mode=auth');
	exit;
}

//Если нажата кнопка то обрабатываем данные
if(isset($_POST['submit']))
{
	//Проверяем на пустоту
	if(empty($_POST['login']))
		$err[] = 'Не введен Логин';

	if(empty($_POST['password']))
		$err[] = 'Не введен Пароль';

	//Проверяем наличие ошибок и выводим пользователю
	if(count($err) > 0)
		echo showErrorMessage($err);
	else
	{
		/*Создаем запрос на выборку из базы 
		данных для проверки подлиности пользователя*/
		$sql = 'SELECT * 
				FROM `users`
				WHERE `login` = :login';
		//Подготавливаем PDO выражение для SQL запроса
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
		$stmt->execute();

		//Получаем данные SQL запроса
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		//Если логин совподает, проверяем пароль
		if(count($rows) > 0)
		{
			//Получаем данные из таблицы
			if(md5(md5($_POST['password']).$rows[0]['salt']) == $rows[0]['password'])
			{	
				$_SESSION['user'] = true;
				
				//Сбрасываем параметры
				header('Location:'. host .'?mode=auth');
				exit;
			}
			else
				echo showErrorMessage('Неверный пароль!');
		}else{
			echo showErrorMessage('Логин <b>'. $_POST['login'] .'</b> не найден!');
		}
	}
}
 
?>