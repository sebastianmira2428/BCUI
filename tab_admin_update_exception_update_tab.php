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

    <!-- icons -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

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
              <li > <?php echo '<a href="tab_invoice_posting.php?user=' . $user . '">2 Invoice Posting</a>'; ?></li>
              <!--li> <?php echo '<a href="home_all_3.php?user=' . $user . '">Add Entry</a>'; ?></li-->
              <li> <?php echo '<a href="tab_exception_input.php?user=' . $user . '">3 Exception Input</a>'; ?></li>
              <?php
              if ($_SESSION['access'] == 'admin'){
                echo '<li class="active"> <a href="tab_admin_update_exception.php?user=' . $user . '"> Update Exception Inputs</a></li>';
              }
              ?>
              <!-- for us broker deals-->
              <!--li><?php echo '<a href="Tab_US_Deals.php?user=' . $user . '">4 US Deals/US Brokers</a>'; ?></li-->
          </ul>
         <ul class="nav navbar-nav pull-right">
          <?php $user = $_SESSION['user']; ?>
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
  <form id="submitForm" method="post">
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


<br>
<br>


<div class="modal fade" id="superModal" role="dialog" >

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b><h4 class="modal-title">Edit Data Entry</h4></b>
          <div class="modal-body">

            <?php

            if(isset($_POST['openModal'])){

              //here here
              $encoded_by                            = array();
              $date_of_encode_array                  = array();
              $pivotal_reference_array               = array();
              $titanCompanyID                        = array();
              $sale_id_array                         = array();
              $inventory_sale_id_array               = array();
              $vat_code_array                        = array();
              $legal_entity_array                    = array();
              $entity_address_array                  = array();
              $broker_agent_name_array               = array();
              $broker_agent_email_array              = array();
              $broker_agent_country_array            = array();
              $broker_company_name_array             = array();
              $broker_company_country_array          = array();
              $payment_currency_array                = array();
              $commission_amount_local_array         = array();
              $commission_amount_gbp_array           = array();
              $commission_amount_array               = array();
              $exception_reason_array                = array();
              $ismtm_array                           = array();
              $commission_payment_month_array        = array();

             //echo "<script>console.log('$id');</script>";

              foreach ($_POST['chkresult']  as $value){
                $comammount = explode (" | ", $value);
                //echo "<script>console.log('$value');</script>";

                array_push($encoded_by, $comammount[17]);
                array_push($pivotal_reference_array, $comammount[18]);
                array_push($titanCompanyID, $comammount[19]);
                array_push($sale_id_array, $comammount[20]);
                array_push($inventory_sale_id_array, $comammount[21]);
                array_push($vat_code_array, $comammount[22]);
                array_push($legal_entity_array, $comammount[23]);
                array_push($entity_address_array, $comammount[24]);

                array_push($broker_agent_name_array, $comammount[25]);
                array_push($broker_agent_email_array, $comammount[26]);
                array_push($broker_agent_country_array, $comammount[27]);

                array_push($broker_company_name_array, $comammount[28]);
                array_push($broker_company_country_array, $comammount[29]);

                array_push($payment_currency_array, $comammount[30]);
                array_push($commission_amount_local_array, $comammount[31]);
                array_push($commission_amount_gbp_array, $comammount[32]);
                array_push($commission_amount_array, $comammount[33]);
                array_push($exception_reason_array, $comammount[34]);

                array_push($ismtm_array, $comammount[35]);
                array_push($commission_payment_month_array, $comammount[36]);
                array_push($date_of_encode_array, $comammount[37]);
               }

              $encoded_by                      = end($encoded_by);
              $date_of_encode                  = end($date_of_encode_array);
              $pivotal_reference               = end($pivotal_reference_array);
              $titanCompanyID                  = end($titanCompanyID);
              $sale_id                         = end($sale_id_array);
              $inventory_sale_id               = end($inventory_sale_id_array);
              $vat_code                        = end($vat_code_array);
              $legal_entity                    = end($legal_entity_array);
              $entity_address                  = end($entity_address_array);
              $vat_code                        = end($vat_code_array);
              $broker_agent_name               = end($broker_agent_name_array);
              $broker_agent_email              = end($broker_agent_email_array);
              $broker_agent_country            = end($broker_agent_country_array);
              $broker_company_name             = end($broker_company_name_array);
              $broker_company_country          = end($broker_company_country_array);
              $payment_currency                = end($payment_currency_array);
              $commission_amount_local         = end($commission_amount_local_array);
              $commission_amount_gbp           = end($commission_amount_gbp_array);
              $commission_amount               = end($commission_amount_array);
              $exception_reason                = end($exception_reason_array);
              $ismtm                           = end($ismtm_array);
              $commission_payment_month        = end($commission_payment_month_array);

            } else {
              print("<p>No selection</p>");
            }

            ?>

            <!-- wtf is this -->
            <input type="text" name="inventorySaleIds" value="a" hidden>
            <input type="text" name="months" value="a" hidden>

            <!--First line -->
             <div class="form-group row">
              <div class="col-md-1">
              </div>
              <div class="col-md-5">
                <br>
                <label class="col-m-2 control-label" id="kulay">Encoded By</label>
                <?php $user = $_SESSION['user']; ?>
                <input type="text" class="form-control" style="text-align:center;" name="encoded_by_display" id="encoded_by_display" readonly value="<?php echo $encoded_by; ?>">
                <input type="text" hidden name="encoded_by" id="encoded_by" value="<?php print("$encoded_by"); ?>">
              </div>
              <div class="col-md-5">
                <br>
                <label class="col-m-2 control-label" id="kulay">Date of Encode</label>
                <?php $user = $_SESSION['user']; ?>
                <input type="text" class="form-control" style="text-align:center;" name="date_of_encode_display" id="date_of_encode_display" readonly value="<?php echo $date_of_encode; ?>">
                <input type="text" hidden name="date_of_encode" id="date_of_encode" value="<?php print("$date_of_encode"); ?>">
              </div>
            </div>

             <div class="form-group row">
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Pivotal Reference</label>
                <input type="text"  class="form-control" readonly name="pivotal_reference_display"
                id="pivotal_reference_display" style="text-align:center;" value = "<?php echo $pivotal_reference; ?>">
                <input type="text"  name="pivotal_reference"
                id="pivotal_reference" value = "<?php echo $pivotal_reference; ?>" hidden >
              </div>
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Titan Company ID</label>
                <input type="text"  class="form-control" readonly name="tidan_company_ID_Display"
                id="tidan_company_ID_Display" style="text-align:center;" value = "<?php echo $titanCompanyID; ?>">
                <input type="text"  name="tidan_company_ID"
                id="tidan_company_ID" value = "<?php echo $titanCompanyID; ?>" hidden >
              </div>
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Sale ID</label>
                <input type="text"  class="form-control" readonly name="sale_id_display"
                id="sale_id_display" style="text-align:center;" value = "<?php echo $sale_id; ?>">
                <input type="text" name="sale_id"
                id="sale_id" value = "<?php echo $sale_id; ?>" hidden >
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-1">
              </div>
               <div class="col-md-5">
                <br>
                <label class="col-m-2 control-label" id="kulay">Inventory Sale ID</label>
                <input type="text"  class="form-control" readonly name="inventory_sale_id_display"
                id="inventory_sale_id_display" style="text-align:center;" value = "<?php echo $inventory_sale_id; ?>">
                <input type="text" name="inventory_sale_id"
                id="inventory_sale_id" value = "<?php echo $inventory_sale_id; ?>" hidden >
              </div>
              <div class="col-md-5">
                <br>
                <label class="col-m-2 control-label" id="kulay">Vat Code</label>
                <input type="text"  class="form-control" name="vat_code"
                id="vat_code" style="text-align:center;" value = "<?php echo $vat_code; ?>">
              </div>

            </div>

            <div class="form-group row">
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Legal Entity</label>
                <input type="text"  class="form-control" name="legal_entity"
                id="legal_entity" style="text-align:center;" value = "<?php echo $legal_entity; ?>">
              </div>
              <div class="col-md-8">
                <br>
                <label class="col-m-2 control-label" id="kulay">Entity Address</label>
                <input type="text"  class="form-control" name="entity_address"
                id="entity_address" style="text-align:center;" value = "<?php echo $entity_address; ?>">
              </div>
            </div>

            <!--Second line -->
           <div class="form-group row">
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Agent Broker Contact Name </label>
                <input type="text"  class="form-control" name="broker_agent_name"
                id="broker_agent_name" style="text-align:center;" value = "<?php echo $broker_agent_name; ?>">
              </div>
                <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Agent Broker Contact Email </label>
                <input type="text"  class="form-control" name="broker_agent_email" id="broker_agent_email" style="text-align:center;" value = "<?php echo $broker_agent_email; ?>">
              </div>
               <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Agent Broker Contact Country </label>
                <input type="text"  class="form-control" name="broker_agent_country"
                id="broker_agent_country" style="text-align:center;" value = "<?php echo $broker_agent_country; ?>">
              </div>
            </div>

            <div class="form-group row">
              <div class = "col-md-1">
              </div>
              <div class = "col-md-1">

                 <?php
                  $checked = '';

                  if(strlen($broker_company_name) > 0){
                    $array_global_broker = array('Instant Offices', 'Flexi Offices (I)', 'SOS', 'Office Broker Ltd (I)', 'Matchoffice', 'CBRE_US', 'Office Network US', 'Office-Hub', 'JLL US');

                    if (in_array("$broker_company_name", $array_global_broker)){
                      $checked = 'checked';
                    }
                  }
                ?>

              <br>
                <label class="col-m-2 control-label" id="kulay" >Global</label>
                <input type="checkbox"  class="form-control" name="isGlobal" autocomplete="off"
                id="isGlobal" style="text-align:center;" <?php echo $checked ?> >
              </div>

              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay" >Agent Broker </label>
                <input type="text"  class="form-control" name="broker_company_name" autocomplete="off"
                id="broker_company_name" style="text-align:center;" value = "<?php echo $broker_company_name ?>">

                <select class="form-control" name="broker_company_name_global" id="broker_company_name_global" style="text-align:center;" hidden>
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

               <div class="col-md-5">
                <br>
                  <label class="col-m-2 control-label" id="kulay">Agent Broker Country </label>
                  <input type="text"  class="form-control" name="broker_company_country"
                  id="broker_company_country" style="text-align:center;" value = "<?php echo $broker_company_country ?>">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-1">
              </div>

              <div class="col-md-5">
                <br>
                <label class="col-m-2 control-label" id="kulay">is Month to Month </label>
                <select class="form-control" name="ismtm"
                    id="ismtm" style="text-align:center;">

                  <?php
                    $isMtmSelected = '';
                    $is_mtm_disabled = '';

                    if($ismtm=='Yes'){
                      echo "<option selected value='1'>Yes</option>";
                      echo "<option value='0'>No</option>";

                    } else {
                      echo "<option value='1'>Yes</option>";
                      echo "<option selected value='0'>No</option>";
                      $is_mtm_disabled = 'disabled';
                    }
                  ?>

                </select>
              </div>
              <div class="col-md-5">
                <br>
                <label class="col-m-2 control-label" id="kulay">Month to Month Payment Month </label>
                <select class="form-control" name="mtmpaymentmonth"
                  id="mtmpaymentmonth" <?php print($is_mtm_disabled) ?> style="text-align:center;">

                  <?php

                    $month_array = [0,1,2,3,4,5,6,7,8,9,10,11,12];
                    $isMonthSelected = '';

                    foreach ($month_array as $month ) {
                      if($commission_payment_month == $month){
                         $isMonthSelected = 'selected' ;
                      } else {
                        $isMonthSelected = '' ;
                      }
                      echo "<option ".$isMonthSelected." value='$month'>$month</option>";
                    }

                  ?>
              </select>
              </div>
            </div>


            <div class="form-group row">
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Currency for Payment </label>
                <input type="text"  class="form-control" name="currency_payment" id="currency_payment" style="text-align:center;" value = "<?php echo $payment_currency ?>">
              </div>
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Commission Amount Local </label>
                <input type="text"  class="form-control" name="commission_amount_local" id="commission_amount_local" style="text-align:center;" value = "<?php echo $commission_amount_local ?>">
              </div>
              <div class="col-md-4">
                <br>
                <label class="col-m-2 control-label" id="kulay">Commission Amount GBP </label>
                <input type="text"  class="form-control" name="commission_amount_gbp" id="commission_amount_gbp" style="text-align:center;" value = "<?php echo $commission_amount_gbp ?>">
              </div>
            </div>

             <div class="form-group row">
              <div class="col-md-6">
                <br>
                <label class="col-m-2 control-label" id="kulay">Commission Amount </label>
                <input type="text"  class="form-control" name="commission_amount" id="commission_amount" style="text-align:center;" value = "<?php  echo $commission_amount ?>">
              </div>
              <div class="col-md-6">
                <br>
                <label class="col-m-2 control-label" id="kulay">Exception Reason </label>
                <select class="form-control" name="exception_reason"
                  id="exception_reason" style="text-align:center;">

                  <?php

                    $reason_array = ["Renewal", "MTM", "Not captured by deal report", "Not captured by deal report - MTM",
                                    "Source Issue", "Expansion", "Client Moved", "SPACES - Additional 10%", "Additional Commission",
                                    "Movement", "Overturn", "Duplicate", "Duplicate/Overturn"
                                    ];

                    foreach ($reason_array as $reason) {
                      $isSelected = '';

                      if(!strcmp($reason, $exception_reason)){
                        $isSelected = 'Selected';
                      }

                      echo "<option $isSelected value='$reason'>$reason</option>";
                    }

                  ?>
              </select>
              </div>

            </div>

            <div class="form-group row">

              <input type="text" name="super_review_by_display" id="super_review_by_display"  hidden value="<?php echo $user; ?>">
                <?php
                  date_default_timezone_set('Asia/Hong_Kong');
                  $today = date("Y-m-d H:i:s");
                ?>

             <input type="text" name="date_of_validation" id="date_of_validation" hidden value="<?php echo $today; ?> ">
             <input type="text"  name="month_per_month_details"
                id="month_per_month_details" value = "<?php echo $month_per_month_details; ?>" hidden >
            </div>

            <br>
            <br>

          <div class="modal-footer">
              <button type="submit" name="saveDB" id="saveDB" class="btn btn-primary" >Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

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

  var checkBoxes = $('td .required_checkboxes');
  //$("#mtmpaymentmonth").attr("disabled", true);

   $('#broker_company_name_global').hide();

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

  currencies = [ 'AED','AFN','ALL','AMD','ANG','AOA','ARS','AUD','AWG','AZN','BAM','BBD','BDT','BGN','BHD','BIF','BMD','BND','BOB','BOV','BRL','BSD','BTN','BWP','BYN','BZD','CAD','CDF','CHE','CHF','CHW','CLF','CLP','CNY','COP','COU','CRC','CUC','CUP','CVE','CZK','DJF','DKK','DOP','DZD','EGP','ERN','ETB','EUR','FJD','FKP','GBP','GEL','GHS','GIP','GMD','GNF','GTQ','GYD','HKD','HNL','HRK','HTG','HUF','IDR','ILS','INR','IQD','IRR','ISK','JMD','JOD','JPY','KES','KGS','KHR','KMF','KPW','KRW','KWD','KYD','KZT','LAK','LBP','LKR','LRD','LSL','LYD','MAD','MDL','MGA','MKD','MMK','MNT','MOP','MRU','MUR','MVR','MWK','MXN','MXV','MYR','MZN','NAD','NGN','NIO','NOK','NPR','NZD','OMR','PAB','PEN','PGK','PHP','PKR','PLN','PYG','QAR','RON','RSD','RUB','RWF','SAR','SBD','SCR','SDG','SEK','SGD','SHP','SLL','SOS','SRD','SSP','STN','SVC','SYP','SZL','THB','TJS','TMT','TND','TOP','TRY','TTD','TWD','TZS','UAH','UGX','USD','USN','UYI','UYU','UZS','VEF','VND','VUV','WST','XAF','XCD','XDR','XOF','XPF','XSU','XUA','YER','ZAR','ZMW','ZWL'
  ];

  var required = ['broker_agent_name', 'broker_agent_email', 'broker_agent_country', 'broker_company_country', 'currency_payment', 'exchange_rate', 'commission_amount_local',  'commission_amount_gbp', 'commission_amount', 'exception_reason', 'ismtm', 'broker_company_name'];


  $("#broker_company_country").autocomplete({
    source: countries,
     messages: {
        noResults: '',
        results: function() {}
    }
  });


  $("#broker_agent_country").autocomplete({
    source: countries,
     messages: {
        noResults: '',
        results: function() {}
    }
  });

  $("#currency_payment").autocomplete({
    source: currencies,
     messages: {
        noResults: '',
        results: function() {}
    }
  });

  function removeFromRequired(fieldname){
      required = jQuery.grep(required, function(value){
        return value != fieldname;
      });
      $('#'+fieldname).removeClass("invalid");

      if(fieldname!='broker_company_name'){
        $('#'+fieldname).val('');
      }
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

  //Check email if valid
   function validateEmail($email){
     var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }

  checkBoxes.change(function () {
      $('#openModal, #deleteColumn').prop('disabled', checkBoxes.filter(':checked').length < 1);
    });

    $('#deleteColumn').click(function(event){
      var result = window.confirm('Are you sure you want to delete the selected data?');
      if(result){
        return true;
      } else {
        event.preventDefault();
      }
    });

  $('#isGlobal').change(function(){
      if(this.checked){
        $('#broker_company_name').fadeOut('fast');
        $('#broker_company_name_global').fadeIn('fast');
        addtoRequired('broker_company_name_global');
        removeFromRequired('broker_company_name');
      } else {
        $('#broker_company_name').fadeIn('fast');
        $('#broker_company_name_global').fadeOut('fast');
        addtoRequired('broker_company_name');
        removeFromRequired('broker_company_name_global');
      }
    });

  $("#ismtm").change(function(){
      var valueSelected = $(this).val();
      if (valueSelected == '1') {
        addtoRequired('mtmpaymentmonth');
        $("#mtmpaymentmonth").attr("disabled", false);
        $("#mtmpaymentmonth").val("1");
        $("#ismtm").removeClass("invalid");
      } else {
        addtoRequired('ismtm');
        removeFromRequired('mtmpaymentmonth');
        $("#mtmpaymentmonth").val("0");
        $("#mtmpaymentmonth").attr("disabled", true);
      }
  });


  $("#saveDB").click(function(event){
    var errors = [];
    var hasmissing = false;

    var form_data = $("#submitForm").serializeArray();
    formFields = {};
    $(form_data).each(function(i, field){
      formFields[field.name] = field.value;
    });

    $.each(required, function(index, value) {
     // console.log(formFields[value]);


      if(formFields[value] == '') {
        hasmissing = true;
        $("#"+value).addClass("invalid");
      } else {
        $("#"+value).removeClass("invalid");
      }
    });

    if($.inArray(formFields['broker_agent_country'], countries) == -1){
      $("#broker_agent_country").addClass("invalid");
      errors.push(', Invalid Broker Agent Country');
      hasmissing = true;
    } else {
      $("#broker_company_name_country").removeClass("invalid");
    }

    if($.inArray(formFields['broker_company_country'], countries) == -1){
      $("#broker_company_country").addClass("invalid");
      errors.push(', Invalid Broker Company Country');
      hasmissing = true;
    } else {
      $("#broker_company_name_country").removeClass("invalid");
    }

    if($.inArray(formFields['currency_payment'], currencies) == -1){
      $("#currency_payment").addClass("invalid");
      errors.push(', Invalid Currency');
      hasmissing = true;
    } else {
      $("#broker_company_name_country").removeClass("invalid");
    }

    if(formFields['broker_agent_email'].length > 0){
      if(!validateEmail(formFields['broker_agent_email'])){
        $("#broker_agent_email").addClass("invalid");
        errors.push(', Invalid Email format');
        hasmissing = true;
      } else {
        $("#broker_agent_email").removeClass("invalid");
      }
    } else {
      $("#broker_company_country").addClass("invalid");
    }

    if(formFields['ismtm'] == 1){
      if(formFields['mtmpaymentmonth'] < 1) {
        $("#mtmpaymentmonth").addClass("invalid");
        errors.push(', Month to Month Payment Month minimum value is 1');
        hasmissing = true;
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

  //Key up activity

  $('#exchange_rate ,#commission_amount_local, #commission_amount_gbp, #commission_amount').keyup(function(event) {
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

  $('#currency_payment').keyup(function() {
    $(this).val($(this).val().toUpperCase());
  });

  //Key Press Activity

  $("#exchange_rate, #commission_amount_local, #commission_amount_gbp, #commission_amount").on("keypress",function(e){
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

  $("#vat, #entity_name, #Entity_Address, #legal_entity, #broker_agent_email").keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z0-9!@#$%^&*()`~_\\-\\+={}\\[\\]:<>,.\/?\\\\ ]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      } else {
        return false;
      }
  });

  $("#broker_agent_name, #broker_company_country, #broker_agent_name, #broker_agent_country, #currency_payment").keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z0-9!@#$%^&*()`~_\\-\\+={}\\[\\]:<>,.\/?\\\\ ]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      } else {
        return false;
      }
  });

  $('#currency_payment').keypress(function (e) {
     var regex = new RegExp("^[a-zA-Z]+$");
     var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
     if (regex.test(str)) {
      return true;
    }
    else{
      return false;
    }
  });

  //Paste activity

  $("#exchange_rate, #commission_amount_local, #commission_amount_gbp, #commission_amount ").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
      var pasteData = e.originalEvent.clipboardData.getData('text');
      var returnData = pasteData.replace(/[^0-9.]/g, "");
      e.preventDefault();
      $(this).val(returnData);
  });

  $("#currency_payment").on('paste', function (e) {
      alert("copy paste detected, check if the values are correct");
     var pasteData = e.originalEvent.clipboardData.getData('text');
     var returnData = pasteData.replace(/[^a-z]/gi, "");
     e.preventDefault();

     $('#currency_payment').val(returnData.toUpperCase());
  });


});

</script>

<button type="submit" class="btn btn-info btn-lg" id="openModal" disabled name="openModal">Update Record</button data-target="#myModal">
<button type="submit" class="btn btn-info btn-lg" id="deleteColumn" disabled name="deleteColumn">Delete Record</button>

  <br>
  <br>

<?php
  function saveTransaction($conn, $description, $auditDb){
    $user = $_SESSION['user'];

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

   function convertStringToNumbersForDB($number_string){
    $number_string = str_replace(',' , '', $number_string);
    return strval(floatval($number_string));
  }

    function removesinglequote($string){
    return str_replace('\'', '', $string);

  }

  function displayModal(){

    if ($_SESSION['access'] == 'admin'){
      echo "<script>
              $(function() {
                $('#superModal').modal('show');
              });
            </script>";
    } else {
       echo "<script type='text/javascript'>alert('Only admin access has the rights to delete or update data, if you believe this is an error, kindly notify system administrator')</script>";
    }
  }

  function displayErrorMessage(){
    echo "<script type='text/javascript'>alert('The record you have selected is already edited by another user. Please note that you can only update new records or records that you have already edited.')</script>";
  }

  function getHTMLASCIIEquiv($val){
    //odly fixes things. keep blank
    return $val;
  }

  function delete_record($conn){

    $encoded_by = '';
    $date_of_encode = '';

    foreach ($_POST['chkresult']  as $value){
        $comammount = explode (" | ", $value);
        $encoded_by = $comammount[17];
        $date_of_encode = $comammount[37];
    }


    $statement = "Delete from ".$_SESSION['db']." where Encoded_by = '$encoded_by'
     and [Date_of_Encode] = '$date_of_encode'";

    $query = $conn->query($statement);
    $query->execute();

    if($query){
      echo "<script type='text/javascript'>alert('selected data deleted')</script>";
      saveTransaction($conn, "Deleted entry with  $encoded_by on $date_of_encode", $_SESSION['auditdb']);
    } else {
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }

  }

  function update_by_superAccess($conn){

    $vat_code                   = (strlen($_POST['vat_code']) > 0 ? "'".$_POST['vat_code']."'" : "NULL");
    $legal_entity               = (strlen($_POST['legal_entity']) > 0 ? "'".$_POST['legal_entity']."'" : "NULL");
    $entity_address             = (strlen($_POST['entity_address']) > 0 ? "'".$_POST['entity_address']."'" : "NULL");
    $broker_agent_name          = $_POST['broker_agent_name'];
    $broker_agent_email         = $_POST['broker_agent_email'];
    $broker_agent_country       = $_POST['broker_agent_country'];

    if(isset($_POST['isGlobal'])){
      $broker_company_name      = $_POST['broker_company_name_global'];
    } else {
      $broker_company_name      = $_POST['broker_company_name'];
    }

    $broker_company_country     = $_POST['broker_company_country'];
    $ismtm = '';

    if(isset($_POST['ismtm'])){
      $ismtm = $_POST['ismtm'];
      if($_POST['ismtm'] != 0){
        $mtmpaymentmonth        = $_POST['mtmpaymentmonth'];
      } else {

        $mtmpaymentmonth = "0";
      }

    } else {
      $ismtm = "0";
      $mtmpaymentmonth              = "0";
    }

    $currency_payment           = $_POST['currency_payment'];
    $commission_amount_local    = convertStringToNumbersForDB($_POST['commission_amount_local']);
    $commission_amount_gbp      = convertStringToNumbersForDB($_POST['commission_amount_gbp']);
    $commission_amount          = convertStringToNumbersForDB($_POST['commission_amount']);
    $exception_reason           = $_POST['exception_reason'];
    $encoded_by                 = $_POST['encoded_by'];
    $date_of_encode             = $_POST['date_of_encode'];

    $statement =  "update ".$_SESSION['db']."
     set VATCode = $vat_code,
     LegalEntity = $legal_entity,
     Entity_Address = $entity_address,
     Broker_Agent_Name = '$broker_agent_name',
     Broker_Agent_Email = '$broker_agent_email',
     Broker_Agent_Country = '$broker_agent_country',
     Broker_Company_Name = '$broker_company_name',
     Broker_Company_Country = '$broker_company_country',
     IsMtm = '$ismtm',
     [MTM commission Payment Month] = '$mtmpaymentmonth',
     [Payment Currency] = '$currency_payment',
     Commission_Amount_Local = '$commission_amount_local',
     Commission_Amount_GBP = '$commission_amount_gbp',
     Commission_Amount = '$commission_amount',
     Exception_Reason = '$exception_reason'
     where Encoded_by = '$encoded_by'
     and [Date_of_Encode] = '$date_of_encode'";

    $query = $conn->query($statement);
    $query->execute();

    if($query){
      echo "<script type='text/javascript'>alert('data updated')</script>";
      $vat_code_record = removesinglequote($vat_code);
      $legal_entity_record = removesinglequote($legal_entity);
      $entity_address = removesinglequote($entity_address);

      saveTransaction($conn, "Update Exeption input on user $encoded_by on $date_of_encode with values vat code :$vat_code_record, legal entity :$legal_entity_record, legal entity: $legal_entity_record,  broker company: $broker_company_name, broker company country: $broker_company_country, is m2m: $ismtm, is m2m payment month: $mtmpaymentmonth, currency payment: $currency_payment, commission amount local: $commission_amount_local, commission amount: $commission_amount, exception reason : $exception_reason, by".$_SESSION['user'], $_SESSION['auditdb']);
    } else {
      echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
    }

  }

  if(isset($_POST['saveDB'])){
    update_by_superAccess($conn);
  }

  if(isset($_POST['deleteColumn'])){
    delete_record($conn);
  }

  if(isset($_POST['openModal'])){
    if(isset($_POST['chkresult'])){

      displayModal();
    }
 }

?>

<table class="table table table-hover set-bg">
  <thead class="headTable">
   <tr>

    <?php

      if ($_SESSION['access'] == 'admin'){
         echo "<td style='width:160px'>Check one to update/delete <br>";
      } else {
        echo "<td style='width:160px'>Check the Applicable <br><input class='required_checkboxes' type='checkbox' id='select_all' /> Select all</td>";
        echo  '<th style="width:100px">Initial Sent Date</th>';
        echo  '<th style="width:100px">Report Type</th>';
        echo  '<th style="width:100px">Reference ID</th>';
      }

    ?>

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
  </tr>
</thead>
<?php
if(isset($_POST['Find'])){
  $Reference_Number = $_POST['Reference_Number'];
  if($Reference_Number == ''){
    echo "<script type='text/javascript'>alert('Please enter a valid input!')</script>";
  }else{

    $query = "select
      ddate.Create_Date,
      cd.[Reference_ID],
      cd.[Report_Type],
      cd.[Reference_Number],
      cd.[TitanCompanyID],
      cd.[saleid],
      cd.[InventorySaleID],
      cd.[Sale Confirmed Date],
      cd.[Broker_Company_Country],
      cd.[Broker_Company_Name],
      cd.[Broker_Agent_Name],
      cd.[Broker_Agent_Email],
      cd.[Broker_Agent_Country],
      cd.[CompanyName],
      cd.[Encoded_by],
      cd.[Date_of_Encode],
      cd.[Company_Contact],
      cd.[ProductGroupName],
      Case when cd.[IsMtm] = 1 then 'Yes' else 'No' end as [IsMtm],

      Case when cd.[isException] = 1 then 'Yes' else 'No' end as [isException],
      cd.[MTM commission Payment Month] ,
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
      Convert(varchar,cast(cast ([Commission_Amount_GBP] as decimal(16,2))as money),1) as [Commission_Amount_GBP],
      [Contract Currency],
      [Payment Currency],
      cast(cd.[Exchange Rate from Contract to Payment Currency] as decimal(16,2)) as [Exchange Rate from Contract to Payment Currency],
      cast(cd.[Exchange Rate from GBP to Payment Currency] as decimal(16,2)) as [Exchange Rate from GBP to Payment Currency],
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
      cd.Date_of_Encode,
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
      where iscurrent = 1 and
      isexception = 1

      --UNION

      --select distinct a.* from ".$_SESSION['db']." a
      --inner join [BCA].[Cancelled_Deals] b
      --on a.InventorySaleID=b.InventorySaleID and a.Create_Date=b.Sent_Date


    ) cd

       LEFT JOIN [BCA].[Cancelled_Deals] ca on cd.InventorySaleID=ca.InventorySaleID

       LEFT JOIN (select min(Create_Date) as Create_Date, InventorySaleID from ".$_SESSION['db']." where
       Reference_Number = :Ref1 and Reference_ID is not NULL
       group by InventorySaleID) ddate
       on cd.InventorySaleID = ddate.InventorySaleID

       where cd.[Reference_Number] = :Ref2

       order by cd.[MTM commission Payment Month]

       ";


    $result = $conn->prepare($query);
    $result->execute(array(':Ref1' => $Reference_Number, ':Ref2' => $Reference_Number));
    $result->execute();
    $row_count =$result->rowCount();

    $user = $_SESSION['user'];
    $query1 = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
    $query1->execute(array($user));
    $result1 = $query1->fetch(PDO::FETCH_LAZY, 0);

    $Chk_Name = $result1['Chk_Name'];
    $Chk_Username = $result1['Chk_Username'];
    $Chk_Position = $result1['Chk_Position'];

    $save_db = $conn->query("INSERT INTO ".$_SESSION['auditdb']." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'Super User - Update Existing: Searched for Reference Number: $Reference_Number', getdate());");

    if(!$result->execute()){
     die('Error');
   }

   if($row_count == 0){
    echo '<tr><td colspan="50">No Available Data.</td></tr>';
  }else{
    $no = 1;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){

      $row_cancelled = '';
      $td_color = "";

      if (strlen($row['isCancelled']) > 0) {
          $row_cancelled = 'disabled';
          $td_color = "bgcolor=" . "'"."#ff8a80"."'";
      }

     echo '<tr '.$td_color.'>';

     $button_type = '';


      if ($_SESSION['access'] == 'admin'){
        $button_type = 'radio' ;
      } else {
        $button_type = 'checkbox' ;
      }

     echo '<td><label><input name="chkresult[]" class="required_checkboxes"  type="'.$button_type.'" value="'.$row['Commission_Amount'].' | '.$row['InventorySaleID'].' | '.getHTMLASCIIEquiv($row['Invoice_Number']).' | '.$row['MTM commission Payment Month'].' | '.$row['Date_Received'].' | '.$row['Invoice_Review_Date'].' | '.$row['bca_currency'].' | '.$row['bca_commission_amount'].' | '.$row['Invoice_Total_Amount'].' | '.getHTMLASCIIEquiv($row['Broker_Account_Code']).' | '.getHTMLASCIIEquiv($row['ICP_Code/Business_Unit']).' | '.getHTMLASCIIEquiv($row['Review_Remarks']).' | '.$row['Invoice_Review_By'].' | '.$row['Invoice_Review_Date'].' | '.$row['Previous_Update_By'].' | '.$row['Update_Timestamp'].' | '.$row['Update_Remarks'].' | '.$row['Encoded_by'].' | '.$row['Reference_Number'].' | '.$row['TitanCompanyID'].' | '.$row['saleid'].' | '.$row['InventorySaleID'].' | '.$row['VATCode'].' | '.$row['LegalEntity'].' | '.$row['Entity_Address'].' | '.$row['Broker_Agent_Name'].' | '.$row['Broker_Agent_Email'].' | '.$row['Broker_Agent_Country'].' | '.$row['Broker_Company_Name'].' | '.$row['Broker_Company_Country'].' | '.$row['Payment Currency'].' | '.$row['Commission_Amount_Local'].' | '.$row['Commission_Amount_GBP'].' | '.$row['Commission_Amount'].' | '.$row['Exception_Reason'].' | '.$row['IsMtm'].' | '.$row['MTM commission Payment Month'].' | '.$row['Date_of_Encode'].'" '.$row_cancelled.'></label></td>';


     if ($_SESSION['access'] != 'admin'){
      echo '<td>'.$row['Create_Date'].'</td>';
      echo '<td>'.$row['Report_Type'].'</td>';
      echo '<td>'.$row['Reference_ID'].'</td>';
  }

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

     echo '<tr>';
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
      $save_db = $conn->query("INSERT INTO ".$_SESSION['auditdb']." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'password changed to $new_password', getdate());");

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
