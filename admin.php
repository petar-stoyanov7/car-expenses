<?php
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
		<th>Remove</th>
	</tr>
	<?php
		foreach ($userlist as $user) {
			echo "<tr>";
			echo "<td><a href='edit-profile.php?uid=".$user['ID']."'>".$user['ID']."</a></td>";
			echo "<td><a href='edit-profile.php?uid=".$user['ID']."'>".$user['Username']."</a></td>";
			echo "<td><a href='edit-profile.php?uid=".$user['ID']."'>".$user['Email']."</a></td>";
			echo "<td><a href='list-cars.php?uid=".$user['ID']."'>".$cars->count_cars_by_user_id($user['ID'])."</a></td>";
			echo "<td><a href='edit-profile.php?uid=".$user['ID']."'>".$user['Fname']."</a></td>";
			echo "<td><a href='edit-profile.php?uid=".$user['ID']."'>".$user['Lname']."</a></td>";
			echo "<td><a href='remove-profile.php?uid=".$user['ID']."'>x</a></td>";
		}
	?>
</table>
</div>
<?php
include("footer.php");
?>