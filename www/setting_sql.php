<?php
 define('HOST', 'localhost'); 		//сервер
 define('USER', 'root'); 			//пользователь
 define('PASSWORD', ''); 			//пароль
 define('NAME_BD', 'LifeExampleShop');		//база
 $connect = mysql_connect(HOST, USER, PASSWORD)or die("Невозможно установить соединение c базой данных".mysql_error( ));
 mysql_select_db(NAME_BD, $connect) or die ("Ошибка обращения к базе ".mysql_error());	
 mysql_query('SET names "utf8"');   //база устанавливаем кодировку данных в базе