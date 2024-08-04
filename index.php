<?php
require_once "env.php";

// Start the OAuth2 process.

$url = "https://www.dropbox.com/oauth2/authorize?client_id=n8nij0pmxza6rxx&redirect_uri=" . $PATH_TO_DIR . "/auth.php&response_type=code&token_access_type=offline";

// Redirect to Dropbox
header("Location: " . $url);

?>