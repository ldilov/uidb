<?php 
require_once('functions.php');
logged_in();

echo "<script src=\"js/upload.js\"></script>";

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
			<?php foreach($success as $msg) { ?>
             <p><?php echo $msg; ?></p>
			<?php } ?>
        </div>
<?php	
}
?>
<div class="container">
  <div class="row">
    <form method="post" action="profile_update.php" enctype="multipart/form-data">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
		<?php
			$row = fetch_user_info($_SESSION['id'], $_SESSION['type']);
		?>
        <img src="<?php echo $row['avatar']; ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="height:300px; width:300px">
        <h6>Качи снимка</h6>
		<h6><span style="color:red">Препоръчителен размер: 300x300</span></h6>
	    <div class="input-group">
			<span class="input-group-btn">
				<span class="btn btn-default btn-file">
					Качи<input type="file" name="avatar" class="text-center center-block well well-sm">
				</span>
			</span>
            <input type="text" class="form-control" readonly>
        </div>
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
        <div class="form-group">
          <label class="col-lg-3 control-label">Име:</label>
          <div class="col-lg-8">
            <p> <?php echo $row['firstName']; ?> </p>
          </div>
        </div>
		<?php if($_SESSION['type'] == 0){ ?>
		<div class="form-group">
          <label class="col-lg-3 control-label">Презиме:</label>
          <div class="col-lg-8">
            <p> <?php echo $row['middleName']; ?> </p>
          </div>
        </div>
		<?php } ?>
        <div class="form-group">
          <label class="col-lg-3 control-label">Фамилия:</label>
          <div class="col-lg-8">
            <p> <?php echo $row['lastName']; ?> </p>
          </div>
        </div>
		<?php if($_SESSION['type'] == 0) { ?>
        <div class="form-group">
          <label class="col-lg-3 control-label">Факултетен номер:</label>
          <div class="col-lg-8">
            <p> <?php echo $row['fnumber']; ?> </p>
          </div>
        </div>
		<div class="form-group">
          <label class="col-lg-3 control-label">Кредити:</label>
          <div class="col-lg-8">
		  	<?php 
				$query = "SELECT credits FROM courses JOIN participate on courses.id = participate.course_id WHERE student_id = ".$_SESSION['id']. "and completed > 0";
				$credits = 0;
				if($result = $link->query($query)){
					while($row = $result->fetch_assoc()){
						$credits += $row['credits'];
					}
				}
			?> 
            <p> <?php echo $credits; ?> <img src="images/icons/medal.png" /></p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Степен:</label>
          <div class="col-lg-8">
            <p> <?php echo $row['degree']; ?> </p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Скайп:</label>
          <div class="col-md-8">
            <input class="form-control" name="skype"value="<?php echo $row['skype']; ?>" type="text">
          </div>
        </div>
		<?php } ?>
        <div class="form-group">
          <label class="col-lg-3 control-label">Град:</label>
          <div class="col-lg-8">
			<input class="form-control" name="city" value="<?php echo $row['city']; ?>" type="text" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Телефон:</label>
          <div class="col-md-8">
            <input class="form-control" name="phone" value="<?php echo $row['phone']; ?>" type="text" required>
          </div>
        </div>
		<br><br>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <button type="submit" class="btn btn-success">Запази</button>
            <span></span>
            <button type="reset" class="btn btn-info">Отказ</button>
          </div>
        </div>
    </div>
	</form>
  </div>
</div>