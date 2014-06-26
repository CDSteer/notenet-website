<div class="modal fade" id="googleTrafficLight" tabindex="-1" role="dialog" aria-labelledby="googleTrafficLightLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="ruleModalLabel">New Traffic Light Ambient Notification Task</h4>
			</div>

			<div class="modal-body">
                <div class="form-group">
                    <label for="ruleName">Name of Task</label>
                    <input type="text" class="form-control" id="ruleName" placeholder="Enter name of the rule.">
				</div>
				<div class="form-group">
				    <label for="calendarList">Select a calendar</label>
				    <select class="form-control" id="calendarList">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
				</div>
				<div class="form-group">
    				<label for="lightTask">Select a task</label>
                    <select class="form-control" id="lightTask">
                        <option>Before an Event starts</option>
                        <option>Before an Event ends</option>
                    </select>
				</div>
				<div class="form-group">
				    <label for="lightTimes">Select a time for each light to activate</label>
                    <div class="well">
                        <p id="error">Light values are valid!</p>
                        <p>
                            <b>Green Light</b><br><input type="text" class="span2 pull-right" value="" data-slider-min="0" data-slider-max="300" data-slider-step="1" data-slider-value="60" data-slider-id="GCL" id="GL" data-slider-tooltip="show" data-slider-handle="round" >
                        </p>
                        <p>
                            <b>Amber Light</b><br><input type="text" class="span2 pull-right" value="" data-slider-min="0" data-slider-max="299" data-slider-step="1" data-slider-value="30" data-slider-id="ACL" id="AL" data-slider-tooltip="show" data-slider-handle="round" >
                        </p>
                        <p>
                            <b>Red Light</b><br><input type="text" class="span2 pull-right" value="" data-slider-min="0" data-slider-max="298" data-slider-step="1" data-slider-value="15" data-slider-id="RCL" id="RL" data-slider-tooltip="show" data-slider-handle="round" >
                        </p>
                        <p>Values from the sliders are in minutes.</p>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" data-target="#ruleModal" data-toggle="modal">Back</button>
			</div>
		</div>
	</div>
</div>