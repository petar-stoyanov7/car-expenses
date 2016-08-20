<?php
ob_start();
$title = "admin panel";
include("header.php");
include("top-toolbar.php");
if($_SESSION['user']['Group']!="admins") {
	header("Location: index.php");
}
if(!isset($_GET['uid'])) {
	header("Location: index.php");
	ob_end_flush();
}

$uid = $_GET['uid'];
$user_dao = new User_DAO();
$car_dao = new Car_DAO();
$stat_dao = new Statistics_DAO();

$user = $user_dao->get_user_by_id($uid);
echo '<div class="container">';
echo '<h3>'.$user['Username'].'</h3>';
echo 'Име, Фамилия:</b> '.$user['Fname'].' '.$user['Lname'].'<br>';
echo 'Брой автомобили: '.$car_dao->count_cars_by_user_id($uid).'<br>';
echo 'Общо похарчени за '.date('Y').': '.$stat_dao->count_year_expenses_by_uid($uid).' лв.<br>';
echo '</div>';
echo '<div class="container">';
echo '<h3>Actions</h3>';
show_back_button();
echo '</div>';
show_user_brief($uid);

include("footer.php");
?>