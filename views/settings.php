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
		<!-- Modal -->
		<div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Delete Account</h4>
					</div>
					<form role="form" action="gateway.php" method="post">
						<div class="modal-body">
							<p>Are you sure you want to delete your account and all of its data?</p>
							<p>Please enter your password to confirm deactivation of your account.</p>
							<input type="password" class="form-control single-input" name="password" placeholder="Password" required>
							<input type="hidden" name="do" value="deactivate">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-danger">Delete Account <i class="fa fa-frown-o"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-body">
							<?php
							switch (nc_error()) {
								case NULL: break;

								case Code::SUCCESS:
								print("<div class=\"alert alert-success\">The changes were successful.</div>");
								break;

								case Code::PASSWORD_MISMATCH:
								print("<div class=\"alert alert-danger\">The passwords you entered do not match.</div>");
								break;

								case Code::INVALID_PASSWORD:
								print("<div class=\"alert alert-danger\">The password you entered does not match.</div>");
								break;

								case Code::EMAIL_MISMATCH:
								print("<div class=\"alert alert-danger\">The email addresses you entered do not match.</div>");
								break;

								default:
								printf("<div class=\"alert alert-danger\">Unknown error (%d).</div>", nc_error());
								break;
							}
							?>

							<div class="well top settings-well">
								<form role="form" method="post" action="gateway.php">
									<h3>Change Email Address</h3>
									<input type="email" class="form-control top-input" name="emailAddress" placeholder="Email address" value="<?php print($user->get("EmailAddress")); ?>" required>
									<input type="email" class="form-control bottom-input" name="confirmEmailAddress" placeholder="Confirm Email address" value="<?php print($user->get("EmailAddress")); ?>" required> 
									<input type="hidden" name="do" value="changeEmail">
									<button type="submit" class="btn btn-default">Submit</button>
								</form>
							</div>

							<div class="well top settings-well">
								<form role="form" method="post" action="gateway.php">
									<h3>Change Password</h3>
									<input type="password" class="form-control top-input" name="password" placeholder="Password" required> 
									<input type="password" class="form-control bottom-input" name="confirmPassword" placeholder="Confirm Password" required> 
									<input type="hidden" name="do" value="changePassword"> 
									<button type="submit" class="btn btn-default">Submit</button>
								</form>
							</div>
							<div class="well top settings-well">
								<h3>Deactivate Account</h3>
								<p><strong>Warning!</strong> This will delete your account and all data associated with it.</p>
								<button type="button" data-toggle="modal" data-target="#deleteAccount" class="btn btn-danger">Deactivate Account <i class="fa fa-frown-o"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php nc_foot(); ?>
	<?php nc_footer(); ?>
</body>
</html>