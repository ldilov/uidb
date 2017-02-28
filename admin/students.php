<?php
require_once(__DIR__."/../functions.php");
verify_admin("..");

if(isset($_POST['op'])){
	switch($_POST['op']){
		case 'activate':
		require_once "/modules/students_activate.php";
		break;
		
		case 'deactivate':
		require_once "/modules/students_deactivate.php";
		break;
		
		case 'edit':	
		require_once "/modules/students_edit.php";
		return;
		break;
		
		case 'filter':
		$cond = "program_id=".$_POST['p_id'];
		$op = "AND";
		break;		
	}
}

if(isset($error)){ ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ?</button>
             <span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
            <hr class="message-inner-separator">
            <p><?php echo $error; ?></p>
        </div>
<?php
} elseif (isset($success) && !empty($success)){ ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ?</button>
            <span class="glyphicon glyphicon-ok"></span> <strong>Операцията е успешна:</strong>
            <hr class="message-inner-separator">
            <p><?php echo $success; ?></p>
        </div>
<?php	
}elseif (isset($warning)){ ?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ?</button>
            <span class="glyphicon glyphicon-record"></span> <strong>Внимание:</strong>
            <hr class="message-inner-separator">
            <p><?php echo $warning;?></p>
        </div>
<?php	
}
?>

<div id="dropdown-container">
    <div id="dropdown">--- ИЗБЕРИ СПЕЦИАЛНОСТ ---
        <span class="down-arrow-icon"><i class="fa fa-caret-down" aria-hidden="true"></i><span>
    </div>
    <ul id="dropdown-list">
		<?php
			$data = fetch_table_rows("programs");
			while($row = $data->fetch_assoc()){
				echo "<form method=\"post\" action=\"index.php?p=students\">";
				echo "<input type=\"hidden\" name=\"p_id\" value=\"".$row['id']."\">";
				echo "<input type=\"hidden\" name=\"name\" value=\"".$row['name']."\">";
				echo "<input type=\"hidden\" name=\"op\" value=\"filter\">";
				echo "<li><input type=\"submit\" value=\"".$row['name']."\"></li>";
				echo "</form>";
			}
		?>
    </ul>
</div>

<?php 
	$theaders = array (
		"име" => 10,
		"презиме" => 10,
		"фамилия" => 10,
		"фак. номер" => 10,
		"група" => 5,
		"кредити" => 10,
		"степен" => 10,
		"студент от" => 10,
		"статут" => 10,
		"операции" => 20
	);

	build_table_header($theaders);
	$iter = 0;
	$class = ["tg-dfop", "tg-mvlx"];
	$query = "SELECT firstName, middleName, lastName, fnumber, students.group, degree, join_date, status FROM students WHERE fnumber > 0";
	try {
		if(isset($cond, $op)){
			$result = query($query, $cond, $op);
			$data = isset($_GET['page']) ? query($query, $cond, $op, (($_GET['page']-1)*$itemsPerPage).", "."$itemsPerPage") : query($query, $cond, $op, $itemsPerPage);
		} else {
			$result = query($query);
			$cond = "true";
			$op = "AND";
			$data = isset($_GET['page']) ? query($query, $cond, $op, (($_GET['page']-1)*$itemsPerPage).", "."$itemsPerPage") : query($query, $cond, $op, $itemsPerPage);
		}
		$pages = getPages($result);
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
		echo "<div class=\"alert alert-info fade in\"> Няма налични студенти. </div>";
		echo "</table>";
	}
	$index = 0;
	while($row = $data->fetch_assoc()){
		$row['credits'] = getCredits($row['fnumber']);
		include('modules/members_data.php');
		$iter = $iter == 1? 0 : 1 ;
		$index++;
	}
?>
</table>

<?php
echo "<div class=\"pagination\">";
for($i = 0; $i < $pages; $i++){
	if((!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] = 1)) && $i == 0){
		echo "<a href=\"index.php?p=students&page=".($i + 1)."\" class=\"active\">".($i + 1)."</a>";
	} else {
		echo "<a href=\"index.php?p=students&page=".($i + 1)."\">".($i + 1)."</a>";
	}
}
echo "</div>";
?>
<br>	