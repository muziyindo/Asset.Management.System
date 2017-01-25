<?php
                        $unames = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
                        echo validation_errors(); 

                        

                        $message=$this->session->flashdata('message');
                       if($message=="loan_inserted")
                       {
                        echo ('<script>setTimeout(function() { alert("Loan application successful!"); }, 1);</script>');
                       }



?>

                    <?php
                       if(isset($error1)) {   
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Error!</strong><?php echo $error1; ?>
                        </div>
 
                   <?php  } ?>

<form enctype="multipart/form-data" action="<?php echo site_url('qlip_controller/file_upload_primera/'.$qlip_upload_data['file_id'].'/upload'); ?>" method="post" accept-charset="utf-8">
<div class="row"><!--qlip_upload_data-->
	             <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits5" class="toggle5 btn btn-primary">Uploaded file Information</a>
                              </header>
                              <div id="credits5" class="show">
                              <div class="panel-body">

                              	       <div class="form-group">
                                               <label for="exampleusername">FIle Name<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="oracle_number" placeholder="" name="oracle_number" value="<?php echo $qlip_upload_data['filename'] ; ?>" readonly>
                                      </div>
                                  
                                      <div class="form-group">
                                               <label for="exampleusername">Repayment Month<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="loan_amount" placeholder="" name="repayment_month" value="<?php echo $qlip_upload_data['upload_month'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Repayment Year<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="loan_tenure_months" placeholder="" name="repayment_year" value="<?php echo $qlip_upload_data['upload_year'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Total Amount<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="loan_tenure_months" placeholder="" name="loan_tenure_months" value="<?php echo $qlip_upload_data['total_amount'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Narration<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="home_addr" readonly><?php echo $qlip_upload_data['narration'] ; ?></textarea>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Date Uploaded<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="loan_tenure_months" placeholder="" name="loan_tenure_months" value="<?php echo $qlip_upload_data['upload_date'] ; ?>" readonly>
                                      </div>

                                      
                              </div>
                          </div>
                          </section>
                 </div>
                 <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits6" class="toggle6 btn btn-primary">Upload Repayment Report</a>
                              </header>
                              <div id="credits6" class="show">
                              <div class="panel-body">
                                       
                                           <div class="form-group">
                                               <label for="examplefirstname">Deduction Report Month</label>
                                               <div class="input-group">
                                               <select class="form-control" name="month" value="" required>
                                                 <option value="" >Select Month</option>
                                                 <option value="january" >January</option>
                                                 <option value="february">February</option>
                                                 <option value="march">March</option>
                                                 <option value="april" >April</option>
                                                 <option value="may">May</option>
                                                 <option value="june">June</option>
                                                 <option value="july" >July</option>
                                                 <option value="august">August</option>
                                                 <option value="september">September</option>
                                                 <option value="october" >October</option>
                                                 <option value="november">November</option>
                                                 <option value="december">December</option>
                                               </select>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="examplefirstname">Deduction Report Year</label>
                                               <div class="input-group">
                                               <select class="form-control" name="year" value="" required>
                                                 <option value="" >Select Year</option>
                                                 <?php
                                                   $days=2050; $day=2015;

                                                   while($day<=$days)
                                                   {
                                                   ?>
                                                        <option value="<?php echo $day ; ?>" ><?php echo $day ; ?></option>
                                                   
                                                   <?php $day=$day+1; } ?>
                                               </select>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="examplelastname">Sum Amount</label>
                                               <div class="input-group">
                                               <input type="text" class="form-control" id="sum_amoun" placeholder="" name="sum_amount" value="<?php echo $_POST['sum_amount'] ; ?>" required>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>
                                           <!--<div class="form-group">
                                               <label for="exampleothernames">Narration</label>
                                               <div class="input-group">
                                               <textarea type="text" class="form-control" id="" placeholder="" name="narration" required><?php echo $_POST['narration'] ; ?></textarea>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>-->
                                           <div class="form-group">
                                               <label for="exampleInputemail">FIle</label>
                                               <!--<div class="input-group">-->
                                               <input type="file"  name="myuploadFile" required>
                                               <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
                                             <!--</div>-->
                                           </div>
                                           <input type="submit" class="submit btn btn-info" value="Upload"></input>
                                       
                                
                                     
                              </div>
                            </div>
                          </section>
                 </div>

</div>
</form>