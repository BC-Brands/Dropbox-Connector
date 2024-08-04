<?php
// HTTP Request

function sendHTTPRequest($type, $path, $headers, $data){
    //Send HTTP Curl Request
    $c = curl_init($path);

    curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, $type);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    // Request Body
    if ($data == null) {
        $jsonData = json_encode($data);
        curl_setopt($c, CURLOPT_POSTFIELDS, $jsonData);
    }

    $response = curl_exec($c);
    curl_close($c);

    // Return response
    return $response; 
}
?>