                 <?php

                        $uname = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
                        //echo validation_errors(); 
                        //echo form_open('qlip_controller/upload_files');
                        echo form_open_multipart('qlip_controller/insert_bulk_upload/');

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
                      <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                         <header class="panel-heading bg-red">Upload Documents(excel)</header>
                         <div class="panel-body">
                           <form enctype="multipart/form-data">
                           
                                           
                                           <div class="form-group">
                                               <label for="exampleInputemail" >Upload Document <span style="background:orange">(only excel)</span> <strong style="color:red"> *</strong></label>
                                               <input type="file"  name="myuploadFile" >
                                           </div>
 
                                               
                                           <input type="hidden" class="form-control" id="" placeholder="" name="flag_" value="100">
                                           <input type="submit" class="submit btn btn-info" value="Upload"></input>
                                           
                                       
                                </form>
                            </div>
                            </section>

                            
                          
                         </div>
                  </div>
                  
                   