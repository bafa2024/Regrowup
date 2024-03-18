<?php
header('Content-Type: application/json');
// Connect to the database
$host = 'localhost';
$db = 'workhouse';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Handle the API requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve all work logs
    $stmt = $pdo->query("SELECT * FROM work_log ORDER BY date DESC");
    $workLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($workLogs);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new work log
    $data = json_decode(file_get_contents('php://input'), true);
    $date = $data['date'];
    $hoursWorked = $data['hoursWorked'];
    $description = $data['description'];

    $stmt = $pdo->prepare("INSERT INTO work_log (date, hours_worked, description) VALUES (?, ?, ?)");
    $stmt->execute([$date, $hoursWorked, $description]);
    echo json_encode(['message' => 'Work log added successfully']);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>
