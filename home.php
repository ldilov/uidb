<?php
$exams = [];
$result = $link->query("SELECT name, date FROM exams JOIN courses ON exams.course_id = courses.id");
while($row = $result->fetch_assoc()){
	$time = strtotime($row['date']);
	$newformat = date('Y-m-d',$time);
	$exams[$row['name']] = $newformat;
}

echo '<script>';
echo 'var arr = ' . json_encode($exams) . ';';
echo '</script>';
?>
<div class="container">
<p id="demo"> </p>
    <hr>
	<div id="calendar"></div>
</div>