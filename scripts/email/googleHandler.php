<?php
//require Google.php
require_once('Google.php');

//save state and service to varibales to be passed to main
$authResult = $_POST['authResult'];
$state = $_POST['state'];
//initiate the instance and call the main method
if(!isset($google)){
    $google = new Google();
    $google->main($authResult, $state);
}
?>