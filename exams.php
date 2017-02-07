<?php
require_once('functions.php');
logged_in();
?>
<table class="tg">
	<colgroup>
		<col style="width: 8%">
		<col style="width: 15%">
		<col style="width: 15%">
		<col style="width: 5%">
		<col style="width: 10%">
		<col style="width: 8%">
		<col style="width: 18%">
		<col style="width: 5%">
	</colgroup>
	  <tr>
		<th class="tg-3we0">ФАКУЛТЕТ</th>
		<th class="tg-3we0">ПРЕДМЕТ</th>
		<th class="tg-3we0">СПЕЦИАЛНОСТ</th>
		<th class="tg-3we0">ЗАЛА</th>
		<th class="tg-3we0">ДАТА</th>
		<th class="tg-3we0">ЧАС</th>
		<th class="tg-3we0">ПРЕПОДАВАТЕЛ</th>
		<th class="tg-3we0">КРЕДИТИ</th>
	  </tr>
<?php 
$iter = 0;
$class = ["tg-dfop", "tg-mvlx"];
if($_SESSION['type'] == 0) {
?>
	<?php 
	$query = "SELECT courses.name as subject, exams.faculty as faculty, exams.room, exams.date, EXTRACT(HOUR from exams.hour) as hours, EXTRACT(MINUTE from exams.hour) as minutes, title, teachers.firstName as fname, teachers.lastName as lname, programs.name as program, courses.credits FROM exams 
														  JOIN teachers on exams.teacher_id = teachers.id
														  JOIN courses on exams.course_id = courses.id
														  JOIN participate on exams.course_id = participate.course_id
														  JOIN programs on programs.id = exams.program_id
														  WHERE completed = 0 AND exams.program_id = ".$_SESSION['program'] . " AND student_id = " . $_SESSION['id'];
	if(!$result = $link->query($query)){
		echo "<div class=\"alert alert-info fade in\"> Няма налични изпити </div>";
		echo "</table>";
		exit();
	}
	while($row = $result->fetch_assoc()){
	?>
	  <tr>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['faculty']; ?></td>
		<td class="<?php echo $class[$iter]; ?>" style="text-align: left"><?php echo $row['subject']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['program'];  ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['room'];    ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['date'];    ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['hours'].":".($row['minutes'] == 0 ? "00": $row['minutes']);?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['title']." ".$row['fname']. " ".$row['lname']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['credits']; ?> <img src="images/icons/medal.png" /></td>
	  </tr>
	<?php 
	$iter = $iter == 1? 0 : 1 ;
	} 
	?> 

<?php
 } else {
	 $query = "SELECT courses.name as subject, exams.faculty, exams.room, exams.date, EXTRACT(HOUR from exams.hour) as hours, EXTRACT(MINUTE from exams.hour) as minutes, title, firstName, lastName, programs.name as program, courses.credits FROM exams
																										JOIN teachers on exams.teacher_id = teachers.id
																										JOIN courses on exams.course_id = courses.id
																										JOIN programs on programs.id = exams.program_id
																										WHERE exams.teacher_id = ". $_SESSION['id'];
	$result = $link->query($query);
	if(!$result = $link->query($query)){
		echo "<div class=\"alert alert-info fade in\"> Няма налични изпити </div>";
		echo "</table>";
		exit();
	}
	while($row = $result->fetch_assoc()) {
?>
	  <tr>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['faculty']; ?></td>
		<td class="<?php echo $class[$iter]; ?>" style="text-align: left"><?php echo $row['subject']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['program'];  ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['room'];    ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['date'];    ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['hours'].":".($row['minutes'] == 0 ? "00": $row['minutes']);?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['title']." ".$row['firstName']. " ".$row['lastName']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['credits']; ?> <img src="images/icons/medal.png" /></td>
	  </tr>
<?php
	$iter = $iter == 1? 0 : 1 ;
	}
 }
 ?>
 </table>