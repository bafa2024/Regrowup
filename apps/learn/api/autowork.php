<?php
//session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/ExternalProjects.php';


$fr = new Bidding();

//wget -O /dev/null https://wheeleder.com/api/autowork.php?task=makeautobids

//wget -O /dev/null https://wheeleder.com/api/autobid.php?task=autobid

//wget -O /dev/null https://wheeleder.com/api/autobid.php?task=check

//Write a cron job to run this script every 5 minutes

//wget -O /dev/null https://wheeleder.xyz/apps/work/api/autowork.php?task=manybids

header('Content-Type: application/json'); // Set the header to return JSON

if ($_GET['task'] == "mbid") {
    $pid = $_GET['p'];

    if ($fr->bidOnProject($pid)) {
        $response = [
            'status' => 200,
            'message' => 'Bid successfully placed',
            'data' => [
                'bid_id' => $pid // Assuming $pid is the bid ID, replace as necessary
            ]
        ];
    } else {
        $response = [
            'status' => 400,
            'message' => 'Failed to place bid',
            'error' => 'An unknown error occurred' // You can replace this with a specific error message
        ];
    }

    echo json_encode($response);
}

if($_GET['task'] == "manybids"){

    $fr-> multibids();
}



if($_GET['task'] == "aw"){

    $fr-> run();
}


if($_GET['task'] == "chats"){

    $fr-> run();
}


