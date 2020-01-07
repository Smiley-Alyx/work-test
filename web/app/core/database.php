<?php

class Database 
{
	public static function getConnection ()
	{
		$paramsPath = 'config.php';
		$params = include($paramsPath);

		try {
			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
			$db = new PDO($dsn, $params['user'], $params['password']);
			$db->exec("set names utf8");
		}
		catch(PDOException $e){
			print $e->getMessage();
			die();
		}
		return $db;
	}
}
