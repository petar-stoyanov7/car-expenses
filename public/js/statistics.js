var cache = {};

var _toggleLoading = function()
{
    $('#form-black-overlay').toggle();
    $('#loading-message').toggle();
};

var getDetailedInformation = function(expenseId) {
    alert(expenseId);
};

var deleteExpense = function(expenseId) {
    alert(expenseId);
};

var renderCars = function(cars)
{
    var containerDiv = $('#overall div.flex-wrapper');
    $('div.element').remove();
    $.each(cars, function(i,car){
        var ratio = 0;
        if (car['Distance'] <= 0) {
            ratio = car['Overall'];
        } else {
            ratio = parseFloat(car['Overall']) / parseFloat(car['Distance']);
        }
        ratio = ratio.toFixed(2);
        var element = $('<div class="element">' +
            '<h4>' + car['Brand'] + ' ' + car['Model'] + '</h4>' +
            '<span class="element-entry"><b>Kilometers passed: </b>' + car['Distance'] + '</span>' +
            '<span class="element-entry"><b>Spent: </b>' + car['Overall'] + '</span>' +
            '<span class="element-entry"><b>Ratio: </b>' + ratio + '</span></div>');
        containerDiv.append(element);

    });
};

var renderDetailedStatistics = function(data)
{
    var table = $('#detailed-expenses-table');
    $('#detailed-expenses-table tr.statistic-row').remove();
    $.each(data, function(i,datarow){
        var element = '<tr class="statistic-row">' +
            '<td>' + datarow['Mileage'] + '</td>' +
            '<td>' + datarow['Date'] + '</td>' +
            '<td>' + datarow['car_brand'] + ' ' + datarow['car_model'] + '</td>' +
            '<td>' + datarow['expense_name'] + '</td>' +
            '<td>' + datarow['Liters'] + '</td>' +
            '<td>' + datarow['Price'] + '</td>' +
            '<td>' + datarow['Notes'] + '</td>' +
            '<td>' +
            '<a onclick="getDetailedInformation('+datarow['ID']+')">' +
            '<i class="fas fa-info-circle"></i>' +
            '</a>  ' +
            '<a onclick="deleteExpense('+datarow['ID']+')">' +
            '<i class="fas fa-trash-alt"></i>' +
            '</a>' +
            '</td>' +
            '</tr>';
        table.append(element);
    })

};

/*

    <td class="car">
        <?= $carModel->getCarNameById($row['CID']); ?>
    </td>
    <td class="expense-type">
        <?= translate($expenseModel->getExpenseName($row['Expense_ID'])); ?>
    </td>
    <td class="expense-liters">
        <?= $row['Liters']; ?>
    </td>
    <td class="expense-value">
        <?= $row['Price']; ?>
    </td>
    <td class="additional-info">
        <?= substr($row['Notes'],0,18); ?>
    </td>
    <td class="expense-operations">
        <a href="/expense/remove/id/<?= $row['ID']; ?>/year/<?= substr($row['Date'], 0, 4); ?>">
            <i class="fas fa-trash-alt"></i>
        </a>
        <a href="/expense/detailed-info/id/<?= $row['ID']; ?>/year/<?= substr($row['Date'], 0, 4); ?>" target="_blank">
            <i class="fas fa-info-circle"></i>
        </a>
    </td>
</tr>
 */

var renderStatisticsData = function(data)
{
    console.log(data);
    renderCars(data['cars']);
    renderDetailedStatistics(data['allExpenses']);
};


var getStatisticsData = function() {
    var selectedCar = $('#car').val();
    var expenseType = $('#expense-type').val();
    var startDate = $('#from').val();
    var endDate = $('#to').val();
    var userId = $('#user-id').val();
    var cacheString = selectedCar + expenseType + startDate + endDate + userId;
    _toggleLoading();
    if (cache[cacheString] !== undefined) {
        renderStatisticsData(cache[cacheString]);
        _toggleLoading();
    } else {
        $.ajax({
            type: 'POST',
            url: '/statistics',
            dataType: 'JSON',
            data: {
                'from': startDate,
                'to': endDate,
                'user-id': userId,
                'car': selectedCar,
                'expense-type': expenseType,
                'ajax': 1
            },
            success: function(data) {
                cache[cacheString] = data;
            },
            error: function(response) {
                console.log('Error with statistics data');
                console.log(response);
                _toggleLoading();
            }
        }).done(function(){
            renderStatisticsData(cache[cacheString]);
            _toggleLoading();
        });
    }
};

$(function(){
    var form = $('#get-statistics-form');

    form.submit(function(event){
        event.preventDefault();
        getStatisticsData();
    });
});