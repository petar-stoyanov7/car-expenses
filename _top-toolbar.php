	<!-- Toolbar	 -->
	<div class="toolbar">
		<div class="tooltip">
			<a href="index.php"><img class="top-navigation" src="./img/icon-home.png"></a>
			<span class="tooltiptext">Начало</span>
		</div>
		<div class="tooltip">
			<a href="new-expense.php"><img class="top-navigation" src="./img/icon-add.png"></a>
			<span class="tooltiptext">Нов Разход</span>
            <!-- keeping it as a reference, might decide to use it later -->
<!--            <div class="dropdown-content">-->
<!--                <a href="new-expense.php?type=fuel"><img class="top-navigation" src="./img/icon-fuel.png"></a>-->
<!--                <a href="new-expense.php?type=maintenance"><img class="top-navigation" src="./img/icon-maintenance.png"></a>-->
<!--                <a href="new-expense.php?type=insurance"><img class="top-navigation" src="./img/icon-insurance.png"></a>-->
<!--                <a href="new-expense.php?type=tax"><img class="top-navigation" src="./img/icon-tax.png"></a>-->
<!--            </div>-->
		</div>
		<div class="tooltip">
			<a href="statistics.php"><img class="top-navigation" src="./img/icon-euro.png"></a>
			<span class="tooltiptext">Статистика</span>
		</div>
		<div class="tooltip">
			<a href="profile.php"><img class="top-navigation" src="./img/icon-wheel2.png"></a>
		  <span class="tooltiptext">Профил</span>
		</div>
		<?php
			if(isset($_SESSION['user'])) {
				if ($_SESSION['user']['Group'] == "admins") {
					echo '<div class="tooltip">';
					echo '<a href="admin.php"><img class="top-navigation" src="./img/icon-admin.png"></a>';
					echo '<span class="tooltiptext">Админ панел</span>';
					echo '</div>';
				}
			}
		?>
	</div>