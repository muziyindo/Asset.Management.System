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
                       if($message=="loan_declined")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Loan successfully declined!.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="loan_approved")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Loan successfully approved!.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="loan_approved11")
                       {
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            You can't approve twice for the same person!
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="view_mode_on")
                       {
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            You can't access this record now, another user is currently viewing it.
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="view_mode_off")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            View-mode is now unlocked.
                        </div>
                    <?php
                       }
                   ?>

  
                    
                    <div class="row">

                       <form action="<?php echo site_url('qlip_controller/search_filter_primera'); ?>" method="post" accept-charset="utf-8">
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
                      </form>

                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Pending Loan Request

                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered" style="font-size:12px;">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Oracle No</th>
                                            <th>Name</th>
                                            <!--<th>Loan Purpose</th>
                                            <th>Loan Type</th>-->
                                            <th>Loan Amount</th>
                                            <th>Loan Tenure Months</th>
                                            <th>Disbursed</th>
                                            <th>Booked</th>
                                            <!--<th>Outstanding</th>-->
                                            <th>Date applied</th>
                                            <th>Date approved</th>
                                            <th>Date declined</th>
                                            <th>Date Disbursed</th>
                                            <th>First Repayment Date</th>
                                            <th>Status</th>
                                              <th>More</th>
                                              
                                        </tr>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; ?>
                                        <?php foreach ($primera_data as $detail): ?>
                                         <?php if($detail['status']=="pending"){ ?>
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['sname']." ".$detail['mname']." ".$detail['fname'] ; ?></td>
                                            <!--<td><?php echo $detail['purp_of_loan'] ; ?></td>
                                            <td><?php echo $detail['loan_type'] ; ?></td>-->
                                            <td><?php echo $detail['loan_amount'] ; ?></td>
                                            <td><?php echo $detail['loan_tenure_months'] ; ?></td>
                                            <td><?php echo $detail['disbursed_amount'] ; ?></td>
                                            <td><?php echo $detail['booked_amount'] ; ?></td>
                                            <!--<td><?php echo $detail['outstanding'] ; ?></td>-->
                                            <td><?php echo $detail['date_applied'] ; ?></td>
                                            <td><?php echo $detail['date_approved'] ; ?></td>
                                            <td><?php echo $detail['date_declined'] ; ?></td>
                                            <td><?php echo $detail['date_disbursed'] ; ?></td>
                                            <td><?php echo $detail['first_repayment_date'] ; ?></td>
                                            <td><span class="badge bg-orange"><?php echo $detail['status'] ; ?></span></td>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_primera_readonly/<?php echo $detail['lsid'] ?>/l1" class="btn btn-default btn-xs" role="button">More</a></td>
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
                                    Declined Loan

                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered" style="font-size:12px;">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Oracle No</th>
                                            <th>Name</th>
                                            <!--<th>Loan Purpose</th>
                                            <th>Loan Type</th>-->
                                            <th>Loan Amount</th>
                                            <th>Loan Tenure Months</th>
                                            <th>Disbursed</th>
                                            <th>Booked</th>
                                            <!--<th>Outstanding</th>-->
                                            <th>Date applied</th>
                                            <th>Date Approved</th>
                                            <th>Date Declined</th>
                                            <th>Date Disbursed</th>
                                            <th>First Repayment Date</th>
                                             <th>Status</th>
                                              <th>More</th>
                                              
                                        </tr>
                                        <tbody id="myTable2">
                                         <?php $sn2=1 ; ?>
                                        <?php foreach ($primera_data as $detail): ?>
                                        <?php if($detail['status']=="declined"){ ?>
                                        <tr>
                                            <td><?php echo $sn2."." ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['sname']." ".$detail['mname']." ".$detail['fname'] ; ?></td>
                                            <!--<td><?php echo $detail['purp_of_loan'] ; ?></td>
                                            <td><?php echo $detail['loan_type'] ; ?></td>-->
                                            <td><?php echo $detail['loan_amount'] ; ?></td>
                                            <td><?php echo $detail['loan_tenure_months'] ; ?></td>
                                            <td><?php echo $detail['disbursed_amount'] ; ?></td>
                                            <td><?php echo $detail['booked_amount'] ; ?></td>
                                            <!--<td><?php echo $detail['outstanding'] ; ?></td>-->
                                            <td><?php echo $detail['date_applied'] ; ?></td>
                                            <td><?php echo $detail['date_approved'] ; ?></td>
                                            <td><?php echo $detail['date_declined'] ; ?></td>
                                            <td><?php echo $detail['date_disbursed'] ; ?></td>
                                            <td><?php echo $detail['first_repayment_date'] ; ?></td>
                                            <td><span class="badge bg-red"><?php echo $detail['status'] ; ?></span></td>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_primera_readonly/<?php echo $detail['lsid'] ?>/l1" class="btn btn-default btn-xs" role="button">More</a></td>
                                        </tr>
                                         <?php
                                          $sn2=$sn2+1 ;
                                           } 
                                         ?>
                                        
                                        <?php endforeach ?>
                                    </tbody>

                                    </table>
                                    <div class="col-md-12 text-center">
                                        <ul class="pagination pagination-lg pager" id="myPager2"></ul>
                                    </div>
                                    
                                </div><!-- /.panel-body -->

                            </div><!-- /.panel -->

                            
                        </div><!-- /.col -->
                        
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Approved Loan

                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered" style="font-size:12px;">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Oracle No</th>
                                            <th>Name</th>
                                            <!--<th>Loan Purpose</th>
                                            <th>Loan Type</th>-->
                                            <th>Loan Amount</th>
                                            <th>Loan Tenure Months</th>
                                            <th>Disbursed</th>
                                            <th>Booked</th>
                                            <!--<th>Outstanding</th>-->
                                            <th>Date applied</th>
                                            <th>Date Approved</th>
                                            <th>Date Declined</th>
                                            <th>Date Disbursed</th>
                                            <th>First Repayment Date</th>
                                             <th>Status</th>
                                              <th>More</th>
                                              
                                        </tr>
                                        <tbody id="myTable4">
                                         <?php $sn3=1 ; ?>
                                        <?php foreach ($primera_data as $detail): ?>
                                        <?php if($detail['status']=="approved"){ ?>
                                        <tr>
                                            <td><?php echo $sn3."." ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['sname']." ".$detail['mname']." ".$detail['fname'] ; ?></td>
                                            <!--<td><?php echo $detail['purp_of_loan'] ; ?></td>
                                            <td><?php echo $detail['loan_type'] ; ?></td>-->
                                            <td><?php echo $detail['loan_amount'] ; ?></td>
                                            <td><?php echo $detail['loan_tenure_months'] ; ?></td>
                                            <td><?php echo $detail['disbursed_amount'] ; ?></td>
                                            <td><?php echo $detail['booked_amount'] ; ?></td>
                                            <!--<td><?php echo $detail['outstanding'] ; ?></td>-->
                                            <td><?php echo $detail['date_applied'] ; ?></td>
                                            <td><?php echo $detail['date_approved'] ; ?></td>
                                            <td><?php echo $detail['date_declined'] ; ?></td>
                                            <td><?php echo $detail['date_disbursed'] ; ?></td>
                                            <td><?php echo $detail['first_repayment_date'] ; ?></td>
                                            <td><span class="badge bg-green"><?php echo $detail['status'] ; ?></span></td>
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_primera_readonly/<?php echo $detail['lsid'] ?>/l1" class="btn btn-default btn-xs" role="button">More</a></td>
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