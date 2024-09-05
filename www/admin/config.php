<?php
//Error_Reporting(E_ALL & ~E_NOTICE);//не выводить предупреждения
function __autoload ($class_name) //автоматическая загрузка кслассов
 {
    $path=str_replace("_", "/", strtolower($class_name));//разбивает имя класска получая из него путь
	if (file_exists("../".$path.".php")) {
     include_once("../".$path.".php");//подключает php файл по полученному пути	
	}
	else{
	header("HTTP/1.0 404 Not Found");
	echo "К сожалению такой страницы не существует. [".PATH_SITE.$path.".php ]";
	exit;
	}
}


 define('PATH_SITE', $_SERVER['DOCUMENT_ROOT']."/"); 		//сервер

  require_once "../setting_sql.php"; //файл настроек
 
	function translitIt($str) 
	{
	  $tr = array(
			"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
			"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
			"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
			"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
			"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
			"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
			"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
			" "=> "_", "."=> "", "/"=> "_","1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5",
			"6"=>"6","7"=>"7","8"=>"8","9"=>"9","0"=>"0"
		);
		return strtr($str,$tr);
	}

	function create_url($urlstr){
		if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
			$urlstr = translitIt($urlstr);
			$urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
			return $urlstr;
		}
		return false;
	} 

	function loger($text){
	$vvod=print_r($text , true);
	$date = date("Y_m_d");
	$filename = "log_".$date.".txt";
	$string = date("d.m.Y H:i:s")." => $vvod"."\n";
	$f = fopen($filename,"a+");
	fwrite($f,$string);
	fclose($f);
}
/*
  Автор: Авдеев Марк.
  e-mail: mark-avdeev@mail.ru
  blog: lifeexample.ru
*/
?>