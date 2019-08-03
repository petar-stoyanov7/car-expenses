<!-- Toolbar	 -->
<div class="toolbar">
    <div class="tooltip">
        <a href="/"><img class="top-navigation" src="/img/icon-home.png"></a>
        <span class="tooltiptext">Начало</span>
    </div>
    <div class="tooltip">
        <a href="/new"><img class="top-navigation" src="/img/icon-add.png"></a>
        <span class="tooltiptext">Нов Разход</span>
    </div>
    <div class="tooltip">
        <a href="/statistics"><img class="top-navigation" src="/img/icon-euro.png"></a>
        <span class="tooltiptext">Статистика</span>
    </div>
    <div class="tooltip">
        <a href="/account/profile"><img class="top-navigation" src="/img/icon-wheel2.png"></a>
        <span class="tooltiptext">Профил</span>
    </div>
    <?php
        if(isset($_SESSION['user'])) {
            if ($_SESSION['user']['Group'] == "admins") {
                echo '<div class="tooltip">';
                echo '<a href="/admin"><img class="top-navigation" src="/img/icon-admin.png"></a>';
                echo '<span class="tooltiptext">Админ панел</span>';
                echo '</div>';
            }
        }
    ?>
</div>