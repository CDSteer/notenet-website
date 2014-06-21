<?php
set_time_limit(10);
require_once("../../lib/common.php");

nc_library("google/src/", 2);

$authResult = $_POST['authResult'];
$state = $_POST['state'];

if($service->isLoggedIn()) {
    // Connect to the DB and query
    $row = DB::query("SELECT * FROM Google WHERE user = %d", intval($user->getID()));

    //if result is 0 then new user get their access and refresh tokens and store in database
    if (DB::count() == 0) {

        $client_id = '315310379653-dqcepo7v2bl6knjpa1gnrdhjiqaqq50f.apps.googleusercontent.com';
        $client_secret = 'Bbi5rD3Gzo4HM5Q6empudVQg';
    
        $client = new Google_Client();
        $client->setApplicationName('NoteNet');
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri("postmessage");
        $client->setDeveloperKey("AIzaSyCkNDjcFn54IDyLOwpWdlFkO5nPTTNVNz4"); // API key
        $client->setScopes("https://www.googleapis.com/auth/plus.login");
        $client->setAccessType('offline');
    
        
        if (isset($state) && $state === $_COOKIE["state"])
        {
            $client->authenticate($authResult);
            $token = json_decode($client->getAccessToken());
    
            // Verify the token
            $reqUrl = 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=' .
            $token->access_token;
    
            $req = new Google_Http_Request($reqUrl);
    
            $tokenInfo = json_decode(
                $client->getAuth()->authenticatedRequest($req)->getResponseBody());
    
            $userId = $tokenInfo->user_id;
            $userEmail = $tokenInfo->email;
    
            // If there was an error in the token info, abort.
            if (isset($tokenInfo->error)) {
                print $tokenInfo->error;
            }
            // Make sure the token we got is for our app.
            if ($tokenInfo->audience != $client_id) {
                print "Token's client ID does not match app's.";
            }
            
            $query = DB::insert('Google', array(
                'user' => intval($user->getID()),
                'code' => $authResult,
                'access_token' => $token->access_token,
                'refresh_token' => $token->refresh_token
                ));
        }
    }  
}
?>