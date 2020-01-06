<p align="center">
    <h1 align="center">Work-test</h1>
    <h2 align="center">Тестовое задание</h2>
</p>

УСТАНОВКА
-------------------

1. Выполнить git clone в консоле:
  ~~~
    $ git clone https://github.com/Smiley-Alyx/work-test.git
  ~~~

ЧАСТЬ WEB
---------

Web-сервис представляет собой страницу с авторизацией пользователя, с возможностью регистрации и смены пароля и данных.

### Установка:

Для запуска приложения настройте сервер на директорию входного скрипта `index.php`, находящегося в каталоге `web`, 
а так же установите конфигурацию в файле `core\config.php`.

### Структура приложения:

    --app/                  		Корень приложения
        --function/              	Основные функции приложения
			--auth.php				Скрипт аутентификации
			--lk.php				Скрипт личного кабинета
			--reg.php               Скрипт регистрации
			--user.php				Скрипт вывода данных о пользователе
        --views/                    Виды
			--404.php				Файл со страницей 404
			--auth_form.php			Файл с формой аутентификации
			--head.php				Файл с шапкой
			--lk_form.php			Файл с формой личного кабинета
            --main.php             	Вид главной страницы
			--reg_form.html         Файл с формой регистрации
    --assets/                       Включаемые компоненты
        --css/                      CSS-стили
		    --style.css     		Файл со стилями
            --bootstrap.min.css     Фреймворк Bootstrap
    --core/                         Ядро приложения
		--config.php				Конфигурационный скрипт
		--database.php             	Подключение к базе данных
		--library.php             	Включаемые базовые функции
    --.gitignore                    Настройки игнорирования файлов Git'ом
    --.htaccess                     Настройки Apache
	--dump.sql						Дамп базы данных
    --index.php                     Входной скрипт приложения


ЧАСТЬ БД
---------

В каталоге `database` лежит файл `bars_test.sql`, который является дампом и содержит структуру таблиц БД.

### Задание 1.

Составить запрос, который выведет список email'лов встречающихся более чем у одного пользователя.

```sql
SELECT `email` 
FROM `users` 
GROUP BY `email` 
HAVING COUNT(`email`) > 1
```

### Задание 2.

Вывести список логинов пользователей, которые не сделали ни одного заказа.

```sql
SELECT `t1`.`login` 
FROM `users` AS `t1`
LEFT JOIN `orders` AS `t2` ON (`t2`.`user_id` = `t1`.`id`)
WHERE `t2`.`user_id` IS NULL
```

### Задание 3.

Вывести список логинов пользователей которые сделали более двух заказов.

```sql
SELECT `t1`.`login` 
FROM `users` AS `t1`
INNER JOIN `orders` AS `t2` ON (`t2`.`user_id` = `t1`.`id`)
GROUP BY `t1`.`login`
HAVING COUNT(`t2`.`user_id`) > 2
```
