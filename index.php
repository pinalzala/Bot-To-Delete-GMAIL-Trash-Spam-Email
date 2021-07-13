<?php
require 'vendor/autoload.php'; // For Google Client Composer
session_start();
// Replace this with your Google Client ID
$client_id     = 'YOUR_CLIENT_ID_HERE';
 $client_secret = 'YOUR_CLIENT_SECRET_HERE';
$redirect_uri  = 'CALL_BACK_URL'; 

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setAccessType('offline'); //Added for Refresh Token
$client->setApprovalPrompt('force'); //Added for Refresh Token

// We only need permissions to compose and send emails
$client->addScope("https://mail.google.com/");

// Redirect the URL after OAuth
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
//BASE_URL_EXAMPLE :   http://www.domain.com
  echo "<script>location.href='YOUR_BASE_URL_HERE/index.php'</script>";

}

// If Access Token is not set, show the OAuth URL
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
 $access_token = $client->getAccessToken();
 echo '<a href="YOUR_BASE_URL_HERE/index.php?action=stop" >Stop Script</a>';
} else {
  $display = "display: block";
  $authUrl = $client->createAuthUrl();
  echo '<a href="'.$authUrl.'" style="'.$display.'">Authorize Me Please</a>';
  echo '</br>';
   echo '<a href="YOUR_BASE_URL_HERE/index.php?action=stop" >Stop Script</a>';
  $access_token = null;
}

if ($access_token != null) {

$acees = json_encode($access_token);
$refres = json_encode($access_token);
if (file_put_contents(token_store, json_encode($refres))) {
  echo '</br>';
  echo "Script will delete trash & spam in few moments.";
  echo "<script>location.href='YOUR_BASE_URL_HERE/cron.php'</script>";
} else {
	 echo "Error: " . $sql . "<br>" . $conn->error;
}
}

if (isset($_GET['action'])) {
$refres='';
if (file_put_contents(token_store, json_encode($refres))) {
    echo "Script Stop successfully";
	session_destroy();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
