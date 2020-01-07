<?php

class Controller_Reg extends Controller
{
	function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}

	public function action_index()
	{
		$model = $this->model;
		$this->view->generate('reg_view.php', 'template_view.php');

		$login = false;
		$email = false;
		$password = false;
		$password2 = false;
		$fullname = false;

		if (isset($_POST['submit'])) {
			$errors = false;
			$login = $_POST['login'];
			$email = $_POST['email'];
			$fullname = $_POST['fullname'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];

			if (!$model->checkEmail($email)) 
				$errors[] = 'Не верно указан E-mail';
			else {
				$checkLogin = $model->checkUserLogin($login);
				if ($checkLogin == true) 
					$errors[] = 'Пользователь с таким Логином, уже зарегистрирован';
				else {
					if (!$model->checkPasswords($password, $password2)) 
						$errors[] = 'Пароли не совпадают';
					else {
						if (!$model->register($login, $password, $fullname, $email)) 
							$errors[] = 'Ошибка Базы Данных';
						else {
							header('Location: /');
						}
					}
				}
			}
		}
	}
}