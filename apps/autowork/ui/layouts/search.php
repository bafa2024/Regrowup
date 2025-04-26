<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Search</h1>
        <form action="/api/searchAPI.php" method="GET">
            <div class="mb-3">
                <input type="text" class="form-control" name="searchTerm" placeholder="Enter your search term">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div id="searchResults"></div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
