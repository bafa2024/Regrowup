<?php
class Dispute {
    private $db;

    public function __construct($db) {
        $this->run_query = $db;
    }

    public function createDispute($contractId, $clientID, $proID, $ticketId, $description) {
        // Implement dispute creation logic

        // Example: Inserting dispute into the "disputes" table
        $sql = "INSERT INTO disputes (contract_id, client_id, pro_id, ticket_id, description) VALUES ('$contractId', '$clientID', '$proID', '$ticketId', '$description')";
        if ($this->run_query->query($sql) === TRUE) {
            echo "Dispute created successfully";
        } else {
            echo "Error creating dispute: " . $this->run_query->error;
        }
    }

    public function getDisputes() {
        // Implement retrieving disputes logic

        // Example: Fetching disputes from the "disputes" table
        $sql = "SELECT * FROM disputes";
        $result = $this->run_query($sql);
        $disputes = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $disputes[] = $row;
            }
        }
        return $disputes;
    }

    // Other dispute-related methods
}
?>
