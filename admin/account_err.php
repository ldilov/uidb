<html>
<head>
<title> Вход в администраторски панел </title>
	<link rel="stylesheet" type="text/css" href="../styles/admin/login.css">
	<link rel="stylesheet" type="text/css" href="../plugins/qtip/jquery.qtip.min.css">
	<link rel="stylesheet" type="text/css" href="../styles/animate.css">
	<script src='../js/jquery-3.1.1.js'></script>
	<script src='../plugins/qtip/jquery.qtip.min.js'></script>
	<script src="../js/index.js"></script>
</head>
<body>
<div id="login-header">
<p>Администраторски вход</p>
</div>
<div class="form">  
	<div id="login-container"> 
			<form action="login.php" method="post" id="loginForm">
			<div class="wrap">	
				<div class="sub-wrapper">
					<label>
					  Потребител<span class="req">*</span>
					</label>
					<input readonly onfocus="this.removeAttribute('readonly');" name="username" type="text" autocomplete="off" 
					pattern="[A-Za-z1-9]{3,15}" id="loginFormUser"  oninvalid="this.setCustomValidity('Невалидна стойност!')" oninput="setCustomValidity('')"/>	
				</div>
				<div class="sub-wrapper">
					<label>
					  Парола<span class="req">*</span>
					</label>
					<input readonly onfocus="this.removeAttribute('readonly');" name="password" type="password" autocomplete="off" 
					oninvalid="this.setCustomValidity('Невалидна стойност!')" oninput="setCustomValidity('')" pattern="[A-Za-z1-9]{3,254}"/>
				</div>
			</div>
				<input type="hidden" name="type" value="admin">
				<button type="submit" class="button button-block" />Вход</button> 
			</form>
			<div id="bar">
			
			</div>
	</div>
</div>
	<script>
		$('.form').find('input').on('click keyup blur focus', function (e) {
	  
		var $this = $(this),
		  label = $this.prev('label');
		  if (e.type == 'click'){
			  label.addClass('active highlight');
		  }
		  if (e.type === 'keyup') {
				if ($this.val() === '') {
			  label.removeClass('active highlight');
			} else {
			  label.addClass('active highlight');
			}
		} else if (e.type === 'blur') {
			if( $this.val() === '' ) {
				label.removeClass('active highlight'); 
				} else {
				label.removeClass('highlight');   
				}   
		} else if (e.type === 'focus') {
		  
		  if( $this.val() === '' ) {
				label.removeClass('highlight'); 
				} 
		  else if( $this.val() !== '' ) {
				label.addClass('highlight');
				}
		}

		});
		
		$('.form').find('label').on('click keyup blur focus', function (e) {
	  
		var $this = $(this),
		  label = $this;
		  if (e.type == 'click'){
			  label.addClass('active highlight');
		  }
		  if (e.type === 'keyup') {
				if ($this.val() === '') {
			  label.removeClass('active highlight');
			} else {
			  label.addClass('active highlight');
			}
		} else if (e.type === 'blur') {
			if( $this.val() === '' ) {
				label.removeClass('active highlight'); 
				} else {
				label.removeClass('highlight');   
				}   
		} else if (e.type === 'focus') {
		  
		  if( $this.val() === '' ) {
				label.removeClass('highlight'); 
				} 
		  else if( $this.val() !== '' ) {
				label.addClass('highlight');
				}
		}

		});
		
		var input = document.getElementById('loginFormUser');
		var bar  = document.getElementById('bar');
		var elem = document.createElement('div');
		elem.id   = 'notify';
		elem.style.display = 'none';
		bar.appendChild(elem);
		input.addEventListener('invalid', function(event){
		event.preventDefault();
		elem.className     = 'error';
		elem.style.display = 'block';
		elem.style.marginTop  = '1.3em';
		elem.style.marginLeft  = '-0.5em';
		if ( ! event.target.validity.valid && event.target.id == "loginFormUser" ) {
			input = document.getElementById('loginFormUser');
			elem.textContent   = 'Потребителското име не отговаря на изискванията. Трябва да съдържа 3 - 15 символа, без спец. символи!';
		}  else if (! event.target.validity.valid && event.target.id == "loginFormPass" ){
			input = document.getElementById('loginFormPass');
			elem.textContent   = 'Паролата трябва да е от 3 до 254 символа, без специални символи!';
		}
		input.className    = 'invalid animated shake';
		})
		
		$("#loginFormUser").qtip(
		  {
			 content: {
				  text: 'Потребителското име трябва да съдържа между 3 и 15 символа!',
			title: 'Внимание'
			 },
			 position: {
				corner: {
				   target: 'bottomMiddle',
				   tooltip: 'topMiddle'
				},
			 },
			 show: { 
				solo: true
			 },
			 hide: {delay:10},
			 style: {
				tip: true,
				border: {
				   width: 0,
				   radius: 4
				},
				name: 'qtip-dark',
				width: 570
			 }
		  })
	</script>
	<footer>
		<div style="text-align: center;">
			<p>© Copyright <?php echo date("Y"); ?>. Лазар Дилов. All Rights Reserved. </p>
		</div>
	</footer>
</body>
</html>