<?php
require_once('functions.php');
verify(".", $_SESSION['type'] > 0);

//Проверка за операция
if(isset($_POST['op'])){
	switch($_POST['op']){
		case 'edit':
		include('modules\student_edit.php');
		break;
		
		case 'filter':
		$cond = "course_id = ".$_POST['id'];
		break;
	}
}

//Изкарване на съобщения, ако има такива
if(isset($error)){ ?>
    <div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-hand-right"></span> <strong>Операцията е успешна:</strong>
        <hr class="message-inner-separator">
        <p><?php echo $error; ?></p>
    </div>
<?php	
}elseif(isset($success)){?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<span class="glyphicon glyphicon-ok"></span> <strong>Операцията е успешна:</strong>
		<hr class="message-inner-separator">
		<p><?php echo $success; ?></p>
    </div>
<?php
}

try {
	$query ="
		SELECT courses.id as course, courses.name, students.firstName, students.lastName, programs.name as program, students.group, students.fnumber, participate.mark, participate.course_id FROM participate 
		JOIN courses on course_id = courses.id
		JOIN teachers on courses.teacher_id = teachers.id
		JOIN students on student_id = students.fnumber
		JOIN programs on students.program_id = programs.id
		WHERE teachers.id = ".$_SESSION['id']."
	";
	$data = isset($cond) ? query($query, $cond) : query($query);
} catch(Exception $e) { ?>
	<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
				<hr class="message-inner-separator">
				<p><?php echo $e->getMessage(); header("Refresh:5; url=index.php"); exit(); ?></p>
	</div>
<?php
}

//Търсачка
?>
<div id="dropdown-container">
    <div id="dropdown">--- ИЗБЕРИ ПРЕДМЕТ ---
        <span class="down-arrow-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
    </div>
    <ul id="dropdown-list">
		<?php
			$courses = fetch_table_rows("courses", "teacher_id=".$_SESSION['id']);
			while($row = $courses->fetch_assoc()){
				echo "<form method=\"post\" action=\"index.php?p=students\">";
				echo "<input type=\"hidden\" name=\"id\" value=\"".$row['id']."\">";
				echo "<input type=\"hidden\" name=\"op\" value=\"filter\">";
				echo "<li><input type=\"submit\" value=\"".$row['name']."\"></li>";
				echo "</form>";
			}
		?>
    </ul>
</div>
<?php

//Построяваме таблицата
$theaders = array (
				"Предмет" => 15,
				"Име на студент" => 30,
				"факултетен номер" => 10,
				"Специалност" => 10,
				"Оценка" => 5,
				"операции" => 30
		);
echo "<table>";
build_table_header($theaders);
$iter = 0;
$class = ["tg-dfop", "tg-mvlx"];
while($row = $data->fetch_assoc()){		
?>

	<tr>
		<form method="post" action="index.php?p=students">
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['name']; ?></td>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['firstName'] . " " . $row['lastName'];  ?></td>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['fnumber']; ?></td>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['program']; ?></td>
			<td class="<?php echo $class[$iter]; ?>"><input type="text" name="mark" value="<?php echo $row['mark']; ?>" min="2.00" max="6.00" pattern="[0-9]{1}([.][0-9]{0,2})?" required></td>
			<input type="hidden" name="op" value="edit">
			<input type="hidden" name="student_id" value="<?php echo $row['fnumber']; ?>">
			<input type="hidden" name="course_id" value="<?php echo $row['course']; ?>">
			<td class="<?php echo $class[$iter]; ?>"><button type="submit" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span> Запиши</button></td>
		</form>
	</tr>
<?php
	$iter = $iter == 1? 0 : 1 ;
}
?>
</table>