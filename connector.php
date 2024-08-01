<?php

class DropboxConnector{
    // Class variables
    private $accesstoken;
    private $uploadURL;

    // Construct the class
    function __construct($accesstoken) {
        $this->accesstoken = $accesstoken;
        $this->uploadURL = "https://content.dropboxapi.com/2/files/download";
        $this->listURL = "https://api.dropboxapi.com/2/files/list_folder";
    }

    // Scripts to send a HTTP request.
    function getRequest($path, $args, $data){
        // Encode the request in JSON
        $jsonObj = json_encode($args);

        // Set headers and bearer token
        $headers = $args;
        array_push($headers, "Authorization: Bearer " . $this->accesstoken);

        var_dump($headers);

        //Send HTTP Curl Request
        $c = curl_init($path);

        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        // Request Body
        if (count($data) != 0) {
            $jsonData = json_encode($data);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        }

        $response = curl_exec($c);
        curl_close($c);

        // Return response
        return $response;   
    }

    // Scripts to list files in a dropbox folder
    function listFiles($path){
        // Request Headers
        $headers = array(
            "Content-Type: application/json"
        );

        // Request Data
        $data = array(
            "include_deleted": false,
            "include_has_explicit_shared_members": false,
            "include_media_info": false,
            "include_mounted_folders": true,
            "include_non_downloadable_files": true,
            "path": "/",
            "recursive": false
        );

        $jsonObj = json_encode($data);

        // Send GET Request
        $response = $this->getRequest($this->listURL, $headers, $jsonObj);

        // Return response
        return $response;
    }

    // Scripts to get a file from dropbox
    function getFile($path){
        // Set the file to get
        $dbxArgs = array();
        $dbxArgs["path"] = $path;

        // Encode the request in JSON
        $jsonObj = json_encode($dbxArgs);

        // Set headers and bearer token
        $headers = array(
            "Dropbox-API-Arg: " . $jsonObj
        );

        // Send GET Request
        $response = $this->getRequest($this->uploadURL, $headers, array());

        // Return response
        return $response;
    }
}
?>