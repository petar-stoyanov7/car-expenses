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
		<?php foreach ($userList as $user) : ?>
			<tr>
			<td><a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['ID']; ?></a></td>
			<td><a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Username']; ?></a></td>
			<td><a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Email']; ?></a></td>
			<td><a href="/cars/list-cars/user_id/<?= $user['ID']; ?>"><?= $carModel->count_cars_by_user_id($user['ID']); ?></a></td>
			<td><a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Fname']; ?></a></td>
			<td><a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Lname']; ?></a></td>
			<td>
			<a href="/account/edit/user_id/<?= $user['ID']; ?>"><img class="icon" src="./img/icon-edit.png"></a>
			<!-- <a href="/admin/remove-profile/user_id/"<?= ''//$user['ID']; ?>"><img class="icon" src="./img/icon-delete.png"></a> -->
			</td>
        <?php endforeach; ?>
		
</table>
</div>