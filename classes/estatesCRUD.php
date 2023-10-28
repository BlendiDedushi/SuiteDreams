<?php

include 'classes/database.php';

class EstatesCrud {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllEstates() {
        $stm = $this->conn->prepare('SELECT * FROM `estate`');
        $stm->execute();
        $estates = [];
        while ($estate = $stm->fetch(PDO::FETCH_ASSOC)) {
            $estates[] = $estate;
        }
        return $estates;
    }

    public function getAverageRatingForEstate($estateId) {
        $stm = $this->conn->prepare('SELECT avg(rating.rate) AS `avgrate` FROM `rating` INNER JOIN `user` ON user.id = rating.user_id INNER JOIN `estate` ON estate.id = rating.estate_id WHERE estate.id = ?');
        $stm->execute([$estateId]);
        $rate = $stm->fetch(PDO::FETCH_ASSOC);
        return $rate['avgrate'];
    }
}
