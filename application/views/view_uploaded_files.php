                    <?php
                      $uname = $this->session->userdata('uname');
                    ?>
                    <?php
                        echo validation_errors(); 
                    ?>
  
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <header class="panel-heading">
                                    Monthly Uploaded Deduction Reports

                                </header>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered" style="font-size:12px;">
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Oracle No</th>
                                            <th>Employee</th>
                                            <th>Credit</th>
                                            <th>Ministry</th>
                                            <th>Deduction Month/Year</th>
                                            <th>Narration</th>
                                            <th>File Name</th>
                                            <th>File ID</th>
                                            <th>Status</th>
                                            <th>Sum on Sheet</th>
                                            <th>Upload Date</th>
                                            <!--<th>Posted By</th>
                                            <th>Date applied</th>
                                             <th>Status</th>
                                              <th></th>-->
                                              
                                        </tr></thead>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; ?>
                                        <?php foreach ($upload_file_data as $detail): ?>
                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['oracle_number'] ; ?></td>
                                            <td><?php echo $detail['employee_name'] ; ?></td>
                                            <td><?php echo $detail['credit'] ; ?></td>
                                            <td><?php echo $detail['ministry_name'] ; ?></td>
                                            <td><?php echo $detail['month_year'] ; ?></td>
                                            <td><?php echo $detail['narration'] ; ?></td>
                                            <td><?php echo $detail['filename'] ; ?></td>
                                            <td><?php echo $detail['file_id'] ; ?></td>
                                            <td><?php echo $detail['status'] ; ?></td>
                                            <td><?php echo $detail['total_amount'] ; ?></td>
                                            <td><?php echo $detail['upload_date'] ; ?></td>
                                            <!--<td><?php echo $detail['booked_amount'] ; ?></td>
                                            <td><?php echo $detail['outstanding'] ; ?></td>
                                            <td><?php echo $detail['posted_by'] ; ?></td>
                                            <td><?php echo $detail['date_applied'] ; ?></td>-->
                                            <!--<?php
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
                                            <?php } ?>-->
                    
                                            <!--<td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_readonly/<?php echo $detail['lsid'] ?>/l2" class="btn btn-default" role="button">More</a></td>-->
                                            
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