<?
$model=new Application_Models_Product;	
if($id=$model->addProduct($_POST))
	$response=array("msg"=>"Создан товар № $id","status"=>true);
else
	$response=array("msg"=>"Не удалось создать товар!","status"=>false);	
echo json_encode($response);
?>