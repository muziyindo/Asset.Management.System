                 <?php
                        error_reporting(E_ERROR|E_WARNING);
                        //echo validation_errors(); 
                        echo form_open('qlip_controller/insert_user');

                        $message=$this->session->flashdata('message');
                       if($message=="user_created")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            User successfully created!
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
                
                   
                   

                 <script>Command: toastr["error"]("Username and password missing")</script>
                  
                    <form>

                    <div class="row">
               
               <div class="col-lg-12">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:20px; color:white; text-alignment:center">USER PROFILING FORM</a>
                              </header>
                          </section>
                 </div>
</div>

<div class="row">
               
               <div class="col-lg-6">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">Personal Information</a>
                              </header>
                              <div class="panel-body">
                                  <div class="form-group">
                                               <label for="examplefirstname">Firstname</label>
                                               <div class="input-group">
                                               <input type="text" id="fname" name="fname" placeholder="" class="form-control" value="<?php echo $_POST['fname'] ; ?>" required>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="examplelastname">Lastname</label>
                                               <div class="input-group">
                                               <input type="text" class="form-control" id="" placeholder="" name="lname" value="<?php echo $_POST['lname'] ; ?>" required>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleothernames">Othername(s)</label>
                                               
                                               <input type="text" class="form-control" id="" placeholder="" name="oname" value="<?php echo $_POST['oname'] ; ?>">
                                           </div>
                                           <div class="form-group">

                                               <label for="exampleInputemail">Email</label>
                                               <div class="input-group">
                                               <input type="email" class="form-control" id="" placeholder="" name="email" value="<?php echo $_POST['email'] ; ?>">
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                               </div>
                                           </div>
                                           
                                           <div class="form-group">
                                               <label for="examplerole">Role</label>
                                               <select class="form-control" name="role" value="" id="table1" required>
                                                 <option value="" >--Select--</option>
                                                 <option value="level1" >Level-1</option>
                                                 <option value="level2">Level-2</option>
                                                 <!--<option value="admin">Admin</option>-->
                                               </select>
                                           </div>
                                           
                            
                              </div>
                          </section>
                 </div>
                 <div class="col-lg-6">
                          <section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                              <header class="panel-heading bg-red">
                                  <a href="#credits" class="toggle" style="font-weight:bold; font-size:15px; color:white; text-alignment:center">Login  Information</a>
                              </header>
                              <div class="panel-body">
                                  <div class="form-group">
                                               <label for="exampleusername">Username</label>
                                               <div class="input-group">
                                               <input type="text" class="form-control" id="" placeholder="" name="uname" value="<?php echo $_POST['uname'] ; ?>" required>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputPassword1">Password</label>
                                               <div class="input-group">
                                               <input type="password" class="form-control" id="" placeholder="" name="pword" value="<?php echo $_POST['pword'] ; ?>" required>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="exampleInputPassword2">Re-type Password</label>
                                               <div class="input-group">
                                               <input type="password" class="form-control" id="" placeholder="" name="pword2" value="<?php echo $_POST['pword2'] ; ?>" required>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>

                                           <!--<div class="form-group" id="year">
                                               <label for="examplerole">Project</label>
                                               <select class="form-control" name="project" value="" required>
                                                 <option value="" >Select</option>
                                                 <option value="NWSM">NWSM</option>
                                                 <option value="ACIS">ACIS</option>
                                                 <option value="IBM">IBM</option>
                                               </select>
                                           </div>-->

                                           <div class="form-group">
                                               <label for="exampleInputPassword2">Project</label>
                                               <div class="input-group">
                                               <input type="text" class="form-control" id="" placeholder="" name="project" value="<?php echo $_POST['project'] ; ?>" >
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                             </div>
                                           </div>

                                           <input type="submit" class="submit btn btn-info bg-red" value="Create"></input>
                                      
                                      
                                      
                              </div>
                          </section>
                 </div>

                 <div class="col-md-6">
                                  <!--<input type="submit" class="submit btn btn-info" value="Create"></input>-->
                 </div>
</div>
                    
                    </form>
                  
                   