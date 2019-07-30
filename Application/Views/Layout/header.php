<?php
use \Core\View
?>
<!DOCTYPE html>
<html>
<head>
	<title>
        <?php 
        if (isset($title)) {
            echo $title;
        } else {
            "Автомобилни разходи";        
        }
        ?>		
	</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href='../css/main.css'>
	<!-- <link rel="icon" href="../img/icon-wheel.png"> -->
	<link rel="icon" href="./img/icon-wheel.png">
</head>
<body>
	<!-- Top Bar -->
	<div class="top-bar">
		<div class="top-links">
		<a href="index.php">АВТО</a>
		<a href="#">ДОМ</a>
		<a href="http://www.pest-art.com">КАРИКАТУРИ</a>
		</div>
		<div class="login">
		<?php
			if (!empty($_SESSION)) {
				echo "<a href='profile.php'>[ ".$_SESSION['user']['Username']." ]</a>";
				echo "<a href='logout.php'>[ Изход ]</a>";
			} else {
				echo '<a href="login.php">Вход</a>';
				echo '<a href="register.php">Регистрация</a>';
			}
		?>
		</div>
	</div>
	<header id="site-header">	
		<img id="site-logo" src="./img/logo2.png">	
		<div class="header">
			<img src="../img/site-logo2.png">
		</div>
	</header>
</body>
<main>