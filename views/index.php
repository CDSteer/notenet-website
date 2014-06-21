<?php
if($service->isLoggedIn()) {
	// Direct user to the dashboard if they are logged in
	nc_goto("dashboard");
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
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item bg bg1 active">
            <div class="container">
            <div class="carousel-caption">
              <h1>Connect</h1>
              <p>Register with NoteNet and within minutes connect multiple devices and receive ambient notifications.</p>
              <p><a class="btn btn-lg btn-warning" href="<?php nc_href("signup"); ?>" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item bg bg2">
          <div class="container">
            <div class="carousel-caption">
              <h1>What is NoteNet?</h1>
              <p>NoteNet is an open source ambient notification platform that gives you power over your notifications.</p>
              <p><a class="btn btn-lg btn-warning" href="<?php nc_href("about"); ?>" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item bg bg3">
          <div class="container">
            <div class="carousel-caption">
              <h1>Getting Started</h1>
              <p>Connecting a device and receiving ambient notifications is quick and simple start now!</p>
              <p><a class="btn btn-lg btn-warning" href="<?php nc_href("help"); ?>" role="button">Get started!</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
	<!-- Main content -->
	<div id="wrap">
		<div class="container centerContent">
      <div class="row">
            <div class="col-lg-4">
              <div class="icon cubes img-responsive"><i class="fa fa-cubes"></i></div>
              <h2>Connect</h2>
              <p>Register with NoteNet and within minutes connect multiple devices and receive ambient notifications at home, work or on the go .</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
              <div class="icon cubes img-responsive"><i class="fa fa-question"></i></div>
              <h2>What is NoteNet?</h2>
              <p>NoteNet is an open source ambient notification platform that gives you power over your notifications. By connecting a device and setting up a few ambient notification tasks your device will emit coloured lights to easily communicate the information thats important to you.</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
              <div class="icon cubes img-responsive"><i class="fa fa-arrow-right"></i></div>
              <h2>Getting Started</h2>
              <p>Connecting a device and receiving ambient notifications is quick and simple and with our documentation for users and developers using NoteNet or it's API couldn't be easier.</p>
            </div><!-- /.col-lg-4 -->
          </div><!-- /.row -->
		</div>
	</div>

	<!-- Footer -->
	<?php nc_foot(); ?>
	<?php nc_footer(); ?>
</body>
</html>