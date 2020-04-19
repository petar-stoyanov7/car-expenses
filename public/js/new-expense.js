var cache = {};
var cars = {};

var _hideOptionals = function() {
    $.each($('.optional-select'), function(i, value){
        $(value).closest('.form-wrapper').hide();
    });
};

var _showAllFuels = function() {
    $.each($('#fuel-type option'), function(){
        $(this).show()
    });
};

var _toggleLoading = function() {
    $('#black-overlay').toggle();
    $('#loading-message').toggle();
};

var displayOption = function(selector) {
    $(selector).closest('.form-wrapper').show();
};

var filterExpenses = function() {
    var selectedExpense = $('#expense-type').val();
    _hideOptionals();
    switch(selectedExpense) {
        case "1":
            displayOption('#fuel-type');
            displayOption('#liters');
            break;
        case "2":
            displayOption('#insurance-type');
            break;
        default:
            break;
    }
};

var filterFuels = function(cars) {
    selectedCar = $('#car-id').val();
    fuels = cars[selectedCar].fuels;
    console.log(fuels);
    _showAllFuels();
    $.each($('#fuel-type option'), function(){
        if (fuels.indexOf($(this).val()) === -1) {
            $(this).hide();
        }
    });
};

var setMileage = function(cars) {
    selectedCar = $('#car-id').val();
    $('#mileage').val(cars[selectedCar].mileage);
};

var getCars = function(userId) {
    _toggleLoading();
    $.ajax({
        type: 'POST',
        url: '/cars/list-user-cars/',
        dataType: 'json',
        data: {
            userid: userId
        },
        success: function(data) {
            cars = data;
        },
        error: function(response) {
            console.log('error with request');
            console.log(response);
        }

    }).done(function(data){
        _toggleLoading();
        filterFuels(cars);
        console.log(cars);
    });
};

$(function(){
    var carSelect = $('#car-id');
    var expenseSelect = $('#expense-type');
    var userId = $('#user-id').val();
    var dataReady = false;

    getCars(userId);

    $('#car-id').change(function(){
        filterFuels(cars);
        setMileage(cars);
    });
    filterExpenses();
    expenseSelect.change(filterExpenses);
});