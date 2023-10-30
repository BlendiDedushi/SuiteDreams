<?php

require_once 'classes/database.php';

class EstatesCrud
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getEstateById($estateId)
    {
        $stm = $this->conn->prepare('SELECT * FROM `estate` WHERE `id` = ?');
        $stm->execute([$estateId]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    public function getEstatesByUserId($userId)
    {
        $stm = $this->conn->prepare('SELECT `estate`.* FROM `estate` INNER JOIN `user` ON user.id = estate.created_by WHERE user.id = ?');
        $stm->execute([$userId]);
        $estates = [];
        while ($estate = $stm->fetch(PDO::FETCH_ASSOC)) {
            $estates[] = $estate;
        }
        return $estates;
    }
    public function getAllEstates()
    {
        $stm = $this->conn->prepare('SELECT * FROM `estate`');
        $stm->execute();
        $estates = [];
        while ($estate = $stm->fetch(PDO::FETCH_ASSOC)) {
            $estates[] = $estate;
        }
        return $estates;
    }

    public function getAllImages($estateId)
    {
        $stm = $this->conn->prepare('SELECT `image`.* FROM `image`
        INNER JOIN `estate` ON `estate`.id = `image`.estate_id
        WHERE `estate`.id = ?');
        $stm->execute([$estateId]);
        $images = [];
        while ($image = $stm->fetch(PDO::FETCH_ASSOC)) {
            $images[] = $image;
        }
        return $images;
    }

    public function getAverageRatingForEstate($estateId)
    {
        $stm = $this->conn->prepare('SELECT avg(rating.rate) AS `avgrate` FROM `rating` INNER JOIN `user` ON user.id = rating.user_id INNER JOIN `estate` ON estate.id = rating.estate_id WHERE estate.id = ?');
        $stm->execute([$estateId]);
        $rate = $stm->fetch(PDO::FETCH_ASSOC);
        return $rate['avgrate'];
    }

    public function deleteEstate($estateId)
    {
        $stm = $this->conn->prepare('DELETE FROM `estate` WHERE `id` = ?');
        $stm->execute([$estateId]);
        if ($stm->rowCount() > 0) {
            return true;
        }
        return false;
    }
}
