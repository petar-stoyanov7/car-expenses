var expenseType = document.querySelector('select#expense-type');
var expenseSubtype = document.querySelector('div#expense-subtype');
var optional = document.querySelector('div#optional');
lineBreak = document.createElement('br');

function clearElement(element) {
    element.innerHTML = '';
}

function translateElement(element) {
    switch(element){
        case 'Gas':
            return "Бензин";
            break;
        case 'LPG':
            return "Газ";
            break;
        case 'Diesel':
            return "Дизел";
            break;
        case 'Methane':
            return "Метан";
            break;
        case 'Electricity':
            return "Електричество";
            break;
        case 'Other':
            return "Друго";
            break;
    }
}

function displayFuelTypes() {
    clearElement(expenseSubtype);
    clearElement(optional);
    var fuelLabel = document.createElement('label');
    fuelLabel.for = 'fuel-type';
    fuelLabel.innerHTML = 'Тип Гориво';
    var select = document.createElement('select');
    select.id = 'fuel-type';
    select.name = 'fuel-type';
    var literLabel = document.createElement('label');
    literLabel.for = 'liters';
    literLabel.innerHTML = 'Литри:';
    var liters = document.createElement('input');
    liters.id = 'liters';
    liters.type = 'number';
    liters.name = 'liters';
    liters.placeholder = 'Литри гориво';
    for (var ind in fuelTypes) {
        option = document.createElement('option');
        option.value = ind;
        option.innerHTML = translateElement(fuelTypes[ind]);
        select.append(option);
    }
    expenseSubtype.appendChild(fuelLabel);
    expenseSubtype.appendChild(select);
    optional.appendChild(literLabel);
    optional.appendChild(liters);
    expenseSubtype.innerHTML += '<input type="hidden" name="insurance-type" value=NULL>';
    //clearElement(expenseSubtype);
}

function displayInsuranceTypes() {
    clearElement(expenseSubtype);
    clearElement(optional);
    var lSelect = document.createElement('label');
    lSelect.for = 'insurance-type';
    lSelect.innerHTML = 'Тип Застраховка';
    var select = document.createElement('select');
    select.id = 'insurance-type';
    select.name = 'insurance-type';
    var opt1 = document.createElement('option');
    opt1.value = "1";
    opt1.innerHTML = 'Гражданска Отговорност';
    var opt2 = document.createElement('option');
    opt2.value = "2";
    opt2.innerHTML = 'Каско';
    var opt3 = document.createElement('option');
    opt3.value = "3";
    opt3.innerHTML = 'Друг вид';
    select.appendChild(opt1);
    select.appendChild(opt2);
    select.appendChild(opt3);
    expenseSubtype.appendChild(lSelect);
    expenseSubtype.appendChild(select);
    expenseSubtype.innerHTML += '<input type="hidden" name="fuel-type" value=NULL>';
    expenseSubtype.innerHTML += '<input type="hidden" name="liters" value=NULL>';
}

function displayOther() {
    clearElement(expenseSubtype);
    clearElement(optional);
    expenseSubtype.innerHTML += '<input type="hidden" name="insurance-type" value=NULL>';
    expenseSubtype.innerHTML += '<input type="hidden" name="fuel-type" value=NULL>';
    expenseSubtype.innerHTML += '<input type="hidden" name="liters" value=NULL>';
}

//Fuel is default
displayFuelTypes();

expenseType.addEventListener('change', function() {
   var expense = expenseType.value;
   console.log(expense);
   switch(expense) {
       case '1':
           displayFuelTypes();
           break;
       case '2':
            displayInsuranceTypes();
            break;
       case '3':
           displayOther();
           break;
       case '4':
           displayOther();
           break;
       case '5':
           displayOther();
           break;
   }
});