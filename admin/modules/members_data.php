<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");

if(isset($_GET['p'])){
	if($_GET['p'] == "students"){
?>
		<tr>
		<form method="post" action="index.php?p=students" style='display:inline;'>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['firstName']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['middleName']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['lastName'];  ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['fnumber']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['group'];    ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['credits']; ?> <img src="../images/icons/medal.png" /></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['degree']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['join_date']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['status'] == 0 ? "Активен" : "<span style=\"color:red \">Неактивен</span>"; ?></td>
		<input type="hidden" name="id" value="<?php echo $row['fnumber']; ?>">
		<?php 
		if($row['status'] == 0){
			echo "<input type=\"hidden\" name=\"op\" value=\"deactivate\">";
			echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span style=\"color:black\" class=\"glyphicon glyphicon-minus\"></span> Прекрати</button>";
		} else {
			echo "<input type=\"hidden\" name=\"op\" value=\"activate\">";
			echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span style=\"color:black\" class=\"glyphicon glyphicon-ok\"></span> Поднови</button>";
		}
		echo "<input type=\"hidden\" name=\"student_id\" value=\"".$row['fnumber']."\">";
		echo "</form>";
		echo "<form method=\"post\" action=\"index.php?p=students\" style='display:inline;'>";
		echo "<input type=\"hidden\" name=\"op\" value=\"edit\">";
		echo "<input type=\"hidden\" name=\"fnumber\" value=\"".$row['fnumber']."\">";
		echo "<button type=\"submit\" class=\"btn btn-xs btn-default\"><span style=\"color:black\" class=\"glyphicon glyphicon-edit\"></span> Редакция</button></td>";
		echo "</form>";
		?>
		</form>
		</tr>
<?php
	} elseif($_GET['p'] == "teachers"){ ?>
		<tr>
		<form method="post" action="index.php?p=teachers" style='display:inline;'>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['title']." ".$row['firstName']. " ".$row['lastName'];; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['email']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['phone'];    ?></td>
		<td class="<?php echo $class[$iter]; ?>"><a href="<?php echo $row['facebook']; ?>" target="_blank"><i style="color:white;" class="fa fa-facebook" aria-hidden="true"></i></a></td>
		<td class="<?php echo $class[$iter]; ?>"><a href="<?php echo $row['twitter']; ?>" target="_blank"><i style="color:white;" class="fa fa-twitter" aria-hidden="true"></i></a></td>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
		<?php 
		echo "<input type=\"hidden\" name=\"op\" value=\"delete\">";
		echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span style=\"color:black\" class=\"glyphicon glyphicon-minus\"></span> Изтрий</button>";
		echo "<input type=\"hidden\" name=\"lecturer_id\" value=\"".$row['id']."\">";
		echo "</form>";
		echo "<form method=\"post\" action=\"index.php?p=teachers\" style='display:inline;'>";
		echo "<input type=\"hidden\" name=\"op\" value=\"edit\">";
		echo "<input type=\"hidden\" name=\"id\" value=\"".$row['id']."\">";
		echo "<button type=\"submit\" class=\"btn btn-xs btn-default\"><span style=\"color:black\" class=\"glyphicon glyphicon-edit\"></span> Редакция</button></td>";
		echo "</form>";
		?>
		</tr>	
	<?php
	}
}
?>