<div class="container">
<h3>User list</h3>
<table class='userlist'>
	<tr>
		<th>ID</th>
		<th>User</th>
		<th>E-mail</th>
		<th>Cars</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Actions</th>
	</tr>
		<?php foreach ($userList as $user) : ?>
            <?php
                if((int)$user['ID'] === 1) {
                    continue;
                }
            ?>

            <tr userId="<?= $user['ID']; ?>" class="table-user-row">
                <td class="table-user-id">
                    <?= $user['ID']; ?>
                </td>
                <td class="table-user-username">
                    <?= $user['Username']; ?>
                </td>
                <td class="table-user-email">
                    <?= $user['Email']; ?>
                </td>
                <td class="table-user-cars">
                    <button
                        type="button"
                        class="show-cars"
                        onClick="showCars('<?=$user['ID'];?>')"
                    >show <?= $user['number_of_cars']; ?> cars</button>
                </td>
                <td class="table-user-firstname">
                    <?= $user['Fname']; ?>
                </td>
                <td class="table-user-lastname">
                    <?= $user['Lname']; ?>
                </td>
                <td>
                    <a onclick="editUser('<?=$user['ID'];?>')"><i class="fas fa-user-edit"></i></a>
                    <a onclick="deleteUser('<?=$user['ID'];?>')"><i class="fas fa-user-times"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
		
</table>
</div>

<div id="user-summary-modal" class="toggleable-modal">
    <h3>User:</h3>
    <?php
    $View::displayPartial(
        'profile.php',
        [
            'form'  => $userForm,
        ]
    );
    ?>
</div>

<div id="user-cars-modal" class="toggleable-modal">
    <h3>Cars:</h3>
    <?php
    $View::displayPartial(
        'list-cars.php',
        [
            'carForm'   => $carForm,
            'showCars'  => false,
        ]
    );
    ?>
</div>