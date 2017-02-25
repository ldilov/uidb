<html>
<head>
	<title> УИБ - Университетска информационна система </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="../styles/admin/main.css" rel="stylesheet" type="text/css">
	<link href="../styles/zsocial.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" integrity="sha384-Wrgq82RsEean5tP3NK3zWAemiNEXofJsTwTyHmNb/iL3dP/sZJ4+7sOld1uqYJtE" crossorigin="anonymous" >	
	<link rel="stylesheet" href="../styles/font-awesome.min.css">
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="../js/jquery-3.1.1.js"></script>
</head>
<body>
	<div class="header">
		<p id="welcome"> Добре дошли Администратор </p>
		<nav>
			<ul>
				<li><a class="third after" href="index.php?p=students"> СТУДЕНТИ</a></li>
				<li><a class="third after" href="index.php?p=lecturers"> ЛЕКТОРИ </a></li>
				<li><a class="third after" href="index.php?p=courses"> КУРСОВЕ </a></li>
				<li><a class="third after" href="index.php?p=programs"> ПРОГРАМИ </a></li>
				<li><a class="third after" href="index.php?p=programs"> ИЗПИТИ </a></li>
				<li><a class="third after" href="index.php?p=logout"> <img src="../images/glyphicons/png/glyphicons-681-door.png" height="20" width="20"/></a></li>
			</ul>
		</nav>
	</div>
	<div class="container">
<?php 
	echo "<h2 class=\"page\" >". $page_title . "</h2>";
	echo "<br><br>";
	include($tpl); 
?>
</div>
<footer style="bottom: 0;">
	<div class="splitter"></div>
	<ul>
	<li>
		<div class="icon" data-icon="7"></div>
		<div class="text">
			<h4>Връзка с нас</h4>
			<div>
				Ако имате въпроси относно нашата онлайн система или въпроси от административен характер, можете да се свържете с нас на:
				<table>
					<tr>
						<td>Тел:</td>  <td><?php echo $phone; ?></td>
					</tr>
					<tr>
						<td>Поща:</td><td> <?php echo $mail; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</li>
	<li>
		<div class="icon" data-icon="."></div>
		<div class="text">
			<h4>Дати за изпити</h4>
			<div>Ако желаете да проверите датите за изпитите от предстоящата ви сесия, можете да влезете <a href="/index.php">ТУК</a></div>
		</div>
	</li>
	<li>
		<div class="icon" data-icon="a"></div>
		<div class="text">
			<h4>Записани предмети</h4>
			<div>В тази секция можете да видите всички предмети, за които сте се записали. Това са както предметите, които сте взели, така и тези, които все още не сте взели. Моля натиснете <a href="/index.php?p=participate">ТУК</a></div>
		</div>
	</li>
	</ul>
	<div class="bar">
		<div class="bar-wrap">
			<ul class="links">
				<li><a href="index.php">Начало</a></li>
				<li><a href="#">За нас</a></li>
			</ul>
			<div class="social">
				<a href="<?php echo  $fb_url; ?>" class="fb">
					<span data-icon="f" class="icon"></span>
					<span class="info">
						<span class="follow">Facebook страница</span>
					</span>
				</a>
				<a href="<?php echo  $tw_url; ?>" class="tw">
					<span data-icon="T" class="icon"></span>
					<span class="info">
						<span class="follow">Последвайте ни в Twitter</span>
					</span>
				</a>
				<a href="https://github.com/ldilov/uidb" class="rss">
					<span data-icon="g" class="icon"></span>
					<span class="info">
						<span class="follow">Посетете Github</span>
					</span>
				</a>
			</div>
			<div class="clear"></div>
			<div class="copyright">Лазар Дилов &copy;  2017 Всички права са запазени</div>
		</div>
	</div>
</footer>
</body>
