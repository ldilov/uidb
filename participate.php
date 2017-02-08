<?php
require_once('functions.php');
logged_in();

//Извиличане на данни
try {
	$data = query("SELECT courses.name, categories.title as cat, type, teachers.title, teachers.firstName, teachers.lastName, courses.credits, participate.completed, participate.mark FROM courses 
					JOIN participate on course_id = courses.id
					JOIN categories ON category = categories.id
					JOIN teachers ON teacher_id = teachers.id
	");
} catch (Exception $e){ ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
		<hr class="message-inner-separator">
		<p><?php echo $e->getMessage(); header("Refresh:5; url=index.php"); exit();?></p>
	</div>
<?php
}
if($data->num_rows === 0){
	echo "<div class=\"alert alert-info fade in\"> Няма налични курсове. </div>";
} else {
	//Построяване на таблицата
	$theaders = array (
		"име" => 15,
		"категория" => 15,
		"тип" => 10,
		"преподавател" => 20,
		"кредити" => 10,
		"оценка" => 5,
		"взет" => 5,
		"операция" => 20
	);
	build_table_header($theaders);
	$class = ["tg-dfop", "tg-mvlx"];
	$index = $iter = 0;
	while($row = $data->fetch_assoc()){
		include('/modules/courses_data.php');
		$iter = $iter == 1? 0 : 1 ;
		$index++;
	}
}
?>
</table>