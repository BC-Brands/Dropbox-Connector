<?php

class DropboxConnector{
    // Class variables
    private $accesstoken;
    private $uploadURL;

    // Construct the class
    function __construct($accesstoken) {
        $this->accesstoken = $accesstoken;
        $this->uploadURL = "https://content.dropboxapi.com/2/files/download";
    }

    function getFile($path){
        $args = array();
        $args["path"] = $path;

        $jsonObj = json_encode($args);

        $headers = array(
            "Authorization: Bearer " . $this->accesstoken,
            "Dropbox-API-Arg: " . $jsonObj
        );

        //Send HTTP Curl Request
        $c = curl_init($this->uploadURL);

        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($c);
        curl_close($c);

        return $response;
    }
}
?>