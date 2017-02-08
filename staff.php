<?php
require_once('functions.php');
logged_in();

try {
	$data = query("SELECT title, firstName, lastName, email, avatar, phone, description, department.name, twitter, facebook FROM teachers JOIN department ON department = department.id");
} catch (Exception $e){
	?>
	<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<span class="glyphicon glyphicon-hand-right"></span> <strong>Възникна грешка:</strong>
	<hr class="message-inner-separator">
	<p><?php echo $e->getMessage(); ?></p>
	</div>
	<?php
	if($data->num_rows === 0){
		echo "<div class=\"alert alert-info fade in\"> Няма налични преподаватели. </div>";
	}
}
echo "<div class=\"container\">";
while($row = $data->fetch_assoc()){
?>
    <div class="col-md-4">
        <div class="profile-card text-center">

            <img class="img-responsive" src="images/header.jpg">
            <div class="profile-info">
              <img class="profile-pic" src="<?php echo $row['avatar']; ?>">
              <h2 class="hvr-underline-from-center"><?php echo $row['title']." ".$row['firstName']. " ".$row['lastName']; ?><span><?php echo $row['name']; ?></span></h2>
              <div><?php echo $row['description']; ?></div>
			  <div>Телефон: <?php echo $row['phone']; ?></div>
              <a href="<?php echo $row['twitter']; ?>"><i class="fa fa-twitter fa-2x"></i></a>
              <a href="mailto:<?php echo $row['email']; ?>"><i class="fa fa-envelope-o fa-2x"></i></a>
              <a href="<?php echo $row['phone']; ?>"><i class="fa fa-facebook fa-2x"></i></a>
            </div>
        </div>
    </div>
<?php
}
echo "</div>";
?>
  