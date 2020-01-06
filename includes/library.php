<?php

/**
 * Функция вывода ошибок
 * @param $data array
 */
function showErrorMessage($data) {
    $err = '<ul>'."\n"; 

    if (is_array($data)) {
        foreach($data as $val)
            $err .= '<li style="color:red;">'. $val .'</li>'."\n";
    }
    else
        $err .= '<li style="color:red;">'. $data .'</li>'."\n";

    $err .= '</ul>'."\n";
    return $err;
}
 

/**
 * Функция генерирования соли
 *
 */
function salt() {
    $salt = substr(md5(uniqid()), -8);
    return $salt;
}


/** 
 * Функция проверки email
 * @param $email string
 */
function emailValid($email) {
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