	<?php
	session_start();

	if (!isset($_SESSION['isLogin'])) {
		header("Location: index.php");
		die();
	}

  
  $db = '';

  if ($_SESSION['environment'] == 'live'){
    $db = "BCA.Commission_Data_1";
  } else {
    $db = "BCA.TESTCommission_Data_1";
  }
  

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<!---	<link rel="icon" href="../../favicon.ico">	-->

		<title>Broker Commission</title>

		<!-- Bootstrap core CSS -->
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

		<!--  jQuery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- JQuery UI for autocomplete-->
    <link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <!--script src="YourJquery source path"></script-->
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js" ></script>


		<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

		<!-- Bootstrap Date-Picker Plugin -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

		<!-- Custom styles for this template -->
		<link href="dist/css/sticky-footer-navbar.css" rel="stylesheet">

	</head>

	<?php
	  //include external files here
	include('css/Tab_3.php');
	include('database.php');
	?>

	<body>
		<style>
		.error{
			display: none;
			margin-left: 10px;
		}

		.error_show{
			color: red;
			margin-left: 10px;
		}

		.invalid{
			border: 3px solid red
		}


    [disabled] {
      color : !important grey;
      background-color: !important grey;
    }

    [hidden], template {
      display: none;
    }


	</style>
	<!-- Fixed navbar -->
	<div class="navbar-wrapper">
		<div class="container-fluid">
			<nav class="navbar navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<img id="tester" class= "resize" src="image/Regus_logo15.png" />
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<?php $user = $_GET['user']; ?>
						
           <li> <?php echo '<a href="home_1_invoice_review.php?user=' . $user . '">Invoice Review</a>'; ?></li>
           <?php
              if ($_SESSION['access'] == 'admin'){
                echo '<li> <a href="home_all_update_existing.php?user=' . $user . '">Update Exception Inputs</a></li>';
              }
           ?>
           <li> <?php echo '<a href="home_2_invoice_posting.php?user=' . $user . '">Invoice Posting</a>'; ?></li>
           <!--li class="active"> <?php echo '<a href="home_all_3.php?user=' . $user . '">Add Entry</a>'; ?></li-->
           <li> <?php echo '<a href="home_4_exception_input.php?user=' . $user . '">Exception Input</a>'; ?></li>

						</ul>
						<ul class="nav navbar-nav pull-right">
							<?php $user = $_GET['user']; ?>
							<li class=" dropdown"><a  class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  Logged in as <?php echo $user; ?>  <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><A href="Report_Export.xlsm">Download Report</A></li>
									<li><a  id="btntest"> Change Password</a></li>
									<li class="divider"></li>
									<li><a href="logout.php">Log Out</a></li>

								</ul>
							</li>

						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>

	<div class="container-fluid no-padding">
		<form method="post"  id="myform">
			<div class="content">
				<br>

<fieldset id="inner">
<br>
<h1> <center> <font color="white"> Add Exception Deals </font> </center> </h1>
<br>
<center><button type="submit" name="savebut" id="savebut" class="btn btn-primary custom" data-loading-text="<i class='fa fa-spinner fa-spin'></i> loading" onClick=" this.form.submit(); this.disabled=true;">Save</button>

<button type="submit" name="cancelBut" id="cancelBut" class="btn btn-danger custom" data-loading-text="<i class='fa fa-spinner fa-spin'></i> loading" onClick=" this.form.submit(); this.disabled=true;">Cancel</button></center>
<hr>
<br>

					<div class="form-group" >
						<div class="panel-title text-center" id="searchbar">
							<br>
							<div class="col-xs-12">




<div class="form-group row"> <!--1st row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Reference Number</label>
    <input type="text"  class="form-control" name="reference_number" autocomplete="off" id="reference_number" maxlength="20" style="text-align:center;" value = "">
    <br>
  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Titan Company ID</label>
    <input type="text"  class="form-control" name="titan_company_id" maxlength="20" autocomplete="off"
    id="titan_company_id" style="text-align:center;" value = "">
  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Sale ID</label>
    <input type="text"  class="form-control" maxlength="20" name="sale_id" autocomplete="off" id="sale_id" style="text-align:center;" value = "">
    <br>
  </div>

     <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Centre Name</label>
    <input type="text"  class="form-control" name="centre_name" autocomplete="off" id="centre_name" style="text-align:center;" value = "">
    <br>
  </div>

</div>



<div class="form-group row"> <!--2nd row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Inventory Sale ID</label>
    <input type="text"  class="form-control" maxlength="20" name="inventory_sale_id" autocomplete="off"
    id="inventory_sale_id" style="text-align:center;" value = "">
  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Sale Confirmed Date</label>
    <input type="text"  class="form-control" readonly name="sale_confirmed_date" id="sale_confirmed_date" style="text-align:center;" value = "">
    <br>
  </div>

  <div class="col-md-1">
    <br>
    <label class="col-m-1 control-label" >Global</label>
    <input type="checkbox"  class="form-control" name="isGlobal" autocomplete="off"
    id="isGlobal" style="text-align:center;" value = "">
  </div>

  <div class="col-md-2">
    <br>
    <label class="col-m-2 control-label" >Agent Broker</label>
    <input type="text"  class="form-control" name="agent_broker" autocomplete="off"
    id="agent_broker" style="text-align:center;" value = "">
    <select class="form-control" name="agent_broker_global"
    id="agent_broker_global" style="text-align:center;" hidden>
      <option></option>
      <option value="Instant Offices">Instant Offices</option>
      <option value="Flexi Offices (I)">Flexi Offices (I)</option>
      <option value="SOS">SOS</option>
      <option value="Office Broker Ltd (I)">Office Broker Ltd (I)</option>
      <option value="Matchoffice">Matchoffice</option>
      <option value="CBRE_US">CBRE_US</option>
      <option value="Office Network US">Office Network US</option>
      <option value="Office-Hub">Office-Hub</option>
      <option value="JLL_US">JLL US</option>
    </select>

  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Agent Broker Country</label>
    <input type="text"  class="form-control" name="agent_broker_country" autocomplete="off" id="agent_broker_country" style="text-align:center;" value = "">
    <br>
  </div>

</div>

<div class="form-group row"> <!--3rd row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Agent Broker Contact Name</label>
    <input type="text"  class="form-control" name="agent_broker_contact_name" autocomplete="off"
    id="agent_broker_contact_name" style="text-align:center;" value = "">
  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Agent Broker Contact Email</label>
    <input type="text"  class="form-control" name="agent_broker_contact_email" autocomplete="off" id="agent_broker_contact_email" style="text-align:center;" value = "">
    <br>
  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Agent Broker Contact Country</label>
    <input type="text"  class="form-control" name="agent_broker_contact_country" autocomplete="off"
    id="agent_broker_contact_country" style="text-align:center;" value = "">
  </div>

    <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Company Name</label>
    <input type="text"  class="form-control" name="company_name" autocomplete="off" id="company_name" style="text-align:center;" value = "">
    <br>
  </div>

</div>


<br>



<div class="form-group row"> <!--4th row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Company Contact</label>
    <input type="text"  class="form-control" name="company_contact" autocomplete="off"
    id="company_contact" style="text-align:center;" value = "">

  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Product Group</label>

    <select class="form-control" name="product_group_name"
        id="product_group_name" style="text-align:center;">
      <option></option>
      <option value="Business World">Business World</option>
      <option value="Office">Office</option>
      <option value="Virtual Office">Virtual Office</option>
      <option value="Workplace Recovery">Workplace Recovery</option>
    </select>

    <br>
  </div>

   <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >is Month to Month Contract</label>

<select class="form-control" name="ismtm"
    id="ismtm" style="text-align:center;">
  <option></option>
  <option value="1">Yes</option>
  <option value="0">No</option>
</select>

  </div>

    <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >MTM Commission Payment Month</label>

<select class="form-control" name="mtmpaymentmonth"
    id="mtmpaymentmonth" style="text-align:center;">+
  <option></option>
  <option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
</select>

    <br>
  </div>

</div>

<div class="form-group row"> <!--5th row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Inventory Name</label>
    <input type="text"  class="form-control" name="inventory_name" autocomplete="off"
    id="inventory_name" style="text-align:center;" value = "">
  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Agreement Start Date</label>
    <input type="text"  class="form-control" readonly name="agreement_start_date"  id="agreement_start_date" style="text-align:center;" value = "">
    <br>
  </div>

   <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Agreement End Date</label>
    <input type="text"  class="form-control" name="agreement_end_date"
    id="agreement_end_date" readonly style="text-align:center;" value = "">
  </div>

   <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Months To Break</label>
    <input type="text"  class="form-control" name="months_to_break" autocomplete="off" id="months_to_break" style="text-align:center;" value = "">
    <br>
  </div>

</div>


<div class="form-group row"> <!--6th row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Workstations</label>
    <input type="text"  class="form-control" name="workstations" autocomplete="off"
    id="workstations" style="text-align:center;" value = "">

  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Average Monthly Price</label>
    <input type="text"  class="form-control" name="average_monthly_price" autocomplete="off" id="average_monthly_price" style="text-align:center;" value = "">
    <br>
  </div>

   <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Country of Centre</label>
    <input type="text"  class="form-control" name="country_of_centre" autocomplete="off"
    id="country_of_centre" style="text-align:center;" value = "">
  </div>



</div>

<br>
<hr>
<br>

<div class="form-group row"> <!--7th row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Legal Entity</label>
    <input type="text"  class="form-control" name="Legal_Entity" autocomplete="off"
    id="Legal_Entity" style="text-align:center;" value = "">

  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Entity Address</label>
    <input type="text"  class="form-control" name="Entity_Address" autocomplete="off" id="Entity_Address" style="text-align:center;" value = "">
    <br>
  </div>

    <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Vat (if Applicable)</label>
    <input type="text"  class="form-control" name="vat" autocomplete="off"
    id="vat" style="text-align:center;" value = "">
  </div>

    <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Contract Value Local</label>
    <input type="text"  class="form-control" name="contract_value_local" autocomplete="off" id="contract_value_local" style="text-align:center;" value = "">
    <br>
  </div>

</div>


<div class="form-group row"> <!--8th row-->

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Commission Amount Local</label>
    <input type="text"  class="form-control" name="commission_amount_local" autocomplete="off"
    id="commission_amount_local" style="text-align:center;" value = "">

  </div>

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Currency</label>
    <input type="text"  class="form-control" name="currency" autocomplete="off" id="currency" style="text-align:center;" value = "">
    <br>
  </div>

    <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Agent Broker Currency</label>
    <input type="text"  class="form-control" name="agent_broker_currency" autocomplete="off"
    id="agent_broker_currency" style="text-align:center;" value = "">
    </div>

    <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Exchange Rate</label>
    <input type="text"  class="form-control" name="exchange_rate" autocomplete="off" id="exchange_rate" style="text-align:center;" value = "">
    <br>
    </div>

</div>

<br>
<hr>
<br>

<div class="form-group row">

  <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Commission Amount</label>
    <input type="text"  class="form-control" name="commission_amount" autocomplete="off"
    id="commission_amount" style="text-align:center;" value = "">

  </div>


    <div class="col-md-3">
    <br>
    <label class="col-m-2 control-label" >Exception Reason</label>

<select class="form-control" name="exceptionReason"
    id="exceptionReason" style="text-align:center;">+
  <option></option>
  <option value="Renewal">Renewal</option>
  <option value="MTM">MTM</option>
  <option value="Not captured by deal report">Not captured by deal report</option>
  <option value="Not captured by deal report - MTM">Not captured by deal report - MTM</option>
  <option value="Source Issue">Source Issue</option>
  <option value="Expansion">Expansion</option>
  <option value="Client Moved">Client Moved</option>
  <option value="SPACES - Additional 10%">SPACES - Additional 10%</option>
  <option value="Additional Commission">Additional Commission</option>
  <option value="Movement">Movement</option>
  <option value="Overturn">Overturn</option>
  <option value="Duplicate">Duplicate</option>
  <option value="Duplicate/Overturn">Duplicate/Overturn</option>
</select>

    <br>
  </div>

  <div class="col-md-3">
     <br>
     <label class="col-m-2 control-label"">Encoded By</label>
     <?php $user = $_GET['user']; ?>
     <input type="text" class="form-control" name="review_by_display" id="review_by_display" style="text-align:center;"  readonly value="<?php echo $user; ?>">
     <input type="text" name="review_by" id="review_by" value="<?php print("$user"); ?>" hidden>

     <input type="text" id="getuser" value="<?php print("$user"); ?>" hidden>
   </div>


   <div class="col-md-3">
     <br>
     <label class="col-m-2 control-label" >Date of Encode</label>

     <?php
     date_default_timezone_set('Asia/Hong_Kong');
     $today = date("Y-m-d H:i:s");
     ?>

<input type="text" id="gettoday" name="gettoday" value="<?php print("$today"); ?>" hidden>

     <input type="text" class="form-control" name="date_of_validation_display" id="date_of_validation_display" style="text-align:center;" readonly value="<?php echo $today; ?> ">
     <input type="text" name="date_of_validation" value="<?php print("$today"); ?>" hidden>

   </div>



</div>

</fieldset>

	<br>
	<br>
</div>
</div>
</div>

</div>
</div>

<br>
<br>

<script>

  $(document).ready(function() {
    var date_input2=$('input[name="sale_confirmed_date"]'); //our date input has the name "sale_confirmed_date"
    var date_input3=$('input[name="agreement_start_date"]'); //our date input has the name "agreement_start_date"
    var date_input4=$('input[name="agreement_end_date"]'); //our date input has the name "agreement_end_date"

    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var curDate = new Date();
    var options={
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
      toggleActivate: true,
    };

    date_input2.datepicker(options);
    date_input3.datepicker(options);
    date_input4.datepicker(options);


    $("#mtmpaymentmonth").attr("disabled", true);


  $("#commission_amount_local, #commission_amount, #exchange_rate, #contract_value_local, #average_monthly_price, #months_to_break").on("keypress",function(e){
      switch (e.key){
        case "1":
        case "2":
        case "3":
        case "4":
        case "5":
        case "6":
        case "7":
        case "8":
        case "9":
        case "0":
        case "Backspace":
          return true;
        break;
        case ".":
          if ($(this).val().indexOf(".") == -1){
            return true;
          } else {
            return false;
          }
        break;
        default:
        return false;
      }
      });

  $("#titan_company_id, #sale_id, #inventory_sale_id, #workstations").on("keypress",function(e){
      switch (e.key){
        case "1":
        case "2":
        case "3":
        case "4":
        case "5":
        case "6":
        case "7":
        case "8":
        case "9":
        case "0":
        case "Backspace":
        case "-":
          return true;
        break;
        default:
        return false;
      }
      });

$("#titan_company_id, #sale_id, #inventory_sale_id, #workstations, #average_monthly_price, #months_to_break, #contract_value_local, #exchange_rate, #commission_amount_local, #commission_amount").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
      var pasteData = e.originalEvent.clipboardData.getData('text');
      var returnData = pasteData.replace(/[^0-9.]/g, "");
      e.preventDefault();
      $(this).val(returnData);
        });

  $("#agent_broker_currency, #currency").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
      var pasteData = e.originalEvent.clipboardData.getData('text');
      var returnData = pasteData.replace(/[^a-z]/gi, "");
      e.preventDefault();

      $(this).val(returnData.toUpperCase());
    });

  $("#Legal_Entity, #Entity_Address, #agent_broker, #agent_broker_contact_name, #agent_broker_contact_email, #company_name, #company_contact, #product_group_name, #vat, #inventory_name, #centre_name").keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z0-9!@#$%^&*()`~_\\-\\+={}\\[\\]:<>,.\/?\\\\ ]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      } else {
        return false;
      }
    });

    $('#currency, #agent_broker_currency').keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      } else {
        return false;
      }
    }).keyup(function(){
      $(this).val($(this).val().toUpperCase());
    });


});

  var required = ['reference_number', 'sale_id', 'sale_confirmed_date', 'agent_broker', 'agent_broker_contact_name', 'agent_broker_contact_email', 'company_name',
  'company_contact', 'ismtm', 'agreement_start_date', 'agreement_end_date', 'months_to_break', 'workstations', 'average_monthly_price', 'country_of_centre',
  'centre_name', 'Legal_Entity', 'Entity_Address', 'contract_value_local', 'commission_amount', 'commission_amount_local', 'currency', 'agent_broker_currency', 'exchange_rate',
  'exceptionReason' ];

  function validateEmail($email){
     var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }

  countries = ['Algeria', 'Angola', 'Argentina', 'Australia', 'Austria', 'Azerbaijan',
  'Bahrain', 'Bangladesh', 'Barbados', 'Belgium', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria',
  'Cambodia', 'Canada', 'Chile', 'China', 'Colombia', 'Costa Rica', 'Côte d\'Ivoire', 'Croatia', 'Cyprus', 'Czech Republic',
  'Denmark', 'Djibouti', 'Dominican Republic',
  'Ecuador', 'Egypt', 'El Salvador', 'Estonia',
  'Finland', 'France',
  'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Guatemala', 'Guinea',
  'Hong Kong', 'Hungary',
  'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Israel', 'Italy',
  'Japan', 'Jordan',
  'Kazakhstan', 'Kenya', 'Kuwait',
  'Latvia', 'Lebanon', 'Lithuania', 'Luxembourg',
  'Macau', 'Madagascar', 'Malaysia', 'Malta', 'Mauritius', 'Mexico', 'Monaco', 'Morocco', 'Mozambique',
  'Namibia', 'Nepal', 'Netherlands', 'New Zealand', 'Nigeria', 'Norway',
  'Oman',
  'Pakistan', 'Panama', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Puerto Rico',
  'Qatar',
  'Republic of Ireland', 'Romania', 'Russia', 'Rwanda',
  'Saudi Arabia', 'Senegal', 'Serbia', 'Singapore', 'Slovakia', 'Slovenia', 'South Africa', 'South Korea', 'Spain', 'Sri Lanka', 'Sudan', 'Sweden', 'Switzerland',
  'Taiwan', 'Tanzania', 'Thailand', 'Trinidad and Tobago', 'Tunisia', 'Turkey',
  'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States of America', 'Uruguay',
  'Venezuela', 'Vietnam',
  'Zambia', 'Zimbabwe'
];

  function removeFromRequired(fieldname){
      required = jQuery.grep(required, function(value){
        return value != fieldname;
      });
      $('#'+fieldname).removeClass("invalid");
      $('#'+fieldname).val('');
  }

  function addtoRequired(fieldname){
     required.push(fieldname);
  }

  $("#agent_broker_contact_country").autocomplete({
    source: countries,
     messages: {
        noResults: '',
        results: function() {}
    }
  });

  $("#agent_broker_country").autocomplete({
    source: countries,
     messages: {
        noResults: '',
        results: function() {}
    }
  });

  $("#country_of_centre").autocomplete({
    source: countries,
     messages: {
        noResults: '',
        results: function() {}
    }
  });

  $('#isGlobal').change(function(){
      if(this.checked){
        $('#agent_broker').fadeOut('fast');
        $('#agent_broker_global').fadeIn('fast');
        addtoRequired('agent_broker_global');
        removeFromRequired('agent_broker');
      } else {
        $('#agent_broker').fadeIn('fast');
        $('#agent_broker_global').fadeOut('fast');
        addtoRequired('agent_broker');
        removeFromRequired('agent_broker_global');
      }

    });

  $("#ismtm").change(function(){
    var valueSelected = $(this).val();
    if (valueSelected == '1') {
      addtoRequired('mtmpaymentmonth');
      $("#mtmpaymentmonth").attr("disabled", false);
      $("#ismtm").removeClass("invalid");
   } else {
      addtoRequired('ismtm');
      removeFromRequired('mtmpaymentmonth');
      $("#mtmpaymentmonth").attr("disabled", true);
    }
  });



  $("#savebut").click(function(event){
    var errors = [];
    var hasmissing = false;

    var form_data = $("#myform").serializeArray();
    formFields = {};
    $(form_data).each(function(i, field){
      formFields[field.name] = field.value;
    });



    $.each(required, function(index, value) {
      if(formFields[value] == '') {
        hasmissing = true;
        $("#"+value).addClass("invalid");
        //console.log(value)
      } else {
        $("#"+value).removeClass("invalid");
      }
    });

    if(!validateEmail(formFields['agent_broker_contact_email'])){
      $("#agent_broker_contact_email").addClass("invalid");
      errors.push(', Invalid Email format');
      hasmissing = true;
    } else {
      $("#agent_broker_contact_email").removeClass("invalid");
    }

    if (formFields['country_of_centre'] != ''){
      if ( $.inArray(formFields['country_of_centre'], countries) == -1 ){
        $("#country_of_centre").addClass("invalid");
        errors.push(', Invalid Country of Centre ');
        hasmissing = true;
      } else {
        $("#country_of_centre").removeClass("invalid");
      }
    }

    if (formFields['agent_broker_country'] != ''){
      if($.inArray(formFields['agent_broker_country'], countries) == -1){
        $("#agent_broker_country").addClass("invalid");
        errors.push(', Invalid Agent Broker Country ');
        hasmissing = true;
      } else {
        $("#agent_broker_country").removeClass("invalid");
      }
    }

    if (formFields['agent_broker_contact_country'] != ''){
      if($.inArray(formFields['agent_broker_country'], countries) == -1){
        $("#agent_broker_contact_country").addClass("invalid");
        errors.push(', Invalid Agent Broker Contact Country ');
        hasmissing = true;
      } else {
        $("#agent_broker_contact_country").removeClass("invalid");
      }
    }

    if(hasmissing){
      var warning = ''
      warning = warning.concat('Please fill in the required fields ')

      jQuery.each(errors, function(i, val){
        warning = warning.concat(val);
      });

      alert(warning)

      event.preventDefault();
    } else {
      var result = window.confirm('Are you sure you want to save the following data?');
      if (result) {
        return true;
      } else {
        event.preventDefault();
      }
    }
  });



</script>



	<?php
  include('database.php');

  function saveTransaction($conn, $description, $auditDb){
    $user = $_GET['user'];
    $Reference_Number1 = $_POST['reference_number'];

    $query1 = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
    $query1->execute(array($user));
    $result1 = $query1->fetch(PDO::FETCH_LAZY, 0);

    $Chk_Name = $result1['Chk_Name'];
    $Chk_Username = $result1['Chk_Username'];
    $Chk_Position = $result1['Chk_Position'];

    $save_db = $conn->query("INSERT INTO ".$auditDb." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', '$description', getdate());");

    if (!$save_db){
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }
  }

  function saveRecord($conn, $statement){
    //$create_date = $_POST['create_date'];
    $Reference_Number1 = $_POST['reference_number'];
    $inventory_sale_id = $_POST['inventory_sale_id'];

    $query = $conn->query($statement);

    if($query){
      echo "<script type='text/javascript'>alert('Data Added, Check Invoice Review Tab for the record.')</script>";
      saveTransaction($conn, "User added entry for reference_number: $Reference_Number1 and inventory sale id: $inventory_sale_id.", $_SESSION['auditdb']);
    } else {
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
      $error = $query->errorInfo();

      foreach ($error as $value) {
        echo "<script>console.log('$value')</script>";
        print("error caught:".$value);
      }
    }
  }

  function removeSpecialCharacters($string){
    $return_String = str_replace('(', '\(', $string);
    return str_replace(')', '\)', $return_String);
  }

  if(isset($_POST['savebut'])){

    //$create_date                  = $_POST['create_date'];
    $reference_number             = (strlen($_POST['reference_number']) > 0 ? "'".$_POST['reference_number']."'" : "NULL"  );
    $titan_company_id             = (strlen($_POST['titan_company_id']) > 0 ? "'".$_POST['titan_company_id']."'" : "NULL"  );
    $sale_id                      = (strlen($_POST['sale_id']) > 0 ? "'".$_POST['sale_id']."'" : "NULL"  );
    $inventory_sale_id            = (strlen($_POST['inventory_sale_id']) > 0 ? "'".$_POST['inventory_sale_id']."'" : "NULL"  );
    $sale_confirmed_date          = (strlen($_POST['sale_confirmed_date']) > 0 ? "'".$_POST['sale_confirmed_date']."'" : "NULL"  );

    if(isset($_POST['isGlobal'] )){
      $agent_broker                 = "'".$_POST['agent_broker_global']."'";
    } else {
      $agent_broker                 = (strlen($_POST['agent_broker']) > 0 ? "'".$_POST['agent_broker']."'" : "NULL"  );
    }

    $agent_broker_country         = (strlen($_POST['agent_broker_country']) > 0 ? "'".$_POST['agent_broker_country']."'" : "NULL"  );
    $agent_broker_contact_name    = (strlen($_POST['agent_broker_contact_name']) > 0 ? "'".$_POST['agent_broker_contact_name']."'" : "NULL"  );
    $agent_broker_contact_email   = (strlen($_POST['agent_broker_contact_email']) > 0 ? "'".$_POST['agent_broker_contact_email']."'" : "NULL"  );
    $agent_broker_contact_country = (strlen($_POST['agent_broker_contact_country']) > 0 ? "'".$_POST['agent_broker_contact_country']."'" : "NULL"  );
    $company_name                 = (strlen($_POST['company_name']) > 0 ? "'".$_POST['company_name']."'" : "NULL"  );
    $company_contact              = (strlen($_POST['company_contact']) > 0 ? "'".$_POST['company_contact']."'" : "NULL"  );
    $product_group_name           = (strlen($_POST['product_group_name']) > 0 ? "'".$_POST['product_group_name']."'" : "NULL"  );
    $country_of_centre            = (strlen($_POST['country_of_centre']) > 0 ? "'".$_POST['country_of_centre']."'" : "NULL"  );
    $centre_name                  = (strlen($_POST['centre_name']) > 0 ? "'".$_POST['centre_name']."'" : "NULL"  );
    $inventory_name               = (strlen($_POST['inventory_name']) > 0 ? "'".$_POST['inventory_name']."'" : "NULL"  );
    $workstations                 = (strlen($_POST['workstations']) > 0 ? $_POST['workstations'] : "NULL"  );
    $agreement_start_date         = (strlen($_POST['agreement_start_date']) > 0 ? "'".$_POST['agreement_start_date']."'" : "NULL"  );
    $agreement_end_date           = (strlen($_POST['agreement_end_date']) > 0 ? "'".$_POST['agreement_end_date']."'" : "NULL"  );
    $average_monthly_price        = (strlen($_POST['average_monthly_price']) > 0 ? $_POST['average_monthly_price'] : "NULL"  );
    $months_to_break              = (strlen($_POST['months_to_break']) > 0 ? $_POST['months_to_break'] : "NULL"  );
    $ismtm                        = (strlen($_POST['ismtm']) > 0 ? $_POST['ismtm'] : "NULL"  );

    if(isset($_POST['mtmpaymentmonth'])){
      $mtmpaymentmonth              = (strlen($_POST['mtmpaymentmonth']) > 0 ? $_POST['mtmpaymentmonth'] : "NULL"  );
    } else {
      $mtmpaymentmonth              = "0";
    }

    $Legal_Entity                 = (strlen($_POST['Legal_Entity']) > 0 ? "'".$_POST['Legal_Entity']."'" : "NULL"  );
    $Entity_Address               = (strlen($_POST['Entity_Address']) > 0 ? "'".$_POST['Entity_Address']."'" : "NULL"  );
    $vat                          = (strlen($_POST['vat']) > 0 ? "'".$_POST['vat']."'" : "NULL"  );
    $contract_value_local         = (strlen($_POST['contract_value_local']) > 0 ? $_POST['contract_value_local'] : "NULL"  );
    $currency                     = (strlen($_POST['currency']) > 0 ? "'".$_POST['currency']."'" : "NULL"  );
    $agent_broker_currency        = (strlen($_POST['agent_broker_currency']) > 0 ? "'".$_POST['agent_broker_currency']."'" : "NULL"  );
    $exchange_rate                = (strlen($_POST['exchange_rate']) > 0 ? $_POST['exchange_rate'] : "NULL"  );
    $commission_amount      = (strlen($_POST['commission_amount']) > 0 ? $_POST['commission_amount'] : "NULL"  );
    $commission_amount_local      = (strlen($_POST['commission_amount_local']) > 0 ? $_POST['commission_amount_local'] : "NULL"  );
    $exceptionReason              = (strlen($_POST['exceptionReason']) > 0 ? "'".$_POST['exceptionReason']."'" : "NULL"  );
    $review_by_display = $_POST['review_by_display'];
    $date_of_validation_display = $_POST['date_of_validation_display'];

    $statement = "insert into ".$db." (Reference_number,
     titanCompanyId,
     saleid,
     inventorySaleId,
     [Sale Confirmed Date],
      Broker_Company_Name,
      Broker_Company_Country,
      Broker_Agent_Name,
      Broker_Agent_Email,
      Broker_Agent_Country,
      CompanyName,
      Company_Contact,
      ProductGroupName,
      [Country of Centre],
      CentreName,
      InventoryName,
      InventorySaleWorkstations,
      [Start Date],
      [End Date],
      Average_Monthly_Price_Local,
      [Term (Months)],
      IsMtm,
      [MTM commission Payment Month],
      LegalEntity,
      Entity_Address,
      VatCode,
      [Total Contract Value Local],
      [Contract Currency],
      [Exchange Rate from GBP to Payment Currency],
      [Payment Currency],
      Commission_Amount_Local,

      Exception_Reason,
      isCurrent,
      isException,
      Sent,
      Commission_Amount,
      Encoded_by,
      Date_of_Encode)

      values

       ($reference_number,
        $titan_company_id,
        $sale_id,
        $inventory_sale_id,
        $sale_confirmed_date,
       $agent_broker,
       $agent_broker_country,
       $agent_broker_contact_name,
       $agent_broker_contact_email,
       $agent_broker_contact_country,
       $company_name,
       $company_contact,
       $product_group_name,
       $country_of_centre,
       $centre_name,
       $inventory_name,
       $workstations,
       $agreement_start_date,
       $agreement_end_date,
       $average_monthly_price,
       $months_to_break,
       $ismtm,
       $mtmpaymentmonth,
       $Legal_Entity,
       $Entity_Address,
       $vat,
       $contract_value_local,
       $currency,
       $exchange_rate,
       $agent_broker_currency,
       $commission_amount_local,

       $exceptionReason,
       1,
       1,
       1,
        $commission_amount,
       '$review_by_display',
        '$date_of_validation_display')";


    //print($statement);
    saveRecord($conn, $statement);
  }

	if(isset($_POST['submit'])){
		//$current_password = $_POST['current_password'];
		$old_password = $_POST['old_password'];

		$sth = $conn->prepare('Select * from bca.Checking_Login where  Chk_Password = ?');

		$sth->execute(array($old_password));
		$result = $sth->fetch(PDO::FETCH_LAZY, 0);
						//print var_dump($result);
		$chk_password = $result['Chk_Password'];

		if($chk_password == $old_password) {
			$new_password = $_POST['new_password'];
			$confirm_password = $_POST['confirm_password'];
			$user = $_GET['user'];
			$new_password = $_POST['new_password'];

			if($new_password == $confirm_password){

				$query = $conn->query("update bca.Checking_Login set Chk_Password = '$new_password' where Chk_Username = '$user'");
				$query->execute();
				$query = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
				$query->execute(array($user));
				$result1 = $query->fetch(PDO::FETCH_LAZY, 0);
				$Chk_Name = $result1['Chk_Name'];
				$Chk_Username = $result1['Chk_Username'];
				$Chk_Position = $result1['Chk_Position'];

				$save_db = $conn->query("INSERT INTO ".$auditDb." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'password changed to $new_password', getdate());");

				echo "<script type='text/javascript'>alert('Password was changed, Please Login again!')</script>";
				session_destroy();
				session_unset();
				?>

				<script type="text/javascript">
					window.location = "../regus.bca/index.php";
				</script>

				<?php
				die();
			}else{
				echo "<script>alert('Password Mismatch');</script>";
			}

		}else{
			echo "<script>alert('Old Password is Incorrect');</script>";
		}
	}
  ?>

  <script>
    $('#btntest').click(function() {
      $('#modelWindow').modal('show');
    });
  </script>

  <div class="modal fade" id="modelWindow" role="dialog">
    <div class="modal-dialog modal-sm vertical-align-center">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Password</h4>
				</div>
        <div class="modal-body">
          <div class="modal-body form-horizontal">
            <div class="control-group">
							<label for="old_password"  id="kulay" class="control-label">Old Password</label>
							<div class="controls">
								<input type="password" maxlength="8" class="form-control" name="old_password">
							</div>
						</div>
						<div class="control-group">
							<label for="new_password" id="kulay" class="control-label">New Password</label>
							<div class="controls">
								<input type="password"   maxlength="8" class="form-control" name="new_password">
							</div>
						</div>
						<div class="control-group">
							<label for="confirm_password" id="kulay" class="control-label">Confirm New Password</label>
							<div class="controls">
								<input type="password" maxlength="8"  class="form-control" name="confirm_password">
							</div>
						</div>
					</div>
        </div>
        <div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
					<button class="btn btn-default btn-success" type="save_record" name="submit" value="Submit">Save</button>
				</div>
			</div>
		</div>
	</div>
</form>

  <!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
  <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
