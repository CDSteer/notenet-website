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

										case Code::EMAIL_IN_USE:
										print("The email address is taken.");
										break;

										case Code::USERNAME_IN_USE:
										print("The username you entered is taken.");
										break;

										case Code::PASSWORD_MISMATCH:
										print("The passwords you entered do not match.");
										break;

										case Code::EMAIL_MISMATCH:
										print("The email addresses you entered do not match.");
										break;

										default:
										printf("Unknown error (%d).", nc_error());
										break;
									}

									print("</div>");
								}
								?>

								<h3 class="form-signin-heading">Sign Up to NoteCube</h3>
								<input type="text" name="username" class="form-control single-input" placeholder="Username" required autofocus>
								<input type="email" name="emailAddress" class="form-control top-input" placeholder="Email address" required>
								<input type="email" name="confirmEmailAddress" class="form-control bottom-input" placeholder="Confirm Email address" required>
								<input type="password" name="password" class="form-control top-input" placeholder="Password" required>
								<input type="password" name="confirmPassword" class="form-control bottom-input" placeholder="Confirm Password" required>
								<input type="hidden" name="do" value="signup">
								<button class="btn btn-lg btn btn-warning btn-block btn-space" value="submit" type="submit">Sign Up</button>
							</form>

							<p class="form-text">By clicking Sign Up you're accepting NoteCube's <a href="<?php nc_href("privacy"); ?>">Privacy Policy</a> and <a href="<?php nc_href("terms"); ?>">Terms of Service</a></p>
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