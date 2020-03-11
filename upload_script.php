<?php
include('database.php');

   if(isset($_FILES['invoices'])){
      $errors= array();
      $file_name = $_FILES['invoices']['name']; // file name with extension
      $file_basename = substr($file_name, 0, strripos($file_name, '.')); //get the base of file name for replace
      $file_size =$_FILES['invoices']['size']; //file size to control the size limit
      $file_tmp =$_FILES['invoices']['tmp_name']; // the tmp file of the uploaded file
      $file_type=$_FILES['invoices']['type']; // to control allowable file type
      $file_ext=strtolower(end(explode('.',$_FILES['invoices']['name']))); // to get the extension for control

      $newfilename = "Invoice Forms." . $file_ext; // renamed file

      $expensions= array("pdf","xlsx","xlsm"); // allowed extensions

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

         $reference_number = "8202200IM1";
         $inventory_sale_id = "19103185";
         $MTM_Payment_Month = "0";
         $invoice_number = "00786884";
         $uploaded_by = "sebastian.mira";
         $upload_date = "2018-03-21";
         $File_Path_W9 = '\\\\regus.local\gsc\GSC_Local\Finance\Transactional Finance Support\Global Broker Commission\Deal Reports\BCUI\\' . $newfilename;


         move_uploaded_file($file_tmp,"//regus.local/gsc/GSC_Local/Finance/Transactional Finance Support/Global Broker Commission/Deal Reports/BCUI/".$newfilename);
         echo "Success";

          $save_db = $conn->query("insert into [BCA].[UI_Upload_Data] ([Reference_Number], [Inventory_Sale_Id], [Invoice_Number], [MTM_Payment_Month], [File_Name], [File_Name_Updated], [File_Type], [File_Ext], [File_Size], [File_Path], [Uploaded_By], [Upload_Date]) values ('$reference_number', '$inventory_sale_id', '$invoice_number', '$MTM_Payment_Month', '$file_name', '$newfilename', '$file_type', '$file_ext', '$file_size', '$File_Path_W9', '$uploaded_by', '$upload_date')");

          $save_db_1 = $conn->query("update bca.testCommission_Data_1 set File_Path_W9 = '$File_Path_W9' where Invoice_Number = '$invoice_number' and InventorySaleID = '$inventory_sale_id' and [MTM commission Payment Month] = '$MTM_Payment_Month'");

          if (!$save_db){
            echo "<script type='text/javascript'>alert('something went wrong, please try again after a couple of minutes. If the issue persist, please inform the admin')</script>";
          }

      }else{
         print_r($errors);
      }
   }

?>

<html>
   <body>

      <form action="" method="POST" enctype="multipart/form-data">
         <label>Invoices</label><br>
         <input type="file" name="invoices" />
         <input type="submit"/>
      </form>

   </body>
</html>
