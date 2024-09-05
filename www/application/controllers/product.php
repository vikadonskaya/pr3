<?php
//контролер обрабатывает данные каталога
  class Application_Controllers_Product extends Lib_BaseController
  {
     function index()
	 {
	     $model=new Application_Models_Product;
		 $product = $model->getProduct($_REQUEST['id']);	
		 $this->product=$product;
		
	 }
  }
/*
  Автор: Авдеев Марк.
  e-mail: mark-avdeev@mail.ru
  blog: lifeexample.ru
*/
?>