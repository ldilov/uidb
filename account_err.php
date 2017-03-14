<!DOCTYPE HTML>
<?php
	if(isset($error)){
?>
		<div class="alert alert-danger">
		  <strong>Грешка:</strong> <span style="color:black"><?php echo $error; ?></span>
		</div>
<?php
	} elseif(isset($success)) {
?>
		<div class="alert alert-success">
		  <strong>Успех!</strong> <span style="color:black"><?php echo $success; ?></span>
		</div>
<?php
	}
	
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>УБИ - Университетска информационна база</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
</head>

<body>
<div class="container">
  <div class="header"> <img class="logo" src="<?php echo $university_logo; ?>" /> </div>
  <?php echo "<h1>" . $university_name . "</h1>"; ?>
  <div class="form">   
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Регистрация</a></li>
        <li class="tab active"><a href="#login">Вход</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Регистрация</h1>
          <form action="/register.php" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Име<span class="req">*</span>
              </label>
              <input readonly onfocus="this.removeAttribute('readonly');" name="firstname" type="text" required autocomplete="off" />
            </div>
        
            <div class="field-wrap" id="hideName">
              <label>
                Презиме<span class="req">*</span>
              </label>
              <input readonly onfocus="this.removeAttribute('readonly');" name="middlename" type="text"required autocomplete="off"/>
            </div>
          </div>
		  
           <div class="field-wrap">
              <label>
                Фамилия<span class="req">*</span>
              </label>
              <input readonly onfocus="this.removeAttribute('readonly');" name="lastname" type="text"required autocomplete="off"/>
           </div>
		   
           <div class="field-wrap inv" id="target">
              <label>
                Титла<span class="req">*</span>
              </label>
              <input readonly onfocus="this.removeAttribute('readonly');" name="title" type="text"required autocomplete="off"/>
           </div>	
		   
          <div class="field-wrap">
            <label>
              Електронна поща<span class="req">*</span>
            </label>
            <input readonly onfocus="this.removeAttribute('readonly');" name="email" type="email"required autocomplete="off"/>
          </div>
          
		  <div class="field-wrap" id="hideSkype">
            <label>
              Скайп
            </label>
            <input readonly onfocus="this.removeAttribute('readonly');" name="skype" type="text"/>
          </div>
		  
		  <div class="field-wrap" id="hideSchool">
            <label>
              Предишно учебно заведение
            </label>
            <input readonly onfocus="this.removeAttribute('readonly');" name="school" type="text"/>
          </div>
		  <div class="field-wrap">
            <label>
              Град<span class="req">*</span>
            </label>
            <input readonly onfocus="this.removeAttribute('readonly');" name="city" type="text" required/>
          </div>
		  <div class="field-wrap">
            <label>
              Телефон<span class="req">*</span>
            </label>
            <input readonly onfocus="this.removeAttribute('readonly');" name="phone" type="text" required/>
          </div>
          <div class="field-wrap">
            <label>
              Парола<span class="req">*</span>
            </label>
            <input name="password" type="password"required autocomplete="off"/>
          </div>
          <div class="field-wrap" id="hideProgram">
			  <select name="program">
			     <?php
				 $link->set_charset('utf8');
				 $query = "SELECT id, name FROM programs";
				 if ($result = $link->query($query)) {
					while ($row = $result->fetch_row()) {
						echo "<option value=\"$row[0]\"> $row[1] </option>";
					}
					$result->close();
				}
			    ?>
			</select>
          </div>  
		  <div class="field-wrap">
			  <select name="type" onchange="showDiv(this)">
			  <option value="0"> Студент </option>
			  <option value="1"> Преподавател</option>
			  </select>
		  </div>
          <button type="submit" class="button button-block" name="submit"/>Регистрирай ме</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Добре дошли!</h1>
          
          <form action="/login.php" method="post">
          
            <div class="field-wrap">
            <label>
              Ел. Поща<span class="req">*</span>
            </label>
            <input readonly onfocus="this.removeAttribute('readonly');" name="email" type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Парола<span class="req">*</span>
            </label>
            <input readonly onfocus="this.removeAttribute('readonly');" name="password" type="password"required autocomplete="off"/>
          </div>
          <div class="field-wrap">
			  <select name="type">
			  <option value="0"> Студент </option>
			  <option value="1"> Преподавател</option>
			  </select>
		  </div>
          <button type="submit" class="button button-block"/>Вход</button>
          
          </form>

        </div>
        
      </div>
      
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</div>
<footer>
<div style="margin-top: 25px;">
	<div style="text-align: center;">
        <p>Система УИБ - Лазар Дилов <br>Графичен дизайн - Виржиния Вълчева <br> Всички права са запазени ©<?php echo date("Y"); ?> </p>
	</div>
</div>
 </footer>
</body>
</html>
