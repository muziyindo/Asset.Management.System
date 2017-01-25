                     <?php
                         $uname = $this->session->userdata('uname');

                         //set session to store serial for update purposes
                         $this->session->set_userdata('sno_sess', $postedloan_data['serial']);
                
                        error_reporting(E_ERROR|E_WARNING);
                        echo validation_errors(); 
                        echo form_open('qlip_controller/update_loan/'.$postedloan_data['lsid'].'/'.$uname);

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
                <?php } else if($postedloan_data['status']=="installed"){  ?>
                <label for="exampleusername" class="fa fa-star">status</label>
                <label for="exampleusername" class="badge bg-green">installed</label>
                <?php } else if($postedloan_data['status']=="decommissioned"){  ?>
                <label for="exampleusername" class="fa fa-star">status</label>
                <label for="exampleusername" class="badge bg-red">decommissioned</label>
                <?php
                  }
                ?>
                
               </div>
               <div class="col-lg-6">
              </div>
</div>

<div class="row">
               
               <div class="col-lg-12">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:20px; color:white; text-alignment:center">ASSET INSTALLATION FORM, RECORD VIEW-MODE</a>
                              </header>
                          </section>
                 </div>
</div>

<div class="row">
               
               <div class="col-lg-6">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">Installer Information</a>
                              </header>
                              <div class="panel-body">

                                  <div class="form-group">
                                               <label for="exampleusername">Name</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="installer_name" value="<?php echo $postedloan_data['installer_name'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Project</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="project" value="<?php echo $postedloan_data['project'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Department</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="department" value="<?php echo $postedloan_data['department'] ; ?>" >
                                      </div>
                              </div>
                          </section>
                 </div>
                 <div class="col-lg-6">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">Office Location</a>
                              </header>
                              <div class="panel-body">
                                  <div class="form-group">
                                               <label for="exampleusername">state<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="state" value="<?php echo $postedloan_data['state'] ; ?>" required>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Local Govt</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="lg" value="<?php echo $postedloan_data['lg'] ; ?>">
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">City/Town<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="city" value="<?php echo $postedloan_data['city'] ; ?>" required>
                                      </div>
                                      
                                      
                                      
                              </div>
                          </section>
                 </div>
</div>

<div class="row">
               
               <div class="col-lg-6">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">General Information</a>
                              </header>
                              <div class="panel-body">
                                  <div class="form-group">
                                               <label for="examplerole">Category<strong style="color:red"> *</strong></label>
                                               <select class="form-control" name="category" value="" id="category" required>

                                                 <?php
                                                  
                                                  if(strtolower($postedloan_data['category'])==strtolower("hardware"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="hardware" selected>Hardware</option>
                                                 <option value="software">Software</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['category'])==strtolower("software"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="hardware" >Hardware</option>
                                                 <option value="software" selected>Software</option>';
                                                  }
                                                  
                                                  else 
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="hardware" >Hardware</option>
                                                 <option value="software">Software</option>';
                                                  }
                                                 ?>
                                               </select>
                                      </div>
                                      <div id="category_box">
                                      <div class="form-group">
                                               <label for="examplerole">Type<strong style="color:red"> *</strong></label>
                                               <select class="form-control" name="asset_type" value="" required>
                                                 

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
                                      </div><!--end-->
                                      
                                      <div class="form-group">
                                               <label for="exampleusername">Name/Brand<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="asset_name" value="<?php echo $postedloan_data['asset_name'] ; ?>" required>
                                       </div>
                                       <div class="form-group">
                                               <label for="exampleusername">Model<strong style="color:red"> *</strong></label></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="model" value="<?php echo $postedloan_data['model'] ; ?>" required>
                                        </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Serial<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="serial" value="<?php echo $postedloan_data['serial'] ; ?>" required>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Specification<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="specification" required><?php echo $postedloan_data['specification'] ; ?></textarea>
                                      </div>

                                      <!--table for uploaded documents-->
                                      <span style="background:rgb(255,117,117)"><strong>(Uploaded documents)</strong></span>
                                      <table class="table table-bordered" style="font-size:12px;">
                                        <tr>
                                            <th>Device ID</th>
                                            <th>Document Type</th>
                                            <th></th>
                                            <?php
                                              $role = $this->session->userdata('role');
                                              if($role=="level1"){ 
                                            ?> 
                                            <th></th> 
                                            <?php } ?>
                                        </tr>
                                        <tbody>
                                          <?php
                                          $oracle_number=$postedloan_data['unique_id'] ;
                                          $result11 = mysql_query("SELECT * from documents where oracle_number='$oracle_number'");
                                          while($row=mysql_fetch_array($result11))
                                          {
                                            $did = $row['did'];
                                          ?>
                                          <tr>
                                          <td><?php echo $row['oracle_number']; ?></td>
                                          <td><?php echo $row['document_type']; ?></td>
                                          <td><a href="<?php echo site_url() ?>/qlip_controller/download_documents/<?php echo $row['path'] ?>">Download</a></td>
                                          
                                          <?php
                                          $role = $this->session->userdata('role');
                                          if($role=="level1"){ 
                                          ?>
                                          <td><a href="<?php echo site_url() ?>/qlip_controller/delete_documents/<?php echo $uname.'/'.$did.'/'.$postedloan_data['lsid'] ?>">Remove</a></td>
                                          <?php } ?>
                                          <tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                  <?php 
                                  $role = $this->session->userdata('role');
                                  if($role=="level1"){ ?>
                                  <a role="button" class="btn btn-default" href="<?php echo site_url() ?>/qlip_controller/change_upload_documents/<?php echo $uname.'/'.$oracle_number.'/'.$postedloan_data['lsid'] ?>">Upload More</a>
                                  <?php } ?>

                              </div>
                          </section>
                 </div>

                 <div class="col-lg-6">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">Others</a>
                              </header>
                              <div class="panel-body">
                                    <div class="form-group">
                                               <label for="exampleusername">PO number</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="po_number" value="<?php echo $postedloan_data['po_number'] ; ?>">
                                      </div>
                                     
                                      <div class="form-group">
                                               <label for="exampleusername">Vendor supplied</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="vendor" value="<?php echo $postedloan_data['vendor'] ; ?>">
                                      </div>
                              </div>
                          </section>

                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits2" class="toggle2" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">Warranty Information</a>
                              </header>
                              <div id="credits2" class="show">
                              <div class="panel-body">
                                  
                                      <div class="form-group">
                                               <label for="exampleusername">Purchase date<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="purchase_date" placeholder="" name="purchase_date" value="<?php echo $postedloan_data['purchase_date'] ; ?>" required>
                                      </div>
                                     
                                      <div class="form-group">
                                               <label for="examplerole">Warranty<strong style="color:red"> *</strong></label>
                                               <select class="form-control" name="warranty" value="" required>
                                                 

                                                 <?php
                                                  
                                                  if(strtolower($postedloan_data['warranty'])==strtolower("1"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="0">No Warranty</option>
                                                 <option value="1" selected>1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" >7 years</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['warranty'])==strtolower("2"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                   <option value="0">No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2" selected>2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" >7 years</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['warranty'])==strtolower("3"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="0">No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" selected>3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" >7 years</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['warranty'])==strtolower("4"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="0">No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4" selected>4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" >7 years</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['warranty'])==strtolower("5"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="0">No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" selected>5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" >7 years</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['warranty'])==strtolower("6"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                  <option value="0">No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6" selected>6 Years</option>
                                                 <option value="7" >7 years</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['warranty'])==strtolower("7"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="0">No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" selected>7 years</option>';
                                                  }
                                                  else if(strtolower($postedloan_data['warranty'])==strtolower("0"))
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                 <option value="0" selected>No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7">7 years</option>';
                                                  }
                                                  
                                                  else 
                                                  {
                                                    echo '<option value="" >--Select--</option>
                                                   <option value="0">No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" >7 years</option>';
                                                  }
                                                 ?>
                                               </select>
                                      </div>

                                      <div class="form-group">
                                               <label for="exampleusername">Date Installed<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="date_installed" placeholder="" name="date_installed" value="<?php echo $postedloan_data['date_installed'] ; ?>" required>
                                      </div>

                                      <?php
                                          $role = $this->session->userdata('role');
                                          if($role=="level1"){
                                          if(($postedloan_data['status']=="installed")){
                                          echo ('<input type="submit" class="btn btn-default bg-red" value="Deploy" name="btn_update"><br><br>');
                                          }
                                        }
                                      ?>

                                      <?php
                                          $role = $this->session->userdata('role');
                                          if($role=="level2"){
                                          if(($postedloan_data['status']=="installed")){
                                          echo ('<input type="submit" class="btn btn-default bg-red" value="Deploy" name="btn_update"><input type="submit" class="btn btn-default bg-red" value="Update" name="btn_update"><br><br>');
                                          }
                                        }
                                      ?>

                                      <?php
                                          $role = $this->session->userdata('role');
                                          if($role=="level2"){
                                          if(($postedloan_data['status']=="deployed") || ($postedloan_data['status']=="returned")){
                                          echo ('<input type="submit" class="btn btn-default bg-red" value="Update" name="btn_update"><br><br>');
                                          }
                                        }
                                      ?>
                                      
                                        
                              </div>
                          </div>
                          </section>
                 </div>

</row>

<input type="hidden" name="status" value="<?php echo $postedloan_data['status'] ; ?>">


  
</form>
