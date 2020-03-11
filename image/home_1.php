
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
	<!--  jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

	<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

	<!-- Bootstrap Date-Picker Plugin -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/sticky-footer-navbar.css" rel="stylesheet">

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

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" >Regus</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a>Update Record</a></li>
			<li><a>Show All Record</a></li>
			
		<?php $user = $_GET['user']; ?>
		
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $user; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Settings</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="index.php">Logout</a></li>
              </ul>
            </li>	
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
		<h2>
			Broker Commission
		</h2>
		
		
	<!-- put codes here -->
	

	
				<div class="form-group">
					<label class="col-m-2 control-label">Enter Inventory Sale ID</label>
					
					<br>
					<div class="col-xs-4">
						<input type="text" name="emp_id" class="form-control" placeholder="Inventory Sale ID" required>
					</div>
					
				<button type="button" class="btn btn-primary">Search</button>
				</div>
				
	
	<h6>____________________________________________________________________________________________________________________________________________________</h6>
	 <div class="container"> </div>
	 

		
		<form class="form-horizontal" action="" method="post">
			
			
			
				<div class="form-group">
					<label class="col-m-2 control-label">Reference Number</label>
					
					<br>
					<div class="col-xs-4">
						<input type="text" name="emp_id" class="form-control"  disabled>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-m-2 control-label">Sale ID</label>
					<br>
					<div class="col-xs-4">
						<input type="text" name="name" class="form-control"  disabled>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-m-2 control-label">Inventory Sale ID</label>
					<br>
					<div class="col-xs-4">
						<input type="text" name="dept" class="form-control" disabled>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-m-2 control-label">Broker Name</label>
					<br>
					<div class="col-xs-4">
						<input type="text" name="bldg" class="form-control"  disabled>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-m-2 control-label">Commission Amount</label>
					<div>
						<div class="col-xs-4">
						<input type="text" id="staticParent" name="num_kid" class="form-control"  disabled>
					</div>
				</div>
				<!----- -->
				
			
				
			<!----- -->
			<br>
			
			
			
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"> Regus Copyright &copy; 2017 </p>
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
