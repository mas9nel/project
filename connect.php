<?php
    //подключение базы данных
    $connect = mysqli_connect("", "", "", "");

    if (!$connect) {die("Ошибка: ". mysqli_connect_error());}
