<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/Autochat.php';

$chat = new Autochat();

/*
if ($_GET['task'] == "makebid") {

    $fr->projects("html5");
    $fr->projects("drupal");
    $fr->projects("c++");
    $fr->projects("c");
    $fr->projects("c#");
    $fr->projects("css3");
    $fr->projects("data science");
    $fr->projects("woocommerce");
    $fr->projects("shopify");
    $fr->projects("web3");
    $fr->projects("openai");
    $fr->projects("magento");
    $fr->projects("reactnative");
    $fr->projects("electonjs");
    $fr->projects("nativescript");
    $fr->projects("ChatGPT");
    $fr->projects("java");
    $fr->projects("aws");
    $fr->projects("azure");
    $fr->projects("s3");
    $fr->projects("cloud");
    $fr->projects("git");
    $fr->projects("github");
        $fr->projects("gitlab");
     $fr->projects("django");
     $fr->projects("python");
     $fr->projects("openAI");
     $fr->projects("blockchain");
     $fr->projects("wordpress");
     $fr->projects("development");
    $fr->projects("reactjs");
    $fr->projects("angularjs");
    $fr->projects("nodejs");
    $fr->projects("typescript");
    $fr->projects("bootstrap");
    $fr->projects("codeigniter");
    $fr->projects("web development");
    $fr->projects("web design");
    $fr->projects("javascript");
    $fr->projects("css");
    $fr->projects("html");
    $fr->projects("mysql");
    $fr->projects("jquery");
    $fr->projects("php");
    $fr->projects("vuejs");
    $fr->projects("codeigniter");
    $fr->projects("laravel");
    $fr->projects("jquery");
    $fr->projects("spring");
    $fr->projects("springboot");
    $fr->projects("springmvc");
    $fr->projects("nextjs");
    $fr->projects("nuxtjs");
    $fr->projects("expressjs");
    $fr->projects("restfulapi");
    $fr->projects("restapi");
    $fr->projects("graphql");
    
    


}

if($_GET['task'] == "history"){

    echo $fr->freelancer_bids_history();
}
if($_GET['task'] == "elite"){

    echo $fr->elite_projects("php");
}
if($_GET['task'] == "user"){

   echo $fr->user(45214417);
}
*/
if($_GET['task'] == "findu"){
 echo $chat->sender(279588918);
}
if($_GET['task'] == "autochat"){

    function updateThreads($oauthAccessToken) {
        function updateThreads($oauthAccessToken) {
            $url = 'https://www.freelancer.com/api/messages/0.1/threads/';
            $headers = array(
                'freelancer-oauth-v1: ' . $oauthAccessToken,
                'Content-Type: application/json'
            );
            $data = array(
                "threads[]" => [279588918,],
                "action" => "move",

            );
        
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $response = curl_exec($ch);
            curl_close($ch);
        
            return json_decode($response, true);
        }
        
        // Usage:
        $oauthAccessToken = "NRiIJt3HAjee1py2HSQymax4HUL44f";
        $response = updateThreads($oauthAccessToken);
        print_r($response);
    }        
    
}




