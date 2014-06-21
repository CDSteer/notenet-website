<div class="modal fade" id="cubeModal" tabindex="-1" role="dialog" aria-labelledby="cubeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="cubeModalLabel">New Cube</h4>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php nc_href("gateway.php") ?>" method="post">
					<div class="form-group">
						<label for="cubeName">Name of Cube</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter name of your cube.">
					</div>

					<div class="form-group">
						<label for="accessToken">Access Token.</label>
						<input type="text" class="form-control" id="accessToken" name="accessToken" placeholder="Enter your cube access token.">
					</div>

					<div class="form-group">
						<label for="deviceID">Device ID.</label>
						<input type="text" class="form-control" id="deviceId" name="deviceId" placeholder="Enter your cube device ID.">
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Add Cube</button>
					</div>

					<input type="hidden" name="do" value="cube_create">
				</form>
			</div>
		</div>
	</div>
</div>