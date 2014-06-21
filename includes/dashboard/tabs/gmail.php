<div class="tab-pane fade" id="Gmail">
	<div class="well top">
		<div class="media">
			<div class="pull-left icon gmail img-responsive"><i class="fa fa-envelope"></i></div>
			<div class="media-body">
				<h4 class="media-heading">Gmail</h4>By connecting Gmail you're able to retrieve and receive ambient notifications from your Gmail account. <br>
				<br>
<!-- gateway.php?do=auth&x=gmail -->
<!-- 
https://www.googleapis.com/auth/calendar
https://www.googleapis.com/auth/drive.readonly
-->
				<button type="button" class="btn btn-gmail g-signin" id="signinButton" 

    data-scope="https://www.googleapis.com/auth/plus.login"
    data-clientid="315310379653-dqcepo7v2bl6knjpa1gnrdhjiqaqq50f.apps.googleusercontent.com"
    data-redirecturi="postmessage"
    data-accesstype="offline"
    data-cookiepolicy="single_host_origin"
    data-callback="signInCallback">
                <i class="fa fa-envelope"></i> Connect Gmail</button>
				<button type="button" class="btn btn-default g-signout" onclick="signout()" id="signoutButton" disabled="disabled">Disconnect Gmail</button>
			</div>
		</div>
	</div>
</div>