<div class='container'>
    <h3>New expense:</h3>
    <?php $View::renderForm($form);?>
</div>
<?php if (!empty($form2)) : ?>
    <div class="container">
        <h3>Import:</h3>
        <?php $View::renderForm($form2); ?>
    </div>
<?php endif; ?>
<div class="container">
    <h3>Last five:</h3>
    <table id="last-five-expenses" class="expenses">
        <tr>
            <th>Mileage</th>
            <th>Car</th>
            <th>Expense type</th>
            <th>Value</th>
            <th>Notes</th>
        </tr>
    </table>
</div>