<?php
//session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/Autowork.php';


$fr = new Autowork();

//wget -O /dev/null https://wheeleder.com/api/autowork.php?task=makeautobids

//wget -O /dev/null https://wheeleder.com/api/autobid.php?task=autobid

//wget -O /dev/null https://wheeleder.com/api/autobid.php?task=check

//Write a cron job to run this script every 5 minutes

//wget -O /dev/null https://wheeleder.xyz/work/api/autowork.php?task=manybids

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


if($_GET['task'] == "fetch"){

    $fr-> fetch_all("php", 10);
}

if($_GET['task'] == "elite"){

    //$fr-> fetch_all("php", 10);
    $fr->elite_project2("php", 10);

}

if($_GET['task'] == "dt"){

    //$fr-> fetch_all("php", 10);
    $pid = $_GET['p'];
    //$fr->project_details($pid);
    $fr->elites($pid);

}



if($_GET['task'] == "filter_elite"){

    $fr-> list_elites("php", 1000);
    $fr-> list_elites("java", 1000);
    $fr-> list_elites("python", 1000);
    $fr-> list_elites("javascript", 1000);
    $fr-> list_elites("c++", 1000);
    $fr-> list_elites("c#", 1000);
    $fr-> list_elites("c", 1000);
    $fr-> list_elites("html", 1000);
    $fr-> list_elites("css", 1000);
    $fr-> list_elites("sql", 1000);
    $fr-> list_elites("ruby", 1000);
    $fr-> list_elites("swift", 1000);
    $fr-> list_elites("objective-c", 1000);
    $fr-> list_elites("reactjs", 1000);


    

    //$fr->list_elites($query, $limit);

}


if($_GET['task'] == "aw"){

    $fr-> run();
}

if($_GET['task'] == "nc"){
     
    $fr-> newthreads();
    
}