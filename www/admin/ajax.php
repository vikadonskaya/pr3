<?
require_once "./config.php";

//���������� �������� ��������
if($_REQUEST['url']=="catalog.php"){
	if(isset($_REQUEST['l']) && isset($_REQUEST['step'])){
	 $lower_bound=$_REQUEST['l']; 
	 $step=$_REQUEST['step'];
	}

	require_once "./".$_REQUEST['url'];
}
else
require_once "./".$_REQUEST['url'];

?>