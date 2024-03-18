<?php
require_once 'Controller.php';

class StatisticsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
{
    // Retrieve data from the database and perform necessary calculations

    // Example: Get total number of users
    $totalUsersResult = $this->run_query->query("SELECT COUNT(*) as total FROM users");
    $totalUsersRow = $totalUsersResult->fetch_assoc();
    $totalUsers = $totalUsersRow['total'];

    // Example: Get total number of deposits
    $totalDepositsResult = $this->run_query->query("SELECT COUNT(*) as total FROM deposits");
    $totalDepositsRow = $totalDepositsResult->fetch_assoc();
    $totalDeposits = $totalDepositsRow['total'];

    // Example: Get total number of contracts
    $totalContractsResult = $this->run_query->query("SELECT COUNT(*) as total FROM contracts");
    $totalContractsRow = $totalContractsResult->fetch_assoc();
    $totalContracts = $totalContractsRow['total'];

    // Return the results as an array
    return [
        'totalUsers' => $totalUsers,
        'totalDeposits' => $totalDeposits,
        'totalContracts' => $totalContracts
    ];
}


}
