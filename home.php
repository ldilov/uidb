<?php
require_once("functions.php");
require_once("config.php");
verify();
$exams = [];
if($_SESSION['type'] ==0){
	$result = $link->query("SELECT name, date, exams.hour FROM exams JOIN courses ON exams.course_id = courses.id WHERE exams.course_id IN (SELECT course_id FROM participate WHERE student_id = ".$_SESSION['id']. " AND completed < 1)");
} else {
	$result = $link->query("SELECT name, date, exams.hour FROM exams JOIN courses ON exams.course_id = courses.id WHERE courses.teacher_id =".$_SESSION['id']);
}
while($row = $result->fetch_assoc()){
	$time = strtotime($row['date'].$row['hour']);
	$newformat = date('Y-m-d h:i',$time);
	$exams[$row['name']] = $newformat;
}

echo '<script>';
echo 'var arr = ' . json_encode($exams) . ';';
echo 'var url = '. json_encode($url) . ';';
echo '</script>';
?>
<script src="js/calendar.js"></script>
<div class="container responsive-container">
<p id="demo"> </p>
    <hr>
	<div id="calendar"></div>
</div>