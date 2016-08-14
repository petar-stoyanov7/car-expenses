<?php
if(!isset($_SESSION['user'])) {
	header("Location: ./static/index.php");
}
?>