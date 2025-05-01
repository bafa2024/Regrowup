<!DOCTYPE html>
<html>
<head>
    <title>Create Dispute</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Create Dispute</h1>
        <form method="POST" action="submit_dispute.php">
            <div class="mb-3">
                <label for="contract_id" class="form-label">Contract ID:</label>
                <input type="text" class="form-control" id="contract_id" name="contract_id" required>
            </div>
            <div class="mb-3">
                <label for="client_id" class="form-label">Client ID:</label>
                <input type="text" class="form-control" id="client_id" name="client_id" required>
            </div>
            <div class="mb-3">
                <label for="pro_id" class="form-label">Professional ID:</label>
                <input type="text" class="form-control" id="pro_id" name="pro_id" required>
            </div>
            <div class="mb-3">
                <label for="ticket_id" class="form-label">Ticket ID:</label>
                <input type="text" class="form-control" id="ticket_id" name="ticket_id" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
