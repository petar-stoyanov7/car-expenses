var hideOptionals = function() {
    $.each($('.optional-select'), function(i, value){
        $(value).closest('.form-wrapper').hide();
    });
};

var displayOption = function(selector) {
    $(selector).closest('.form-wrapper').show();
};

var filterExpenses = function() {
    var selectedExpense = $('#expense-type').val();
    hideOptionals();
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

$(function(){
    var carSelect = $('#car-id');
    var expenseSelect = $('#expense-type');


    filterExpenses();

    expenseSelect.change(filterExpenses);
});