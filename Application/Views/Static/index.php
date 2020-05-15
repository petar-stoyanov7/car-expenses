<?php
$title = "Автомобилни разходи";
?>
<div class="container">
<h3 style="background-color: red; color: white">This is an example page!</font></h3>
<div class="content">
    Wellcome to the expenses web app! What you see is an example index page. With this app you can manage, monitor and calculate
    the daily expenses of your car, you can extract detailed statistics about your car. To use the full capabilities of
    this app you need to have an account. Registering is absolutely free. For already registered users -
    you can proceed to the login.
    <div>
    End User's License agreement can be seen <a href="#" class="eula-activator">here</a>
    </div>
</div>
    <button class="site-access register-activator">Register</button>
    <button class="site-access login-activator">Login</button>
</div>
<!-- Content -->
<div class="container">
	<h3>Wellcome John Smith</h3>
    <div class="content">
        Number of cars: 2<br>
        Total spent: 7350.<br>
    </div>

</div>
<div class="container">
<h3>Cars:</h3>
    <div class="flex-wrapper">
        <div class="element">
        <h4>BMW M3 2010</h4>
        <b>Километри</b>: 80000km<br>
        <b>Похарчени:</b> 6800 лв.
        </div>

        <div class="element">
        <h4>Автомобил 2:</h4>
        Wolkswagen Golf 2001<br>
        <b>Километри:</b> 150000km<br>
        <b>Похарчени:</b> 1400 лв.
        </div>
    </div>
</div>

<div class="container">
	<h3>Последни пет:</h3>
	<table class="expenses">
		<tr>
			<th>Километри</th>
			<th>Автомобил</th>
			<th>Тип разход</th>
			<th>Стойност</th>
		</tr>
		<tr>
			<td>78950</td>
			<td>BMW M3</td>
			<td>Гориво</td>
			<td>99</td>				
		</tr>
		<tr>
			<td>148950</td>
			<td>Wolkswagen Golf</td>
			<td>Винетка</td>
			<td>97</td>
		</tr>
		<tr>
			<td>78850</td>
			<td>BMW M3</td>
			<td>Ремонт</td>
			<td>1200</td>
		</tr>
		<tr>
			<td>147800</td>
			<td>Wolkswagen Golf</td>
			<td>Застраховка</td>
			<td>100</td>
		</tr>
		<tr>
			<td>147770</td>
			<td>Wolkswagen Golf</td>
			<td>Гориво</td>
			<td>20</td>
		</tr>
	</table>
</div>
<div id="modal-eula" class="modal-lvl-1">
    <h3>End user license agreement</h3>
    <div>
        This site is mainly a proof of concept creation, intended mainly for personal usage. It has no commercial aim,
        does not share any of the stored data with third parties, and does not show advertisements.
    </div>
    <div>
        The site is completely free to use, the platform, upon which is built is Open Source and the source code can be
        seen <a href="https://github.com/petar-stoyanov7/car-expenses" target="_blank">here</a>.
    </div>
    <div>
        For general feedback, bugs, issues, or suggestion - you can contact me at <span>petar <i>dot</i> stoyanov <i>at</i> gmail.com</span>
    </div>
</div>