<?php
require_once(__DIR__."/../functions.php");
verify_admin("..");


if(isset($_POST['op'])){		
	switch($_POST['op']){
		case 'add':
		require_once "modules\courses_add.php";
		break;

		case 'edit':
		require_once "modules\courses_edit.php";
		break;
			
		case 'filter':
		$cond = "category = ".$_POST['id'];
		$op = "AND";
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

<link rel="stylesheet" type="text/css" href="../styles/admin/normalize.css" />
<link rel="stylesheet" type="text/css" href="../styles/admin/demo.css" />
<link rel="stylesheet" type="text/css" href="../styles/admin/component.css" /> 
<script src="../js/modernizr.custom.25376.js"></script>

<div id="perspective" class="perspective effect-rotatetop">
			<div class="container">
				<div class="wrapper">
					<div class="main clearfix">
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
					</div><!-- /main -->
				</div><!-- wrapper -->
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
		$query = "SELECT courses.id, courses.name, courses.description, firstName, lastName, teachers.title as title, credits, EXTRACT(HOUR from hour) as hours, EXTRACT(MINUTE from hour) as minutes, day, auditorium, categories.title as category, programs. name as program
				FROM courses
				JOIN teachers ON teacher_id = teachers.id
				JOIN programs ON program_id = programs.id
				JOIN categories ON category = categories.id
				";
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
			echo "<div class=\"alert alert-info fade in\"> Няма налични курсове. </div>";
			echo "</table></div>";
		}
		$index = 0;
		while($row = $data->fetch_assoc()){
			include('modules/courses_data.php');
			$iter = $iter == 1? 0 : 1 ;
			$index++;
		} 
		$tfooter = ["<button class=\"button\" id=\"showMenu\">ПОКАЖИ МЕНЮ <i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i></button>"];
		build_table_footer($tfooter, 9);
	?>
	</table>
	</div>
	<?php
		echo "<div class=\"pagination\">";
		for($i = 0; $i < $pages; $i++){
			if((!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] = 1)) && $i == 0){
				echo "<a href=\"index.php?p=coursess&page=".($i + 1)."\" class=\"active\">".($i + 1)."</a>";
			} else {
				echo "<a href=\"index.php?p=courses&page=".($i + 1)."\">".($i + 1)."</a>";
			}
		}
		echo "</div>";
	?>
	</div>
			<nav class="outer-nav bottom horizontal">
				<a href="#" class="icon-settings">Настройки</a>
				<a href="index.php?p=participate" class="icon-participate">Записване</a>
				<a href="#" class="icon-add">Добавяне курс</a>
				<a href="#" class="icon-add-free">Добавяне свободно-избираем крус</a>
			</nav>
		</div><!-- /perspective -->
		<script src="../js/classie.js"></script>
		<script src="../js/menu.js"></script>
</div>