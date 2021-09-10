<?php

    session_start();

    require_once("dbconnect.php");

    $_SESSION["error_messages"] = '';
    $_SESSION["success_messages"] = '';
    
    if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){

        if(isset($_POST["captcha"])){

            $captcha = trim($_POST["captcha"]);

            if(!empty($captcha)){

                if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){

                    $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>";

                    $_SESSION["error_messages"] = $error_message;

                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/aut.php");

                    exit(); //Останавливаем скрипт
                }
            } else {
                $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Поле для ввода   капчи не должна быть пустой. </p>";

                $_SESSION["error_messages"] = $error_message;

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/aut.php");

                exit();
            }

            $email = trim($_POST["email"]);

            if(isset($_POST["email"])) {

                if(!empty($email)) {
                    $email = htmlspecialchars($email, ENT_QUOTES);

                    //Проверяем формат полученного почтового адреса с помощью регулярного выражения
                    $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

                    if( !preg_match($reg_email, $email)) { //Если формат полученного почтового адреса не соответствует регулярному выражению

                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";

                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/aut.php");

                        exit();
                    }
                } else {

                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Поле для ввода почтового адреса(email) не должна быть пустой.</p>";

                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/reg.php");

                    exit();
                }

            } else {

                $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода Email</p>";

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/aut.php");

                exit();
            }

            if(isset($_POST["password"])){

                $password = trim($_POST["password"]);

                if(!empty($password)){
                    $password = htmlspecialchars($password, ENT_QUOTES);
                    
                    $password = md5($password."top_secret");
                } else {

                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш пароль</p>";

                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/aut.php");

                    exit();
                }

            } else {

                $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода пароля</p>";

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/aut.php");


                exit();
            }
            
            $result_query_select = $mysqli->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");

            if(!$result_query_select){
 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на выборке пользователя из БД</p>";

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/aut.php");

                exit();
            } else {

                if($result_query_select->num_rows == 1) {

                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;

                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/index.php");

                } else {

                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Неправильный логин и/или пароль</p>";

                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/aut.php");

                    exit();
                }
            }
        } else {
            exit("<p><strong>Ошибка!</strong> Отсутствует проверочный код, то есть код капчи. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
        }

    } else {
        exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
    }