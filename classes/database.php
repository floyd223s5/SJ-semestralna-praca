<?php 
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'otaruembroidery';
    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection error: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
}
?>