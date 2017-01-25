                    <?php
                      $uname = $this->session->userdata('uname');
                    ?>
                    <?php
                        echo validation_errors(); 
                    ?>
                    <?php
                        error_reporting(E_ERROR|E_WARNING);
                        //echo validation_errors();   
                    ?>

                    <?php
                       $message=$this->session->flashdata('message');
                       if($message=="deployed")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Asset successfully Deployed!.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="invalid_serial")
                       {
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Invalid serial Number or asset is already deployed,contact system administrator
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="asset_updated")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Asset successfully updated!.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="asset_updated_0")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            No update was done!.
                        </div>
                    <?php
                       }
                   ?>
  
                    <div class="row">
                        <!--Search FIlter-->
                        <!--<form action="<?php echo site_url('qlip_controller/search_filter'); ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplerole"></label>
                               <select class="form-control" name="filter_by" disable>
                                <option value="" >Filter By</option>
                                 <option value="date_installed" >Date Installed</option>
                                 <option value="purchase_date">Date Purchased</option>
                                 <option value="expiry_date">Warranty Expiry Date</option>
                                 
                               </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplelastname"></label>
                               <div class="input-group">
                               <input type="text" class="form-control datepicker2" name="start_date" value="<?php echo $start_date ; ?>" placeholder="Start Date" disable>
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                           </div>
                       </div>

                        <div class="col-md-3">
                             <div class="form-group">
                               <label for="exampleothernames"></label>
                               <div class="input-group">
                               <input type="text" class="form-control datepicker2" name="end_date" value="<?php echo $end_date ; ?>" placeholder="End Date" disable>
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>     
                           </div> 
                        </div>
                        
                        <div class="col-md-3">
                                    <div class="form-group">       
                                          <label for="exampleothernames"></label> 
                                          <div class="input-group">
                                          <input type="text" class="form-control" id="" placeholder="Keyword" name="keyword" value="">
                                          <span class="input-group-btn">
                                             <button type='button' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search" ></i></button>
                                         </span>
                                        </div>
                                    </div>
                        </div>
                        </form>-->
                        <div style="height:50px"></div>

                        <div class="col-md-12">
                            <div class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                                <header class="panel-heading bg-red">
                                    Download Activity Logs

                                </header>
                                <div class="panel-body">
                                    <!--Search FIlter-->
                        <form action="<?php echo site_url('qlip_controller/download_log'); ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplerole"></label>
                               <select class="form-control" name="filter_by">
                                <!--<option value="" >Filter By</option>-->
                                 <option value="lasg_staff_info_audit" >Installed</option>
                                 <option value="deployed_audit">Deployed</option>
                                 <option value="returned_audit">Returned</option>
                                 <option value="decommissioned_audit">Decommissioned</option>
                                 <!--<option value="first_repayment_date">First Repayment Date</option>-->
                               </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplelastname"></label>
                               <div class="input-group">
                               <input type="text" class="form-control datepicker2" name="start_date" value="<?php echo $start_date ; ?>" placeholder="Log Start Date">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                           </div>
                       </div>

                        <div class="col-md-3">
                             <div class="form-group">
                               <label for="exampleothernames"></label>
                               <div class="input-group">
                               <input type="text" class="form-control datepicker2" name="end_date" value="<?php echo $end_date ; ?>" placeholder="Log End Date">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>     
                           </div> 
                        </div>
                        
                        <div class="col-md-3">
                                    <div class="form-group">       
                                          <label for="exampleothernames"></label> 
                                          <div class="input-group">
                                          <input type="submit" class="form-control" id="" placeholder="Keyword" name="submit" value="Download">
                                          <!--<span class="input-group-btn">
                                             <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                         </span>-->
                                        </div>
                                    </div>
                        </div>
                        </form>
                                    
                                </div><!-- /.panel-body -->

                            </div><!-- /.panel -->

                            
                        </div><!-- /.col -->
                        
                    </div><!-- /.row -->


                    