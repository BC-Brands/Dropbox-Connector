<?php

// This is the Redirect endpoint for dropbox.
require_once "http.php";
require_once "env.php";

if (isset($_GET["code"])){
    // Get the OAuth Code
    $code = htmlspecialchars($_GET["code"]);

    $data = "code=". $code ."&grant_type=authorization_code&client_id=". $APP_KEY ."&client_secret=" . $APP_SECRET . "&redirect_uri=" . $PATH_TO_DIR . "/auth.php";

    // Generate a Refresh Token
    $response = sendHTTPRequest('POST', 'https://api.dropboxapi.com/oauth2/token', array(), $data, 'TXT');

    $responseJSON = json_decode($response);

    $refresh_token = $responseJSON->refresh_token;

    // Save to file
    $file = fopen("token.env", "w") or die("Unable to open file!");
    fwrite($file, $refresh_token);
    fclose($file);
    
    echo "<p>Authentication Successful.</p>";
} else {
    // Auth unsuccessful
    echo "<p>Authentication Unsuccessful.</p>";
}

?>