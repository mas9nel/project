<link rel="stylesheet" href="one_product.css">
<?php
    // подключаем функцию вывода текста
    include_once("Audit.php");

    // получаем GET переменные    
    $shop_id = isset($_GET["shop_id"]) ? $_GET["shop_id"] : false;
    $bought = isset($_GET["bought"]) ? $_GET["bought"] : false;
    
    //массив для вывода данных о магазинах
    $shops = [];
    
    // получаем данные о товаре
    if($bought){
        $sql_goods = "UPDATE Audit 
                      SET stok = stok - $bought
                      WHERE Product_id = $id 
                      AND Shop_id = $shop_id";
        mysqli_query($connect, $sql_goods);
    };

    $sql_product = "SELECT *
                    FROM `Product` 
                    WHERE id = $id";

    $result_product = mysqli_query($connect, $sql_product);                  

    if(!$result_product){die("Ошибка: продукта не существует");};

    $r_p = mysqli_fetch_array($result_product);
    
    $product = new Audit();
    foreach($r_p as $key => $value){$product->bind($key, $value);};

    // получаем данные о магазинах и кол-ве товара
    $sql_shops_stok = "SELECT A.Shop_id, A.Product_id, COALESCE(A.stok, 0) AS stok, S.name, S.adress
                       FROM `Audit` AS A
                       JOIN `Shops` AS S 
                       ON A.Shop_id = S.id
                       WHERE A.Product_id = $id";
    
    $result_shops_stok = mysqli_query($connect, $sql_shops_stok);

    if(!$result_shops_stok){die("Ошибка: подключение к складу не установленно");};
    
    while($r_s_s = mysqli_fetch_array($result_shops_stok)){
        $shops[$r_s_s["Shop_id"]] = new Audit();
        foreach($r_s_s as $key => $value){$shops[$r_s_s["Shop_id"]]->bind($key, $value);};
    };
?>
<!-- выводим данные о товаре -->
<h1><?php $product->print("name", "Наименование товара не указано")?></h1>
<div id="one_product_data">
    <img id="one_product_img" src="img/<?php $product->print("name");?>.jpg" alt="Изображение товара не найдено">
    <div>
        Рейтинг:<br><img id="one_product_rating" src="img/<?php $product->print("rating","");?>.jpg" alt="звёзды рейтинга отсутствуют"><br>
        Тип: <?php $product->print("type", "Тип товара не указан");?><br>
        Цена: <?php $product->print("cost");?> р.<br>
        Тип соединения: <?php $product->print("connector");?><br>
        Материал корпуса: <?php $product->print("material", "материал не указан");?><br>
        Вес: <?php $product->print("weight", "вес не указан");?> гр.<br>
        Страна производитель: <?php $product->print("country", "страна не указана");?>
    </div>
</div>

<!-- Выводим данные о магазинах -->
<form method="GET" id="shops_data">
    <input type="hidden" name="id" value="<?php $product->print("id");?>">
    <button type="submit" class="button" id="one_product_bue" disabled> Купить</button><br>
    <?php foreach($shops as $value):?>
            <input type="radio" value="<?php $value->print("Shop_id");?>" name="shop_id" stok="<?php $value->print("stok");?>"> 
            <b>Магазин: </b> <?php $value->print("name", "название магазина не указано");?> <b> Адрес: </b> <?php $value->print("adress", "адрес не указан");?> . <b> Кол-во:</b> <?php $value->print("stok", "товар отсутствует");?><br>
    <?php endforeach;?>
</form>

<div id="one_product_footer">
    <h2>Описание:</h2>
    <?php $product->print("description", "Описание отсутствует.");?>
</div>

<!-- подключаем popup -->
<?php include_once("one_prroduct_popup.php"); ?>