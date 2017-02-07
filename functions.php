<?php
require_once(__DIR__.'/config.php');

function logged_in($dir= "."){
	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1 || !defined('Permitted')){
		header("location:$dir/index.php");
	}
}

function update_user_info(array $params, $type){
	global $link;
	if($type == 0){
		foreach($params as $param => $value){
			$link->query("UPDATE students SET $param = '$value' WHERE fnumber = ".$_SESSION['id']);
			if($link->affected_rows < 0){
				throw new Exception("Промяната беше неуспешна. Грешка: ". $link->error);
			}
		}
		return true;
	} else {
		foreach($params as $param => $value){
			$link->query("UPDATE teachers SET $param= '$value' WHERE id = ".$_SESSION['id']);
			if($link->affected_rows < 0){
				throw new Exception("Промяната беше неуспешна. Грешка: ". $link->error);
			}
		}	
		return true;
	}
	
	return false;
}

function fetch_table_rows($table, $cond = true){
	global $link;
	$query = "SELECT * FROM $table WHERE $cond";
	if($result = $link->query($query)){
		return $result;
	} else {
		throw new Exception("Възникна грешка при извличането на данни от БД.");
	}		
}

function query($query, $cond = true, $op = "AND"){
	global $link;
	if($result = $link->query("$query $op $cond")){
		return $result;
	} else {
		throw new Exception("Възникна грешка при извличането на данни от БД.");
	}		
}


function fetch_join_table_rows($table, $join, $join_pk, $primary_key = 'id',  $cond = true){
	global $link;
	$table = $link->real_escape_string($table);
	$query = "SELECT * FROM $table JOIN $join on $table.$primary_key = $join_pk WHERE $cond";
	if($result = $link->query($query)){
		return $result;
	} else {
		throw new Exception("Възникна грешка при извличането на данни от БД.");
	}		
}

function fetch_user_info($id, $type){
	global $link;
	if($type == 0) {
		$result = $link->query("SELECT * FROM students WHERE fnumber=" . $id);
	} else {
		$result = $link->query("SELECT * FROM teachers WHERE id=" . $id);
	}
	return $result-> fetch_assoc();
}

function build_table_header(array &$theaders){
	$sizes = array_values($theaders);
	$headers = array_keys($theaders);
	echo "<table class=\"tg\">";
	echo "<colgroup>";
	foreach($sizes as $col){
		echo "<col style=\"width: $col %\">";
	}
	echo "</colgroup>";
	echo "<tr>";
	foreach($headers as $th){
		echo "<th class=\"tg-3we0\">". strtoupper($th) ."</th>";
	}
	echo "</tr>";
}
?>