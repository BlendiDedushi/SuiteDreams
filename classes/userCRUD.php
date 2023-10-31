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

    public function getResByUserId($userId)
    {
        $stm = $this->conn->prepare('SELECT `reservation`.* FROM `reservation` INNER JOIN `user` ON user.id = reservation.user_id WHERE user.id = ?');
        $stm->execute([$userId]);
        $reservations = [];
        while ($reservation = $stm->fetch(PDO::FETCH_ASSOC)) {
            $reservations[] = $reservation;
        }
        return $reservations;
    }

    public function deleteReservation($rId)
    {
        $reservation = $this->getUserById($rId);
        if ($reservation) {
            $stm = $this->conn->prepare('DELETE FROM `reservation` WHERE `id` = ?');
            $stm->execute([$rId]);
            if ($stm->rowCount() > 0) {
                return true;
            }
        }
        return false; 
    }
}
