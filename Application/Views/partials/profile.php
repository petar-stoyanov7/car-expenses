<input type="hidden" id="profile-user-id" value="<?= (isset($user) && !empty($user)) ? $user['id'] : ''; ?>">
<div class="element user-summary">
    <div class="flex-wrapper">
        <strong>
            <span id="profile-username" class="user-data">
                <?= isset($user) ? $user['username'] : ''; ?>
            </span>
        </strong>
    </div>
    <div class="flex-wrapper">
            <span class="label">
                Name:
            </span>
        <span id="profile-name" class="user-data">
                <?= isset($user) ? "{$user['firstname']} {$user['lastname']}" : ''; ?>
            </span>
    </div>
    <div class="flex-wrapper">
            <span class="label">
                Email:
            </span>
        <span id="profile-email" class="user-data">
                <?= isset($user) ? $user['email1'] : ''; ?>
            </span>
    </div>
    <div class="flex-wrapper">
            <span class="label">
                City:
            </span>
        <span id="profile-city" class="user-data">
                <?= isset($user) ? $user['city'] : ''; ?>
            </span>
    </div>
    <button id="edit-user">Edit Profile</button>
</div>

<div id="user-form-modal" class="modal-lvl-2">
    <h3>Edit user</h3>
    <?php $View::renderForm($form); ?>
</div>