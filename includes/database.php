<?php

if (!defined('security_key')) {
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('./html/404.html'));
}

try {
    $db = new PDO('mysql:host=localhost;dbname='.db_name, db_user, db_password, 
        array(PDO::ATTR_PERSISTENT => true)
    );
}
catch(PDOException $e){
    print "Ошибка соединения!: " . $e->getMessage() . "<br/>";
    die();
}
