<?php

    header('Content-Type: text/html; charset=utf-8'); // Указываем кодировку

    $mysqli = new mysqli("localhost", "root", "root", "registration"); 

    if ($mysqli->connect_errno) { 
        die("<p><strong>Ошибка подключения к БД </strong></p><p><strong>Код ошибки: </strong> ". $mysqli->connect_errno ." </p><p><strong>Описание ошибки:</strong> ".$mysqli->connect_error."</p>"); 
    }

    $mysqli->set_charset('utf8');

    // переменная, содержащая адрес (URL) нашего сайта
    $address_site = "http://autreg";
?>