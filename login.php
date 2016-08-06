<?php
$title = "Вход";
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
</div>

<?php
include("footer.php");
?>