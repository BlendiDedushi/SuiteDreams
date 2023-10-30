<?php

require_once 'classes/database.php';

class UserCrud
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserById($userId)
    {
        $stm = $this->conn->prepare('SELECT * FROM `user` WHERE `id` = ?');
        $stm->execute([$userId]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllUsers()
    {
        $stm = $this->conn->prepare('SELECT * FROM `user`');
        $stm->execute();
        $users = [];
        while ($user = $stm->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $user;
        }
        return $users;
    }
    public function deleteUser($userId)
    {
        $user = $this->getUserById($userId);
        if ($user) {
            $stm = $this->conn->prepare('DELETE FROM `user` WHERE `id` = ?');
            $stm->execute([$userId]);
            if ($stm->rowCount() > 0) {
                return true;
            }
        }
        return false; 
    }
}
