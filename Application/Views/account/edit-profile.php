<?php
$title = "Редактирай профил";
?>
<div class="container">

<h3>Редактирай профил</h3>
<form method="post" action="/account/edit">
Редакция на профил: <b><?= $user['Username']; ?></b><br><br>
<input type="hidden" name="user" value="<?= $user['Username']; ?>">
<?php if (!$isAdmin) : ?>
    <label for="old_password">Текуща парола:</label>
    <input id="old_password" type="password" name="old_password"><br><br>
<?php endif; ?>
<label for="password1">Нова парола:</label>
<input id="password1" type="password" name="password1" placeholder="Ако не желаеш смяна на парола,"><br>
<label for="password2">Повтори паролата:</label>
<input id="password2" type="password" name="password2" placeholder="Остави полето празно"><br>

<label for="fname">Име:</label>
<input id="fname" name="fname" type="name" placeholder="Настоящо име: <?= $user['Fname']; ?>"><br>
<label for="lname">Фамилия</label>
<input id="lname" name="lname" type="name" placeholder="Настояща фамилия: <?= $user['Lname']; ?>"><br>
<label for="city">Град</label>
<input id="city" name="city" type="name" placeholder="Настоящ град: <?= $user['City']; ?>"><br>
<br>
<button type="submit">Редактирай</button>
</form>


</div>