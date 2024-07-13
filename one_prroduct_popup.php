<div id="one_product_popup">
    <div id="one_product_popup_exit">
        <button>x</button>
    </div>
    <form method="GET" action="index.php" id="popup_bye">
        <input type="hidden" name="id" value="<?php $product->print("id");?>">
        <input type="hidden" name="shop_id" value="<?php echo $shop_id;?>">
        <input type="submit" class="button" id="one_product_popup_bought" value="Купить">
        <input type="number" min="1" max="<?php ($shop_id)? $shops[$shop_id]->print("stok") : null;?>" value="1" name="bought">
        Кол-во:
    </form>
</div>