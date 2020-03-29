<?php
$title = "Редактирай профил";
?>
<div class="container">

<h3>Редактирай профил</h3>
<form id="edit-user-form" method="post" action="/account/edit">
Редакция на профил: <b><?= $user['Username']; ?></b><br><br>
<input type="hidden" name="user" value="<?= $user['Username']; ?>">
<?php if (!$isAdmin) : ?>
    <div class="form-wrapper">
        <label for="old_password">Текуща парола:</label>
        <input id="old_password" type="password" name="old_password" placeholder="Задължително!">
    </div>
<?php endif; ?>
<div class="form-wrapper">
    <label for="password1">Нова парола:</label>
    <input id="password1" type="password" name="password1" placeholder="Нова парола (при желание за смяна)">
</div>
<div class="form-wrapper">
    <label for="password2">Повтори паролата:</label>
    <input id="password2" type="password" name="password2" placeholder="Повтори новата парола">
</div>
<div class="form-wrapper">
    <label for="fname">Име:</label>
    <input id="fname" name="fname" type="text" value="<?= $user['Fname']; ?>">
</div>
<div class="form-wrapper">
    <label for="lname">Фамилия</label>
    <input id="lname" name="lname" type="text" value="<?= $user['Lname']; ?>">
</div>
<div class="form-wrapper">
    <label for="city">Град</label>
    <input id="city" name="city" type="text" value="<?= $user['City']; ?>">
</div>
<button id="form-submit" type="submit">Редактирай</button>
</form>


</div>