<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<a class="navbar-brand navbar-left" href="<?php nc_href(""); ?>">NoteNet <i class="fa fa-cube"></i></a>
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<?php
				if($service->isLoggedIn()) {
					// User is logged in
					nc_li_active("dashboard", "Dashboard");
				} else {
					// User isn't logged in
					nc_li_active("", "Home");
				}

				nc_li_active("about", "About");
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if($service->isLoggedIn()) { ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php print($user->getUsername()); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php nc_li_active("help", "Help"); ?>
						<?php nc_li_active("settings", "Settings"); ?>
						<li class="divider"></li>
						<?php nc_li_active("gateway.php?do=logout", "Logout"); ?>
					</ul>
				</li>
				<?php } else {
				// User isn't logged in
					nc_li_active("login", "Login");
					nc_li_active("signup", "Sign Up");
				}
				?>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>