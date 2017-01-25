                     <?php
                        $unames = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
                        echo validation_errors(); 
                        echo form_open_multipart('qlip_controller/insert_loan/'.$unames);

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
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:20px; color:white; text-alignment:center">NEW ASSET INSTALLATION FORM</a>
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

                                  <?php
                                                    $sql="select * from qusers where uname = '$unames'";
                                                    $query = $this->db->query($sql);
                                                    foreach ($query->result() as $val_user)
                                                    {
                                                        $fname = $val_user->fname ;
                                                        $lname = $val_user->lname ;
                                                        $project = $val_user->project ;
                                                    }
                                    ?>

                                  <div class="form-group">
                                               <label for="exampleusername">Name</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="installer_name" value="<?php echo $lname." ".$fname ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Project</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="project" value="<?php echo $project ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Department</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="department" value="<?php echo $_POST['department'] ; ?>" >
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
                                               <input type="text" class="form-control" id="" placeholder="" name="state" value="<?php echo $_POST['state'] ; ?>" required>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Local Govt</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="lg" value="<?php echo $_POST['lg'] ; ?>">
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">City/Town<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="city" value="<?php echo $_POST['city'] ; ?>" required>
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
                                                 <option value="" >-Select-</option>
                                                 <option value="hardware" >Hardware</option>
                                                 <!--<option value="software">Software</option>-->
                                               </select>
                                      </div>
                                      <div id="category_box">
                                      <!--<div class="form-group">
                                               <label for="examplerole">Type<strong style="color:red"> *</strong></label>
                                               <select class="form-control" name="asset_type" value="" required>
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
                                      </div>-->
                                      </div>
                                      
                                      <div class="form-group">
                                               <label for="exampleusername">Name/Brand<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="asset_name" value="<?php echo $_POST['asset_name'] ; ?>" required>
                                       </div>
                                       <div class="form-group">
                                               <label for="exampleusername">Model<strong style="color:red"> *</strong></label></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="model" value="<?php echo $_POST['mname'] ; ?>" required>
                                        </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Serial<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="serial" value="<?php echo $_POST['fname'] ; ?>" required>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Specification<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="specification" required><?php echo $_POST['specification'] ; ?></textarea>
                                      </div>

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
                                               <input type="text" class="form-control" id="" placeholder="" name="po_number" value="<?php echo $_POST['current_emp'] ; ?>">
                                      </div>
                                     
                                      <div class="form-group">
                                               <label for="exampleusername">Vendor supplied</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="vendor" value="<?php echo $_POST['landmark_emp'] ; ?>">
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
                                               <input type="text" class="form-control" id="purchase_date" placeholder="" name="purchase_date" value="<?php echo $_POST['purchase_date'] ; ?>" required>
                                      </div>
                                     
                                      <div class="form-group">
                                               <label for="examplerole">Warranty<strong style="color:red"> *</strong></label>
                                               <select class="form-control" name="warranty" value="" required>
                                                 <option value="" >--Select--</option>
                                                  <option value="0" >No Warranty</option>
                                                 <option value="1" >1 Year</option>
                                                 <option value="2">2 Years</option>
                                                 <option value="3" >3 Years</option>
                                                 <option value="4">4 years</option>
                                                 <option value="5" >5 Years</option>
                                                 <option value="6">6 Years</option>
                                                 <option value="7" >7 years</option>
                                               </select>
                                      </div>

                                      <div class="form-group">
                                               <label for="exampleusername">Date Installed<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="date_installed" placeholder="" name="date_installed" value="<?php echo $_POST['date_installed'] ; ?>" required>
                                      </div>
                                      
                                        
                              </div>
                          </div>
                          </section>
                 </div>

</row>

<?php
/*Auto generate d2rs_id, serves as oracle_no*/
     $sql = "select d2rs_id from d2rs_unique_id";
     $query = $this->db->query($sql);
     foreach ($query->result() as $val_d2rs_id)
     {
          $d2rs_id = $val_d2rs_id->d2rs_id ;
          $today = date('Y-m-d');
          $date = DateTime::createFromFormat("Y-m-d", $today);
          $year = $date->format("Y");
          $year = substr($year,1,4);
          $d2rs_number = "2".$year."".$d2rs_id ;

          //increment and update d2rs_id
          $d2rs_id = $d2rs_id + 1 ;
          $sql = "update d2rs_unique_id set d2rs_id = '$d2rs_id'";
          $query = $this->db->query($sql);
     }
?>

<input type="hidden" class="form-control" id="" placeholder="" name="unique_id" value="<?php echo $d2rs_number ; ?>">

<div class="row">
               
               <div class="col-lg-6" style="padding-left:50px">
                    <input type="submit" class="submit btn btn-default" id="" value="Next" ></input>  
                </div>
</div>


</form>