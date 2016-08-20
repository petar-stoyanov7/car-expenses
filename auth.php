<?php
ob_start();
if(!isset($_SESSION['user'])) {
	header("Location: ./static/index.php");
}
ob_end_flush();
?>