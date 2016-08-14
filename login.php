<?php
$title = "Вход";
$auth_ignore = 1;
include("header.php");
include("top-toolbar.php");
?>
<div class="container">
<h3>Вход:</h3>
<br>
<form method="post" action="#">
	<label for="username">Потребител:</label>
	<input id="username" type="text" name="username"><br>
	<label for="password">Парола:</label>
	<input id="password" type="password" name="password"><br><br>
	<button type="submit">Вход</button>
</form>
<?php
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$user = new User($_POST['username'],$_POST['password']);
		$user_dao = new User_DAO();
		if ($user_dao->login($user)) {
			header("Location: index.php");
		} else {
			display_warning("Невалиден потребител/парола");
		}
	}
?>
</div>

<?php
include("footer.php");
?>