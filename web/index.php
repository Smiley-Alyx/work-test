<?php

// Запускаем сессию
session_start();

// Устанавливаем кодировку и вывод всех ошибок
header('Content-Type: text/html; charset=UTF8');
error_reporting(E_ALL);

// Включаем буферизацию содержимого
ob_start();

// Устанавливаем ключ защиты
define('security_key', true);
 
// Подключаем файл конфигурации
include './core/config.php';

// подключаем базу данных
include './core/database.php';

// Подключаем скрипт с функциями
include './core/library.php';

// Определяем переменные для обработчиков
$mode = isset($_GET['mode'])  ? $_GET['mode'] : false;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : false;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
$err = array();

include './app/view/head.php';

// Обработчики
switch($mode) {
	case 'reg':
		include './app/function/reg.php';
		include './app/view/reg_form.php';
	break;

	case 'auth':
		include './app/function/auth.php';
		include './app/view/auth_form.php';
	break;

	default:
		include './app/function/userdata.php';
		include './app/function/lk.php';
		include './app/view/lk_form.php';
	break;
}

// Получаем данные с буфера
$content = ob_get_contents();
ob_end_clean();

// Подключаем шаблон страницы
include './app/view/main.php';		