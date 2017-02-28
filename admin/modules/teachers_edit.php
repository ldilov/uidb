<?php
	require_once(__DIR__."/../../functions.php");
	verify_admin("..");
	if(isset($_POST['edit']) && $_POST['edit'] == "true"){
		require_once("teachers_edit_process.php");
	}
	if(isset($error)) {
		echo "
				<div class=\"alert alert-danger\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					?</button>
					 <span class=\"glyphicon glyphicon-hand-right\"></span> <strong>Възникна грешка:</strong>
					<hr class=\"message-inner-separator\">
					<p>$error</p>
				</div>
			";
	} else if(isset($success)){
		echo "
				<div class=\"alert alert-success\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
						?</button>
					<span class=\"glyphicon glyphicon-ok\"></span> <strong>Операцията е успешна:</strong>
					<hr class=\"message-inner-separator\">
					<p>$success</p>
				</div>
			";
	}
	$teacher = fetch_user_info($_POST['id'], 1);
?>
<div class="col-md-10 ">
<form action="index.php?p=teachers" method="POST" class="form-horizontal">
<fieldset>
<legend>Данни за <?php echo $teacher['title']." ".$teacher['firstName']." ".$teacher['lastName']; ?></legend>
<div class="form-group">
  <label class="col-md-4 control-label" for="Name (Full name)">Име</label>  
  <div class="col-md-4">
 <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
       <input id="name" type="text" placeholder="<?php echo $teacher['title']." ".$teacher['firstName']." ".$teacher['lastName']; ?>" class="form-control input-md" readonly>
      </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Skills">Парола</label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-lock"></i>  
    </div>
       <input id="password" name="password" type="password" placeholder="Парола за вход в системата" class="form-control input-md">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Skills">Титла</label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-graduation-cap"></i>  
    </div>
       <input id="Skills" name="title" type="text" placeholder="Титла на преподавателя" class="form-control input-md" value="<?php echo $teacher['title']; ?>">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Phone number ">Телефон </label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-phone"></i>   
    </div>
		<input id="phone " name="phone" type="text" placeholder="Телефенен номер за връзка " class="form-control input-md" value="<?php echo $teacher['phone']; ?>">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Email Address">Електронна поща</label>  
  <div class="col-md-4">
  <div class="input-group">
  <div class="input-group-addon">
    <i class="fa fa-envelope-o"></i>  
    </div>
		<input id="email" name="email" type="text" placeholder="Електронна поща на преподавателят" class="form-control input-md" value="<?php echo $teacher['email']; ?>">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Описание (макс. 1500 символа)</label>
  <div class="col-md-4">                     
	<script type="text/javascript" src="../../plugins/ckeditor/ckeditor.js"></script>
    <textarea name="description" style="width: 100%;" maxlength="1500" spellcheck="true" lang="bg" id="editor"><?php echo $teacher['description']; ?></textarea>
	<script type="text/javascript"> CKEDITOR.replace( 'editor' );</script>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" ></label>  
  <div class="col-md-4">
  <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
  <input type="hidden" name="op" value="edit">
  <input type="hidden" name="edit" value="true">
  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Запази</a>
  <button type="reset" class="btn btn-danger" value=""><span class="glyphicon glyphicon-remove-sign"></span> Изчисти</a>
  </div>
</div>

</fieldset>
</form>
</div>
<div class="col-md-2 hidden-xs">
	<img src="<?php echo "../".$teacher['avatar']; ?>" class="img-responsive img-thumbnail ">
</div>