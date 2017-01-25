                     <?php
                         $uname = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
                        echo validation_errors(); 
                        echo form_open('qlip_controller/update_deployed/'.$postedloan_data['did'].'/'.$uname);

                        $message=$this->session->flashdata('message');
                       if($message=="loan_inserted")
                       {
                        echo ('<script>setTimeout(function() { alert("Loan application successful!"); }, 1);</script>');
                       }

                     ?>

                     
<!--disable all inputs in this div-->
<form role="form">

<div class="row">
                <div class="col-lg-6">
                <?php
                if($postedloan_data['status']=="deployed"){ ?>
                <label for="exampleusername" class="fa fa-star">status</label>
                <label for="exampleusername" class="badge bg-orange">deployed</label>
                <?php } else if($postedloan_data['status']=="returned"){  ?>
                <label for="exampleusername" class="fa fa-star">status</label>
                <label for="exampleusername" class="badge bg-navy">returned</label>
                <?php } ?>
                
               </div>
               <div class="col-lg-6">
              </div>
</div>

<div class="row">
               
               <div class="col-lg-12">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:20px; color:white; text-alignment:center">ASSET DEPLOYMENT FORM, RECORD VIEW-MODE</a>
                              </header>
                          </section>
                 </div>
</div>

<div class="row">
               
               <div class="col-lg-4">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">To be Filled By User</a>
                              </header>
                              <div class="panel-body">


                                  <div class="form-group">
             <label for="inputPassword">	Organization</label>
             <input type="text" class="form-control" Value="<?php echo $postedloan_data['organisation'] ; ?>" name="organisation">
        </div>
        <div class="form-group">
            <label for="inputusername">	Country</label>
            <input type="text" class="form-control" placeholder="" name="country" value="<?php echo $postedloan_data['country'] ; ?>" >
         </div>  
    	 <div class="form-group">
            <label for="inputusername">	Region</label>
            <input type="text" class="form-control" placeholder="" name="region" value="<?php echo $postedloan_data['region'] ; ?>">
         </div>	 
		 <div class="form-group">
            <label for="inputusername">	City</label>
            <input type="text" class="form-control" placeholder="" name="city" value="<?php echo $postedloan_data['city'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername">	Location/Address</label>
            <input type="text" class="form-control" placeholder="" name="address" value="<?php echo $postedloan_data['address'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername">	Type of office</label>
            <input type="text" class="form-control" placeholder="" name="office_type" value="<?php echo $postedloan_data['office_type'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername">	Floor/Room/Seat rack No</label>
            <input type="text" class="form-control" placeholder="" name="room_no" value="<?php echo $postedloan_data['room_no'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>Employee Name</label>
            <input type="text" class="form-control" placeholder="" name="user_name" value="<?php echo $postedloan_data['employee_name'] ; ?>" required>
         </div>
		 <div class="form-group">
            <label for="inputusername">	Employee No</label>
            <input type="text" class="form-control mobile_phone" placeholder="" name="employee_no" value="<?php echo $postedloan_data['employee_no'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>	Contact No</label>
            <input type="text" class="form-control mobile_phone" placeholder="" name="contact_no" value="<?php echo $postedloan_data['contact_no'] ; ?>" required>
         </div>
		 <div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>	Department</label>
            <input type="text" class="form-control" placeholder="" name="department" value="<?php echo $postedloan_data['department'] ; ?>" required>
         </div>

         </div>
       </section>
                 </div>
                 <div class="col-lg-4">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center"></a>
                              </header>
                              <div class="panel-body">
                                  <div class="form-group">
            						<label for="inputusername"><strong style="color:red">*</strong>	Email ID</label>
            						<input type="email" class="form-control" placeholder="" name="email" value="<?php echo $postedloan_data['email'] ; ?>" required>
         					</div>
		 
		 					<div class="form-group">
            				<label for="inputusername">	Request Date</label>
            				<input type="text" class="form-control datepicker2" placeholder="" name="request_date"  value = "<?php echo $postedloan_data['request_date'] ; ?>" readonly>
         					</div>

		 					<div class="form-group">
             				<label for="inputgroup">User Approval/Signature</label>
             				<select class="form-control" name="user_approval" >
            				

            								<?php
                                                  
                                                  if(strtolower($postedloan_data['user_approval'])==strtolower("yes"))
                                                  {
                                                    echo '<option value="yes" selected>Yes</option>
            											<option value="no">No</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['user_approval'])==strtolower("no"))
                                                  {
                                                    echo '<option value="yes" >Yes</option>
            										<option value="no" selected>No</option>';
                                                  }
                                                  else
                                                  {
                                                  	echo '<option value="yes" >Yes</option>
            										<option value="no">No</option>';
                                                  }
                                                  
                                                  
                                                 ?>
           					</select>
		 					</div>


	<div class="form-group">
    <label for="inputusername"><strong style="color:red">*</strong>	Brief Description of Work requested</label>
   <textarea type="text" class="form-control" placeholder="" name="description" required><?php echo $postedloan_data['request_description'] ; ?>					</textarea>
    </div>
                                      
                                      
                                      
                              </div>
                          </section>


                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">Department/Head Manager Approval</a>
                              </header>
                              <div class="panel-body">

                                  <div class="form-group">
              <label for="inputusername"><strong style="color:red">*</strong>	Department Manager Name</label>
            <input type="text" class="form-control" placeholder="" name="dept_manager_name" value="<?php echo $postedloan_data['dept_manager_name'] ; ?>" required>
            </div>

			 <div class="form-group">
             <label for="inputgroup"><strong style="color:red">*</strong>	Approve</label>
             <select class="form-control" name="dept_manager_approval" required>
            
            									<?php
                                                  
                                                  if(strtolower($postedloan_data['dept_manager_approval'])==strtolower("yes"))
                                                  {
                                                    echo '<option value="yes" selected>Yes</option>
            												<option value="no">No</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['dept_manager_approval'])==strtolower("no"))
                                                  {
                                                    echo '<option value="yes" >Yes</option>
            										<option value="no" selected>No</option>';
                                                  }
                                                  else
                                                  {
                                                  	
                                                  }
                                                  
                                                  
                                                 ?>
            </select>
		      </div>

			<div class="form-group">
            <label for="inputusername">	Approval Date</label>
            <input type="text" class="form-control datepicker2" placeholder="" value = "<?php echo $postedloan_data['dept_approval_date'] ; ?>" name="dept_approval_date" readonly>
         </div>
		                              
                              </div>
                          </section>

                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">IT Manager Approval for Software licence</a>
                              </header>
                              <div class="panel-body">

                      <div class="form-group">
            		  <label for="inputusername"><strong style="color:red">*</strong>IT Manager	Name</label>
					  <input type="text" class="form-control" placeholder="" name="it_manager_name" value="<?php echo $postedloan_data['it_manager_name'] ; ?>" required>
            		  </div>
			  
			 <div class="form-group">
             <label for="inputgroup"><strong style="color:red">*</strong>	Approve</label>
             <select class="form-control" name="it_manager_approval" required>
            
            									<?php
                                                  
                                                  if(strtolower($postedloan_data['it_manager_approval'])==strtolower("yes"))
                                                  {
                                                    echo '<option value="yes" selected>Yes</option>
            												<option value="no">No</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['it_manager_approval'])==strtolower("no"))
                                                  {
                                                    echo '<option value="yes" >Yes</option>
            										<option value="no" selected>No</option>';
                                                  }
                                                  else{}
                                                  
                                                  
                                                 ?>
           </select>
		       </div>

			<div class="form-group">
            <label for="inputusername">	Approval Date</label>
            <input type="text" class="form-control datepicker2" placeholder="" value = "<?php echo $postedloan_data['it_approval_date'] ; ?>" name="it_approval_date" readonly>
            </div>
		                              
                            </div>
                     </section>
              </div>

                 <div class="col-lg-4">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">To be filled by Service Desk engineer</a>
                              </header>
                              <div class="panel-body">
                                  <div class="form-group">
             						<label for="inputgroup">	Asset Type</label>
             						<select class="form-control" name="asset_type">
              							
              							<?php
                                                  
                                                  if(strtolower($postedloan_data['asset_type'])==strtolower("Laptop"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" selected>Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Monitor"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor" selected>Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("CPU"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" selected>CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Switches"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches" selected>Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Router"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" selected>Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Printer"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer" selected>Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Battery"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" selected>Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Power_pack"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack" selected>Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Mouse"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="working capital" >Working Capitial</option>
                                                 <option value="fixed assets">Fixed Assets</option> 
                                                 <option value="consumer" >Consumer</option>
                                                 <option value="housing">Housing</option>
                                                 <option value="Others" selected>Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("KYC Kit"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit" selected>KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['asset_type'])==strtolower("Others"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" selected>Others</option>';
                                                  }
                                                  else 
                                                  {
                                                    echo '<option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>';
                                                  }
                                                 ?>

           							</select>
		    </div>
			<div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>	Asset Tag No</label>
            <input type="text" class="form-control" placeholder="" name="tag_no" value="<?php echo $postedloan_data['tag_no'] ; ?>" required>
            </div>
			<div class="form-group">
            <label for="inputusername">	Hostname</label>
            <input type="text" class="form-control" placeholder="" name="hostname" value="<?php echo $postedloan_data['hostname'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername">	Product ID/Machine Type/Equipment Type</label>
            <input type="text" class="form-control" placeholder="" name="product_id" value="<?php echo $postedloan_data['product_id'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername">	Port/Ethernet</label>
            <input type="text" class="form-control" placeholder="" name="port" value="<?php echo $postedloan_data['port'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername"><strong style="color:red"></strong>	MAC Address</label>
            <input type="text" class="form-control" placeholder="" name="ip_address" value="<?php echo $postedloan_data['ip_address'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername">	Owned By</label>
            <input type="text" class="form-control" placeholder="" name="owned_by" value="<?php echo $postedloan_data['owned_by'] ; ?>">
            </div>
		
		   <div class="form-group">
            <label for="inputusername">Serial Number</label>
            <input type="text" class="form-control" placeholder="" name="serial" value="<?php echo $postedloan_data['serial_no'] ; ?>" readonly>
          </div>
		
		<div class="form-group">

            <label for="inputusername">Specifications</label>

            <textarea type="text" class="form-control" placeholder="" name="specification" readonly><?php echo $postedloan_data['specifications'] ; ?></textarea>

        </div>

        <div class="form-group">

            <label for="inputusername">Date Deployed</label>

            <input type="text" class="form-control datepicker2" name="date_deployed" value = "<?php echo $postedloan_data['date_deployed'] ; ?>" readonly required>

        </div>        
		
		<div class="form-group">
            <label for="inputusername">	<strong style="color:red">*</strong>Deployed By</label>
           <input type="text" class="form-control" placeholder="" name="deployed_by" value="<?php echo $postedloan_data['deployed_by'] ; ?>" readonly>
        </div>
		
		<div class="form-group">
            <label for="inputusername">	Project</label>
            <input type="text" class="form-control" name="project" value="<?php echo $postedloan_data['project'] ; ?>" >
                

               									<!--<?php
                                                  
                                                  if(strtolower($postedloan_data['project'])==strtolower("NWSM"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                <option value="NWSM" selected>NWSM</option>
                <option value="ACIS">ACIS</option>
               <option value="IBM">IBM</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['project'])==strtolower("ACIS"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                <option value="NWSM">NWSM</option>
                <option value="ACIS" selected>ACIS</option>
               <option value="IBM">IBM</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['project'])==strtolower("IBM"))
                                                  {
                                                    echo '<option value="" >-Select-</option>
                <option value="NWSM">NWSM</option>
                <option value="ACIS">ACIS</option>
               <option value="IBM" selected>IBM</option>';
                                                  }
                                                  else 
                                                  {
                                                    echo '<option value="" >-Select-</option>
                <option value="NWSM">NWSM</option>
                <option value="ACIS">ACIS</option>
               <option value="IBM">IBM</option>';
                                                  }

                                                  
                                                  
                                                 ?>

          </select>-->
        </div>

        							               <?php
                                          $role = $this->session->userdata('role');
                                          if($role=="level1"){
                                          if(($postedloan_data['status']=="deployed")){
                                          echo ('<input type="submit" class="btn btn-warning bg-red" value="Return" name="btn_update"><br><br>');
                                          }
                                        }
                                      ?>

                                      <?php
                                          $role = $this->session->userdata('role');
                                          if($role=="level2"){
                                          if(($postedloan_data['status']=="deployed")){
                                          echo ('<input type="submit" class="btn btn-default bg-red" value="Return" name="btn_update"><input type="submit" class="btn btn-default bg-red" value="Update" name="btn_update"><br><br>');
                                          }
                                        }
                                      ?>

                                      <?php
                                          $role = $this->session->userdata('role');
                                          if($role=="level2"){
                                          if(($postedloan_data['status']=="returned")){
                                          echo ('<input type="submit" class="btn btn-default bg-red" value="Update" name="btn_update"><br><br>');
                                          }
                                        }
                                      ?>

                                      
                                      
                                      
                              </div>
                          </section>
                 </div>

                 

</div>


  
</form>
