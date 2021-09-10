<?php
    session_start();

    $rand = mt_rand(1000, 9999);

    $_SESSION["rand"] = $rand; // Сохраняем значение переменной  $rand в сессию

    $im = imageCreateTrueColor(90,50); //создаём новое черно-белое изображение

    $c = imageColorAllocate($im, 255, 255, 255); // Указываем белый цвет для текста

    imageTtfText($im, 20, -10, 10, 30, $c, __DIR__."/fonts/verdana.ttf", $rand); // Записываем полученное случайное число на изображение

    header("Content-type: image/png");

    imagePng($im);  // Выводим изображение

    imageDestroy($im); //Освобождаем ресурсы
?>