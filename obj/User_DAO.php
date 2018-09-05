<?php
	require_once("functions.php");
	class User_DAO {
		private $connection;
		/* user class:
		__construct($username,$password,$email,$fname,$lname,$city,$sex,$group="users",$notes="")
		*/
		public function __construct() {
			$this->connection = new database_connection();
		}

		public function list_users() {
			$array = $this->connection->get_data_from_database("SELECT * FROM `Users`");
			return $array;
		}

		public function get_user_by_id($id) {
			$user = $this->connection->get_data_from_database("SELECT * FROM `Users` WHERE `ID` = ".$id);
			return $user[0];
		}

		public function get_user_by_name($username) {
			$user_array = $this->connection->get_data_from_database("SELECT * FROM `Users` WHERE `Username` = '".$username."'");
			return $user_array[0];
		}

		public function start_session($username) {
			$array = $this->get_user_by_name($username);
			$_SESSION['user'] = $array;
		}

		public function add_user($user) {
			$users = $this->list_users();
			if (empty($user->get_property("username"))) {
				return display_warning("Не е въведено потребителско име!");
			} elseif ($user->get_property("password1") != $user->get_property("password2")) {
				return display_warning("Паролите не съвпадат");
			} elseif ($user->get_property("email1") != $user->get_property("email2")) {
				return display_warning("E-mail адресите не съвпадат!");
			} elseif (empty($user->get_property("password1"))) {
				return display_warning("Не е въведена парола!");
			} elseif (strlen($user->get_property("password1")) < 6) {
				return display_warning("Паролата е под шест символа!");
			} elseif (empty($user->get_property("email1"))) {
				return display_warning("Не е въведен e-mail адрес!");
			}
			foreach ($users as $usr) {
				if ($user->get_property("username")==$usr["Username"]) {
					return display_warning("Потребитеят съществува!");
				} elseif ($user->get_property("email1")==$usr["Email"]) {
					return display_warning("Този e-mail се използва от друг потребител!");
				}
			}
			$query = "INSERT INTO `Users` (`Username`,`Password`,`Group`,`Email`,`Fname`,`Lname`,`City`,`Sex`,`Notes`)
			VALUES ('".$user->get_property("username")."', 
					'".password_hash($user->get_property("password1"), PASSWORD_DEFAULT)."',
					'".$user->get_property("group")."',
					'".$user->get_property("email1")."',
					'".$user->get_property("fname")."',
					'".$user->get_property("lname")."',
					'".$user->get_property("city")."',
					'".$user->get_property("sex")."',
					'".$user->get_property("notes")."'
					)";
			$this->connection->execute_sql_query($query);
			echo "<a href=login.php>";
			display_warning("Регистрацията е успешна! Може да влезнете с потребителското си име");
			echo "</a>";
		}

		public function edit_user($user,$post,$auth=0) {
			$user_array = $this->get_user_by_name($user->get_property("username"));
			if (empty($user->get_property("password1"))) {
				return display_warning("Паролата е празна");
			} 
			if ($this->login($user) || $auth!=0) {
				if ($post['password1'] != $post['password2']) {
					return display_warning("Паролите не съвпадат");
				} elseif (empty($post['password1'])) {
					$post['password1'] = $user->get_property("password1");
					$query = "UPDATE `Users` SET `Fname` = '".$post['fname']."', 
											`Lname` = '".$post['lname']."',
											`City` = '".$post['city']."'
										WHERE `ID` = ".$user_array['ID'];
					$this->connection->execute_sql_query($query);
					$_SESSION['Fname'] = $post['fname'];
					$_SESSION['Lname'] = $post['lname'];
					$_SESSION['City'] = $post['city'];
					header("refresh:5;url=logout.php");
					echo "<a href='logout.php'>";
					display_warning("Данните са променени успешно. Влезте повторно в профила си, за да бъдат активни");
					echo "</a>";
				} elseif (!empty($post['password1']) && strlen($post['password1']) < 6) {
					return display_warning("Паролата е под шест символа!");
				} else {
					$query = "UPDATE `Users` SET `Fname` = '".$post['fname']."', 
											`Lname` = '".$post['lname']."',
											`City` = '".$post['city']."',
											`Password` = '".password_hash($post['password1'], PASSWORD_DEFAULT)."'
											WHERE `ID` = ".$user_array['ID'];
					$this->connection->execute_sql_query($query);
					$_SESSION['Fname'] = $post['fname'];
					$_SESSION['Lname'] = $post['lname'];
					$_SESSION['City'] = $post['city'];
					header("refresh:5;url=profile.php");
					echo "<a href='logout.php'>";
					display_warning("Данните са променени успешно. Влезте повторно в профила си, за да бъдат активни");
					echo "</a>";
				}
			} else {
				return display_warning("Некоректна парола!");
			}
		}

		public function login($user) {
			$users = $this->list_users();
			foreach ($users as $usr) {
				if($user->get_property("username") == $usr["Username"] && password_verify($user->get_property("password1"), $usr["Password"])) {
					$this->start_session($user->get_property("username"));
					return true;
				}
			}
			return false;
		}

		public function remove_user($id) {
			$expense_dao = new Expense_DAO();
			$tables = $expense_dao->get_table_list();
			$user = "DELETE FROM `Users` WHERE `ID`=".$id;
			$cars = "DELETE FROM `Cars` WHERE `UID` =".$id;
			foreach ($tables as $table) {
				$query = "DELETE FROM `".$table."` WHERE `UID` = ".$id;
				$this->connection->execute_sql_query($query);
			}
			$this->connection->execute_sql_query($user);
			$this->connection->execute_sql_query($cars);
		}
	}
?>