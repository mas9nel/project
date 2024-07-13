<?php
    //подключение базы данных
    $connect = mysqli_connect("localhost", "pozdeshev1", "Rfhfvtkm666", "pozdeshev1");
    if (!$connect) {die("Ошибка: ". mysqli_connect_error());}
