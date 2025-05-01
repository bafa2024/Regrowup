<?php

class ChatAPI
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $dbname = 'workhouse';

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->run_queryname);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function fetchChatMessages($token)
    {
        $sql = "SELECT * FROM chats WHERE token='$token' ORDER BY date_created ASC";
        $result = $this->conn->query($sql);

        $messages = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = array(
                    'sender' => $row['sender'],
                    'message' => $row['message']
                );
                $messages[] = $message;
            }
        }

        return $messages;
    }

    //create a function to fetch all chats 

    public function fetchAllChats()
    {
        $sql = 'SELECT * FROM chats ORDER BY date_created ASC';
        $result = $this->conn->query($sql);

        $messages = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = array(
                    'sender' => $row['sender'],
                    'message' => $row['message']
                );
                $messages[] = $message;
            }
        }

        return $messages;
    }

    public function saveChatMessage($sender, $destination, $message)
    {
        $token = ($sender + $destination) * 2;

        $stmt = $this->conn->prepare("INSERT INTO chats (sender, destination, token, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $sender, $destination, $token, $message);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

// Create a new instance of ChatAPI
$chatAPI = new ChatAPI();

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetchMessages') {
    $token=$_GET['token'];
    $messages = $chatAPI->fetchChatMessages($token);

    header('Content-Type: application/json');
    echo json_encode($messages);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'sendMessage') {
    $sender = $_POST['sender'];
    $destination = $_POST['destination'];
    $message = $_POST['message'];

    $success = $chatAPI->saveChatMessage($sender, $destination, $message);

    header('Content-Type: application/json');
    echo json_encode(array('success' => $success));
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetchAllChats') {
    $messages = $chatAPI->fetchAllChats();

    header('Content-Type: application/json');
    echo json_encode($messages);
}

// Close the database connection
$chatAPI->closeConnection();
?>
