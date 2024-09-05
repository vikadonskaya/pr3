<?php
 class Application_Models_Cart
  {	  
	  function addToCart($id, $count=1)// доавляет в корзину товар
	  {
		$_SESSION['cart'][$id]=$_SESSION['cart'][$id]+$count;		
		return true;
	  }	  
	  
	  function getListItemId() // возвращает список id продуктов из корзины
	  {	  	  		 
		if(!empty($_SESSION['cart'])){
		$listId=array_keys($_SESSION['cart']);
		return $listId;	}
		else
		return false;
	  }	  
	  
	  function getTotalSumm() // возвращает иготовую сумму корзины
	  {	  	  		 
		$array_product_id=$this->getListItemId(); // получаем списо id 
		$item_position = new Application_Models_Product();// создаем модель для работы с продуктами		
		
		foreach($array_product_id as $id){
			$product_positions[]=$item_position->getProduct($id);// получаем информацию о каждом продукте
		}
		foreach($product_positions as $product)
		{
			$total_summ+=$_SESSION['cart'][$product['id']]*$product['price'];// расчитываем сумму
		}
			
		return $total_summ;
	  }
	  
	  // отчищает корзину
	 function clearCart(){
    unset($_SESSION['cart']);
  }

	  
	  // обновляет содержимое корзины
	  function refreshCart($array_product_id){ // получает ассоциативный массив id=>count
		foreach($array_product_id as $Item_Id => $new_count){
			if($new_count<=0){ 
				unset($_SESSION['cart'][$Item_Id]); // если количесво меньше нуля, то удаляем запись
			}
			else
				$_SESSION['cart'][$Item_Id]=$new_count; // присваиваем новое количество			
			
		}
		
	  }
	  
	  // проверка корзины на заполненность
	 function isEmptyCart(){ 
    if($_SESSION['cart']) return true; 
    else return false;
    }

	  // возвращает html код корзины
	  function printCart()
	  {	  	  
		$array_product_id=array();
		$product_positions=array();
		
		$array_product_id=$this->getListItemId(); // получает список id
		
		$item_position = new Application_Models_Product();	// создаем модель для работы с продуктами	
		if (!empty($array_product_id))
		foreach($array_product_id as $id){
			$product_positions[]=$item_position->getProduct($id); // заполняем массив информацией о каждом продукте
		}	
	  // формируем интерфейс для работы с корзиной
			$table_cart="<table bgcolor='#E6DEEA' border='1' class='table_cart'><tr><th>№</th><th>Наименование</th><th>Стоимость</th><th>Количество</th><th>Сумма</th><th>Удалить</th></tr>";
			$i=1;
			foreach($product_positions as $product)
			{
				if ($i%2==0) $bgcolor="#F2F2F2"; else $bgcolor="lightgray";
				$table_cart.="<tr bgcolor=$bgcolor>";
				$table_cart.="<td>".$i++."</td>";
				$table_cart.="<td>".$product['name']."</td>";
				$table_cart.="<td>".$product['price']." руб. </td>";
				$table_cart.="<td><input type='text' style='text-align:center' size=3 name='item_".$product['id']."' value='".$_SESSION['cart'][$product['id']]."' /></td>";
				$table_cart.="<td>".$_SESSION['cart'][$product['id']]*$product['price']." руб. </td>";
				$table_cart.="<td>"."<INPUT TYPE='checkbox'  name='del_".$product['id']."'>"."</td>";
				$table_cart.="</tr>";	
				$total_summ+=$_SESSION['cart'][$product['id']]*$product['price'];
			}
			$table_cart.="<tr><td colspan='3'></td><td>К оплате: </td><td><strong> <span style='color: #7F0037'>".$total_summ." руб. </span></strong></td><td></td></tr></table>";
		
		return $table_cart;
	  }	  
  } 