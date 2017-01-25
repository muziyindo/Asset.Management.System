                    <?php
                      $uname = $this->session->userdata('uname');
                      $empty1=1;
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
                       if($message=="upload_updated")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            File Upload successfully approved!
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="upload_declined")
                       {
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            File Upload declined!
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="loan_updated")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Loan successfully updated!.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="upload_updated_0")
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

                        <form action="<?php echo site_url('qlip_controller/search_qlip_uploads'); ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplerole"></label>
                               <select class="form-control" name="filter_by">
                                <option value="" >Filter By</option>
                                 <option value="pending" >Pending</option>
                                 <option value="approved">Approved</option>
                                 <option value="declined">Declined</option>
                                 <!--<option value="first_repayment_date">First Repayment Date</option>-->
                               </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplelastname"></label>
                               <div class="input-group">
                               <input type="text" class="form-control" id="datepicker3" name="start_date" value="<?php echo $start_date ; ?>" placeholder="Start Date">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                           </div>
                       </div>

                        <div class="col-md-3">
                             <div class="form-group">
                               <label for="exampleothernames"></label>
                               <div class="input-group">
                               <input type="text" class="form-control" id="datepicker2" name="end_date" value="<?php echo $end_date ; ?>" placeholder="End Date">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>     
                           </div> 
                        </div>
                        
                        <div class="col-md-3">
                                    <div class="form-group">       
                                          <label for="exampleothernames"></label> 
                                          <div class="input-group">
                                          <input type="text" class="form-control" id="" placeholder="Keyword" name="keyword" value="<?php echo $keyword ; ?>">
                                          <span class="input-group-btn">
                                             <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                         </span>
                                        </div>
                                    </div>
                        </div>
                      </form>

                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Files Uploaded By Qlip

                                </header>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered" style="font-size:12px;">
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>File ID</th>
                                            <th>File name</th>
                                            <th>Repayment Month</th>
                                            <th>Repayment Year</th>
                                            <th>Narration</th>
                                            <th>Date Uploaded</th>
                                            <th>Sum amount</th>
                                            <th>Status</th>
                                              <th>Action</th>
                                              
                                              
                                        </tr></thead>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; 
                                          
                                         ?>
                                        <?php foreach ($qlip_upload_data as $detail): ?>

                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['file_id'] ; ?></td>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/download_uploaded/<?php echo $detail['file_id'] ?>"><?php echo $detail['filename'] ; ?></a></td>
                                            <td><?php echo $detail['upload_month'] ; ?></td>
                                            <td><?php echo $detail['upload_year'] ; ?></td>
                                            <td><?php echo $detail['narration'] ; ?></td>
                                            <td><?php echo $detail['upload_date'] ; ?></td>
                                            <td><?php echo $detail['total_amount'] ; ?></td>

                                            <?php
                                              if($detail['status']=="declined"){
                                            ?>
                                            <td><span class="badge bg-red"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                                            <?php
                                              if($detail['status']=="pending"){
                                            ?>
                                            <td><span class="badge bg-orange"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                                            <?php
                                              if($detail['status']=="approved"){
                                            ?>
                                            <td><span class="badge bg-green"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>

                                            <?php
                                              if($detail['status']=="pending" && $detail['recon']!="yes"){
                                            ?>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/file_upload_primera/<?php echo $detail['file_id'] ?>/edit" class="btn btn-default" role="button" style="width:100px">Reconcile</a></td>
                                            <?php
                                              } else if($detail['status']=="pending" && $detail['recon']=="yes"){
                                            ?>
                                             <td><a href="<?php echo site_url(); ?>/qlip_controller/edit_uploaded/<?php echo $detail['file_id'] ?>/edit" class="btn btn-default" role="button" style="width:100px">Approve</a></td>
                                            <?php
                                              } else if($detail['status']=="declined" && $detail['recon']=="yes"){
                                            ?>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/edit_uploaded/<?php echo $detail['file_id'] ?>/edit" class="btn btn-default" role="button" style="width:100px">View</a></td>
                                            <?php
                                              } else if($detail['status']=="approved" && $detail['recon']=="yes"){
                                            ?>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/edit_uploaded/<?php echo $detail['file_id'] ?>/edit" class="btn btn-default" role="button" style="width:100px">View</a></td>
                                            <?php } ?>
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