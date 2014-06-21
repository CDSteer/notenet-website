<div class="modal fade" id="customLight" tabindex="-1" role="dialog" aria-labelledby="customLightLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="ruleModalLabel">New Rule</h4>
			</div>

			<div class="modal-body">
				<form role="form">
					<div class="form-group">
						<label for="ruleName">Name of Rule</label>
						<input type="text" class="form-control" id="ruleName" placeholder="Enter name of the rule.">
					</div>
					<div class="form-group">
						<label for="notification">Notification</label>
						<select class="form-control" id="notification">
							<option>General Notification</option>
							<option>Message Notification</option>
							<option>Friend Request Notification</option>
						</select>
					</div>
					<div class="form-group">
						<label for="dateTime">Date and Time</label>
						<div class="well">
							<div id="datetimepicker3" class="input-append">
								<input data-format="hh:mm:ss" type="text">
								<span class="add-on">
									<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="RGB">Select a Colour</label>
						<div class="well">
							<p>
								<b>R</b> <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="255" data-slider-step="1" data-slider-value="128" data-slider-id="RC" id="R" data-slider-tooltip="show" data-slider-handle="round" >
							</p>
							<p>
								<b>G</b> <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="255" data-slider-step="1" data-slider-value="128" data-slider-id="GC" id="G" data-slider-tooltip="show" data-slider-handle="round" >
							</p>
							<p>
								<b>B</b> <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="255" data-slider-step="1" data-slider-value="128" data-slider-id="BC" id="B" data-slider-tooltip="show" data-slider-handle="round" >
							</p>
							<div id="RGB"></div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" data-target="#ruleModal" data-toggle="modal">Back</button>
				<button type="submit" class="btn btn-primary">Add Rule</button>
			</div>
		</div>
	</div>
</div>