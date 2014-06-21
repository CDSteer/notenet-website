<div class="tab-pane fade in active" id="Overview">
	<?php
	if(nc_error() != Code::SUCCESS) {
		switch (nc_error()) {
			case NULL: break;

			case Code::DEVICE_REGISTER_SUCCESS:
			print("<div class=\"alert alert-success center\">Cube successfully registered.</div>");
			break;

			case Code::INVALID_ACCESS_TOKEN:
			print("<div class=\"alert alert-danger center\">Invalid access token.</div>");
			break;

			case Code::INVALID_DEVICE_ID:
			print("<div class=\"alert alert-danger center\">Invalid device ID.</div>");
			break;

			case Code::DEVICE_ALREADY_REGISTERED:
			print("<div class=\"alert alert-danger center\">Cube already registered.</div>");
			break;

			case Code::DEVICE_REMOVE_SUCCESS:
			print("<div class=\"alert alert-success center\">Cube successfully removed.</div>");
			break;

			case Code::NO_SUCH_DEVICE:
			print("<div class=\"alert alert-danger center\">No such device.</div>");
			break;

			default:
			printf("<div class=\"alert alert-danger center\">Unknown error (%d).</div>", $error);
			break;
		}
	}
	?>
	<div class="page-header">
		<h1>Your Overview<div class="btn-group pull-right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#cubeModal">Add Device</button></div></h1>
	</div>

	<?php
	// Get user cubes
	$cubes = $user->getCubes();

	foreach($cubes as $cube) {
		$cube = new Cube($cube->id);
		?>
		<div class="well top">
			<div class="media">
				<div class="pull-left icon cube img-responsive"><i class="fa fa-cube"></i></div>
				<div class="media-body">
					<h4 class="media-heading">
						<?php print($cube->getName()); ?> - <small class="cube-connect-status" data-cubeaccesstoken="<?php print($cube->getPublicAccessToken()); ?>" data-cubeid="<?php print($cube->getID()); ?>">Contacting <i class="fa fa-circle-o-notch fa-spin"></i></small>
						<?php
						/*printf(
							"%s - <small>%s <i class=\"fa fa-%s text-%s\"></i></small>",
							$cube->get("Name"),
							$connected ? "Connected" : "Not connected",
							$connected ? "check-circle" : "exclamation-circle",
							$connected ? "success" : "danger"
						);*/
						?>
						<button type="button" class="close pull-right" data-cubeid="<?php print($cube->getID()); ?>" data-cubename="<?php print($cube->getName()); ?>" data-target="#deleteCube" data-toggle="modal" aria-hidden="true">&times;</button>
					</h4>
					Active Rules
				</div>
			</div>
		</div>
		<?php
	}

	if(empty($cubes)) {
		?>
		<div class="well top">
			No Devices connected.
		</div>
		<?php
	}
	?>
</div>