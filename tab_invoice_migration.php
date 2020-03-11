  <?php
  session_start();

  if (!isset($_SESSION['isLogin'])) {
    header("Location: index.php");
    die();
  }

  date_default_timezone_set('Asia/Hong_Kong');
  $today = date("Y-m-d H:i:s");
  
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

    <!--script src="https://code.jquery.com/jquery-1.10.2.js"></script-->

    <!--  jQuery -->
    <script
      src="https://code.jquery.com/jquery-1.12.4.min.js"
      integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
      crossorigin="anonymous"></script>
    <!--script type="text/javascript" src="jquery/jquery-3.3.1.min"></script-->


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

    <!-- Toast.js -->
   <!-- <script type="text/javascript" src="js/jquery.toast.js"/>
   <link rel="stylesheet" href="css/jquery.toast.css"/> -->

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

   #isGlobal {
  transform: scale(0.5);
}

/*   #value1, #value2, #value3, #value4, #value5, #value6, #value7, #value8, #value9, #value10, #value11, #value12 {
  transform: scale(2);
  vertical-align: bottom;
}*/

#kulay1, #mtmpaymentlabel, #text1, #text2, #text3, #text4, #text5, #text6, #text7, #text8, #text9, #text10, #text11, #text12, #commlocal1, #commlocal2, #commlocal3, #commlocal4, #commlocal5, #commlocal6, #commlocal7, #commlocal8, #commlocal9, #commlocal10, #commlocal11, #commlocal12, #comm1, #comm2, #comm3, #comm4, #comm5, #comm6, #comm7, #comm8, #comm9, #comm10, #comm11, #comm12    {

color: #555;

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
                    <img id="tester" class="resize" src="image/Regus_logo15.png" />
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
                      echo '<li> <a href="tab_admin_update_exception.php?user=' . $user . '"> Update Exception Inputs</a></li>';
                    }
                    ?>
                    <!-- for us broker deals-->
                    <!--li><?php echo '<a href="Tab_US_Deals.php?user=' . $user . '">4 US Deals/US Brokers</a>'; ?></li-->
                  </ul>
                  <ul class="nav navbar-nav pull-right">
                    <?php $user = $_SESSION['user']; ?>
                    <li class=" dropdown"><a class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  Logged in as <?php echo $user; ?>  <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <!-- <li><a href="Report_Export.xlsx">Download Report</a>
                        </li> -->
                        <li><a id="btntest"> Change Password</a></li>
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
                            <input type="text" name="Reference_Number" id="Reference_Number" autocomplete="off" maxlength="20" style="text-align:center;" class="form-control" autofocus value="<?php
          echo isset($_POST['Reference_Number']) ? $_POST['Reference_Number'] : ''?>">

                            <br>
                            <button type="submit" name="Find" id="searchbut" class="btn btn-success custom" data-loading-text="<i class='fa fa-spinner fa-spin'></i> loading" onClick=" this.form.submit(); this.disabled=true;">Search</button>
                            <br>

                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
</div>

<div class='fixed side'>

    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
       <div class="col-md-6">
            <label class="col-m-2 control-label" id="kulay">Date Received</label>
            <input class="form-control element" id="date_received" name="date_received" style="text-align:center;" autocomplete="off" placeholder="YYYY-MM-DD" type="text" readonly>
            <input type="text" id="saleInventory" name="saleInventory" hidden>
            <input type="text" id="months" name="months" hidden >

            <input type="text" id="review_by" name="review_by" value = "<?php echo $_SESSION['user']; ?>" hidden>
            <input type="text" id="gettoday" name="gettoday" value = "<?php echo ("$today"); ?>" hidden>

       
        </div>
        <div class="col-md-6">
            <label class="col-m-2 control-label" id="kulay">Invoice Date</label>
            <input class="form-control element" id="invoice_date" name="invoice_date" autocomplete="off" placeholder="YYYY-MM-DD" type="text" style="text-align:center;" readonly>
        </div>
    </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Payment Currency</label>
            <input type="text" class="form-control" name="Payment_Currency"  id="Payment_Currency" style="text-align:center;" value="" disabled>
        </div>
    </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <input type="checkbox" id="update_currency_checked" name ="update_currency_checked"> <label class="col-m-2 control-label" id="kulay">Update Payment Currency</label>
            <input type="text" class="form-control" name="update_Payment_Currency" disabled id="update_Payment_Currency" style="text-align:center;" value="">
        </div>
    </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">

            <label class="col-m-2 control-label" id="kulay">Commission Amount</label>
            <input type="text" class="form-control" name="Commission_Amount" disabled id="Commission_Amount" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <input type="checkbox" id="update_ComAm_checked" name="update_ComAm_checked" > <label class="col-m-2 control-label" id="kulay">Update Commission Amount</label>
            <input type="text" class="form-control" name="update_Commission_Amount" disabled id="update_Commission_Amount" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">

            <label class="col-m-2 control-label" id="kulay">Invoice Number</label>
            <input type="text" class="form-control" name="invoice_number" id="invoice_number" style="text-align:center;" value="">
        </div>
    </div>


    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Invoice Amount Total</label>
            <input type="text" class="form-control" name="invoice_amount_total" id="invoice_amount_total" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">

     <div class="col-sm-4 col-sm-offset-4 text-center">

     <label class="col-m-2 control-label" id="kulay">Broker Set Up?</label>
     <div class="radio">
       <label class="col-m-2 control-label" id="kulay"><input type="radio" checked="checked" name="broker_setup" id="broker_setup_yes" value="yes" >Yes</label>
       <label class="col-m-2 control-label" id="RadioBtn"><input type="radio" name="broker_setup" id="broker_setup_no" value="No">No</label>
       <!--label class="col-m-2 control-label" id="RadioBtn"><input type="radio" name="optradiono" value="No">No</label-->
     </div>
   </div>
 </div>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">

 <div class="col-md-6">

    <label class="col-m-2 control-label" id="kulay">Broker Account Code</label>
    <input type="text"  class="form-control" name="broker_account_code"
    id="broker_account_code" autocomplete="off" style="text-align:center;" value="">

  </div>

  <div class="col-md-6">

    <label class="col-m-2 control-label" id="kulay">ICP Code/Bussiness Unit</label>
    <input type="text" autocomplete="off" class="form-control" name="icp_code" id="icp_code" style="text-align:center;" value= "">
    <br>
  </div>
</div>

<input type="text" id="previously_updated_by" name="previously_updated_by" hidden>
<input type="text" id="update_timestamp" name="update_timestamp" hidden>
<input type="text" id="update_remarks" name="update_remarks" hidden>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <label class="col-m-2 control-label" id="kulay">Updated By</label>
    <input type="text"  class="form-control" name="previously_updated_by_display"
    id="previously_updated_by_display" autocomplete="off" style="text-align:center;" value="" disabled>

  </div>
</div>

<!--  <div class="col-md-6">
    <label class="col-m-2 control-label" id="kulay">Journal/Voucher Number</label>
    <input type="text"  class="form-control" name="journal_voucher_number"
    id="journal_voucher_number" autocomplete="off" style="text-align:center;" value="">
  </div>

  <div class="col-md-6">
    <label class="col-m-2 control-label" id="kulay">Posted Amount</label>
    <input type="text" autocomplete="off" class="form-control" name="posted_Commission_Amount" id="posted_Commission_Amount" style="text-align:center;" value= "">
    <br>
  </div>
</div>
 -->

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <label class="col-m-2 control-label" id="kulay">Update Timestamp</label>
    <input type="text" autocomplete="off" class="form-control" name="update_timestamp_display" id="update_timestamp_display" style="text-align:center;" value= "" disabled>
    <br>
  </div>
</div>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <label class="col-m-2 control-label" id="kulay">Update Remarks</label>
    <input type="text" autocomplete="off" class="form-control" name="update_remarks_display" id="update_remarks_display" style="text-align:center;" value= "" disabled>
    <br>
  </div>
</div>
 

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <label class="col-m-2 control-label" id="kulay">Remarks</label>
    <input type="text" autocomplete="off" class="form-control" name="remarks" id="remarks" style="text-align:center;" value= "">
    <br>
  </div>
</div>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <br>
    <label class="col-m-2 control-label" id="kulay">Invoice Form</label>
    <input class="form-control" id="w9link" readonly value=""> </input>
    <br>
    <input class="col-m-2 control-label"  type="file" name="invoice_upload" id="invoice_upload" />
    <!-- onChange="validate(this.value)-->
    <br>
  </div>
</div>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">

  <div class="col-md-12">
    <br>
    <label class="col-m-2 control-label" id="kulay">Broker Registration Form/ACH</label>
    <input class="form-control" readonly value=""> </input>
    <br>
    <input class="col-m-2 control-label"  type="file" name="broker_upload" id="broker_upload" onChange="validate(this.value)" />
    <br>
  </div>
</div>


<div class="form-group row" id="RejectReasons" hidden style="margin-left:5px;margin-right:5px;">

  <div class ="col-md-12">
    <label class="col-m-2 control-label" id="hidetext7" >Please Choose Reject Reason Below:</label>
  </div>

  <div class ="col-md-12">
    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="invoice" id="invoice" value="1">
      <label class="col-m-2 control-label" id="hidetext1" >No Invoice Copy</label>
      <input type="text" id="isRejected" name="isRejected" value="0" hidden>
      <br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="entity" id="entity" value="1" >
      <label class="col-m-2 control-label" id="hidetext2" >Incorrect/No Legal Entity</label>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="address" id="address" value="1" >
      <label class="col-m-2 control-label" id="hidetext3" >Incorrect/No Address</label>
      <br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="amount" id="amount" value="1" >
      <label class="col-m-2 control-label" id="hidetext4" >Incorrect Amount</label>
      <br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="currency" id="currency" value="1" >
      <label class="col-m-2 control-label" id="hidetext5" >Incorrect Currency</label><br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="duplicate" id="duplicate" value="1" >
      <label class="col-m-2 control-label" id="hidetext6" >Duplicate Invoice</label><br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="invalidinvoice" id="invalidinvoice" value="1" >
      <label class="col-m-2 control-label" id="hidetext8" >Invalid Invoice/Incomplete Details</label><br>
    </div>

    <div id="chkboxline" class="">
      <input class="col-m-2" type="checkbox" name="clientcancelled" id="clientcancelled" value="1" >
      <label class="col-m-2 control-label" id="hidetext9" >Client Cancelled/Booking Terminated</label><br>
    </div>
  </div>
</div>
    <br>
    <br>
    
    <div class="modal-footer">
      <div class="" align="left">
      <input class="col-m-2" type="checkbox" name="iscommissionable" id="iscommissionable">
      <label class="col-m-2 control-label" id="iscommissionable_label" >Is not commissionable</label><br>
    </div>
    <br>
    <button type="submit" name="saveDB" id="saveDB" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-danger" id="rejected" name="rejected">Reject</button>
    <button type="button" class="btn btn-danger" id="rejected_cancel" name="rejected_cancel">Cancel</button>
  </div>

</div>


<br>
<br>

<script>

   function validate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();
    var arrayExtensions = ["pdf","xlsx","xlsm"];
    if (arrayExtensions.lastIndexOf(ext) == -1) {
      alert("Wrong extension type.");
      $("#invoice_upload, #broker_upload").val("");
    }
  }
  
  var checked_array = []
  function checkbox_clicked(checkbox_values) {

    var selected_value = checkbox_values.value.split(" ^^ ");
    var total_commission = 0;
    var inventorysaleid_array = [];
    var month_array = [];
    var error_message = [];
    var isMultiple = false;
    var wasReviewed = false;
    var hasWarnings = false;

  
    //remove if it is not clicked.
    if(checkbox_values.checked){
      checked_array.push(checkbox_values.value)
    } else {
      var i = checked_array.indexOf(checkbox_values.value);
      if(i != -1) {
        checked_array.splice(i, 1);
      }
    }

    //remove or add to checked array depending if it is clicked or not
    //and push that last selected to the input boxes
    checked_array.forEach(function(i){
      var current_checked = i.split(" ^^ ");
      var commission = current_checked[2].replace(',','');
      var inventory_sale_id = current_checked[3];
      var month = current_checked[4];
      total_commission += parseInt(commission);

      
      if(inventorysaleid_array.length != 0){
        if(!inventorysaleid_array.includes(inventory_sale_id)){
        isMultiple = true;
        } 
      }

      if(current_checked[5].length > 1){
        wasReviewed = true;
      }

      inventorysaleid_array.push(inventory_sale_id);  
      month_array.push(month);

      $('#previously_updated_by').val(current_checked[5]);
      $('#update_timestamp').val(current_checked[6]);
      $('#update_remarks').val(current_checked[7]);

      $('#previously_updated_by_display').val(current_checked[5]);
      $('#update_timestamp_display').val(current_checked[6]);
      $('#update_remarks_display').val(current_checked[7]);

      $('#Payment_Currency').val(current_checked[1]);
    });

    //console.log(checkbox_values)

    if(isMultiple){
      hasWarnings = true;
      error_message.push('Multiple Inventory Sale Id detected');
    }

    if(wasReviewed){
      error_message.push(' ,The Reference Number you selected has a deal that has already been updated')
      hasWarnings = true;
    }

    if(hasWarnings){
      var warning = 'Warning: ';
      warning_mesage = error_message.join();
      warning += warning_mesage;
      alert(warning)
    }

    $('#Commission_Amount').val(total_commission);
    $('#saleInventory').val(inventorysaleid_array);
    $('#months').val(month_array);

    //if there is no selected, set val to 0
    if (checked_array.length === 0){
      $('#Commission_Amount').val('');
      $('#Payment_Currency').val('');
      $('#previously_updated_by').val('');
      $('#update_timestamp').val('');
      $('#update_remarks').val('');
      $('#previously_updated_by_display').val('');
      $('#update_timestamp_display').val('');
      $('#update_remarks_display').val('');

    } 
    //console.log(checked_array);
  
  };

 $(document).ready(function() {
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

  var required = ['date_received', 'invoice_date', 'update_Commission_Amount', 'invoice_number', 'invoice_amount_total', 'broker_account_code', 'icp_code' ];

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

  //add comma to a number
  function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }

  function set_fields_if_not_commissionable(isDisabled){
    required.splice(required.indexOf('date_received'),1); //remove date_received on the required array disabling
    required.splice(required.indexOf('invoice_date'),1);  //add date_received on the required array for disabling
    required.forEach(function(i){
      $("#"+i).prop("disabled", isDisabled);
      $("#"+i).val('');
    });
    addtoRequired('date_received');
    addtoRequired('invoice_date');
  }

  function no_rejected_selected(){
    var ctr = 0;
    var rejected_array = ['invoice', 'entity', 'address', 'amount', 'currency', 'duplicate', 'invalidinvoice','clientcancelled'];

    rejected_array.forEach(function (i){
      if($('#'+i).is(':checked')){
        ctr +=1;
      }
    });    

    return (ctr > 0) ? false : true
  }

  document.getElementById('iscommissionable').onchange = function(e) {
    if($(this).is(':checked')){
      set_fields_if_not_commissionable(true);
    } else {
      set_fields_if_not_commissionable(false);
    }
  }

  $("#rejected").click(function(event){
     $('#isRejected').val('1');
     $("#iscommissionable, #iscommissionable_label, #rejected").hide();
     $("#RejectReasons, #rejected_cancel").show();
     set_fields_if_not_commissionable(true);
  });

  $("#rejected_cancel").click(function(event){
    $('#isRejected').val('0');
    $("#iscommissionable, #iscommissionable_label, #rejected").show();
    $("#RejectReasons, #rejected_cancel").hide();
    set_fields_if_not_commissionable(false);
    $('#iscommissionable').prop('checked', false);
  });

  document.getElementById('update_currency_checked').onchange = function(e) {
    if($(this).is(':checked')){
      $("#update_Payment_Currency").prop("disabled", false);
      addtoRequired('update_Payment_Currency');
    } else {
      $("#update_Payment_Currency").prop("disabled", true);
      removeFromRequired('update_Payment_Currency')
    }
  };

  document.getElementById('update_ComAm_checked').onchange = function(e) {
    $("#update_Commission_Amount").prop("disabled", !$(this).is(':checked'));
    $("#update_Commission_Amount").val("");
  };

  $('#broker_setup_yes').click(function(){
    $('#broker_account_code').removeAttr("disabled");
  });

  $('#broker_setup_no').click(function(){
    alert('Please send Broker Set-up Request to Vendor Maintenance Team');
    $('#broker_account_code').attr("disabled", "disabled");
    $("#broker_account_code").val("");
  });

  $("#rejected_cancel").hide();

  currencies = [ 'AED','AFN','ALL','AMD','ANG','AOA','ARS','AUD','AWG','AZN','BAM','BBD','BDT','BGN','BHD','BIF','BMD','BND','BOB','BOV','BRL','BSD','BTN','BWP','BYN','BZD','CAD','CDF','CHE','CHF','CHW','CLF','CLP','CNY','COP','COU','CRC','CUC','CUP','CVE','CZK','DJF','DKK','DOP','DZD','EGP','ERN','ETB','EUR','FJD','FKP','GBP','GEL','GHS','GIP','GMD','GNF','GTQ','GYD','HKD','HNL','HRK','HTG','HUF','IDR','ILS','INR','IQD','IRR','ISK','JMD','JOD','JPY','KES','KGS','KHR','KMF','KPW','KRW','KWD','KYD','KZT','LAK','LBP','LKR','LRD','LSL','LYD','MAD','MDL','MGA','MKD','MMK','MNT','MOP','MRU','MUR','MVR','MWK','MXN','MXV','MYR','MZN','NAD','NGN','NIO','NOK','NPR','NZD','OMR','PAB','PEN','PGK','PHP','PKR','PLN','PYG','QAR','RON','RSD','RUB','RWF','SAR','SBD','SCR','SDG','SEK','SGD','SHP','SLL','SOS','SRD','SSP','STN','SVC','SYP','SZL','THB','TJS','TMT','TND','TOP','TRY','TTD','TWD','TZS','UAH','UGX','USD','USN','UYI','UYU','UZS','VEF','VND','VUV','WST','XAF','XCD','XDR','XOF','XPF','XSU','XUA','YER','ZAR','ZMW','ZWL'
  ];

  $("#update_Payment_Currency").autocomplete({
    source: currencies,
     messages: {
        noResults: '',
        results: function() {}
    }
  });

  //conflict with tab 4? test please.
    // if($('#invoice').is(":visible")){
    //   if(no_rejected_selected()){
    //     $('#RejectReasons').addClass("invalid");
    //     errors.push(', Please select atleast 1 Reject Reason');
    //     hasmissing = true;
    //   }
    // } 

  $("#saveDB").click(function(event){
   
    var errors = [];
    var hasmissing = false;

    var form_data = $("#submitForm").serializeArray();
    formFields = {};
    $(form_data).each(function(i, field){
      //console.log(field.name);
      formFields[field.name] = field.value;
    });

    $.each(required, function(index, value) {
      if(formFields[value] == '') {
        hasmissing = true;
        $("#"+value).addClass("invalid");
      } else {
        $("#"+value).removeClass("invalid");
      }
    });

    if($.inArray(formFields['update_Payment_Currency'], required) == 1){
      if($.inArray(formFields['update_Payment_Currency'], currencies) == -1){
        $("#update_Payment_Currency").addClass("invalid");
        errors.push(', Invalid currency');
        hasmissing = true;
      } else {
        $("#update_Payment_Currency").removeClass("invalid");
      }
    }

    if($('#saleInventory').val().length === 0) {
        $('#chkresult').addClass("invalid");
       errors.push(', Please select atleast 1 Inventory Sale ID');
       hasmissing = true;
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

  //Key up activity
  $('#invoice_amount_total, #update_Commission_Amount').keyup(function(event) {
    //no arrow keys
    if(event.which >= 37 && event.which <= 40) {
      event.preventDefault();
    };

    $(this).val(function(index, value) {
      value = value.replace(/,/g, '')
      return numberWithCommas(value);
    ;
    });
  });

  $('#currency_payment, #update_Payment_Currency').keyup(function() {
    $(this).val($(this).val().toUpperCase());
  });

  //Key Press Activity

  $("#invoice_amount_total, #update_Commission_Amount").on("keypress",function(e){
      switch (e.key){
        case "1":
        case "2":
        case "3":
        case "4":
        case "5":
        case "6":
        case "7":
        case "8":
        case "9":
        case "0":
        case "Backspace":
          return true;
        break;
        case ".":
          if ($(this).val().indexOf(".") == -1){
            return true;
          } else {
            return false;
          }
        break;
        default:
        return false;
      }
  });



  //Paste activity
  $("#invoice_amount_total, #update_Commission_Amount").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
      var pasteData = e.originalEvent.clipboardData.getData('text');
      var returnData = pasteData.replace(/[^0-9.]/g, "");
      e.preventDefault();
      $(this).val(returnData);
  });

  $("update_Payment_Currency").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
     var pasteData = e.originalEvent.clipboardData.getData('text');
     var returnData = pasteData.replace(/[^a-z]/gi, "");
     e.preventDefault();

     $('update_Payment_Currency').val(returnData.toUpperCase());
  });


});

</script>

<br>
<br>

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

  function convertStringToNumbersForDB($number_string){
    $number_string = str_replace(',' , '', $number_string);
    return strval(floatval($number_string));
  }

    function convertSingleQuote($number_string){
    $number_string = str_replace('\'' , '"', $number_string);
    return $number_string;
  }

  function saveRecord($conn, $statement){
    //echo "<script>console.log('$statement')</script>";

    $query = $conn->query($statement);

    $inventory_sale_id = $_POST['saleInventory'];
    $reference_Number = $_POST['Reference_Number'];

    if($query){
      echo "<script type='text/javascript'>alert('Data Added, Check Invoice Review Tab for the record.')</script>";
      saveTransaction($conn, "User updated entry on Tab 1: Invoice for reference_number: $reference_Number and inventory sale id: $inventory_sale_id.");
    } else {
      echo "<script type='text/javascript'>alert('The record is not saved, something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
      $error = $query->errorInfo();

      foreach ($error as $value) {
        echo "<script>console.log('$value')</script>";
        print("error caught:".$value);
      }
    }
  }

  function saveTransaction($conn, $description){
    $user = $_SESSION['user'];
    $Chk_Name = $_SESSION['name'];
    $Chk_Username = $_SESSION['user'];
    $Chk_Position = $_SESSION['position'];
  
    $save_db = $conn->query("INSERT INTO ".$_SESSION['auditdb']." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', '$description', getdate());");

    if (!$save_db){
      echo "<script type='text/javascript'>alert('The Data was saved but The transaction was not logged, something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }
  }

   if(isset($_POST['showright'])){
    if(isset($_POST['chkresult'])){
      displayModal();
    }
  }

  function removeSpecialcharacters1($value){
      return str_replace("'", "", $value);
  }

  function checkIfExisting($conn, $val){
    $query = $conn->prepare('select * from pricing.bca.TESTCommission_Data_1 where iscurrent = 1 and sent = 1 and InventorySaleID = ?');
    $query->execute(array($val));
    $rows = $query->fetchAll();
    return count($rows);
  }

  function getHTMLASCIIEquiv($val){
    //odly fixes things. keep blank
    return $val;
  }


   // "Invoice_Form_", $_FILES['invoice_upload'], 'invoice_upload', $inventory_sale_id_string, $_POST['Reference_Number'], $_POST['invoice_number'], $months_string, $conn, $today

                                
  function attach_file_to_record($string_type,  $file_array, $column_name, $inventory_sale_id, $pivotal_reference, $invoice_number, $months, $conn, $today){
    

   var_dump($file_array);

    $errors= array();
    $file_name = $file_array['name'];                             // file name with extension
    $file_basename = substr($file_name, 0, strripos($file_name, '.'));              // get the base of file name for replace
    $file_size = $file_array['size'];                              // file size to control the size limit
    $file_tmp = $file_array['tmp_name'];                           // the tmp file of the uploaded file
    $file_type = $file_array['type'];                               // to control allowable file type
    $file_ext_explode = explode('.',$file_array['name']);         // to get the extension for control
    $file_ext_end = end($file_ext_explode);
    $file_ext =  strtolower($file_ext_end);                                         // to get the extension for control
    

    $newfilename = $string_type . $today . "_ISID-" . $inventory_sale_id . "_M-" . $months . "_IN-" . $invoice_number . "_RN-" . $pivotal_reference . "." . $file_ext; //
    
    $expensions = array("pdf","xlsx","xlsm","msg");
    if($file_size > 2097152){
      $errors[]='File size must be excately 2 MB';
    }

    //check if the upload is success or not
    if(empty($errors)==true){
      $File_Path = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\Deal Reports\BCUI\\' . $newfilename;
      move_uploaded_file($file_tmp,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/Deal Reports/BCUI/".$newfilename);

      //TODO: save this somewhere?
      if ($file_array['size'] > 0)
      {
        $save_db_3 = $conn->query("update ".$_SESSION['db']." set File_Path_Email_Approval = '$File_Path' where InventorySaleID in ('$inventory_sale_id')");
      
        if(!$save_db_3){
          echo"<script>alert('error in saving file details to db, please contact admin')<script>";    
        }

      }

    }else{
      echo"<script>alert('error in uploading file, please contact admin')<script>";
      print_r($errors);
    }
  }

  if(isset($_POST['saveDB'])){

    $months                       = "'".$_POST['months']."'";
    $saleInventory                = "'".$_POST['saleInventory']."'";

    $isRejected                   = $_POST['isRejected'];
    $is_commissionable            = 0;

    $review_by                    = "'".$_POST['review_by']."'";
    $gettoday                     = "'".$_POST['gettoday']."'";
    $date_received                = "'".$_POST['date_received']."'";
    $invoice_date                 = "'".$_POST['invoice_date']."'";

    $update_currency              = "NULL";
    $update_Commission_Amount     = "NULL";
    $invoice_number               = "NULL";
    $invoice_amount_total         = "NULL";
    $broker_account_code          = "NULL";
    $icp_code                     = "NULL";
    //$journal_voucher_number       = "NULL";
    //$postedAmount                 = "NULL";
    $remarks                      = "NULL";

    $isNo_InvoiceCopy             = "NULL";
    $isIncorrect_No_LegalEntity   = "NULL";
    $isIncorrect_No_LegalAddress  = "NULL";
    $isIncorrect_Amount           = "NULL";
    $isIncorrect_Currency         = "NULL";
    $isDuplicate_Invoice          = "NULL";
    $isIncompleteDetails          = "NULL";
    $isClient_Cancelled           = "NULL";

    $isCommissionable             = "NULL"; 
    
    $previous_Update_By           = "NULL";
    $update_Timestamp             = "NULL";
    $update_Remarks               = "NULL";

    // -- Previous update by -- // 
    
    if(isset($_POST['previously_updated_by']) and strlen($_POST['previously_updated_by']) > 1){
      $previous_Update_By           = "'".$_POST['previously_updated_by']."'";
      $update_Timestamp             = "'".$_POST['update_timestamp']."'";
      $update_Remarks               = "'".$_POST['update_remarks']."'";
    }

    if(isset($_POST['iscommissionable'])){
      if($_POST['iscommissionable'] == 'on'){
        $is_commissionable  = 1;  
      } else {
        $is_commissionable  = 0;  
      }
    }

    if ($is_commissionable == 1){
      $isRejected = '0';
      $isCommissionable = '1';
    }

    else if ($isRejected == 1){
      //TODO: add what is clicked !
      $isRejected = '1';
      $isCommissionable = '0';

      if(isset($_POST['invoice'])){
        $isNo_InvoiceCopy             = ($_POST['invoice'] == 1 ? 1 : "NULL" );
        $test = $_POST['invoice'];
      }

      if(isset($_POST['entity'])){
         $isIncorrect_No_LegalEntity   = ($_POST['entity'] == 1 ? 1 : "NULL" );
      }

      if(isset($_POST['address'])){
         $isIncorrect_No_LegalAddress  = ($_POST['address'] == 1 ? 1 : "NULL" );
      }

      if(isset($_POST['amount'])){
         $isIncorrect_Amount           = ($_POST['amount'] == 1 ? 1 : "NULL" );
      }

      if(isset($_POST['currency'])){
        $isIncorrect_Currency         = ($_POST['currency'] == 1 ? 1 : "NULL" );
      }

      if(isset($_POST['duplicate'])){
        $isDuplicate_Invoice          = ($_POST['duplicate'] == 1 ? 1 : "NULL" );
      }

      if(isset($_POST['invalidinvoice'])){
         $isIncompleteDetails          = ($_POST['invalidinvoice'] == 1 ? 1 : "NULL" );
      }

      if(isset($_POST['clientcancelled'])){
        $isClient_Cancelled           = ($_POST['clientcancelled'] == 1 ? 1 : "NULL" );
      }

    } else {
      $update_currency_checked = false;
      $update_Commision_Amount_Checked = false;
                     
      if(isset($_POST['update_currency_checked'])){
        if($_POST['update_currency_checked'] == 'on'){
          $update_currency_checked = true;
        }
      }

      if(isset($_POST['update_ComAm_checked'])){
        if($_POST['update_ComAm_checked'] == 'on'){
          $update_Commision_Amount_Checked = true;
        }
      }

      if($update_currency_checked){
        $update_currency          = "'".$_POST['update_Payment_Currency']."'"; 
      }

      if($update_Commision_Amount_Checked){
        $update_Commission_Amount = "'".convertStringToNumbersForDB($_POST['update_Commission_Amount'])."'";
      }

      $invoice_number             = "'".$_POST['invoice_number']."'";
      $invoice_amount_total       = "'".convertStringToNumbersForDB($_POST['invoice_amount_total'])."'";
      
      if(strcmp($_POST['broker_setup'], 'yes') == 0){
        $broker_account_code = (strlen($_POST['broker_account_code']) > 0 ? "'".$_POST['broker_account_code']."'" : "NULL");  
      }

      
      $icp_code                   = "'".$_POST['icp_code']."'";
    
      // -- Invoice Posting Side -- //     
      
      //$journal_voucher_number     = "'".$_POST['journal_voucher_number']."'";
      //$postedAmount               = "'".$_POST['posted_Commission_Amount']."'";
           
      $remarks = (strlen($_POST['remarks']) > 0 ? "'".$_POST['remarks']."'" : "NULL");
      $isCommissionable = 0;

    }


    $query_String = "
      Update ".$_SESSION['db']."
      set
      Invoice_Review_By = $review_by,
      Invoice_Review_Date = $gettoday,
      Date_Received = $date_received,
      Invoice_Number = $invoice_number,
      Invoice_Received_Date = $invoice_date,
      bca_currency = $update_currency,
      bca_commission_amount = $update_Commission_Amount,
      Invoice_Total_Amount = $invoice_amount_total,
      Broker_Account_Code = $broker_account_code,
      [ICP_Code/Business_Unit] = $icp_code,
      Review_Remarks = $remarks,
      isRejected = $isRejected,

      Previous_Update_By = $previous_Update_By,
      Update_Timestamp = $update_Timestamp,
      Update_Remarks = $update_Remarks,

      isNo_InvoiceCopy= $isNo_InvoiceCopy,
      isIncorrect_No_LegalEntity= $isIncorrect_No_LegalEntity,
      isIncorrect_No_LegalAddress= $isIncorrect_No_LegalAddress,
      isIncorrect_Amount= $isIncorrect_Amount,
      isIncorrect_Currency= $isIncorrect_Currency,
      isDuplicate_Invoice= $isDuplicate_Invoice,
      isIncompleteDetails= $isIncompleteDetails,
      isClient_Cancelled= $isClient_Cancelled,
      isCommissionable = $isCommissionable

      WHERE [MTM commission Payment Month] in ($months) and InventorySaleID in ($saleInventory)";

      //print($query_String);
      saveRecord($conn, $query_String);

      

      $inventory_sale_id_string = "[";
      $inventory_sale_id_string .= $_POST['saleInventory'];
      $inventory_sale_id_string .= "]";

      $months_string = "[";
      $months_string .= $_POST['months'];
      $months_string .= "]";


    if(isset($_FILES['invoice_upload'])){
      $review_by = $_POST['review_by'];
      $gettoday = $_POST['gettoday'];
      @$date_received = $_POST['date_received'];
      @$invoice_date = $_POST['invoice_date'];
      @$Remarks = $_POST['Remarks'];
      @$currency = $_POST['update_currency'];
      @$invoice_number = $_POST['invoice_number'];
      @$broker_account_code = $_POST['broker_account_code'];
      @$icp_code = $_POST['icp_code'];
      $Reference_Number1 = $_POST['Reference_Number'];

      @$previousupdateby = $_POST['previousupdateby'];
      @$update_timestamp = $_POST['update_timestamp'];
      @$updateremarks = $_POST['updateremarks'];
      @$id = $_POST['inventorySaleIds'];
      @$months = $_POST['months'];

      @$id = removeSpecialcharacters1($id);
      @$months = removeSpecialcharacters1($months);

      date_default_timezone_set('Asia/Hong_Kong');
      $today = date("Y-m-d");

      $errors= array();
      $file_name = $_FILES['invoice_upload']['name']; // file name with extension
      $file_basename = substr($file_name, 0, strripos($file_name, '.')); //get the base of file name for replace
      $file_size =$_FILES['invoice_upload']['size']; //file size to control the size limit
      $file_tmp =$_FILES['invoice_upload']['tmp_name']; // the tmp file of the uploaded file
      $file_type=$_FILES['invoice_upload']['type']; // to control allowable file type
      //$file_ext=strtolower(end(explode('.',$_FILES['invoice_upload']['name']))); // to get the extension for control


      $file_ext_explode = explode('.',$_FILES['invoice_upload']['name']);         // to get the extension for control
      $file_ext_end = end($file_ext_explode);
      $file_ext =  strtolower($file_ext_end);     

      $newfilename = "Invoice_Form_" . $today . "_ISID-" . $id . "_M-" . $months . "_IN-" . $invoice_number . "_RN-" . $Reference_Number1 . "." . $file_ext; // renamed file

      $expensions= array("pdf","xlsx","xlsm"); // allowed extensions

            //extension checker if valid or not
            // if(in_array($file_ext,$expensions)=== false){
            //    $errors[]="extension not allowed";
            // }

            //file size checker if it reaches the limit
      if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
      }

      //check if the upload is success or not
      if(empty($errors)==true){
        $File_Path = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\Deal Reports\BCUI\\' . $newfilename;
        move_uploaded_file($file_tmp,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/Deal Reports/BCUI/".$newfilename);

      if ($_FILES['invoice_upload']['size'] > 0)
      {
        $save_db_3 = $conn->query("update ".$_SESSION['db']." set File_Path_Invoices = '$File_Path' where InventorySaleID in ('$id') and [MTM commission Payment Month] in ('$months')");
      }

      }else{
        print_r($errors);
      }

    }

    //---------------UPLOAD INVOICE END-------------------------
    //--------------------------UPLOAD Broker Form --------------------------------

    if(isset($_FILES['broker_upload'])){

      #print_r($FILES['broker_upload']);
      $review_by = $_POST['review_by'];
      $gettoday = $_POST['gettoday'];
      @$date_received = $_POST['date_received'];
      @$invoice_date = $_POST['invoice_date'];
      @$Remarks = $_POST['Remarks'];
      @$currency = $_POST['update_currency'];
      @$invoice_number = $_POST['invoice_number'];
      @$broker_account_code = $_POST['broker_account_code'];
      @$icp_code = $_POST['icp_code'];
      $Reference_Number1 = $_POST['Reference_Number'];

      @$previousupdateby = $_POST['previousupdateby'];
      @$update_timestamp = $_POST['update_timestamp'];
      @$updateremarks = $_POST['updateremarks'];
      @$id = $_POST['inventorySaleIds'];
      @$months = $_POST['months'];

      @$id = removeSpecialcharacters1($id);
      @$months = removeSpecialcharacters1($months);
      date_default_timezone_set('Asia/Hong_Kong');
      $today = date("Y-m-d");

      $errors1 = array();
      $file_name1 = $_FILES['broker_upload']['name']; // file name with extension
      $file_basename1 = substr($file_name, 0, strripos($file_name, '.')); //get the base of file name for replace
      $file_size1 =$_FILES['broker_upload']['size']; //file size to control the size limit
      $file_tmp1 =$_FILES['broker_upload']['tmp_name']; // the tmp file of the uploaded file
      $file_type1 =$_FILES['broker_upload']['type']; // to control allowable file type


      $file_ext_explode = explode('.',$_FILES['broker_upload']['name']);         // to get the extension for control
      $file_ext_end = end($file_ext_explode);
      $file_ext =  strtolower($file_ext_end);     

      //$file_ext1 =strtolower(end(explode('.',$_FILES['broker_upload']['name']))); // to get the extension for control

      $newfilename1 = "Broker_Form_" . $today . "_ISID-" . $id . "_M-" . $months . "_IN-" . $invoice_number . "_RN-" . $Reference_Number1 . "." . $file_ext; // renamed file

      $expensions1 = array("pdf","xlsx","xlsm"); // allowed extensions

      //file size checker if it reaches the limit
      if($file_size1 > 2097152){
        $errors1[]='File size must be excately 2 MB';
      }

      //check if the upload is success or not
      if(empty($errors1)==true){
        $File_Path1 = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\Deal Reports\BCUI\\' . $newfilename1;
        move_uploaded_file($file_tmp1,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/Deal Reports/BCUI/".$newfilename1);

      if ($_FILES['broker_upload']['size'] > 0)
      {
        $save_db_4 = $conn->query("update ".$_SESSION['db']." set [File_Path_Broker Registration Form/ACH] = '$File_Path' where InventorySaleID in ('$id') and [MTM commission Payment Month] in ('$months')");
      }
    }else{
      print_r($errors1);
    }
  }

      //---------------UPLOAD broker form END-------------------------

      if(isset($_FILES['invoice_upload'])){
        //for future use. 
       //attach_file_to_record("Invoice_Form_", $_FILES['invoice_upload'], 'invoice_upload', $inventory_sale_id_string, $_POST['Reference_Number'], $_POST['invoice_number'], $months_string, $conn, $today);

      }

      if(isset($_FILES['broker_upload'])){
        //for future use.
        //attach_file_to_record("Broker_Form_", $_FILES['broker_upload'], 'broker_upload', $inventory_sale_id_string, $_POST['Reference_Number'], $_POST['invoice_number'], $months_string, $conn, $today);
      }
   }

  ?>

<table class="table table table-hover set-bg" style="margin-left:450px;">
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
    <th style="width:450px">File_Path_Invoices</th>
    <th style="width:450px">File_Path_Broker Registration Form/ACH</th>

  </tr>
</thead>

<?php

function removeSpecialcharacters($value){
      return str_replace("\"", "", $value);
    }

if(isset($_POST['Find'])){
  $Reference_Number = $_POST['Reference_Number'];
  if($Reference_Number == ''){
    echo "<script type='text/javascript'>alert('Please enter a valid input!')</script>";
  }else{
    $fullQuery = "select
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
      [Payment Currency] as [Payment_Currency],
      cast(cd.[Exchange Rate from Contract to Payment Currency] as decimal(16,2)) as [Exchange Rate from Contract to Payment Currency],
      Convert(varchar,cast(cast (cd.[Commission_Amount] as decimal(16,2))as money),1) as [Commission_Amount],
      cd.[Invoice_Review_By],
      cd.[Invoice_Review_Date],
      cd.[Date_Received],
      cd.[invoice_number],
      cd.[Invoice_Received_Date],
      cd.[bca_currency],
      cd.[bca_commission_amount],
      cd.[Invoice_Total_Amount],
      Case when cd.[isCommissionable] = 1 then 'Yes' else 'No' end as [isCommissionable],
      cd.[Broker_Account_Code],
      cd.[ICP_Code/Business_Unit],
      cd.Previous_Update_By,
      cd.Update_Timestamp,
      cd.Update_Remarks,


      cd.Journal_Number,
      cd.Commision_Amount_Posted,
      cd.Review_Remarks,
      cd.File_Path_Invoices ,
      cd.[File_Path_Broker Registration Form/ACH] ,

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

       order by cd.[MTM commission Payment Month]
       ";


    $result = $conn->prepare($fullQuery);
    $result->execute(array(':Ref1' => $Reference_Number, ':Ref2' => $Reference_Number));
    $result->execute();
    $row_count =$result->rowCount();

    saveTransaction($conn, "Tab US Deals/US Brokers: Searched for PivotalReference Number: $Reference_Number");
    
    if(!$result->execute()){
      die('Error');
    }

    if($row_count == 0){
      echo '<tr><td colspan="50">No Available Data.</td></tr>';
    }else{
     
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $row_cancelled = '';
        $td_color = '';

        if (strlen($row['isCancelled']) > 0) {
          $row_cancelled = 'disabled';
          $td_color = "bgcolor=" . "'"."#ff8a80"."'";
        }

        echo '<tr '.$td_color.'>';

        echo '<td><label><input name="chkresult[]" class="required_checkboxes" type="checkbox" onclick="checkbox_clicked(this)" value="'.$row['saleid'].' ^^ '.$row['Payment_Currency'].' ^^ '.$row['Commission_Amount'].' ^^ '.$row['InventorySaleID'].' ^^ '.$row['MTM commission Payment Month'].' ^^ '.$row['Invoice_Review_By'].' ^^ '.$row['Invoice_Review_Date'].' ^^ '.$row['Review_Remarks'].'" </label></td>';

        echo '<td>'.$row['Create_Date'].'</td>';
        echo '<td>'.$row['Report_Type'].'</td>';
        echo '<td>'.$row['Reference_ID'].'</td>';

        echo '<td bgcolor="#fff59d">'.$row['Reference_Number'].'</td>';

        echo '<td>'.$row['TitanCompanyID'].'</td>';
        echo '<td>'.$row['saleid'].'</td>';
        echo '<td bgcolor="#fff59d">'.$row['InventorySaleID'].'</td>';
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

        echo '<td bgcolor="#fff59d">'.$row['CentreName'].'</td>';
        echo '<td bgcolor="#fff59d">'.$row['LegalEntity'].'</td>';
        echo '<td bgcolor="#fff59d">'.$row['Entity_Address'].'>/td>';
        echo '<td bgcolor="#fff59d">'.$row['VATCode'].'</td>';

        echo '<td>'.$row['Total Contract Value Local'].'</td>';
        echo '<td>'.$row['Commission_Amount_Local'].'</td>';
        echo '<td>'.$row['Contract Currency'].'</td>';
        echo '<td>'.$row['Payment_Currency'].'</td>';
        echo '<td>'.$row['Exchange Rate from Contract to Payment Currency'].'</td>';
        
        echo '<td bgcolor="#fff59d">'.$row['Commission_Amount'].'</td>';

        echo '<td>'.$row['Invoice_Review_By'].'</td>';
        echo '<td>'.$row['Invoice_Review_Date'].'</td>';

        echo '<td>'.$row['Date_Received'].'</td>';
        echo '<td>'.$row['invoice_number'].'</td>';
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

        echo '<td>'.$row['isRejected'].'</td>';
        echo '<td>'.$row['Rejected_Reason'].'</td>';
        echo '<td>'.$row['isCommissionable'].'</td>';
        echo '<td>'.$row['isCancelled'].'</td>';
        echo '<td>'.$row['isException'].'</td>';
        echo '<td>'.$row['Exception_Reason'].'</td>';

        echo '<td>'.$row['Encoded_by'].'</td>';
        echo '<td>'.$row['Date_of_Encode'].'</td>';
        echo '<td>'.$row['File_Path_Invoices'].'</td>';
        echo '<td>'.$row['File_Path_Broker Registration Form/ACH'].'</td>';

        echo '<tr>';
      }
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
      $save_db = $conn->query("INSERT INTO BCA.Checking_Audit_Log (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'password changed to $new_password', getdate());");

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
