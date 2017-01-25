                 <?php
                        error_reporting(E_ERROR|E_WARNING);
                        //echo validation_errors(); 
                        //echo form_open('qlip_controller/upload_files');
                        echo form_open_multipart('qlip_controller/upload_files');

                        $message=$this->session->flashdata('message');
                       if($message=="file_inserted")
                       {
                    ?>
                           <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            File Successfully uploaded!
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
                         <header class="panel-heading">Upload Deduction Report</header>
                         <div class="panel-body">
                           <form enctype="multipart/form-data">
                           
                               
                                       
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
                                               <input type="text" class="form-control" id="sum_amount" placeholder="" name="sum_amount" value="<?php echo $_POST['sum_amount'] ; ?>" required>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleothernames">Narration</label>
                                               <div class="input-group">
                                               <textarea type="text" class="form-control" id="" placeholder="" name="narration" required><?php echo $_POST['narration'] ; ?></textarea>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputemail">FIle</label>
                                               <!--<div class="input-group">-->
                                               <input type="file"  name="myuploadFile" required>
                                               <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
                                             <!--</div>-->
                                           </div>
                                           <input type="submit" class="submit btn btn-info" value="Upload"></input>
                                       
                                </form>
                            </div>
                            </section>

                            
                          
                         </div>
                  </div>
                  
                   