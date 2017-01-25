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
                       if($message=="connect_failed")
                       {
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Couldnt connect to T-24 Server!.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="login_failed")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            There was an issue login in to T-24 Server!.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="upload_failed")
                       {
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Couldn't upload to T-24 Server!
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="upload_success")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            File has been successfully uploaded to T-24!
                        </div>
                    <?php
                       }
                   ?>
  
                    
                    <div class="row">

                       <!--<form action="<?php echo site_url('qlip_controller/search_filter_primera'); ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplerole"></label>
                               <select class="form-control" name="filter_by">
                                <option value="" >Filter By</option>
                                 <option value="date_applied" >Date Applied</option>
                                 <option value="date_approved">Date Approved</option>
                                 <option value="date_disbursed">Date Disbursed</option>
                                 <option value="first_repayment_date">First Repayment Date</option>
                               </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplelastname"></label>
                               <div class="input-group">
                               <input type="text" class="form-control" id="datepicker4" name="start_date" value="<?php echo $start_date ; ?>" placeholder="Start Date">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                           </div>
                       </div>

                        <div class="col-md-3">
                             <div class="form-group">
                               <label for="exampleothernames"></label>
                               <div class="input-group">
                               <input type="text" class="form-control" id="datepicker5" name="end_date" value="<?php echo $end_date ; ?>" placeholder="End Date">
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
                      </form>-->

                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Pending T-24 PUSH

                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered" style="font-size:12px;">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Customer ID</th>
                                            <th>Oracle No</th>
                                            <th>Name</th>
                                            <th>Date approved</th>
                                            <th>Date Pushed</th>
                                            <th>Response</th>
                                            <th>Status</th>
                                              <th>Action</th>
                                              
                                        </tr>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; ?>
                                        <?php foreach ($primera_data as $detail): ?>
                                         <?php if($detail['status']=="pending"){ ?>
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['lsid'] ; ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['customer_name'] ; ?></td>
                                            <td><?php echo $detail['date_approved'] ; ?></td>
                                            <td><?php echo $detail['date_pushed'] ; ?></td>
                                            <td><?php echo $detail['response'] ; ?></td>
                                            <td><span class="badge bg-orange"><?php echo $detail['status'] ; ?></span></td>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/push_to_t24/<?php echo $detail['lsid'] ?>/<?php echo $detail['pid'] ?>" class="btn btn-default btn-xs" role="button">Push</a></td>
                                        </tr>
                                         <?php
                                            $sn=$sn+1 ; 
                                           } 
                                         ?>
                                        
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

                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    PUSHED TO T-24 SUCCESSFULLY

                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered" style="font-size:12px;">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Customer ID</th>
                                            <th>Oracle No</th>
                                            <th>Name</th>
                                            <th>Date approved</th>
                                            <th>Date Pushed</th>
                                            <th>Response</th>
                                            <th>Status</th>
                                              <!--<th>Action</th>-->
                                              
                                        </tr>
                                        <tbody id="myTable4">
                                         <?php $sn3=1 ; ?>
                                        <?php foreach ($primera_data as $detail): ?>
                                        <?php if($detail['status']=="success"){ ?>
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['lsid'] ; ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['customer_name'] ; ?></td>
                                            <td><?php echo $detail['date_approved'] ; ?></td>
                                            <td><?php echo $detail['date_pushed'] ; ?></td>
                                            <td><?php echo $detail['response'] ; ?></td>
                                            <td><span class="badge bg-green"><?php echo $detail['status'] ; ?></span></td>
                                            <!--<td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_primera_readonly/<?php echo $detail['lsid'] ?>/l1" class="btn btn-default btn-xs" role="button">More</a></td>-->
                                        </tr>
                                         <?php
                                            $sn3=$sn3+1 ;
                                           } 
                                         ?>
                                        
                                        <?php endforeach ?>
                                    </tbody>

                                    </table>
                                    <div class="col-md-12 text-center">
                                        <ul class="pagination pagination-lg pager" id="myPager4"></ul>
                                    </div>
                                    
                                </div><!-- /.panel-body -->

                            </div><!-- /.panel -->

                            
                        </div><!-- /.col -->
                        
                    </div><!-- /.row -->