<?php
$title = "Статистика";
include("header.php");
include("top-toolbar.php");

	$statistics_dao = new Statistics_DAO();
	if(!empty($_GET['id'])) {
		$uid = $_GET['id'];
	} else {
		$uid = $_SESSION['user']['ID'];
	}

	echo '<div class="container">';
	echo '<h3>Статистика за период:</h3>';
	display_statistics_input($uid);
	echo '</div>';
	
	if(!empty($_POST)) {
		$data = $statistics_dao->get_statistic_for_period($_POST['from'],$_POST['to'],$_SESSION['user']['ID'],$_POST['car'],$_POST['expense-type']);
		display_overall_statistics($data);
		display_detailed_statistics($data);
	}
	echo '</div>';

include("footer.php");
?>