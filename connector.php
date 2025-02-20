<?php

require_once "http.php";
require_once "token.php";

class DropboxConnector{
    // Class variables
    private $accesstoken;
    private $uploadURL;

    // Construct the class
    function __construct() {
        $this->accesstoken = generateToken();
        $this->uploadURL = "https://content.dropboxapi.com/2/files/download";
        $this->listURL = "https://api.dropboxapi.com/2/files/list_folder";
        $this->namespaceURL = "https://api.dropboxapi.com/2/team/namespaces/list";
    }

    // Scripts to send a HTTP request.
    function sendRequest($type, $path, $args, $data){
        // Set headers and bearer token
        $headers = $args;
        array_push($headers, "Authorization: Bearer " . $this->accesstoken);

        $response = sendHTTPRequest($type, $path, $headers, $data, 'JSON');

        // Return response
        return $response; 
    }

    // Scripts to send a HTTP GET request
    function getRequest($path, $args, $data){
        return $this->sendRequest('GET', $path, $args, $data);  
    }

    // Scripts to send a HTTP POST request
    function postRequest($path, $args, $data){
        return $this->sendRequest('POST', $path, $args, $data);
    }

    // List All Folders
    function listAllFolders(){
        // Send GET Request
        $response = $this->listFiles("");

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
            "include_deleted" => false,
            "include_has_explicit_shared_members" => false,
            "include_media_info" => false,
            "include_mounted_folders" => true,
            "include_non_downloadable_files" => true,
            "path" => $path,
            "recursive" => false
        );

        $jsonObj = json_encode($data);

        // Send GET Request
        $response = $this->postRequest($this->listURL, $headers, $jsonObj);

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
            "Dropbox-API-Arg: " . $jsonObj,
            "Content-Type: application/octet-stream"
        );

        // Send GET Request
        $response = $this->getRequest($this->uploadURL, $headers, array());

        // Return response
        return $response;
    }
}
?>