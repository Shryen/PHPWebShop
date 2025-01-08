<?php
require_once 'database.php';
class User extends Database
{
    public function AuthCheck()
    {
        return isset($_SESSION['name']) ? true : false;
    }
    public function GetUser()
    {
        if ($this->AuthCheck()) {
            $query = "SELECT * FROM users";
            return $this->fetch($query);
        } else {
            return null;
        }
    }
}
