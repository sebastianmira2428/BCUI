<?php
	//session_start();
	if (isset($_SESSION['isLogin'])) {
		header("Location: home_1_invoice_review.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<!---	<link rel="icon" href="../../favicon.ico">	-->

    <title>Broker Commission</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/sticky-footer-navbar.css" rel="stylesheet">

		<!-- Website Font style -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <style>
  body, html{
	 background: #00ff00 url("image/6.jpg") no-repeat center center fixed;
	 background-size: 100% 100%;

 	background-repeat: no-repeat;
 	background-color: #d3d3d3;
 	font-family: 'Oxygen', sans-serif;
}

.main{
 	margin-top: 70px;
}

h1.title {
	font-size: 50px;
	font-family: 'Oxygen', sans-serif;
	font-weight: 400;
}

hr{
	width: 10%;
	color: #fff;
}

.form-group{
	margin-bottom: 15px;
}

label{
	margin-bottom: 15px;
}

input,
input::-webkit-input-placeholder {
    font-size: 11px;
    padding-top: 3px;
}

.main-login{
 	background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
 	margin-top: 30px;
 	margin: 0 auto;
 	max-width: 330px;
    padding: 40px 40px;

}

.login-button{
	margin-top: 5px;
}

.login-register{
	font-size: 11px;
	text-align: center;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 450px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.main-login {

    border: 1px solid silver;
	background-color: rgba(0,0,0,0.65)
	}

label {

	color: white;

}

#forgots {

	color: 	#87CEEB;
}

#tester {

user-drag: none;
user-select: none;
-moz-user-select: none;
-webkit-user-drag: none;
-webkit-user-select: none;
-ms-user-select: none;
	}

	#showHide {
  width: 15px;
  height: 15px;
  float: left;
}
#showHideLabel {
  float: left;
  padding-left: 5px;
}

#kulay{
	 color: black;
	position: center;
}
  </style>

    <!-- Fixed navbar -->


    <!-- Begin page content -->
    <div class="container">

		<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
     <div class="panel-title text-center">

			<img id="tester" src="image/logo.png" style="height: 150px; width: auto;"/>

			<br>
			<br>


<div class="main-login main-center">
<form method="post" action="login-query.php">


						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="username"  autocomplete="off" placeholder="Enter your Username" autofocus="autofocus" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>

									<input type="password" data-toggle="password" class="form-control password" maxlength="8" name="password" id="password"  placeholder="Enter your Password"/>


								</div>
								<td>
							  <input type="checkbox" id="showHide" />
							  <label for="showHide" id="showHideLabel">Show Password</label>
							</td>
							</div>
						</div>

						<div class="form-group ">
							<button type="submit" name="submitbtn" id="submitbtn" onClick=" this.form.submit(); this.disabled=true;" class="btn btn-primary btn-lg btn-block login-button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Logging In">Log in</button>
							<button type="button"  class="btn btn-link" id="forgots">Forgot Password?</button>
						</div>



						<div class="dropdown">

						<br>
						<label class="cols-sm-2 control-label" class="btn btn-link">Need Access?</label>
						<div class="dropdown-content">
							<p>Ask access approval from Alfonso Bryan Cabardo III at AlfonsoBryan.Cabardo@regus.com</p>
						  </div>
						</div>



<script>
$(document).ready(function() {
  $("#showHide").click(function() {
    if ($(".password").attr("type") == "password") {
      $(".password").attr("type", "text");

    } else {
      $(".password").attr("type", "password");
    }
  });
});

window.onload = function() {
 var password = document.getElementById('password');
 password.onpaste = function(e) {
   e.preventDefault();
 }

  var username = document.getElementById('username');
 username.onpaste = function(e) {
   e.preventDefault();
 }

 $('#submitbtn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
});

}

</script>

<div class="modal fade" id="modelWindow" role="dialog">
            <div class="modal-dialog modal-sm vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Forgot Password</h4>
                </div>
                <div class="modal-body">


    <div class="modal-body form-horizontal">


		<A href="email change pass.xlsm">Download and Open the Excel file to get your password</A>


    </div>


                </div>
                <div class="modal-footer">


                </div>
              </div>
            </div>
        </div>


</form>
</div>
	</div>
		</div>
			</div>
				</div>
					</div>


						<script>
$('#forgots').click(function() {
   $('#modelWindow').modal('show');
});

	 </script>


    <footer class="footer">

      <div class="container">
        <p class="text-muted">
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
