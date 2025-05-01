<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/ExternalProjects.php';
$bid = new Bidding();

$bid->checkSessionAndRedirect();

include $path.'/apps/work/ui/layouts/nav.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AutoWork Settings</title>
</head>
<body>
    <h1>Settings Page</h1>
    <p>Coming soon: Configure API keys, preferences, etc.</p>
</body>
</html>
