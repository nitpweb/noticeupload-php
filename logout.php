<?php
// Include configuration file
require_once 'configannoun.php';
require_once 'configevent.php';
require_once 'configimportant.php';
require_once 'configTender.php';

// Remove token and user data from the session
unset($_SESSION['token']);
unset($_SESSION['userData']);



// Reset OAuth access token
$gClient->revokeToken();

// Destroy entire session data
session_destroy();

// Redirect to homepage
header("Location:notice.php");
