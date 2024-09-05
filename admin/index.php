<?
session_start(); //открываем сессию
?>
<link rel="stylesheet" href="design/style.css" type="text/css" />
<?if($_SESSION["Auth"] && $_SESSION["role"]=="1"):
?>
<html>

  <head>
    <script type="text/javascript" src="../script/jquery.form.js"></script>
	<script type="text/javascript" src="../script/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../script/admin.js"></script>
  </head>
  
  <body>
  
 <div id="header">
		<div class="logo"></div>		
		<div class="menu">
			<ul>
				<li ><a href="/" id="look">Просмотр</a></li>
				<li class="products"><a href="#" id="product">Товары</a></li>
				<li class="page"><a href="#" id="page">Страницы</a></li>
				<li class="menu"><a href="#" id="menu">Меню</a></li>
				<li class="settings"><a href="#" id="settings">Настройки</a></li>

			</ul>
		</div>
		<div class="user">
			<a href="#"><?=$_SESSION["User"]?></a> (<a href="/enter?out=1">Выход</a>)
		</div>
	</div>
	
	<div id="message_box">
	<div id="message">
	
	</div>
	</div>

	<div id="content">
		<div class="data">
			<p>Добро пожаловать в панель администрирования системы!</p>
		</div>
	</div>

  </body>
  
</html>
<?else:?>
<div class="login_form">
<h2>Авторизация</h2>
<div class="info">
<?if(!$_SESSION["Auth"]){
echo "Только администраторы могут пользоваться этим разделом!";
}
else 
{
if($_SESSION["role"]>1) echo "У вас нет доступа к этой части сайта!";
}?>
</div>
Введите логин и пароль администратора:
<form action="/enter" method="POST">
<table id="login_form_table" style="margin-top:10px;">
<tr>
  <td>Логин:</td><td><input type="text" name="login" value="<?=$login?>" /></td>
</tr>
<tr>
  <td>Пароль:</td><td><input type="text" name="pass" value="<?=$pass?>" /></td>
</tr>
<tr>
<td colspan="2">
  <input type="hidden" name="location" value="/admin" />
  <input type="submit" value="Вход" />
</td>  
</tr>  
</table>  
</form>

<?endif;?>
</div>