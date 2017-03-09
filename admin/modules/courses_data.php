<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");
if(isset($_GET['p'])){
	if($_GET['p'] == "courses"){
?>
		<tr>
		<form method="post" action="index.php?p=courses" style="display:inline;">
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
		<?php 
			echo "<input type=\"hidden\" name=\"op\" value=\"edit\">";
			echo "<input type=\"hidden\" name=\"id\" value=\"".$row['id']."\">";
			echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-edit\"></span> Редакция</button></td>";
		?>
		</form>
		</tr>
<?php
	} elseif ($_GET['p'] == "participate"){
		?>
		<tr>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['name']; ?></td>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['credits']; ?> <img src="../images/icons/medal.png" /></td>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['limit']; ?></td>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['type'] == 0 ? "Задължителна" : "Избираема";?></td>
			<td class="<?php echo $class[$iter]; ?>"><?php echo $row['title']." ".$row['firstName']. " ".$row['lastName']; ?></td>
			
			<?php 
			if (isset($_POST['fn']) && isset($_POST['op']) && $_POST['op'] == 'sign') {
				echo "<form method=\"POST\" action=\"?p=participate&op=add\">";
				echo "<input type=\"hidden\" name=\"id\" value=\"".$row['id']. "\">";
				echo "<input type=\"hidden\" name=\"fn\" value=\"".$_POST['fn']. "\">";		
				echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-edit\"></span> Запиши</button></td>";	
				echo "</form>";
			} else{
				echo "<form method=\"POST\" action=\"?p=participate&op=remove\">";
				echo "<input type=\"hidden\" name=\"id\" value=\"".$row['id']. "\">";
				echo "<input type=\"hidden\" name=\"fn\" value=\"".$_POST['fn']. "\">";	
				if(getCourseType($row['id']) == 0){
					echo "<td class=". $class[$iter] ."><span class=\"glyphicon glyphicon-minus\"></span> </td>";
				} else {
					echo "<td class=". $class[$iter] ."><button type=\"submit\" class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-edit\"></span> Отпиши</button></td>";	
				}
				echo "</form>";				
			}
			?>
		</tr>
		<?php
	}
}
?>