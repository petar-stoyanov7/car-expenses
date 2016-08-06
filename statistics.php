<?php
$title = "Статистика";
include("header.php");
include("top-toolbar.php");
?>
<div class="container">
	<h3>Статистика за период:</h3>
	<form>		
		<label for="car">Автомобил</label>
		<select id="car" name="car">
			<option value="all">Всички</option>
			<option value="bmw">BMW M3</option>
			<option value="wv">Wolkswagen Golf</option>		
		</select><br>
		<label for="from">От дата</label>
		<input id="from" type="date" name="from"><br>
		<label for="to">До дата</label>
		<input id="to" type="date" name="to"><br>
		<label for="expense-type">Тип разход</label>
		<select id="expense-type" name="expense-type">
			<option value="all">Всички</option>
			<option value="fuel">Гориво</option>
			<option value="vignette">Винетка</option>
			<option value="insurance">Застраховка</option>
			<option value="maintenance">Ремонт</option>
		</select><br>
	</form>
</div>
<div class="container">
	<h3>Общо:</h3>
	<div class="element">
		<b>Автомобил:</b> Всички
		<br>
		<b>Изминати километри:</b> 25000км.
		<br>
		<b>Похарчени:</b> 2500лв.
		<br>
		<b>Лв/Км:</b> 0.35
	</div>
	<div class="element">
		<b>Гориво:</b> 1500лв
		<br>
		<b>Ремонти:</b> 500лв
		<br>
		<b>Застраховки:</b> 300лв.
		<br>
		<b>Други:</b> 200лв
	</div>
</div>
<div class="container">
<h3>Детайлна статистика</h3>
	<table class="expenses">
		<tr>
			<th>Километри</th>
			<th>Дата</th>
			<th>Автомобил</th>
			<th>Тип разход</th>
			<th>Литри:</th>
			<th>Стойност</th>
			<th>Допълнителна информация</th>
		</tr>
		<tr>
			<a href="#">
			<td><a href="#">78950</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Гориво</td>
			<td>40</td>
			<td>99</td>
			</a>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">148950</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Винетка</td>
			<td></td>
			<td>97</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">78850</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Ремонт</td>
			<td></td>
			<td>1200</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">147800</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Застраховка</td>
			<td></td>
			<td>100</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">147770</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Гориво</td>
			<td>25</td>
			<td>20</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href=#>78950</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Гориво</td>
			<td>40</td>
			<td>99</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<a href="#">
			<td><a href="#">78950</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Гориво</td>
			<td>40</td>
			<td>99</td>
			</a>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">148950</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Винетка</td>
			<td></td>
			<td>97</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">78850</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Ремонт</td>
			<td></td>
			<td>1200</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">147800</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Застраховка</td>
			<td></td>
			<td>100</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">147770</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Гориво</td>
			<td>25</td>
			<td>20</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href=#>78950</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Гориво</td>
			<td>40</td>
			<td>99</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<a href="#">
			<td><a href="#">78950</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Гориво</td>
			<td>40</td>
			<td>99</td>
			</a>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">148950</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Винетка</td>
			<td></td>
			<td>97</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">78850</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Ремонт</td>
			<td></td>
			<td>1200</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">147800</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Застраховка</td>
			<td></td>
			<td>100</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href="#">147770</a></td>
			<td>13.31.2016</td>
			<td>Wolkswagen Golf</td>
			<td>Гориво</td>
			<td>25</td>
			<td>20</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
		<tr>
			<td><a href=#>78950</a></td>
			<td>13.31.2016</td>
			<td>BMW M3</td>
			<td>Гориво</td>
			<td>40</td>
			<td>99</td>
			<td>Lorem ipsum dolor sit amet...</td>
		</tr>
	</table>
</div>
<?php
include("footer.php");
?>