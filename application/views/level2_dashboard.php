                   <?php
                      $uname = $this->session->userdata('uname');
                    ?>
                    <?php
                        error_reporting(E_ERROR|E_WARNING);
                        //echo validation_errors();   
                    ?>
                    <?php
                        echo validation_errors(); 
                    ?>
                   
                  <?php
                     $sum_credit=0 ;
                  ?>

                  

                   <div class="row">

                        <!--<div class="col-md-12">
                            earning graph start
                            <section class="panel panel-primary">
                                <header class="panel-heading">
                                    Qlip Loan Application Documentation
                                </header>
                                <div class="panel-body">
                                    <canvas id="linechart" width="600" height="330"></canvas>
                                    <?php  //$this->load->view('slide'); ?>
     
                                </div>
                                
                            </section>
                    </div>-->

                        <?php
                         if($director=="blanck")
                         {
                        ?>

                          <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Ledger Balance

                                </header>
                                <div class="panel-body">

                                <form action="<?php echo site_url('qlip_controller/open_level2_section/1/'); ?>" method="post" accept-charset="utf-8">
                                    <div class="form-group">
                                          
                                          <div class="input-group">
                                          <input type="text" class="form-control" id="" placeholder="Enter Oracle Number" name="search" value="">
                                          <span class="input-group-btn">
                                             <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                         </span>
                                        </div>
                                    </div>
                                </form>

                                </div>
                            </div>

                            <!--the form action is the file inside the include statement below-->
                            <form action="<?php echo site_url('qlip_controller/view_report_l2/1'); ?>" method="post" accept-charset="utf-8">
                             <?php 
                                echo include 'include_report.php';
                             ?>

                          </div>
                          

                       <?php } else if($director=="ledger_balance"){ ?>

                               

                        <div class="col-md-12">
                            <form action="<?php echo site_url('qlip_controller/open_level2_section/1/'); ?>" method="post" accept-charset="utf-8">
                                    <div class="form-group">
                                          
                                          <div class="input-group">
                                          <input type="text" class="form-control" id="" placeholder="Enter Oracle Number" name="search" value="">
                                          <span class="input-group-btn">
                                             <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                         </span>
                                        </div>
                                    </div>
                                </form>
                             <div id="page-wrap"><!--for Printing-->
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Ledger Balance

                                </header>
                                <div class="panel-body">

                                    <?php foreach ($breakdown_data as $detail): ?>
                                    <table class="table table-condensed" style="font-size:12px; width:300px;">
                                        <tr><td style="width:150px">Tenure</td><td style="width:150px"><?php echo  $detail['tenure'] ; ?></td></tr>
                                        <tr class="warning"><td style="width:150px">Repayment Amount</td><td style="width:150px"><?php echo  $detail['repayment_amount'] ; ?></td></tr>
                                        <tr><td style="width:150px">Interest</td><td style="width:150px"><?php echo  $detail['interest'] ; ?></td></tr>
                                        <tr class="danger"><td style="width:150px">Customer Name</td><td style="width:150px"><?php echo  $detail['employee_name'] ; ?></td></tr>
                                        <tr class="success"><td style="width:150px">Oracle Number</td><td style="width:150px"><?php echo  $detail['oracle_number'] ; ?></td></tr>
                                        <tr><td style="width:150px">Date Disbursed</td><td style="width:150px"><?php echo  $detail['date_disbursed'] ; ?></td></tr>
                                        <tr><td style="width:150px">First Repayment Date</td><td style="width:150px"><?php echo  $detail['first_repayment_date'] ; ?></td></tr>
                                        <tr class="active"><td style="width:150px">Principal Loan Amount</td><td style="width:150px"><?php echo  $detail['booked_amount'] ; ?></td></tr>
                                    </table>
                                    <!--<a href="#" class="btn btn-default" role="button" style="width:150px">Tenure</a>=
                                    <a href="#" class="btn btn-default" role="button" style="width:200px"><?php echo  $detail['tenure'] ; ?></a><br><br>
                                    <a href="#" class="btn btn-default" role="button" style="width:150px">Repayment Amount</a>=
                                    <a href="#" class="btn btn-default" role="button" style="width:200px"><?php echo  $detail['repayment_amount'] ; ?></a><br><br>
                                    <a href="#" class="btn btn-default" role="button" style="width:150px">Customer Name</a>=
                                    <a href="#" class="btn btn-default" role="button" style="width:200px"><?php echo  $detail['employee_name'] ; ?></a><br><br>
                                    <a href="#" class="btn btn-default" role="button" style="width:150px">Oracle Number</a>=
                                    <a href="#" class="btn btn-default" role="button" style="width:200px"><?php echo  $detail['oracle_number'] ; ?></a><br><br>
                                    <a href="#" class="btn btn-default" role="button" style="width:150px">Date Disbursed</a>=
                                    <a href="#" class="btn btn-default" role="button" style="width:200px"><?php //echo  ($booked_sum-$sum_credit); ?></a><br><br>
                                    <a href="#" class="btn btn-default" role="button" style="width:150px">First Repayment Date</a>=
                                    <a href="#" class="btn btn-default" role="button" style="width:200px"><?php echo  $detail['first_repayment_date'] ; ?></a><br><br>
                                    <a href="#" class="btn btn-default" role="button" style="width:150px">Principal Loan Amount</a>=
                                    <a href="#" class="btn btn-default" role="button" style="width:200px"><?php echo  $detail['booked_amount'] ; ?></a><br><br>-->
                                    <?php break ; ?>
                                    <?php endforeach ?>

                                    <table class="table table-bordered table-striped" style="font-size:12px;">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Entry Date</th>
                                            <th>Description</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            <!--<th>Credit</th>
                                            <th>Month_year</th>-->  
                                        </tr></thead>
                                        <tbody id="myTable_ledger">
                                         <?php $sn=1 ; ?>
                                        <?php foreach ($breakdown_data as $detail): ?>
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo str_replace("_", "/", $detail['month_year']); ?></td>
                                            <td><?php echo $detail['narration']; ?></td>
                                            <td>0.00</td>
                                            <td><?php echo number_format($detail['credit'],2) ; ?></td>
                                            <td><?php echo number_format($detail['ledger_balance'],2); ?></td>
                                            <!--<td><?php echo $detail['credit'] ; ?></td>
                                            <td><?php echo $detail['month_year'] ; ?></td>-->
                                        </tr>
                                        <?php $sn=$sn+1 ; ?>
                                         
                                        
                                        <?php endforeach ?>
                                    </tbody>

                                    </table>

                                    <a href="#" class="btn btn-default" role="button">C/F = <?php echo number_format($detail['ledger_balance'],2); ?> </a>
                                    
                                    <div class="col-md-12 text-center">
                                     <ul class="pagination pagination-lg pager" id="myPager"></ul>
                                    </div>
                                </div><!-- /.panel-body -->

                            </div><!-- /.panel -->
                            </div><!--end for print-->
                            <a href="#" class="btn btn-default" role="button" onclick="printContent('page-wrap');">PRINT </a>

                            
                        </div><!-- /.col -->

                        <?php } ?>

                        
                    </div>