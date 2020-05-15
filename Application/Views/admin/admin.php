<div class="container">
<h3>User list</h3>
<table class='userlist'>
	<tr>
		<th>ID</th>
		<th>User</th>
        <th>Gender</th>
		<th>Cars</th>
		<th>First Name</th>
		<th>Last Name</th>
        <th>E-mail</th>
	</tr>
		<?php foreach ($userList as $user) : ?>
            <?php
                if((int)$user['ID'] === 1) {
                    continue;
                }
            ?>

            <tr userId="<?= $user['ID']; ?>" class="table-user-row" id="user-row-<?= $user['ID'] ?>">
                <td class="table-user-id">
                    <?= $user['ID']; ?>
                </td>
                <td class="table-user-username">
                    <?= $user['Username']; ?>
                </td>
                <td class="table-user-gender">
                    <?= $user['Sex']; ?>
                </td>
                <td class="table-user-cars">
                    <?= $user['number_of_cars']; ?>
                    <?= ((int)$user['number_of_cars'] === 1) ? 'car' : 'cars'; ?>
                </td>
                <td class="table-user-firstname">
                    <?= $user['Fname']; ?>
                </td>
                <td class="table-user-lastname">
                    <?= $user['Lname']; ?>
                </td>
                <td class="table-user-email">
                    <?= $user['Email']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
		
</table>
</div>

<div id="user-summary-modal" class="modal-lvl-1">
    <span class="modal-close">
        <i class="far fa-times-circle" aria-hidden="true"></i>
    </span>
    <h3>User:</h3>
    <?php
    $View::displayPartial(
        'profile.php',
        [
            'form'       => $userForm,
            'adminPanel' => true,
        ]
    );
    ?>
</div>

<div id="user-cars-modal" class="modal-lvl-1">
    <span class="modal-close">
        <i class="far fa-times-circle" aria-hidden="true"></i>
    </span>
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

<div id="delete-user-confirm" class="modal-lvl-3 delete-confirm">
    <span class="confirm-close" onclick="_closeUserDeleteConfirmation()"><i class="far fa-times-circle"></i></span>
    <span>Are you sure you want to delete this user</span>
    <div class="options">
        <div>
            <input type="checkbox" id="delete-user-expenses">
            <label for="delete-user-expenses">delete expenses?</label>
        </div>
        <div>
            <input type="checkbox" id="delete-user-cars">
            <label for="delete-user-cars">Delete cars?</label>
        </div>
    </div>
    <button class="delete-yes">Yes</button>
    <button class="delete-no" onclick="_closeUserDeleteConfirmation()">No</button>
</div>