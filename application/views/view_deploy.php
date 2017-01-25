                     <?php
                        $unames = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
                        echo validation_errors(); 
                        echo form_open_multipart('qlip_controller/insert_deploy/'.$unames.'/'.$install_id);

                     ?>
                     <?php
                       $message=$this->session->flashdata('message');
                       if($message=="loan_inserted")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Device Successful Installed!.
                        </div>
                    <?php
                       }
                   ?>

<form enctype="multipart/form-data">

<div class="row">
               
               <div class="col-lg-12">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:20px; color:white; text-alignment:center">ASSET DEPLOYMENT FORM</a>
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
             <input type="text" class="form-control" Value="Airtel" name="organisation">
        </div>
        <div class="form-group">
            <label for="inputusername">	Country</label>
            <input type="text" class="form-control" placeholder="" name="country" value="<?php echo $_POST['country'] ; ?>" >
         </div>  
    	 <div class="form-group">
            <label for="inputusername">	Region</label>
            <input type="text" class="form-control" placeholder="" name="region" value="<?php echo $_POST['region'] ; ?>">
         </div>	 
		 <div class="form-group">
            <label for="inputusername">	City</label>
            <input type="text" class="form-control" placeholder="" name="city" value="<?php echo $_POST['city'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername">	Location/Address</label>
            <input type="text" class="form-control" placeholder="" name="address" value="<?php echo $_POST['address'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername">	Type of office</label>
            <input type="text" class="form-control" placeholder="" name="office_type" value="<?php echo $_POST['office_type'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername">	Floor/Room/Seat rack No</label>
            <input type="text" class="form-control" placeholder="" name="room_no" value="<?php echo $_POST['room_no'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>Employee Name</label>
            <input type="text" class="form-control" placeholder="" name="user_name" value="<?php echo $_POST['user_name'] ; ?>" required>
         </div>
		 <div class="form-group">
            <label for="inputusername">	Employee No</label>
            <input type="text" class="form-control mobile_phone" placeholder="" name="employee_no" value="<?php echo $_POST['employee_no'] ; ?>">
         </div>
		 <div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>	Contact No</label>
            <input type="text" class="form-control mobile_phone" placeholder="" name="contact_no" value="<?php echo $_POST['contact_no'] ; ?>" required>
         </div>
		 <div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>	Department</label>
            <input type="text" class="form-control" placeholder="" name="department" value="<?php echo $_POST['department'] ; ?>" required>
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
            						<input type="email" class="form-control" placeholder="" name="email" value="<?php echo $_POST['email'] ; ?>" required>
         					</div>
		 
		 					<div class="form-group">
            				<label for="inputusername">	Request Date</label>
            				<input type="text" class="form-control datepicker2" placeholder="" name="request_date"  value = "<?php echo $_POST['request_date'] ; ?>" readonly>
         					</div>
		 					<div>
             				<label for="inputgroup">	User Approval/Signature</label>
             				<select class="form-control" name="user_approval" >
            				<option value="yes" selected="selected">Yes</option>
            				<option value="no">No</option>
           					</select>
		 					</div>
		   					<div class="form-group">
            				<label for="inputusername"><strong style="color:red">*</strong>	Brief Description of Work requested</label>
            				<textarea type="text" class="form-control" placeholder="" name="description" required><?php echo $_POST['description'] ; ?>					</textarea>
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
            <input type="text" class="form-control" placeholder="" name="dept_manager_name" value="<?php echo $_POST['dept_manager_name'] ; ?>" required>
            </div>
			       <div>
             <label for="inputgroup"><strong style="color:red">*</strong>	Approve</label>
             <select class="form-control" name="dept_manager_approval" required>
            <option value="no">No</option>
            <option value="yes" selected="selected">Yes</option>
            </select>
		      </div>
			<div class="form-group">
            <label for="inputusername">	Approval Date</label>
            <input type="text" class="form-control datepicker2" placeholder="" value = "<?php echo $_POST['dept_approval_date'] ; ?>" name="dept_approval_date" readonly>
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
            <input type="text" class="form-control" placeholder="" name="it_manager_name" value="<?php echo $_POST['it_manager_name'] ; ?>" required>
            </div>
			       <div>
             <label for="inputgroup"><strong style="color:red">*</strong>	Approve</label>
             <select class="form-control" name="it_manager_approval" required>
            <option value="no">No</option>
            <option value="yes" selected="selected">Yes</option>
           </select>
		       </div>
			     <div class="form-group">
            <label for="inputusername">	Approval Date</label>
            <input type="text" class="form-control datepicker2" placeholder="" value = "<?php echo $_POST['it_approval_date'] ; ?>" name="it_approval_date" readonly>
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
                                  <div>
             <label for="inputgroup">	Asset Type</label>
             <select class="form-control" name="asset_type">
             <option value="" >-Select-</option>
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
                                                 <option value="Others" >Others</option>
           </select>
		    </div>
			<div class="form-group">
            <label for="inputusername"><strong style="color:red">*</strong>	Asset Tag No</label>
            <input type="text" class="form-control" placeholder="" name="tag_no" value="<?php echo $_POST['tag_no'] ; ?>" required>
            </div>
			<div class="form-group">
            <label for="inputusername">	Hostname</label>
            <input type="text" class="form-control" placeholder="" name="hostname" value="<?php echo $_POST['hostname'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername">	Product ID/Machine Type/Equipment Type</label>
            <input type="text" class="form-control" placeholder="" name="product_id" value="<?php echo $_POST['product_id'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername">	Port/Ethernet</label>
            <input type="text" class="form-control" placeholder="" name="port" value="<?php echo $_POST['port'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername"><strong style="color:red"></strong>	MAC Address</label>
            <input type="text" class="form-control" placeholder="" name="ip_address" value="<?php echo $_POST['ip_address'] ; ?>">
            </div>
			<div class="form-group">
            <label for="inputusername">	Owned By</label>
            <input type="text" class="form-control" placeholder="" name="owned_by" value="<?php echo $_POST['owned_by'] ; ?>">
            </div>

            				            <?php
            									//get asset detail
                                                    $sql="select * from lasg_staff_info where lsid = '$install_id'";
                                                    $query = $this->db->query($sql);
                                                    foreach ($query->result() as $val_user)
                                                    {
                                                        $serial = $val_user->serial ;
                                                        $specification = $val_user->specification ;
                                                        
                                                    }
                                    ?>
		
		   <div class="form-group">
            <label for="inputusername">Serial Number</label>
            <input type="text" class="form-control" placeholder="" name="serial" value="<?php echo $serial ; ?>" readonly>
          </div>
		
		<div class="form-group">

            <label for="inputusername">Specifications</label>

            <textarea type="text" class="form-control" placeholder="" name="specification" readonly><?php echo $specification ; ?></textarea>

        </div>

        <div class="form-group">

            <label for="inputusername">Date Deployed</label>

            <input type="text" class="form-control datepicker2" name="date_deployed" value = "<?php echo date('Y-m-d') ; ?>" readonly required>

        </div>        
		
                              <?php
                              //get asset detail
                                                    $sql="select * from qusers where uname = '$unames'";
                                                    $query = $this->db->query($sql);
                                                    foreach ($query->result() as $val_user)
                                                    {
                                                        $fname = $val_user->fname ;
                                                        $lname = $val_user->lname ;
                                                        
                                                    }
                                    ?>

		<div class="form-group">
            <label for="inputusername">	<strong style="color:red">*</strong>Deployed By</label>
           <input type="text" class="form-control" placeholder="" name="deployed_by" value="<?php echo $lname.' '.$fname ; ?>" readonly>
        </div>
		
		<div class="form-group">
            <label for="inputusername">	Project</label>
            <input type="text" class="form-control" name="project" value="">
                <!--<option value="" >-Select-</option>
                <option value="NWSM">NWSM</option>
                <option value="ACIS">ACIS</option>
               <option value="IBM">IBM</option>
          </select>-->
        </div>
                                      
                                      
                                      
                              </div>
                          </section>
                 </div>

                 

</div>


<div class="row">
               
               <div class="col-lg-6" style="padding-left:50px">
                    <input type="submit" class="submit btn btn-default" id="" value="Deploy" ></input>  
                </div>
</div>


</form>