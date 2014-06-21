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
		<div class="container centerContent">
		<div class="panel panel-default">
		<div class="panel-body">
      <div class="row">
        <div class="col-lg-1"></div>
            <a class="well-link" href="#">
            <div class="col-lg-4 well ant-well">
              <div class="icon cubes img-responsive"><i class="fa fa-user"></i></div>
              <h2>User</h2>
              <p>Select the User documentation if you're a user looking to find out how to connect a device, setup different services and receive ambient notifications to your devices.</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2"></div>
            </a>
            <a class="well-link" href="#">
            <div class="col-lg-4 well ant-well">
              <div class="icon cubes img-responsive"><i class="fa fa-users"></i></div>
              <h2>Developer</h2>
              <p>Select the Developer documentation if you're a developer looking to find out how to go beyond the services provided by NoteNet and start developing your applications for your devices.</p>
            </div><!-- /.col-lg-4 -->
            </a>
            <div class="col-lg-1"></div>
          </div><!-- /.row -->
		</div></div>
		</div>
	</div>

	<!-- Footer -->
	<?php nc_foot(); ?>
	<?php nc_footer(); ?>
</body>
</html>