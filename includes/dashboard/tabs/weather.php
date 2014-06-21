<div class="tab-pane fade" id="Weather">
	<div class="well top">
		<div class="media">
			<div class="pull-left icon weather img-responsive"><i class="wi wi-day-sunny-overcast"></i></div>
			<div class="media-body">
				<h4 class="media-heading">Weather</h4>
				By setting a location you're able to receive ambient notifications for the current weather at your location.
				<br>
				<br>
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#tabOne">
									Weather Light Codes<b class="caret"></b>
								</a>
							</h4>
						</div>
						<div id="tabOne" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Colour</th>
												<th>Weather</th>
											</tr>
										</thead>
										<tbody>
											<tr class="success">
												<td>Green</td>
												<td>Includes Clear skies, few clouds, light breeze and hot weather.</td>
											</tr>
											<tr class="info">
												<td>Light Blue</td>
												<td>Includes light drizzle, showers and rain.</td>
											</tr>
											<tr class="primary">
												<td>Dark Blue</td>
												<td>Includes moderate to heavy rain, hail and heavy showers.</td>
											</tr>
											<tr class="warning">
												<td>Yellow</td>
												<td>Includes thunderstorms and light to heavy rain.</td>
											</tr>
											<tr class="danger">
												<td>Red</td>
												<td>Includes all dangerous weathers such as fog, snow, storms, hurricanes etc. Weather should be checked to ensure safety.</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
					<h4 class="media-heading"><?php print($cube->getName()); ?></h4>
					<form role="form" action="<?php nc_href("gateway.php") ?>" method="post">
						<div class="form-group">
							<label for="location"><?php print($cube->getName()); ?> Location</label>
							<input type="hidden" name="cube" value="<?php print($cube->getID()); ?>">
							<input type="text" class="form-control typeahead" id="location" name="location" value="<?php printf("%s, %s", $cube->getLocation()->name, $cube->getLocation()->country); ?>" placeholder="Enter city of <?php print($cube->getName()); ?>">
							<input type="hidden" name="do" value="addWeatherLocation">
						</div>
						<button class="btn btn-spotify" value="submit" type="submit"><i class="wi wi-day-sunny-overcast"></i> Update Location</button>
					</form>
                    <div class="suggestionBox"></div>
					<iframe data-center="<?php printf("%f,%f", $cube->getLocation()->latitude, $cube->getLocation()->longitude); ?>" class="cubeLocationFrame" src="" width="100%" height="200" frameborder="0" style="border:0;margin-top:20px;"></iframe>
				</div>
			</div>
		</div>
		<?php
	}

	if(empty($cubes)) {
		?>
		<div class="well top">
			No cubes connected.
		</div>
		<?php
	}
	?>
</div>