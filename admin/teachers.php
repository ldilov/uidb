<?php
require_once(__DIR__."/../functions.php");
verify_admin("..");

if(isset($_POST['op'])){
	switch($_POST['op']){
		case 'delete':
		require_once "/modules/teachers_delete.php";
		break;
		
		case 'edit':	
		require_once "/modules/teachers_edit.php";
		return;
		break;
		
		case 'filter':
		$cond = "department=".$_POST['d_id'];
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
    <div id="dropdown">--- ИЗБЕРИ КАТЕДРА ---
        <span class="down-arrow-icon"><i class="fa fa-caret-down" aria-hidden="true"></i><span>
    </div>

    <ul id="dropdown-list">
		<?php
			$data = fetch_table_rows("department");
			while($row = $data->fetch_assoc()){
				echo "<form method=\"post\" action=\"index.php?p=teachers\">";
				echo "<input type=\"hidden\" name=\"d_id\" value=\"".$row['id']."\">";
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
		"име" => 30,
		"ел. поща" => 20,
		"телефон" => 10,
		"Facebook" => 5,
		"Twitter" => 5,
		"операции" => 30
	);

	build_table_header($theaders);
	$iter = 0;
	$class = ["tg-dfop", "tg-mvlx"];
	$query = "SELECT id, firstName, title, lastName, email, phone, facebook, twitter FROM teachers WHERE id > 0";
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
			?
		</button>
		<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
		<hr class="message-inner-separator">
		<p><?php echo $e->getMessage(); ?></p>
	</div>
	<?php } 
	if($data->num_rows === 0){
		echo "<div class=\"alert alert-info fade in\"> Няма налични преподаватели. </div>";
		echo "</table>";
	}
	$index = 0;
	while($row = $data->fetch_assoc()){
		include('modules/members_data.php');
		$iter = $iter == 1? 0 : 1 ;
		$index++;
	}
	$tfooter = [
	"<a href=\"?p=teachers_add\"><div class=\"button\">ДОБАВИ ПРЕПОДАВАТЕЛ
		<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i>
	</div></a>
	"];
	build_table_footer($tfooter, 6);
?>
</table>

<?php
echo "<div class=\"pagination\">";
for($i = 0; $i < $pages; $i++){
	if((!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] = 1)) && $i == 0){
		echo "<a href=\"index.php?p=teachers&page=".($i + 1)."\" class=\"active\">".($i + 1)."</a>";
	} else {
		echo "<a href=\"index.php?p=teachers&page=".($i + 1)."\">".($i + 1)."</a>";
	}
}
echo "</div>";
?>
<br>	