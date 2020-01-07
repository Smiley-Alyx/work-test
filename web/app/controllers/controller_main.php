<?php

class Controller_Main extends Controller
{
	function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}

	function action_index()
	{
		$model = $this->model;
		if ($model->isGuest()) 
			header('Location: /auth');

		$userId = $_SESSION['user'];
		$userData = $model->getUserDataOnId($userId);
		$userEmail = $userData['email'];
		$userFullname = $userData['fullname'];
		$userPass = $userData['password'];
		$userSalt = $userData['salt'];
		$this->view->generate('main_view.php', 'template_view.php', $userData);

		$email = $userEmail;
		$fullname = $userFullname;
		$password = false;
		$password2 = false;
		$oldpassword = false;

		if (isset($_POST['submit'])) {
			$errors = false;
			$oldpassword = $_POST['oldpassword'];

			if(!empty($_POST['fullname']))
				$fullname = $_POST['fullname'];

			if(!empty($_POST['email']))
				$email = $_POST['email'];

			if(!empty($_POST['password']))
				$password = $_POST['password'];

			if(!empty($_POST['password2']))
				$password2 = $_POST['password2'];

			if (!$model->checkEmail($email)) 
				$errors[] = 'Не верно указан E-mail';
			else {
				if(!$model->checkPasswords($password, $password2)) {
					$errors[] = 'Пароли не совпадают';
				}
				else {
					if (!$model->verifyPasses($oldpassword, $userPass, $userSalt)) {
						$errors[] = 'Неверный пароль!';
					}
					else {
						if($password) {
							$salt = $model->salt();
							$pass = $model->generateHash($password, $salt);
						} 
						else {
							$salt = $userSalt;
							$pass = $userPass;
						}
						$model->updateUser($userId, $pass, $salt, $fullname, $email); 
						header('Location: /');
					}

				}
			}
		}
	}
}