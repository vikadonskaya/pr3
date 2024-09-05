<?
$model=new Application_Models_Product;	
if($model->deleteProduct($_POST['id']))
	$response=array("msg"=>"Удален товар № {$_POST['id']}","status"=>true);
else
	$response=array("msg"=>"Не удалось удалить товар!","status"=>false);	
echo json_encode($response);
?>