
<section class="panel panel-primary">
    <header class="panel-heading">Spool Report(s)</header>
    <div class="panel-body">
    <?php
        if($report_type=="all"){
    ?>

    <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control" id="datepicker4" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
    </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control" id="datepicker5" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
         <label for="examplerole">Type</label>
         <div class="input-group">
         <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
           <option value="all" selected="selected">All</option>
           <option value="pending">Pending Loan Request</option>
           <option value="declined">Declined Loan Request</option>  
           <option value="approved">Approved Loan Request</option>
           <!--<option value="due">Due Payment(s)</option>-->            
         </select>
         <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
      </div>
   </div>

   <?php } else if($report_type=="pending"){ ?>

   	<div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control" id="datepicker4" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
    </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control" id="datepicker5" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
       <label for="examplerole">Type</label>
       <div class="input-group">
       <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
         <option value="all">All</option>
         <option value="pending" selected="selected">Pending Loan Request</option>
         <option value="declined">Declined Loan Request</option>  
         <option value="approved">Approved Loan Request</option>
         <!--<option value="due">Due Payment(s)</option>-->            
        </select>
         <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
        </div>
   </div>
   
   <?php } else if($report_type=="declined"){ ?>
      
      <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control" id="datepicker4" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
     </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control" id="datepicker5" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
        <label for="examplerole">Type</label>
        <div class="input-group">
        <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
          <option value="all">All</option>
          <option value="pending">Pending Loan Request</option>
          <option value="declined" selected="selected">Declined Loan Request</option>  
          <option value="approved">Approved Loan Request</option>
          <!--<option value="due">Due Payment(s)</option>-->            
        </select>
        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
     </div>
   </div>

  <?php } else if($report_type=="approved"){ ?>

  <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control" id="datepicker4" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
     </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control" id="datepicker5" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
     <label for="examplerole">Type</label>
      <div class="input-group">
      <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
        <option value="all">All</option>
        <option value="pending">Pending Loan Request</option>
        <option value="declined">Declined Loan Request</option>  
        <option value="approved" selected="selected">Approved Loan Request</option>
        <!--<option value="due">Due Payment(s)</option>-->            
      </select>
      <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
     </div>
  </div>

  <?php } else if(empty($report_type)){ ?>

  <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control" id="datepicker4" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
     </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control" id="datepicker5" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
      <label for="examplerole">Type</label>
      <div class="input-group">
      <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
        <option value="all">All</option>
        <option value="pending">Pending Loan Request</option>
        <option value="declined">Declined Loan Request</option>  
        <option value="approved">Approved Loan Request</option>
        <!--<option value="due">Due Payment(s)</option>-->            
      </select>
       <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
      </div>
   </div>
   
    <?php } ?>
    <input type="submit" name="submit" class="submit btn btn-default" value="Spool" style="margin:5px;"></input>
   <input type="submit" name="submit" class="submit btn btn-default" value="View" style="margin:5px;"></input>

    <table class="table table-striped table-bordered" style="font-size:12px;">
        <thead><tr>
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
            <th>Authorized</th>
            <th>Date applied</th>
            <th>Posted By</th>
             <th>Status</th>
              <!--<th>More</th>--> 
            </tr></thead>
            <tbody id="myTable">
             <?php $sn=1 ; ?>
            <?php foreach ($report_data as $detail): ?>

            <?php
            $oracle_no=$detail['oracle_number'];
            $ledger_balance=0 ;
            
             //compute outstanding for each employee
             $result1=mysql_query("select ledger_balance from deduction_report where oracle_number='$oracle_no' order by rid desc limit 1");
              while($row=mysql_fetch_array($result1))
              {
                 $ledger_balance=$row['ledger_balance'];
              }
            ?>

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
                 <!--<td><?php echo $ledger_balance ; ?></td>-->
                 <td><?php echo $detail['l2_approved'] ; ?></td>
                 <td><?php echo $detail['date_applied'] ; ?></td>
                 <td><?php echo $detail['posted_by'] ; ?></td>                          
                 <td><span class="badge bg-orange"><?php echo $detail['status'] ; ?></span></td>            
                 <!--<td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_readonly/<?php echo $detail['lsid'] ?>/l1/<?php echo $uname ; ?>" class="btn btn-default" role="button">More</a></td>-->                                           
             </tr>
             <?php } ?>
             <?php if($detail['status']=="declined"){ ?>
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
                <!--<td><?php echo $ledger_balance ; ?></td>-->
                <td><?php echo $detail['l2_approved'] ; ?></td>
                <td><?php echo $detail['date_applied'] ; ?></td>  
                <td><?php echo $detail['posted_by'] ; ?></td>               
                <td><span class="badge bg-red"><?php echo $detail['status'] ; ?></span></td>        
                <!--<td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_readonly/<?php echo $detail['lsid'] ?>/l1/<?php echo $uname ; ?>" class="btn btn-default" role="button">More</a></td>-->
                                            
                </tr>
                <?php } ?>
                <?php if($detail['status']=="approved"){ ?>
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
                    <!--<td><?php echo $ledger_balance ; ?></td>-->
                    <td><?php echo $detail['l2_approved'] ; ?></td>
                    <td><?php echo $detail['date_applied'] ; ?></td>  
                    <td><?php echo $detail['posted_by'] ; ?></td>                         
                    <td><span class="badge bg-green"><?php echo $detail['status'] ; ?></span></td>
                    <!--<td><a href="<?php echo site_url(); ?>/qlip_controller/fetch_postedloan_readonly/<?php echo $detail['lsid'] ?>/l1/<?php echo $uname ; ?>" class="btn btn-default" role="button">More</a></td>-->
                         
                     </tr>
                     <?php }  ?>
                     <?php $sn=$sn+1 ; ?>
                     <?php endforeach ?>
                 </tbody>

                </table>
                <div class="col-md-12 text-center">
                    <ul class="pagination pagination-lg pager" id="myPager"></ul>
                </div>

  </div>
 </section>
</form>