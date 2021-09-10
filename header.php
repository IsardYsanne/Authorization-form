<?php  session_start();  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Registration and authentication</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/script.js"></script>
</head>
<body>
    <div class="wrapper">
        <div id="header" class="header">
            <h2>Шапка сайта</h2>
            <a href="/index.php">На главную</a>
            <div id="auth_block" class="menu">

            <?php
                if(!isset($_SESSION['email']) && !isset($_SESSION['password'])) { 
            ?>

                <div id="link_register">
                    <a href="/reg.php">Регистрация</a>
                </div>
                <div id="link_auth">
                    <a href="/aut.php">Вход</a>
                </div>

            <?php
                } else { 
            ?> 
            <div id="link_logout">
                <a href="/logout.php">Выход</a>
            </div>
            
            <?php
                }
            ?>
            </div>
            <div class="clear"></div>
        </div>