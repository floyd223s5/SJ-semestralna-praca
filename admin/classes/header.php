<?php
class Header {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->ensureLoggedIn();
    }

    private function ensureLoggedIn() {
        session_start();
        if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
            header("Location: login.php");
            exit();
        }
    }

    public function handleLogout() {
        if (isset($_GET['logout'])) {
            $_SESSION = array();
            session_destroy();
            header("location: login.php");
            exit();
        }
    }

    public function getNewOrderCount() {
        $sql = "SELECT * FROM orders WHERE created_at >= NOW() - INTERVAL 12 HOUR";
        $result = $this->db->query($sql);
        return $result->num_rows;
    }

    public function getNotifications() {
        $sql = "SELECT * FROM orders WHERE created_at >= NOW() - INTERVAL 12 HOUR";
        $result = $this->db->query($sql);
        $notifications = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $notifications[] = $row;
            }
        }
        return $notifications;
    }
}
?>
