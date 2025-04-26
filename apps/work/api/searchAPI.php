<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/SearchController.php';
include $path.'/work/ui/layouts/nav.php';

// Instantiate the SearchController
$searchController = new SearchController();

if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    // Perform the general search using the searchAll() function
    $results = $searchController->searchUsers($searchTerm);

    // Display the search results
    if (count($results) === 0) {
        echo '<div class="container mt-5">';
        echo '<h3>No results found.</h3>';
        echo '</div>';
    } else {
        ?>
        <style>
        .profile-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>
        <div class="container mt-2">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div id="user-feed">
                <?php foreach ($results as $result): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <?php if (!empty($result['profile_image'])): ?>
                                    <img src="<?php echo $result['profile_image']; ?>" class="profile-image" alt="Profile Image">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="/work/ui/views/profile/profile.php?ui=<?php echo $result['id']; ?>">
                                            <?php echo $result['first_name'] . ' ' . $result['last_name']; ?>
                                        </a>
                                    </h5>
                                    <p class="card-text"><?php echo $result['bio']; ?></p>
                                    <p class="card-text">
                                        <small class="text-muted">Joined: <?php echo $result['date_created']; ?></small>
                                    </p>
                                    <!-- Add any other details you want to display -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>




   <?php
    }
} else {
    // No search term provided
    echo '<div class="container mt-5">';
    echo '<h3>Please provide a search term</h3>';
    echo '</div>';
}
?>
