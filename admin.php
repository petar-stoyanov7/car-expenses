<?php
ob_start();
$title = "admin panel";
include("header.php");
include("top-toolbar.php");
if($_SESSION['user']['Group']!="admins") {
	header("Location: index.php");
}

$users = new User_DAO();
$cars = new Car_DAO();
$userlist = $users->list_users();
?>
<div class="container">
<h3>User list</h3>
<table class='userlist'>
	<tr>
		<th>UID</th>
		<th>usr</th>
		<th>e-mail</th>
		<th>cars</th>	
		<th>Fname</th>
		<th>Lname</th>
		<th>Modify</th>
	</tr>
	<?php
		foreach ($userlist as $user) {
			echo "<tr>";
			echo "<td><a href='show-profile.php?uid=".$user['ID']."'>".$user['ID']."</a></td>";
			echo "<td><a href='show-profile.php?uid=".$user['ID']."'>".$user['Username']."</a></td>";
			echo "<td><a href='show-profile.php?uid=".$user['ID']."'>".$user['Email']."</a></td>";
			echo "<td><a href='list-cars.php?uid=".$user['ID']."'>[".$cars->count_cars_by_user_id($user['ID'])."]</a></td>";
			echo "<td><a href='show-profile.php?uid=".$user['ID']."'>".$user['Fname']."</a></td>";
			echo "<td><a href='show-profile.php?uid=".$user['ID']."'>".$user['Lname']."</a></td>";
			echo "<td>
			<a href='edit-profile.php?uid=".$user['ID']."'><img class='icon' src='./img/icon-edit.png'></a>
			<a href='remove-profile.php?uid=".$user['ID']."'><img class='icon' src='./img/icon-delete.png'></a>
			</td>";
		}
		if (isset($_GET['uid'])) {
			$uid = $_GET['uid'];
			$user_dao = new User_DAO();
			$user_dao->remove_user($uid);
			echo "KUR";
			display_warning("Потребителят ".$user_dao->get_user_by_id($uid)."е изтрит успешно");
			header("Location: admin.php");
		}
		echo '</table>';
		echo '</div>';
	?>

<?php
include("footer.php");
ob_end_flush();
?>