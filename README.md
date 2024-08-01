# Dropbox-Connector
A collection of simple scripts to work with Dropbox files.
This SHOULD NOT be used to build an application to work with end-user accounts.

## About
Version 1.0, 01/08/2024

Copyright (C) 2024 BC Brands. All rights reserved.

Registered with the BC Brands Software Centre, No #00051.
https://bcwd.site/software

## Installation
Firstly create a development app on Dropbox: https://www.dropbox.com/developers/apps.
Set the permission type to be 'Scoped' and allow access to all Dropbox files.

Under OAuth2, create an access token and save this for later use.

Under the Permissions tab, make sure `files.content.read`is selected.

## Example code
### List All Files in a Directory
```
<?php
require_once "connector.php";

$auth_token = ""; // Insert your AUTH Token here.

$dc = new DropboxConnector($auth_token);
echo $dc->listFiles("") // Replace "" with your directory, or leave blank string for the root directory.

?>
```

### Get and return a file
```
<?php
require_once "connector.php";

$auth_token = "";

$dc = new DropboxConnector($auth_token);
echo $dc->getFile("path/to/file");
?>
```