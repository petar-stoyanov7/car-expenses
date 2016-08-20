<?php
$title = "Редактирай профил";
include("header.php");
include("top-toolbar.php");
$dao = new User_DAO();
echo '<div class="container">';
if (!empty($_GET['uid'])) {
	$uid = $_GET['uid'];
	$usr = $dao->get_user_by_id($uid);
	display_edit_profile($usr,1);
	$password="blank";
	show_back_button();
	
} else {
	display_edit_profile($_SESSION['user']);	
}
if (!empty($_POST)) {	
	if (isset($password)) {
		$user = new User($_POST['user'], $password);
		$dao->edit_user($user,$_POST,1);
	} else {
		$user = new User($_POST['user'],$_POST['old_password']);
		$dao->edit_user($user,$_POST);
	}
}

echo '</div>';

include("footer.php");
?>