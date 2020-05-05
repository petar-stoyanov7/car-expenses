var cache = {};
var cars = {};
var lastFive = {};

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
    $('#expense-black-overlay').toggle();
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
    });
};

var drawLastFive = function(data){
    $table = $('#last-five-expenses');
    $('#last-five-expenses tr.dynamic-row').remove();

    $.each(data, function(i,datum){
        var row = '<tr class="dynamic-row">' +
            '<td>'+datum['mileage']+'</td>' +
            '<td>'+datum['car']+'</td>' +
            '<td>'+datum['expenseType']+'</td>' +
            '<td>'+datum['type']+'</td>' +
            '<td>'+datum['price']+'</td>' +
            '<td>'+datum['notes']+'</td>' +
            '</tr>';
        $table.append(row);
    });
};

var getLastFive = function(userId) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/expense/get-last-five',
        data: {
            userId: userId
        },
        success: function(data) {
            lastFive = data;
        },
        error: function(response) {
            console.log('error with last five');
            console.log(response);
        }
    }).done(function(data){
        drawLastFive(lastFive);
    });
};

$(function(){
    var carSelect = $('#car-id');
    var expenseSelect = $('#expense-type');
    var userId = $('#user-id').val();
    var dataReady = false;
    var form = $('#new-expense-form');

    getCars(userId);
    getLastFive(userId);

    form.submit(function(event){
        _toggleLoading()
        event.preventDefault();
        formData = {
            "userId": userId,
            "carId": $('#car-id').val(),
            "expenseType": $('#expense-type').val(),
            "fuelType": $('#fuel-type').val(),
            "insuranceType": $('#insurance-type').val(),
            "date": $('#date').val(),
            "mileage": $('#mileage').val(),
            "liters": $('#liters').val(),
            "value": $('#value').val(),
            "description": $('#description').val(),
        };
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/expense/new-ajax-expense',
            data: formData,
            error: function(response) {
                _toggleLoading();
                console.log('error with form execution');
                console.log(response);
            }
        }).done(function(data){
            form.find('input textarea').val('');
            setMileage(cars);
            if (data['success']) {
                getLastFive(userId);
                _toggleLoading();
            }
        });
    });

    $('#car-id').change(function(){
        filterFuels(cars);
        setMileage(cars);
    });
    filterExpenses();
    expenseSelect.change(filterExpenses);
});