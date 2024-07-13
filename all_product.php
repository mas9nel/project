<link rel="stylesheet" href="all_product.css">
<?php
    // подключаем функцию вывода текста
    include_once("Audit.php");
   
    $in_stok = isset( $_GET["in_stok"] ) ? $_GET["in_stok"] : false;
    $out_stok = isset( $_GET["out_stok"] ) ? $_GET["out_stok"] : false;
    $start_cost = isset( $_GET["start_cost"] ) ? htmlentities($_GET["start_cost"]) : false;
    $end_cost = isset($_GET["end_cost"]) ? htmlentities($_GET["end_cost"]) : false;
    $order_by = isset( $_GET["order_by"] ) ? $_GET["order_by"] : false;
    $search = isset( $_GET["search"] ) ? htmlentities($_GET["search"]) : false;
   
    // выполняем запрос sql
    $sql_product = "SELECT A.Product_id, P.name, P.type, P.cost, P.rating, P.volume, COALESCE(SUM(A.stok), 0) AS stok
                    FROM `Product` AS P
                    JOIN `Audit` AS A
                    ON A.Product_id = P.id";
    
    if($search){ $sql_product .= " WHERE LOWER(name) LIKE LOWER('%$search%') 
                                   OR LOWER(type) LIKE LOWER('%$search%')
                                   OR LOWER(volume) LIKE LOWER('%$search%')";};
    
    if($start_cost && $end_cost){
        $sql_product .= ($search)? " AND" : " WHERE";
        $sql_product .= " cost BETWEEN $start_cost AND $end_cost";
    }
    elseif($start_cost){ 
        $sql_product .= ($search)? " AND" : " WHERE";
        $sql_product .= " cost > $start_cost";
    }
    elseif($end_cost){ 
        $sql_product .= ($search)? " AND" : " WHERE";
        $sql_product .= " cost < $end_cost";
    };

    $sql_product .= " GROUP BY P.id";

    if ($in_stok){ $sql_product .= " HAVING stok > 0";};

    if ($out_stok && !$in_stok){ $sql_product .= " HAVING stok < 1";}
    elseif($out_stok && $in_stok){ $sql_product .= " OR stok < 1";}
    elseif(!$out_stok && !$in_stok){ $sql_product .= " Having stok < -1";};

    if($order_by){ $sql_product .= " ORDER BY $order_by";};
    
    $result_product = mysqli_query($connect, $sql_product);
    
    if(!$result_product){die("Ошибка: некорректный запрос!");};

    if(!mysqli_num_rows($result_product)){echo "<h1 class='error'>Товаров по вашему запросу не обнаружено!<h1>";};

    // создаём массив с объектами
    $product = [];
    while($r_p = mysqli_fetch_array($result_product)){
        $product[$r_p["Product_id"]] = new Audit();
        foreach($r_p as $key => $value){
            $product[$r_p["Product_id"]]->bind($key, $value);
        };
    };
    
    // выводим данные объектов
    foreach($product as $value):
?>
    <a href="index.php?id=<?php $value->print("Product_id");?>" class="all_product_data">
        <img src="img/<?php $value->print("name");?>.jpg" alt="Изображение товара не найдено">
        <div>
            <b>Название:</b> <?php $value->print("name","название товара отсутствует");?><br>
            <b>Тип:</b> <?php $value->print("type","тип не указан");?><br>
            <b>Объём:</b> <?php $value->print("volume","объём памяти не указан");?>ТБ
        </div>
        <div>
            <b>Рейтинг:</b> <?php $value->print("rating","рейтинг не указан");?><br>
            <b>Цена:</b> <?php $value->print("cost","цена не указана");?> р.<br>
            <b>Кол-во(шт.):</b> <?php $value->print("stok", "товара нет в наличие");?>
        </div>
    </a>
<?php endforeach;?>