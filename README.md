<p align="center">
    <h1 align="center">Work-test</h1>
    <h2 align="center">Тестовое задание для компании Ворк</h2>
</p>

УСТАНОВКА
-------------------

1. Выполнить git clone в консоле:
  ~~~
    $ git clone https://github.com/Smiley-Alyx/work-test.git
  ~~~

ЧАСТЬ WEB
---------

Web-сервис представляет собой страницу с авторизацией пользователя, с возможностью регистрации и смены данных пользователя.

### Установка:

Для запуска приложения настройте сервер на директорию входного скрипта `index.php`, находящегося в каталоге `web`, а так же установите конфигурацию в файле `app\core\config.php`.

### Структура приложения:

    --app/                              Корень приложения
        --controllers/                  Контроллеры
            --controller_404.php        Контроллер страницы 404
            --controller_auth.php       Контроллер аутентификации
            --controller_logout.php     Контроллер выхода из системы
            --controller_main.php       Контроллер личного кабинета
            --controller_reg.php        Контроллер регистрации
        --core/                         Ядро приложения
            --config.php                Конфигурационный скрипт
            --controller.php            Базовый контроллер
            --database.php              Подключение к базе данных
            --model.php                 Базовый класс моделей
            --route.php                 Роутер приложения
            --view.php                  Базовый класс видов
        --models/                       Модели
            --model_main.php            Главный класс моделей приложения
        --views/                        Виды
            --404_view.php              Вид для страницы 404
            --auth_view.php             Вид с формой аутентификации
            --main_view.php             Вид с формой личного кабинета
            --reg_view.php              Вид с формой регистрации
            --template_view.php         Базовый вид приложения
    --assets/                           Включаемые компоненты
        --css/                          CSS-стили
            --style.css                 Файл со стилями
            --bootstrap.min.css         Фреймворк Bootstrap
    --.gitignore                        Настройки игнорирования файлов Git'ом
    --.htaccess                         Настройки Apache
    --dump.sql                          Дамп базы данных
    --index.php                         Входной скрипт приложения


ЧАСТЬ БД
---------

В каталоге `database` лежит файл `work-test.sql`, который является дампом и содержит структуру таблиц БД.

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
