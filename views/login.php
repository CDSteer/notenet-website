<?php
if($service->isLoggedIn()) {
	// Direct user to the dashboard if they are logged in
	nc_goto(DOCROOT);
}
?>
<!doctype html>
<html>
<head>
	<?php nc_head(); ?>
	<title>NoteCube</title>
</head>

<body>
	<!-- Navbar -->
	<?php nc_navbar(); ?>

	<!-- Main content -->
	<div id="wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>

				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<form action="<?php nc_href("gateway.php") ?>" method="post" class="form-signin" role="form">
								<?php
								if(nc_error() != Code::SUCCESS) {
									print("<div class=\"alert alert-danger\">");

									switch (nc_error()) {
										case NULL: break;

										case Code::NO_SUCH_USER:
										print("The username or email address you entered was not found.");
										break;

										case Code::INVALID_PASSWORD:
										print("The password you entered is incorrect.");
										break;

										case Code::BRUTE_ATTACK:
										print("The account has been blocked for 5 minutes due to 3 failed login attempts.");
										break;
										
										default:
										printf("Unknown error (%d).", nc_error());
										break;
									}

									print("</div>");
								}
								?>

								<h3 class="form-signin-heading">Login to NoteCube</h3>

								<input type="text" name="emailAddress" id="emailAddress" class="form-control top-input" placeholder="Username or Email Address" required autofocus>
								<input type="password" name="password" id="password" class="form-control bottom-input" placeholder="Password" required>
								<input type="hidden" name="do" value="login">

								<input type="checkbox" name="remember"> Remember me

								<button class="btn btn-lg btn btn-warning btn-block btn-space" value="submit" type="submit">Login</button>
							</form>
						</div>
					</div>
				</div>
				
				<div class="col-md-3"></div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php nc_foot(); ?>
	<?php nc_footer(); ?>
</body>
</html>