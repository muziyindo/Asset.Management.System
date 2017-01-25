                  <?php
                        $uname = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
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
 
                  <?php
                 }
                        echo form_open('qlip_controller/update_password/'.$uname);
    
                   
                        $message=$this->session->flashdata('message');
                       if($message=="pword_changed")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Success!</strong> Password successfully changed!.
                        </div>

                     <?php  }
                       if($message=="pword_same")
                      {
                        ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Zero-change!</strong> Old password is the same with new password!.
                        </div>

                    <?php
                      }
                        echo $wrong_old_password ;
                   ?>

                                                    
                   

                 <script>Command: toastr["error"]("Username and password missing")</script>
                   <div class="row">
                    
                         
                        
                           
                           <div class="col-lg-12">
                                      <section class="panel panel-primary">
                                        <header class="panel-heading">Change Password</header>
                                        <div class="panel-body">
                                          <form>
                                           <div class="form-group">
                                               <label for="examplefirstname">Old Password</label>
                                               <div class="input-group">
                                               <input type="password" id="fname" name="old_password" placeholder="" class="form-control" value="<?php echo $_POST['fname'] ; ?>">
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="examplelastname">New Password</label>
                                               <div class="input-group">
                                               <input type="password" class="form-control" id="" placeholder="" name="new_password" value="<?php echo $_POST['lname'] ; ?>">
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleothernames">Confirm New Password</label>
                                               <div class="input-group">
                                               <input type="password" class="form-control" id="" placeholder="" name="retype_password" value="<?php echo $_POST['oname'] ; ?>">
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                               </div>
                                           </div>
                                           
                                           <input type="submit" class="submit btn btn-info" value="Change Password"></input>
                                          </form>
                                        </div>
                                      </section>
                            </div>
                        </div>
                    
                  
                   