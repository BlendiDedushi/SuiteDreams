<?php

include 'classes/database.php';

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
}
