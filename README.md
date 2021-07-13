# Bot-To-Delete-GMAIL-Trash-Spam-Email
This script will delete your GMAIL trash and spam email automatically everyday or every hour or whenever you want to delete. I'm building this bot in php using Google API. 


Installation and usage

System Requirements:

PHP 5 or Above (I tested with 5.5.9) CURL extension for PHP SSL CA Bundle

How to install project and setup Google Account:

- Clone project
- Edit "index.php" & "cron.php" and include your Live Client ID, Secret Key and oAuth callback URL in relevant places.
- Create "token_store" file to store your oAuth token, oAuth will use to verify your account.


How to run project:
- Deploy to your web server or localhost
- Make sure "token_store" file has read+write permission.
- Edit ""index.php" and "cron.php" and include your Live Client ID, Secret Key and oAuth callback URL in relevant places.
- run "index.php" like http://example.com/index.php
- Setup cron to your server and set time for cron whenever you want delete email like 10 minutes, 30 minutes, Every Day, Every Month ..... etc


Uses of all files

-  index.php - For athntication your Google account and delete trash & spam first 
- cron.php - For deleting email at your particular time

Questions???

E-Mail me pinal@pinalzal.me
