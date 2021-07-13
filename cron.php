<?php
header("Refresh: 300;url=YOUR_BASE_URL_HERE/cron.php'"); 
require 'vendor/autoload.php';
//Get Refresh Token From token file to set when running Authentication File

	  $refresh_token = json_decode(file_get_contents(token_store), TRUE);

      // Replace this with your Google Client ID
      $client_id     = 'YOUR_CLIENT_ID_HERE';
      $client_secret = 'YOUR_CLIENT_SECRET_HERE';
      $redirect_uri  = 'CALL_BACK_URL'; 

      $client = new Google_Client();
      $client->setClientId($client_id);
      $client->setClientSecret($client_secret);
      $client->setRedirectUri($redirect_uri);
      $client->addScope("https://mail.google.com/");
      $client->setAccessType('offline');
      $client->setApprovalPrompt('force');

      $client->setAccessToken($token);

      if ($client->isAccessTokenExpired()) {
      $client->refreshToken($refresh_token);
      $newtoken = $client->getAccessToken();
      $client->setAccessToken($newtoken);
      }else{
		  $newtoken = $token;
	  }
	
  
		$service = new Google_Service_Gmail($client);

                $optParams = [];
                $optParams['maxResults'] = 500; // Return Only 5 Messages
                $optParams['labelIds'] = 'SPAM'; // Only show messages in Inbox
                $messages = $service->users_messages->listUsersMessages('me',$optParams);
                $list = $messages->getMessages();
				
				foreach($list as $key=>$value){
                $messageId = $list[$key]->getId(); // Grab first Message
			    $service->users_messages->delete('me', $messageId);
				print 'Message with ID: ' . $messageId . ' successfully deleted.';
  
				}
				
				$optParams1 = [];
                $optParams1['maxResults'] = 500; // Return Only 5 Messages
                $optParams1['labelIds'] = 'TRASH'; // Only show messages in Inbox
                $messages = $service->users_messages->listUsersMessages('me',$optParams1);
                $list1 = $messages->getMessages();
				
				foreach($list1 as $key=>$value){
				$messageId = $list1[$key]->getId(); // Grab first Message
			    $service->users_messages->delete('me', $messageId);
				print 'Message with ID: ' . $messageId . ' successfully deleted.';
  
				}
