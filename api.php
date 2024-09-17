<?php
// Groq API URL

if (isset($_GET['role']) && isset($_GET['prompt']) && $_GET['prompt'] != '' && $_GET['role'] != '') 
{
$url = "https://api.groq.com/openai/v1/chat/completions";

// The secret key (replace with your actual secret key)
$api_key = "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";

// The data you want to send in JSON format
$data = [
    "messages" => [
        [
            "role" => "system",
            // "content" => "You are my best friend. Please respond like a friendly and supportive companion."
               "content" =>$_GET["role"]
        ],
        [
            "role" => "user",
            // "content" => "Explain the importance of fast language models"
            "content" =>$_GET["prompt"]
        ]
    ],
    "model" => "llama3-8b-8192"
];

// Initialize cURL session
$curl = curl_init($url);

// Set cURL options
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $api_key",
    "Content-Type: application/json"
]);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

// Execute cURL request
$response = curl_exec($curl);

// Check for cURL errors
if ($response === false) {
    $error = curl_error($curl);
    curl_close($curl);
    die('Curl error: ' . $error);
}

// Close the cURL session
curl_close($curl);

// Decode the JSON response
$responseData = json_decode($response, true);

// Output the response in JSON format
header('Content-Type: application/json');
echo json_encode($responseData, JSON_PRETTY_PRINT);
}
 else {
    // echo "SOMETHING WRONG"; // Invalid usage
    echo json_encode(['error' => 'Invalid input']);

}
?>


