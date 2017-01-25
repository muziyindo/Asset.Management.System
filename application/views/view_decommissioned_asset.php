                    <?php
                      $uname = $this->session->userdata('uname');
                      $role = $this->session->userdata('role');
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
                       if($message=="asset_returned")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Asset successfully Returned!.
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
                       if($message=="decommissioned")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Asset decommissioned successfully!
                        </div>
                    <?php
                       }
                   ?>
  
                    <div class="row">
                        <!--Search FIlter-->
                        <form action="<?php echo site_url('qlip_controller/search_filter_decommissioned/'); ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplerole"></label>
                               <select class="form-control" name="filter_by">
                                <option value="" >Filter By</option>
                                 <option value="date_decommissioned" >Date Decommissioned</option>
                                 <!--<option value="date_approved">Date Approved</option>
                                 <option value="date_disbursed">Date Disbursed</option>
                                 <option value="first_repayment_date">First Repayment Date</option>-->
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
                                    Decommissioned Asset -- <?php echo count($level1_data); ?> Records Returned

                                </header>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered" style="font-size:12px;">
                                        <thead class="bg-red"><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Serial No</th>
                                            <th>Organisation</th>
                                            <th>Region</th>
                                            <th>Employee Name</th>
                                            <th>Specifications</th>
                                            <th>Department</th>
                                            <th>request Date</th>
                                            <th>Tag No</th>
                                            <th>Status</th>
                                            <th>Deployed By</th>
                                            <th>Date Decommissioned</th>
                                             <th>Decommissioned By</th>
                                             <!--<th>Decommission</th>
                                              <th>More</th> -->
                                        </tr></thead>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; ?>
                                        <?php foreach ($level1_data as $detail): ?>
                                         
                      <?php
                        	//get install_id using deploy_id
                        	$deploy_id = $detail['deploy_id'];
                        	$sql = "select * from deployed where did = '$deploy_id'";
                        	$query = $this->db->query($sql);
                        	foreach ($query->result() as $val_user)
              				{
                    			$serial_no = $val_user->serial_no ;
                    			//echo $install_id;
              				}
                        	
                    ?>

                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['serial_no'] ; ?></td>
                                            <td><?php echo $detail['organisation']; ?></td>
                                            <td><?php echo $detail['region'] ; ?></td>
                                            <td><?php echo $detail['employee_name'] ; ?></td>
                                            <td><?php echo $detail['specifications'] ; ?></td>
                                            <td><?php echo $detail['department'] ; ?></td>
                                            <td><?php echo $detail['request_date'] ; ?></td>
                                            <td><?php echo $detail['tag_no'] ; ?></td>
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
                                            <td><?php echo $detail['deployed_by'] ; ?></td> 
                                            <td><?php echo $detail['date_decommissioned'] ; ?></td>   
                                            <td><?php echo $detail['decommissioned_by'] ; ?></td> 
                                            
                                            <!--<?php
                                              if($detail['status']=="deployed" && $role=="level2"){
                                            ?>
                                            <td>No Action</td>
                                            <td>No Action</td>
                                            <?php } ?>

                                            <?php
                                              if($detail['status']=="decommissioned" && $role=="level2"){
                                            ?>
                                            <td>No Action</td>
                                            <td>No Action</td>
                                            <?php } ?>

                                            <?php
                                              if($detail['status']=="returned" && $role=="level2"){
                                            ?>
                                             <td><a href="<?php echo site_url(); ?>/qlip_controller/insert_decommissioned/<?php echo $detail['rid']; ?>/<?php echo $detail['deploy_id'] ; ?>/<?php echo $serial_no ; ?>" class="btn btn-default btn-xs" role="button">Decommission</a></td>
                                             <td><a href="<?php echo site_url(); ?>/qlip_controller/view_deploy_returned/<?php echo $detail['rid']; ?>/<?php echo $detail['deploy_id'] ; ?>/<?php echo $serial_no ; ?>" class="btn btn-default btn-xs" role="button">Deploy</a></td>
                                            <?php } ?>           
                                                                  
                                            
                                            <?php
                                              if($detail['status']=="deployed" && $role=="level1"){
                                            ?>
                                            <td>No Action</td>
                                            <td>No Action</td>
                                            <?php } ?>

                                            <?php
                                              if($detail['status']=="decommissioned" && $role=="level1"){
                                            ?>
                                            <td>No Action</td>
                                            <td>No Action</td>
                                            <?php } ?>


                                            <?php
                                              if($detail['status']=="returned" && $role=="level1"){
                                            ?>
                                            <td>No Action</td>
                                             <td><a href="<?php echo site_url(); ?>/qlip_controller/view_deploy_returned/<?php echo $detail['rid']; ?>/<?php echo $detail['deploy_id'] ; ?>/<?php echo $serial_no ; ?>" class="btn btn-default btn-xs" role="button">Deploy</a></td>

                                            <?php } ?> -->
                                                                                     
                                        </tr>

                                        <?php $sn=$sn+1 ; ?>
                                        <?php endforeach ?>
                                    </tbody>

                                    </table>
                                    <div class="col-md-12 text-center">
                                        <ul class="pagination pagination-lg pager" id="myPager"></ul>
                                    </div>
                                    <!--<div class="table-foot">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                    </div>-->
                                </div><!-- /.panel-body -->

                            </div><!-- /.panel -->

                            
                        </div><!-- /.col -->
                        
                    </div><!-- /.row -->