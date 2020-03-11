 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type ="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Post Invoice</h4>
        </div>
        <div class="modal-body">
			
		
							<?php 
								if(isset($_POST['openModal'])){
				          			$id = (implode( ", " , array_map('intval',$_POST['invnumresult'] )));
									
									
									
									$Invoice_Received_Date = $_POST['invreceiveddate'];
									
									$legentity = $_POST['legentity'];
									$entityadd = $_POST['entityadd'];
									$ref_num = $_POST['ref_num'];
									$compname = $_POST['compname'];
									
									$brokeracc = $_POST['brokeracc'];
									$icpcode = $_POST['icpcode'];
									
							
									
								} else {
									print("<p>No selection</p>");
								}
							?>
							
		  
			<label class="col-m-2 control-label" id="kulay">Posted By</label>
			<?php $user = $_GET['user']; ?>
			<input type="text" class="form-control" name="Posted_By"  readonly value="<?php echo $user; ?> ">
		  <br>
		  
			<label class="col-m-2 control-label" id="kulay">Invoice Posting Date</label>
			<?php 
			date_default_timezone_set('Asia/Hong_Kong');
			$today = date("Y-m-d");  
			?>
			<input type="text" class="form-control" name="Posting_Date"  readonly value="<?php echo $today; ?> ">
		   <br>
		   
		   <!--  Read Only Inputs   -->                               
		   
		  
	
		   
		   <label class="col-m-2 control-label" id="kulay">Invoice_Number</label>
			<input type="text" class="form-control" name="Invoice_Number1" readonly value ="<?php echo $id; ?>" >
		  
		  <br>
		  
		   <label class="col-m-2 control-label" id="kulay">Invoice_Received_Date</label>
			<input type="text" class="form-control" name="Invoice_Received_Date" readonly value ="<?php echo $Invoice_Received_Date; ?>">
		  
		  <br>
		 
		  
		   <label class="col-m-2 control-label" id="kulay">LegalEntity</label>
			<input type="text" class="form-control" name="LegalEntity" readonly value ="<?php echo $legentity; ?>">
		  
		  <br>
		  
		  
		   <label class="col-m-2 control-label" id="kulay">Entity_Address</label>
			<input type="text" class="form-control" name="Entity_Address" readonly value ="<?php echo $entityadd; ?>">
		  
		  <br>
		  
		  
		  
		   <label class="col-m-2 control-label" id="kulay">Reference_Number</label>
			<input type="text" class="form-control" name="Reference_Number" readonly value ="<?php echo $ref_num; ?>">
		  
		  <br>
		  
		   <label class="col-m-2 control-label" id="kulay">Company Name</label>
			<input type="text" class="form-control" name="Company_Name" readonly value ="<?php echo $compname; ?>">
		  
		  <br>
		  
		  <label class="col-m-2 control-label" id="kulay">Broker_Account_Code</label>
			<input type="text" class="form-control" name="Broker_Account_Code" readonly value ="<?php echo $brokeracc; ?>">
		  
		  <br>
		   
		   
		   <label class="col-m-2 control-label" id="kulay">ICP_Code/Business_Unit</label>
			<input type="text" class="form-control" name="ICP_Code/Business_Unit" readonly value ="<?php echo $icpcode; ?>">
		  
		  <br>
		   
		
		   
		    <!--  END of Read Only Inputs   -->   
		   
		   
		   
		    <label class="col-m-2 control-label" id="kulay">Journal/Voucher Number <font color="red"><i>*Required</i></font></label>
			<input type="text" class="form-control" name="Journal_Number" id="Journal_Number">
		  
		  <br>
		  
		  <label class="col-m-2 control-label" id="kulay">Invoice Total Amount </label>
			<input type="text" class="form-control" name="Posted_Amount" readonly value ="<?php echo array_sum($_POST['invtotal']); ?>">
			
		  <br>
		  
		  <label class="col-m-2 control-label" id="kulay">Posted Commission Amount <font color="red"><i>*Required</i></font></label>
			<input type="text" class="form-control" name="Posted_Amount" id="Posted_Amount">
		  <br>
		  
		  <label class="col-m-2 control-label" id="kulay">Remarks</label>
			<input type="text" class="form-control" name="Remarks" >
		  <br>
		  
		   
        </div>
        <div class="modal-footer">
			<button type="submit" name="saveDB" class="btn btn-primary" >Save changes</button>
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
	        	<p>Please Select Dates</p>
	        </div>
	        <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	    </div>
    </div>
</div>
 
