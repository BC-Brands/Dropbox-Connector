# Dropbox-Connector
A collection of simple scripts to work with Dropbox files.

## About
Version 2, 01/08/2024

Copyright (C) 2024 BC Brands. All rights reserved.

Registered with the BC Brands Software Centre, No #00051.
https://bcwd.site/software

### Changelog
Version 2     Now supports OAuth2 connectivity to Dropbox.
**Please note Version 2 is not backwards compatible with version 1.**

## Installation
Firstly create a development app on Dropbox: https://www.dropbox.com/developers/apps.
Set the permission type to be 'Scoped' and allow access to all Dropbox files.

Under OAuth2, copy the app key and secret - save this in `env.php`.

Under the Permissions tab, make sure `files.content.read`is selected.

Then, visit the directory this file is located in. This will allow you to authenticate with Dropbox.

## Example code
### List All Files in a Directory
```
<?php
require_once "connector.php";

$dc = new DropboxConnector();
echo $dc->listFiles("") // Replace "" with your directory, or leave blank string for the root directory.

?>
```

### Get and return a file
```
<?php
require_once "connector.php";

$dc = new DropboxConnector();
echo $dc->getFile("path/to/file");
?>
```