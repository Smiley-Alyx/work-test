<?php

// Запускаем сессию
session_start();

// Устанавливаем кодировку и вывод всех ошибок
header('Content-Type: text/html; charset=UTF8');
error_reporting(E_ALL);

// Включаем буферизацию содержимого
ob_start();

// Определяем переменные для переключателя
$mode = isset($_GET['mode'])  ? $_GET['mode'] : false;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
$err = array();

// Устанавливаем ключ защиты
define('security_key', true);
 
// Подключаем файл конфигурации
include './config.php';

// подключаем базу данных
include './includes/database.php';

// Подключаем скрипт с функциями
include './includes/library.php';

// Обработчики
switch($mode) {
	case 'reg':
		include './includes/registration/reg.php';
		include './includes/registration/reg_form.html';
	break;

	case 'auth':
		include './includes/authentication/auth.php';
		include './includes/authentication/auth_form.html';
		include './includes/authentication/show.php';
	break;
}

// Получаем данные с буфера
$content = ob_get_contents();
ob_end_clean();

// Подключаем шаблон страницы
include './html/index.html';		