<?php

class Model_Main extends Model
{
	public static function salt() {
		return substr(md5(uniqid()), -8);
	}

	public static function generateHash($password, $salt) {
		return md5(md5($password).$salt);
	}

	public static function checkEmail($email)
	{
		if (function_exists('filter_var')) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			if (!preg_match("/^[a-z0-9_.-]+@([a-z0-9]+\.)+[a-z]{2,6}$/i", $email)) {
				return false;
			}
			else {
				return true;
			}
		}
	}

	public static function checkPasswords($password, $password2)
	{
		if ($password == $password2) 
			return true;
		else
			return false;
	}

	public static function checkUserLogin($login)
	{
		$db = Database::getConnection();
		$sql = 'SELECT `login` 
				FROM `users`
				WHERE `login` = :login';
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($user) return true;
		else return false;
	}

	public static function checkUserId($id)
	{
		$db = Database::getConnection();
		$sql = 'SELECT * 
				FROM `users`
				WHERE `login` = :login';
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':login', $id, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($user) return true;
		else return false;
	}

	public static function register($login, $password, $fullname, $email)
	{
		$salt = Model_Main::salt();
		$pass = Model_Main::generateHash($password, $salt);

		$db = Database::getConnection();
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
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->bindParam(':password', $pass, PDO::PARAM_STR);
		$stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
		$stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public static function auth($userId, $userLogin)
	{
		$_SESSION['user'] = $userId;
		$_SESSION['username'] = $userLogin;
	}

	public static function isGuest()
	{
		if (isset($_SESSION['user'])) return false;
		else return true;
	}

	public static function verifyPasses($pass_received, $pass_hash, $salt) {
		return Model_Main::generateHash($pass_received, $salt) == $pass_hash;
	}

	public static function getUserDataOnId($id)
	{
		$db = Database::getConnection();
		$sql = 'SELECT * FROM users WHERE id = :id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		return $result->fetch();
	}

	public static function getUserDataOnLogin($login)
	{
		$db = Database::getConnection();
		$sql = 'SELECT * FROM users WHERE login = :login';
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		return $result->fetch();
	}

	public static function updateUser($id, $password, $salt, $fullname, $email)
	{
		$db = Database::getConnection();
		$sql = 'UPDATE `users`
				SET	password=:password, 
					salt=:salt, 
					fullname=:fullname, 
					email=:email
				WHERE `id` = :id';
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
		$stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		return $stmt->execute();
	}
}
