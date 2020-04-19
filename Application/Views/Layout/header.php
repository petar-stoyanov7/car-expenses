<?php
use \Core\View;
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?= (isset($title)) ? $title : "Автомобилни разходи"; ?>	
	</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>
    <?php if (isset($cssArray) && count($cssArray) > 0) : ?>
        <?php foreach($cssArray as $cssFile) : ?>
            <link rel="stylesheet" href="/css/<?=$cssFile?>">
        <?php endforeach; ?>
    <?php endif; ?>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="icon" href="/img/icon-wheel.png">
</head>
<body>
    <div id="black-overlay"></div>
	<!-- Top Bar -->
	<div class="top-bar">
		<div class="top-links">
		<a href="/">АВТО</a>
		<a href="/">ДОМ</a>
		</div>
		<div class="login">
		<?php
			if (!empty($_SESSION)) {
				echo "<a href='/account/profile'>[ ".$_SESSION['user']['Username']." ]</a>";
				echo "<a href='/account/logout'>[ Изход ]</a>";
			} else {
				echo '<a href="/account/login">Вход</a>';
				echo '<a href="/account/register">Регистрация</a>';
			}
		?>
		</div>
	</div>
	<header id="site-header">	
		<img id="site-logo" src="/img/logo2.png">	
		<div class="header">
			<img src="/img/site-logo2.png">
		</div>
	</header>
</body>
<main>