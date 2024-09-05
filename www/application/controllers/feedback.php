<?php
  class Application_Controllers_Feedback extends Lib_BaseController
  {  
    function index()
	 {				
		$this->dislpay_form = true; // показывать форму ввода данных
			if(isset($_REQUEST["send"])){  // если пришли данные с формы
				$feed_back = new Application_Models_Feedback;	//создаем модель отправки сообщения
				$error=$feed_back->isValidData($_REQUEST);  //проверяем на корректность вода
				if($error)$this->error=$error; // если есть ошиби заносим их в переменную 
				else{			
					$feed_back->sendMail();
					header('Location: /feedback?thanks=1');
					exit;
				}
			}
			
			if(isset($_REQUEST["thanks"])){
			   //формируем сообщение 
					$this->message="Ваше сообщение отправленно!";
					$this->dislpay_form = false;//  форму ввода данных больше не покзываем
			}
	 }
  }
/*
  Автор: Авдеев Марк.
  e-mail: mark-avdeev@mail.ru
  blog: lifeexample.ru
*/