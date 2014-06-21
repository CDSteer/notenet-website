<?php
//ob_start();
//session_start();
if (!isset($_COOKIE["state"])){
    $data['state'] = md5(uniqid(rand(), true));
    $expire=time()+60*60*24*30;
    setcookie("state", $data['state'], $expire);
    header("Location: dashboard");
}
//$_SESSION['state'] = $data['state'];

if(!$service->isLoggedIn()) {
	// Direct user to the homepage if they aren't logged in
	nc_goto(DOCROOT);
}
?>
<!doctype html>
<html>
<head>
	<?php nc_head(); ?>
	<?php nc_stylesheet("brand-buttons"); ?>
	<?php nc_stylesheet("weather-icons"); ?>
	<?php nc_stylesheet("bootstrap-datetimepicker"); ?>
	<?php nc_stylesheet("slider", FALSE); ?>
	<title>NoteCube</title>
	<?php nc_include("dashboard/googleplus"); ?>
</head>

<body>
	<!-- Navbar -->
	<?php nc_navbar(); ?>

	<!-- Main content -->
	<div id="wrap">
		<!-- Modals -->
		<?php nc_include("dashboard/modals/cube"); ?>
		<?php nc_include("dashboard/modals/rule"); ?>
		<?php nc_include("dashboard/modals/customLight"); ?>
		<?php nc_include("dashboard/modals/trafficLight"); ?>
        <?php nc_include("dashboard/modals/pulseLight"); ?>
        <?php nc_include("dashboard/modals/flashLight"); ?>
        <?php nc_include("dashboard/modals/deleteCube"); ?>

		<div class="container-fluid">
			<div class="row">
				<!-- Sidebar -->
				<?php nc_include("dashboard/sidebar"); ?>
				<!--Main window-->
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<!-- Tab panes -->
					<div class="tab-content">
						<?php nc_include("dashboard/tabs/overview"); ?>
						<?php nc_include("dashboard/tabs/facebook"); ?>
						<?php nc_include("dashboard/tabs/twitter"); ?>
						<?php nc_include("dashboard/tabs/gmail"); ?>
						<?php nc_include("dashboard/tabs/googlePlus"); ?>
						<?php nc_include("dashboard/tabs/googleCalendar"); ?>
						<?php nc_include("dashboard/tabs/googleDrive"); ?>
						<?php nc_include("dashboard/tabs/dropbox"); ?>
						<?php nc_include("dashboard/tabs/weather"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php nc_foot(); ?>
	<?php nc_controller("footer-dashboard"); ?>
	<?php nc_script("bootstrap-slider", FALSE); ?>
	<?php nc_script("bootstrap-datetimepicker"); ?>
	<script>
		var RGBChange = function() {
			$('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
		};

		var r = $('#R').slider()
		.on('slide', RGBChange)
		.data('slider');
		var g = $('#G').slider()
		.on('slide', RGBChange)
		.data('slider');
		var b = $('#B').slider()
		.on('slide', RGBChange)
		.data('slider');

		$(function() {
			$('#datetimepicker3').datetimepicker({
				pickDate: false
			});
		});
		
		
function signInCallback(authResult) {
          if (authResult['code']) { 
            // Update the app to reflect a signed in user
            document.getElementById('signinButton').setAttribute("disabled","disabled");
            document.getElementById('signoutButton').removeAttribute("disabled");
            var state = '<?php echo $_COOKIE['state']; ?>'
            var param = 
            { 
            'authResult': authResult['code'],
            'state':state
            }            // Send the code to the server
            $.ajax({
              type: 'POST',
              url: '../NoteCube/scripts/email/google.php?storeToken&state/',
              //contentType: 'application/octet-stream; charset=utf-8',
              data: param,
              success: function(result) {
                // Handle or verify the server response if necessary.
        
                // Prints the list of people that the user has allowed the app to know
                // to the console.
                console.log(result);
                },
                processData: true
      });
      
  } else if (authResult['error']) {
    // Update the app to reflect a signed out user
    document.getElementById('signinButton').removeAttribute("disabled");
    document.getElementById('signoutButton').setAttribute("disabled","disabled");
    // Possible error values:
    //   "user_signed_out" - User is signed-out
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatically log in the user
    console.log('Sign-in state: ' + authResult['error']);
  }
}


function signout(){ 
       gapi.auth.signOut();
       document.getElementById('signinButton').removeAttribute("disabled");
       document.getElementById('signoutButton').setAttribute("disabled","disabled");
       console.log('sign out');
}

	</script>
</body>
</html>