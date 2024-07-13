<!-- форма с левой стороны -->
<form method="GET" action="index.php" id="left_form">
    
    <input type="hidden" name="id" value="0">
    
    Сортировка по:<br>
    <select name="order_by">
        <option value="rating DESC">Рейтингу</option>
        <option value="cost ASC">Убыванию цены</option>
        <option value="cost DESC">Возрастанию цены</option>
    </select>

    В наличие:<br>
    <input type="checkbox" name="in_stok" checked>
    
    Не в наличие:<br>
    <input type="checkbox" name="out_stok">
    
    Цена от:<br>
    <input type="number" name="start_cost" >

    Цена до:<br>
    <input type="number" name="end_cost" >
    
    <input type="submit" class="button" value="Найти" id="form_left_find">
</form>