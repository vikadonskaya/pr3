<?php
//контролер обрабатывает данные каталога
  class Application_Controllers_Catalog extends Lib_BaseController
  {
     function index()
	 {
		 if($_REQUEST['in-cart-product-id']) 
			{
			    $cart=new Application_Models_Cart;
				$cart->addToCart($_REQUEST['in-cart-product-id']);
				Lib_SmalCart::getInstance()->setCartData();
				header('Location: /catalog');
				exit;
			}
	

	
	
			$step=6;//сколько выводить на странице объектов	
			$page=1;
			if(isset($_REQUEST['p'])){ //запрашиваемая страница
			$page=$_REQUEST['p'];
			}
		
	     $model=new Application_Models_Catalog;
		 $Items =$model->getPageList($page,$step);//передаем номер страницы, и количество объектов
		
		 
		 
		 foreach($Items as $data){

			if(key($data)=="pagination"){
				$pagination=$data["pagination"];
				
				foreach($pagination as $page=>$info){
				
				if(is_numeric($page))
					$pages.='<a class="'.$info[2].'" href="/catalog?p='.($page+1).'">'.($page+1).'</a>';
		
				}
				
				$pages='<div class="pagination">Страница '.$pagination['activ_page'].' из '.(count($pagination)-1).' '.$pages.'</div>';
				$this->pager=$pages;
			}		 
	 }

	//удаляем из массиваинформацию о пагинации? вся она хранится в последнем элементе массива
	 $id_pagination_element=count($Items)-1;
	 unset($Items[$id_pagination_element]);
		
	 $this->Items=$Items;
	
  }
  }