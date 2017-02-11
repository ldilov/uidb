<?php
require_once('functions.php');
verify();

//Проверка за операция
if(isset($_POST['op'])){
	switch($_POST['op']){
		case 'edit':
		require_once('modules\courses_edit.php');
		break;
		
		case 'del';
		require_once('modules\courses_delete.php');
		break;
	}
}


//Изкарване на съобщения, ако има такива
if(isset($success)){ ?>
    <div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-ok"></span> <strong>Операцията е успешна:</strong>
        <hr class="message-inner-separator">
        <p><?php echo $success; ?></p>
    </div>
<?php	
} elseif(isset($error)){?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
		<hr class="message-inner-separator">
		<p><?php echo $error;?></p>
	</div>	
<?php
}

//Извиличане на данни
try {
	if($_SESSION['type'] == 0){
		$data = query("SELECT courses.id as id, courses.name, categories.title as cat, type, teachers.title, teachers.firstName, teachers.lastName, courses.credits, participate.completed, participate.mark FROM courses 
						JOIN participate on course_id = courses.id
						JOIN categories ON category = categories.id
						JOIN teachers ON teacher_id = teachers.id
		");
	} else {
		$data = query("SELECT courses.id as id, courses.name, categories.title as cat, type, courses.credits, EXTRACT(HOUR from hour) as hours, EXTRACT(MINUTE from hour) as minutes, auditorium, day FROM courses
						JOIN categories ON category = categories.id
						WHERE teacher_id = ".$_SESSION['id']."
		");
	}
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
	if($_SESSION['type'] == 0){
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
	} else {
		$theaders = array (
			"Предмет" => 20,
			"категория" => 20,
			"тип" => 10,
			"кредити" => 10,
			"час" => 10,
			"зала" => 10,
			"ден" => 10, 
			"операция" => 10
		);		
	}
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