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
    <span class="user-modify-actions">
        <a id="edit-user">
            <span class="profile-tooltip profile-edit">Edit user</span>
            <i class="fas fa-user-edit"></i>
        </a>
        <?php if (isset($adminPanel) && $adminPanel) : ?>
        <a id="delete-user">
            <span class="profile-tooltip profile-delete">Delete user</span>
            <i class="fas fa-user-times"></i>
        </a>
        <?php endif; ?>
    </span>
</div>

<div id="user-form-modal" class="modal-lvl-3">
    <h3>Edit user</h3>
    <?php $View::renderForm($form); ?>
</div>