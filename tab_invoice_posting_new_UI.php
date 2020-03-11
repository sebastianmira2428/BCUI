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
                    <li> <?php echo '<a href="tab_invoice_review.php?user=' . $user . '">1 Invoice Review</a>'; ?></li>
                    <li class="active"> <?php echo '<a href="tab_invoice_posting.php?user=' . $user . '">2 Invoice Posting</a>'; ?></li>
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
                        <li><a href="Report_Export.xlsx">Download Report</a>
                        </li>
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
                            <label class="col-m-2 control-label">Enter Invoice Number</label>
                            <input type="text" name="invoice_number" id="invoice_number" autocomplete="off" maxlength="20" style="text-align:center;" class="form-control" autofocus value="<?php
          echo isset($_POST['invoice_number']) ? $_POST['invoice_number'] : ''?>">

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

    <!--div class="form-group row" style="margin-left:5px;margin-right:5px;">
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
    </div-->
    <!--div class="form-group row" style="margin-left:5px;margin-right:5px;">
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
    </div-->

    <!-- !!!!!REMOVE use the search one instead!-->
<!--
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Invoice Number</label>
            <input type="text" class="form-control" name="invoice_number" id="invoice_number" style="text-align:center;" value="" disabled="">
        </div>
    </div> -->




    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Invoice Amount Total</label>
            <input type="text" class="form-control" name="invoice_amount_total" id="invoice_amount_total" style="text-align:center;" value="" disabled="">
            <input type="text" name="Reference_Number" id="Reference_Number" hidden >
            <input type="text" name="months" id="months" hidden >
            <input type="text" name="saleInventory" id="saleInventory" hidden >


        </div>
    </div>

<!--     <div class="form-group row" style="margin-left:5px;margin-right:5px;">

     <div class="col-sm-4 col-sm-offset-4 text-center">

     <label class="col-m-2 control-label" id="kulay">Broker Set Up?</label>
     <div class="radio">
       <label class="col-m-2 control-label" id="kulay"><input type="radio" checked="checked" name="broker_setup" id="broker_setup_yes" value="yes" >Yes</label>
       <label class="col-m-2 control-label" id="RadioBtn"><input type="radio" name="broker_setup" id="broker_setup_no" value="No">No</label>
     </div>
   </div>
 </div>
 -->
<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-6">
    <label class="col-m-2 control-label" id="kulay">Broker Account Code</label>
    <input type="text"  class="form-control" name="broker_account_code"
    id="broker_account_code" autocomplete="off" style="text-align:center;" value="" disabled="">
  </div>

  <div class="col-md-6">
    <label class="col-m-2 control-label" id="kulay">ICP Code/Bussiness Unit</label>
    <input type="text" autocomplete="off" class="form-control" name="icp_code" id="icp_code" style="text-align:center;" value= "" disabled="">
  </div>
</div>

<!-- <input type="text" id="previously_updated_by" name="previously_updated_by" hidden>
<input type="text" id="update_timestamp" name="update_timestamp" hidden>
<input type="text" id="update_remarks" name="update_remarks" hidden> -->

<!-- <div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <label class="col-m-2 control-label" id="kulay">Updated By</label>
    <input type="text"  class="form-control" name="previously_updated_by_display"
    id="previously_updated_by_display" autocomplete="off" style="text-align:center;" value="" disabled>

  </div>
</div> -->

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-6">
    <label class="col-m-2 control-label" id="kulay">Journal/Voucher Number</label>
    <input type="text"  class="form-control" name="journal_voucher_number"
    id="journal_voucher_number" autocomplete="off" style="text-align:center;" value="">
  </div>

  <div class="col-md-6">
    <label class="col-m-2 control-label" id="kulay">Posted Amount</label>
    <input type="text" autocomplete="off" class="form-control" name="posted_Commission_Amount" id="posted_Commission_Amount" style="text-align:center;" value= "">

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

<!-- <div class="form-group row" style="margin-left:5px;margin-right:5px;">
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
</div> -->

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <label class="col-m-2 control-label" id="kulay">Location</label>
    <input type="text" autocomplete="off" class="form-control" name="location" id="location" style="text-align:center;" value= "">

  </div>
</div>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">
    <label class="col-m-2 control-label" id="kulay">Remarks</label>
    <input type="text" autocomplete="off" class="form-control" name="remarks" id="remarks" style="text-align:center;" value= "">

  </div>
</div>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">
  <div class="col-md-12">

    <label class="col-m-2 control-label" id="kulay">W9 Form <i>(e.g. .pdf, .xlsx, .xlsm, .msg)</i></label>
    <input class="form-control" id="w9link" readonly value=""> </input>
    <br>
    <input type="button" id="visible-button1" value="Copy Link" onclick='copyPasteShit("w9link")'>
    <br>
    <br>
    <input class="col-m-2 control-label"  type="file" name="w9_upload" id="w9_upload" />
    <!-- onChange="validate(this.value)-->
    <br>
  </div>
</div>

<div class="form-group row" style="margin-left:5px;margin-right:5px;">

  <div class="col-md-12">

    <label class="col-m-2 control-label" id="kulay">Broker Registration Form/ACH <i>Excel files only</i></label>
    <input class="form-control" id="broker" readonly value=""> </input>
    <br>
    <input type="button" id="visible-button" value="Copy Link" onclick='copyPasteShit("broker")'>
    <br>
    <br>
    <input class="col-m-2 control-label"  type="file" name="broker_upload" id="broker_upload" onChange="validate(this.value)" />
    <br>
  </div>
</div>


<!-- <div class="form-group row" id="RejectReasons" hidden style="margin-left:5px;margin-right:5px;">

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
</div> -->
    <br>
    <br>

    <div class="modal-footer">
      <div class="" align="left">
    <!--   <input class="col-m-2" type="checkbox" name="iscommissionable" id="iscommissionable">
      <label class="col-m-2 control-label" id="iscommissionable_label" >Is not commissionable</label><br> -->
    </div>
    <br>
    <button type="submit" name="saveDB" id="saveDB" class="btn btn-primary">Save</button>
    <!-- <button type="button" class="btn btn-danger" id="rejected" name="rejected">Reject</button> -->
    <button type="button" class="btn btn-danger" id="rejected_cancel" name="rejected_cancel">Cancel</button>
  </div>

</div>


<br>
<br>

<script>
function copyPasteShit(input){
    document.querySelector('#'+input).select();
    document.execCommand('copy');
}
</script>

<script>

   function validate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();
    var arrayExtensions = ["pdf","xlsx","xlsm","msg"];
    if (arrayExtensions.lastIndexOf(ext) == -1) {
      alert("Wrong extension type.");
      $("#invoice_upload, #broker_upload").val("");
    }
  }

  var checked_array = []
  function checkbox_clicked(checkbox_values) {

    var selected_value = checkbox_values.value.split(" ^^ ");
    var inventorysaleid_array = [];
    var reference_number_array = [];
    var month_array = [];
    var error_message = [];
    var isMultiple = false;
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
      var month = current_checked[8];
      var reference_number = current_checked[6];
      var inventory_sale_id = current_checked[9]

      if(reference_number_array.length != 0){
        if(!reference_number_array.includes(reference_number)){
        isMultiple = true;
        }
      }

      reference_number_array.push(reference_number);
      month_array.push(month);
      inventorysaleid_array.push(inventory_sale_id);

      $('#invoice_amount_total').val(current_checked[2]);
      $('#broker_account_code').val(current_checked[3]);
      $('#icp_code').val(current_checked[4]);
      $('#remarks').val(current_checked[5]);
      //console.log(current_checked[6]);
      //$('#Reference_Number').val(current_checked[6]);
      $('#location').val(current_checked[7]);

      $('#journal_voucher_number').val(current_checked[10]);
      $('#posted_Commission_Amount').val(current_checked[11]);

      $('#w9link').val(current_checked[12]);
      $('#broker').val(current_checked[13]);




    });

    if(isMultiple){
      hasWarnings = true;
      error_message.push('Multiple Reference Number detected');
    }

    if(hasWarnings){
      var warning = 'Warning: ';
      warning_mesage = error_message.join();
      warning += warning_mesage;
      alert(warning)
    }

    //console.log(reference_number_array)

    $('#months').val(month_array);
    $('#Reference_Number').val(reference_number_array);
    $('#saleInventory').val(inventorysaleid_array);

    //if there is no selected, set val to 0
    if (checked_array.length === 0){
      $('#invoice_number').val('');
      $('#invoice_amount_total').val('');
      $('#broker_account_code').val('');
      $('#icp_code').val('');
      $('#journal_voucher_number').val('');
      $('#posted_Commission_Amount').val('');
      $('#remarks').val('');
      $('#Reference_Number').val('');
      $('#location').val('');
      $('#journal_voucher_number').val('');
      $('#posted_Commission_Amount').val('');
      $('#w9link').val('');
      $('#broker').val('');
    }
  };

 $(document).ready(function() {

  var required = ['posted_Commission_Amount', 'remarks', 'journal_voucher_number' ];

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


  //add comma to a number
  function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }

  $("#saveDB").click(function(event){

    var errors = [];
    var hasmissing = false;

    var form_data = $("#submitForm").serializeArray();
    formFields = {};
    $(form_data).each(function(i, field){
      //console.log(field.name);
      formFields[field.name] = field.value;
    });

    if(formFields['Reference_Number'].length == 0){
      errors.push(', Please select a value on the Invoice Reference Table');
      hasmissing = true;
    }

    $.each(required, function(index, value) {
      if(formFields[value] == '') {
        hasmissing = true;
        $("#"+value).addClass("invalid");
      } else {
        $("#"+value).removeClass("invalid");
      }
    });

    if($.inArray(formFields['location'], countries) == -1){
      $("#location").addClass("invalid");
      errors.push(', Invalid location');
      hasmissing = true;
    } else {
      $("#location").removeClass("invalid");
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
  $('#posted_Commission_Amount').keyup(function(event) {

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

  $("#posted_Commission_Amount").on("keypress",function(e){
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
  $("#posted_Commission_Amount").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
      var pasteData = e.originalEvent.clipboardData.getData('text');
      var returnData = pasteData.replace(/[^0-9.]/g, "");
      e.preventDefault();
      $(this).val(returnData);
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

    //HERE
    $invoice_number = $_POST['invoice_number'];
    $Reference_Number = $_POST['Reference_Number'];

    if($query){
      echo "<script type='text/javascript'>alert('Data Added, Check Invoice Review Tab for the record.')</script>";
      saveTransaction($conn, "User updated entry on Tab 2: Invoice number: $invoice_number and reference number : $Reference_Number.");
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

    $months_return = explode(',' , $_POST['months']);
    $Reference_Number_return = explode(',', $_POST['Reference_Number']);
    $Reference_Number_return = array_unique($Reference_Number_return);

    $saleInventory_return = explode(',', $_POST['saleInventory']);
    $saleInventory_return = array_unique($saleInventory_return);


    $months_for_filename = '[';

    foreach ($months_return as $value) {
      $months_for_filename .= removeSpecialcharacters($value)."_";
    }

    $months_for_filename .= ']';

    $months = "'".implode("','", $months_return);
    //$months = implode("','", $months_return);
    $months .="'";

    $reference_number  ="'".implode("','", $Reference_Number_return);
    $reference_number .= "'";
    $saleInventory  ="'".implode("','", $saleInventory_return);
    $saleInventory .= "'";

    $journal_number           = $_POST['journal_voucher_number'];
    $posted_Commission_Amount = str_replace(',','',$_POST['posted_Commission_Amount']);
    $remarks                  = (isset($_POST['remarks']) ? $_POST['remarks'] : "NULL");
    $location                 = $_POST['location'];
    $invoice_number           = $_POST['invoice_number'];
    $posted_by                = $_SESSION['user'];
    $posting_date             = $today;
    //$reference_number         = $_POST['Reference_Number'];
    $remarks                  = $_POST['remarks'];


    $query_String = "
      update ".$_SESSION['db']."
        set Posting_Date = '$posting_date', Invoice_Posted_By = '$posted_by', Journal_Number = '$journal_number', Commision_Amount_Posted = '$posted_Commission_Amount', Remarks = '$remarks', location = '$location'
        where sent = 1 and iscurrent = 1 and Invoice_Number = '$invoice_number' and Reference_Number in ($reference_number)";

    //print($query_String);
    saveRecord($conn, $query_String);

    $invoice_number = $_POST['invoice_number'];
    $Reference_Number1 = $_POST['Reference_Number'];
    $id = $saleInventory;
    $id = removeSpecialcharacters1($id);

    date_default_timezone_set('Asia/Hong_Kong');
    $today = date("Y-m-d");

    //--------------------------W9 ------------------------

    if(isset($_FILES['w9_upload'])){
      $errors= array();
      $file_name = $_FILES['w9_upload']['name'];                          // file name with extension
      $file_basename = substr($file_name, 0, strripos($file_name, '.'));  //get the base of file name for replace
      $file_size =$_FILES['w9_upload']['size'];                           //file size to control the size limit
      $file_tmp =$_FILES['w9_upload']['tmp_name'];                        // the tmp file of the uploaded file
      $file_type=$_FILES['w9_upload']['type'];                            // to control allowable file type

      $file_ext_explode = explode('.',$_FILES['w9_upload']['name']);         // to get the extension for control
      $file_ext_end = end($file_ext_explode);
      $file_ext =  strtolower($file_ext_end);

      // renamed file
      $newfilename = "W9_Form_" . $today . "_ISID-" . $id . "_M-" . $months_for_filename . "_IN-" . $invoice_number . "_RN-" . $Reference_Number1 . "." . $file_ext;

      $expensions= array("pdf","xlsx","xlsm", "msg"); // allowed extensions
      //extension checker if valid or not
      if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed";
      }

      //file size checker if it reaches the limit
      if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
      }

      //check if the upload is success or not
      if(empty($errors)==true){
        $File_Path = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\Deal Reports\BCUI\\' . $newfilename;
        move_uploaded_file($file_tmp,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/Deal Reports/BCUI/".$newfilename);

      if ($_FILES['w9_upload']['size'] > 0)
      {

        $save_db_3 = $conn->query("update ".$_SESSION['db']." set File_Path_W9 = '$File_Path' where InventorySaleID in ($id) and [MTM commission Payment Month] in ($months)");
      }

      }else{
        print_r($errors);
      }

    }

    //--------------------------UPLOAD INVOICE END-------------------------
    //--------------------------UPLOAD Broker Form ------------------------

    echo "<Script>console.log('test')</Script>";
    if(isset($_FILES['broker_upload'])){
      echo "<Script>console.log('test')</Script>";
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

      $newfilename1 = "Broker_Form_" . $today . "_ISID-" . $id . "_M-" . $months_for_filename . "_IN-" . $invoice_number . "_RN-" . $Reference_Number1 . "." . $file_ext; // renamed file

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
        //print("update ".$_SESSION['db']." set [File_Path_Broker Registration Form/ACH] = '$File_Path' where InventorySaleID in ($id) and [MTM commission Payment Month] in ($months)");
        $save_db_4 = $conn->query("update ".$_SESSION['db']." set [File_Path_Broker Registration Form/ACH] = '$File_Path1' where InventorySaleID in ($id) and [MTM commission Payment Month] in ($months)");
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
    <th style="width:160px">Check the Applicable</th>
    <th style="width:150px">Invoice Number</th>
    <th style="width:100px">Invoice Date</th>
    <th style="width:100px">Date Received</th>
    <th style="width:150px">Centre Name</th>
    <th style="width:150px">LegalEntity</th>
    <th style="width:200px">Entity Address</th>
    <th style="width:150px">VAT (if applicable)</th>
    <th style="width:80px">Reference Number</th>
    <th style="width:80px">Inventory Sale ID</th>
    <th style="width:200px">Company Name</th>
    <th style="width:150px">Commission Amount</th>
    <th style="width:100px">Invoice Amount</th>
    <th style="width:150px">Broker Account Code</th>
    <th style="width:150px">ICP Code/ Business Unit</th>
    <th style="width:150px">Journal/Voucher Number</th>
    <th style="width:100px">Posted Commission Amount</th>
    <th style="width:100px">Location</th>
    <th style="width:350px">Remarks</th>
    <th style="width:350px">File_Path_w9</th>
    <th style="width:350px">File_Path_Broker_Form</th>
    <th style="width:350px">MTM Month</th>
  </tr>
</thead>

<?php

function removeSpecialcharacters($value){
      return str_replace("\"", "", $value);
    }

if(isset($_POST['Find'])){

  $invoice_number = $_POST['invoice_number'];

  if($invoice_number == ''){
    echo "<script type='text/javascript'>alert('Please enter a valid input!')</script>";
  }else{

    $result = $conn->prepare("select

          [Invoice_Number],
          [Invoice_Received_Date],
          [Date_Received],
          [LegalEntity],
          [Entity_Address],
          [VATCode],
          [Reference_Number],
          [InventorySaleID],
          [CompanyName],
          case when BCA_Commission_Amount is null or BCA_Commission_Amount = '' then Convert(varchar,cast(cast ([Commission_Amount] as decimal(16,2))as money),1) else Convert(varchar,cast(cast (BCA_Commission_Amount as decimal(16,2))as money),1) end as Commission_Amount,
          Convert(varchar,cast(cast ([Invoice_Total_Amount] as decimal(16,2))as money),1) as [Invoice_Total_Amount],
          [Broker_Account_Code],
          [ICP_Code/Business_Unit],
          [Journal_Number],
          [Commision_Amount_Posted],
          [CentreName],
          [Remarks],
          [File_Path_W9],
          [MTM commission Payment Month],
          [File_Path_Broker Registration Form/ACH],
          [Location]

          from ".$_SESSION['db']."
          where sent = 1 and iscurrent = 1 and [Invoice_Number] = ?");

        $result->execute(array($invoice_number));
        $result->execute();
        $row_count =$result->rowCount();

    //print($fullQuery);

    saveTransaction($conn, "Invoice posting: Searched for Invoice Number: $invoice_number, getdate());");

    if(!$result->execute()){
      die('Error');
    }

    if($row_count == 0){
      echo '<tr><td colspan="50">No Available Data.</td></tr>';
    }else{
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
          echo '<td>'.'<div class="checkbox">'.'<label><input name="chkValues[]" class="required_checkboxes"  type="checkbox" onclick="checkbox_clicked(this)" value="'.$row['Invoice_Received_Date'].' ^^ '.$row['Date_Received'].' ^^ '.$row['Invoice_Total_Amount'].' ^^ '.$row['Broker_Account_Code'].' ^^ '.$row['ICP_Code/Business_Unit'].' ^^ '.$row['Remarks'].' ^^ '.$row['Reference_Number'].' ^^ '.$row['Location'].' ^^ '.$row['MTM commission Payment Month'].' ^^ '.$row['InventorySaleID'].' ^^ '.$row['Journal_Number'].' ^^ '.$row['Commision_Amount_Posted'].' ^^ '.$row['File_Path_W9'].' ^^ '.$row['File_Path_Broker Registration Form/ACH'].'"></label>' . '</div>'.'</td>';

          echo '<td>'.$row['Invoice_Number'].'</td>';
          echo '<td>'.$row['Invoice_Received_Date'].'</td>';
          echo '<td>'.$row['Date_Received'].'</td>';
          echo '<td>'.$row['CentreName'].'</td>';
          echo '<td>'.$row['LegalEntity'].'</td>';
          echo '<td>'.$row['Entity_Address'].'</td>';
          echo '<td>'.$row['VATCode'].'</td>';
          echo '<td>'.$row['Reference_Number'].'</td>';
          echo '<td>'.$row['InventorySaleID'].'</td>';
          echo '<td>'.$row['CompanyName'].'</td>';
          echo '<td>'.$row['Commission_Amount'].'</td>';
          echo '<td>'.$row['Invoice_Total_Amount'].'</td>';
          echo '<td>'.$row['Broker_Account_Code'].'</td>';
          echo '<td>'.$row['ICP_Code/Business_Unit'].'</td>';
          echo '<td>'.$row['Journal_Number'].'</td>';
          echo '<td>'.$row['Commision_Amount_Posted'].'</td>';
          echo '<td>'.$row['Location'].'</td>';
          echo '<td>'.$row['Remarks'].'</td>';
          echo '<td>'.$row['File_Path_W9'].'</td>';
          echo '<td>'.$row['File_Path_Broker Registration Form/ACH'].'<input type="text" name="File_Path_Broker_Form" hidden value="'.$row['File_Path_Broker Registration Form/ACH'].'"></td>';
          echo '<td>'.$row['MTM commission Payment Month'].'<input type="text" name="MTM_month" hidden value="'.$row['MTM commission Payment Month'].'"></td>';
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
