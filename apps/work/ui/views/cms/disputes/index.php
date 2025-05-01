<!DOCTYPE html>
<html>
<head>
    <title>Dispute Handling System</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Dispute Handling System</h1>
        <a href="create_dispute.php" class="btn btn-primary">Create Dispute</a>
        <hr>
        <?php
        // Fetch and display disputes
        require_once 'Database.php';
        require_once 'Dispute.php';

        $db = new Database();
        $dispute = new Dispute($db);
        $disputes = $dispute->getDisputes();

        if (!empty($disputes)) {
            echo '<table class="table">';
            echo '<thead><tr><th>ID</th><th>Contract ID</th><th>Client ID</th><th>Professional ID</th><th>Ticket ID</th><th>Status</th><th>Description</th><th>Created At</th></tr></thead>';
            echo '<tbody>';
            foreach ($disputes as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['contract_id'] . '</td>';
                echo '<td>' . $row['client_id'] . '</td>';
                echo '<td>' . $row['pro_id'] . '</td>';
                echo '<td>' . $row['ticket_id'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['created_at'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No disputes found.</p>';
        }
        ?>
    </div>
</body>
</html>
