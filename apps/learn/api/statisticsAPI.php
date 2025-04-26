<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/StatisticsController.php';

$statistics = new StatisticsController();
$statistics->authCheck();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

// Perform API logic here
$statisticsData = $statistics->index();
$totalUsers = $statisticsData['totalUsers'];
$totalDeposits = $statisticsData['totalDeposits'];
$totalContracts = $statisticsData['totalContracts'];

$response = [
    'totalUsers' => $totalUsers,
    'totalDeposits' => $totalDeposits,
    'totalContracts' => $totalContracts
];

echo json_encode($response);
?>
