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

            <?php if ((int)$user['ID'] === 1) : ?>
                <?php continue; ?>
            <?php else : ?>
            <tr>
                <td>
                    <a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['ID']; ?></a>
                </td>
                <td>
                    <a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Username']; ?></a>
                </td>
                <td>
                    <a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Email']; ?></a></td>
                <td>
                    <a href="/cars/list-cars/user_id/<?= $user['ID']; ?>"><?= $carModel->countCarsByUserId($user['ID']); ?></a>
                </td>
                <td>
                    <a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Fname']; ?></a>
                </td>
                <td>
                    <a href="/admin/show-profile/user_id/<?= $user['ID']; ?>"><?= $user['Lname']; ?></a>
                </td>
                <td>
                    <a href="/account/edit/user_id/<?= $user['ID']; ?>"><i class="fas fa-user-edit"></i></a>
                    <a href="/admin/remove-profile/user_id/"<?= $user['ID']; ?>"><i class="fas fa-user-times"></i></a>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
		
</table>
</div>