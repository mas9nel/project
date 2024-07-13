<?php
    //подключение базы данных
    $connect = mysqli_connect("localhost", "root", "", "Project");
    if (!$connect) {die("Ошибка: ". mysqli_connect_error());}