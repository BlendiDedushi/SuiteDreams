<?php
include 'Database.php';

class CRUD{
    public function __construct(){
        $db = new Database('localhost', 'suitedreams_db', 'utf8mb4', 'root', 'blendi123');
        $conn = $db -> connect();
    }
}
?>
