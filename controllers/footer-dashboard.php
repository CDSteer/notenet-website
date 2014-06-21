<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-md-2"></div>
			<div class="col-sm-9 col-md-10 col-md-offset-2">
				<p class="text-muted">
					&copy; 2014 NoteNet &middot; <a href="<?php nc_href("privacy"); ?>">Privacy Policy</a>
					<span class="pull-right">NoteNet uses cookies.</span>
				</p>
			</div>
		</div>
	</div>
</div>
<?php nc_script("typeahead", FALSE); ?>
<?php nc_script("api/Code", FALSE); ?>
<script>
	var cities;
	var checkInterval = null;

	$(document).ready(function() {
		// Check cube connection status
		setTimeout(function() { checkCubes(); }, 500);
		checkInterval = setInterval(function() { checkCubes(); }, 3000);

		// TODO : Fix location autocomplete
		cities = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			limit: 10,
			prefetch: {
				url: "<?php print(nc_href('gateway.php')); ?>?do=city_all",
				filter: function(list) {
					return $.map(list, function(city) { return { name: city.name, id: city.id, country: city.country, latitude: city.latitude, longitude: city.longitude }; });
				}
			}
		});

		cities.initialize();

		$("input#location.typeahead").typeahead(null, {
			name: "cities",
			displayKey: "name",
			// `ttAdapter` wraps the suggestion engine in an adapter that
			// is compatible with the typeahead jQuery plugin
			source: cities.ttAdapter()
		});

		// Delete cube modal
		$(document).on("click", "button[data-toggle=\"modal\"][data-target=\"#deleteCube\"]", function() {
			var cubeName = $(this).attr("data-cubeName");
			var cubeId = $(this).attr("data-cubeId");
			$("#deleteCube #deleteCubeName").text(cubeName);
			$("#deleteCube #deleteCubeId").val(cubeId);
		});

		$("ul.nav li a[href=\"#Weather\"]").click(function() {
			updateMaps();
		});
	});

	function updateMaps() {
		$(".cubeLocationFrame").each(function(i, v) {
			$(v).attr("src", "https://www.google.com/maps/embed/v1/view?key=AIzaSyCkNDjcFn54IDyLOwpWdlFkO5nPTTNVNz4&zoom=11&center=" + $(v).attr("data-center"));
		});
	}

	function checkCubes() {
		$("small.cube-connect-status").each(function(i, v) {
			var cube_id = $(this).attr("data-cubeid");
			var cube_access_token = $(this).attr("data-cubeaccesstoken");

			if($(v).attr("disabled") == "disabled") {
				return;
			}

			$.ajax({
				url: "<?php print(nc_href('api/v1/devices/')); ?>" + cube_id + "/ping",
				data: {
					access_token: cube_access_token
				},
				type: "POST",
				timeout: 3000
			}).success(function(data) {
				var result = $.parseJSON(data);

				if(result.ok) {
					$(v).html("Connected <i class=\"fa fa-check-circle text-success\"></i>");
				} else {
					switch(result.code) {
						case Code.SUCCESS:
						$(v).html("Connected <i class=\"fa fa-check-circle text-success\"></i>");
						break;

						case Code.CANT_CONNECT_TO_DEVICE:
						$(v).html("Disconnected <i class=\"fa fa-exclamation-circle text-danger\"></i>");
						break;

						case Code.NO_SUCH_DEVICE:
						case Code.INVALID_DEVICE:
						$(v).attr("disabled", "disabled").parent().parent().parent().parent().fadeTo("fast", 0.5);
						$(v).html("Invalid device <i class=\"fa fa-exclamation-circle text-danger\"></i>");
						break;

						default:
						$(v).html("Error <i class=\"fa fa-exclamation-circle text-warning\"></i>");
						break;
					}
				}
			}).fail(function() {
				$(v).html("Failed. Error pinging <i class=\"fa fa-exclamation-triangle text-warning\"></i>");
			});
		});
}

$(document).ready(function(){
	$('#signoutButton').on('click', function(event) {
		gapi.auth.signOut();
	});
});
</script>