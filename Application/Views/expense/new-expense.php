<div id="expense-black-overlay"></div>
<div id="loading-message" class="new-expense-loading">
    <span>Loading...</span>
</div>
<div class='container'>
    <h3>New expense:</h3>
    <?php $View::renderForm($form);?>
</div>

<div class="container">
    <h3>Last five:</h3>
    <table id="last-five-expenses" class="expenses">
        <tr>
            <th>Mileage</th>
            <th>Car</th>
            <th>Expense type</th>
            <th>Type</th>
            <th>Value</th>
            <th>Notes</th>
        </tr>
    </table>
</div>