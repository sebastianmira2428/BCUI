	<?php
	session_start();
	include('database.php');

	if (!isset($_SESSION['isLogin'])) {
		header("Location: index.php");
		die();
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

		<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

		<!-- Bootstrap Date-Picker Plugin -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

		<!-- Custom styles for this template -->
		<link href="dist/css/sticky-footer-navbar.css" rel="stylesheet">

		<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

	</head>

	<?php
	  //include external files here
	include('css/regular_design.php');
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
			border: 1px solid red
		}

		.ui-autocomplete
			{
			z-index: 1051;
			}

  .pac-container {
    z-index: 9999999999 !important;
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
						 <?php
						 if ($_SESSION['environment'] == 'dev'){
						 	echo '*Running in Dev Environment';
						 }
						 ?>
						<img id="tester" class= "resize" src="image/Regus_logo15.png" />
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<?php
							$user = $_SESSION['user'];
							?>
							<li> <?php echo '<a href="tab_invoice_review.php?user=' . $user . '">1 Invoice Review</a>'; ?></li>
							
							<li class="active"> <?php echo '<a href="tab_invoice_posting.php?user=' . $user . '">2 Invoice Posting</a>'; ?></li>
							<!--li> <?php echo '<a href="home_all_3.php?user=' . $user . '">Add Entry</a>'; ?></li-->
							<li> <?php echo '<a href="tab_exception_input.php?user=' . $user . '">3 Exception Input</a>'; ?></li>
							<?php
							if ($_SESSION['access'] == 'admin'){
								echo '<li> <a href="tab_admin_update_exception.php?user=' . $user . '">Update Exception Inputs</a></li>';
							}
							?>

						</ul>
						<ul class="nav navbar-nav pull-right">
							<?php $user = $_SESSION['user']; ?>
							<li class=" dropdown"><a  class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  Logged in as <?php echo $user; ?>  <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<!-- <li><A href="Report_Export.xlsx">Download Report</A></li> -->
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
		<form method="post"  id="myform" enctype="multipart/form-data">
			<div class="content">
				<br>

				<fieldset id="inner">
					<div class="form-group" >
						<div class="panel-title text-center" id="searchbar">
							<div class="col-xs-12">
								<label class="col-m-2 control-label">Enter Invoice Number</label>
								<input type="text" name="Invoice_Number" id="Invoice_Number" autocomplete="off" style="text-align:center;" class="form-control" autofocus "
								value="<?php
								echo isset($_POST['Invoice_Number']) ? $_POST['Invoice_Number'] : ''?>"

								>
								<br>
								<button type="submit" name="searchbut" id="searchbut" class="btn btn-success custom" data-loading-text="<i class='fa fa-spinner fa-spin'></i> loading" onClick=" this.form.submit(); this.disabled=true;" >Search</button>
								<br>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
		</div>

		<br>
		<br>

		<!-- Trigger the modal with a button -->
		<button type="submit" class="btn btn-info btn-lg" disabled id="openModal" name="openModal">Update Record(s)</button>


		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog" >
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header" id="thead">
						<button type ="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Post Invoice</h4>
					</div>
					<div class="modal-body">

						<?php
						if(isset($_POST['openModal'])){
							$id = $_POST['chkValues'] ;

							$id_array = array();
							$Invoice_Received_Date_array = array();
							$legentity_array = array();
							$entityadd_array = array();
							$ref_num_array = array();
							$inventory_sale_id_array = array();
							$compname_array = array();
							$brokeracc_array = array();
							$icpcode_array = array();
							$CentreName_array = array();
							$Invoice_Total_Amount_array = array();
							//$Posted_Amount1_array = array();
							$Journal_Number_array = array();
							$Commision_Amount_Posted_array = array();
							$Remarks_array = array();
							// $File_Path_W9_array = array();
							// $File_Path_Broker_Form_array = array();
							$MTM_month_array = array();
							// $Location_array = array();

							foreach ($id as $value){
								//echo "<script>console.log($value);</script>";
								$invoice_detail = explode (" ^^ ", $value);
								array_push($id_array, $invoice_detail[0]);
								array_push($Invoice_Received_Date_array, $invoice_detail[1]);
								array_push($CentreName_array, $invoice_detail[2]);
								array_push($legentity_array, $invoice_detail[3]);
								array_push($entityadd_array, $invoice_detail[4]);
								array_push($compname_array, $invoice_detail[5]);
								array_push($ref_num_array, $invoice_detail[6]);
								array_push($inventory_sale_id_array, $invoice_detail[7]);

								// array_push($totalComAmmount, floatval(preg_replace("/[^-0-9.]/","",$comammount[0])));
								array_push($Invoice_Total_Amount_array, $invoice_detail[8]);
								array_push($brokeracc_array, $invoice_detail[9]);
								array_push($icpcode_array, $invoice_detail[10]);
								array_push($Journal_Number_array, $invoice_detail[11]);
								array_push($Commision_Amount_Posted_array, $invoice_detail[12]);
								array_push($Remarks_array, $invoice_detail[13]);
								// array_push($File_Path_W9_array, $invoice_detail[14]);
								// array_push($File_Path_Broker_Form_array, $invoice_detail[15]);
								array_push($MTM_month_array, $invoice_detail[16]);
								// array_push($Location_array, $invoice_detail[17]);


							}

							$id= end($id_array);
							$Invoice_Received_Date = end($Invoice_Received_Date_array);

							$CentreName = end($CentreName_array);
							$legentity =end($legentity_array);
							$entityadd = end($entityadd_array);
							$compname = end($compname_array);
							$ref_num = end($ref_num_array);
							$inventory_sale_id = end($inventory_sale_id_array);
							$Invoice_Total_Amount = end($Invoice_Total_Amount_array);
							$brokeracc =end($brokeracc_array);
							$icpcode = end($icpcode_array);
							$Journal_Number = end($Journal_Number_array);
							$Commision_Amount_Posted = end($Commision_Amount_Posted_array);
							$Remarks = end($Remarks_array);
							// $File_Path_W9 = end($File_Path_W9_array);
							// $File_Path_Broker_Form = end($File_Path_Broker_Form_array);
							$MTM_month = end($MTM_month_array);
							// $Location = end($Location_array);

						} else {
							print("<p>No selection</p>");
						}
						?>

						<div class="form-group">
							<br>
							<div class="col-md-6">
								<label class="col-m-2 control-label" id="kulay">Posted By</label>
								<?php $user = $_SESSION['user']; ?>
								<input type="text" class="form-control" name="Posted_By" style="text-align:center;"  readonly value="<?php echo $user; ?> ">
							</div>


							<div class="col-md-6">

								<label class="col-m-2 control-label" id="kulay">Invoice Posting Date</label>
								<?php
								date_default_timezone_set('Asia/Hong_Kong');
								$today = date("Y-m-d");
								?>
								<input type="text" class="form-control" name="Posting_Date" style="text-align:center;"  readonly value="<?php echo $today; ?> ">
							</div>

						</div>
						<br>
						<br>
						<div class="form-group">
							<br>
							<div class="col-md-6">

								<label class="col-m-2 control-label" id="kulay">Invoice Number</label>
								<input type="text" class="form-control" name="Invoice_Number1" style="text-align:center;" readonly value ="<?php echo $id; ?>" >
								<input type="text" class="form-control" id="inventory_sale_id" name="inventory_sale_id" style="text-align:center;" hidden value ="<?php echo $inventory_sale_id; ?>" >
								<input type="text" class="form-control" id="MTM_month" name="MTM_month" style="text-align:center;" hidden value ="<?php echo $MTM_month; ?>" >
							</div>

							<div class="col-md-6">

								<label class="col-m-2 control-label" id="kulay">Invoice Received Date</label>
								<input type="text" class="form-control" name="Invoice_Received_Date" style="text-align:center;" readonly value ="<?php echo $Invoice_Received_Date; ?>">
							</div>

						</div>
						<br>
						<br>
						<br>
						<div class="col-md-12">

								<label class="col-m-2 control-label" id="kulay">Centre Name</label>
								<input type="text" class="form-control" name="CentreName" style="text-align:center;" readonly value ="<?php echo $CentreName; ?>">
							</div>


						<br>
						<br>
						<br>


						<div class="col-md-12">
							<label class="col-m-2 control-label" id="kulay">Legal Entity</label>
							<input type="text" class="form-control" name="LegalEntity" style="text-align:center;" readonly value ="<?php echo $legentity; ?>">
						</div>
						<br>
						<br>
						<div class="col-md-12">
							<br>
							<label class="col-m-2 control-label" id="kulay">Entity Address</label>
							<input type="text" class="form-control" name="Entity_Address" style="text-align:center;" readonly value ="<?php echo $entityadd; ?>">
						</div>
						<br>
						<div class="col-md-12">
							<br>
							<label class="col-m-2 control-label" id="kulay">Company Name</label>
							<input type="text" class="form-control" name="Company_Name" style="text-align:center;" readonly value ="<?php echo $compname; ?>">
						</div>
						<br>
						<br>
						<div class="form-group">
							<div class="col-md-6">
								<br>
								<label class="col-m-2 control-label" id="kulay">Reference Number</label>
								<input type="text" class="form-control" name="Reference_Number" style="text-align:center;" readonly value ="<?php echo $ref_num; ?>">
							</div>

							<div class="col-md-6">
								<br>
								<label class="col-m-2 control-label" id="kulay">Invoice Total Amount </label>
								<input type="text" class="form-control" name="Posted_Amount1" style="text-align:center;" readonly value ="<?php echo ($Invoice_Total_Amount); ?>">
							</div>
						</div>
						<br>
						<br>
						<div class="form-group">
							<div class="col-md-6">
								<br>
								<label class="col-m-2 control-label" id="kulay">Broker Account Code</label>
								<input type="text" class="form-control" name="Broker_Account_Code" style="text-align:center;" readonly value ="<?php echo $brokeracc; ?>">
							</div>


							<div class="col-md-6">
								<br>
								<label class="col-m-2 control-label" id="kulay">ICP Code/Business Unit</label>
								<input type="text" class="form-control" name="ICP_Code/Business_Unit" style="text-align:center;" readonly value ="<?php echo $icpcode; ?>">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6">
								<br>
								<label class="col-m-2 control-label" id="kulay">Journal/Voucher Number <font color="red"><i>*Required</i></font></label>
								<input type="text" class="form-control required-field element" autocomplete="off" name="Journal_Number" style="text-align:center;" id="Journal_Number" autofocus value ="<?php echo $Journal_Number; ?>">
								<input type="text" name="Journal_Number_DB" hidden value ="<?php echo $Journal_Number; ?>">
							</div>

							<div class="col-md-6">
								<br>
								<label class="col-m-2 control-label" id="kulay">Posted Commission Amount <font color="red"><i>*Required</i></font></label>
								<input type="text" class="form-control required-field element" autocomplete="off" name="Posted_Amount" style="text-align:center;" id="Posted_Amount" value ="<?php echo $Commision_Amount_Posted; ?>">
							</div>
						</div>

						<!-- <div class="col-md-12">
							<br>
							<label class="col-m-2 control-label" id="kulay">Location</label>
							<input type="text" class="form-control" id="location" name="location" autocomplete="off" style="text-align:center;" value ="<?php echo $Location; ?>">
						</div> -->

						<div class="col-md-12">
							<br>
							<label class="col-m-2 control-label" id="kulay">Remarks</label>
							<input type="text" class="form-control" id="Remarks" name="Remarks" autocomplete="off" style="text-align:center;" value ="<?php echo $Remarks; ?>">
							<br>
						</div>
					</div>

					<!-- <div class="form-group">
						<div class="col-md-12">
							<br>
							<label class="col-m-2 control-label" id="kulay">W9 Form</label>
							<input class="form-control" id="w9link" readonly value="<?php echo $File_Path_W9; ?>"> </input>

							<br>
							<input class="col-m-2 control-label" id="w9" type="file" name="w9" onChange="validate(this.value)"/>
							<br>
						</div>
					</div>

					<br>

					<div class="form-group">
						<div class="col-md-12">
							<br>
							<label class="col-m-2 control-label" id="kulay">Broker Registration Form/ACH</label>
							<input class="form-control" readonly value="<?php echo $File_Path_Broker_Form; ?>"> </input>
							<br>
							<input class="col-m-2 control-label" id="broker" type="file" name="broker" onChange="validate(this.value)" />
							<br>
						</div>
					</div> -->

					<div class="modal-footer">
						<button type="submit" name="saveDB" id="saveDBut" class="btn btn-primary" >Save changes</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="warningModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Error</h4>
					</div>
					<div class="modal-body">
						<p>Please Choose One on the Choices</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<script>

			countries = ['Afghanistan','Åland','Albania','Algeria','American Samoa','Andorra','Angola','Anguilla','Antarctica','Antigua and Barbuda','Argentina','Armenia','Aruba','Australia','Austria','Azerbaijan',
    'Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Bouvet Island','Brazil','British Indian Ocean Territory','British Virgin Islands','Brunei','Bulgaria','Burkina Faso','Burundi',
    'Cambodia','Cameroon','Canada','Cape Verde','Cayman Islands','Central African Republic','Chad','Chile','China','Christmas Island','Cocos (Keeling) Islands','Colombia','Comoros','Congo','Cook Islands','Costa Rica','Côte d\'Ivoire','Croatia','Cuba','Curacao','Cyprus','Czech Republic',
    'Denmark','Djibouti','Dominica','Dominican Republic',
    'Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia',
    'Falkland Islands','Faroe Islands','Fiji','Finland','France','French Guiana','French Polynesia','French Southern Lands','FYRO Macedonia',
    'Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guadeloupe','Guam','Guatemala','Guinea','Guinea-Bissau','Guyana',
    'Haiti','Heard and McDonald Islands','Honduras','Hong Kong','Hungary',
    'Iceland','India','Indonesia','Iran','Iraq','Israel','Italy',
    'Jamaica','Japan','Jordan',
    'Kazakhstan','Kenya','Kiribati','Kuwait','Kyrgystan',
    'Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg',
    'Macau','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Martinique','Mauritania','Mauritius','Mayotte','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Myanmar',
    'Namibia','Nauru','Nepal','Netherlands','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Niue','Norfolk Island','North Korea','Northern Mariana Islands','Norway',
    'Oman',
    'Pakistan','Palau','Palestinian Territories','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Pitcairn','Poland','Portugal','Puerto Rico',
    'Qatar',
    'Republic of Ireland','Republic of Kosovo','Reunion','Romania','Russia','Rwanda',
    'Saint Helena','Saint Lucia','Saint Pierre and Miquelon','San Marino','São Tomé and Príncipe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Georgia and South Sandwich Islands','South Korea','Spain','Sri Lanka','St Kitts and Nevis','St Vincent and the Grenadines','Sudan','Suriname','Svalbard and Jan Mayen Islands','Swaziland','Sweden','Switzerland','Syria',
    'Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tokelau','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Turks and Caicos Islands','Tuvalu',
    'Uganda','Ukraine','United Arab Emirates','United Kingdom','United States Minor Outlying Islands','United States of America','Uruguay','US Virgin Islands','Uzbekistan',
    'Vanuatu','Vatican City','Venezuela','Vietnam',
    'Wallis and Futuna Islands','Western Sahara','Western Samoa',
    'Yemen',
    'Zaire','Zambia','Zimbabwe',
  ];

   					$("#location").autocomplete({
					    source: countries,
					     messages: {
					        noResults: '',
					        results: function() {}
					    }
					  });



			function validate(file) {
	          var ext = file.split(".");
	          ext = ext[ext.length-1].toLowerCase();
	          var arrayExtensions = ["pdf","xlsx","xlsm"];

	          if (arrayExtensions.lastIndexOf(ext) == -1) {
	              alert("Wrong extension type.");
	              $("#w9, #broker").val("");
	          }
	      }

			$(document).ready(function() {
				document.getElementById("inventory_sale_id").style.display = "none";
				document.getElementById("MTM_month").style.display = "none";



			 var checkBoxes = $('td .required_checkboxes');
    		checkBoxes.change(function () {
      			$('#openModal').prop('disabled', checkBoxes.filter(':checked').length < 1);
    		});


			$(document).keydown(function(e) {
				if (e.keyCode == 27) return false;
				if (e.keyCode == 13) return false;
			});


			$("#Journal_Number").keydown(function(e) {
				if (e.keyCode == 27) {
					return false;
				}
			});


			$("#Posted_Amount").keydown(function(e) {
				if (e.keyCode == 27) {
					return false;
				}
			});



			$("#Remarks").keydown(function(e) {
				if (e.keyCode == 27) {
					return false;
				}
			});



			$("#Posted_Amount").on("keypress",function(e){
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
					}
					else{
						return false;
					}
					break;
					default:
					return false;
				}
			});

			$("#saveDBut").click(function(event){
				var form_data=$("#myform").serializeArray();
				//console.log(form_data);
				//event.preventDefault();

				formFields = {};
				//Make formFields use Value in Key Value
				$(form_data).each(function(i, field){
					formFields[field.name] = field.value;
				});

				if(formFields['Journal_Number'] =='' && formFields['Posted_Amount'] ==''){
					event.preventDefault();
					$('#Journal_Number').addClass("invalid");
					$('#Posted_Amount').addClass("invalid");
					alert("please fill in the required fields");
				} else if(formFields['Journal_Number_DB'] != ""){
					var result = window.confirm('Do you wish to overwrite existing data?');
					if (result) {
						return true;
					} else {
						event.preventDefault();
					}

				} else {
					return true;
				}
			});

			$("#Posted_Amount").on('paste', function (e) {
				alert("copy paste detected, check if the values are correct");
				var pasteData = e.originalEvent.clipboardData.getData('text');
				var returnData = pasteData.replace(/[^0-9.]/g, "");
				e.preventDefault();

				$('#Posted_Amount').val(returnData);

			});

			$('#Journal_Number').keyup(function() {
				$(this).val($(this).val().toUpperCase());
			});

			$(document).ready(function(){

				var date_input=$('input[name="reviewdate"]'); //our date input has the name "date"
				var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
				var curDate = new Date();
				var options={
					format: 'mm/dd/yyyy',
					container: container,
					todayHighlight: true,
					autoclose: true,
					startDate: curDate,
					toggleActivate: true,
				};
				date_input.datepicker(options);
			});

		});


	</script>

	<br>
	<br>

	<?php

	function displayModal(){
		echo "<script>
		$(function() {
			$('#myModal').modal('show');
		});
		</script>";
	}

	function displayErrorModal(){
		echo "<script>
			$(function() {
				$('#warningModal').modal('show');
			});
			</script>";

	}

	function displayErrorMessage(){
		echo "<script type='text/javascript'>alert('More than 1 reference number is selected, you can only update 1 reference number at a time.')</script>";
	}




	if(isset($_POST['openModal'])){

		if(isset($_POST['chkValues'])){

			$invoice_number_array = array();

			foreach($_POST['chkValues'] as $value){
				$invoice_detail =  explode(" ^^ ", $value);
				array_push($invoice_number_array, $invoice_detail[6]);
			}

			$number_of_invoice_number = array_unique($invoice_number_array);

			if(count($number_of_invoice_number)==1){
				displayModal();
			} else {
				displayErrorMessage();
			}
		} else {
			displayErrorModal();
		}
	}

	if(isset($_POST['saveDB'])){


		$inventory_sale_id = $_POST['inventory_sale_id'];
		$Journal_Number = $_POST['Journal_Number'];
		$Posted_Amount = $_POST['Posted_Amount'];
		$Remarks = $_POST['Remarks'];
		$Invoice_Number = $_POST['Invoice_Number1'];
		$Reference_Number = $_POST['Reference_Number'];
		$Posting_Date = $_POST['Posting_Date'];
		$Posted_By = $_POST['Posted_By'];
		$MTM_month = $_POST['MTM_month'];
		//$location = $_POST['location'];



// //FUNCTION TO BE UPDATED
// //---------------------------UPLOAD W9------------------------------

// 		   if(isset($_FILES['w9'])){

// 		   	$inventory_sale_id = $_POST['inventory_sale_id'];
// 			$Journal_Number = $_POST['Journal_Number'];
// 			$Posted_Amount = $_POST['Posted_Amount'];
// 			$Remarks = $_POST['Remarks'];
// 			$Invoice_Number = $_POST['Invoice_Number1'];
// 			$Reference_Number = $_POST['Reference_Number'];
// 			$Posting_Date = $_POST['Posting_Date'];
// 			$Posted_By = $_POST['Posted_By'];
// 			$MTM_month = $_POST['MTM_month'];


// 		   	$errors= array();
//             $file_name = $_FILES['w9']['name']; // file name with extension
//             $file_basename = substr($file_name, 0, strripos($file_name, '.')); //get the base of file name for replace
//             $file_size =$_FILES['w9']['size']; //file size to control the size limit
//             $file_tmp =$_FILES['w9']['tmp_name']; // the tmp file of the uploaded file
//             $file_type=$_FILES['w9']['type']; // to control allowable file type
//             $file_ext=strtolower(end(explode('.',$_FILES['w9']['name']))); // to get the extension for control

//             $newfilename = "W9_Form_" . $Posting_Date . "_ISID-" . $inventory_sale_id . "_M-" . $MTM_month . "_IN-" . $Invoice_Number . "_RN-" . $Reference_Number . "." . $file_ext; // renamed file

//             $expensions= array("pdf","xlsx","xlsm"); // allowed extensions

//             //extension checker if valid or not
//             // if(in_array($file_ext,$expensions)=== false){
//             //    $errors[]="extension not allowed";
//             // }

//             //file size checker if it reaches the limit
//             if($file_size > 2097152){
//                $errors[]='File size must be excately 2 MB';
//             }

//             //check if the upload is success or not
//             if(empty($errors)==true){

//                $File_Path = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\BCUI\\' . $newfilename;


//                move_uploaded_file($file_tmp,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/BCUI/".$newfilename);

// 		if ($_FILES['w9']['size'] > 0)
// 		    {
// 		           	   $save_db_3 = $conn->query("update ".$_SESSION['db']." set File_Path_W9 = '$File_Path' where Invoice_Number = '$Invoice_Number' and InventorySaleID = '$inventory_sale_id' and [MTM commission Payment Month] = '$MTM_month'");
// 		    }

//             }else{
//                print_r($errors);
//             }

//         }

// //-------------------------UPLOAD END--------------------------

// //------------------------------UPLOAD BROKER START-----------------------------------

//         if(isset($_FILES['broker'])){

//         	$inventory_sale_id = $_POST['inventory_sale_id'];
// 			$Journal_Number = $_POST['Journal_Number'];
// 			$Posted_Amount = $_POST['Posted_Amount'];
// 			$Remarks = $_POST['Remarks'];
// 			$Invoice_Number = $_POST['Invoice_Number1'];
// 			$Reference_Number = $_POST['Reference_Number'];
// 			$Posting_Date = $_POST['Posting_Date'];
// 			$Posted_By = $_POST['Posted_By'];
// 			$MTM_month = $_POST['MTM_month'];

// 		   	$errors1= array();
//             $file_name1 = $_FILES['broker']['name']; // file name with extension
//             $file_basename1 = substr($file_name, 0, strripos($file_name, '.')); //get the base of file name for replace
//             $file_size1 =$_FILES['broker']['size']; //file size to control the size limit
//             $file_tmp1 =$_FILES['broker']['tmp_name']; // the tmp file of the uploaded file
//             $file_type1=$_FILES['broker']['type']; // to control allowable file type
//             $file_ext1=strtolower(end(explode('.',$_FILES['broker']['name']))); // to get the extension for control

//             $newfilename1 = "Broker_Form_" . $Posting_Date . "_ISID-" . $inventory_sale_id . "_M-" . $MTM_month . "_IN-" . $Invoice_Number . "_RN-" . $Reference_Number . "." . $file_ext1; // renamed file

//             $expensions= array("pdf","xlsx","xlsm"); // allowed extensions

//             //extension checker if valid or not
//             // if(in_array($file_ext1,$expensions)=== false){
//             //    $error1s[]="extension not allowed";
//             // }

//             //file size checker if it reaches the limit
//             if($file_size1 > 2097152){
//                $errors1[]='File size must be excately 2 MB';
//             }

//             //check if the upload is success or not
//             if(empty($errors1)==true){

//                $File_Path1 = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\BCUI\\' . $newfilename1;


//                move_uploaded_file($file_tmp1,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/BCUI/".$newfilename1);

// 		if ($_FILES['broker']['size'] > 0)
// 		    {
// 		           		$save_db_5 = $conn->query("update ".$_SESSION['db']." set [File_Path_Broker Registration Form/ACH] = '$File_Path' where Invoice_Number = '$Invoice_Number' and InventorySaleID = '$inventory_sale_id' and [MTM commission Payment Month] = '$MTM_month'");
// 			}

//             }else{
//                print_r($errors1);
//             }

//         }

        //-------------------------------UPLOAD END BROKER -------------------------------


		if(is_numeric($Posted_Amount)){
			//location = '$location'

			$query = $conn->query("update ".$_SESSION['db']."
				set Posting_Date = '$Posting_Date', Invoice_Posted_By = '$Posted_By', Journal_Number = '$Journal_Number', Commision_Amount_Posted = '$Posted_Amount', Remarks = '$Remarks' 
				where sent = 1 and iscurrent = 1 and Invoice_Number = '$Invoice_Number' and Reference_Number in ('$Reference_Number') and [MTM commission Payment Month] = $MTM_month
				");

			$query->execute();

			$user = $_SESSION['user'];
			$query1 = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
			$query1->execute(array($user));
			$result1 = $query1->fetch(PDO::FETCH_LAZY, 0);

			$Chk_Name = $result1['Chk_Name'];
			$Chk_Username = $result1['Chk_Username'];
			$Chk_Position = $result1['Chk_Position'];

			$save_db = $conn->query("INSERT INTO ".$_SESSION['auditdb']." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'Invoice posting: Posted amount of $Posted_Amount for invoice number $Invoice_Number with a Journal Number of $Journal_Number', getdate());");


			if($query)
			{
				echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			}
			else {
				echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
			}
		} else {
			echo "<script type='text/javascript'>alert('Amount fields has detected characters, please be careful on using copy paste function. The Data is not saved.');</script>";
		}

	}

	?>


	<table class="table table table-hover set-bg">
		<thead class="headTable">
			<tr>

				<th style="width:160px">Check the Applicable</th>
				<th style="width:150px">Invoice Number</th>
				<th style="width:100px">Invoice Date</th>
				<th style="width:150px">Centre Name</th>
				<th style="width:150px">LegalEntity</th>
				<th style="width:200px">Entity Address</th>
				<th style="width:150px">VAT (if applicable)</th>
				<th style="width:80px">Reference Number</th>
				<th style="width:200px">Company Name</th>
				<th style="width:150px">Commission Amount</th>
				<th style="width:100px">Invoice Amount</th>
				<th style="width:150px">Broker Account Code</th>
				<th style="width:150px">ICP Code/ Business Unit</th>
				<th style="width:150px">Journal/Voucher Number</th>
				<th style="width:100px">Posted Commission Amount</th>
				<!-- <th style="width:100px">Location</th> -->
				<th style="width:350px">Remarks</th>
				<!-- <th style="width:350px">File_Path_w9</th>
				<th style="width:350px">File_Path_Broker_Form</th> -->
				<th style="width:350px">MTM Month</th>

			</tr>
		</thead>

		<?php
		include('database.php');

		function removeSpecialcharacters($value){
			return str_replace("\"", "", $value);
		}

		if(isset($_POST['searchbut'])){

			$Invoice_Number = $_POST['Invoice_Number'];

			if($Invoice_Number == ''){

				echo "<script type='text/javascript'>alert('Please enter a valid input!')</script>";

			}else{

				$result = $conn->prepare("select

					[Invoice_Number],
					[Invoice_Received_Date],
					[LegalEntity],
					[Entity_Address],
					[VATCode],
					[Reference_Number],
					[CompanyName],
					case when BCA_Commission_Amount is null or BCA_Commission_Amount = '' then Convert(varchar,cast(cast ([Commission_Amount] as decimal(16,2))as money),1) else Convert(varchar,cast(cast (BCA_Commission_Amount as decimal(16,2))as money),1) end as Commission_Amount,
					Convert(varchar,cast(cast ([Invoice_Total_Amount] as decimal(16,2))as money),1) as [Invoice_Total_Amount],
					[Broker_Account_Code],
					[ICP_Code/Business_Unit],
					[Journal_Number],
					[Commision_Amount_Posted],
					[CentreName],
					[Remarks],
					[MTM commission Payment Month],
					[Location],
					[File_Path_W9],
					[File_Path_Broker Registration Form/ACH],
					[InventorySaleID]

					from ".$_SESSION['db']."
					where iscurrent = 1 and [Invoice_Number] = ?");


					

					//[File_Path_W9],
					//[File_Path_Broker Registration Form/ACH],

				$result->execute(array($Invoice_Number));
				$result->execute();
				$row_count =$result->rowCount();

				$user = $_SESSION['user'];
				$query1 = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
				$query1->execute(array($user));
				$result1 = $query1->fetch(PDO::FETCH_LAZY, 0);

				$Chk_Name = $result1['Chk_Name'];
				$Chk_Username = $result1['Chk_Username'];
				$Chk_Position = $result1['Chk_Position'];

				$save_db = $conn->query("INSERT INTO ".$_SESSION['auditdb']." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'Invoice posting: Searched for Invoice Number: $Invoice_Number', getdate());");

				if(!$result->execute()){
					echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
				}

				if($row_count == 0){
					echo '<tr><td colspan="20">No Available Data.</td></tr>';
				}else{
					$no = 1;
					while($row = $result->fetch(PDO::FETCH_ASSOC)){
						echo '<tr>';

						echo '<td>'.'<div class="checkbox">'.'<label><input name="chkValues[]" class="required_checkboxes"  type="radio" value="'.$row['Invoice_Number'].' ^^ '.$row['Invoice_Received_Date'].' ^^ '.removeSpecialcharacters($row['CentreName']).' ^^ '.removeSpecialcharacters($row['LegalEntity']).' ^^ '.removeSpecialcharacters($row['Entity_Address']).' ^^ '.removeSpecialcharacters($row['CompanyName']).' ^^ '.$row['Reference_Number'].' ^^ '.$row['InventorySaleID'].' ^^ '.$row['Invoice_Total_Amount'].' ^^ '.$row['Broker_Account_Code'].' ^^ '.$row['ICP_Code/Business_Unit'].' ^^ '.$row['Journal_Number'].' ^^ '.$row['Commision_Amount_Posted'].' ^^ '.$row['Remarks'].' ^^ '.$row['File_Path_W9'].' ^^ '.$row['File_Path_Broker Registration Form/ACH'].' ^^ '.$row['MTM commission Payment Month'].' ^^ '.$row['Location'].'"></label>' . '</div>'.'</td>';

						
						echo '<td>'.$row['Invoice_Number'].'<input type="text" name="invnumresult[]" hidden value="'.$row['Invoice_Number'].'"></td>';
						echo '<td>'.$row['Invoice_Received_Date'].'<input type="text" name="invreceiveddate" hidden value="'.$row['Invoice_Received_Date'].'"></td>';
						echo '<td>'.$row['CentreName'].'<input type="text" name="CentreName" hidden value="'.$row['CentreName'].'"></td>';
						echo '<td>'.$row['LegalEntity'].'<input type="text" name="legentity" hidden value="'.$row['LegalEntity'].'"></td>';
						echo '<td>'.$row['Entity_Address'].'<input type="text" name="entityadd" hidden value="'.$row['Entity_Address'].'"></td>';
						echo '<td>'.$row['VATCode'].'<input type="text" name="vatcode" hidden value="'.$row['VATCode'].'"></td>';
						echo '<td>'.$row['Reference_Number'].'<input type="text" name="ref_num" hidden value="'.$row['Reference_Number'].'"></td>';
						echo '<td>'.$row['CompanyName'].'<input type="text" name="compname" hidden value="'.$row['CompanyName'].'"></td>';

						echo '<td>'.$row['Commission_Amount'].'</td>';

						echo '<td>'.$row['Invoice_Total_Amount'].'<input type="text" name="invtotal" hidden value="'.$row['Invoice_Total_Amount'].'"></td>';

						echo '<td>'.$row['Broker_Account_Code'].'<input type="text" name="brokeracc" hidden value="'.$row['Broker_Account_Code'].'"></td>';
						echo '<td>'.$row['ICP_Code/Business_Unit'].'<input type="text" name="icpcode" hidden value="'.$row['ICP_Code/Business_Unit'].'"></td>';

						echo '<td>'.$row['Journal_Number'].'<input type="text" name="Journal_Number" hidden value="'.$row['Journal_Number'].'"></td>';
						echo '<td>'.$row['Commision_Amount_Posted'].'<input type="text" name="Commision_Amount_Posted" hidden value="'.$row['Commision_Amount_Posted'].'"></td>';
						// echo '<td>'.$row['Location'].'<input type="text" name="Location" hidden value="'.$row['Location'].'"></td>';
						echo '<td>'.$row['Remarks'].'<input type="text" name="Remarks" hidden value="'.$row['Remarks'].'"></td>';
						echo '<td>'.$row['MTM commission Payment Month'].'<input type="text" name="MTM_month" hidden value="'.$row['MTM commission Payment Month'].'"></td>';
						echo '<tr>';
					}
				}

			}
		}

		?>
	</table>

	<?php
	if(isset($_POST['mudal'])){
		$id = (implode( ", " , $_POST['chkresult'] ));
		echo $id;
	}
	?>

	<?php

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
			$user = $_SESSION['user'];
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

				$save_db = $conn->query("INSERT INTO ".$_SESSION['auditdb']." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'password changed to $new_password', getdate());");

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
					<button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button>
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
