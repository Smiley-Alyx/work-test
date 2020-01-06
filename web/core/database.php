<?php

try {
    $db = new PDO('mysql:host=localhost;dbname='.db_name, db_user, db_password, 
        array(PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    	)
    );
    $db -> exec('SET NAMES utf8');
}
catch(PDOException $e){
    print "Ошибка соединения!: " . $e->getMessage() . "<br/>";
    die();
}
