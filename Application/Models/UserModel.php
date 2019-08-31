<?php

namespace Application\Models;

use Application\Classes\User;
use Application\Models\ExpenseModel;

class UserModel extends DbModelAbstract
{
    public function list_users() {
        $array = $this->getData("SELECT * FROM `Users`");
        return $array;
    }

    public function get_user_by_id($id) {
        $user = $this->getData("SELECT * FROM `Users` WHERE `ID` = ".$id);
        return $user[0];
    }

    public function get_user_by_name($username) {
        $user_array = $this->getData("SELECT * FROM `Users` WHERE `Username` = '".$username."'");
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
        $this->execute($query);
        echo "<a href='/account/login'>";
        display_success("Регистрацията е успешна! Може да влезнете с потребителското си име");
        echo "</a>";
    }

    public function edit_user($user,$post,$auth=0) {
        $userArray = $this->get_user_by_name($post['user']);
        if (empty($user->get_property("password1"))) {
            return display_warning("Паролата е празна");
        }        
        if ($this->login($user, true) || $auth !== 0) {
            $query = "UPDATE `Users` SET ";
            $values = [];
            if (!empty($post['password1']) && !empty($post['password2'])) {
                if ($post['password1'] !== $post['password2']) {
                    display_warning("Паролите не съвпадат! Запазва се старата");
                    $post['passworc1'] = $user->get_property('password1');
                } else {
                    $query .= "`Password` = ?";
                    $values[] = password_hash($post['password1'], PASSWORD_DEFAULT);
                }
            } else {
                $post['passworc1'] = $user->get_property('password1');
            }
            $oldSession = $_SESSION;

            if (!empty($post['fname'])) {
                $query .= "`Fname` = ?, ";
                $values[] = $post['fname'];
                $_SESSION['Fname'] = $post['fname'];
            }

            if (!empty($post['lname'])) {
                $query .= "`Lname` = ?, ";
                $values[] = $post['lname'];
                $_SESSION['Lname'] = $post['lname'];
            }

            if (!empty($post['city'])) {
                $query .= "`City` = ?, ";
                $values[] = $post['city'];
                $_SESSION['City'] = $post['city'];
            }
            $query = rtrim($query, ', ');
            $query .= " WHERE `ID` = ? ";
            $values[] = $userArray['ID'];

            echo $query;
            
            $this->execute($query, $values);

            if ($_SESSION !== $oldSession) {
                session_start();
            }
        } else {
            return display_warning("Некоректна парола!");
        }
    }

    public function login($user, $justPasswordCheck = false) {
        $users = $this->list_users();
        foreach ($users as $usr) {
            if($user->get_property("username") === $usr["Username"] && password_verify($user->get_property("password1"), $usr["Password"])) {
                if (!$justPasswordCheck) {
                    $this->start_session($user->get_property("username"));
                }
                return true;
            }
        }
        return false;
    }

    public function remove_user($id) {
        $expenseModel = new ExpenseModel();
        $tables = $expenseModel->get_table_list();
        $query = "DELETE FROM `Users` WHERE `ID` = ?";
        $this->execute($query, [$id]);
    }
}

?>