<?php
require_once("functions.php");
verify(".", $_SESSION['type'] == 0);
$query = "SELECT courses.name, courses.type, courses.credits, teachers.title, teachers.firstName, teachers.lastName, participate.mark FROM participate 
		JOIN courses ON course_id = courses.id
		JOIN teachers ON courses.teacher_id = teachers.id
		WHERE participate.student_id = ". $_SESSION['id'] ." AND participate.completed > 0";

try {
	$data = query($query);
} catch (Exception $e){ ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">?</button>
		<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
		<hr class="message-inner-separator">
		<p><?php echo $e->getMessage(); header("Refresh:5; url=index.php"); exit(); ?></p>
	</div>
<?php	
}
$theaders = [
				"Име" => 25,
				"Тип" => 15,
				"Преподавател" => 30,
				"Кредити" => 20,
				"Оценка" => 10
			];
build_table_header($theaders);
$iter = 0;
$class = ["tg-dfop", "tg-mvlx"];
while($row = $data->fetch_assoc()){?>
	<tr>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['name']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['type'] == 0 ? "Задължителна" : "Избираема";  ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['title']." ".$row['firstName']. " ".$row['lastName']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['credits']; ?> <img src="../images/icons/medal.png" /></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['mark']; ?></td>
	</tr>
<?php
	$iter = $iter == 1? 0 : 1 ;
}
echo "</table>";
?> 