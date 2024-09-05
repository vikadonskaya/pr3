<?php
$menu=getMenu();
$smal_cart=getSmalCart();

function getMenu(){
	return Lib_Menu::getInstance()->getMenu();
}
function getSmalCart(){
	return Lib_SmalCart::getInstance()->getCartData();
}

