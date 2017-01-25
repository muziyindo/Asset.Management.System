                     <?php
                         $uname = $this->session->userdata('uname');
                        error_reporting(E_ERROR|E_WARNING);
                        echo validation_errors(); 
                        echo form_open('qlip_controller/update_loan_primera/'.$postedloan_data['lsid']);

                        $message=$this->session->flashdata('message');
                       if($message=="loan_inserted")
                       {
                        echo ('<script>setTimeout(function() { alert("Loan application successful!"); }, 1);</script>');
                       }

                     ?>
<!--disable all inputs in this div-->
<form role="form">
  <!--<?php
    $role = $this->session->userdata('role');
    if($role=="level2"){
      if($postedloan_data['status']=="pending"||$postedloan_data['status']=="declined"){
        echo ('<input type="button" class="btn btn-default" value="Edit-Mode" onclick="disableall1()"></input><input type="submit" name="btn_update" class="btn btn-default" value="Update"></input><br><br>');
       }
    }
  ?>
  <?php
    $role = $this->session->userdata('role');
    if($role=="level1"){
      if($postedloan_data['status']=="declined"){
        echo ('<input type="button" class="btn btn-default" value="Edit-Mode" onclick="disableall1()"></input><input type="submit" name="btn_update" class="btn btn-default" value="Re-Apply"></input><br><br>');
       }
    }
  ?>-->
  

<div id="l1_loan">
<div class="row">
                <div class="col-lg-6">
                <?php
                if($postedloan_data['status']=="pending"){ ?>
                <label for="exampleusername" class="fa fa-star">status</label>
                <label for="exampleusername" class="badge bg-orange">pending</label>
                <?php } else if($postedloan_data['status']=="declined"){  ?>
                <label for="exampleusername" class="fa fa-star">status</label>
                <label for="exampleusername" class="badge bg-red">declined</label>
                
                <?php } else if($postedloan_data['status']=="approved"){  ?>
                <label for="exampleusername" class="fa fa-star">status</label>
                <label for="exampleusername" class="badge bg-green">approved</label>
                <?php } ?>
                
               </div>
               <div class="col-lg-6">
              </div>
</div>
<div class="row">
	             <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits" class="toggle btn btn-primary">Personal Information</a>
                              </header>
                              <!--<div id="credits" class="hidden">-->
                              <div class="panel-body">
                                      <div class="form-group">
                                               <label for="exampleusername">Customer No<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="sname" value="<?php echo $postedloan_data['qlip_id'] ; ?>" readonly>
                                       </div>
                                      <div class="form-group">
                                               <label for="examplerole">Loan Application Type<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="application_type" value="<?php echo $postedloan_data['application_type'] ; ?>" id="apptb" readonly>
                                               </input>
                                               <!--<select class="form-control" name="application_type" value="<?php echo $_POST['role'] ; ?>" required>
                                                 <option value="" >--Select--</option>
                                                 <option value="New Loan" >New loan</option>
                                                 <option value="Loan Renewal">Loan Renewal</option>
                                               </select>-->
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Title<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="title" value="<?php echo $postedloan_data['title'] ; ?>" id="titletb" readonly>
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['role'] ; ?>" id="titledd" style="height:10px;">
                                                <option value="" >Select title type</option>
                                                 <option value="mr" >Mr</option>
                                                 <option value="miss">Miss</option>
                                                 <option value="mrs">Mrs</option>
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Surname<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="sname" value="<?php echo $postedloan_data['sname'] ; ?>">
                                       </div>
                                       <div class="form-group">
                                               <label for="exampleusername">Middle Name<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="mname" value="<?php echo $postedloan_data['mname'] ; ?>" >
                                        </div>
                                      <div class="form-group">
                                               <label for="exampleusername">First Name<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="fname" value="<?php echo $postedloan_data['fname'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Maiden Name</label>
                                               <input type="text" class="form-control" id="" placeholder="" name="maiden_name" value="<?php echo $postedloan_data['maiden_name'] ; ?>">
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Date of Birth<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="datepicker" placeholder="" name="dob" value="<?php echo $postedloan_data['dob'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Gender<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="gender" value="<?php echo $postedloan_data['gender'] ; ?>" readonly>                                               	                    
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['gender'] ; ?>" id="genderdd" style="height:10px;">
                                                <option value="" >Select gender</option>
                                                 <option value="male" >Male</option>
                                                 <option value="female">Female</option>                     
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Means of Identification<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="means_of_id" value="<?php echo $postedloan_data['means_of_id'] ; ?>" readonly>     
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['means_of_id'] ; ?>" id="means_of_iddd" style="height:10px;">
                                                <option value="" >Select Means of Identification</option>
                                                 <option value="social secuirity card" >Social security card</option>
                                                 <option value="PPS number">PPS number</option>   
                                                 <option value="Passport" >Passport</option>
                                                 <option value="Drivers licence">Drivers licence</option>   
                                                 <option value="Employees card" >Employees card</option>
                                                 <option value="Birth certificate">Birth certificate</option>   
                                                 <option value="Known to officer" >Known to officer</option>
                                                 <option value="Utility bill">Utility bill</option>                 
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Mobile Number<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="mobile_phone" placeholder="" name="mobile_number" value="<?php echo $postedloan_data['mobile_number'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Email Address<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="email" value="<?php echo $postedloan_data['email'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Home Address<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="home_addr" ><?php echo $postedloan_data['home_addr'] ; ?></textarea>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">LGA<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="lga" value="<?php echo $postedloan_data['lga'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Closest Landmark<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="landmark" value="<?php echo $postedloan_data['landmark'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Marital Status<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="marital_status" value="<?php echo $postedloan_data['marital_status'] ; ?>" readonly>
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['marital_status'] ; ?>" id="marital_statusdd" style="height:10px;">
                                                <option value="" >Select Marital Status</option>
                                                 <option value="Single" >Single</option>
                                                 <option value="Married">Married</option> 
                                                 <option value="Divorced" >Divorced</option>
                                                 <option value="Widow">Widow</option>                    
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Dependents<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="dependents" value="<?php echo $postedloan_data['dependents'] ; ?>" readonly>                                               	              
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['dependents'] ; ?>" id="dependentsdd" style="height:10px;">
                                                <option value="" >Select dependents</option>
                                                 <option value="0" >0</option>
                                                 <option value="1">1</option> 
                                                 <option value="2" >2</option>
                                                 <option value="3">3</option>  
                                                 <option value="4" >4</option>
                                                 <option value="5">5</option> 
                                                 <option value="6" >6</option>
                                                 <option value="7">7</option>   
                                                 <option value="8">8</option> 
                                                 <option value="9" >9</option> 
                                                 <option value="10" >10</option>               
                                               </select>
                                      </div>
                                      
                                  

                              </div>
                          <!--</div>-->
                          </section>
                 </div>
                 <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits2" class="toggle2 btn btn-primary">Employment Information</a>
                              </header>
                              <!--<div id="credits2" class="hidden">-->
                              <div class="panel-body">
                                  
                                      <div class="form-group">
                                               <label for="examplerole">Employment Status<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="emp_status" value="<?php echo $postedloan_data['emp_status'] ; ?>" readonly>
                                               	</input>
                                                <select class="form-control" name="" value="<?php echo $_POST['emp_status'] ; ?>" id="emp_statusdd" style="height:10px;">
                                                <option value="" >Select Employment Status</option>
                                                 <option value="Full time employment" >Full time employment</option>
                                                 <option value="Part time employment">Part time employment</option> 
                                                 <option value="Pensioner" >Pensioner</option>
                                                 <option value="Casual">Casual</option>  
                                                 <option value="Unemployed" >Unemployed</option>
                                                 <option value="Student">Student</option> 
                                                 <option value="Self employed" >Self employed</option>              
                                               </select>       
                                               
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Current Employer<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="current_emp" value="<?php echo $postedloan_data['current_emp'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Current Employer's Address<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="current_emp_addr" ><?php echo $postedloan_data['current_emp_addr'] ; ?></textarea>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Departement/Branch<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="dept" value="<?php echo $postedloan_data['dept'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Departement/Branch Address<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="dept_addr" readonly><?php echo $postedloan_data['dept_addr'] ; ?></textarea>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Closest Landmark<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="landmark_emp" value="<?php echo $postedloan_data['landmark_emp'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">LGA<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="lga_emp" value="<?php echo $postedloan_data['lga_emp'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">State</label>
                                               <input class="form-control" name="state_emp" value="<?php echo $postedloan_data['state_emp'] ; ?>" >
                                                          
                                               </input>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Employer Phone Number<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="employer_phone" placeholder="" name="employer_phone" value="<?php echo $postedloan_data['employer_phone'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Email Address(Official)<strong style="color:red"> *</strong></label>
                                               <input type="email" class="form-control" id="" placeholder="" name="official_email" value="<?php echo $postedloan_data['official_email'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Industry/Sector<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="industry" value="<?php echo $postedloan_data['industry'] ; ?>" readonly>               	              
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['industry'] ; ?>" style="height:10px;" id="industrydd">
                                                <option value="" >Select Industry/Sector</option>
                                                 <option value="Agriculture" >Agriculture</option>
                                                 <option value="Information Technology">Information Technology</option> 
                                                 <option value="Banking" >Banking</option>
                                                 <option value="Other Financial Institutions">Other Financial Institutions</option>  
                                                 <option value="Real Estate Activities" >Real Estate Activities</option>
                                                 <option value="Services">Services</option> 
                                                 <option value="Administrative & Support Services" >Administrative & Support Services</option> 
                                                 <option value="Education" >Education</option>
                                                 <option value="Health">Health</option> 
                                                 <option value="International Organisation" >International Organisation</option>
                                                 <option value="Manufacturing">Manufacturing</option>  
                                                 <option value="Power" >Power</option>
                                                 <option value="Oil and Gas">Oil and Gas</option> 
                                                 <option value="Other" >Other</option>  
                                                 <option value="Engineering" >Engineering</option>
                                                 <option value="Water Supply and Management">Water Supply and Management</option> 
                                                 <option value="Construction" >Construction</option>
                                                 <option value="Sales and retails">Sales and retails</option>  
                                                 <option value="Transport and Storage" >Transport and Storage</option>
                                                 <option value="Information and Communication">Information and Communication</option> 
                                                 <option value="Telecommunication" >Telecommunication</option>                   
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Level Of Education<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="level_of_edu" value="<?php echo $postedloan_data['level_of_edu'] ; ?>" readonly>                    	               
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['level_of_edu'] ; ?>" style="height:10px;" id="level_of_edudd">
                                                <option value="" >Select education level</option>
                                                 <option value="Primary" >Primary</option>
                                                 <option value="Secondary">Secondary</option> 
                                                 <option value="Tertiary" >Tertiary</option>
                                                 <option value="Licenced Practioner">Licenced Practioner</option>  
                                                 <option value="Post Graduate" >Post Graduate</option>
                                                 <option value="None">None</option>                  
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Net Monthly Salary<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="monthly_salar" placeholder="" name="monthly_salary" value="<?php echo $postedloan_data['monthly_salary'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Average Monthly Household Expenses<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="monthly_expens" placeholder="" name="monthly_expense" value="<?php echo $postedloan_data['monthly_expense'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Pay Day<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="pay_day" value="<?php echo $postedloan_data['pay_day'] ; ?>" readonly>                                              	
                                             </input>
                                             <select class="form-control" name="" value="<?php echo $_POST['pay_day'] ; ?>" id="pay_daydd" style="height:10px;">
                                                <option value="miss">Select Pay Day</option>  
                                      <?php
                                       $days=31; $day=1;

                                       while($day<=31)
                                       {
                                       ?>
                                            <option value="<?php echo $day ; ?>" ><?php echo $day ; ?></option>
                                       
                                         
                                       <?php $day=$day+1; } ?>
                                             </select>
                                       </div>
                                         
                                       

                                      
                                      

                                      
                              </div>
                          <!--</div>-->
                          </section>
                 </div>
</div>
           <div class="row">
	             <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits3" class="toggle3 btn btn-primary">Other Information</a>
                              </header>
                              <!--<div id="credits3" class="hidden">-->
                              <div class="panel-body">
                                  
                                      <div class="form-group">
                                               <label for="examplerole">Purpose of Loan<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="purp_of_loan" value="<?php echo $postedloan_data['purp_of_loan'] ; ?>" readonly>                                              	               
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['purp_of_loan'] ; ?>" id="purp_of_loandd" style="height:10px;">
                                                <option value="" >Select Purpose of loan</option>
                                                 <option value="Rent" >Rent</option>
                                                 <option value="Household Enhancement">Household Enhancement</option> 
                                                 <option value="Rent/Holiday" >Rent/Holiday</option>
                                                 <option value="Medical">Medical</option>  
                                                 <option value="School Fees" >School Fees</option>
                                                 <option value="Wedding/Events">Wedding/Events</option>   
                                                 <option value="Household goods" >Household goods</option>
                                                 <option value="Others">Others</option>                
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">If Others,Please Specify<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="loan_purp_specify" value="<?php echo $postedloan_data['loan_purp_specify'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Do you have an existing Loan<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="existing_loan" value="<?php echo $postedloan_data['existing_loan'] ; ?>" readonly>                                                      
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['existing_loan'] ; ?>" id="existing_loandd" style="height:10px;">
                                                 <option value="yes" >Yes</option>
                                                 <option value="no">No</option>      
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">If Yes,Please Specify<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="existing_loan_specify" value="<?php echo $postedloan_data['existing_loan_specify'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">If Yes,Repayment Amount<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="existing_loan_repayment_amount" placeholder="" name="existing_loan_repayment_amount" value="<?php echo $postedloan_data['existing_loan_repayment_amount'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Type of Loan<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="loan_type" value="<?php echo $postedloan_data['loan_type'] ; ?>" readonly>
                                               	           
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['loan_type'] ; ?>" id="loan_typedd" style="height:10px;">
                                                <option value="" >Select loan Type</option>
                                                 <option value="Mortgage" >Mortgage</option>
                                                 <option value="Overdraft">Overdraft</option> 
                                                 <option value="Business Loan" >Business Loan</option>
                                                 <option value="Credit Card">Credit Card</option>  
                                                 <option value="Personal Loan" >Personal Loan</option>
                                                 <option value="Others">Others</option>             
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Type of Bank Account<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="bank_account" value="<?php echo $postedloan_data['bank_account'] ; ?>" readonly>
                                               	              
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['bank_account'] ; ?>" id="bank_accountdd" style="height:10px;">
                                                 <option value="" >Select Bank account Type</option>
                                                 <option value="current" >Current</option>
                                                 <option value="savings">Savings</option>             
                                               </select>
                                      </div>
                                      
                                  
                              </div>
                          <!--</div>-->
                          </section>
                 </div>
                 <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits4" class="toggle4 btn btn-primary">Next of Kin Information(Employed and above 21)</a>
                              </header>
                              <!--<div id="credits4" class="hidden">-->
                              <div class="panel-body">
                                 
                                      <div class="form-group">
                                               <label for="exampleusername">Name<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="nok_name" value="<?php echo $postedloan_data['nok_name'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Relationship<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="relationship" value="<?php echo $postedloan_data['relationship'] ; ?>" readonly>
                                               	
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['relationship'] ; ?>" id="relationshipdd" style="height:10px;">
                                                <option value="" >Select Relationship Type</option>
                                                 <option value="Husband" >Husband</option>
                                                 <option value="Partner">Partner</option> 
                                                 <option value="Father" >Father</option>
                                                 <option value="Mother">Mother</option>  
                                                 <option value="Child" >Child</option>
                                                 <option value="Cousin">Cousin</option>   
                                                 <option value="Brother" >Brother</option>
                                                 <option value="Nephew">Nephew</option> 
                                                 <option value="Niece" >Niece</option>
                                                 <option value="Wife">Wife</option>  
                                                 <option value="Uncle" >Uncle</option>
                                                 <option value="Aunt">Aunt</option> 
                                                 <option value="Sister" >Sister</option>
                                                 <option value="Grand Child">Grand Child</option> 
                                                 <option value="Guard" >Guard</option>
                                                 <option value="Business">Business</option>  
                                                 <option value="Business Manager" >Business Manager</option>
                                                 <option value="Guarantor">Guarantor</option>   
                                                 <option value="Borrower" >Borrower</option>
                                                 <option value="Club">Club</option> 
                                                 <option value="Member of the Club" >Member of the Club</option>
                                                 <option value="Entity">Entity</option>  
                                                 <option value="Trustee of the Entity" >Trustee of the Entity</option>
                                                 <option value="Member">Member</option>    
                                                 <option value="Group">Group</option> 
                                                 <option value="Employee">Employee</option>                 
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Employer Name<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="nok_employer_name" value="<?php echo $postedloan_data['nok_employer_name'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Mobile Number<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="nok_phone" placeholder="" name="nok_phone" value="<?php echo $postedloan_data['nok_phone'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Home Address<strong style="color:red"> *</strong></label>
                                               <textarea type="text" class="form-control" placeholder="" name="nok_addr" ><?php echo $postedloan_data['nok_addr'] ; ?></textarea>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Email<strong style="color:red"> *</strong></label>
                                               <input type="email" class="form-control" id="" placeholder="" name="nok_email" value="<?php echo $postedloan_data['nok_email'] ; ?>" >
                                      </div>
                                      
                                  

                              </div>
                           <!--</div>-->
                          </section>
                 </div>
</div>
<div class="row">
	             <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits5" class="toggle5 btn btn-primary">Loan Information</a>
                              </header>
                              <!--<div id="credits5" class="hidden">-->
                              <div class="panel-body">

                              	       <div class="form-group">
                                               <label for="exampleusername">Oracle Number<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="oracle_number" placeholder="" name="oracle_number" value="<?php echo $postedloan_data['oracle_number'] ; ?>" >
                                      </div>
                                  
                                      <div class="form-group">
                                               <label for="exampleusername">Loan Amount<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="loan_amoun" placeholder="" name="loan_amount" value="<?php echo $postedloan_data['loan_amount'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Loan Tenure Months<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="loan_tenure_months" value="<?php echo $postedloan_data['loan_tenure_months'] ; ?>" >
                                      </div>
                                      <?php if($postedloan_data['status']=="pending"){ ?>
                                      <!--<div class="form-group">
                                               <label for="exampleusername">Disbursed Amount<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="disbursed_amount" value="<?php echo $_POST['disbursement_amount'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Booked Amount<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="booked_amount" value="<?php echo $_POST['booked_amount'] ; ?>" >
                                      </div>

                                      <div class="form-group">
                                               <label for="exampleothernames">First Repayment Date</label>
                                               <div class="input-group">
                                               <input type="text" class="form-control" id="datepicker2" name="repayment_date" value="<?php echo $end_date ; ?>" >
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                               </div>     
                                      </div> 

                                      <div class="form-group">
                                               <label for="exampleothernames">Date Disbursed</label>
                                               <div class="input-group">
                                               <input type="text" class="form-control" id="datepicker3" name="date_disbursed" value="<?php echo $end_date ; ?>" >
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                               </div>     
                                      </div>--> 

                                      <div class="form-group">
                                               <label for="exampleusername">Reason for loan declination(<span style="background-color:yellow; font-size:12px;">Leave empty if approving loan</span>)</label>
                                               <textarea type="text" class="form-control" placeholder="" name="rejection_reason" ><?php echo $_POST['rejection_reason'] ; ?></textarea>
                                      </div>
                                      
                                      <?php } elseif ($postedloan_data['status']=="declined"||$postedloan_data['status']=="approved") { ?>
                                       <div class="form-group">
                                               <label for="exampleusername">Disbursed Amount<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="disbursed_amount" value="<?php echo $postedloan_data['disbursed_amount'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">First Repayment Date<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="repayment_date" value="<?php echo $postedloan_data['first_repayment_date'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">date_disbursed<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="date_disbursed" value="<?php echo $postedloan_data['date_disbursed'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Booked Amount<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="booked_amount" value="<?php echo $postedloan_data['booked_amount'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Outstanding<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="outstanding" value="<?php echo $postedloan_data['outstanding'] ; ?>" readonly>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Reason for loan declination</label>
                                               <textarea type="text" class="form-control" placeholder="" name="rejection_reason" readonly><?php echo $postedloan_data['rejection_reason'] ; ?></textarea>
                                      </div>
                                        
                                      <?php } ?>
                                      
                              </div>
                          <!--</div>-->
                          </section>
                 </div>
                 <div class="col-lg-6">
                          <section class="panel panel-primary">
                              <header class="panel-heading">
                                  <a href="#credits6" class="toggle6 btn btn-primary">Loan Disbursement Details</a>
                              </header>
                              <!--<div id="credits6" class="hidden">-->
                              <div class="panel-body">
                                 
                                      <div class="form-group">
                                               <label for="exampleusername">Account Name<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="account_name" value="<?php echo $postedloan_data['account_name'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="examplerole">Bank Name<strong style="color:red"> *</strong></label>
                                               <input class="form-control" name="bank_name" value="<?php echo $postedloan_data['bank_name'] ; ?>" readonly>                                                               
                                               </input>
                                               <select class="form-control" name="" value="<?php echo $_POST['bank_name'] ; ?>" id="bank_namedd" style="height:10px;" >
                                                 <option value="" >Select a Bank</option>
                                                 <option value="Access Bank">Access Bank</option> 
                                                 <option value="Citi Bank" >Citi Bank</option>
                                                 <option value="Diamond Bank">Diamond Bank</option>  
                                                 <option value="Eco Bank" >Eco Bank</option>
                                                 <option value="Enterprise Bank">Enterprise Bank</option>   
                                                 <option value="Fidelity Bank" >Fidelity Bank</option>
                                                 <option value="FIN Bank">FIN Bank</option> 
                                                 <option value="First Bank" >First Bank</option>
                                                 <option value="First City Monument Bank">First City Monument Bank</option>  
                                                 <option value="GT Bank" >GT Bank</option>
                                                 <option value="Heritage Bank">Heritage Bank</option> 
                                                 <option value="Keystone Bank" >Keystone Bank</option>
                                                 <option value="Mainstreet Bank">Mainstreet Bank</option> 
                                                 <option value="Skye Bank" >Skye Bank</option>
                                                 <option value="Stanbic-IBTC Bank">Stanbic-IBTC Bank</option>  
                                                 <option value="Standard Chartered" >Standard Chartered</option>
                                                 <option value="Sterling">Sterling</option>   
                                                 <option value="UBA" >UBA</option>
                                                 <option value="Union Bank">Union Bank</option> 
                                                 <option value="Unity Bank" >Unity Bank</option>
                                                 <option value="Wema Bank">Wema Bank</option>  
                                                 <option value="Zenith Bank" >Zenith Bank</option>                
                                               </select>
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Account Number<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="account_number" placeholder="" name="account_number" value="<?php echo $postedloan_data['account_number'] ; ?>" >
                                      </div>
                                      <div class="form-group">
                                               <label for="exampleusername">Bank Branch<strong style="color:red"> *</strong></label>
                                               <input type="text" class="form-control" id="" placeholder="" name="bank_branch" value="<?php echo $postedloan_data['bank_branch'] ; ?>" >
                                      </div>
                                      
                                      <!--table for uploaded documents-->
                                      <span style="background:rgb(255,117,117)"><strong>(Uploaded documents)</strong></span>
                                      <table class="table table-bordered" style="font-size:12px;">
                                        <tr>
                                            <th>Oracle No</th>
                                            <th>Document Type</th>
                                            <th></th>  
                                        </tr>
                                        <tbody>
                                          <?php
                                          $oracle_number=$postedloan_data['oracle_number'] ;
                                          $result11 = mysql_query("SELECT * from documents where oracle_number='$oracle_number'");
                                          while($row=mysql_fetch_array($result11))
                                          {
                                            
                                          ?>
                                          <tr>
                                          <td><?php echo $row['oracle_number']; ?></td>
                                          <td><?php echo $row['document_type']; ?></td>
                                          <td><a href="<?php echo site_url() ?>/qlip_controller/download_documents/<?php echo $row['path'] ?>">Download</a></td>
                                          <tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                      
                                  

                              </div>
                          <!--</div>-->
                          </section>
                 </div>
</div>
</div>
<?php
      if($postedloan_data['status']=="pending"){
        echo ('<input type="submit" class="btn btn-default" name="btn_update" value="Decline"></input><input type="submit" name="btn_update" class="btn btn-default" value="Approve"></input><br><br>');
       }
  ?>
  
</form>