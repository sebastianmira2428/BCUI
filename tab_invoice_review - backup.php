  <?php
  session_start();

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
    <!--- <link rel="icon" href="../../favicon.ico">  -->

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
           <li class="active"> <?php echo '<a href="tab_invoice_review.php?user=' . $user . '">1 Invoice Review</a>'; ?></li>
           <li> <?php echo '<a href="tab_invoice_posting.php?user=' . $user . '">2 Invoice Posting</a>'; ?></li>
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
              <!-- <li><A href="Report_Export.xlsm">Download Report</A></li> -->
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
  <form id="submitForm" method="post" enctype="multipart/form-data">
    <div class="content">
     <br>

     <fieldset id="inner">
       <div class="form-group">
        <div class="panel-title text-center" id="searchbar">
         <div class="col-xs-12">
          <label class="col-m-2 control-label">Enter Pivotal Reference Number</label>
          <input type="text" name="Reference_Number" id="Reference_Number"  autocomplete="off" maxlength="20" style="text-align:center;" class="form-control" autofocus
          value="<?php
          echo isset($_POST['Reference_Number']) ? $_POST['Reference_Number'] : ''?>" >

          <br>
          <button type="submit" name="Find" id="searchbut" class="btn btn-success custom" data-loading-text="<i class='fa fa-spinner fa-spin'></i> loading" onClick=" this.form.submit(); this.disabled=true;">Search</button>
          <br>

        </div>
      </div>
    </div>
  </fieldset>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" >
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Review Invoice</h4>

     <div class="modal-body">
      <?php
      if(isset($_POST['openModal'])){

        $totalComAmmount = array();
        $inventorySaleId = array();
        $invoice_numberArray = array();
        $MTM_Month = array();
        $date_received_array =  array();
        $invoice_date_array = array();
        $update_currency_array = array();
        $commission_amount_update_array = array();
        $invoice_amount_total_array = array();
        $broker_account_code_array = array();
        $icp_code_array = array();
        $Remarks_array = array();
        $reviewby_array = array();
        $reviewdate_array = array();
        $previousupdateby_array = array();
        $update_timestamp_array = array();
        $updateremarks_array = array();
        // $File_Path_Invoices_array = array();
        // $broker_registration_array = array();

        foreach($_POST['chkresult'] as $value){
          $comammount = explode (" ^^ ", $value);
          array_push($totalComAmmount, floatval(preg_replace("/[^-0-9.]/","",$comammount[0])));
          array_push($inventorySaleId, $comammount[1]);
          array_push($invoice_numberArray, $comammount[2]);
          array_push($MTM_Month, $comammount[3]);
          array_push($date_received_array, $comammount[4]);
          array_push($invoice_date_array, $comammount[5]);
          array_push($update_currency_array, $comammount[6]);
          array_push($commission_amount_update_array, $comammount[7]);
          array_push($invoice_amount_total_array, $comammount[8]);
          array_push($broker_account_code_array, $comammount[9]);
          array_push($icp_code_array, $comammount[10]);
          array_push($Remarks_array, $comammount[11]);
          array_push($reviewby_array, $comammount[12]);
          array_push($reviewdate_array, $comammount[13]);
          array_push($previousupdateby_array, $comammount[14]);
          array_push($update_timestamp_array, $comammount[15]);
          array_push($updateremarks_array, $comammount[16]);
          // array_push($File_Path_Invoices_array, $comammount[17]);
          // array_push($broker_registration_array, $comammount[18]);
        }

        $ref_number = $_POST['ref_number'];
        $CentreName = $_POST['CentreName'];
        $LegalEntity = $_POST['LegalEntity'];
        $Entity_Address = $_POST['Entity_Address'];
        $VATCode = $_POST['VATCode'];
        $paymentCurrency =  $_POST['paymentCurrency'];
        $totalCom = array_sum($totalComAmmount);
        $id = ("'".implode( "', '" , array_map('intval',$inventorySaleId))."'");
        $months = ("'".implode( "', '" , array_map('intval',$MTM_Month))."'");

        $date_received = end($date_received_array);
        $invoice_date = end($invoice_date_array);
        $update_currency = end($update_currency_array);
        $commission_amount_update = end($commission_amount_update_array);
        $invoice_amount_total = end($invoice_amount_total_array);
        $invoice_number = end($invoice_numberArray);
        $invoice_number_from_db = end($invoice_numberArray);

        $broker_account_code = end($broker_account_code_array);
        $icp_code = end($icp_code_array);
        $Remarks = end($Remarks_array);

        $reviewby = end($reviewby_array);
        $reviewdate = end($reviewdate_array);

        $previousupdateby = end($previousupdateby_array);
        $update_timestamp = end($update_timestamp_array);
        $updateremarks = end($updateremarks_array);

        // $File_Path_Invoices = end($File_Path_Invoices_array);
        // $broker_registration = end($broker_registration_array);
      } else {
        print("<p>No selection</p>");
      }

    ?>

   <input type="text" name="inventorySaleIds" value="<?php echo("$id"); ?>" hidden>
   <input type="text" name="months" value="<?php echo("$months"); ?>" hidden>

   <div class="form-group"> <!--1st row-->

    <div class="col-md-6">
     <br>
     <label class="col-m-2 control-label" id="kulay">Reviewed By</label>
     <?php $user = $_SESSION['user']; ?>
     <input type="text" class="form-control" name="review_by_display" id="review_by_display" style="text-align:center;"  readonly value="<?php echo $reviewby; ?>">
     <input type="text" name="review_by" id="review_by" value="<?php print("$reviewby"); ?>" hidden>

     <input type="text" id="getuser" value="<?php print("$user"); ?>" hidden>
   </div>

   <div class="col-md-6">
     <br>
     <label class="col-m-2 control-label" id="kulay">Date of Validation</label>

     <?php
     date_default_timezone_set('Asia/Hong_Kong');
     $today = date("Y-m-d H:i:s");
     ?>

<input type="text" id="gettoday" name="gettoday" value="<?php print("$today"); ?>" hidden>

     <input type="text" class="form-control" name="date_of_validation_display" id="date_of_validation_display" style="text-align:center;" readonly value="<?php echo $reviewdate; ?> ">
     <input type="text" name="date_of_validation" value="<?php print("$reviewdate"); ?>" hidden>

   </div>
 </div>



 <div class="form-group"> <!--2nd row-->

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Reference_Number</label>
    <input type="text" readonly class="form-control" name="Reference_Number1"
    id="Reference_Number1" style="text-align:center;" value = " <?php echo $ref_number; ?>">

  </div>

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Centre Name</label>
    <input type="text" readonly class="form-control" name="Centre_Name" id="Centre_Name" style="text-align:center;" value = " <?php echo $CentreName; ?>">

  </div>

</div>


<div class="form-group"> <!--3rd row-->

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Legal_Entity</label>
    <input type="text" readonly class="form-control" name="Legal_Entity"
    id="Legal_Entity" style="text-align:center;" value = " <?php echo $LegalEntity; ?>">

  </div>

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Entity_Address</label>
    <input type="text" readonly class="form-control" name="Entity_Address" id="Entity_Address" style="text-align:center;" value = " <?php echo $Entity_Address; ?>">
    <br>
  </div>

</div>

<div class="form-group"> <!--4th row-->

  <div class="col-md-6">
    <br>

   <label class="col-m-2 control-label" id="kulay">Date Received <font color="red"><i>*Required</i></font></label>
   <input class="form-control element" id="date_received" name="date_received" style="text-align:center;" autocomplete="off" placeholder="YYYY-MM-DD" type="text" readonly="readonly" value = "<?php echo $date_received; ?>" />
   <i class="calendar"></i>

 </div>

 <div class="col-md-6">
   <br>
   <label class="col-m-2 control-label" id="kulay">Invoice Date <font color="red"><i>*Required</i></font></label>
   <input class="form-control element" id="invoice_date" name="invoice_date" autocomplete="off" placeholder="YYYY-MM-DD" type="text" style="text-align:center;" readonly="readonly" value="<?php echo $invoice_date; ?>" />
   <i class="calendar"></i>

 </div>



</div>

<div class="row"> <!--5th row-->
  <div class="col-m-10 ">

    <div class="col-sm-4 col-sm-offset-4 text-center">
     <br>
     <label class="col-m-2 control-label" id="kulay">VAT (if applicable)</label>
     <input type="text" readonly class="form-control" name="VAT"
     id="VAT" style="text-align:center;" value = " <?php echo $VATCode; ?>">

   </div>

 </div>
</div>
</div>

<div class="form-group">

</div>

<div class="form-group"> <!--6th row-->

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Payment Currency</label>
    <input type="text" class="form-control" autocomplete="off" name="current_currency_display" style="text-align:center;" value="<?php echo $paymentCurrency; ?>" readonly/>

  </div>

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Commission Amount</label>
    <input type="text" class="form-control" name="commission_amount_display"
    value = "<?php echo $totalCom;?>" autocomplete="off" style="text-align:center;" readonly>

  </div>

</div>



<div class="form-group"> <!--6th row-->

  <div class="col-md-6">
    <br>
    <input type="checkbox" id="yesCurr" value="yesCurr" >  <label class="col-m-2 control-label" id="kulay">Update Payment Currency</label>
    <input type="text" class="form-control" autocomplete="off" disabled id="update_currency" name="update_currency" style="text-align:center;" value = "<?php echo $update_currency; ?>">

  </div>

  <div class="col-md-6">
    <br>
    <input type="checkbox" id="yesCommAm" value="yesCommAm"> <label class="col-m-2 control-label" id="kulay">Update Commission Amount</label>
    <input type="text" class="form-control" autocomplete="off"  disabled name="commission_amount_update" id="commission_amount_update" style="text-align:center;" value = "<?php echo $commission_amount_update; ?>">

  </div>

</div>

<div class="form-group"> <!--7th row-->

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Invoice Number <font color="red"><i>*Required</i></font></label>
    <input type="text" class="form-control element" autocomplete="off" name="invoice_number" id="invoice_number" style="text-align:center;" value = "<?php echo $invoice_number; ?>">
    <input id="invoice_number_from_db" name="invoice_number_from_db" type="text" hidden value="<?php echo $invoice_number_from_db; ?>" />

  </div>

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Invoice Amount Total <font color="red"><i>*Required</i></font></label>
    <input type="text" class="form-control element" autocomplete="off" style="text-align:center;" name="invoice_amount_total" id="invoice_amount_total" value = "<?php echo $invoice_amount_total; ?>">

  </div>
</div>


<div class="row"> <!--8th row-->
  <div class="col-m-10 ">

    <div class="col-sm-4 col-sm-offset-4 text-center">
     <br>
     <label class="col-m-2 control-label" id="kulay">Broker Set Up?</label>
     <div class="radio">
       <label class="col-m-2 control-label" id="kulay"><input type="radio" checked="checked" name="broker_setup[]" id="broker_setup_yes" >Yes</label>
       <label class="col-m-2 control-label" id="RadioBtn"><input type="radio" name="broker_setup[]" id="broker_setup_no" value="No">No</label>
       <!--label class="col-m-2 control-label" id="RadioBtn"><input type="radio" name="optradiono" value="No">No</label-->
     </div>

   </div>
 </div>
</div>

<div class="form-group"> <!--9th row-->

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Broker Account Code <font color="red"><i>*If Yes Required</i></font></label>
    <input type="text"  class="form-control" name="broker_account_code"
    id="broker_account_code" autocomplete="off" style="text-align:center;" value="<?php echo $broker_account_code; ?>">

  </div>

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">ICP Code/Bussiness Unit <font color="red"><i>*Required</i></font> </label>
    <input type="text" ="disabled" autocomplete="off" class="form-control" name="icp_code" id="icp_code" style="text-align:center;" value= "<?php echo $icp_code; ?>">
    <br>
  </div>
</div>

<div class="col-md-12">
  <br>
  <label class="col-m-2 control-label" id="kulay"> Remarks </label>
  <input type="text" class="form-control" id="Remarks" name="Remarks" autocomplete="off" style="text-align:center;" value ="<?php echo $Remarks; ?>">
  <br>
</div>

<div class="form-group"> <!--9th row-->

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Update By </label>
    <input type="text"  class="form-control" readonly name="previousupdateby"
    id="previousupdateby" autocomplete="off" style="text-align:center;" value="<?php echo $previousupdateby; ?>">

  </div>

  <div class="col-md-6">
    <br>
    <label class="col-m-2 control-label" id="kulay">Update Timestamp <i>(YYYY-MM-DD HH:MM:SS)</i></label>
    <input type="text" ="disabled" autocomplete="off" readonly class="form-control" name="update_timestamp" id="update_timestamp" style="text-align:center;" value= "<?php echo $update_timestamp; ?>">
    <br>
  </div>
</div>


<div class="col-md-12">
  <br>
  <label class="col-m-2 control-label" id="kulay"> Update Remarks </label>
  <input type="text" class="form-control" id="updateremarks" name="updateremarks" autocomplete="off" style="text-align:center;" value ="<?php echo $updateremarks; ?>">
  <br>
</div>


  <!-- <div class="form-group row" style="margin-left:5px;margin-right:5px;">
       <div class="form-group">
            <div class="col-md-12">
              <br>
              <label class="col-m-2 control-label" id="kulay">Invoice Form</label>
              <input class="form-control" id="w9link" readonly value="<?php echo $File_Path_Invoices; ?>"> </input>

              <br>
              <input class="col-m-2 control-label" id="invoice" type="file" name="invoice" onChange="validate(this.value)" />
              <br>
            </div>
          </div>


  </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
                <div class="form-group">
            <div class="col-md-12">
              <br>
              <label class="col-m-2 control-label" id="kulay">Broker Registration Form/ACH</label>
              <input class="form-control" readonly value="<?php echo $broker_registration; ?>"> </input>
              <br>
              <input class="col-m-2 control-label" id="broker" type="file" name="broker" onChange="validate(this.value)" />
              <br>
            </div>
          </div> -->



  <!-- </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">

  </div> -->
        
          <!-- <br> -->


<div class="row"> <!--8th row-->
  <div class="col-m-10 ">

    <div class="col-sm-4 col-sm-offset-6 text-left">

      <label class="col-m-2 control-label" id="hidetext7" >Please Choose Reject Reason Below:</label>


      <div id="chkboxline" class="">
       <input class="col-m-2" type="checkbox" name="invoice" id="hidecheck2" value="1">
       <label class="col-m-2 control-label" id="hidetext1" >No Invoice Copy</label>
       <br>
     </div>


     <div id="chkboxline" class="">
       <input class="col-m-2" type="checkbox" name="entity" id="hidecheck3" value="1" >
       <label class="col-m-2 control-label" id="hidetext2" >Incorrect/No Legal Entity</label>

     </div>

     <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="address" id="hidecheck4" value="1" >
      <label class="col-m-2 control-label" id="hidetext3" >Incorrect/No Address</label>
      <br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="amount" id="hidecheck5" value="1" >
      <label class="col-m-2 control-label" id="hidetext4" >Incorrect Amount</label>
      <br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="currency" id="hidecheck6" value="1" >
      <label class="col-m-2 control-label" id="hidetext5" >Incorrect Currency</label><br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="duplicate" id="hidecheck7" value="1" >
      <label class="col-m-2 control-label" id="hidetext6" >Duplicate Invoice</label><br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="invalidinvoice" id="hidecheck8" value="1" >
      <label class="col-m-2 control-label" id="hidetext8" >Invalid Invoice/Incomplete Details</label><br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="clientcancelled" id="hidecheck9" value="1" >
      <label class="col-m-2 control-label" id="hidetext9" >Client Cancelled/Booking Terminated</label><br>
    </div>

    <!-- Hidden input to check if the ID is rejected  -->
    <input type="text" hidden name="rejected_yes_no" id="rejected_yes_no" />
    <input type="text" hidden name="iscommissionablecheck" id="iscommissionablecheck" />


  </div>

</div>

</div>

<div class="modal-footer">

  <!-- new -->
    <div class="" align="left">
      <input class="col-m-2" type="checkbox" name="iscommissionable" id="iscommissionable" onchange="doalert(this)">
      <label class="col-m-2 control-label" id="iscommissionable_label" >Is not commissionable</label><br>
    </div>
    <hr>

    <script>

      function validate(file) {
          var ext = file.split(".");
          ext = ext[ext.length-1].toLowerCase();
          var arrayExtensions = ["pdf","xlsx","xlsm"];

          if (arrayExtensions.lastIndexOf(ext) == -1) {
              alert("Wrong extension type.");
              $("#invoice, #broker").val("");
          }
      }

      function doalert(checkboxElem) {
        if (checkboxElem.checked) {
          document.getElementById("iscommissionablecheck").value = "NOT";

          document.getElementById("yesCommAm").checked = false;
          document.getElementById("yesCurr").checked = false;

          document.getElementById("yesCommAm").disabled = true;
          document.getElementById("yesCurr").disabled = true;
          document.getElementById("modal_reject").disabled = true;

          document.getElementById("invoice_amount_total").disabled = true;
          document.getElementById("date_received").disabled = true;
          document.getElementById("invoice_date").disabled = true;
          document.getElementById("invoice_number").disabled = true;
          document.getElementById("broker_account_code").disabled = true;
          document.getElementById("icp_code").disabled = true;
          document.getElementById("update_currency").disabled = true;
          document.getElementById("commission_amount_update").disabled = true;
          document.getElementById("broker_setup_yes").disabled = true;
          document.getElementById("broker_setup_no").disabled = true;
          document.getElementById("Remarks").disabled = true;

          document.getElementById("updateremarks").disabled = false;
          document.getElementById("previousupdateby").value = "";
          document.getElementById("update_timestamp").value = "";

          document.getElementById("review_by_display").value = "";
          document.getElementById("date_of_validation_display").value = "";

          document.getElementById("previousupdateby").value = document.getElementById("getuser").value
          document.getElementById("update_timestamp").value = document.getElementById("gettoday").value

          document.getElementById("invoice_amount_total").value = "";
          document.getElementById("date_received").value = "";
          document.getElementById("invoice_date").value = "";
          document.getElementById("invoice_number").value = "";
          document.getElementById("broker_account_code").value = "";
          document.getElementById("icp_code").value = "";
          document.getElementById("update_currency").value = "";
          document.getElementById("commission_amount_update").value = "";
          document.getElementById("Remarks").value = "";

          document.getElementById("rejected_yes_no").value = "";

        } else {
          location.reload();
          document.getElementById("iscommissionablecheck").value = "";

          document.getElementById("modal_reject").disabled = false;
          document.getElementById("invoice_amount_total").disabled = false;
          document.getElementById("date_received").disabled = false;
          document.getElementById("invoice_date").disabled = false;
          document.getElementById("invoice_number").disabled = false;
          document.getElementById("broker_account_code").disabled = false;
          document.getElementById("icp_code").disabled = false;
          document.getElementById("yesCommAm").disabled = false;
          document.getElementById("yesCurr").disabled = false;
          document.getElementById("broker_setup_yes").disabled = false;
          document.getElementById("broker_setup_no").disabled = false;
          document.getElementById("Remarks").disabled = false;
        }
      }

    </script>


  <!-- end new -->


  <button type="submit" class="btn btn-success" id="modal_save" name="modal_save" >Save</button>
  <button type="button" class="btn btn-danger" id="modal_reject" name="modal_reject"  >Reject</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


  <br>

</div>

</div>
</div>
</div>
</div>
<!--/form-->
</div>

<!-- temporary error modal is this used?-->
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
  $(document).ready(function() {
    $('#invoice_date').datepicker({
      format: 'yyyy-mm-dd'
    });

    $('#date_received').datepicker({
      format: 'yyyy-mm-dd'
    });

    if($('#review_by_display').val().length == 0){
      $('#updateremarks').attr('disabled', true);
      document.getElementById("review_by").value = document.getElementById("getuser").value
      document.getElementById("review_by_display").value = document.getElementById("getuser").value
      document.getElementById("date_of_validation_display").value = document.getElementById("gettoday").value

      document.getElementById("previousupdateby").value = "";
      document.getElementById("update_timestamp").value = "";
      document.getElementById("updateremarks").value = "";

    }else {
      $('#updateremarks').attr('disabled',false);
      document.getElementById("previousupdateby").value = document.getElementById("getuser").value
      document.getElementById("update_timestamp").value = document.getElementById("gettoday").value
    }

    document.getElementById("hidecheck2").style.display = "none";
    document.getElementById("hidecheck3").style.display = "none";
    document.getElementById("hidecheck4").style.display = "none";
    document.getElementById("hidecheck5").style.display = "none";
    document.getElementById("hidecheck6").style.display = "none";
    document.getElementById("hidecheck7").style.display = "none";
    document.getElementById("hidecheck8").style.display = "none";
    document.getElementById("hidecheck9").style.display = "none";

    document.getElementById("hidetext1").style.display = "none";
    document.getElementById("hidetext2").style.display = "none";
    document.getElementById("hidetext3").style.display = "none";
    document.getElementById("hidetext4").style.display = "none";
    document.getElementById("hidetext5").style.display = "none";
    document.getElementById("hidetext6").style.display = "none";
    document.getElementById("hidetext7").style.display = "none";
    document.getElementById("hidetext8").style.display = "none";
    document.getElementById("hidetext9").style.display = "none";

    $('#modal_reject').click(function () {
      var button=this;
      if ($('#hidecheck2').is(':visible')) {
         location.reload();
        $("#modal_reject").text("Cancel");
        document.getElementById("iscommissionable").disabled = false;
        document.getElementById("yesCommAm").disabled = false;
        document.getElementById("yesCurr").disabled = false;
        document.getElementById("invoice_amount_total").disabled = false;
        document.getElementById("date_received").disabled = false;
        document.getElementById("invoice_date").disabled = false;
        document.getElementById("invoice_number").disabled = false;
        document.getElementById("broker_account_code").disabled = false;
        document.getElementById("icp_code").disabled = false;
        document.getElementById("broker_setup_yes").disabled = false;
        document.getElementById("broker_setup_no").disabled = false;
        document.getElementById("Remarks").disabled = false;
        document.getElementById("rejected_yes_no").value = "";
      } else {
        $("#modal_reject").text("Reject");
        document.getElementById("iscommissionable").disabled = true;
        document.getElementById("yesCommAm").disabled = true;
        document.getElementById("yesCurr").disabled = true;

        document.getElementById("hidecheck2").checked = false;
        document.getElementById("hidecheck3").checked = false;
        document.getElementById("hidecheck4").checked = false;
        document.getElementById("hidecheck5").checked = false;
        document.getElementById("hidecheck6").checked = false;
        document.getElementById("hidecheck7").checked = false;
        document.getElementById("hidecheck8").checked = false;
        document.getElementById("hidecheck9").checked = false;

        document.getElementById("yesCommAm").checked = false;
        document.getElementById("yesCurr").checked = false;
        document.getElementById("invoice_amount_total").disabled = true;
        document.getElementById("date_received").disabled = true;
        document.getElementById("invoice_date").disabled = true;
        document.getElementById("invoice_number").disabled = true;
        document.getElementById("broker_account_code").disabled = true;
        document.getElementById("icp_code").disabled = true;
        document.getElementById("update_currency").disabled = true;
        document.getElementById("commission_amount_update").disabled = true;
        document.getElementById("broker_setup_yes").disabled = true;
        document.getElementById("broker_setup_no").disabled = true;
        document.getElementById("Remarks").disabled = true;

        document.getElementById("invoice_amount_total").value = "";
        document.getElementById("date_received").value = "";
        document.getElementById("invoice_date").value = "";
        document.getElementById("invoice_number").value = "";
        document.getElementById("broker_account_code").value = "";
        document.getElementById("icp_code").value = "";
        document.getElementById("update_currency").value = "";
        document.getElementById("commission_amount_update").value = "";
        document.getElementById("Remarks").value = "";

        document.getElementById("rejected_yes_no").value = "Rejected";

        document.getElementById("review_by_display").value = "";
        document.getElementById("date_of_validation_display").value = "";
        document.getElementById("updateremarks").disabled = true;
        document.getElementById("previousupdateby").value = "";
        document.getElementById("update_timestamp").value = "";

        document.getElementById("previousupdateby").value = document.getElementById("getuser").value
        document.getElementById("update_timestamp").value = document.getElementById("gettoday").value
      }

      $('#hidecheck2, #hidecheck3, #hidecheck4, #hidecheck5, #hidecheck6, #hidecheck7, #hidecheck8, #hidecheck9, #hidetext1, #hidetext2, #hidetext3, #hidetext4, #hidetext5, #hidetext6, #hidetext7, #hidetext8, #hidetext9').slideToggle('fast', function () {

        if ($('#hidecheck2').is(':visible')) {
          $("#modal_reject").text("Cancel");
        } else {
          $("#modal_reject").text("Reject");
        }
      });

    });

    document.getElementById('yesCurr').onchange = function(e) {
      $("#update_currency").prop("disabled", !$(this).is(':checked'));
      document.getElementById("update_currency").value = "";
    };

    document.getElementById('yesCommAm').onchange = function(e) {
      $("#commission_amount_update").prop("disabled", !$(this).is(':checked'));
      document.getElementById("commission_amount_update").value = "";
    };

    var confirmationDialogs = {
      custom: function(event, message){
        var result = window.confirm(message);
        if (result) {
          return true;
        } else {
          event.preventDefault();
        }
      }
    }

    //paste guard special characters.
    $("#commission_amount_update, #invoice_amount_total").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
      var pasteData = e.originalEvent.clipboardData.getData('text');
      var returnData = pasteData.replace(/[^0-9.]/g, "");
      e.preventDefault();
      $(this).val(returnData);
    });

    $("#update_currency").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
      var pasteData = e.originalEvent.clipboardData.getData('text');
      var returnData = pasteData.replace(/[^a-z]/gi, "");
      e.preventDefault();

      $(this).val(returnData.toUpperCase());
   });

    $("#modal_save").click(function(event) {
      //event.preventDefault();
      var form_data=$("#submitForm").serializeArray();
      var isDisabledBAC = $('#broker_account_code').prop('disabled');

      formFields = {};
      //Make formFields use Value in Key Value
      $(form_data).each(function(i, field){
        formFields[field.name] = field.value;
      });

      if (isDisabledBAC){
        if(formFields["date_received"] =='' || formFields["invoice_date"] =='' || formFields["invoice_number"] =='' || formFields["icp_code"] =='' || formFields["invoice_amount_total"] ==''){
          event.preventDefault();
          $('#date_received').addClass("invalid");
          $('#invoice_number').addClass("invalid");
          $('#invoice_date').addClass("invalid");
          $('#invoice_amount_total').addClass("invalid");
          $('#icp_code').addClass("invalid");
          alert("please fill in the required fields");
        } else if(formFields["invoice_number_from_db"] != ''){
          confirmationDialogs.custom(event, "Do you wish to overwrite existing data?");
        }
      } else if (formFields["date_received"] =='' || formFields["invoice_date"] =='' || formFields["invoice_number"] ==''|| formFields["invoice_amount_total"] =='' ||
        formFields["broker_account_code"] =='' || formFields["icp_code"] =='' ) {
        event.preventDefault();
        $('#date_received').addClass("invalid");
        $('#invoice_number').addClass("invalid");
        $('#invoice_date').addClass("invalid");
        $('#invoice_amount_total').addClass("invalid");
        $('#icp_code').addClass("invalid");
        $('#broker_account_code').addClass("invalid");
        alert("please fill in the required fields");
      } else if(formFields["invoice_number_from_db"] != ''){
        confirmationDialogs.custom(event, "Do you wish to overwrite existing data?");
      }
    });

    $('#date_received, #invoice_date').datepicker().on('changeDate',function(e){
      var isempty = true;
      $(this).datepicker('hide');
      var date_received = $('#date_received').val();
      var invoice_date = $('#invoice_date').val();
    });

    var checkBoxes = $('td .required_checkboxes');

    checkBoxes.change(function () {
      $('#openModal').prop('disabled', checkBoxes.filter(':checked').length < 1);
    });

    $('td .required_checkboxes').change();

    $("#commission_amount_update, #invoice_amount_total").on("keypress",function(e){
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

    $('#update_currency').keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      } else {
        return false;
      }
  });

    //#remarks
    $('#invoice_number, #broker_account_code, #icp_code').keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z0-9!@#$%^&*()`~_\\-\\+={}\\[\\]:<>,.\/?\\\\]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      } else {
        return false;
      }
    });

    //escape key
    $(document).keydown(function(e) {
      if (e.keyCode == 27) return false;
      if (e.keyCode == 13) return false;
    });

    $("#date_received, #invoice_date, #update_currency, #commission_amount_update,#invoice_number, #invoice_amount_total, #broker_account_code, #icp_code, #Remarks").keydown(function(e) {
    if (e.keyCode == 27) {
      return false;
    }
  });

    $('#broker_setup_yes').click(function(){
      $('#broker_account_code').removeAttr("disabled");
      $('#icp_code').removeAttr("disabled");
    });

    $('#broker_setup_no').click(function(){
      alert('Please send Broker Set-up Request to Vendor Maintenance Team');
      $('#broker_account_code').attr("disabled", "disabled");
      document.getElementById("broker_account_code").value = "";
    });

    var date_input=$('input[name="date_received"]'); //our date input has the name "date"
    var date_input2=$('input[name="invoice_date"]'); //our date input has the name "date"

    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var curDate = new Date();
    var options={
      format: 'mm/dd/yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
      toggleActivate: true,
    };

    date_input.datepicker(options);
    date_input2.datepicker(options);


   $('#update_currency, #invoice_number, #broker_account_code, #icp_code').keyup(function() {
      $(this).val($(this).val().toUpperCase());
    });

   $('#select_all').on('click',function(){
    if(this.checked){
      $('.required_checkboxes').each(function(){
          if($(this).is(':disabled')){
            this.checked = false;
          } else {
            this.checked = true;
          }
      });

    }else{
      $('.required_checkboxes').each(function(){
        this.checked = false;
      });
    }

   $('.required_checkboxes').each(function(){
      if ($(this).is(':enabled')) {
        $('.chec_emp[value="'+$(this).val()+'"]').not(this).prop('disabled', 'disabled').prop('checked', false);
      }
    });
  });

});
</script>

<br>
<br>

<button type="submit" class="btn btn-info btn-lg" id="openModal" disabled name="openModal">Update Record(s)</button data-target="#myModal">

  <br>
  <br>

<?php
  function saveTransaction($conn, $description, $auditdb){
    $user = $_SESSION['user'];
    $Reference_Number1 = $_POST['Reference_Number1'];

    $query1 = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
    $query1->execute(array($user));
    $result1 = $query1->fetch(PDO::FETCH_LAZY, 0);

    $Chk_Name = $result1['Chk_Name'];
    $Chk_Username = $result1['Chk_Username'];
    $Chk_Position = $result1['Chk_Position'];

    $save_db = $conn->query("INSERT INTO ".$auditdb."  (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', '$description', getdate());");

    if (!$save_db){
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }
  }

  function rejectCommission($conn, $months, $inventorySaleIds, $db){
    @$hidecheck2 = $_POST['invoice'];
    @$hidecheck3 = $_POST['entity'];
    @$hidecheck4 = $_POST['address'];
    @$hidecheck5 = $_POST['amount'];
    @$hidecheck6 = $_POST['currency'];
    @$hidecheck7 = $_POST['duplicate'];
    @$hidecheck8 = $_POST['invalidinvoice'];
     $Reference_Number1 = $_POST['Reference_Number1'];
    @$hidecheck9 = $_POST['clientcancelled'];

       @$previousupdateby = $_POST['previousupdateby'];
    @$update_timestamp = $_POST['update_timestamp'];

    $query = $conn->query("
      Update ".$db."
      set
      Invoice_Review_By = NULL,
      Invoice_Review_Date = NULL,
      Date_Received = NULL,
      Invoice_Number = NULL,
      Invoice_Received_Date = NULL,
      bca_currency = NULL,
      bca_commission_amount = NULL,
      Invoice_Total_Amount = NULL,
      Broker_Account_Code = NULL,
      [ICP_Code/Business_Unit] = NULL,
      Review_Remarks = NULL,
      isRejected = '1',
      Previous_Update_By = '$previousupdateby',
      Update_Timestamp = '$update_timestamp',
      Update_Remarks = NULL,

      isNo_InvoiceCopy='$hidecheck2',
      isIncorrect_No_LegalEntity='$hidecheck3',
      isIncorrect_No_LegalAddress='$hidecheck4',
      isIncorrect_Amount='$hidecheck5',
      isIncorrect_Currency='$hidecheck6',
      isDuplicate_Invoice='$hidecheck7',
      isIncompleteDetails='$hidecheck8',
      isClient_Cancelled='$hidecheck9',
      isCommissionable = '0'

      WHERE [MTM commission Payment Month] in ($months) and InventorySaleID in ($inventorySaleIds);"
    );

    $query->execute();
    if($query){
      echo "<script type='text/javascript'>alert('data updated')</script>";
      saveTransaction($conn, "Invoice Review: Reject Commission for: $Reference_Number1", $_SESSION['auditdb']);
    } else {
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }
  }

  function updateSelectedCommission($conn, $months, $inventorySaleIds, $commission_amount, $invoice_amount_total, $db){

    $review_by = $_POST['review_by'];
    $gettoday = $_POST['gettoday'];
    @$date_received = $_POST['date_received'];
    @$invoice_date = $_POST['invoice_date'];
    @$Remarks = $_POST['Remarks'];
    @$currency = $_POST['update_currency'];
    @$invoice_number = $_POST['invoice_number'];
    @$broker_account_code = $_POST['broker_account_code'];
    @$icp_code = $_POST['icp_code'];
     $Reference_Number1 = $_POST['Reference_Number1'];

    @$previousupdateby = $_POST['previousupdateby'];
    @$update_timestamp = $_POST['update_timestamp'];
    @$updateremarks = $_POST['updateremarks'];



    if (empty($previousupdateby)){
    #echo "<script>console.log( 'success!' );</script>";

      $query = $conn->query("
      Update ".$db."
      set
      Invoice_Review_By = '$review_by',
      Invoice_Review_Date = '$gettoday',
      Date_Received = '$date_received',
      Invoice_Number = '$invoice_number',
      Invoice_Received_Date = '$invoice_date',
      bca_currency = '$currency',
      bca_commission_amount = '$commission_amount',
      Invoice_Total_Amount = '$invoice_amount_total',
      Broker_Account_Code = '$broker_account_code',
      [ICP_Code/Business_Unit] = '$icp_code',
      Review_Remarks = '$Remarks',
      isRejected = '0',

      Previous_Update_By = NULL,
       Update_Timestamp = NULL,
       Update_Remarks = NULL,

      isNo_InvoiceCopy= NULL,
      isIncorrect_No_LegalEntity= NULL,
      isIncorrect_No_LegalAddress= NULL,
      isIncorrect_Amount= NULL,
      isIncorrect_Currency= NULL,
      isDuplicate_Invoice= NULL,
      isIncompleteDetails= NULL,
      isClient_Cancelled= NULL,
      isCommissionable = '0'

      WHERE [MTM commission Payment Month] in ($months) and InventorySaleID in ($inventorySaleIds);"
      );
    }else{
       $query = $conn->query("
       Update ".$db."
       set
       Date_Received = '$date_received',
       Invoice_Number = '$invoice_number',
       Invoice_Received_Date = '$invoice_date',
       bca_currency = '$currency',
       bca_commission_amount = '$commission_amount',
       Invoice_Total_Amount = '$invoice_amount_total',
       Broker_Account_Code = '$broker_account_code',
       [ICP_Code/Business_Unit] = '$icp_code',
       Review_Remarks = '$Remarks',
       isRejected = '0',

       Previous_Update_By = '$previousupdateby',
       Update_Timestamp = '$update_timestamp',
       Update_Remarks = '$updateremarks',

       isNo_InvoiceCopy= NULL,
       isIncorrect_No_LegalEntity= NULL,
       isIncorrect_No_LegalAddress= NULL,
       isIncorrect_Amount= NULL,
       isIncorrect_Currency= NULL,
       isDuplicate_Invoice= NULL,
       isIncompleteDetails= NULL,
       isClient_Cancelled= NULL,
       isCommissionable = '0'

       WHERE [MTM commission Payment Month] in ($months) and InventorySaleID in ($inventorySaleIds);"
     );
    }

    $query->execute();

    if($query){
      echo "<script type='text/javascript'>alert('data updated')</script>";
       saveTransaction($conn, "Invoice Review: Updated information for reference number $Reference_Number1:  Review By: $review_by, Date of Validation: $gettoday, Date Received: $date_received, Invoice Date: $invoice_date, Remarks: $Remarks, Currency: $currency, invoice_number: $invoice_number, Broker Account Code: $broker_account_code, icp_code = $icp_code, Updated by: $previousupdateby, updated timestamp: $update_timestamp, Update Remarks: $updateremarks", $_SESSION['auditdb']);
    } else {
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }

  }


function notcommissionable($conn, $months, $inventorySaleIds, $db){
    $review_by = $_POST['review_by'];
    $date_of_validation = $_POST['date_of_validation'];
    @$date_received = $_POST['date_received'];
    @$invoice_date = $_POST['invoice_date'];

    @$currency = $_POST['update_currency'];

    @$previousupdateby = $_POST['previousupdateby'];
    @$update_timestamp = $_POST['update_timestamp'];
    @$updateremarks = $_POST['updateremarks'];


    @$invoice_number = $_POST['invoice_number'];

    @$broker_account_code = $_POST['broker_account_code'];
    @$icp_code = $_POST['icp_code'];
     @$Reference_Number1 = $_POST['Reference_Number1'];

    $query = $conn->query("
    Update ".$db."
      set
      Invoice_Review_By = NULL,
      Invoice_Review_Date = NULL,
      Date_Received = NULL,
      Invoice_Number = NULL,
      Invoice_Received_Date = NULL,
      bca_currency = NULL,
      bca_commission_amount = NULL,
      Invoice_Total_Amount = NULL,
      Broker_Account_Code = NULL,
      [ICP_Code/Business_Unit] = NULL,
      Review_Remarks = NULL,
      isRejected = '0',

      Previous_Update_By = '$previousupdateby',
      Update_Timestamp = '$update_timestamp',
      Update_Remarks = '$updateremarks',

      isNo_InvoiceCopy=NULL,
      isIncorrect_No_LegalEntity=NULL,
      isIncorrect_No_LegalAddress=NULL,
      isIncorrect_Amount=NULL,
      isIncorrect_Currency=NULL,
      isDuplicate_Invoice=NULL,
      isIncompleteDetails=NULL,
      isClient_Cancelled= NULL,
      isCommissionable = '1'


      WHERE [MTM commission Payment Month] in ($months) and InventorySaleID in ($inventorySaleIds);"
    );

    $query->execute();

    if($query){
      echo "<script type='text/javascript'>alert('data updated')</script>";
      saveTransaction($conn, "Invoice Review: the Reference Number: $Reference_Number1 is not commissionable", $_SESSION['auditdb']);
    } else {
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }
  }

  function displayModal(){
    echo "<script>
      $(function() {
      $('#myModal').modal('show');
      });
      </script>";
  }

  function displayErrorMessage(){
    echo "<script type='text/javascript'>alert('The record you have selected is already edited by another user. Please note that you can only update new records or records that you have already edited.')</script>";
  }

  function checkIfEmptyOrEqualToCurrentUser($invoice_reviewBy_name, $currenctUser){
    if ((!strcmp($invoice_reviewBy_name[0], $currenctUser)) || strlen($invoice_reviewBy_name[0]) == 0) {
      displayModal();
    } else {
      displayErrorMessage();
    }
  }

   function removeSpecialcharacters1($value){
      return str_replace("'", "", $value);
  }

  function getHTMLASCIIEquiv($val){
    //odly fixes things. keep blank
    return $val;
  }

  // if(isset($_POST['modalload'])){
  //   print(implode( ", ", $_POST['chkresult'] ));
  // }

   if(isset($_POST['openModal'])){
    if(isset($_POST['chkresult'])){
      displayModal();
    }
 }

  if(isset($_POST['modal_save'])){

    $rejected_yes_no = $_POST['rejected_yes_no'];
    $iscommissionablecheck = $_POST['iscommissionablecheck'];

    @$invoice_amount_total = $_POST['invoice_amount_total'];
    @$commission_amount = $_POST['commission_amount_update'];
    $inventorySaleIds = $_POST['inventorySaleIds'];
    $months = $_POST['months'];

    //last catcher of invalid input.
    if (isset($commission_amount)){
      if ($commission_amount == ""){
        $comAmmountValidation = true;
      } else {
        $comAmmountValidation= is_numeric($commission_amount);
      }
    } else {
      $comAmmountValidation = true;
    }

    if(isset($currency)){
      if ($currency == ""){
        $currencyValidation =  true;
      }else {
        $currencyValidation = ctype_alpha($currency);
      }
    } else {
      $currencyValidation = true;
    }

    if($rejected_yes_no == 'Rejected'){
      rejectCommission($conn, $months, $inventorySaleIds, $_SESSION['db']);
    } else if ($iscommissionablecheck == 'NOT'){
      notcommissionable($conn,  $months, $inventorySaleIds, $_SESSION['db']);
    } else if(is_numeric($invoice_amount_total) && $comAmmountValidation && $currencyValidation){
      updateSelectedCommission($conn, $months, $inventorySaleIds, $commission_amount, $invoice_amount_total, $_SESSION['db']);

      //--------------------------UPLOAD Invoice --------------------------------

    // if(isset($_FILES['invoice'])){

    // $review_by = $_POST['review_by'];
    // $gettoday = $_POST['gettoday'];
    // @$date_received = $_POST['date_received'];
    // @$invoice_date = $_POST['invoice_date'];
    // @$Remarks = $_POST['Remarks'];
    // @$currency = $_POST['update_currency'];
    // @$invoice_number = $_POST['invoice_number'];
    // @$broker_account_code = $_POST['broker_account_code'];
    // @$icp_code = $_POST['icp_code'];
    //  $Reference_Number1 = $_POST['Reference_Number1'];

    // @$previousupdateby = $_POST['previousupdateby'];
    // @$update_timestamp = $_POST['update_timestamp'];
    // @$updateremarks = $_POST['updateremarks'];
    // @$id = $_POST['inventorySaleIds'];
    // @$months = $_POST['months'];

    // @$id = removeSpecialcharacters1($id);
    // @$months = removeSpecialcharacters1($months);

    //             date_default_timezone_set('Asia/Hong_Kong');
    //             $today = date("Y-m-d");

    //         $errors= array();
    //         $file_name = $_FILES['invoice']['name']; // file name with extension
    //         $file_basename = substr($file_name, 0, strripos($file_name, '.')); //get the base of file name for replace
    //         $file_size =$_FILES['invoice']['size']; //file size to control the size limit
    //         $file_tmp =$_FILES['invoice']['tmp_name']; // the tmp file of the uploaded file
    //         $file_type=$_FILES['invoice']['type']; // to control allowable file type
    //         $file_ext=strtolower(end(explode('.',$_FILES['invoice']['name']))); // to get the extension for control

    //         $newfilename = "Invoice_Form_" . $today . "_ISID-" . $id . "_M-" . $months . "_IN-" . $invoice_number . "_RN-" . $Reference_Number1 . "." . $file_ext; // renamed file

    //         $expensions= array("pdf","xlsx","xlsm"); // allowed extensions

    //         //extension checker if valid or not
    //         // if(in_array($file_ext,$expensions)=== false){
    //         //    $errors[]="extension not allowed";
    //         // }

    //         //file size checker if it reaches the limit
    //         if($file_size > 2097152){
    //            $errors[]='File size must be excately 2 MB';
    //         }

    //         //check if the upload is success or not
    //         if(empty($errors)==true){

    //            $File_Path = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\BCUI\\' . $newfilename;


    //            move_uploaded_file($file_tmp,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/BCUI/".$newfilename);

    // if ($_FILES['invoice']['size'] > 0)
    // {
    //   $save_db_3 = $conn->query("update ".$_SESSION['db']." set File_Path_Invoices = '$File_Path' where InventorySaleID in ('$id') and [MTM commission Payment Month] in ('$months')");
    // }

    //         }else{
    //            print_r($errors);
    //         }

    //     }


      //---------------UPLOAD INVOICE END-------------------------


        //--------------------------UPLOAD Broker Form --------------------------------

//     if(isset($_FILES['broker'])){

//     $review_by = $_POST['review_by'];
//     $gettoday = $_POST['gettoday'];
//     @$date_received = $_POST['date_received'];
//     @$invoice_date = $_POST['invoice_date'];
//     @$Remarks = $_POST['Remarks'];
//     @$currency = $_POST['update_currency'];
//     @$invoice_number = $_POST['invoice_number'];
//     @$broker_account_code = $_POST['broker_account_code'];
//     @$icp_code = $_POST['icp_code'];
//      $Reference_Number1 = $_POST['Reference_Number1'];

//     @$previousupdateby = $_POST['previousupdateby'];
//     @$update_timestamp = $_POST['update_timestamp'];
//     @$updateremarks = $_POST['updateremarks'];
//     @$id = $_POST['inventorySaleIds'];
//     @$months = $_POST['months'];

//     @$id = removeSpecialcharacters1($id);
//     @$months = removeSpecialcharacters1($months);

//                 date_default_timezone_set('Asia/Hong_Kong');
//                 $today = date("Y-m-d");

//             $errors1 = array();
//             $file_name1 = $_FILES['broker']['name']; // file name with extension
//             $file_basename1 = substr($file_name, 0, strripos($file_name, '.')); //get the base of file name for replace
//             $file_size1 =$_FILES['broker']['size']; //file size to control the size limit
//             $file_tmp1 =$_FILES['broker']['tmp_name']; // the tmp file of the uploaded file
//             $file_type1 =$_FILES['broker']['type']; // to control allowable file type
//             $file_ext1 =strtolower(end(explode('.',$_FILES['broker']['name']))); // to get the extension for control

//             $newfilename1 = "Broker_Form_" . $today . "_ISID-" . $id . "_M-" . $months . "_IN-" . $invoice_number . "_RN-" . $Reference_Number1 . "." . $file_ext; // renamed file

//             $expensions1 = array("pdf","xlsx","xlsm"); // allowed extensions

//             //extension checker if valid or not
//             // if(in_array($file_ext,$expensions)=== false){
//             //    $errors[]="extension not allowed";
//             // }

//             //file size checker if it reaches the limit
//             if($file_size1 > 2097152){
//                $errors1[]='File size must be excately 2 MB';
//             }

//             //check if the upload is success or not
//             if(empty($errors1)==true){

//                $File_Path1 = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\BCUI\\' . $newfilename1;


//                move_uploaded_file($file_tmp1,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/BCUI/".$newfilename1);


//  if ($_FILES['broker']['size'] > 0)
//     {
//       $save_db_4 = $conn->query("update ".$_SESSION['db']." set [File_Path_Broker Registration Form/ACH] = '$File_Path' where InventorySaleID in ('$id') and [MTM commission Payment Month] in ('$months')");
//     }

//             }else{
//                print_r($errors1);
//             }

//         }

      //---------------UPLOAD broker form END-------------------------

    } else {
      echo "<script type='text/javascript'>alert('Amount fields has detected characters, please be careful on using copy paste function. The Data is not saved.');</script>";
    }
  }
?>

<table class="table table table-hover set-bg">
  <thead class="headTable">
   <tr>
    <td style="width:160px">Check the Applicable <br><input class="required_checkboxes" type="checkbox" id="select_all" /> Select all</td>
    <th style="width:100px">Initial Sent Date</th>
    <th style="width:100px">Report Type</th>
    <th style="width:100px">Reference ID</th>
    <th style="width:80px">Reference Number</th>
    <th style="width:100px">Titan CompanyID</th>
    <th style="width:100px">SaleId</th>
    <th style="width:100px">Inventory SaleID</th>
    <th style="width:100px">Sale Confirmed Date</th>
    <th style="width:150px">Agent/Broker</th>
    <th style="width:150px">Agent/Broker Country</th>
    <th style="width:150px">Agent/Broker Contact Name</th>
    <th style="width:250px">Agent/Broker Contact E-Mail</th>
    <th style="width:150px">Agent/Broker Contact Country</th>
    <th style="width:200px">Company Name</th>
    <th style="width:150px">Company Contact</th>
    <th style="width:100px">Product</th>
    <th style="width:100px">Is Month to Month Contract</th>
    <th style="width:100px">MTM Commission Payment Month</th>
    <th style="width:150px">Inventory Name</th>
    <th style="width:100px">Agreement Start Date</th>
    <th style="width:100px">Agreement End Date</th>
    <th style="width:100px">Months to Break</th>
    <th style="width:100px">Workstations</th>
    <th style="width:100px">Average Monthly Price</th>
    <th style="width:150px">Country of Centre</th>
    <th style="width:150px">Centre Name</th>
    <th style="width:150px">Legal Entity</th>
    <th style="width:200px">Entity Address</th>
    <th style="width:150px">VAT (if applicable)</th>
    <th style="width:100px">Contract Value (Local)</th>
    <th style="width:150px">Commission Amount(Local)</th>
    <th style="width:100px">Currency</th>
    <th style="width:100px">Agent/Broker Currency</th>
    <th style="width:100px">Exchange Rate from Contract to Payment Currency</th>
    <th style="width:100px">Commission Amount</th>
    <th style="width:150px">Invoice Review By</th>
    <th style="width:100px">Invoice Review Date</th>
    <th style="width:150px">Date Received</th>
    <th style="width:150px">Invoice Number</th>
    <th style="width:150px">Invoice Received Date</th>
    <th style="width:100px">Manual Currency</th>
    <th style="width:100px">Manual Commission Amount</th>
    <th style="width:100px">Invoice Total Amount</th>
    <th style="width:150px">Broker Account Code</th>
    <th style="width:150px">ICP Code/Business Unit</th>
    <th style="width:150px">Previous Update By</th>
    <th style="width:150px">Update Timestamp</th>
    <th style="width:150px">Update Remarks</th>
    <th style="width:150px">Remarks</th>
    <th style="width:150px">Rejected?</th>
    <th style="width:150px">Rejected_Reason</th>
    <th style="width:150px">Is Not Commissionable?</th>
    <th style="width:150px">Is Cancelled?</th>
    <th style="width:150px">Is Exception?</th>
    <th style="width:150px">Exception Reason</th>
    <th style="width:150px">Encoded By</th>
    <th style="width:150px">Date of Encode</th>
    <!-- <th style="width:150px">File_Path_Invoices</th>
    <th style="width:150px">File_Path_Broker Registration Form/ACH</th> -->
  </tr>
</thead>
<?php
if(isset($_POST['Find'])){
  $Reference_Number = $_POST['Reference_Number'];
  if($Reference_Number == ''){
    echo "<script type='text/javascript'>alert('Please enter a valid input!')</script>";
  }else{

    //removed cd.File_Path_Invoices ,
    //  cd.[File_Path_Broker Registration Form/ACH] ,

    $query = "select
      ddate.Create_Date,
      cd.[Reference_ID],
      cd.[Report_Type],
      cd.[Reference_Number],
      cd.[TitanCompanyID],
      cd.[saleid],
      cd.[InventorySaleID],
      cd.[Sale Confirmed Date],
      cd.[Broker_Agent_Name],
      cd.[Broker_Company_Country],
      cd.[Broker_Company_Name],
      cd.[Broker_Agent_Email],
      cd.[Broker_Agent_Country],
      cd.[CompanyName],
      cd.[Encoded_by],
      cd.[Date_of_Encode],
      cd.[Company_Contact],
      cd.[ProductGroupName],
      Case when cd.[IsMtm] = 1 then 'Yes' else 'No' end as [IsMtm],
      Case when cd.[isException] = 1 then 'Yes' else 'No' end as [isException],
      cd.[MTM commission Payment Month],
      cd.[InventoryName],
      cd.[Start Date],
      cd.[End Date],
      cast(cd.[Term (Months)] as decimal(16,2)) as [Term (Months)],
      cd.[InventorySaleWorkstations],
      Convert(varchar,cast(cast (cd.[Average_Monthly_Price_Local] as decimal(16,2))as money),1) as [Average_Monthly_Price_Local],
      cd.[Country of Centre],
      cd.[CentreName],
      cd.[Exception_Reason],
      cd.[LegalEntity],
      cd.[Entity_Address],
      cd.[VATCode],
      Convert(varchar,cast(cast ([Total Contract Value Local] as decimal(16,2))as money),1) as [Total Contract Value Local],
      Convert(varchar,cast(cast ([Commission_Amount_Local] as decimal(16,2))as money),1) as [Commission_Amount_Local],
      [Contract Currency],
      [Payment Currency],
      cast(cd.[Exchange Rate from Contract to Payment Currency] as decimal(16,2)) as [Exchange Rate from Contract to Payment Currency],
      Convert(varchar,cast(cast (cd.[Commission_Amount] as decimal(16,2))as money),1) as [Commission_Amount],
      cd.[Invoice_Review_By],
      cd.[Invoice_Review_Date],
      cd.[Date_Received],
      cd.[Invoice_Number],
      cd.[Invoice_Received_Date],
      cd.[bca_currency],
      cd.[bca_commission_amount],
      cd.[Invoice_Total_Amount],
      Case when cd.[isCommissionable] = 1 then 'Yes' else 'No' end as [isCommissionable],
      cd.[Broker_Account_Code],
      cd.[ICP_Code/Business_Unit],
      cd.[Previous_Update_By],
     convert(varchar(19),cd.Update_Timestamp , 120) as [Update_Timestamp],
      cd.[Update_Remarks],
      cd.Review_Remarks,
      Case when cd.[isRejected] = 1 then 'Yes' else 'No' end as [isRejected],
                        STUFF(
                       case when isNo_InvoiceCopy = 1  then 'No Invoice Copy | ' else '' end +
                       case when isIncorrect_No_LegalEntity = 1 then 'Incorrect/No LegalEntity | ' else '' end +
                       case when isIncorrect_No_LegalAddress = 1 then 'Incorrect/No LegalAddress | ' else '' end +
                       case when isIncorrect_Amount = 1 then 'Incorrect Amount | ' else '' end +
                       case when isIncorrect_Currency = 1 then 'Incorrect Currency | ' else '' end +
                       case when isDuplicate_Invoice = 1 then 'Duplicate Invoice | ' else '' end +
                       case when isIncompleteDetails = 1 then 'Invalid Invoice/Incomplete Details | ' else '' end +
                       case when isClient_Cancelled = 1 then 'Client Cancelled/Booking Terminated | ' else '' end
              , LEN(
                       case when isNo_InvoiceCopy = 1  then 'No Invoice Copy | ' else '' end +
                       case when isIncorrect_No_LegalEntity = 1 then 'Incorrect/No LegalEntity | ' else '' end +
                       case when isIncorrect_No_LegalAddress = 1 then 'Incorrect/No LegalAddress | ' else '' end +
                       case when isIncorrect_Amount = 1 then 'Incorrect Amount | ' else '' end +
                       case when isIncorrect_Currency = 1 then 'Incorrect Currency | ' else '' end +
                       case when isDuplicate_Invoice = 1 then 'Duplicate Invoice | ' else '' end+
                       case when isIncompleteDetails = 1 then 'Invalid Invoice/Incomplete Details | ' else '' end +
                       case when isClient_Cancelled = 1 then 'Client Cancelled/Booking Terminated | ' else '' end
              ), 3, '')
      as Rejected_Reason,

    Case when ca.InventorySaleID is not null then 'Cancelled' else '' end as isCancelled

      from (

      select * from ".$_SESSION['db']."
      where iscurrent = 1

      UNION

      select distinct a.* from ".$_SESSION['db']." a
      inner join [BCA].[Cancelled_Deals] b
      on a.InventorySaleID=b.InventorySaleID and a.Create_Date=b.Sent_Date


    ) cd

       LEFT JOIN [BCA].[Cancelled_Deals] ca on cd.InventorySaleID=ca.InventorySaleID

       LEFT JOIN (select min(Create_Date) as Create_Date, InventorySaleID, [MTM commission Payment Month]   from ".$_SESSION['db']." where
       Reference_Number = :Ref1  and Reference_ID is not NULL
       group by InventorySaleID,[MTM commission Payment Month]) ddate
       on cd.InventorySaleID = ddate.InventorySaleID and cd.[MTM commission Payment Month]  = ddate.[MTM commission Payment Month]

       where cd.[Reference_Number] = :Ref2

       order by [MTM commission Payment Month], cd.[InventoryName]
";


    $result = $conn->prepare($query);
    $result->execute(array(':Ref1' => $Reference_Number, ':Ref2' => $Reference_Number));
    $result->execute();
    $row_count =$result->rowCount();

    $user = $_SESSION['user'];
    $query1 = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
    $query1->execute(array($user));
    $result1 = $query1->fetch(PDO::FETCH_LAZY, 0);



    // $Chk_Name = $result1['Chk_Name'];
    // $Chk_Username = $result1['Chk_Username'];
    // $Chk_Position = $result1['Chk_Position'];

    // $save_db = $conn->query("INSERT INTO BCA.Checking_Audit_Log (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'Invoice Review: Searched for Reference Number: $Reference_Number', getdate());");

    if(!$result->execute()){
     die('Error');
   }

   if($row_count == 0){
    echo '<tr><td colspan="50">No Available Data.</td></tr>';
  }else{
    $no = 1;
    $isReviewed = false;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){

      if($row['Invoice_Review_By'] != ''){
          $isReviewed = true;
      }

      $row_cancelled = '';
      $td_color = "";

      if (strlen($row['isCancelled']) > 0) {
          $row_cancelled = 'disabled';
          $td_color = "bgcolor=" . "'"."#ff8a80"."'";
      }

     echo '<tr '.$td_color.'>';

     //echo '<td><label><input name="chkresult[]" class="required_checkboxes"  type="checkbox" value="'.$row['Commission_Amount'].' ^^ '.$row['InventorySaleID'].' ^^ '.getHTMLASCIIEquiv($row['Invoice_Number']).' ^^ '.$row['MTM commission Payment Month'].' ^^ '.$row['Date_Received'].' ^^ '.$row['Invoice_Review_Date'].' ^^ '.$row['bca_currency'].' ^^ '.$row['bca_commission_amount'].' ^^ '.$row['Invoice_Total_Amount'].' ^^ '.getHTMLASCIIEquiv($row['Broker_Account_Code']).' ^^ '.getHTMLASCIIEquiv($row['ICP_Code/Business_Unit']).' ^^ '.getHTMLASCIIEquiv($row['Review_Remarks']).' ^^ '.$row['Invoice_Review_By'].' ^^ '.$row['Invoice_Review_Date'].' ^^ '.$row['Previous_Update_By'].' ^^ '.$row['Update_Timestamp'].' ^^ '.$row['Update_Remarks'].' ^^ '.$row['File_Path_Invoices'].' ^^ '.$row['File_Path_Broker Registration Form/ACH'].'" '.$row_cancelled.'></label></td>';
     echo '<td><label><input name="chkresult[]" class="required_checkboxes"  type="checkbox" value="'.$row['Commission_Amount'].' ^^ '.$row['InventorySaleID'].' ^^ '.getHTMLASCIIEquiv($row['Invoice_Number']).' ^^ '.$row['MTM commission Payment Month'].' ^^ '.$row['Date_Received'].' ^^ '.$row['Invoice_Received_Date'].' ^^ '.$row['bca_currency'].' ^^ '.$row['bca_commission_amount'].' ^^ '.$row['Invoice_Total_Amount'].' ^^ '.getHTMLASCIIEquiv($row['Broker_Account_Code']).' ^^ '.getHTMLASCIIEquiv($row['ICP_Code/Business_Unit']).' ^^ '.getHTMLASCIIEquiv($row['Review_Remarks']).' ^^ '.$row['Invoice_Review_By'].' ^^ '.$row['Invoice_Review_Date'].' ^^ '.$row['Previous_Update_By'].' ^^ '.$row['Update_Timestamp'].' ^^ '.$row['Update_Remarks'].'" '.$row_cancelled.'></label></td>';

     //Create_Date
     echo '<td>'.$row['Create_Date'].'</td>';
     echo '<td>'.$row['Report_Type'].'</td>';
 echo '<td>'.$row['Reference_ID'].'</td>';


     echo '<td bgcolor="#fff59d">'.$row['Reference_Number'].'<input type="text" name="ref_number" hidden value="'.$row['Reference_Number'].'"></td>';

     echo '<td>'.$row['TitanCompanyID'].'</td>';
     echo '<td>'.$row['saleid'].'</td>';
     echo '<td bgcolor="#fff59d">'.$row['InventorySaleID'].'<input type="text" name="InventorySaleID[]" hidden value="'.$row['InventorySaleID'].'"></td>';
     echo '<td>'.$row['Sale Confirmed Date'].'</td>';
     echo '<td>'.$row['Broker_Company_Name'].'</td>';
     echo '<td>'.$row['Broker_Company_Country'].'</td>';
     echo '<td>'.$row['Broker_Agent_Name'].'</td>';
     echo '<td>'.$row['Broker_Agent_Email'].'</td>';
     echo '<td>'.$row['Broker_Agent_Country'].'</td>';
     echo '<td>'.$row['CompanyName'].'</td>';
     echo '<td>'.$row['Company_Contact'].'</td>';
     echo '<td>'.$row['ProductGroupName'].'</td>';
     echo '<td>'.$row['IsMtm'].'</td>';
     echo '<td>'.$row['MTM commission Payment Month'].'</td>';
     echo '<td>'.$row['InventoryName'].'</td>';
     echo '<td>'.$row['Start Date'].'</td>';
     echo '<td>'.$row['End Date'].'</td>';
     echo '<td>'.$row['Term (Months)'].'</td>';
     echo '<td>'.$row['InventorySaleWorkstations'].'</td>';
     echo '<td>'.$row['Average_Monthly_Price_Local'].'</td>';
     echo '<td>'.$row['Country of Centre'].'</td>';

     echo '<td bgcolor="#fff59d">'.$row['CentreName'].'<input type="text" name="CentreName" hidden value="'.$row['CentreName'].'"></td>';
     echo '<td bgcolor="#fff59d">'.$row['LegalEntity'].'<input type="text" name="LegalEntity" hidden value="'.$row['LegalEntity'].'"></td>';
     echo '<td bgcolor="#fff59d">'.$row['Entity_Address'].'<input type="text" name="Entity_Address" hidden value="'.$row['Entity_Address'].'"></td>';
     echo '<td bgcolor="#fff59d">'.$row['VATCode'].'<input type="text" name="VATCode" hidden value="'.$row['VATCode'].'"></td>';

     echo '<td>'.$row['Total Contract Value Local'].'</td>';
     echo '<td>'.$row['Commission_Amount_Local'].'</td>';
     echo '<td>'.$row['Contract Currency'].'</td>';
     echo '<td>'.$row['Payment Currency'].'<input type="text" name="paymentCurrency" hidden value='.$row['Payment Currency'].' ></td>';
     echo '<td>'.$row['Exchange Rate from Contract to Payment Currency'].'</td>';
     echo '<td bgcolor="#fff59d">'.$row['Commission_Amount'].'<input type="text" hidden  value='.$row['Commission_Amount'].' ></td>';

     echo '<td>'.$row['Invoice_Review_By'].'<input type="text" name="Invoice_Review_By" hidden value='.$row['Invoice_Review_By'].' ></td>';
     echo '<td>'.$row['Invoice_Review_Date'].'<input type="text" name="Invoice_Review_Date" hidden value='.$row['Invoice_Review_Date'].' ></td>';

     echo '<td>'.$row['Date_Received'].'</td>';

     echo '<td>'.$row['Invoice_Number'].'</td>';
     echo '<td>'.$row['Invoice_Received_Date'].'</td>';

     echo '<td>'.$row['bca_currency'].'</td>';
     echo '<td>'.$row['bca_commission_amount'].'</td>';

     echo '<td>'.$row['Invoice_Total_Amount'].'</td>';
     echo '<td>'.$row['Broker_Account_Code'].'</td>';
     echo '<td>'.$row['ICP_Code/Business_Unit'].'</td>';

     echo '<td>'.$row['Previous_Update_By'].'</td>';
     echo '<td>'.$row['Update_Timestamp'].'</td>';
     echo '<td>'.$row['Update_Remarks'].'</td>';


    echo '<td>'.$row['Review_Remarks'].'</td>';

     echo '<td>'.$row['isRejected'].'<input type="text" name="isRejected"  hidden value='.$row['isRejected'].' ></td>';
     echo '<td>'.$row['Rejected_Reason'].'<input type="text" name="Rejected_Reason"  hidden value='.$row['Rejected_Reason'].' ></td>';
     echo '<td>'.$row['isCommissionable'].'<input type="text" name="isCommissionable"  hidden value='.$row['isCommissionable'].' ></td>';
     echo '<td>'.$row['isCancelled'].'</td>';
     echo '<td>'.$row['isException'].'</td>';
     echo '<td>'.$row['Exception_Reason'].'</td>';


     echo '<td>'.$row['Encoded_by'].'</td>';
     echo '<td>'.$row['Date_of_Encode'].'</td>';
    //  echo '<td>'.$row['File_Path_Invoices'].'</td>';
    //  echo '<td>'.$row['File_Path_Broker Registration Form/ACH'].'</td>';

     echo '<tr>';
   }

if($isReviewed){
  echo '<script type="text/javascript">alert("The Reference Number you have searched has a deal that has already been updated. Please check the Invoice Review By column to validate");</script>';
 }

 }
}
?>
</table>

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
      $save_db = $conn->query("INSERT INTO ".$auditDb." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'password changed to $new_password', getdate());");

      echo "<script type='text/javascript'>alert('Password was changed, Please Login again!')</script>";
      session_destroy();
      session_unset();
      ?>

      <script type="text/javascript">
       window.location = "index.php";
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
