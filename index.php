<?php
/*
  Автор: Авдеев Марк.
  e-mail: mark-avdeev@mail.ru
  blog: lifeexample.ru
*/

require_once "./config.php"; //файл настроек

//-------------------------------------
$router=new Lib_Application; //создаем объект, который будет искать нуджные контролеры
$member=$router->Run();//Начинаем поиск нужного контролера

if(isset($member)) //если контролер вернул какието переменные, то делаеми их доступными для публичной части
  foreach ($member as $key => $value)
	{
	 	$$key= $value; 
		// Возможно здесь кому-то будет не понятно назначение оператора $$.
		// Приведу пример
		//  $a="b";
		//	$$a=1;
		//	echo $b;
		// В результате на выходе получим: 1
		// Можно провести аналогию оператора $$ с указателями в C++

	}
 if($_SESSION["Auth"] && $_SESSION["role"]=="1"){	
		require_once "admin/adminbar.php";
		}	
require_once "./function.php";//подключаем функционал сайта
require_once "./template/index.php";//подключаем шаблон сайта 