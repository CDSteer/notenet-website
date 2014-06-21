<?php
    session_start();
    if (!isset($_SESSION["userid"])) {
        header("location:../login/index.php");
        exit();
    }
    // Connect to Database
    $connection = mysql_connect("10.246.16.209:3306", "rummager_org", "newpasswordeleventythree");
    if (!$connection) {
        echo "<h2>Failed to connect to rummager.org</h2>" . mysql_error();
    }
    // Select the database
    if (!mysql_select_db("rummager_org", $connection)) {
        echo "<h2>Failed to select database rummager_org!</h2><br />" . mysql_error();
    }
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Social Search Tool">
    <meta name="author" content="Group 14">
    <link rel="shortcut icon" href="#">

    <title>Rummager</title><!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"><!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"><!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<!-- BEGIN Pre-requisites -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
  </script>
  <script type="text/javascript">
    (function () {
      var po = document.createElement('script');
      po.type = 'text/javascript';
      po.async = true;
      po.src = 'https://plus.google.com/js/client:plusone.js?onload=start';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(po, s);
    })();
  </script>

<script type="text/javascript">

function signInCallback(authResult) {
  if (authResult['code']) {

    // Hide the sign-in button now that the user is authorized, for example:
    document.getElementById("signinButton").innerHTML = "";

    // Send the code to the server
    $.ajax({
      type: 'POST',
      url: 'google.php',
      data: {code: authResult['code']},
      success: function(result) {
        // Handle or verify the server response if necessary.

        // Prints the list of people that the user has allowed the app to know
        // to the console.
        console.log(result);
        document.getElementById("signinButton").innerHTML = "<form method=\"GET\" action=\"./google/logout.php\"><button type=\"submit\" onclick=\"gapi.auth.signOut();\" id=\"googleLogOut\" class=\"btn btn-primary\">Logout of Google</button></form>";
	},
      processData: true
    });
  } else if (authResult['error']) {
    // There was an error.
    // Possible error codes:
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatially log in the user
    // console.log('There was an error: ' + authResult['error']);
  }
} 

</script>
  <!-- END Pre-requisites -->

</head>

<body>
    <!-- Fixed NavBar
    ================================================== -->

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span></button> <a class="navbar-brand">Rummager</a>
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../search">Home</a></li>

                    <li><a href="../about">About</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">Settings</a></li>

                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div><!-- Start Dropbox API =-->
    <?php
            $appName = "Rummager 0.1";
            require_once "./dropbox/dropbox-sdk/Dropbox/autoload.php";
            
            use \Dropbox as dbx; // Copied directly from tutorial. Unsure as to why.
            $appInfo = dbx\AppInfo::loadFromJsonFile("./app-info.json");
            $webAuth = new dbx\WebAuthNoRedirect($appInfo, $appName);
        ?><!-- Start Facebook API =-->
    <?php
            require_once('./facebook/facebook.php');
            include "./facebook/facebook_init.php";
        ?><!-- Main Content
    ================================================== -->

    <div id="wrap">
        <!-- Begin page content -->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul id="myTab" class="nav nav-tabs">
                                <li class="active"><a href="#services" data-toggle="tab">Services</a></li>

                                <li><a href="#recentfeed" data-toggle="tab">Recent Activity</a></li>

                                <li><a href="#accountSettings" data-toggle="tab">Account Settings</a></li>
                            </ul>

                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade" id="accountSettings">
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="well top">
                                                <form role="form" method="post" action="emailchange.php">
                                                    <h3>Change Email Address</h3><input type="text" id="email1" class="form-control top-input" name="EmailAddress" placeholder="Email address" required=""> <input type="text" class="form-control bottom-input" id="email2" name="ConfirmEmailAddress" placeholder="Confirm Email address" required=""> <button type="submit" class="btn btn-default" onclick='return formVal();'>Submit</button>
                                                </form>
                                            </div>

                                            <div class="well top">
                                                <form role="form" method="post" action="passwordchange.php">
                                                    <h3>Change Password</h3><input type="password" class="form-control top-input" id="password1" name="Password" placeholder="Password" required=""> <input type="password" class="form-control bottom-input" id="password2" name="ConfirmPassword" placeholder="Confirm Password" required=""> <button type="submit" class="btn btn-default" onclick='return formVal1();'>Submit</button>
                                                </form>
                                            </div>

                                            <div id="error"></div><?php
                                                                                            if (isset($_REQUEST['code'])) {
                                                                                                if ($_REQUEST['code'] == "1") {
                                                                                                    echo '<div class="alert alert-success center">You have successfully changed your email!</div>';
                                                                                                }
                                                                                                if ($_REQUEST['code'] == "2") {
                                                                                                    echo '<div class="alert alert-success center">You have successfully changed your password!</div>';
                                                                                                }
                                                                                                if ($_REQUEST['code'] == "3") {
                                                                                                    echo '<div class="alert alert-danger center">Emails do not match!</a></div>';
                                                                                                }
                                                                                                if ($_REQUEST['code'] == "4") {
                                                                                                    echo '<div class="alert alert-danger center">Passwords do not match!</div>';
                                                                                                }
                                                                                            }

                                                                                        ?>
                                        </div>

                                        <div class="col-md-2"></div>
                                    </div>
                                </div>

                                <div class="tab-pane fade in active" id="services">
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <a name="tab2"></a>

                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/facebook-icon.png" alt="Facebook" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">Facebook</h4>By connecting Facebook you're able to search for posts, messages, files etc..<br>
                                                        <br>
                                                        <?php
                                                                                            // Login Details - Generate Login URL, including Redirect.
                                                                                            $scope = "read_stream,user_events,friends_events"; // Comma Separated List of permissions requested.
                                                                                            $response_type = "code"; // Can be either code, token or code%20token - code allows you to take out and store your own token.

                                                                                            // Get Login URLs (Begin Login)
                                                                                            $user_id_fb = $facebook->getUser();
                                                                                            $code_fb = $_GET["code"];
                                                                                            $logout_url_fb = $facebook->getLogoutUrl();
                                                                                            $login_url_fb = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . $login_page . "&response_type=" . $response_type . "&scope=" . $scope;
                                                                                        ?> <?php
                                                                                            // Get data from DBMS.
                                                                                            $query_fb = "SELECT UserID, Token FROM loginFacebook WHERE UserID = " . $_SESSION["userid"];
                                                                                            $result_fb = mysql_query($query_fb);
                                                                                            if ($row = mysql_fetch_assoc($result_fb)){
                                                                                                $TokenFb = $row["Token"];
                                                                                            }
                                                                                            if( (isset($TokenFb)) && (strlen($TokenFb) > 1) ) {
                                                                                                // We have a user ID, so probably a logged in user.
                                                                                                // If not, we'll get an exception, which we handle below.
                                                                                                echo "<form method='POST' action='facebook/del.php'><button type='submit' class='btn btn-primary' name='button' onclick='window.open(\"https://www.facebook.com/settings?tab=applications\")'>Logout of Facebook</button></form>";
                                                                                            }
                                                                                            else {
                                                                                                // No user, print a link for the user to login
                                                                                                // echo "To Log into Facebook, please click <a href='" . $login_url_fb . "'>Here.</a>";
													     echo "<a href='" . $login_url_fb . "'><button type='submit' class='btn btn-primary'>Login to Facebook</button></a>";
                                                                                            }
                                                                                        ?> <?php
                                                                                            // This section gets the access token.
                                                                                            // Note: $code is retrieved from the Facebook Login Redirect above.
                                                                                            $token_url = "https://graph.facebook.com/oauth/access_token?client_id=" . $app_id . "&redirect_uri=" . $login_page . "&client_secret=" . $secret_id . "&code=" . $code;
                                                                                            if ($code) {
													 	$accesstokenFacebook = substr(file_get_contents($token_url), 13);
													 }
                                                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/twitter-icon.png" alt="Twitter" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">Twitter</h4>By connecting Twitter you're able to search for Tweets etc..<br>
                                                        <br>
                                                        <?php
									$query = "SELECT * FROM loginTwitter WHERE UserID = " . $_SESSION["userid"];
									$result = mysql_query($query);
									if ($row = mysql_fetch_assoc($result)) {
										$token = $row["OauthToken"];
									}
									if ( (isset($token)) && (strlen($token) > 1) ){
										// User is already logged in, present option to logout
    										echo('<form method="POST" action="./twitteroauth/logout.php"><button type="submit" class="btn btn-primary">Logout of Twitter</button></form>');
									}else{
										// User not logged in, present option to login
										//echo('<button type="button" class="btn btn-primary">Login to Twitter</button>');
    										echo('<a href="./twitteroauth/redirect.php"><button type="button" class="btn btn-primary">Login to Twitter</button></a>');
									}
								?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/google+-icon.png" alt="Google+" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">Google Drive & Google Calendar</h4>By connecting your Google Account, you're able to search for files and calendar events etc..<br>
                                                        <br>
								<div id="signinButton">
									<span class="g-signin"
    											data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/drive.readonly"
    											data-clientid="177318234519-ntrobn3dkvhbutqi29lpl3kv9maje5bg.apps.googleusercontent.com"
    											data-redirecturi="postmessage"
    											data-accesstype="offline"
    											data-cookiepolicy="single_host_origin"
    											data-callback="signInCallback">
  									</span>
								</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/dropbox-icon.png" alt="Dropbox" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">Dropbox</h4>By connecting Dropbox you're able to search for files.<br>
								<b>WARNING:</b> If you have a large number of files in your Dropbox, Rummager might not be able to cope!
                                                        <br>
                                                        <?php

                                                                                        $query = "SELECT UserID, Token, IsToken FROM loginDropbox WHERE UserID = " . $_SESSION["userid"];
                                                                                        $result = mysql_query($query);

                                                                                        if ($row = mysql_fetch_assoc($result)) {
                                                                                            if ($row['IsToken'] == 0) {
                                                                                                list($accessToken, $dropboxUserId) = $webAuth->finish($row['Token']);
                                                                                                $query2 = "DELETE FROM loginDropbox WHERE UserID = " . $_SESSION["userid"];
                                                                                                $result2 = mysql_query($query2);    

                                                                                                $query3 = "INSERT INTO loginDropbox(UserID, UserName, Token, IsToken) VALUES (" . $_SESSION["userid"] . ", '" . $dropboxUserId . "', '" . $accessToken . "', 1)";
                                                                                                $result3 = mysql_query($query3);
                                                                                            }
                                                                                            echo "<form method='POST' action='dropbox/del.php'><button type='submit' class='btn btn-primary' name='button'>Logout Of Dropbox</button></form>";
                                                                                        } else {
                                                                                            $authorizeUrl = $webAuth->start();
                                                                                            echo "1. Go to: <a href='" . $authorizeUrl . "' target='_blank'>This Link.</a><br>";
                                                                                            echo "2. Click \"Allow\" (you might have to log in first).<br>";
                                                                                            echo "3. Copy the authorization code here.<br>";
                                                                                            echo "<form method='POST' action='dropbox/get.php'><input type='text' class='form-control' name='id' required='' placeholder='Paste Authorization code here!' /><br><button type='submit' class='btn btn-primary' name='button'>Login to Dropbox</button></form>";
                                                                                        }
                                                                                        ?>
                                                                                                  <?php
            if (isset($_REQUEST['error'])) {
                if ($_REQUEST['error'] == "dbx") {
                    echo '<br><div class="alert alert-danger center">Incorrect authorization code!</div>';
            }
            }
           ?>
                                                    </div>
                                                </div>
                                            </div>
						<!-- 
                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/linkedin-icon.png" alt="LinkedIn" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">LinkedIn</h4>By connecting LinkedIn you're able to search for...<br>
                                                        <br>
                                                        <button type="button" class="btn btn-primary">Link LinkedIn</button> <button type="button" class="btn btn-default" disabled="disabled">Remove LinkedIn</button>
                                                    </div>
                                                </div>
                                            </div>
						
                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/Evernote-icon.png" alt="Evernote" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">Evernote</h4>By connecting Evernote you're able to search for files.<br>
                                                        <br>
                                                        <?php
									$query = "SELECT * FROM loginEvernote WHERE UserID = " . $_SESSION["userid"];
									$result = mysql_query($query);
									if ($row = mysql_fetch_assoc($result)) {
										$token = $row["Token"];
									}
									if ( (isset($token)) && (strlen($token) > 1) ){
										// User is already logged in, present option to logout
    										echo('<form method="POST" action="./evernote/logout.php"><button type="submit" class="btn btn-primary">Logout of Evernote</button></form>');
									}else{
										// User not logged in, present option to login
    										echo('<form method="POST" action="./evernote/login.php"><button type="submit" class="btn btn-primary">Login to Evernote</button></form>');
									}
								?>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/delicious-icon.png" alt="Delicious" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">Delicious</h4>By connecting Delicious you're able to search for links.<br>
                                                        <br>
                                                        <button type="button" class="btn btn-primary">Link Delicious</button> <button type="button" class="btn btn-default" disabled="disabled">Remove Delicious</button>
                                                    </div>
                                                </div>
                                            </div>
						--->
                                        </div>
						
                                        <div class="col-md-2"></div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="recentfeed">
					<?php
						$query = "SELECT * FROM userSettings WHERE UserID = " . $_SESSION["userid"];
						$result = mysql_query($query);
						$row = mysql_fetch_assoc($result);
					?>
                                    <div class="row">
                                        <div class="col-md-2"></div>
					     <form method="POST" action="setRecent.php">
                                        <div class="col-md-8">
                                            <div class="well top">
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img src="../images/facebook-icon.png" alt="Facebook" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                    <div class="media-body">
                                                        <h4 class="media-heading">Facebook</h4>Turn Facebook updates on or off in the recent activity feed.<br>
                                                        <br>
								<?php
									if ($row["FacebookOn"] == 1) {
										echo '<input type="checkbox" name="check-facebook" checked data-on-color="primary" data-off-color="danger">';
									} elseif ($row["FacebookOn"] == 0) {
										echo '<input type="checkbox" name="check-facebook" data-on-color="primary" data-off-color="danger">';
									}
								?>
                                                    </div>
                                                </div>
                                            </div>

						<div class="well top">
                                            <div class="media">
                                                <a class="pull-left" href="#"><img src="../images/twitter-icon.png" alt="Twitter" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                <div class="media-body">
                                                    <h4 class="media-heading">Twitter</h4>Turn Twitter updates on or off in the recent activity feed.<br>
                                                    <br>
                                                    <?php
									if ($row["TwitterOn"] == 1) {
										echo '<input type="checkbox" name="check-twitter" checked data-on-color="primary" data-off-color="danger">';
									} elseif ($row["TwitterOn"] == 0) {
										echo '<input type="checkbox" name="check-twitter" data-on-color="primary" data-off-color="danger">';
									}
							   ?>
                                                </div>
                                            </div>
                                        </div>

						<div class="well top">
                                            <div class="media">
                                                <a class="pull-left" href="#"><img src="../images/googledrive-icon.png" alt="Google Drive" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                <div class="media-body">
                                                    <h4 class="media-heading">Google Drive</h4>Turn Google Drive updates on or off in the recent activity feed.<br>
                                                    <br>
                                                    <?php
									if ($row["GoogleDriveOn"] == 1) {
										echo '<input type="checkbox" name="check-drive" checked data-on-color="primary" data-off-color="danger">';
									} elseif ($row["GoogleDriveOn"] == 0) {
										echo '<input type="checkbox" name="check-drive" data-on-color="primary" data-off-color="danger">';
									}
      							   ?>
                                                </div>
                                            </div>
                                        </div>


                                            
                                        	<div class="well top">
                                            <div class="media">
                                                <a class="pull-left" href="#"><img src="../images/dropbox-icon.png" alt="Dropbox" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                <div class="media-body">
                                                    <h4 class="media-heading">Dropbox</h4>Turn Dropbox updates on or off in the recent activity feed.<br>
                                                    <br>
                                                    <?php
									if ($row["DropboxOn"] == 1) {
										echo '<input type="checkbox" name="check-dropbox" checked data-on-color="primary" data-off-color="danger">';
									} elseif ($row["DropboxOn"] == 0) {
										echo '<input type="checkbox" name="check-dropbox" data-on-color="primary" data-off-color="danger">';
									}
							   ?>
                                                </div>
                                            </div>
                                        </div>

						<div class="well top">
                                            <div class="media">
                                                <a class="pull-left" href="#"><img src="../images/googlecalendar-icon.png" alt="Google Calendar" class="img-circle img-responsive" width="50px" height="50px"></a>

                                                <div class="media-body">
                                                    <h4 class="media-heading">Google Calendar</h4>Turn Google Calendar updates on or off in the recent activity feed.<br>
                                                    <br>
                                                    <?php
									if ($row["GoogleCalOn"] == 1) {
										echo '<input type="checkbox" name="check-cal" checked data-on-color="primary" data-off-color="danger">';
									} elseif ($row["GoogleCalOn"] == 0) {
										echo '<input type="checkbox" name="check-cal" data-on-color="primary" data-off-color="danger">';
									}
							   ?>
                                                </div>
                                            </div>
                                        </div>
						<button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
						</form>
                                    </div>
                                </div>

                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Footer
    ================================================== -->

    <div id="footer">
        <div class="container">
            <p class="text-muted">&copy; 2014 Rummager &middot; <a href="../privacy">Privacy Policy</a></p>
        </div>
    </div><!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript">
</script><script src="../js/bootstrap.min.js" type="text/javascript">
</script><script src="../js/bootstrap-switch.min.js" type="text/javascript">
</script>

<script type="text/javascript">

    function formVal() {

    var email1 = document.getElementById('email1').value;
    var email2 = document.getElementById('email2').value;

    if (email1 != email2){
        document.getElementById('error').innerHTML = '<div class="alert alert-danger center">Emails do not match!<\/div>';
        return false;
    }
        return true;
    }

    function formVal1() {

    var password1 = document.getElementById('password1').value;
    var password2 = document.getElementById('password2').value;

    if (password1 != password2){
        document.getElementById('error').innerHTML = '<div class="alert alert-danger center">Passwords do not match!<\/div>';
        return false;
    }else{
        return true;
    }
    }

    
    </script><?php
        // Close DBMS.
        mysql_close();
    ?>
</body>
</html>
