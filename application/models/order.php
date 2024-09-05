<?php
//Модель оформления заказа
 class Application_Models_Order extends Lib_DateBase // наследует все методы класса для работы с бд
  {	  
		private $fio;
		private $email;
		private $phone;
		private $adres;
		
		// проверка на корректность ввода данных
		function isValidData($array_data){
			//корректность емайл
			if(!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $array_data['email'])){ 
			  $error="E-mail не существует!";	
			} 
			// заполненность адреса
			elseif(!trim($array_data['adres'])){ 
			  $error="Введите адресс!";	
			}
			//если нет ощибок, то заносим информацию в поля класса
			if($error)return $error;
			else{
				$this->fio=trim($array_data['fio']);
				$this->email=trim($array_data['email']);
				$this->phone=trim($array_data['phone']);
				$this->adres=trim($array_data['adres']);
				return false;
			}		
     
		}
		
	//добавление заявки		
	function addOrder(){
		$date = mktime(); //текущая дата в UNIX формате
			
		$item_position = new Application_Models_Product();
		//добавляем в массив корзины третий параметр  цены товара, для сохранения в заказ
		// это нужно для того чтобы в последствии вывести детальную информацию о заказе. 
		//Если оставить только id то информация может оказаться не верной, так как цены меняютмя.
		foreach($_SESSION['cart'] as $product_id=>$count){
			$price=$item_position->getProductPrice($product_id);
			$product_positions[$product_id] = array(
			"price"=>$price,
			"count"=>$count,
			);
		}
		// сериализуем данные в строку для записи в бд
		$order_content=addslashes(serialize($product_positions));
		// создаем новую модель корзины чтобы узнать сумму заказа
		$cart = new Application_Models_Cart();	
		$summ = $cart->getTotalSumm();
		
		//формируем массив параметров SQL запроса
		$array=array(
			"name"=>$this->fio, 
			"email"=>$this->email,
			"phone"=>$this->phone,
			"adres"=>$this->adres,
			"date"=>$date,
			"summ"=>$summ,
			"order_content"=>$order_content
		);
		
		// отдаем на обработку  родительской функции build_query
		parent::build_query("INSERT INTO `order` SET",$array);
		$id=parent::insert_id(); //заказ номер id добавлен в базу
		
		if($id) $cart->clearCart();// если заказ успешно записан, то отчищаем корзину
		return $id; // возвращаем номер заказа
	}
	
  } 
 /*
  Автор: Авдеев Марк.
  e-mail: mark-avdeev@mail.ru
  blog: lifeexample.ru
*/