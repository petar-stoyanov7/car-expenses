<?php
$title = "Нова регистрация";
include("header.php");
include("top-toolbar.php");
?>
<div class="container">
<h3>Регистрация:</h3>
<br>
<form method="post" action="#">
	<label for="username">Потребителско име:</label>
	<input id="username" type="text" name="username" placeholder="...с което Влизате в системата"><br>
	<label for="password">Парола:</label>
	<input id="password" type="password" name="password" placeholder="минимум шест символа"><br>
	<label for="email">e-mail:</label>
	<input id="email" type="email" name="email" placeholder="скрит за останалите потребители"><br>
	<label for="firstname">Име:</label>
	<input id="firstname" type="text" name="firstname" placeholder="Иван"><br>
	<label for="lastname">Фамилия:</label>
	<input id="lastname" type="text" name="lastname" placeholder="Иванов"><br>
	<label for="city">Град</label>
	<input id="city" type="text" name="city" placeholder="Пловдив"><br>
	<label for="sex">Пол:</label>
	<select id="sex" name="sex">
		<option value="male">Мъж</option>
		<option value="female">Жена</option>
	</select><br>
	<label for="check">Съгласен съм с Еюлата</label>
	<input id="check" type="checkbox" name="checkbox" value="check"><br><br>
	<button type="submit">Регистрирай се</button>
</form>
</div>

<div class="container">
<h3>Еюла</h3>
<p class="eula">С настоящата регистрация се съгласявам, че личните ми данни може да бъдат използвани за лични облаги от собственика на сайта, че вероятно ще бъдат продадени на Илюминатите, че на мое име може да се регистрират дюнерджийници в Пазарджик, както и че нямам против нататък сайта да ми говори на "ти".<br><br>
Съгласен(на) съм, че сайтът може да използва данните за превозните ми средства за трафик на наркотици, за екстрадиране на бежанци, хванати от Динко от Ямбол, както и за спекулации с цените на краставиците в Каспичан.<br><br>
Сайтът използва курабии, вафли, марципани и шоколадови бонбони, богати на глутен и лишени от всякакви огризения на съвестта.<br><br>
Съгласен(на) съм, да не се приемам прекалено насериозно и да спра да споделям уловените от мен покемони в социалните мрежи и сред приятелите си.<br><br>
Също така съм съгласен(на), че сайта може да си измисли нови глупости в бъдеще, с които автоматично се съгласявам.</p>
</div>


<?php
include("footer.php");
?>