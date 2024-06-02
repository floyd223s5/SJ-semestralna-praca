<?php
session_start();

require_once 'database.php';

class LoginProcessor {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function processLogin($username, $password) {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['loggedin'] = true;
                header("location: ../orders.php");
                exit();
            } else {
                echo "The password you entered was not valid.";
            }
        } else {
            echo "No account found with that username.";
        }

        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $loginProcessor = new LoginProcessor($db);
    $loginProcessor->processLogin($_POST['username'], $_POST['password']);
    $db->close();
} else {
    header("location: login.php");
}
?>
