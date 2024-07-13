//меняем тёмную/светлую тему и сохраняем значение
function index_theme(){
    if(document.documentElement.hasAttribute("theme")){
        document.documentElement.removeAttribute("theme");
        localStorage.removeItem("theme");
    }else{
        document.documentElement.setAttribute("theme", "dark");
        localStorage.setItem("theme", "dark");
    };
};

const btn = document.getElementById("change_theme");
btn.addEventListener("click", index_theme);

document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("theme") === "dark") {
      document.documentElement.setAttribute("theme", "dark");
    }
});

// прячем/добавляем popup на странице one_product.php
function one_product_popup_show_hide(){ ;
    if(document.getElementById("one_product_popup").hasAttribute("popup_hide")){
        document.getElementById("one_product_popup").removeAttribute("popup_hide");
        localStorage.removeItem("popup_hide");
    }else{
        document.getElementById("one_product_popup").setAttribute("popup_hide", "hide");
        localStorage.setItem("popup_hide", "hide");
    };
};

const one_product_popup_exit = document.getElementById("one_product_popup_exit");
const one_product_popup_bought = document.getElementById("one_product_popup_bought");
const one_product_bye = document.getElementById("one_product_bue");

if (one_product_popup_exit) one_product_popup_exit.addEventListener("click", one_product_popup_show_hide);
if (one_product_popup_bought) one_product_popup_bought.addEventListener("click", one_product_popup_show_hide);
if (one_product_bye) one_product_bye.addEventListener("click", one_product_popup_show_hide);

if(document.getElementById("one_product_popup")) document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("popup_hide") === "hide") {
      document.getElementById("one_product_popup").setAttribute("popup_hide", "hide");  
    }
});

document.getElementById("form_right_main").onclick = () => localStorage.setItem("popup_hide", "hide");
document.getElementById("header_find").onclick = () => localStorage.setItem("popup_hide", "hide");
document.getElementById("form_left_find").onclick = () => localStorage.setItem("popup_hide", "hide");

//удаляем параметр из запроса
const url = new URL(document.location);
const searchParams = url.searchParams;
searchParams.delete("bought");
window.history.pushState({}, '', url.toString());

// включаем/отключаем покупку в зависимости от наличия товара на складе
function one_product_get_cheked_input(){
    const curent_shop = document.querySelector("input[name='shop_id']:checked");
    if(!curent_shop.getAttribute("stok"))
        document.getElementById("one_product_bue").disabled = true;
    else
        document.getElementById("one_product_bue").disabled = false;
};
if(document.getElementById("shops_data")) document.getElementById("shops_data").addEventListener("change", one_product_get_cheked_input)