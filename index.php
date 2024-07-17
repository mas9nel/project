<?php 
    $id = isset($_GET["id"])? $_GET["id"] : "0";
    $in_stok = isset( $_GET["in_stok"] ) ? $_GET["in_stok"] : "on";
    $out_stok = isset( $_GET["out_stok"] ) ? $_GET["out_stok"] : false;
    include_once "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Project</title>
</head>
<body>
    <div>
        <?php include_once("form_left.php");?>
    </div>
    <div id="center_container">
        <header>
            <?php include_once("header.php");?>
        </header>
        <main>
            <?php ($id != "0")? include_once("one_product.php") : include_once("all_product.php");?>
        </main>
        <footer><?php include_once("footer.php");?></footer>
    </div>
    <div> 
        <?php include_once("form_right.php");?>
    </div>
    <script src="script.js"></script>
</body>
</html>
<?php
    mysqli_close($connect);
?>
