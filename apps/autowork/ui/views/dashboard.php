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
    <title>AutoWork Dashboard</title>
</head>
<body>
    <h1>AutoWork App - Dashboard</h1>
    <ul>
        <li><a href="/autowork/start">Start Auto Bidding</a></li>
        <li><a href="/autowork/settings">Settings</a></li>
    </ul>
</body>
</html>
