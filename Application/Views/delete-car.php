<div class='container'>
<h3>Изтриване на автомобил:</h3>
<?php display_warning(
    "Сиурен ли сте, че искате да изтриете този автомобил:<br> 
    {$car['Brand']} {$car['Model']}, {$car['Year']}"
); ?>
<p></p>
<form class="yes" method="post" action="/cars/delete/cid/<?= $carid; ?>">
    <input type="hidden" name="id" value="<?= $carId; ?>">
    <input type="hidden" name="choice" value="yes">
    <button class="yes" type="submit">Да</button>
</form>
<button type="button" onclick="window.location.href = '/account/profile'">Не</button>
</div>