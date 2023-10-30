<?php
class Database
{
    private $host;
    private $db;
    private $charset;
    private $username;

    public function __construct($host, $db, $charset, $username)
    {
        $this->host = $host;
        $this->db = $db;
        $this->charset = $charset;
        $this->username = $username;
    }

    public function connect()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        return new PDO($dsn, $this->username);
    }

}
$db = new Database('localhost', 'suitedreams_db', 'utf8mb4', 'root');
$conn = $db->connect();
?>