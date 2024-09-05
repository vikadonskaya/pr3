<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/template/style.css" type="text/css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo">
				<a href="/"><img src="/images/logo.png"/></a>
			</div>	
			<div class="smalcart">
				<strong>Товаров в корзине:</strong>	<?=$smal_cart['cart_count']?> шт.
				<br/>
				<strong>На сумму:</strong>	<?=$smal_cart['cart_price']?> руб.	
				<br/>
				<a href='/cart'>Оформить заказ</a>
			</div>	
			<div class="menu">
				<?=$menu?>
			</div>	

		</div>
		<div id="content">
		<hr/>
			
	