<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

define('OPENAI_API_ENDPOINT', 'https://api.openai.com/v1/chat/completions');
define('OPENAI_API_KEY', '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');  // Replace 'YOUR_OPENAI_API_KEY' with your actual API key

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);
    $userInput = $input['userInput'];

    $data = [
        'model' => 'gpt-3.5-turbo-16k-0613',
        'messages' => [
            [
                'role' => 'user',
                'content' => $userInput
            ]
        ],
        'temperature' => 1,
        'max_tokens' => 2000,
        'top_p' => 1,
        'frequency_penalty' => 0,
        'presence_penalty' => 0
    ];

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . OPENAI_API_KEY
    ];

    $ch = curl_init(OPENAI_API_ENDPOINT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => curl_error($ch)]);
        exit();
    }

    curl_close($ch);
    echo $response;
}
