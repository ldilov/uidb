<?php
require_once('functions.php');
verify();

if(isset($_SESSION['c_id'])){
	switch($_SESSION['op']){
		case 'add':
		require_once "modules\courses_add.php";
		break;

		case 'edit':
		require_once "modules\courses_edit.php";
		break;
		
		case 'filter':
			$cond = "category = ".$_SESSION['c_id'];
			$op = "AND";
			unset($_SESSION['op']);
			unset($_SESSION['c_id']);
		break;		
	}
}

if(isset($error)){ ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button>
             <span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
            <hr class="message-inner-separator">
            <p><?php echo $error; ?></p>
        </div>
<?php
} elseif (isset($success) && !empty($success)){ ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <span class="glyphicon glyphicon-ok"></span> <strong>Операцията е успешна:</strong>
            <hr class="message-inner-separator">
            <p><?php echo $success; ?></p>
        </div>
<?php	
}elseif (isset($warning)){ ?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <span class="glyphicon glyphicon-record"></span> <strong>Внимание:</strong>
            <hr class="message-inner-separator">
            <p><?php echo $warning;?></p>
        </div>
<?php	
}
?>

<div id="dropdown-container">
    <div id="dropdown">--- ИЗБЕРИ КАТЕГОРИЯ ---
        <span class="down-arrow-icon"><i class="fa fa-caret-down" aria-hidden="true"></i><span>
    </div>
    <ul id="dropdown-list">
		<?php
			$data = fetch_table_rows("categories");
			while($row = $data->fetch_assoc()){
				echo "<form method=\"post\" action=\"index.php?p=courses\">";
				echo "<input type=\"hidden\" name=\"id\" value=\"".$row['id']."\">";
				echo "<input type=\"hidden\" name=\"name\" value=\"".$row['title']."\">";
				echo "<input type=\"hidden\" name=\"op\" value=\"filter\">";
				echo "<li><input type=\"submit\" value=\"".$row['title']."\"></li>";
				echo "</form>";
			}
		?>
    </ul>
</div>

	<?php 
		$theaders = array (
				"предмет" => 10,
				"категория" => 11,
				"специалност" => 15,
				"зала" => 5,
				"ден" => 10,
				"час" =>  8,
				"преподавател" => 10,
				"кредити" => 5,
				"операции" => 10
		);
		build_table_header($theaders);
		$iter = 0;
		$class = ["tg-dfop", "tg-mvlx"];
		if($_SESSION['type'] == 0) {
			$query = "SELECT courses.id, courses.name, courses.description, firstName, lastName, teachers.title as title, credits, EXTRACT(HOUR from hour) as hours, EXTRACT(MINUTE from hour) as minutes, day, auditorium, categories.title as category, programs. name as program
							  FROM courses
							  JOIN teachers ON teacher_id = teachers.id
							  JOIN programs ON program_id = programs.id
							  JOIN categories ON category = categories.id
							  WHERE type > 0 AND courses.program_id =".$_SESSION['program_id']." AND courses.id NOT IN (SELECT course_id FROM participate WHERE student_id =".$_SESSION['id'].")";
			try {
				$data = isset($cond, $op) ? query($query, $cond, $op) : query($query);
			} catch (Exception $e) {
	?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					 ×
				</button>
				<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
				<hr class="message-inner-separator">
				<p><?php echo $e->getMessage(); ?></p>
			</div>
	<?php } 
			if($data->num_rows === 0){
				echo "<div class=\"alert alert-info fade in\"> Няма налични курсове. </div>";
				echo "</table>";
			}
			$index = 0;
			while($row = $data->fetch_assoc()){
				include('/modules/courses_data.php');
				$iter = $iter == 1? 0 : 1 ;
				$index++;
			}
		} else {
			$query = "SELECT courses.id, courses.name, courses.description, firstName, lastName, teachers.title as title, credits, EXTRACT(HOUR from hour) as hours, EXTRACT(MINUTE from hour) as minutes, day, auditorium, categories.title as category, programs. name as program
							  FROM courses
							  JOIN teachers ON teacher_id = teachers.id
							  JOIN programs ON program_id = programs.id
							  JOIN categories ON category = categories.id
							  WHERE courses.teacher_id =".$_SESSION['id'];
			try {
				$data = isset($cond, $op) ? query($query, $cond, $op) : query($query);
			} catch (Exception $e) {
	?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					 ×
				</button>
				<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
				<hr class="message-inner-separator">
				<p><?php echo $e->getMessage(); header("Refresh:5; url=index.php"); exit(); ?></p>
			</div>
	<?php } 
			if($data->num_rows === 0){
				echo "<div class=\"alert alert-info fade in\"> Няма налични курсове. </div>";
				echo "</table>";
			}
			$index = 0;
			while($row = $data->fetch_assoc()){ 
				include('/modules/courses_data.php');
				$iter = $iter == 1? 0 : 1 ;
				$index++;
			}
		}
	?>
</table>	