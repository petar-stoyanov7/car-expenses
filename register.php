<?php
ob_start();
$title = "Нова регистрация";
$auth_ignore = 1;
include("header.php");
include("top-toolbar.php");
?>
<div class="container">
<h3>Регистрация:</h3>
<br>
<form method="post" action="#">
	<label for="username">Потребителско име:</label>
	<input id="username" type="text" name="username" placeholder="трябва да е на латиница"><br>
	<label for="password1">Парола:</label>
	<input id="password1" type="password" name="password1" placeholder="минимум шест символа"><br>
	<label for="password2">Повтори парола:</label>
	<input id="password2" type="password" name="password2" placeholder="минимум шест символа"><br>
	<label for="email1">e-mail:</label>
	<input id="email1" type="email" name="email1" placeholder="скрит за останалите потребители"><br>
	<label for="email2">Повтори e-mail</label>
	<input id="email2" type="email" name="email2" placeholder="скрит за останалите потребители"><br>
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
	<label for="check">Съгласен съм с условията.</label>
	<input id="check" type="checkbox" name="checkbox" value="check"><br><br>
	<button type="submit">Регистрирай се</button>
</form>
<?php
	if(isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['email1'])) {
		if (!$_POST['checkbox']) {
			display_warning("Трябва да се съгласите с условията!");
		} else {
			$user = new User($_POST['username'],$_POST['password1'],$_POST['password2'],$_POST['email1'],$_POST['email2'],$_POST['firstname'],$_POST['lastname'],$_POST['city'],$_POST['sex']);
			$DAO = new User_DAO();
			$DAO->add_user($user);
			header("Location: index.php");			
		}
	}
?>
</div>

<div class="container">
<h3>Условия за ползване</h3>
<p class="eula">С настоящата регистрация се съгласявам, че личните ми данни може да бъдат използвани за лични облаги от собственика на сайта, че вероятно ще бъдат продадени на Илюминатите, че на мое име може да се регистрират дюнерджийници в Пазарджик, както и че нямам против нататък сайта да ми говори на "ти".<br><br>
Съгласен(на) съм, че сайтът може да използва данните за превозните ми средства за трафик на наркотици, за екстрадиране на бежанци, хванати от Динко от Ямбол, както и за спекулации с цените на краставиците в Каспичан.<br><br>
Сайтът използва курабии, вафли, марципани и шоколадови бонбони, богати на глутен и лишени от всякакви огризения на съвестта.<br><br>
Съгласен(на) съм, да не се приемам прекалено насериозно и да спра да споделям уловените от мен покемони в социалните мрежи и сред приятелите си.<br><br>
</div>


<?php
include("footer.php");
ob_end_flush();
?>