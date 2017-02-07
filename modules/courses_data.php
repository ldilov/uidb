<?php
require_once(__DIR__."/../functions.php");
logged_in("..");
if(isset($_GET['p'])){
	if($_GET['p'] == "courses"){
?>
		<tr>
		<form method="post" action="/index.php?p=courses">
		<td class="<?php echo $class[$iter]; ?>">
			<a href="javascript: void(0);" id="info<?php echo $index; ?>">
				<?php echo $row['name']; ?>
			</a>
			<script> 
				document.getElementById("info<?php echo $index; ?>").addEventListener ("click", function(){
					window.open("modules/course_info.php?id=<?php echo $row['id']; ?>", "Информация", "toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=no, titlebar=no, width=550, height=250");
				});
			</script>
		</td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['category']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['program'];  ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['auditorium']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['day'];    ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['hours'].":".($row['minutes'] == 0 ? "00" : $row['minutes']); ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['title']." ".$row['firstName']. " ".$row['lastName']; ?></td>
		<td class="<?php echo $class[$iter]; ?>"><?php echo $row['credits']; ?> <img src="../images/icons/medal.png" /></td>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
		<?php 
		if($_SESSION['type'] == 0){
			echo "<input type=\"hidden\" name=\"op\" value=\"add\">";
			echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-edit\"></span> Запиши ме</button></td>";
		} else {
			echo "<input type=\"hidden\" name=\"op\" value=\"edit\">";
			echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-edit\"></span> Редактирай</button></td>";
		}
		?>
		</tr>
<?php
	}
}
?>