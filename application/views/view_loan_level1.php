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
                        <form action="<?php echo site_url('qlip_controller/search_filter'); ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplerole"></label>
                               <select class="form-control" name="filter_by">
                                <option value="" >Filter By</option>
                                 <option value="date_installed" >Date Installed</option>
                                 <option value="purchase_date">Date Purchased</option>
                                 <option value="expiry_date">Warranty Expiry Date</option>
                                 <!--<option value="first_repayment_date">First Repayment Date</option>-->
                               </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplelastname"></label>
                               <div class="input-group">
                               <input type="text" class="form-control datepicker2" name="start_date" value="<?php echo $start_date ; ?>" placeholder="Start Date">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                           </div>
                       </div>

                        <div class="col-md-3">
                             <div class="form-group">
                               <label for="exampleothernames"></label>
                               <div class="input-group">
                               <input type="text" class="form-control datepicker2" name="end_date" value="<?php echo $end_date ; ?>" placeholder="End Date">
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
                                             <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                         </span>
                                        </div>
                                    </div>
                        </div>
                        </form>


                        <div class="col-md-12">
                            <div class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                                <header class="panel-heading bg-red">
                                    Installed Asset -- <?php echo count($level1_data); ?> Records Returned

                                </header>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered" style="font-size:12px;">
                                        <thead class="bg-red"><tr>
                                            <th style="width: 10px">#</th>
                                            
                                            <th>Serial</th>
                                            <th>Name/Brand</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Available</th>
                                            <th>Date Installed</th>
                                            <th>Purchase Date</th>
                                            <th>Warranty</th>
                                            <th>Expiry Date</th>
                                            <th>Last Modified</th>
                                            <th>Installer</th>
                                             <th>Status</th>
                                              <th>More</th> 
                                        </tr></thead>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; ?>
                                        <?php foreach ($level1_data as $detail): ?>
                                         
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            
                                            <td><?php echo $detail['serial']; ?></td>
                                            <td><?php echo $detail['asset_name'] ; ?></td>
                                            <td><?php echo $detail['model'] ; ?></td>
                                            <td><?php echo $detail['asset_type'] ; ?></td>
                                            <td><?php echo $detail['available'] ; ?></td>
                                            <td><?php echo $detail['date_installed'] ; ?></td>
                                            <td><?php echo $detail['purchase_date'] ; ?></td>
                                            <td><?php echo $detail['warranty'] ; ?></td>
                                            <td><?php echo $detail['expiry_date'] ; ?></td> 
                                            <td><?php echo $detail['last_modified'] ; ?></td> 
                                            <td><?php echo $detail['installer_name'] ; ?></td>           
                                                          
                                            <?php
                                              if($detail['status']=="installed"){
                                            ?>
                                            <td><span class="badge bg-green"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                                            <?php
                                              if($detail['status']=="deployed"){
                                            ?>
                                            <td><span class="badge bg-orange"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                                            <?php
                                              if($detail['status']=="returned"){
                                            ?>
                                             <td><span class="badge bg-navy"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                                            <?php
                                              if($detail['status']=="decommissioned"){
                                            ?>
                                             <td><span class="badge bg-red"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                                                       
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_readonly/<?php echo $detail['lsid'] ?>/l2/<?php echo $uname ; ?>" class="btn btn-default btn-xs" role="button">More</a></td>                                           
                                        </tr>
                                        
                                        

                                        <?php $sn=$sn+1 ; ?>
                                        <?php endforeach ?>
                                    </tbody>

                                    </table>
                                    <div class="col-md-12 text-center">
                                        <ul class="pagination pagination-lg pager" id="myPager"></ul>
                                    </div>
                                    
                                </div><!-- /.panel-body -->

                            </div><!-- /.panel -->

                            
                        </div><!-- /.col -->
                        
                    </div><!-- /.row -->


                    