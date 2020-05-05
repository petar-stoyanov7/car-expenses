
<div class="container">
    <h3>Statistic for period:</h3>
    <?php //display_statistics_input($uid); ?>
    <?php $View::renderForm($form); ?>
</div>

<div id="overall" class="container">
    <h3>Overall:</h3>
    <div class="flex-wrapper">
    </div>
</div>

<div id="detailed" class="container">
    <table id="detailed-expenses-table" class="expenses">
        <tr>
            <th>Пробег</th>
            <th>Дата</th>
            <th>Автомобил</th>
            <th>Тип разход</th>
            <th>Литри:</th>
            <th>Стойност</th>
            <th>Допълнителна информация</th>
            <th>Операции</th>
        </tr>
    </table>
</div>