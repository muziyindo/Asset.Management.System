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

                        <form action="<?php echo site_url('qlip_controller/view_due_payments_l2/1'); ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label for="examplerole"></label>
                               <select class="form-control" name="filter_by">
                                
                                 <option value="due_date" >Due Date</option>
                                 <option value="last_repayment_date">Last Repayment Date</option>
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
                                          <input type='submit' name='btn_submit' class="btn btn-default" value="View"></input>
                                          <input type='submit' name='btn_submit' class="btn btn-default" value="Spool"></input>
                                        </div>
                                    </div>
                        </div>

                        
                      </form>

                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Due Payments 

                                </header>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered" style="font-size:12px;">
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Oracle No</th>
                                            <th>Name</th>
                                            <!--<th>Pay Day</th>
                                            <th>Loan Purpose</th>
                                            <th>Loan Type</th>-->
                                            <th>Booked Amount</th>
                                            <th>Loan Tenure Months</th>
                                            <th>Monthly Repayments</th>
                                            <!--<th>Disbursed</th>
                                            <th>Booked</th>-->
                                            <th>Amount Credited</th>
                                            <th>Balance</th>
                                            <th>First Repayment Date</th>
                                            <th>Last Repayment Date</th>
                                            <th>Due Date</th>
                                            <!--<th>Current Date</th>
                                            <th>Date applied</th>
                                            <th>Date Approved</th>
                                            <th>Date Declined</th>
                                            <th>Date Disbursed</th>
                                            <th>First Repayment Date</th>
                                             <th>Status</th>-->
                                              
                                              
                                        </tr></thead>
                                        <tbody id="myTable3">
                                         <?php $sn=1 ; 
                                          
                                         ?>
                                        <?php foreach ($due_data as $detail): ?>
                                         

                                         <?php
                                              $indicator=0 ;
                                             $due_date = $detail['due_date'] ;
                                             $oracle_number = $detail['oracle_number'] ;
                                             $result1=mysql_query("select credit from deduction_report where last_repayment_date='$due_date' and oracle_number='$oracle_number' and checked='yes'");
                                             while($row=mysql_fetch_array($result1))
                                             {
                                                $credit=$row['credit'];
                                                if(!empty($credit))
                                                {
                                                  $indicator=1 ;
                                                }
                                             }

                                         ?>
                                        
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['employee_name'] ; ?></td>
                                            
                                            <!--<td><?php echo $detail['pay_day'] ; ?></td>
                                            <td><?php echo $detail['purp_of_loan'] ; ?></td>
                                            <td><?php echo $detail['loan_type'] ; ?></td>-->
                                            <td><?php echo $detail['booked_amount'] ; ?></td>
                                            <td><?php echo $detail['tenure'] ; ?></td>
                                            <td><?php echo number_format($detail['repayment_amount'],2) ; ?></td>
                                             <td><?php echo number_format($detail['credit'],2) ; ?></td>
                                            <td><?php echo number_format($detail['balance'],2); ?></td>

                                            <td><?php echo date('F j, Y', strtotime($detail['first_repayment_date'])); ?></td>
                                            <td><?php echo date('F j, Y', strtotime($detail['last_repayment_date'])); ?></td>
                                            <?php 
                                            if($indicator==1){
                                            ?>
                                            <td><span class="fa fa-check-square-o"><?php echo date('F j, Y', strtotime($detail['due_date'])); ?></span></td>
                                            <?php } else if ($indicator==0) {
                                            ?>
                                            <td><?php echo date('F j, Y', strtotime($detail['due_date'])); ?></td>
                                            <?php } ?>
                                            <!--<td><?php echo date('Y-m-d') ; ?></td>-->
                                        </tr>
                                        
                                        <?php $sn=$sn+1 ; ?>
                                        <?php endforeach ?>
                                    </tbody>

                                    </table>
                                     <div class="col-md-12 text-center">
                                     <ul class="pagination pagination-lg pager" id="myPager3"></ul>
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