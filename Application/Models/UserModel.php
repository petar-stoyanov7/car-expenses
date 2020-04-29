<?php

namespace Application\Models;

use Application\Classes\User;
use Application\Models\ExpenseModel;
use Core\DbModelAbstract;
use Exception;

class UserModel extends DbModelAbstract
{
    public function listUsers()
    {
        $array = $this->getData("SELECT * FROM `Users`");
        return $array;
    }

    public function getUserByUserId($id)
    {
        $user = $this->getData("SELECT * FROM `Users` WHERE `ID` = ".$id);
        return $user[0];
    }

    public function getUserByUsername($username)
    {
        $user_array = $this->getData("SELECT * FROM `Users` WHERE `Username` = '".$username."'");
        return $user_array[0];
    }

    public function startSession($username)
    {
        $array = $this->getUserByUsername($username);
        $_SESSION['user'] = $array;
    }

    public function addUser($User)
    {
        $users = $this->listUsers();
        foreach ($users as $user) {
            if ($User->getProperty("username") === $user["Username"]) {
                throw new Exception('User already exists');
            } elseif ($User->getProperty("email1") === $user["Email"]) {
                throw new Exception('Email is already in use ');
            }
        }
        $query = "INSERT INTO `Users` (`Username`,`Password`,`Group`,`Email`,`Fname`,`Lname`,`City`,`Sex`,`Notes`)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values = [
            $User->getProperty("username"),
            password_hash($User->getProperty("password1"), PASSWORD_DEFAULT),
            $User->getProperty("group"),
            $User->getProperty("email1"),
            $User->getProperty("fname"),
            $User->getProperty("lname"),
            $User->getProperty("city"),
            $User->getProperty("sex"),
            $User->getProperty("notes"),
        ];
        $this->execute($query, $values);
        return true;
    }

    public function editUser($user, $post, $auth=0)
    {
        $userArray = $this->getUserByUsername($user->getProperty('username'));
        if ($this->login($user, true) || $auth !== 0) {
            $query = 'UPDATE Users SET Fname = ?, Lname = ?, City = ?,';

            $values = [
                $post['firstname'],
                $post['lastname'],
                $post['city'],
            ];
            if (!empty($post['password1']) && !empty($post['password2'])) {
                if ($post['password1'] !== $post['password2']) {
                    return false;
                }
                $query .= ' ` Password` = ?,';
                $values[] = password_hash($post['password1'], PASSWORD_DEFAULT);
            }
            $oldSession = $_SESSION;

            $query = rtrim($query, ',');
            $query .= ' WHERE `ID` = ?';
            $values[] = $userArray['ID'];
            
            $this->execute($query, $values);

            if ($_SESSION !== $oldSession) {
                session_start();
            }
        } else {
            return false;
        }
    }

    public function login($user, $justPasswordCheck = false)
    {
        $users = $this->listUsers();
        foreach ($users as $usr) {
            if($user->getProperty("username") === $usr["Username"] && password_verify($user->getProperty("password1"), $usr["Password"])) {
                if (!$justPasswordCheck) {
                    $this->startSession($user->getProperty("username"));
                }
                return true;
            }
        }
        return false;
    }

    public function remove_user($id)
    {
        $expenseModel = new ExpenseModel();
        $tables = $expenseModel->getTableList();
        $query = "DELETE FROM `Users` WHERE `ID` = ?";
        $this->execute($query, [$id]);
    }
}

?>