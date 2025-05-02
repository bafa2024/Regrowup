<?php
$db = new PDO('sqlite:database.sqlite');

// Optional: set error mode to exceptions
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create a sample table
$db->exec("CREATE TABLE IF NOT EXISTS ans_data (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    questions TEXT NOT NULL,
    answers TEXT NOT NULL,
    images TEXT NOT NULL
)");

echo "Database and table ready.";
?>