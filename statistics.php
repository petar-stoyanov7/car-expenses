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
		$start_year = substr($_POST['from'], 0, 4);
		$end_year = substr($_POST['to'], 0, 4);
		if ($start_year > $end_year) {
			echo "<div class='container'>";
			return(display_warning("Некоректен период!"));
			echo "</div>";;
		}
		else {
			$data = $statistics_dao->get_statistic_for_period($_POST['from'],$_POST['to'],$uid,$_POST['car'],$_POST['expense-type']);
			display_overall_statistics($data);
			display_detailed_statistics($data);
		}
	}
	echo '</div>';

include("footer.php");
?>