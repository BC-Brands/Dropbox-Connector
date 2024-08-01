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

Under the Permissions tab, make sure `files.content.read`, `team_data.content.read` and `team_data.member` are selected.

## Example code