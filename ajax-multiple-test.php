<?php
require_once("lib/common.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<?php nc_head(); ?>
</head>

<body>
	<div id="wrap">
		<div class="container">
			<input class="form-control" type="text" id="city" placeholder="City">

			<div id="results" style="margin-top:20px;">
			</div>
		</div>
	</div>

	<?php nc_foot(); ?>
	<script>
		$(document).ready(function() {
			var val = $("#city").val();
			setInterval(function() {
			//$("#city").on("change keydown keyup", function() {
				var c = $("#city").val();

				if(c != val) {
					val = c;

					$.ajax({
						url: "gateway.php",
						data: {
							_do: "cityLike",
							city: c
						},
						type: "POST"
					}).success(function(data) {
						var json = $.parseJSON(data);
						var html = "";

						$.each(json, function(i, v) {
							html +=
							"<div class=\"well\">" +
							"<div class=\"media map-location\" data-city=\"" + v.ID + "\">" +
							"<a class=\"pull-left\" href=\"#\"><i class=\"fa fa-map-marker text-danger\" style=\"font-size:32px;margin:3px 0 0 3px;\"></i></a>" +
							"<div class=\"media-heading\"><h4>" + v.Name + ", " + v.Country + "</h4></div>" +
							"<iframe src=\"https://www.google.com/maps/embed/v1/view?key=AIzaSyCkNDjcFn54IDyLOwpWdlFkO5nPTTNVNz4&zoom=10&center=" + v.Latitude + "," + v.Longitude + "\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\"></iframe>" +
							"</div>" +
							"</div>";
						});

						$("#results").html(html);
					});
				}
			}, 500);
});
</script>
</body>
</html>