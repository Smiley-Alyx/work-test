<?php

// Ключ защиты
if (!defined('security_key')) {
	header("HTTP/1.1 404 Not Found");
	exit(file_get_contents('./html/404.html'));
}

// Адрес базы данных
define('db_server','localhost');

// Пользователь
define('db_user','root');

// Пароль
define('db_password','');

// Название
define('db_name','authorization');

//Ошибки
define('error_connect','Ошибка соединения с базой данных');
define('no_db_select','Данная БД отсутствует на сервере');

//Адрес хоста сайта
define('host','http://'. $_SERVER['HTTP_HOST'] .'/work-test/');
