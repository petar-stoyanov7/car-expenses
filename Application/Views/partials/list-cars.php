<input type="hidden" id="cars-user-id" value="<?= $showCars ? $userId : ''; ?>">

<div class="flex-wrapper cars-list<?= (!$showCars) ? ' hidden' : '' ?>">

</div>
<button id="add-car">Add car</button>



<div id="delete-confirm" class="expense-details-modal modal-lvl-3">
    <span class="confirm-close" onclick="_closeDeleteConfirmation()"><i class="far fa-times-circle"></i></span>
    <span>Are you sure you want to delete this car? This action is irreversible!</span>
    <button class="delete-yes">Yes</button>
    <button class="delete-no" onclick="_closeDeleteConfirmation()">No</button>
</div>

<div id="car-form-modal" class="modal-lvl-2">
    <h3 class="title">Edit car:</h3>
    <?php $View::renderForm($carForm) ?>
</div>

<?php /** the bellow is template, used for JS */ ?>
<div class="element profile-car" id="car-template">
    <h4></h4>
    <div class="cars-actions">
        <a class="edit-car" onclick="showEditCar()">
            <i class="fas fa-edit"></i>
        </a>
        <a class="delete-car" onclick="showDeleteCar()">
            <i class="far fa-trash-alt"></i>
        </a>
    </div>
    <div class="flex-wrapper">
        <span class="label">Year: </span>
        <span class="cars-data car-year"></span>
    </div>
    <div class="flex-wrapper">
        <span class="label">Color: </span>
        <span class="cars-data car-color"></span>
    </div>
    <div class="flex-wrapper">
        <span class="label">Mileage: </span>
        <span class="cars-data car-mileage"></span>
    </div>
    <div class="flex-wrapper">
        <span class="label">Fuel: </span>
        <span class="cars-data car-fuel"></span>
    </div>
    <div class="flex-wrapper hidden">
        <span class="label">Secondary fuel</span>
        <span class="cars-data car-fuel2"></span>
    </div>
    <div class="flex-wrapper">
        <span class="label">Notes: </span>
        <span class="cars-data car-notes"></span>
    </div>
</div>