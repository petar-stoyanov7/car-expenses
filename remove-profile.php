<?php
	include("header.php");
	ob_start();
	if (isset($_SESSION['user']) && ($_SESSION['user']['Group']) == "admins") {
		if (isset($_GET['uid'])) {
			$uid = $_GET['uid'];
			$user_dao = new User_DAO();
			$user_dao->remove_user($uid);
			display_warning("Потребителят ".$user_dao->get_user_by_id($uid)['Username']." е изтрит успешно");
			header("refresh:5;url=admin.php");
		} else {
			header("Location: index.php");
		}
	} else {
		header("Location: index.php");
	}
	ob_end_flush();
?>