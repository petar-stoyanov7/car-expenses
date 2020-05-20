<div class="container form-container">
    <h3>Statistic for period:</h3>
    <?php //display_statistics_input($uid); ?>
    <?php $View::renderForm($form); ?>
</div>

<div id="overall" class="container statistics-content">
    <h3>Overall:</h3>
    <div class="flex-wrapper">
    </div>
</div>

<div id="detailed" class="container statistics-content">
    <table id="detailed-expenses-table" class="expenses">
        <tr>
            <th>Mileage</th>
            <th>Date</th>
            <th>Car</th>
            <th>Type</th>
            <th>Fuel Type</th>
            <th>Liters</th>
            <th>Value</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
    </table>
</div>

<div id="parts-info" class="modal-lvl-1">
    <h4>Parts details:</h4>
    <table id="detailed-parts-table" class="expenses">
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Car</th>
            <th>Mileage</th>
            <th>Age</th>
        </tr>
    </table>
</div>

<div id="detailed-info" class="modal-lvl-1 expense-details-modal">
    <span class="modal-close"><i class="far fa-times-circle"></i></span>
    <h4>Expense details:</h4>
    <div class="flex-wrapper">
        <span class="label">Car: </span>
        <span class="data" id="details-car">Wolkswagen Golf</span>
    </div>
    <div class="flex-wrapper">
        <span class="label">Date: </span>
        <span class="data" id="details-date">33-13-333</span>
    </div>
    <div class="flex-wrapper">
        <span class="label">Mileage: </span>
        <span class="data" id="details-mileage">3333</span>
    </div>
    <div class="flex-wrapper separator">
        <span class="label">Type: </span>
        <span class="data" id="details-expense-type">Fuel</span>
    </div>
    <div class="flex-wrapper">
        <span class="label">Value: </span>
        <span class="data" id="details-value">Fuel</span>
    </div>
    <a class="delete-expense"><i class="far fa-trash-alt"></i></a>
</div>

<div id="delete-stat-confirm" class="expense-details-modal modal-lvl-2 delete-confirm">
    <span class="confirm-close" onclick="_closeDeleteConfirmation()"><i class="far fa-times-circle"></i></span>
    <span>Are you sure you want to delete this expense?!</span>
    <button class="delete-yes">Yes</button>
    <button class="delete-no" onclick="_closeDeleteConfirmation()">No</button>
</div>