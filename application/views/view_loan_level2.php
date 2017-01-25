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
                       if($message=="loan_authorized")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Loan successfully authorized and forwarded to primera-credit!.
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
                       if($message=="loan_rejected")
                       {
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Loan rejected!
                        </div>
                    <?php
                       }
                   ?>

                   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="loan_updated_0")
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

                        <form action="<?php echo site_url('qlip_controller/search_filter/'.$empty1); ?>" method="post" accept-charset="utf-8">
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
                               <input type="text" class="form-control" id="datepicker1" name="start_date" value="<?php echo $start_date ; ?>" placeholder="Start Date">
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
                                    Loan applications

                                </header>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered" style="font-size:12px;">
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Oracle No</th>
                                            <th>Name</th>
                                            <th>Monthly Salary</th>
                                            <!--<th>Pay Day</th>
                                            <th>Loan Purpose</th>
                                            <th>Loan Type</th>-->
                                            <th>Loan Amount</th>
                                            <th>Booked Amount</th>
                                            <th>Loan Tenure Months</th>
                                            <!--<th>Disbursed</th>
                                            <th>Booked</th>
                                            <th>Outstanding</th>-->
                                            <th>Authorized</th>
                                            <th>Posted By</th>
                                            <th>Date applied</th>
                                            <th>Date Approved</th>
                                            <th>Date Declined</th>
                                            <th>Date Disbursed</th>
                                            <th>First Repayment Date</th>
                                             <th>Status</th>
                                              <th></th>
                                              
                                        </tr></thead>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; 
                                          
                                         ?>
                                        <?php foreach ($level2_data as $detail): ?>

                                        <?php
                                        $oracle_no=$detail['oracle_number'];
                                        $sum1=0 ;
                                        
                                         //compute outstanding for each employee
                                         $result1=mysql_query("select credit from deduction_report where oracle_number='$oracle_no'");
                                          while($row=mysql_fetch_array($result1))
                                          {
                                             $sum1=$sum1+$row['credit'];
                                          }
                                        ?>
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['sname']." ".$detail['mname']." ".$detail['fname'] ; ?></td>
                                            <td><?php echo $detail['monthly_salary'] ; ?></td>
                                            <!--<td><?php echo $detail['pay_day'] ; ?></td>
                                            <td><?php echo $detail['purp_of_loan'] ; ?></td>
                                            <td><?php echo $detail['loan_type'] ; ?></td>-->
                                            <td><?php echo $detail['loan_amount'] ; ?></td>
                                            <td><?php echo $detail['booked_amount'] ; ?></td>
                                            <td><?php echo $detail['loan_tenure_months'] ; ?></td>
                                            <!--<td><?php echo $detail['disbursed_amount'] ; ?></td>
                                            <td><?php echo $detail['booked_amount'] ; ?></td>
                                            <td><?php echo ($detail['booked_amount']-$sum1) ; ?></td>-->
                                            <td><?php echo $detail['l2_approved'] ; ?></td>
                                            <td><?php echo $detail['posted_by'] ; ?></td>
                                            <td><?php echo $detail['date_applied'] ; ?></td>
                                            <td><?php echo $detail['date_approved'] ; ?></td>
                                            <td><?php echo $detail['date_declined'] ; ?></td>
                                            <td><?php echo $detail['date_disbursed'] ; ?></td>
                                            <td><?php echo $detail['first_repayment_date'] ; ?></td>
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
                                              if($detail['status']=="rejected"){
                                            ?>
                                             <td><span class="badge bg-red"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                                            <?php
                                              if($detail['status']=="approved"){
                                            ?>
                                            <td><span class="badge bg-green"><?php echo $detail['status'] ; ?></span></td>
                                            <?php } ?>
                    
                                            <td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_readonly/<?php echo $detail['lsid'] ?>/l2" class="btn btn-default btn-xs" role="button">More</a></td>
                                            
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