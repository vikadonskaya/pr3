<?php

class Lib_DateBase {


function query($query)
{

//func_num_args -  ���������� ���������� ����������, ���������� �������

	if(($num_args = func_num_args()) > 1){
		$arg  = func_get_args();
		unset($arg[0]);
		//������� �������� ������� args, ����������������� � ������������ � ���������� format, 
		
		
		foreach($arg as $argument=>$value){
			$arg[$argument]=mysql_real_escape_string($value); // ���������� ������� ��� ���� ������� ����������
		}

		$query = vsprintf($query,$arg);	

	}




	
	$sql = mysql_query($query);
	

	
	
	
	if(preg_match('`^(INSERT|UPDATE|DELETE|REPLACE)`i',$query,$null)){
		if($this->affected_rows($sql)){
			return $sql;
		}		
	}else{
		if($this->num_rows($sql)){
			return $sql;
		}
	}

	return false;	
}

function build_query($query,$array,$_devide = ',')
{
	if(is_array($array)){
		$part_query = '';
		foreach($array as $index=>$value){
			$part_query .= sprintf(" `%s` = '%s'".$_devide,$index,mysql_real_escape_string($value));
		}
		$part_query = trim($part_query,$_devide);
		$query.=$part_query;
		return $this->query($query);
	}
	return false;
}

function build_part_query($array,$_devide = ',')
{
	$part_query="";
	if(is_array($array)){
		$part_query = '';
		foreach($array as $index=>$value){
			$part_query .= sprintf(" `%s` = '%s'".$_devide,$index,mysql_real_escape_string($value));
		}
		$part_query = trim($part_query,$_devide);
		
	}
	return $part_query;
}

//mysql_fetch_object- ������������ ��� ���������� ������� � ���������� ������
function fetch_object($object)
{
	return @mysql_fetch_object($object);
}

//mysql_num_rows() ���������� ���������� ����� ���������� �������.
function num_rows($object)
{
	return @mysql_numrows($object);
}
 
//mysql_affected_rows() ���������� ���������� �����, ���������� ��������� INSERT, UPDATE, DELETE �������� � �������, �� ������� ��������� ��������� link_identifier.
function affected_rows($object)
{
	return mysql_affected_rows();
}

function fetch_assoc($object)
{
	return mysql_fetch_assoc($object);
}

//mysql_insert_id -  ���������� ID, ��������������� ��� ��������� INSERT-�������.
function insert_id()
{
	return mysql_insert_id();
}
}