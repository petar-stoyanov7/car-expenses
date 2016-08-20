<?php
	class User {
		private $username;
		private $password1;
		private $password2;
		private $email1;
		private $email2;
		private $fname;
		private $lname;
		private $city;
		private $sex;
		private $notes;		
		private $group;

		public function __construct($username,$password1,$password2="",$email1="",$email2="",$fname="",$lname="",$city="",$sex="",$group="users",$notes="") {
			$this->username = sanitize($username);
			$this->password1 = $password1;
			$this->password2 = $password2;
			$this->email1 = sanitize($email1,1);
			$this->email2 = sanitize($email2,1);
			$this->fname = sanitize($fname);
			$this->lname = sanitize($lname);
			$this->city = sanitize($city);
			$this->sex = $sex;
			$this->group = $group;
			$this->notes = sanitize($notes,1);
		}

		public function get_property($property) {
			if (property_exists('User', $property)) {
				return $this->$property;
			} else {
				die("Non existent property");
			}
		}

		//debugger
		public function say_hello() {
			echo "<br>Helo from ".$this->fname." ".$this->lname."!";
			echo "<br>I am from ".$this->city." and I am ".$this->sex."!";
			echo "<br>My e-mail is ".$this->email1." .<br>";
		}
	}
?>