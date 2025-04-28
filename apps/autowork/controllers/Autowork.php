<?php

// Include necessary files for database connection and logging
include 'DbConnection.php';
include 'DbController.php';  // Assuming this handles table creation, if needed

class Autowork {
    private $db;

    // API Rate Limiting settings
    private $rateLimit = 5; // Max number of API calls per minute
    private $rateLimitWindow = 60; // Time window in seconds for rate limiting
    private $lastApiCallTime = 0;

    public function __construct() {
        $this->db = new DbConnection(); // Assuming DbConnection handles PDO
    }

    // Enhanced log function to store logs in /logs directory
    private function log($message) {
        $logDir = $_SERVER['DOCUMENT_ROOT'] . '/logs/';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true); // Create directory if it doesn't exist
        }

        $logFile = $logDir . 'autowork_log.txt';
        $currentTime = date("Y-m-d H:i:s");
        file_put_contents($logFile, "[$currentTime] $message\n", FILE_APPEND);
    }

    // Enhanced check for existing project in the 'projects' table
    public function checkStoredProjects($projectId, $table = "projects") {
        $sql = "SELECT COUNT(*) FROM $table WHERE project_id = :project_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
        $stmt->execute();

        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    // Method to store a single project
    public function storeProjects($projectId, $client_id, $status, $link, $max_bg, $min_bg, $type, $wproject) {
        try {
            // Check if the project already exists
            if ($this->checkStoredProjects($projectId)) {
                throw new Exception("Project with ID $projectId already exists in the database.");
            }

            // Prepare the SQL statement to insert project data into the 'projects' table
            $sql = "INSERT INTO projects (project_id, client_id, status, link, max_budget, min_budget, type, whole_project)
                    VALUES (:project_id, :client_id, :status, :link, :max_bg, :min_bg, :type, :wproject)";
            $stmt = $this->db->pdo->prepare($sql);

            // Bind the parameters
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
            $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':link', $link, PDO::PARAM_STR);
            $stmt->bindParam(':max_bg', $max_bg, PDO::PARAM_STR);
            $stmt->bindParam(':min_bg', $min_bg, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':wproject', $wproject, PDO::PARAM_STR); // Assuming $wproject is a JSON string

            // Execute the statement
            if ($stmt->execute()) {
                $this->log("Project ID {$projectId} stored successfully.");
                return true;
            } else {
                throw new Exception("Failed to store project ID $projectId.");
            }
        } catch (Exception $e) {
            // Log the error message
            $this->log("Error storing project ID {$projectId}: " . $e->getMessage());
            return false;
        }
    }

    // Method to store multiple projects using a bulk insert
    public function storeMultipleProjects($projects) {
        $pdo = $this->db->pdo;

        // Start a database transaction to ensure atomicity
        $pdo->beginTransaction();

        try {
            // Prepare the SQL statement for bulk insert
            $sql = "INSERT INTO projects (project_id, client_id, status, link, max_budget, min_budget, type, whole_project)
                    VALUES (:project_id, :client_id, :status, :link, :max_bg, :min_bg, :type, :wproject)";
            $stmt = $pdo->prepare($sql);

            // Loop through each project and insert
            foreach ($projects as $project) {
                // Bind parameters for each project
                $stmt->bindParam(':project_id', $project['project_id'], PDO::PARAM_INT);
                $stmt->bindParam(':client_id', $project['client_id'], PDO::PARAM_INT);
                $stmt->bindParam(':status', $project['status'], PDO::PARAM_STR);
                $stmt->bindParam(':link', $project['link'], PDO::PARAM_STR);
                $stmt->bindParam(':max_bg', $project['max_bg'], PDO::PARAM_STR);
                $stmt->bindParam(':min_bg', $project['min_bg'], PDO::PARAM_STR);
                $stmt->bindParam(':type', $project['type'], PDO::PARAM_STR);
                $stmt->bindParam(':wproject', $project['wproject'], PDO::PARAM_STR); // Assuming $wproject is a JSON string

                // Execute for each project
                $stmt->execute();
            }

            // Commit the transaction if all inserts are successful
            $pdo->commit();

            $this->log("Successfully stored multiple projects.");
            return true;
        } catch (Exception $e) {
            // Rollback the transaction if any error occurs
            $pdo->rollBack();

            // Log the error
            $this->log("Error storing multiple projects: " . $e->getMessage());
            return false;
        }
    }

    // Sample method to fetch and store multiple projects (example use case)
    public function fetchAndStoreProjects($apiUrl) {
        // Fetch projects data from the API
        $projectsData = $this->fetchProjectsFromAPI($apiUrl);

        if ($projectsData && count($projectsData) > 0) {
            return $this->storeMultipleProjects($projectsData); // Store in bulk
        }

        return false;
    }

    // Sample method to simulate API fetching (replace with actual API fetching logic)
    private function fetchProjectsFromAPI($url) {
        // Simulate fetching data from an API
        // You can replace this with actual API calling logic (e.g., cURL)
        return [
            [
                'project_id' => 101,
                'client_id' => 1,
                'status' => 'active',
                'link' => 'http://example.com/project/101',
                'max_bg' => 5000,
                'min_bg' => 1000,
                'type' => 'fixed',
                'wproject' => json_encode(['details' => 'Some details'])
            ],
            // More projects
        ];
    }
}
?>
