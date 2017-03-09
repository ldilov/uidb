<?php
require_once(__DIR__."/../functions.php");
verify_admin("..");

if(isset($_GET['op'])){
	switch($_GET['op']){
		case "sign":
			include("modules\get_courses.php");
			break;	
		case "getuser":
			include("modules\get_student_courses.php");
			break;
		case "add":
			include("modules\add_student_courses.php");
			break;
		case "remove":
			include("modules\\remove_student_courses.php");
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
<?php } ?>

<form method="POST" action="?p=participate&op=getuser">
	<div id="dropdown-container">
		<div id="searchbox">
			<input type="search" name="fn" placeholder="Факултетен номер" pattern="[0-9]{1,10}" required>
			<input type="submit" value="" id="search">
		</div>
	</div>
</form>

<form method="POST" action="?p=participate&op=sign">
	<div id="dropdown-container">
		<div id="searchbox">
			<button class="button" id="showMenu" <?php echo isset($fnumber) && !isset($_POST['op']) ? "" : "disabled"?>>ДОБАВИ ПРЕДМЕТ <i class="fa fa-plus-square" aria-hidden="true"></i></button>
			<input type="hidden" value="<?php echo $fnumber; ?>" name="fn">
			<input type="hidden" value="<?php echo 'sign'; ?>" name="op">
		</div>
	</div>
</form>

<?php
	if(isset($result)){
		$theader = array (
			"предмет" => 25,
			"кредити" => 5,
			"лимит" => 10,
			"тип" => 25,
			"преподавател" => 25,
			"операция" => 10 );
			
		build_table_header($theader);
		$iter = 0;
		$class = ["tg-dfop", "tg-mvlx"];
		$index = 0;
		while($row = $result->fetch_assoc()){
			include('modules/courses_data.php');
			$iter = $iter == 1? 0 : 1 ;
			$index++;
		} 

		echo "</table>";
		echo "<div class=\"pagination\">";
		for($i = 0; $i < $pages; $i++){
			if((!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] = 1)) && $i == 0){
				echo "<a href=\"index.php?p=participate&page=".($i + 1)."\" class=\"active\">".($i + 1)."</a>";
			} else {
				echo "<a href=\"index.php?p=particapte&page=".($i + 1)."\">".($i + 1)."</a>";
			}
		}
		echo "</div>";
	}
?>