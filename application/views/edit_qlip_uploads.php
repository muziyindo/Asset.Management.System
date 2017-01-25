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

<form action="<?php echo site_url('qlip_controller/edit_uploaded/'.$qlip_upload_data['file_id']."/update"); ?>" method="post" accept-charset="utf-8">
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
                                               <input type="text" class="form-control" id="loan_amount" placeholder="" name="loan_amount" value="<?php echo $qlip_upload_data['upload_month'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Repayment Year<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="loan_tenure_months" placeholder="" name="loan_tenure_months" value="<?php echo $qlip_upload_data['upload_year'] ; ?>" readonly>
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
                                  <a href="#credits6" class="toggle6 btn btn-primary">Bank Statement Information</a>
                              </header>
                              <div id="credits6" class="show">
                              <div class="panel-body">

                                     <?php
                                        if($qlip_upload_data['status']=="pending"){
                                     ?>
                                 
                                      <div class="form-group">
                                               <label for="exampleusername">Statement ID<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="account_number" placeholder="" name="statement_id" value="<?php echo $_POST['statement_id'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Amount Credited<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="credit_bank" value="<?php echo $_POST['credit_bank'] ; ?>">
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Value Date<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="datepicker2" placeholder="" name="value_date" value="<?php echo $_POST['value_date'] ; ?>">
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Narration on Bank Statement<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="narration_bank"><?php echo $_POST['narration_bank'] ; ?></textarea>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Reason for upload declination(<span style="background-color:orange; font-size:12px;">Leave empty if approving upload</span>)</label>
                                               <textarea type="text" class="form-control" placeholder="" name="rejection_reason" ><?php echo $_POST['rejection_reason'] ; ?></textarea>
                                      </div>
                                      
                                      <?php } else if($qlip_upload_data['status']=="declined"||$qlip_upload_data['status']=="approved"){ ?>
                                      
                                      <div class="form-group">
                                               <label for="exampleusername">Statement ID<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="statement_id" value="<?php echo $qlip_upload_data['statement_id'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Amount Credited<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="account_number" placeholder="" name="credit_bank" value="<?php echo $qlip_upload_data['credit_bank'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Value Date<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="value_date" value="<?php echo $qlip_upload_data['value_date'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Narration on Bank Statement<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="narration_bank" readonly><?php echo $qlip_upload_data['narration_bank'] ; ?></textarea>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Reason for loan declination</label>
                                               <textarea type="text" class="form-control" placeholder="" name="rejection_reason" readonly><?php echo $qlip_upload_data['rejection_reason'] ; ?></textarea>
                                      </div>

                                      <?php } ?>

                                      <?php 
                                        if($qlip_upload_data['status']=="pending"){
                                      ?>

                                      <input type="submit" class="btn btn-default" id="submit" value="Approve" name="btn_submit"></input>
                                      <input type="submit" class="btn btn-default" id="submit" value="Decline" name="btn_submit"></input>
                                    <?php } ?>

                              </div>
                          </div>
                          </section>
                 </div>

</div>
</form>