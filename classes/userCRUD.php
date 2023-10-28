<?php

include 'classes/database.php';

class UserCrud {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserById($userId) {
        $stm = $this->conn->prepare('SELECT * FROM `user` WHERE `id` = ?');
        $stm->execute([$userId]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    // public function getMyEstates(){
    //     $stm = $conn->prepare('SELECT estate.* FROM `estate` INNER JOIN `user` ON user.id = estate.created_by');
    //     $stm->execute();
    //     $estates = [];
    //     while($estate = $stm->fetch(PDO::FETCH_ASSOC)){
    //         $estates[] = $estate;
    //     }
    // }

    public function updateUserProfile($userId, $username, $avatar) {
        // Implement the logic to update the user's profile here
    }

    public function updatePassword($userId, $oldPassword, $newPassword) {
        // Implement the logic to update the user's password here
    }
}
