<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
// define('DB_HOST', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '12345');
// define('DB_NAME', 'googleSign');
// define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '915024648862-b03sfabagou7hmv1veo6qc299l8uakd3.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'lN_JB-L1S8qO0usCqWLp8QDe');
define('GOOGLE_REDIRECT_URL', 'http://localhost/GoogleLogin/event.php');

// Start session
if (!session_id()) {
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
