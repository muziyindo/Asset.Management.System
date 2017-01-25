                 <?php

                        $uname = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
                        //echo validation_errors(); 
                        //echo form_open('qlip_controller/upload_files');
                        echo form_open_multipart('qlip_controller/update_loan_images/'.$uname.'/'.$oracle_no.'/'.$id);

                        $message=$this->session->flashdata('message');
                       if($message=="invalid_on")
                       {
                    ?>
                           <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Invalid oracle number
                         </div>
                    <?php
                       }
                   ?>

                   <?php
                    $message=$this->session->flashdata('message');
                       if($message=="uploaded")
                       {
                    ?>
                           <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Document has been successfully uploaded.
                         </div>
                    <?php
                       }
                     ?>

                     <?php
                    $message=$this->session->flashdata('message');
                       if($message=="too_big")
                       {
                    ?>
                           <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Uploaded file is too big, maximum file-size is 1.5mb.
                         </div>
                    <?php
                       }
                     ?>

                   <?php
                       if(validation_errors() != false) {   
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Error!</strong><?php echo validation_errors();?>
                        </div>
 
                  <?php  } ?>

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
                
                   
                 <script>Command: toastr["error"]("Username and password missing")</script>
                 
                  <div class="row">
                    <div class="col-lg-12">
                      <section class="panel panel-primary">
                         <header class="panel-heading">Upload Documents</header>
                         <div class="panel-body">
                           <form enctype="multipart/form-data">
                           
                                           <div class="form-group">
                                               <label for="examplelastname">Oracle Number<strong style="color:red"> *</strong></label>
                                               <!--<div class="input-group">-->
                                               <input type="text" class="form-control" id="" placeholder="" name="oracle_number" value="<?php echo $oracle_no ; ?>" readonly>
                                               <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
                                             <!--</div>-->
                                           </div>

                                           <!--<div class="form-group">
                                               <label for="examplerole">Document Type<strong style="color:red"> *</strong></label> <span style="background:rgb(255,117,117)"><strong>(allowed file types are .JPG,PNG. PDF not allowed)</strong></span>
                                               <select class="form-control" name="document_type" value="" required>
                                                <option value="" >Select Document type</option>
                                                 <option value="Loan Application Form" >Loan Application</option>
                                                 <option value="Pay Slip">Pay Slip</option>
                                                 <option value="Letter of Authority">Letter of Authority</option>
                                                 <option value="Loan Application Form" >Loan Application</option>
                                                 <option value="Offer letter">Offer letter</option>
                                                 <option value="Staff ID">Staff ID</option>
                                                 <option value="Employment letter" >Employment letter</option>
                                                 <option value="Bank Statement">Bank Statement</option>
                                                 <option value="Bank Verification Number">Bank Verification Number
                                                 <option value="Means of ID" >Valid Means of ID(Optional)</option>
                                                 
                                               </select>
                                           </div>-->
                                           
                                           <!--<div class="form-group">
                                               <label for="exampleInputemail">Loan Application </label>
                                               
                                               <input type="file"  name="loan_application">
                                               
                                           </div>-->
                                           <div class="form-group">
                                               <label for="exampleInputemail">Upload Documents <strong style="color:red"> *</strong></label>
                                               <input type="file"  name="pay_slip">
                                           </div>
                                           <!--<div class="form-group">
                                               <label for="exampleInputemail">Letter of Authority </label>
                                               
                                               <input type="file"  name="letter_of_authority">
                                               
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputemail">Offer Letter </label>
                                               
                                               <input type="file"  name="offer_letter">
                                               
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputemail">Staff ID </label>
                                               
                                               <input type="file"  name="staff_id">
                                               
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputemail">Employment Letter </label>
                                               
                                               <input type="file"  name="employment_letter">
                                               
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputemail">Bank Statement </label>
                                               
                                               <input type="file"  name="bank_statement">
                                               
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputemail">Bank Verification Number </label>
                                               
                                               <input type="file"  name="bvn">
                                               
                                           </div>-->
                                           <input type="submit" class="submit btn btn-info" value="Upload"></input>
                                           <input type="hidden" name="MAX_FILE_SIZE" value="15000000000000">
                                       
                                </form>
                            </div>
                            </section>

                            
                          
                         </div>
                  </div>
                  
                   