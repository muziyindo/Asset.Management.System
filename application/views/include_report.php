
<section class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
    <header class="panel-heading bg-red">Spool Report(s)</header>
    <div class="panel-body">
    <?php
        if($report_type=="all"){
    ?>

    <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker2" id="datepicker1" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
    </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control datepicker2" id="datepicker2" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
         <label for="examplerole">Type</label>
         <div class="input-group">
         <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
           <option value="all" selected="selected">All</option>
           <option value="installed">Installed</option>
           <option value="deployed">Deployed</option>  
           <option value="returned">Returned</option>
           <option value="decommissioned">Decommissioned</option>
           

           <!--<option value="due">Due Payment(s)</option>-->            
         </select>
         <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
      </div>
   </div>

   <?php } else if($report_type=="installed"){ ?>

   	<div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker2" id="datepicker1" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
    </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control datepicker2" id="datepicker2" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
       <label for="examplerole">Type</label>
       <div class="input-group">
       <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
         <option value="all">All</option>
           <option value="installed" selected>Installed</option>
           <option value="deployed">Deployed</option>  
           <option value="returned">Returned</option>
           <option value="decommissioned">Decommissioned</option>
         <!--<option value="due">Due Payment(s)</option>-->            
        </select>
         <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
        </div>
   </div>
   
   <?php } else if($report_type=="deployed"){ ?>
      
      <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker2" id="datepicker1" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
     </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control datepicker2" id="datepicker2" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
        <label for="examplerole">Type</label>
        <div class="input-group">
        <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
          <option value="all" >All</option>
           <option value="installed">Installed</option>
           <option value="deployed" selected>Deployed</option>  
           <option value="returned">Returned</option>
           <option value="decommissioned">Decommissioned</option>
          <!--<option value="due">Due Payment(s)</option>-->            
        </select>
        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
     </div>
   </div>

  <?php } else if($report_type=="returned"){ ?>

  <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker2" id="datepicker1" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
     </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control datepicker2" id="datepicker2" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
     <label for="examplerole">Type</label>
      <div class="input-group">
      <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
        <option value="all">All</option>
           <option value="installed">Installed</option>
           <option value="deployed">Deployed</option>  
           <option value="returned" selected>Returned</option>
           <option value="decommissioned">Decommissioned</option>
        <!--<option value="due">Due Payment(s)</option>-->            
      </select>
      <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
     </div>
  </div>

  <?php } else if($report_type=="decommissioned"){ ?>

  <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker2" id="datepicker1" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
     </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control datepicker2" id="datepicker2" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
     <label for="examplerole">Type</label>
      <div class="input-group">
      <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
        <option value="all">All</option>
           <option value="installed">Installed</option>
           <option value="deployed">Deployed</option>  
           <option value="returned">Returned</option>
           <option value="decommissioned" selected>Decommissioned</option>
        <!--<option value="due">Due Payment(s)</option>-->            
      </select>
      <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
     </div>
  </div>

  <?php } else if(empty($report_type)){ ?>

  <div class="form-group">
            <label for="examplelastname">Start Date</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker2" id="datepicker1" name="start_date" value="<?php echo $start_date ; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
     </div>

    <div class="form-group">
        <label for="exampleothernames">End Date</label>
        <div class="input-group">
        <input type="text" class="form-control datepicker2" id="datepicker2" name="end_date" value="<?php echo $end_date ; ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>     
    </div> 
        
    <div class="form-group">
      <label for="examplerole">Type</label>
      <div class="input-group">
      <select class="form-control" name="report_type" value="<?php echo $_POST['bank_account'] ; ?>" required>
        <option value="all">All</option>
           <option value="installed">Installed</option>
           <option value="deployed">Deployed</option>  
           <option value="returned">Returned</option>
           <option value="decommissioned">Decommissioned</option>
        <!--<option value="due">Due Payment(s)</option>-->            
      </select>
       <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
      </div>
   </div>
   
    <?php } ?>
    <input type="submit" name="submit" class="submit btn btn-default" value="Spool" style="margin:5px;"></input>
   <input type="submit" name="submit" class="submit btn btn-default" value="View" style="margin:5px;"></input>

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
                                        <?php foreach ($report_data as $detail): ?>
                                         
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

  </div>
 </section>
</form>