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
                    <img id="tester" class="resize" src="image/Regus_logo15.png" />
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <?php
                      $user = $_GET['user'];
                    ?>
                    <li>
                      <?php echo '<a href="home_all.php?user=' . $user . '">Invoice Review</a>'; ?></li>
                      <?php if ($_SESSION['access'] == 'admin'){
                          echo '<li> <a href="home_all_update_existing.php?user=' . $user . '">Update Exception Inputs</a></li>';
                        }
                      ?>
                    <li><?php echo '<a href="home_all_2.php?user=' . $user . '">Invoice Posting</a>'; ?></li>
                    <!--li> <?php echo '<a href="home_all_3.php?user=' . $user . '">Add Entry</a>'; ?></li-->
                    <li class="active"><?php echo '<a href="home_all_4.php?user=' . $user . '">Exception Input</a>'; ?></li>
                  </ul>
                  <ul class="nav navbar-nav pull-right">
                    <?php $user = $_GET['user']; ?>
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
    <form id="submitForm" method="post">
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

<input type="text" name="chkresultFinal" id="chkresultFinal" style="text-align:center;" value="" hidden>

<div class='fixed side'>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
       <div class="col-md-6">
            <label class="col-m-2 control-label" id="kulay">Inventory Sale Id</label>
            <input type="text" class="form-control" name="inventory_sale_id" id="inventory_sale_id" style="text-align:center;" value="" disabled="">
        </div>
        <div class="col-md-6">
            <label class="col-m-2 control-label" id="kulay">Vat Code</label>
            <input type="text" class="form-control" name="vat_code" id="vat_code" style="text-align:center;" value="">
        </div>
    </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Legal Entity</label>
            <input type="text" class="form-control" name="legal_entity" id="legal_entity" style="text-align:center;" value="">
        </div>
    </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Entity Address</label>
            <input type="text" class="form-control" name="entity_address" id="entity_address" style="text-align:center;" value="">
        </div>
    </div>
    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">

            <label class="col-m-2 control-label" id="kulay">Agent Broker Contact Name </label>
            <input type="text" class="form-control" name="broker_agent_name" id="broker_agent_name" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Agent Broker Contact Email </label>
            <input type="text" class="form-control" name="broker_agent_email" id="broker_agent_email" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">

            <label class="col-m-2 control-label" id="kulay">Agent Broker Contact Country </label>
            <input type="text" class="form-control" name="broker_company_country" id="broker_company_country" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-2">

            <label class="col-m-2 control-label" id="kulay">Global</label>
            <input type="checkbox" class="form-control" name="isGlobal" autocomplete="off" id="isGlobal" style="text-align:center;" value="">

        </div>

        <div class="col-md-10">

            <label class="col-m-2 control-label" id="kulay">Agent Broker</label>
            <input type="text" class="form-control" name="broker_company_name" autocomplete="off" id="broker_company_name" style="text-align:center;" value="">
            <select class="form-control" name="broker_company_name_global" id="broker_company_name_global" style="text-align:center;" hidden>
                  <option></option>
                  <?php
                    $offices = ['Instant Offices', 'Flexi Offices (I)', 'SOS', 'Office Broker Ltd (I)', 'Matchoffice', 'CBRE_US', 'Office Network US', 'Office-Hub', 'JLL_US'];

                      foreach ($offices as $value) {
                        echo "<option value='$value'>$value</option>";
                      }

                  ?>
                </select>
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">Agent Broker Country </label>
            <input type="text" class="form-control" name="broker_agent_country" id="broker_agent_country" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">
            <label class="col-m-2 control-label" id="kulay">is MtM </label>
            <select class="form-control" name="ismtm" id="ismtm" style="text-align:center;">
                  <option></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12" id='div1' hidden>
            <table id="kulay">
                <tr>
                    <th id="kulay"> MtM Payment Month </th>
                    <th id="kulay"> Commission Amount Local </th>
                    <th id="kulay"> Commission Amount </th>
                </tr>
              <!--   <tr>
                  <td><input type='checkbox' name='m_table1' id='m_table1' value='1'>1</td>
                  <td><input id='commission_amount_local1' name='commission_amount_local1'></td>
                  <td><input id='commission_amount1' name='commission_amount1'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table2' id='m_table2' value='2'>2</td>
                  <td><input id='commission_amount_local2' name='commission_amount_local2'></td>
                  <td><input id='commission_amount2' name='commission_amount2'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table3' id='m_table3' value='3'>3</td>
                  <td><input id='commission_amount_local3' name='commission_amount_local3'></td>
                  <td><input id='commission_amount3' name='commission_amount3'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table4' id='m_table4' value='4'>4</td>
                  <td><input id='commission_amount_local4' name='commission_amount_local4'></td>
                  <td><input id='commission_amount4' name='commission_amount4'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table5' id='m_table5' value='5'>5</td>
                  <td><input id='commission_amount_local5' name='commission_amount_local5'></td>
                  <td><input id='commission_amount5' name='commission_amount5'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table6' id='m_table6' value='6'>6</td>
                  <td><input id='commission_amount_local6' name='commission_amount_local6'></td>
                  <td><input id='commission_amount6' name='commission_amount6'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table7' id='m_table7' value='7'>7</td>
                  <td><input id='commission_amount_local7' name='commission_amount_local7'></td>
                  <td><input id='commission_amount7' name='commission_amount7'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table8' id='m_table8' value='8'>8</td>
                  <td><input id='commission_amount_local8' name='commission_amount_local8'></td>
                  <td><input id='commission_amount8' name='commission_amount8'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table9' id='m_table9' value='9'>9</td>
                  <td><input id='commission_amount_local9' name='commission_amount_local9'></td>
                  <td><input id='commission_amount9' name='commission_amount9'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table10' id='m_table10' value='10'>10</td>
                  <td><input id='commission_amount_local10' name='commission_amount_local10'></td>
                  <td><input id='commission_amount10' name='commission_amount10'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table11' id='m_table11' value='11'>11</td>
                  <td><input id='commission_amount_local11' name='commission_amount_local11'></td>
                  <td><input id='commission_amount11' name='commission_amount11'></td>
                </tr>
                <tr>
                  <td><input type='checkbox' name='m_table12' id='m_table12' value='12'>12</td>
                  <td><input id='commission_amount_local12' name='commission_amount_local12'></td>
                  <td><input id='commission_amount12' name='commission_amount12'></td>
                </tr> -->


                <?php
                  $ctr = 1;
                    while ($ctr <= 12){
                      echo "<tr>";
                      echo "  <td><input type='checkbox' name='m_table$ctr' id='m_table$ctr' value='$ctr'>&nbsp$ctr</td>";
                      echo "  <td><input id='commission_amount_local$ctr' name='commission_amount_local$ctr'></td>";
                      echo "  <td><input id='commission_amount$ctr' name='commission_amount$ctr'></td>";
                      echo "</tr>";
                      $ctr += 1;
                    }
                ?>
            </table>


        </div>
        <div class="col-md-12" id='div2' hidden>
          <div class="col-md-6">
            <label class="col-m-2 control-label" id="kulay">Com Amount Local</label>
            <input type="text" class="form-control" name="commission_amount_local_single" id="commission_amount_local_single" style="text-align:center;" value="" >
          </div>
          <div class="col-md-6">
            <label class="col-m-2 control-label" id="kulay">Commission Amount</label>
            <input type="text" class="form-control" name="commission_amount_single" id="commission_amount_single" style="text-align:center;" value="">
          </div>
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">

            <label class="col-m-2 control-label" id="kulay">Currency for Payment </label>
            <input type="text" class="form-control" name="currency_payment" maxlength="3" id="currency_payment" style="text-align:center;" value="">
        </div>
    </div>

    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">

            <label class="col-m-2 control-label" id="kulay">Exchange Rate from Contract to Payment Currency </label>
            <input type="text" class="form-control" name="exchange_rate" id="exchange_rate" style="text-align:center;" value="">
        </div>
    </div>



    <div class="form-group row" style="margin-left:5px;margin-right:5px;">
        <div class="col-md-12">

            <label class="col-m-2 control-label" id="kulay">Exception Reason </label>
            <select class="form-control" name="exception_reason" id="exception_reason" style="text-align:center;">
                  <option></option>
                  <?php
                    $Reasons = ['Renewal', 'MTM', 'Not captured by deal report', 'Not captured by deal report - MTM','Source Issue', 'Expansion'
                    ,'SPACES - Additional 10%', 'Additional Commission', 'Movement', 'Overturn', 'Duplicate', 'Duplicate/Overturn'];

                      foreach ($Reasons as $value) {
                        echo "<option value='$value'>$value</option>";
                      }
                  ?>
                </select>
        </div>
        <input type="text" name="review_by_display" id="review_by_display" hidden value="<?php echo $user; ?>">
        <?php
                  date_default_timezone_set('Asia/Hong_Kong');
                  $today = date("Y-m-d H:i:s");
                ?>

            <input type="text" name="date_of_validation" id="date_of_validation" hidden value="<?php echo $today; ?> ">
            <input type="text" name="month_per_month_details" id="month_per_month_details" value="<?php echo $month_per_month_details; ?>" hidden>
    </div>

    <br>
    <br>

    <div class="modal-footer">
        <button type="submit" name="saveDB" id="saveDB" class="btn btn-primary">Save</button>
        <button type="submit" name="Cancel" id="Cancel" class="btn btn-danger">Cancel</button>
    </div>




</div>


<br>
<br>

<script>

   function checkbox_clicked(checkbox_values) {

      inventory_sale_id = checkbox_values.value.split(" ^^ ");
      $('#chkresultFinal').val(checkbox_values.value);
      $('#inventory_sale_id').val(inventory_sale_id[9]);
      $('#vat_code').val(inventory_sale_id[24]);
      $('#legal_entity').val(inventory_sale_id[22]);
      $('#entity_address').val(inventory_sale_id[23]);
      $('#month_per_month_details').val(inventory_sale_id[26]);

      $.ajax({
            url: 'check_Inventory.php?inventory_sale_id='+inventory_sale_id[9],
            success: function(data) {
               if (data == 1) {
                alert('Warning: This office is already on Tab 1 please check first!')
               }
            }
          });
  };

  $(document).ready(function() {
    function enable_column(column_number){
        document.getElementById("commission_amount_local"+column_number).disabled=false;
        document.getElementById("commission_amount"+column_number).disabled=false;
    }

    function disbale_column(column_number){
        document.getElementById("commission_amount_local"+column_number).disabled=true;
        document.getElementById("commission_amount"+column_number).disabled=true;
        document.getElementById("commission_amount_local"+column_number).value = "";
        document.getElementById("commission_amount"+column_number).value = "";
    }

    function clear_all_checks(box_number){
       $("#m_table"+box_number).prop('checked', false)
    }

    function disable_all_column(){
      var ctr = 1;
      while (ctr <= 12){
        disbale_column(ctr);
        clear_all_checks(ctr);
        ctr +=1;
      }
    }

    disable_all_column();

    $("#div1").hide();

    $('#ismtm').on('change', function() {
      if ( this.value == '1')
      {
      $("#div1").show();
      $("#div2").hide();
      }
      else
      {
       $("#div1").hide();
       $("#div2").show();
       disable_all_column()
      }
    });


    var months = [1,2,3,4,5,6,7,8,9,10,11,12];

    jQuery.each( months, function(i,val){
      document.getElementById("m_table"+val).onchange =function() {
        var checkbox_value = $(this).val()
        if(this.checked==true){
          enable_column(checkbox_value);
        } else {
          disbale_column(checkbox_value);
        }
      };

    });


  var checkBoxes = $('td .required_checkboxes');
  $("#mtmpaymentmonth").attr("disabled", true);

  checkBoxes.change(function () {
      $('#showright').prop('disabled', checkBoxes.filter(':checked').length < 1);
    });

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


  var required = ['broker_agent_name', 'broker_company_country', 'broker_agent_email', 'broker_agent_country', 'currency_payment', 'exchange_rate', 'commission_amount_local',  'commission_amount_gbp', 'commission_amount', 'exception_reason', 'ismtm', 'broker_company_name'];


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

  //Check email if valid
   function validateEmail($email){
     var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }

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
        //addtoRequired('mtmpaymentmonth');
        //$("#mtmpaymentmonth").attr("disabled", false);
        //$("#mtmpaymentmonth").val("1");
        //$("#ismtm").removeClass("invalid");

        removeFromRequired('commission_amount_local_single');
        removeFromRequired('commission_amount_single');
      } else {
        addtoRequired('commission_amount_local_single');
        addtoRequired('commission_amount_single');
       // addtoRequired('ismtm');
       // removeFromRequired('commission_amount_local_single');
       // removeFromRequired('commission_amount_single');
       // $("#mtmpaymentmonth").val("0");
       // $("#mtmpaymentmonth").attr("disabled", true);
      }
  });

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

    //need to verify why not working..
    if(formFields['ismtm'] == 1){
      var months = 1;
      var hasChecked = false;

      while (months <= 12){
        var strstr = 'm_table'+months;
        var local = 'commission_amount_local'+months;
        var amount = 'commission_amount'+months;

        if ($('#'+strstr).is(':checked')){
          hasChecked = true;
          //console.log('success');


          // if($('#'+local).val().length === 0) {
          //   addtoRequired('#'+local);
          // } else {
          //   removeFromRequired('#'+local);
          // }

          // if($('#'+amount).val().length === 0 ){
          //   addtoRequired('#'+amount);
          // } else {
          //   removeFromRequired('#'+amount);
          // }

        }
        months +=1;

      }

      if(!hasChecked){
        errors.push(', Need to select 1 from month to month payment');
        hasmissing = true;
      }
    }


    if(formFields['chkresultFinal'].length == 0){
      errors.push(', Please select a value on the Pivotal Reference Table');
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
  $('#exchange_rate ,#commission_amount_local, #commission_amount_gbp, #commission_amount, #commission_amount_local_single, #commission_amount_single').keyup(function(event) {
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

  $("#exchange_rate, #commission_amount_gbp, #commission_amount_local1, #commission_amount_local2, #commission_amount_local3, #commission_amount_local4, #commission_amount_local5, #commission_amount_local6, #commission_amount_local7, #commission_amount_local8, #commission_amount_local9, #commission_amount_local10, #commission_amount_local11, #commission_amount_local12, #commission_amount1, #commission_amount2, #commission_amount3, #commission_amount4, #commission_amount5, #commission_amount6, #commission_amount7, #commission_amount8, #commission_amount9, #commission_amount10, #commission_amount11, #commission_amount12, #commission_amount_local_single, #commission_amount_single").on("keypress",function(e){
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

  $("#exchange_rate, #commission_amount_local, #commission_amount_gbp, #commission_amount, #commission_amount_local_single, #commission_amount_single ").on('paste', function (e) {
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

  function saveRecord($conn, $statement,$pivotal_reference, $inventory_sale_id){
    //echo "<script>console.log('$statement')</script>";

    $query = $conn->query($statement);

    if($query){
      echo "<script type='text/javascript'>alert('Data Added, Check Invoice Review Tab for the record.')</script>";
      saveTransaction($conn, "User added entry on Tab 4 for reference_number: $pivotal_reference and inventory sale id: $inventory_sale_id.");
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
    $user = $_GET['user'];

    $query1 = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
    $query1->execute(array($user));
    $result1 = $query1->fetch(PDO::FETCH_LAZY, 0);

    $Chk_Name = $result1['Chk_Name'];
    $Chk_Username = $result1['Chk_Username'];
    $Chk_Position = $result1['Chk_Position'];

    $save_db = $conn->query("INSERT INTO BCA.Checking_Audit_Log (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', '$description', getdate());");

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
    $query = $conn->prepare('select * from pricing.bca.Commission_Data_1 where iscurrent = 1 and sent = 1 and InventorySaleID = ?');
    $query->execute(array($val));
    $rows = $query->fetchAll();
    return count($rows);
  }

  if(isset($_POST['saveDB'])){

    $table_value = explode(" ^^ ", $_POST['chkresultFinal']);

    $vat_code                     = (strlen($_POST['vat_code']) > 0 ? "'".$_POST['vat_code']."'" : "NULL");
    $legal_entity                 = (strlen($_POST['legal_entity']) > 0 ? "'".$_POST['legal_entity']."'" : "NULL");
    $entity_address             = (strlen($_POST['entity_address']) > 0 ? "'".removeSpecialcharacters1($_POST['entity_address'])."'" : "NULL");

    // $entity_address = "";
    //  if (strlen($_POST['entity_address'] > 0)){
    //     $entity_address = convertSingleQuote($entity_address);
    //     $entity_address = "'".$entity_address."'";
    // } else {
    //     $entity_address = "NULL";
    // }

    $broker_agent_name            = (strlen($_POST['broker_agent_name']) > 0 ? "'".$_POST['broker_agent_name']."'" : "NULL");
    $broker_agent_email           = (strlen($_POST['broker_agent_email']) > 0 ? "'".$_POST['broker_agent_email']."'" : "NULL");
    $broker_company_country       = (strlen($_POST['broker_company_country']) > 0 ? "'".$_POST['broker_company_country']."'" : "NULL");



    if(isset($_POST['isGlobal'])){
       $broker_company_name = "'".$_POST['broker_company_name_global']."'";
     } else {
       $broker_company_name = (strlen($_POST['broker_company_name']) > 0 ? "'".$_POST['broker_company_name']."'" : "NULL");
     }

    $broker_agent_country     = (strlen($_POST['broker_agent_country']) > 0 ? "'".$_POST['broker_agent_country']."'" : "NULL");
    $ismtm                    = (strlen($_POST['ismtm']) > 0 ? "'".$_POST['ismtm']."'" : "NULL");
    $currency_payment         = (strlen($_POST['currency_payment']) > 0 ? "'".$_POST['currency_payment']."'" : "NULL");
    $exchange_rate            = (strlen($_POST['exchange_rate']) > 0 ? "'".convertStringToNumbersForDB($_POST['exchange_rate'])."'" : "NULL");
    $exception_reason         = (strlen($_POST['exception_reason']) > 0 ? "'".$_POST['exception_reason']."'" : "NULL");

    $pivotal_reference        = "'".$table_value[0]."'";
    $tidan_company_ID         = "'".$table_value[1]."'";
    $company_name             = "'".$table_value[2]."'";
    $company_contact          = "'".$table_value[3]."'";
    $product_group_name       = "'".$table_value[4]."'";
    $centre_number            = "'".$table_value[5]."'";
    $centre_name              = (strlen($table_value[6]) > 0 ? "'".removeSpecialcharacters1($table_value[6])."'" : "NULL");




    // $centre_name = "";
    // if (strlen($table_value[6] > 0)){
    //   $centre_name            = $table_value[6];
    //   $centre_name            = "'".$centre_name."'";
    // } else {
    //   $centre_name            = "NULL";
    // }

    $country_name             = "'".$table_value[7]."'";
    $sale_id                  = "'".$table_value[8]."'";
    $inventory_sale_id        = "'".$table_value[9]."'";
    $inventory_name           = "'".$table_value[10]."'";
    $start_date               = "'".$table_value[11]."'";
    $end_date                 = "'".$table_value[12]."'";
    $sale_confirmed_date      = "'".$table_value[13]."'";
    $term                     = "'".$table_value[14]."'";
    $number_of_workstation    = "'".$table_value[15]."'";
    $average_price_local      = "'".$table_value[16]."'";
    $average_Price_Contract_value_GBP = "'".$table_value[17]."'";
    $total_contract_local     = "'".$table_value[18]."'";
    $total_contract_gbp       = "'".$table_value[19]."'";
    $contract_currency        = "'".$table_value[20]."'";
    $sale_type_titan          = "'".$table_value[21]."'";
    $months_active            = "'".$table_value[25]."'";

    $review_by_display        = "'".$_POST['review_by_display']."'";
    $date_of_validation       = "'".$_POST['date_of_validation']."'";
    $exception_reason         = "'".$_POST['exception_reason']."'";

    $month_per_month_details = explode (" , ", $_POST['month_per_month_details']);

    $m2mRevLocal1   = (strlen($month_per_month_details[0]) > 0 ? $month_per_month_details[0] : "NULL");
    $m2mRevLocal2   = (strlen($month_per_month_details[1]) > 0 ? $month_per_month_details[1] : "NULL");
    $m2mRevLocal3   = (strlen($month_per_month_details[2]) > 0 ? $month_per_month_details[2] : "NULL");
    $m2mRevLocal4   = (strlen($month_per_month_details[3]) > 0 ? $month_per_month_details[3] : "NULL");
    $m2mRevLocal5   = (strlen($month_per_month_details[4]) > 0 ? $month_per_month_details[4] : "NULL");
    $m2mRevLocal6   = (strlen($month_per_month_details[5]) > 0 ? $month_per_month_details[5] : "NULL");
    $m2mRevLocal7   = (strlen($month_per_month_details[6]) > 0 ? $month_per_month_details[6] : "NULL");
    $m2mRevLocal8   = (strlen($month_per_month_details[7]) > 0 ? $month_per_month_details[7] : "NULL");
    $m2mRevLocal9   = (strlen($month_per_month_details[8]) > 0 ? $month_per_month_details[8] : "NULL");
    $m2mRevLocal10  = (strlen($month_per_month_details[9]) > 0 ? $month_per_month_details[9] : "NULL");
    $m2mRevLocal11  = (strlen($month_per_month_details[10]) > 0 ? $month_per_month_details[10] : "NULL");
    $m2mRevLocal12  = (strlen($month_per_month_details[11]) > 0 ? $month_per_month_details[11] : "NULL");

    $m2mRevGBPM1    = (strlen($month_per_month_details[12]) > 0 ? $month_per_month_details[12] : "NULL");
    $m2mRevGBPM2    = (strlen($month_per_month_details[13]) > 0 ? $month_per_month_details[13] : "NULL");
    $m2mRevGBPM3    = (strlen($month_per_month_details[14]) > 0 ? $month_per_month_details[14] : "NULL");
    $m2mRevGBPM4    = (strlen($month_per_month_details[15]) > 0 ? $month_per_month_details[15] : "NULL");
    $m2mRevGBPM5    = (strlen($month_per_month_details[16]) > 0 ? $month_per_month_details[16] : "NULL");
    $m2mRevGBPM6    = (strlen($month_per_month_details[17]) > 0 ? $month_per_month_details[17] : "NULL");
    $m2mRevGBPM7    = (strlen($month_per_month_details[18]) > 0 ? $month_per_month_details[18] : "NULL");
    $m2mRevGBPM8    = (strlen($month_per_month_details[19]) > 0 ? $month_per_month_details[19] : "NULL");
    $m2mRevGBPM9    = (strlen($month_per_month_details[20]) > 0 ? $month_per_month_details[20] : "NULL");
    $m2mRevGBPM10   = (strlen($month_per_month_details[21]) > 0 ? $month_per_month_details[21] : "NULL");
    $m2mRevGBPM11   = (strlen($month_per_month_details[22]) > 0 ? $month_per_month_details[22] : "NULL");
    $m2mRevGBPM12   = (strlen($month_per_month_details[23]) > 0 ? $month_per_month_details[23] : "NULL");

    $ismtm          = (strlen($_POST['ismtm']) > 0 ? "'".$_POST['ismtm']."'" : "NULL");

    $m2mPaymentMonthArray = [];
    $months = 1;

    if ($_POST['ismtm'] == 1) {
      while ($months<= 12) {

        $indexstr = 'm_table'.$months;
        $index_Commission_local_str = 'commission_amount_local'.$months;
        $index_Commission_str = 'commission_amount'.$months;

        if (isset($_POST[$indexstr])){

          $m2mPaymentMonthArray[] = array (
                              'month' =>  $months,
                              'local' =>  (strlen($_POST[$index_Commission_local_str]) > 0 ? $_POST[$index_Commission_local_str] : 0),
                              'commission' => (strlen($_POST[$index_Commission_str]) > 0 ? $_POST[$index_Commission_str] : 0)
                              );
        }

        $months += 1;
      }
    } else {
       $m2mPaymentMonthArray[] = array (
                              'month' =>  '0',
                              'local' =>  convertStringToNumbersForDB($_POST['commission_amount_local_single']),
                              'commission' => convertStringToNumbersForDB($_POST['commission_amount_single'])
                              );
    }

    $sqlStatements = [];

    $ctr = 0;

    foreach ($m2mPaymentMonthArray as $m2mKey) {

      $month = $m2mKey['month'];
      $local_ammount = $m2mKey['local'];
      $commission_amount =  $m2mKey['commission'];

      $isFirstValue = '';

      #

      if (($ctr != 0) || (!end($m2mPaymentMonthArray))) {
        $isFirstValue = "union all select";
      }

      $ctr += 1;

      array_push($sqlStatements, $isFirstValue."
      $pivotal_reference,
      $tidan_company_ID,
      N$company_name,
      N$company_contact,
      $product_group_name,
       $centre_number,
       $centre_name,
       $country_name,
       $sale_id,
       $inventory_sale_id,
       $inventory_name,
       $start_date,
       $end_date,
       $sale_confirmed_date,
       $term,
       $number_of_workstation,
       $average_price_local,
       $average_Price_Contract_value_GBP,
       $total_contract_local,
       $total_contract_gbp,
       $contract_currency,
       $sale_type_titan,
       $legal_entity,
       N$entity_address,
       $vat_code,
       $months_active,
       N$broker_company_name,
       $broker_company_country,
       N$broker_agent_name,
       N$broker_agent_email,
       $broker_agent_country,
       $ismtm,
       $month,
       $currency_payment,
       $exchange_rate,
       $local_ammount,
       $local_ammount * ecg.ExchangeRate,
       $commission_amount,
       $exception_reason,
       1,
       1,
       1,
       $review_by_display,
       $date_of_validation,
       $m2mRevLocal1,
       $m2mRevLocal2,
       $m2mRevLocal3,
       $m2mRevLocal4,
       $m2mRevLocal5,
       $m2mRevLocal6,
       $m2mRevLocal7,
       $m2mRevLocal8,
       $m2mRevLocal9,
       $m2mRevLocal10,
       $m2mRevLocal11,
       $m2mRevLocal12,
       $m2mRevGBPM1,
       $m2mRevGBPM2,
       $m2mRevGBPM3,
       $m2mRevGBPM4,
       $m2mRevGBPM5,
       $m2mRevGBPM6,
       $m2mRevGBPM7,
       $m2mRevGBPM8,
       $m2mRevGBPM9,
       $m2mRevGBPM10,
       $m2mRevGBPM11,
       $m2mRevGBPM12,
       'Paid',
       $date_of_validation,
       egp.ExchangeRate

        from pricing.bca.Payment_Currency_Exchange ecg
        cross join pricing.bca.Payment_Currency_Exchange egp where egp.FromCurrencyCode =  $currency_payment  and egp.ToCurrencyCode = 'GBP'
        and  ecg.FromCurrencyCode = $contract_currency and ecg.ToCurrencyCode = 'GBP'
      COLLATE SQL_Latin1_General_CP850_CI_AS
    ");

    }


    $query =  "insert into BCA.Commission_Data_1 (Reference_Number,
        TitanCompanyId,
        CompanyName,
        Company_Contact,
        ProductGroupName,
        CentreNumber,
        CentreName,
        [Country of Centre],
        saleid,
        InventorySaleId,
        InventoryName,
        [Start Date],
        [End Date],
        [Sale Confirmed Date],
        [Term (Months)],
        InventorySaleWorkstations,
        Average_Monthly_Price_Local,
        Average_Monthly_Price_GBP,
        [Total Contract Value Local],
        [Total Contract Value GBP],
        [Contract Currency],
        [Sale Type],
        LegalEntity,
        Entity_Address,
        VATCode,
        MonthsActive,
        Broker_Company_name,
        Broker_Company_Country,
        Broker_Agent_Name,
        Broker_Agent_Email,
        Broker_Agent_Country,
        IsMtm,
        [MTM commission Payment Month],
        [Payment Currency],
        [Exchange Rate from Contract to Payment Currency],
        Commission_Amount_local,
        Commission_Amount_GBP,
        Commission_Amount,
        Exception_Reason,
        isCurrent,
        isException,
        [Sent],
        Encoded_by,
        Date_of_Encode,
        MonthlyRevLocalM1,
        MonthlyRevLocalM2,
        MonthlyRevLocalM3,
        MonthlyRevLocalM4,
        MonthlyRevLocalM5,
        MonthlyRevLocalM6,
        MonthlyRevLocalM7,
        MonthlyRevLocalM8,
        MonthlyRevLocalM9,
        MonthlyRevLocalM10,
        MonthlyRevLocalM11,
        MonthlyRevLocalM12,
        MonthlyRevGBPM1,
        MonthlyRevGBPM2,
        MonthlyRevGBPM3,
        MonthlyRevGBPM4,
        MonthlyRevGBPM5,
        MonthlyRevGBPM6,
        MonthlyRevGBPM7,
        MonthlyRevGBPM8,
        MonthlyRevGBPM9,
        MonthlyRevGBPM10,
        MonthlyRevGBPM11,
        MonthlyRevGBPM12,
        HasInvoiceBeenPaid,
        Create_Date,
          [Exchange Rate from GBP to Payment Currency]
        ) select";

        foreach ($sqlStatements as $value){

          $query .= $value;

        }

    //var_dump($query);
    //foreach ($sqlStatements as $value) {
      //echo "<script> console.log('$value')</script>";
     saveRecord($conn, $query, $table_value[0], $table_value[9]);
    //}


  }

  ?>



<table class="table table table-hover set-bg" style="margin-left:450px;">
  <thead class="headTable">
   <tr>
    <th style="width:160px">Select to Add </th>
    <th style="width:100px">Pivotal Reference</th>
    <th style="width:100px">Titan Company ID</th>
    <th style="width:150px">Company Name</th>
    <th style="width:150px">Company Contact</th>
    <th style="width:100px">Product Group Name</th>
    <th style="width:100px">Centre Number</th>
    <th style="width:150px">Centre Name</th>
    <th style="width:100px">Country Name</th>
    <th style="width:100px">Sale ID</th>
    <th style="width:100px">Inventory Sale ID</th>
    <th style="width:100px">Inventory Name</th>
    <th style="width:100px">Start Date</th>
    <th style="width:150px">End Date</th>
    <th style="width:150px">Sale Confirmed Date in Titan</th>
    <th style="width:100px">Term</th>
    <th style="width:100px">Number of Ws</th>
    <th style="width:100px">Is MtM</th>
    <th style="width:100px">Average Price Contract Value (Local)</th>
    <th style="width:100px">Average Price Contract Value (GBP)</th>
    <th style="width:100px">Total Contract Value (Local)</th>
    <th style="width:100px">Total Contract Value (GBP)</th>
    <th style="width:100px">Contract Currency</th>
    <th style="width:100px">Sale Type in Titan</th>
    <th style="width:150px">Legal Entity</th>
    <th style="width:200px">Entity Address</th>
    <th style="width:100px">Vat Code</th>
    <th style="width:100px">Sale Status in Titan</th>
    <th style="width:100px">Months Active</th>
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
    $Reference_Number = "'%".$Reference_Number."%'";
    $fullQuery = "SELECT
    [PivotalReference]
    ,[TitanCompanyID]
    ,[Companyname]
    ,[CompanyContact]
    ,[ProductGroupName]
    ,[Centrenumber]
    ,[Centrename]
    ,[Countryname]
    ,[Saleid]
    ,[Inventorysaleid]
    ,[Inventoryname]
    ,[Start Date]
    ,[End Date]
    ,[Sale Confirmed Date in Titan]
    ,cast( [Term] as decimal(16,2)) as [Term]
    ,[Number of Ws]
    ,[IsMtM?]
    ,cast([Average Price Contract Value (Local)] as decimal(16,2)) as [Average Price Contract Value (Local)]
    ,cast([Average Price Contract Value (GBP)] as decimal(16,2)) as [Average Price Contract Value (GBP)]
    ,cast([Total Contract Value (Local)] as decimal(16,2)) as [Total Contract Value (Local)]
    ,cast([Total Contract Value (GBP)] as decimal(16,2)) as [Total Contract Value (GBP)]
    ,[Contract Currency]
    ,[Sale Type in Titan]
    ,Legal_Entity
    ,Entity_Address
    ,VATCode
    ,[Sale Status in Titan]
    ,[MonthsActive]
    ,MonthlyRevLocalM1
    ,MonthlyRevLocalM2
    ,MonthlyRevLocalM3
    ,MonthlyRevLocalM4
    ,MonthlyRevLocalM5
    ,MonthlyRevLocalM6
    ,MonthlyRevLocalM7
    ,MonthlyRevLocalM8
    ,MonthlyRevLocalM9
    ,MonthlyRevLocalM10
    ,MonthlyRevLocalM11
    ,MonthlyRevLocalM12
    ,MonthlyRevGBPM1
    ,MonthlyRevGBPM2
    ,MonthlyRevGBPM3
    ,MonthlyRevGBPM4
    ,MonthlyRevGBPM5
    ,MonthlyRevGBPM6
    ,MonthlyRevGBPM7
    ,MonthlyRevGBPM8
    ,MonthlyRevGBPM9
    ,MonthlyRevGBPM10
    ,MonthlyRevGBPM11
    ,MonthlyRevGBPM12
    FROM [Pricing].[BCA].[All_Titan_Deals] where PivotalReference like $Reference_Number
    ";

    $result = $conn->prepare($fullQuery);
    $result->execute();
    //echo $fullQuery;
    $row_count =$result->rowCount();
    //saveTransaction($conn, "Tab 4: Searched for PivotalReference Number: $Reference_Number" );
    saveTransaction($conn, "Tab 4: Searched for reference number - '$Reference_Number'");





    //HERE
    // $query = $conn->prepare('select * from pricing.bca.Commission_Data_1 where iscurrent = 1 and sent = 1 and InventorySaleID = ?');
    // $query->execute(array($inventory_sale_id));
    // $rows = $query->fetchAll();
    // $num_rows = count($rows);

    // if ($num_rows > 0) {
    //    echo "<script type='text/javascript'>alert('Warning: This office is already on Tab 1 please check first!')</script>";
    // }


    if(!$result->execute()){
      die('Error');
    }

    if($row_count == 0){
      echo '<tr><td colspan="50">No Available Data.</td></tr>';
    }else{

      while($row = $result->fetch(PDO::FETCH_ASSOC)){


        $row_cancelled = '';
        $td_color = '';

        if(strcmp($row['Sale Status in Titan'],'Confirmed')){
          $row_cancelled = 'disabled';
          $td_color = "bgcolor=" . "'"."#ff8a80"."'";
        }

        echo '<tr '.$td_color.'>';

        echo '<td>'.'<div class="checkbox">'.'<label><input name="chkresult[]" class="required_checkboxes" type="radio" onclick="checkbox_clicked(this)" type="radio" value="'.$row['PivotalReference'].' ^^ '.$row['TitanCompanyID'].' ^^ '.removeSpecialcharacters($row['Companyname']).' ^^ '.removeSpecialcharacters($row['CompanyContact']).' ^^ '.$row['ProductGroupName'].' ^^ '.$row['Centrenumber'].' ^^ '.removeSpecialcharacters($row['Centrename']).' ^^ '.$row['Countryname'].' ^^ '.$row['Saleid'].' ^^ '.$row['Inventorysaleid'].' ^^ '.$row['Inventoryname'].' ^^ '.$row['Start Date'].' ^^ '.$row['End Date'].' ^^ '.$row['Sale Confirmed Date in Titan'].' ^^ '.$row['Term'].' ^^ '.$row['Number of Ws'].' ^^ '.$row['Average Price Contract Value (Local)'].' ^^ '.$row['Average Price Contract Value (GBP)'].' ^^ '.$row['Total Contract Value (Local)'].' ^^ '.$row['Total Contract Value (GBP)'].' ^^ '.$row['Contract Currency'].' ^^ '.$row['Sale Type in Titan'].' ^^ '.removeSpecialcharacters($row['Legal_Entity']).' ^^ '.removeSpecialcharacters($row['Entity_Address']).' ^^ '.$row['VATCode'].' ^^ '.$row['MonthsActive'].' ^^ '.$row['MonthlyRevLocalM1'].' , '.$row['MonthlyRevLocalM2'].' , '.$row['MonthlyRevLocalM3'].' , '.$row['MonthlyRevLocalM4'].' , '.$row['MonthlyRevLocalM5'].' , '.$row['MonthlyRevLocalM6'].' , '.$row['MonthlyRevLocalM7'].' , '.$row['MonthlyRevLocalM8'].' , '.$row['MonthlyRevLocalM9'].' , '.$row['MonthlyRevLocalM10'].' , '.$row['MonthlyRevLocalM11'].' , '.$row['MonthlyRevLocalM12'].' , '.$row['MonthlyRevGBPM1'].' , '.$row['MonthlyRevGBPM2'].' , '.$row['MonthlyRevGBPM3'].' , '.$row['MonthlyRevGBPM4'].' , '.$row['MonthlyRevGBPM5'].' , '.$row['MonthlyRevGBPM6'].' , '.$row['MonthlyRevGBPM7'].' , '.$row['MonthlyRevGBPM8'].' , '.$row['MonthlyRevGBPM9'].' , '.$row['MonthlyRevGBPM10'].' , '.$row['MonthlyRevGBPM11'].' , '.$row['MonthlyRevGBPM12'].'" '.$row_cancelled.'></label></div>'.'</td>';


       // echo '<td><label><input name="chkresult[]" class="required_checkboxes"  type="checkbox" value="1" </label></td>';
          echo "<td>".$row['PivotalReference']."</td>";
          echo "<td>".$row['TitanCompanyID']."</td>";
          echo "<td>".$row['Companyname']."</td>";
          echo "<td>".$row['CompanyContact']."</td>";
          echo "<td>".$row['ProductGroupName']."</td>";
          echo "<td>".$row['Centrenumber']."</td>";
          echo "<td>".$row['Centrename']."</td>";
          echo "<td>".$row['Countryname']."</td>";
          echo "<td>".$row['Saleid']."</td>";
          echo "<td>".$row['Inventorysaleid']."</td>";
          echo "<td>".$row['Inventoryname']."</td>";
          echo "<td>".$row['Start Date']."</td>";
          echo "<td>".$row['End Date']."</td>";
          echo "<td>".$row['Sale Confirmed Date in Titan']."</td>";
          echo "<td>".$row['Term']."</td>";
          echo "<td>".$row['Number of Ws']."</td>";
          echo "<td>".$row['IsMtM?']."</td>";
          echo "<td>".$row['Average Price Contract Value (Local)']."</td>";
          echo "<td>".$row['Average Price Contract Value (GBP)']."</td>";
          echo "<td>".$row['Total Contract Value (Local)']."</td>";
          echo "<td>".$row['Total Contract Value (GBP)']."</td>";
          echo "<td>".$row['Contract Currency']."</td>";
          echo "<td>".$row['Sale Type in Titan']."</td>";
          echo "<td>".$row['Legal_Entity']."</td>";
          echo "<td>".$row['Entity_Address']."</td>";
          echo "<td>".$row['VATCode']."</td>";
          echo "<td>".$row['Sale Status in Titan']."</td>";
          echo "<td>".$row['MonthsActive']."</td>";
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
