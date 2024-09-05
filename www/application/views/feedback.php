<h1>Обратная связь</h1>
<?if($error){ echo $error;}?><br/>
<?
if($dislpay_form){?>
<form action="" method="post">
<table class="table_order_form"> 
<tr bgcolor="#F2F2F2"><td>Ф.И.О.</td><td><input type="text" name="fio" value="<?=$_REQUEST['fio']?>"/></td></tr>
<tr bgcolor="lightgray"><td>E-mail<span style="color: red;">*</span></td><td><input type="text" name="email" value="<?=$_REQUEST['email']?>"/></td></tr>
<tr bgcolor="#F2F2F2"><td>Сообщение:</td><td><textarea name="message"><?=$_REQUEST['message']?></textarea></td></tr>
</table>
<br/>
<input type="submit" name="send" value="Отправить сообщение">
</form>
<?}
else{ echo $message; };
?>
