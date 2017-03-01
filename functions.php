<?php
require_once(__DIR__.'/config.php');
$error_msg = "Възникна грешка при извличането на данни от БД. Ще Ви пренасочим към главната страница след 5 секунди.";

function verify($dir= ".", $cond = true){
	if(!isset($_SESSION['verify']) || $_SESSION['verify'] != 1 || !defined('Permitted') || !$cond){
		header("location:$dir/index.php");
	}
	
	$account = fetch_user_info($_SESSION['id'], 0, "status");
	if($_SESSION['type'] == 0 && $account['status'] == 1){
		$_SESSION['accountDeactivated'] = true;
		die(header("location:index.php?accountDeactivated"));
	}
}

function verify_admin($dir= ".", $cond = true){
	if(!isset($_SESSION['verify']) || $_SESSION['verify'] != 2 || !defined('Permitted') || !$cond || $_SESSION['type'] != 'admin'){
		header("location:$dir/index.php");
	}
}

function update_table($table, array $params, $cond){
	global $link;

	foreach($params as $param => $value){
		if($value == null || $value == "")
			continue;

		$result = $link->query("UPDATE $table SET $table.$param = '$value' WHERE $cond");
		if($link->affected_rows < 0 || !$result){
			throw new Exception("Промяната беше неуспешна. Грешка: ". $link->error);
		}
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
	global $link, $error_msg;
	$query = "SELECT * FROM $table WHERE $cond";
	if($result = $link->query($query)){
		return $result;
	} else {
		throw new Exception($error_msg);
	}		
}

function query($query, $cond = true, $op = "AND", $limit = "-1"){
	global $link, $error_msg;
	$query = $limit == -1 ? "$query $op $cond" : "$query $op $cond LIMIT $limit";
	if($result = $link->query($query)){
		return $result;
	} else {
		throw new Exception($error_msg.$link->error);
	}		
}

function fetch_user_info($id, $type, $param = "*"){
	global $link;
	if($type == 0) {
		$result = $link->query("SELECT $param FROM students WHERE fnumber=" . $id);
	} else {
		$result = $link->query("SELECT $param FROM teachers WHERE id=" . $id);
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
		echo "<th class=\"tg-3we0\">$th</th>";
	}
	echo "</tr>";
}

function build_table_footer(array &$tfooter){
	echo "<tfoot><tr>";
	foreach($tfooter as $ft){
		echo "<td class=\"tfooter\">$ft</td>";
	}
	echo "</tr></tfoot>";
}

function campaignAvailable(){
	global $first_sem, $second_sem, $campaign_end;
	$cur = (int)date('m');
	$day = (int)date('d');
	if($cur == $first_sem || $cur == $second_sem){
		return true;
	}elseif($cur == $first_sem + 1 || $cur == $second_sem + 1){
		if($day <= $campaign_end)
			return true;
	}
return false;
}

function getPages($data){
    global $itemsPerPage;
	$rows = $data->num_rows;
	return ($rows % $itemsPerPage) == 0 ? (int)($rows / $itemsPerPage) : (int)($rows / $itemsPerPage + 1);
}

/* Verifications
---------------------------------------*/
function userRegAllowed($type){
	global $link, $error_msg;
	if($type == 1){
		$data = $link->query("SELECT teacher_registration_allowed FROM options");
	} else {
		$data = $link->query("SELECT students_registration_allowed FROM options");
	}
	
	if($data)
	{
		$val = $data->fetch_assoc();
		return (int)reset($val);
	} else {
		throw new Exception($error_msg.$link->error);
	}
	
}

/* Students functions 
---------------------------------------*/

function getCredits($id){
	global $link;
	$query = "SELECT credits FROM courses JOIN participate on courses.id = participate.course_id WHERE student_id = $id AND completed > 0";
	$credits = 0;
	if($result = $link->query($query)){
		while($row = $result->fetch_assoc()){
			$credits += $row['credits'];
		}
	}
	return $credits;
}
?>