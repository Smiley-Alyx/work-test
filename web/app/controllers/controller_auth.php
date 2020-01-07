<?php

class Controller_Auth extends Controller
{
	function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}
	function action_index()
	{
		$model = $this->model;
		$this->view->generate('auth_view.php', 'template_view.php', $model);

		$login = false;
		$password = false;
		if (isset($_POST['submit'])) {
			$login = $_POST['login'];
			$password = $_POST['password'];
			$errors = false;

			$userData = $model->getUserDataOnLogin($login);
			$userId = $userData['id'];
			$userLogin = $userData['login'];
			$userPass = $userData['password'];
			$userSalt = $userData['salt'];

			if ($model->verifyPasses($password, $userPass, $userSalt)) {
				$model->auth($userId, $userLogin);
				header('Location: /');
			} 
			else 
				$errors[] = 'Неправильные данные для входа на сайт';
		}
	}
}