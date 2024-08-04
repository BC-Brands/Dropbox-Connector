<?php

require_once "http.php";
require_once "env.php";

function generateToken(){
    $file = fopen("token.env", "r") or die("Unable to open file!");
    $refresh_token = fread($file,filesize("token.env"));
    fclose($file);

    $data = "refresh_token=". $refresh_token ."&grant_type=refresh_token&client_id=". $APP_KEY ."&client_secret=" . $APP_SECRET;

    $response = sendHTTPRequest('POST', 'https://api.dropboxapi.com/oauth2/token', array(), $data, 'TXT');

    $auth_token = $response["access_token"];

    return $auth_token;
}

?>