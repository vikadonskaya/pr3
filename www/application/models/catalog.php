<?php
//Модель вывода каталога
 class Application_Models_Catalog extends Lib_DateBase
  {	  
	//получает список продуктов, возвращает все данные о них. А также разбивает на страницы полученный список
	  function getList($lower_bound=0, $step=6)
	  { 
		// формирует страницу с продуктами 
		$result = parent::query("SELECT * FROM  `product` ORDER BY id LIMIT %d , %d",$lower_bound,$step);
		if(parent::num_rows($result))
		while ($row = parent::fetch_assoc($result))
		{		 
			$сatalogItems[]=$row;
		}
		
		// вычисляет общее количество продуктов 
		$result = parent::query("SELECT id FROM  `product` ORDER BY id ");	   
		$count = parent::num_rows($result);
		// вычисляет параметры для пагинации
		
		
		$array_page=array(); 
		$k=1;
		if($step=="0")$step=1;		
		for($i=1; $i<=ceil($count/$step); $i++)
			{
				unset($num);
				for($j=0; $j<$step; $j++)
					$num[]=$k++;
				
				$array_page[$i]=$num;
			}
		

		
		foreach($array_page as $pageid=>$page){
	
			foreach($page as $num){
			
				if($num==($lower_bound+1)){
					$activ=$pageid;
				}
			}
		}	

		
		$pagination["activ_page"]=$activ;
		$k=0;
		for($s=0; $s<$count; $s+=$step){
			$class="noactiv";
			if($activ==($k+1)){$class="activ";}
			$pagination[$k]=array($s,$step,$class);
			$k++;
		}
		// дописывает  к возвращаемому массиву информацию о пагинации  		  
		$сatalogItems[]=array('pagination'=>$pagination);
		
		return $сatalogItems; 
	  }
	  
	  
	  //вычисляет нижнюю границу для запрашиваемой страницы, и передает данные в getList
	   function getPageList($page=1,$step=5)
	  { 
		
		// вычисляет общее количество продуктов 
		$result = parent::query("SELECT id FROM  `product` ORDER BY id ");	   
		$count = parent::num_rows($result);
		// вычисляет параметры для пагинации
		$array_page=array(); 
		$k=1;
		if($step=="0")$step=1;		
		for($i=1; $i<=ceil($count/$step); $i++)
			{
				unset($num);
				for($j=0; $j<$step; $j++)
					$num[]=$k++;
				
				$array_page[$i]=$num;
			}
			


		$lower_bound=$array_page[$page][0]-1;
		if(!isset($lower_bound))$lower_bound=1;
		
		
		
		return $this->getList($lower_bound, $step);		
	  }
  } 