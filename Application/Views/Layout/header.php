<?php
use \Core\View;
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?= (isset($title)) ? $title : 'Car expenses'; ?>
	</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/75ddeba959.js" crossorigin="anonymous"></script>
    <?php if (isset($cssArray) && count($cssArray) > 0) : ?>
        <?php foreach($cssArray as $cssFile) : ?>
            <link rel="stylesheet" href="/css/<?=$cssFile?>">
        <?php endforeach; ?>
    <?php endif; ?>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="icon" href="/img/icon-wheel.png">
</head>
<body>
    <div id="black-lvl-1" class="black-overlay"></div>
    <div id="black-lvl-2" class="black-overlay"></div>
    <div id="black-lvl-3" class="black-overlay"></div>
    <div id="loading-black" class="black-overlay"></div>
    <div id="loading-message" class="loading-text">
        <span>Loading...</span>
    </div>
    <div id="top-spacer"></div>
    <?php #top-toolbar ?>
	<header class="top-bar">
        <div class="site-logo">
            <a href="/"><img src="/img/logo2.png"></a>
        </div>

        <div class="toolbar">
            <a href="/">Home</a>
            <?php if (empty($_SESSION)) : ?>
                <a href="#" class="eula-activator">EULA</a>
            <?php endif; ?>
            <a href="/expense/new">New Expense</a>
            <a href="/statistics">Statistics</a>
            <a href="/account/profile">Profile</a>
            <?= ((isset($_SESSION['user'])) && ($_SESSION['user']['Group'] == "admins")) ?
                '<a href="/admin">Admin panel</a>' :
                ''
            ?>
        </div>
        <?php #login panel ?>
		<div class="login">
		<?php if (!empty($_SESSION)) : ?>
				<a href='/account/profile'>
                    <span class="tooltip">profile</span>
                    <i class="fas fa-user"></i>
                </a>
				<a href='/account/logout'>
                    <span class="tooltip">logout</span>
                    <i class="fas fa-sign-out-alt"></i>
                </a>
		<?php else : ?>
				<a id="login-button" class="site-access login-activator">
                    <span class="tooltip">login</span>
                    <i class="fas fa-sign-in-alt"></i>
                </a>
				<a id="register-button" class="site-access register-activator">
                    <span class="tooltip">register</span>
                    <i class="fas fa-user-plus"></i>
                </a>
		<?php endif; ?>
		</div>
	</header>
</body>
<main>
<?php if (!empty($loginForm)) : ?>
    <div id="user-login-modal" class="modal-lvl-1">
        <h3>Login:</h3>
        <?php View::renderForm($loginForm); ?>
    </div>
<?php endif; ?>
<?php if (!empty($registerForm)) : ?>
    <div id="user-register-modal" class="modal-lvl-1">
        <h3>Register:</h3>
        <?php View::renderForm($registerForm); ?>
    </div>
<?php endif; ?>
<div class="main-content">

