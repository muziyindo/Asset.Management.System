<?php
class Qlip_model extends CI_Model
{
    public function __construct()
	{
    parent::__construct();
		$this->load->database();// no need, guess hava already done that in auto load
    
    
	}
    
    function verifyUser($uname,$pword)
    {
      /*select id from ms_admins where username = '$u',password = '$pw' limit 1--an alternative way to do this which is my way is*/
      /*$this->db->select('id');
      $this->db->where('username',$u);
      $this->db->where('password', $pw); //$this->db->where('password', md5($pw));
      $this->db->where('status', 'active');
      $this->db->limit(1);
      $Q = $this->db->get('ms_admins');*/
      
      $this->db->select('uid,fname,lname,uname,role,pword');
      $Q = $this->db->get_where('qusers', array('uname'=>$uname));
      
      if ($Q->num_rows() > 0)
      {
        $row = $Q->row_array();
        return $row;
      }

      else
      {
        return array();
      }
    }

    public function insert_user($date_created)
   {
     $encrypted_password = $this->encrypt->encode($this->input->post('pword'));
        
     $data = array(
    'fname' => $this->input->post('fname'),
    'lname' => $this->input->post('lname'),
    'oname' => $this->input->post('oname'),
    'email' => $this->input->post('email'),
    'uname' => $this->input->post('uname'),
    'pword' => $encrypted_password,
    'role' => $this->input->post('role'),
    'date_created' => $date_created,
    'project' => $this->input->post('project')
  );
     return $this->db->insert('qusers', $data);
  }

   public function insert_loan($applied_date)
   {
     $result1 = mysql_query("select * from qlip_id order by id desc limit 1");
    while($row = mysql_fetch_array($result1))
    {
      $qlip_id = $row['id_series'] + 1 ;
      $id = $row['id'];
      //update with the new qlip id
      mysql_query("update qlip_id set id_series = '$qlip_id' where id = '$id'");
    
    }

    //calculate the warranty expiry_date
    $warranty = $this->input->post('warranty');
    $purchase_date = $this->input->post('purchase_date');

    $date = DateTime::createFromFormat("Y-m-d", $purchase_date);//obtaining day from last_repayment_date
    $day1 = $date->format("d"); //obtaining day from last_repayment_date
    $month1 = $date->format("m"); //obtaining month from last_repayment_date
    $year1 = $date->format("Y"); //obtaining day from last_repayment_date

    $expiry_year=$year1+$warranty;
    $warranty_expiry = $expiry_year."-".$month1."-".$day1;
    //echo $warranty_expiry ;
   
     $status="installed" ;
     $l2_approved='no' ;
     //$new_old='new' ;
     $data = array(
    'unique_id' => $this->input->post('unique_id'),
    'installer_name' => $this->input->post('installer_name'),
    'project' => $this->input->post('project'),
    'department' => $this->input->post('department'),
    'state' => $this->input->post('state'),
    'city' => $this->input->post('city'),
    'lg' => $this->input->post('lg'),
    'category' => $this->input->post('category'),
    'asset_type' => $this->input->post('asset_type'),
    'asset_name' => $this->input->post('asset_name'),
    'model' => $this->input->post('model'),
    'serial' => $this->input->post('serial'),
    'specification' => $this->input->post('specification'),
    'po_number' => $this->input->post('po_number'),
    'vendor' => $this->input->post('vendor'),
    'purchase_date' => $this->input->post('purchase_date'),
    'warranty' => $this->input->post('warranty'),
    'expiry_date' => $warranty_expiry,
    'date_installed' => $this->input->post('date_installed'),
    'posted_by' =>$this->session->userdata('uname'),
    'status' => $status,
    'install_type' => 'single',
    'available' => 'yes',
    'l2_approved' => $l2_approved,
    'date_applied' => $applied_date,
    'last_modified' => date('Y-m-d'),
     'action_type' =>'insert',
    'action_user' =>$uname = $this->session->userdata('uname'),
     'qlip_id' =>$qlip_id
    
  );
     $this->db->insert('lasg_staff_info', $data);

     $lsid = $this->db->insert_id();
     $this->audit_trigger($lsid); //audit-trail record transaction log
  }

    public function insert_deploy($install_id)
   {
     
     $data = array(
    'install_id' => $install_id,
    'serial_no' => $this->input->post('serial'),
    'organisation' => $this->input->post('organisation'),
    'country' => $this->input->post('country'),
    'region' => $this->input->post('region'),
    'city' => $this->input->post('city'),
    'address' => $this->input->post('address'),
    'office_type' => $this->input->post('office_type'),
    'room_no' => $this->input->post('room_no'),
    'employee_name' => $this->input->post('user_name'),
    'employee_no' => $this->input->post('employee_no'),
    'contact_no' => $this->input->post('contact_no'),
    'department' => $this->input->post('department'),
    'email' => $this->input->post('email'),
    'request_date' => $this->input->post('request_date'),
    'user_approval' => $this->input->post('user_approval'),
    'request_description' => $this->input->post('description'),
    'dept_manager_name' => $this->input->post('dept_manager_name'),
    'dept_manager_approval' => $this->input->post('dept_manager_approval'),
    'dept_approval_date' =>$this->input->post('dept_approval_date'),
    'it_manager_name' =>$this->input->post('it_manager_name'),
    'it_manager_approval' =>$this->input->post('it_manager_approval'),
    'it_approval_date' =>$this->input->post('it_approval_date'),
    'asset_type' =>$this->input->post('asset_type'),
    'tag_no' =>$this->input->post('tag_no'),
    'hostname' =>$this->input->post('hostname'),
    'product_id' =>$this->input->post('product_id'),
    'port' =>$this->input->post('port'),
    'ip_address' =>$this->input->post('ip_address'),
    'owned_by' =>$this->session->userdata('owned_by'),
    'specifications' =>$this->input->post('specification'),
    'date_deployed' =>$this->input->post('date_deployed'),
    'engineer' =>$this->session->userdata('uname'),
    'deployed_by' =>$this->input->post('deployed_by'),
    'project' =>$this->input->post('project'),
    'status' =>'deployed',
    'log_date' =>date('Y-m-d'),
     'action_type' =>'insert',
    'action_user' =>$this->session->userdata('uname')
  );
     $this->db->insert('deployed', $data);

     $lsid = $this->db->insert_id();
     $this->audit_trigger_deployed($lsid); //audit-trail record transaction log
  }

  public function insert_deploy_returned($return_id)
   {
     
     $data = array(
    'return_id' => $return_id,
    'serial_no' => $this->input->post('serial'),
    'organisation' => $this->input->post('organisation'),
    'country' => $this->input->post('country'),
    'region' => $this->input->post('region'),
    'city' => $this->input->post('city'),
    'address' => $this->input->post('address'),
    'office_type' => $this->input->post('office_type'),
    'room_no' => $this->input->post('room_no'),
    'employee_name' => $this->input->post('user_name'),
    'employee_no' => $this->input->post('employee_no'),
    'contact_no' => $this->input->post('contact_no'),
    'department' => $this->input->post('department'),
    'email' => $this->input->post('email'),
    'request_date' => $this->input->post('request_date'),
    'user_approval' => $this->input->post('user_approval'),
    'request_description' => $this->input->post('description'),
    'dept_manager_name' => $this->input->post('dept_manager_name'),
    'dept_manager_approval' => $this->input->post('dept_manager_approval'),
    'dept_approval_date' =>$this->input->post('dept_approval_date'),
    'it_manager_name' =>$this->input->post('it_manager_name'),
    'it_manager_approval' =>$this->input->post('it_manager_approval'),
    'it_approval_date' =>$this->input->post('it_approval_date'),
    'asset_type' =>$this->input->post('asset_type'),
    'tag_no' =>$this->input->post('tag_no'),
    'hostname' =>$this->input->post('hostname'),
    'product_id' =>$this->input->post('product_id'),
    'port' =>$this->input->post('port'),
    'ip_address' =>$this->input->post('ip_address'),
    'owned_by' =>$this->session->userdata('owned_by'),
    'specifications' =>$this->input->post('specification'),
    'date_deployed' =>$this->input->post('date_deployed'),
    'engineer' =>$this->session->userdata('uname'),
    'deployed_by' =>$this->input->post('deployed_by'),
    'project' =>$this->input->post('project'),
    'status' =>'deployed',
    'log_date' =>date('Y-m-d'),
     'action_type' =>'insert',
    'action_user' =>$this->session->userdata('uname')
  );
     $this->db->insert('deployed', $data);

     $lsid = $this->db->insert_id();
     $this->audit_trigger_deployed($lsid); //audit-trail record transaction log
  }

  public function insert_return($deploy_id)
   {
     
     $data = array(
    'deploy_id' => $deploy_id,
    'serial_no' => $this->input->post('serial'),
    'organisation' => $this->input->post('organisation'),
    'country' => $this->input->post('country'),
    'region' => $this->input->post('region'),
    'city' => $this->input->post('city'),
    'address' => $this->input->post('address'),
    'office_type' => $this->input->post('office_type'),
    'room_no' => $this->input->post('room_no'),
    'employee_name' => $this->input->post('user_name'),
    'employee_no' => $this->input->post('employee_no'),
    'contact_no' => $this->input->post('contact_no'),
    'department' => $this->input->post('department'),
    'email' => $this->input->post('email'),
    'request_date' => $this->input->post('request_date'),
    'user_approval' => $this->input->post('user_approval'),
    'request_description' => $this->input->post('description'),
    'dept_manager_name' => $this->input->post('dept_manager_name'),
    'dept_manager_approval' => $this->input->post('dept_manager_approval'),
    'dept_approval_date' =>$this->input->post('dept_approval_date'),
    'it_manager_name' =>$this->input->post('it_manager_name'),
    'it_manager_approval' =>$this->input->post('it_manager_approval'),
    'it_approval_date' =>$this->input->post('it_approval_date'),
    'asset_type' =>$this->input->post('asset_type'),
    'tag_no' =>$this->input->post('tag_no'),
    'hostname' =>$this->input->post('hostname'),
    'product_id' =>$this->input->post('product_id'),
    'port' =>$this->input->post('port'),
    'ip_address' =>$this->input->post('ip_address'),
    'owned_by' =>$this->session->userdata('owned_by'),
    'specifications' =>$this->input->post('specification'),
    'date_returned' =>date('Y-m-d'),
    'engineer' =>$this->session->userdata('uname'),
    'deployed_by' =>$this->input->post('deployed_by'),
    'project' =>$this->input->post('project'),
    'status' =>'returned',
    'log_date' =>date('Y-m-d'),
     'action_type' =>'insert',
    'action_user' =>$this->session->userdata('uname')
  );
     $this->db->insert('returned', $data);

     $lsid = $this->db->insert_id();
     $this->audit_trigger_returned($lsid); //audit-trail record transaction log
  }

  public function get_data($type,$id=0,$uname=0)
  {

     if($type=="level1_data")
    {
      $sql="select * from lasg_staff_info order by date_installed desc";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
    else if($type=="deployed_data")
    {
      $sql="select * from deployed order by date_deployed desc";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
    else if($type=="returned_data")
    {
      $sql="select * from returned order by date_returned desc";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
    else if($type=="decommissioned_data")
    {
      $sql="select * from decommissioned order by date_decommissioned desc";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
    else if($type=="level2_data")
    {
      $this->db->order_by("lsid", "desc"); 
      $query = $this->db->get('lasg_staff_info'); //get a member detail  whose column id = $id
      return $query->result_array();
    } 
    else if($type=="users_data")
    {
      $this->db->order_by("uid", "desc"); 
      $query = $this->db->get('qusers'); //get a member detail  whose column id = $id
      return $query->result_array();
    } 
    else if($type=="upload_file_data")
    {
         $this->db->select('*');
         $this->db->from('deduction_report');
         $this->db->join('uploaded_files', 'uploaded_files.file_id = deduction_report.file_id','inner');
         $this->db->order_by("deduction_report.rid", "desc"); 
         //$this->db->where('client.linkid !=', '2001');
         $query = $this->db->get();
         return $query->result_array(); //search_upload
    } 
    else if($type=="primera_data")
    {
      $this->db->order_by("date_applied", "desc"); 
      //$query = $this->db->get('lasg_staff_info'); //get a member detail  whose column id = $id
      $query = $this->db->get_where('lasg_staff_info', array('l2_approved' => 'yes'));
      return $query->result_array();
    } //
    else if($type=="t24_data")
    {
      $this->db->order_by("date_approved", "desc"); 
      //$query = $this->db->get('lasg_staff_info'); //get a member detail  whose column id = $id
      $query = $this->db->get('push_24_status');
      return $query->result_array();
    } 
    else if($type=="deployed_info")
    {
       $query = $this->db->get_where('deployed', array('did' => $id)); //get a member detail  whose column id = $id
       return $query->row_array();
    }
    else if($type=="installed_info")
    {
       $query = $this->db->get_where('lasg_staff_info', array('lsid' => $id)); //get a member detail  whose column id = $id
       return $query->row_array();
    }
    else if($type=="search_l1")
    {
      /*$this->db->where(array('posted_by' => 'gafar'));
      $this->db->like('status', $id);
      $this->db->or_like('oracle_number', $id);
      $this->db->or_like('fname', $id);
      $this->db->or_like('sname', $id);
      $this->db->or_like('mname', $id);
      $this->db->or_like('email', $id);
      $this->db->or_like('date_applied', $id);
      $this->db->or_like('mobile_number', $id);
      $this->db->or_like('home_addr', $id);
      $this->db->or_like('official_email', $id);
      $this->db->or_like('loan_type', $id);
      $this->db->or_like('account_number', $id);
      $this->db->or_like('posted_by', $id);
      $this->db->or_like('disbursed_amount', $id);
      $this->db->or_like('monthly_salary', $id);
      //$query = $this->db->get('lasg_staff_info');
     //$query = $this->db->get_where('lasg_staff_info', array('posted_by' => $uname)); //get a member detail  whose column id = $id
      $query = $this->db->get('lasg_staff_info');*/
      $sql= "SELECT * FROM lasg_staff_info where posted_by='$uname' and (fname like '%$id%' or oracle_number like '%$id%' or status like '%$id%' or 
        sname like '%$id%' or mname like '%$id%' or email like '%$id%' or date_applied like '%$id%' or posted_by like '%$id%' or loan_type like '%$id%' or l2_approved like '%$id%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    else if($type=="breakdown_search")
    {
          
         $sql= "SELECT lasg_staff_info.oracle_number,lasg_staff_info.first_repayment_date,deduction_report.employee_name,lasg_staff_info.loan_amount,lasg_staff_info.disbursed_amount,lasg_staff_info.date_disbursed,deduction_report.credit,deduction_report.ledger_balance,deduction_report.principal_from_credited,deduction_report.interest_from_credited,deduction_report.interest,deduction_report.principal_amount,deduction_report.repayment_amount,deduction_report.balance,deduction_report.booked_amount,deduction_report.tenure,deduction_report.narration,deduction_report.month_year from lasg_staff_info inner join deduction_report on deduction_report.oracle_number=lasg_staff_info.oracle_number where deduction_report.oracle_number='$id' and deduction_report.checked='yes'";
         $query=$this->db->query($sql);
         return $query->result_array();
    }
    
    else if($type=="breakdown_search_l1")//querying ledger balance from level 1 user view
    { 
           $sql= "SELECT lasg_staff_info.oracle_number,lasg_staff_info.first_repayment_date,deduction_report.employee_name,lasg_staff_info.loan_amount,lasg_staff_info.disbursed_amount,deduction_report.credit,deduction_report.ledger_balance,deduction_report.principal_from_credited,deduction_report.interest_from_credited,deduction_report.interest,deduction_report.principal_amount,deduction_report.repayment_amount,deduction_report.balance,deduction_report.booked_amount,deduction_report.tenure,deduction_report.narration,deduction_report.month_year from lasg_staff_info inner join deduction_report on deduction_report.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' and deduction_report.oracle_number='$id' and deduction_report.checked='yes'";
           $query=$this->db->query($sql);
           return $query->result_array(); 
    }
    else if($type=="booked_sum")
    {
      $sql= "select sum(booked_amount) from lasg_staff_info where status='approved'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
    else if($type=="booked_sum_search")
    {
      $sql= "select sum(booked_amount) from lasg_staff_info where status='approved' and oracle_number='$id'";
      $query=$this->db->query($sql);
      return $query->row_array();
    } 
    else if($type=="qlip_upload_data")
    {
      $sql= "select * from uploaded_files order by file_id desc";
      $query=$this->db->query($sql);
      return $query->result_array(); 
    } 

    else if($type=="view_reconciliation")
    {
      $sql= "select * from reconciliation ";
      $query=$this->db->query($sql);
      return $query->result_array(); 
    }//get_single_recon

    else if($type=="single_recon")
    {
      $sql= "select * from reconciliation where file_id='$id'";
      $query=$this->db->query($sql);
      return $query->result_array(); 
    }

    else if($type=="qlip_upload_data_each")
    {
      $sql= "select * from uploaded_files where file_id='$id'";
      $query=$this->db->query($sql);
      return $query->row_array(); 
    }

     else if($type=="search_l2")
    {
      $this->db->like('oracle_number', $id);
      $this->db->or_like('fname', $id);
      $this->db->or_like('sname', $id);
      $this->db->or_like('mname', $id);
      $this->db->or_like('email', $id);
      $this->db->or_like('date_applied', $id);
      $this->db->or_like('mobile_number', $id);
      $this->db->or_like('home_addr', $id);
      $this->db->or_like('official_email', $id);
      $this->db->or_like('loan_type', $id);
      $this->db->or_like('account_number', $id);
      $this->db->or_like('status', $id);
      $this->db->or_like('posted_by', $id);
      $this->db->or_like('disbursed_amount', $id);
      $this->db->or_like('monthly_salary', $id);
      $this->db->or_like('l2_approved', $id);
      $query = $this->db->get('lasg_staff_info');
     //$query = $this->db->get_where('lasg_staff_info', array('posted_by' => $uname)); //get a member detail  whose column id = $id
    return $query->result_array();
    }

    else if($type=="search_admin")
    {
      $this->db->like('uname', $id);
      $this->db->or_like('email', $id);
      $this->db->or_like('fname', $id);
      $this->db->or_like('lname', $id);
      $this->db->or_like('oname', $id);
      $this->db->or_like('role', $id);
      $query = $this->db->get('qusers');
     //$query = $this->db->get_where('lasg_staff_info', array('posted_by' => $uname)); //get a member detail  whose column id = $id
    return $query->result_array();
    }
    else if($type=="search_upload")
    {
         $this->db->select('*');
         $this->db->from('deduction_report');
         $this->db->join('uploaded_files', 'uploaded_files.file_id = deduction_report.file_id','inner');
         $this->db->like('oracle_number', $id);
         $this->db->or_like('month_year', $id);         
         $this->db->or_like('employee_name', $id);
          $this->db->or_like('uploaded_files.status', $id);
         $this->db->or_like('uploaded_files.file_id', $id);
         $query = $this->db->get();
         return $query->result_array(); //search_upload
    } 


     else if($type=="search_pr")
    {
      /*$this->db->like('oracle_number', $id);
      $this->db->or_like('fname', $id);
      $this->db->or_like('sname', $id);
      $this->db->or_like('mname', $id);
      $this->db->or_like('email', $id);
      $this->db->or_like('date_applied', $id);
      $this->db->or_like('mobile_number', $id);
      $this->db->or_like('home_addr', $id);
      $this->db->or_like('official_email', $id);
      $this->db->or_like('loan_type', $id);
      $this->db->or_like('account_number', $id);
      $this->db->or_like('status', $id);
      $this->db->or_like('posted_by', $id);
      $this->db->or_like('disbursed_amount', $id);
      $this->db->or_like('monthly_salary', $id);
      $query = $this->db->get_where('lasg_staff_info',array('l2_approved' => 'yes'));
     //$query = $this->db->get_where('lasg_staff_info', array('posted_by' => $uname)); //get a member detail  whose column id = $id
      return $query->result_array();*/
      $sql= "SELECT * FROM lasg_staff_info where l2_approved='yes' and (fname like '%$id%' or oracle_number like '%$id%' or status like '%$id%' or 
        sname like '%$id%' or mname like '%$id%' or email like '%$id%' or date_applied like '%$id%' or posted_by like '%$id%' or loan_type like '%$id%' or l2_approved like '%$id%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    else if($type=="breakdown")
    {
      $sql= "SELECT lasg_staff_info.oracle_number,deduction_report.employee_name,lasg_staff_info.loan_amount,lasg_staff_info.disbursed_amount,lasg_staff_info.booked_amount,deduction_report.credit,deduction_report.month_year from lasg_staff_info inner join deduction_report on deduction_report.oracle_number=lasg_staff_info.oracle_number";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    else if($type=="due_data")
    {
      $sql= "select * from due_payments";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    else if($type=="due_data_l1")
    {
      $sql= "select * from due_payments inner join lasg_staff_info on due_payments.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' ";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    
    /*if($type=="service_request")
    {
        /*$query = $this->db->get('service_request');
      return $query->result_array();
      //$query = $this->db->get('client');
      //return $query->result_array();

       $this->db->select('*');
         $this->db->from('client');
         $this->db->join('checklist', 'checklist.linkid = client.linkid','inner');
         $this->db->where('client.linkid !=', '2001');
         $query = $this->db->get();
         return $query->result_array();

    }
    else if($type=="customer")
    {
       $this->db->select('*');
         $this->db->from('client');
         $this->db->join('checklist', 'checklist.linkid = client.linkid','inner');
         $this->db->where('client.linkid !=', '2001');
         $query = $this->db->get();
         return $query->result_array();
        /*$query = $this->db->get('client');
      return $query->result_array();
    }
    else if($type=="agent")
    {
        $this->db->select('*');
         $this->db->from('client');
         $this->db->join('checklist', 'checklist.linkid = client.linkid','inner');
         $this->db->where('client.linkid !=', '2001');
         $query = $this->db->get();
         return $query->result_array();
    }
    else if($type=="one")
    {
        $query = $this->db->get_where('client', array('cuid' => $id)); //get a member detail  whose column id = $id
    return $query->row_array();
    }

    else if($type=="track")
    {
        $query = $this->db->get_where('client', array('cuid' => $id)); //get a member detail  whose column id = $id
    return $query->row_array();
    }

    else if($type=="invoiceid")
    {
        $query = $this->db->get_where('invoice_id', array('id' => '1')); //get a member detail  whose column id = $id
    return $query->row_array();
    }

    else if($type=="address_name")
    {
        $query = $this->db->get_where('client', array('cuid' => $id)); //get a member detail  whose column id = $id
    return $query->row_array();
    }

    else if($type=="invoice_info")
    {
        $query = $this->db->get_where('invoice', array('iid' => $id)); //get a member detail  whose column id = $id
    return $query->row_array();
    }

    else if($type=="proforma_info")
    {
        $query = $this->db->get_where('proforma', array('iid' => $id)); //get a member detail  whose column id = $id
    return $query->row_array();
    }

    else if($type=="invoice_data")
    {
       $query = $this->db->get('invoice');
      return $query->result_array();
    }

    else if($type=="proforma_data")
    {
       $query = $this->db->get('proforma');
      return $query->result_array();
    }

    else if($type=="search")
    {
        
    $this->db->like('name', $id);
    $this->db->or_like('email', $id);
    $this->db->or_like('service_type', $id);
    $this->db->or_like('address', $id);
    $this->db->or_like('preferred_location', $id);
    $query = $this->db->get('client');
     //$query = $this->db->get_where('client', array('name' => $id)); //get a member detail  whose column id = $id
    return $query->result_array();
    }
  
  else if($type=="search2")
    {
        

     $query = $this->db->get_where('client', array('name' => $id)); //get a member detail  whose column id = $id
    return $query->result_array();
    }
  
  else if($type=="search_agent")
    {
        

    $this->db->like('agent_name', $id);
    $this->db->or_like('agent_email', $id);
    $this->db->or_like('agent_company', $id);
    $this->db->or_like('agent_phone', $id);
    $query = $this->db->get('client');
     //$query = $this->db->get_where('client', array('name' => $id)); //get a member detail  whose column id = $id
    return $query->result_array();
    }

    else if($type=="search_invoice")
    {
        

     $query = $this->db->get_where('invoice', array('issued_to' => $id)); //get a member detail  whose column id = $id
    return $query->result_array();
    }

    else if($type=="search_proforma")
    {
        

     $query = $this->db->get_where('proforma', array('issued_to' => $id)); //get a member detail  whose column id = $id
    return $query->result_array();
    }

    else if($type=="checklist")
    {
        
         $this->db->select('*');
         $this->db->from('client');
         $this->db->join('checklist', 'checklist.linkid = client.linkid','inner');
         $this->db->where('client.linkid', $id);
         $query = $this->db->get();
         return $query->row_array();
    }*/
  }

  public function update_loan($last_updated,$id)
  {

      
      //let update reflect in deployed and returned assets
      $sno_sess = $this->session->userdata('sno_sess');
      $sno = $this->input->post('serial');
      $status = $this->input->post('status');

      if($status=="deployed" || $status=="returned")
      {
      $spec = $this->input->post('specification');
      $sql="update deployed set serial_no='$sno',specifications='$spec' where serial_no='$sno_sess'";
      $query = $this->db->query($sql);
      $sql2="update returned set serial_no='$sno',specifications='$spec' where serial_no='$sno_sess'";
      $query2 = $this->db->query($sql2);
      }
      $this->session->unset_userdata($sno_sess);


      //calculate the warranty expiry_date
    $warranty = $this->input->post('warranty');
    $purchase_date = $this->input->post('purchase_date');

    $date = DateTime::createFromFormat("Y-m-d", $purchase_date);//obtaining day from last_repayment_date
    $day1 = $date->format("d"); //obtaining day from last_repayment_date
    $month1 = $date->format("m"); //obtaining month from last_repayment_date
    $year1 = $date->format("Y"); //obtaining day from last_repayment_date

    $expiry_year=$year1+$warranty;
    $warranty_expiry = $expiry_year."-".$month1."-".$day1;
     //$status="pending" ;
     $data = array(
    //'unique_id' => $this->input->post('unique_id'),
    //'installer_name' => $this->input->post('installer_name'),
    //'project' => $this->input->post('project'),
    'department' => $this->input->post('department'),
    'state' => $this->input->post('state'),
    'city' => $this->input->post('city'),
    'lg' => $this->input->post('lg'),
    'category' => $this->input->post('category'),
    'asset_type' => $this->input->post('asset_type'),
    'asset_name' => $this->input->post('asset_name'),
    'model' => $this->input->post('model'),
    'serial' => $this->input->post('serial'),
    'specification' => $this->input->post('specification'),
    'po_number' => $this->input->post('po_number'),
    'vendor' => $this->input->post('vendor'),
    'purchase_date' => $this->input->post('purchase_date'),
    'warranty' => $this->input->post('warranty'),
    'expiry_date' => $warranty_expiry,
    'date_installed' => $this->input->post('date_installed'),
    //'posted_by' =>$this->session->userdata('uname'),
    //'status' => $status,
    //'install_type' => 'single',
    //'available' => 'yes',
    //'l2_approved' => $l2_approved,
    //'date_applied' => $applied_date,
    //'application_type' => $this->input->post('application_type'),
     'action_type' =>'update',
    'action_user' =>$uname = $this->session->userdata('uname')
     //'qlip_id' =>$qlip_id
    
  );
     $this->db->where('lsid', $id);
     $this->db->update('lasg_staff_info', $data);

     $this->audit_trigger($id); //audit-trail record transaction log
  }

  public function update_deployed($id)
  {

      
      //let update reflect in deployed and returned assets
      /*$sno_sess = $this->session->userdata('sno_sess');
      $sno = $this->input->post('serial');
      $status = $this->input->post('status');

      if($status=="deployed" || $status=="returned")
      {
      $spec = $this->input->post('specification');
      $sql="update deployed set serial_no='$sno',specifications='$spec' where serial_no='$sno_sess'";
      $query = $this->db->query($sql);
      $sql2="update returned set serial_no='$sno',specifications='$spec' where serial_no='$sno_sess'";
      $query2 = $this->db->query($sql2);
      }
      $this->session->unset_userdata($sno_sess);*/


     
     $data = array(
    //'install_id' => $install_id,
    //'serial_no' => $this->input->post('serial'),
    'organisation' => $this->input->post('organisation'),
    'country' => $this->input->post('country'),
    'region' => $this->input->post('region'),
    'city' => $this->input->post('city'),
    'address' => $this->input->post('address'),
    'office_type' => $this->input->post('office_type'),
    'room_no' => $this->input->post('room_no'),
    'employee_name' => $this->input->post('user_name'),
    'employee_no' => $this->input->post('employee_no'),
    'contact_no' => $this->input->post('contact_no'),
    'department' => $this->input->post('department'),
    'email' => $this->input->post('email'),
    'request_date' => $this->input->post('request_date'),
    'user_approval' => $this->input->post('user_approval'),
    'request_description' => $this->input->post('description'),
    'dept_manager_name' => $this->input->post('dept_manager_name'),
    'dept_manager_approval' => $this->input->post('dept_manager_approval'),
    'dept_approval_date' =>$this->input->post('dept_approval_date'),
    'it_manager_name' =>$this->input->post('it_manager_name'),
    'it_manager_approval' =>$this->input->post('it_manager_approval'),
    'it_approval_date' =>$this->input->post('it_approval_date'),
    'asset_type' =>$this->input->post('asset_type'),
    'tag_no' =>$this->input->post('tag_no'),
    'hostname' =>$this->input->post('hostname'),
    'product_id' =>$this->input->post('product_id'),
    'port' =>$this->input->post('port'),
    'ip_address' =>$this->input->post('ip_address'),
    'owned_by' =>$this->session->userdata('owned_by'),
    //'specifications' =>$this->input->post('specification'),
    'date_deployed' =>$this->input->post('date_deployed'),
    //'engineer' =>$this->session->userdata('uname'),
    'deployed_by' =>$this->input->post('deployed_by'),
    'project' =>$this->input->post('project'),
    //'status' =>'deployed',
    'log_date' =>date('Y-m-d'),
     'action_type' =>'update',
    'action_user' =>$this->session->userdata('uname')
  );

  $data_ = array(
    //'install_id' => $install_id,
    //'serial_no' => $this->input->post('serial'),
    'organisation' => $this->input->post('organisation'),
    'country' => $this->input->post('country'),
    'region' => $this->input->post('region'),
    'city' => $this->input->post('city'),
    'address' => $this->input->post('address'),
    'office_type' => $this->input->post('office_type'),
    'room_no' => $this->input->post('room_no'),
    'employee_name' => $this->input->post('user_name'),
    'employee_no' => $this->input->post('employee_no'),
    'contact_no' => $this->input->post('contact_no'),
    'department' => $this->input->post('department'),
    'email' => $this->input->post('email'),
    'request_date' => $this->input->post('request_date'),
    'user_approval' => $this->input->post('user_approval'),
    'request_description' => $this->input->post('description'),
    'dept_manager_name' => $this->input->post('dept_manager_name'),
    'dept_manager_approval' => $this->input->post('dept_manager_approval'),
    'dept_approval_date' =>$this->input->post('dept_approval_date'),
    'it_manager_name' =>$this->input->post('it_manager_name'),
    'it_manager_approval' =>$this->input->post('it_manager_approval'),
    'it_approval_date' =>$this->input->post('it_approval_date'),
    'asset_type' =>$this->input->post('asset_type'),
    'tag_no' =>$this->input->post('tag_no'),
    'hostname' =>$this->input->post('hostname'),
    'product_id' =>$this->input->post('product_id'),
    'port' =>$this->input->post('port'),
    'ip_address' =>$this->input->post('ip_address'),
    'owned_by' =>$this->session->userdata('owned_by'),
    //'specifications' =>$this->input->post('specification'),
    //'date_deployed' =>$this->input->post('date_deployed'),
    //'engineer' =>$this->session->userdata('uname'),
    'deployed_by' =>$this->input->post('deployed_by'),
    'project' =>$this->input->post('project'),
    //'status' =>'deployed',
    'log_date' =>date('Y-m-d'),
     'action_type' =>'update',
    'action_user' =>$this->session->userdata('uname')
  );

      //update returned table
     $this->db->where('deploy_id', $id);
     $this->db->update('returned', $data_);
    
     $this->db->where('did', $id);
     $this->db->update('deployed', $data);

     $this->audit_trigger_deployed($id); //audit-trail record transaction log
  }

  public function update_loan_reapply($last_updated,$id)
  {
     $status="pending" ;
     $l2_approved='no' ;
     $data = array(
    'oracle_number' => $this->input->post('oracle_number'),
    'title' => $this->input->post('title'),
    'sname' => $this->input->post('sname'),
    'mname' => $this->input->post('mname'),
    'fname' => $this->input->post('fname'),
    'maiden_name' => $this->input->post('maiden_name'),
    'dob' => $this->input->post('dob'),
    'gender' => $this->input->post('gender'),
    'means_of_id' => $this->input->post('means_of_id'),
    'mobile_number' => $this->input->post('mobile_number'),
    'email' => $this->input->post('email'),
    'home_addr' => $this->input->post('home_addr'),
    'lga' => $this->input->post('lga'),
    'landmark' => $this->input->post('landmark'),
    'marital_status' => $this->input->post('marital_status'),
    'dependents' => $this->input->post('dependents'),
    'emp_status' => $this->input->post('emp_status'),
    'current_emp' => $this->input->post('current_emp'),
    'current_emp_addr' => $this->input->post('current_emp_addr'),
    'dept' => $this->input->post('dept'),
    'dept_addr' => $this->input->post('dept_addr'),
    'landmark_emp' => $this->input->post('landmark_emp'),
    'lga_emp' => $this->input->post('lga_emp'),
    'state_emp' => $this->input->post('state_emp'),
    'employer_phone' => $this->input->post('employer_phone'),
    'official_email' => $this->input->post('official_email'),
    'industry' => $this->input->post('industry'),
    'level_of_edu' => $this->input->post('level_of_edu'),
    'monthly_salary' => $this->input->post('monthly_salary'),
    'monthly_expense' => $this->input->post('monthly_expense'),
    'pay_day' => $this->input->post('pay_day'),
    'purp_of_loan' => $this->input->post('purp_of_loan'),
    'loan_purp_specify' => $this->input->post('loan_purp_specify'),
    'existing_loan' => $this->input->post('existing_loan'),
    'existing_loan_specify' => $this->input->post('existing_loan_specify'),
    'existing_loan_repayment_amount' => $this->input->post('existing_loan_repayment_amount'),
    'loan_type' => $this->input->post('loan_type'),
    'bank_account' => $this->input->post('bank_account'),
    'nok_name' => $this->input->post('nok_name'),
    'relationship' => $this->input->post('relationship'),
    'nok_employer_name' => $this->input->post('nok_employer_name'),
    'nok_phone' => $this->input->post('nok_phone'),
    'nok_addr' => $this->input->post('nok_addr'),
    'nok_email' => $this->input->post('nok_email'),
    'loan_amount' => $this->input->post('loan_amount'),
    'loan_tenure_months' => $this->input->post('loan_tenure_months'),
    'account_name' => $this->input->post('account_name'),
    'bank_name' => $this->input->post('bank_name'),
    'account_number' => $this->input->post('account_number'),
    'bank_branch' => $this->input->post('bank_branch'),
    //'posted_by' =>$this->session->userdata('uname'),
    'status' => $status,
    'l2_approved' => $l2_approved,
    'last_updated' => $last_updated,
    'application_type' => $this->input->post('application_type'),
    'action_type' =>'update',
    'action_user' =>$uname = $this->session->userdata('uname')
    
  );
     $this->db->where('lsid', $id);
     $this->db->update('lasg_staff_info', $data);

     $this->audit_trigger($id); //audit-trail record transaction log
  }
  public function update_loan_primera($status,$id)
  {

    if($status=="approved")
    {

     $monthly_salary = str_replace(",","",$this->input->post('monthly_salary'));
      $monthly_expense = str_replace(",","",$this->input->post('monthly_expense'));
      $loan_amount = str_replace(",","",$this->input->post('loan_amount'));

     $last_updated=date('Y-m-d');
     $date_approved=date('Y-m-d');
     $data = array(
     'oracle_number' => $this->input->post('oracle_number'),
    'title' => $this->input->post('title'),
    'sname' => $this->input->post('sname'),
    'mname' => $this->input->post('mname'),
    'fname' => $this->input->post('fname'),
    'maiden_name' => $this->input->post('maiden_name'),
    'dob' => $this->input->post('dob'),
    'gender' => $this->input->post('gender'),
    'means_of_id' => $this->input->post('means_of_id'),
    'mobile_number' => $this->input->post('mobile_number'),
    'email' => $this->input->post('email'),
    'home_addr' => $this->input->post('home_addr'),
    'lga' => $this->input->post('lga'),
    'landmark' => $this->input->post('landmark'),
    'marital_status' => $this->input->post('marital_status'),
    'dependents' => $this->input->post('dependents'),
    'emp_status' => $this->input->post('emp_status'),
    'current_emp' => $this->input->post('current_emp'),
    'current_emp_addr' => $this->input->post('current_emp_addr'),
    'dept' => $this->input->post('dept'),
    'dept_addr' => $this->input->post('dept_addr'),
    'landmark_emp' => $this->input->post('landmark_emp'),
    'lga_emp' => $this->input->post('lga_emp'),
    'state_emp' => $this->input->post('state_emp'),
    'employer_phone' => $this->input->post('employer_phone'),
    'official_email' => $this->input->post('official_email'),
    'industry' => $this->input->post('industry'),
    'level_of_edu' => $this->input->post('level_of_edu'),
    'monthly_salary' => $monthly_salary,
    'monthly_expense' => $monthly_expense,
    'pay_day' => $this->input->post('pay_day'),
    'purp_of_loan' => $this->input->post('purp_of_loan'),
    'loan_purp_specify' => $this->input->post('loan_purp_specify'),
    'existing_loan' => $this->input->post('existing_loan'),
    'existing_loan_specify' => $this->input->post('existing_loan_specify'),
    'existing_loan_repayment_amount' => $this->input->post('existing_loan_repayment_amount'),
    'loan_type' => $this->input->post('loan_type'),
    'bank_account' => $this->input->post('bank_account'),
    'nok_name' => $this->input->post('nok_name'),
    'relationship' => $this->input->post('relationship'),
    'nok_employer_name' => $this->input->post('nok_employer_name'),
    'nok_phone' => $this->input->post('nok_phone'),
    'nok_addr' => $this->input->post('nok_addr'),
    'nok_email' => $this->input->post('nok_email'),
    'loan_amount' => $loan_amount,
    'loan_tenure_months' => $this->input->post('loan_tenure_months'),
    'account_name' => $this->input->post('account_name'),
    'bank_name' => $this->input->post('bank_name'),
    'account_number' => $this->input->post('account_number'),
    'bank_branch' => $this->input->post('bank_branch'),
    'disbursed_amount' => $this->input->post('disbursed_amount'),
    'booked_amount' => $this->input->post('booked_amount'),
    //'outstanding' => $this->input->post('booked_amount'),
    'rejection_reason' => $this->input->post('rejection_reason'),
    'status' => $status,
    'first_repayment_date' => $this->input->post('repayment_date'),
    'date_disbursed' => $this->input->post('date_disbursed'),
    'last_updated' => $last_updated,
    'date_approved' =>$date_approved,
    'action_type' =>'update',
    'action_user' =>$uname = $this->session->userdata('uname')
      );
       
      //insert into due payments
      //$this->insert_in_due_payments_first($id);  //compute due date at first approval

         $this->db->where('lsid', $id);
         $this->db->update('lasg_staff_info', $data);

         $this->audit_trigger($id);


         
     }
    else if($status=="declined")
   {
       $last_updated=date('Y-m-d');
        $date_declined=date('Y-m-d');
        $data = array(
       'disbursed_amount' => $this->input->post('disbursed_amount'),
       'booked_amount' => $this->input->post('booked_amount'),
       //'outstanding' => $this->input->post('booked_amount'),
       'rejection_reason' => $this->input->post('rejection_reason'),
       'status' => $status,
       'first_repayment_date' => $this->input->post('repayment_date'),
       'date_disbursed' => $this->input->post('date_disbursed'),
       'last_updated' => $last_updated,
       'date_declined' =>$date_declined,
       'action_type' =>'update',
       'action_user' =>$uname = $this->session->userdata('uname')
       
     );
        $this->db->where('lsid', $id);
        $this->db->update('lasg_staff_info', $data);

        $this->audit_trigger($id); //audit-trail record transaction log
   
   }
    else if($status=="rejected")
   {
       $last_updated=date('Y-m-d');
        //$date_declined=date('Y-m-d');
        $data = array(
       'rejection_reason_l2' => $this->input->post('rejection_reason'),
       'status' => 'rejected',
       'last_updated' => $last_updated
       
     );
        $this->db->where('lsid', $id);
        $this->db->update('lasg_staff_info', $data);

        $this->audit_trigger($id); //audit-trail record transaction log
   
   }
  

}

function insert_in_due_payments_first($id)
{
      //echo "gets here";
       $result1=mysql_query("select * from lasg_staff_info where lsid='$id' "); //
       while($row=mysql_fetch_array($result1))
       {
            //echo "ajaja".$id."".$row['oracle_number'];
          //fetch record from table lasg staff_info
          $oracle_number=$row['oracle_number'];
          $employee_name=$row['sname']." ".$row['mname']." ".$row['fname'];
          $booked_amount=$row['booked_amount'];
          $tenure=$row['loan_tenure_months'];
          $credit="0";
          $balance=$row['booked_amount'];
          $balance=(double)($balance);
          $first_repayment_date=$row['first_repayment_date'];
          $last_repayment_date=$row['first_repayment_date'];
          $due_date=$row['first_repayment_date'];
          $interest=((4/100)*$booked_amount);
          $principal_amount=($booked_amount/$tenure);
          $repayment_amount=($principal_amount+$interest);


          $date = DateTime::createFromFormat("Y-m-d", $first_repayment_date);//obtaining day from last_repayment_date
          $day1 = $date->format("d"); //obtaining day from last_repayment_date
          $month1 = $date->format("m"); //obtaining month from last_repayment_date
          $year1 = $date->format("Y"); //obtaining day from last_repayment_date

          

          //compute first due payments and insert in table due payment
           $savedata=array(
          'oracle_number'=>$oracle_number,
          'employee_name'=>$employee_name,
          'credit'=>$credit,
          'repayment_amount'=>$repayment_amount,
          'balance'=>$balance,
          'booked_amount'=>$booked_amount,
          'tenure'=>$tenure,
          'month'=>$month1,
          'year'=>$year1,
          'first_repayment_date'=>$first_repayment_date,
          'last_repayment_date'=>$last_repayment_date,
          'due_date'=>$due_date
          );
          $this->db->insert('due_payments', $savedata);

          break ;
      }

}

   public function l2_approve($id)
  {

     $last_updated=date('Y-m-d');
     $l2_approved='yes' ;
     $data = array(
    'l2_approved' => $l2_approved,
    'last_updated' => $last_updated,
    'action_type' =>'update',
    'action_user' =>$uname = $this->session->userdata('uname')
  );
     $this->db->where('lsid', $id);
     $this->db->update('lasg_staff_info', $data);

     $this->audit_trigger($id); //audit-trail record transaction log
  }

  function insert_file_details($filename)
  { 
    $month=$this->input->post('month');
    $year=$this->input->post('year');
    $month_year=$month."_".$year ;
    $upload_date=date('Y-m-d');

    $data = array(
    'filename' => $filename,
    'upload_month' => $this->input->post('month'),
    'upload_year' => $this->input->post('year'),
    'upload_month_year' => $month_year,
    'narration' => $this->input->post('narration'),
    'total_amount' => $this->input->post('sum_amount'),
    'upload_date' => $upload_date,
    'status' => 'pending',
    'action_type' =>'insert',
    'action_user' =>$uname = $this->session->userdata('uname')
  );
     $this->db->insert('uploaded_files', $data);
     $file_id = $this->db->insert_id();
     $this->audit_trigger_file_upload($file_id); //audit-trail record transaction log

  }

  function delete_from_upload_files($filename1,$fileid)
  {
    $this->db->delete('uploaded_files', array('filename' => $filename1));
    $this->db->delete('deduction_report', array('file_id' => $fileid));
  }

  function get_csv()
  {
     return $query = $this->db->get('qusers');
  }

  function get_fileid_uploaded($filename1)
  {    
      $sql= "SELECT file_id FROM uploaded_files where filename='$filename1'";
      $query=$this->db->query($sql);
      return $query->row_array();
  }

  function get_approved_count($uname=0,$level="l1")
  {
    if($level=="l1")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where posted_by='$uname' and status='approved'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
    else if($level=="l2")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where status='installed'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
  }
  
  function get_authorized_count($uname=0,$level="l1")
  {
    if($level=="l1")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
    else if($level=="l2")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
  }

  function insert_from_uploaded($data)
  {

    return $this->db->insert('deduction_report', $data);
  }

  function get_pending_count($uname=0,$level="l1")
  {   
    if($level=="l1")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where posted_by='$uname' and status='pending' and l2_approved='yes'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
    else if($level=="l2")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where status='deployed'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
  }

  function get_pending_authorized_count($uname=0,$level="l1")
  {   
    if($level=="l1")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where posted_by='$uname' and l2_approved='no'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
    else if($level=="l2")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where l2_approved='no'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
  }

  function get_declined_count($uname=0,$level="l1")
  {
     if($level=="l1")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where posted_by='$uname' and status='declined'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
    else if($level=="l2")
    {
      $sql= "SELECT count(1) FROM lasg_staff_info where status='returned'";
      $query=$this->db->query($sql);
      return $query->row_array();
    }
  }
  
  function get_old_password($uname)
  {
    $query = $this->db->get_where('qusers', array('uname' => $uname)); //get a member detail  whose column id = $id
    return $query->row_array();
  }

  function update_password($uname)
  {
    $encrypted_password=$this->encrypt->encode($this->input->post('new_password'));
    $data = array(
    'pword' => $encrypted_password);
    $this->db->where('uname', $uname);
    return $this->db->update('qusers', $data);   
  }

  function update_qlip_upload($id,$status)
  {
    //update on uploaded_files table
    if($status=="approved")
    {
       $data = array(
       'statement_id' => $this->input->post('statement_id'),
       'credit_bank' => $this->input->post('credit_bank'),
       'value_date' => $this->input->post('value_date'),
       'narration_bank' => $this->input->post('narration_bank'),
       'status' => "approved",
       'entry_date_primera' => date('Y-m-d'),
       'action_type' =>'update',
       'action_user' =>$uname = $this->session->userdata('uname')
     );

     //update on deduction_report table as checked
     $data2 = array('checked' => "yes");
     $this->db->where('file_id', $id);
     $this->db->update('deduction_report', $data2); 

      //insert into due payments
      $this->insert_in_due_payments($id);


      $this->db->where('file_id', $id);
      $this->db->update('uploaded_files', $data); 
      $this->audit_trigger_file_upload($id); //audit-trail record transaction log
     
   }
   else if($status=="declined")
   {
       
       $data = array(
        'status' => "declined",
        'rejection_reason' => $this->input->post('rejection_reason'),
        'action_type' =>'update',
       'action_user' =>$uname = $this->session->userdata('uname')
        );
       
     //update column "checked" to declined on deduction_report table as checked
     //$this->db->delete('deduction_report', array('filename' => $filename1));
     $data2 = array(
      'checked' => "declined",
      'month' => "declined",
      'year' => "declined",
      'month_year' => "declined"
      );
     $this->db->where('file_id', $id);
     $this->db->update('deduction_report', $data2); 
     
     mysql_query("delete from reconciliation where file_id='$id'"); //clear record off reconciliation table
      
      $this->db->where('file_id', $id);
      $this->db->update('uploaded_files', $data);
      $this->audit_trigger_file_upload($id); //audit-trail record transaction log 

     
   }

  
}

function insert_in_due_payments($id)
{  
   $result1=mysql_query("select * from deduction_report where file_id='$id'"); //get all employee in attached file
       while($row=mysql_fetch_array($result1))
       {

          $oracle_number=$row['oracle_number'];
          $employee_name=$row['employee_name'];
          $ministry_name=$row['ministry_name'];
          $credit=$row['credit'];
          $ledger_balance=$row['ledger_balance'];
          $principal_from_credited=$row['principal_from_credited'];
          $interest_from_credited=$row['interest_from_credited'];
          $interest=$row['interest'];
          $principal_amount=$row['principal_amount'];
          $repayment_amount=$row['repayment_amount'];
          $balance=$row['balance'];
          $booked_amount=$row['booked_amount'];
          $tenure=$row['tenure'];
          $narration=$row['narration'];
          $element_name=$row['element_name'];
          $entry_date=$row['entry_date'];
          $checked=$row['checked'];
          $month_year=$row['month_year'];
          $month=$row['month'];
          $year=$row['year'];
          $first_repayment_date=$row['first_repayment_date'];
          $last_repayment_date=$row['last_repayment_date'];
          $due_date=$row['due_date'];
          $file_id=$row['file_id'];

          $result2=mysql_query("delete from due_payments where oracle_number='$oracle_number' and due_date='$last_repayment_date'"); //delete employee record last record from due payment
          $savedata=array(
          'oracle_number'=>$oracle_number,
          'employee_name'=>$employee_name,
          'ministry_name'=>$ministry_name,
          'credit'=>$credit,
          'ledger_balance'=>$ledger_balance,
          'principal_from_credited'=>$principal_from_credited,
          'interest_from_credited'=>$interest_from_credited,
          'interest'=>$interest,
          'principal_amount'=>$principal_amount,
          'repayment_amount'=>$repayment_amount,
          'balance'=>$balance,
          'booked_amount'=>$booked_amount,
          'tenure'=>$tenure,
          'narration'=>$narration,
          'element_name'=>$element_name,
          'entry_date'=>date('Y-m-d'),
          'checked'=>$checked,
          'month_year'=>$month_year,
          'month'=>$month,
          'year'=>$year,
          'first_repayment_date'=>$first_repayment_date,
          'last_repayment_date'=>$last_repayment_date,
          'due_date'=>$due_date,
          'file_id'=>$file_id
          );
          $this->db->insert('due_payments', $savedata);
       }
}//end function

  function get_log_csv($count=0)
  {
      $greater="" ; $less="" ;
      $start_date=$this->input->post('start_date');
      $end_date=$this->input->post('end_date'); 
      $filter_by=$this->input->post('filter_by'); 

      if(empty($start_date) && empty($end_date))
      {
        $sql="select * from ".$filter_by ;
        $query = $this->db->query($sql);
        return $query ;
      }
      else if(empty($start_date) && !empty($end_date))
      {
        $sql="select * from ".$filter_by." where log_date <= '$end_date'" ;
        $query = $this->db->query($sql);
        return $query ;
      }
      else if(!empty($start_date) && empty($end_date))
      {
          $sql="select * from ".$filter_by." where log_date >= '$start_date'" ;
          $query = $this->db->query($sql);
          return $query ;
      }
      else if(!empty($start_date) && !empty($end_date))
      {
          $sql="select * from ".$filter_by." where log_date>='$start_date' and log_date<= '$end_date'" ;
          $query = $this->db->query($sql);
          return $query ;
      }


  }

  function get_report_csv($count=0)
  {
    if($count==0)
    {
       $query = $this->db->get('lasg_staff_info'); //get a member detail  whose column id = $id
       return $query->result_array();
    }
    else if($count==1)
    {
      $start_date=$this->input->post('start_date');
      $end_date=$this->input->post('end_date'); 
      $report_type=$this->input->post('report_type');

      if($report_type=="all" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info ";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="all" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date' and date_applied<='$end_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }

       else if($report_type=="all" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
       else if($report_type=="all" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied<='$end_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
    }

  }

  function get_report_csv_primera()
  {
    
      $start_date=$this->input->post('start_date');
      $end_date=$this->input->post('end_date'); 
      $report_type=$this->input->post('report_type');

      if($report_type=="all" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where l2_approved='yes' ";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="all" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }

       else if($report_type=="all" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
       else if($report_type=="all" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="pending" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="declined" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="approved" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query ;
      }
    

  }

  function get_report_csv_l1($uname,$count=0)
  {
    if($count==0)
    {
       $query = $this->db->get('lasg_staff_info'); //get a member detail  whose column id = $id
       return $query->result_array();
    }
    else if($count==1)
    {
      $start_date=$this->input->post('start_date');
      $end_date=$this->input->post('end_date'); 
      $report_type=$this->input->post('report_type');

      if($report_type=="all" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="installed" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='installed'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="deployed" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='deployed'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="returned" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='returned'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="decommissioned" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='decommissioned'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="all" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where last_modified>='$start_date' and last_modified<='$end_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="installed" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='installed' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="deployed" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='deployed' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="returned" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='returned' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="decommissioned" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='decommissioned' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }

       else if($report_type=="all" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where last_modified>='$start_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="installed" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='installed' and last_modified>='$start_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="deployed" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='deployed' and last_modified>='$start_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="returned" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='returned' and last_modified>='$start_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="decommissioned" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='decommissioned' and last_modified>='$start_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
       else if($report_type=="all" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="installed" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='installed' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="deployed" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='deployed' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="returned" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS,last_modified as LAST_MODIFIED FROM lasg_staff_info where status='returned' and last_modified<='$end_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
      else if($report_type=="decommissioned" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT installer_name as INSTALLER,serial as SERIAL,model as MODEL,category as CATEGORY,asset_type as ASSET_TYPE,asset_name as ASSET_NAME,specification as SPECIFICATION,purchase_date as PURCHASE_DATE,warranty as WARRANTY,expiry_date as EXPIRY_DATE,date_installed as DATE_INSTALLED,status as STATUS FROM lasg_staff_info where status='decommissioned' and last_modified<='$end_date' ";
        $query=$this->db->query($sql);
        return $query ;
      }
    }

  }

  function get_reports($count=0)
  {
    if($count==0)
    {
       $query = $this->db->get('lasg_staff_info'); //get a member detail  whose column id = $id
       return $query->result_array();
    }
    else if($count==1)
    {
      $start_date=$this->input->post('start_date');
      $end_date=$this->input->post('end_date'); 
      $report_type=$this->input->post('report_type');

      if($report_type=="all" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="all" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date' and date_applied<='$end_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }

       else if($report_type=="all" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
       else if($report_type=="all" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied<='$end_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
       
    }

  }

  function get_reports_primera($count=0)
  {
    if($count==0)
    {
       $sql= "SELECT * FROM lasg_staff_info where l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    else if($count==1)
    {
      $start_date=$this->input->post('start_date');
      $end_date=$this->input->post('end_date'); 
      $report_type=$this->input->post('report_type');

      if($report_type=="all" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="all" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }

       else if($report_type=="all" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied>='$start_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
       else if($report_type=="all" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="pending" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='pending' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="declined" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='declined' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="approved" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT oracle_number,l2_approved,sname,loan_tenure_months,mname,fname,loan_amount,disbursed_amount,booked_amount,outstanding,date_applied,posted_by,status FROM lasg_staff_info where status='approved' and date_applied<='$end_date' and l2_approved='yes'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
       
    }

  }

   function get_reports_l1($uname,$count=0)
  {
    if($count==0)
    {
       $query = $this->db->get('lasg_staff_info'); //get a member detail  whose column id = $id  $Q = $this->db->get_where('qusers', array('uname'=>$uname));
       return $query->result_array();
    }
    else if($count==1)
    {
      $start_date=$this->input->post('start_date');
      $end_date=$this->input->post('end_date'); 
      $report_type=$this->input->post('report_type');

      if($report_type=="all" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT * FROM lasg_staff_info";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="installed" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT * FROM lasg_staff_info where status='installed'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="deployed" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT * FROM lasg_staff_info where status='deployed'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="returned" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT * FROM lasg_staff_info where status='returned'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="decommissioned" && $end_date=="" && $start_date=="")
      {
        $sql= "SELECT * FROM lasg_staff_info where status='decommissioned'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="all" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where last_modified>='$start_date' and last_modified<='$end_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="installed" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='installed' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="deployed" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='deployed' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="returned" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='returned' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="decommissioned" && !empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='decommissioned' and last_modified>='$start_date' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }

       else if($report_type=="all" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where last_modified>='$start_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="installed" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='installed' and last_modified>='$start_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="deployed" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='deployed' and last_modified>='$start_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="returned" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='returned' and last_modified>='$start_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="decommissioned" && empty($end_date) && !empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='decommissioned' and last_modified>='$start_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
       else if($report_type=="all" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="installed" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='installed' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="deployed" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='deployed' and last_modified<='$end_date'";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="returned" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='returned' and last_modified<='$end_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
      else if($report_type=="decommissioned" && !empty($end_date) && empty($start_date))
      {
        $sql= "SELECT * FROM lasg_staff_info where status='decommissioned' and last_modified<='$end_date' ";
        $query=$this->db->query($sql);
        return $query->result_array();
      }
       
    }

  }

  function search_filter_dashboard($uname,$status)
  {
      if($uname == "level2")
      {
          if($status=="approved")
         {
            $sql= "SELECT * FROM lasg_staff_info where status='installed'";
            $query=$this->db->query($sql);
            return $query->result_array();
         }
         else if($status=="pending")
         {
            $sql= "SELECT * FROM lasg_staff_info where status='deployed'";
            $query=$this->db->query($sql);
            return $query->result_array();
         }
         else if($status=="declined")
         {
            $sql= "SELECT * FROM lasg_staff_info where status='returned'";
            $query=$this->db->query($sql);
            return $query->result_array();
         }
         else if($status=="total")
         {
            $sql= "SELECT * FROM lasg_staff_info";
            $query=$this->db->query($sql);
            return $query->result_array();
         }
         else if($status=="decommissioned")
         {
            $sql= "SELECT * FROM lasg_staff_info where status='decommissioned'";
            $query=$this->db->query($sql);
            return $query->result_array();
         }
         /*else
         {
            $sql= "SELECT * FROM lasg_staff_info where status='$status' and l2_approved='yes'";
            $query=$this->db->query($sql);
            return $query->result_array();
         }*/
      }
      

  }

  function search_filter($uname)
  {
    if($uname==1)
    {
          $filter_by = $this->input->post('filter_by');
           $start_date = $this->input->post('start_date');
           $end_date = $this->input->post('end_date');
           $keyword = $this->input->post('keyword');
           
           if(empty($filter_by) && empty($start_date) && empty($end_date) && !empty($keyword))
           {
               $sql= "SELECT * FROM lasg_staff_info where (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           else if(empty($filter_by) && !empty($keyword))
           {
               $sql= "SELECT * FROM lasg_staff_info where (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           
           
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_installed")
               {
                  $sql= "SELECT * FROM lasg_staff_info where date_installed>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="purchase_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where purchase_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_installed")
               {
                  $sql= "SELECT * FROM lasg_staff_info where date_installed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="purchase_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where purchase_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_installed")
               {
                  $sql= "SELECT * FROM lasg_staff_info where date_installed>='$start_date' and date_installed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="purchase_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where purchase_date>='$start_date' and purchase_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_installed")
               {
                  $sql= "SELECT * FROM lasg_staff_info where date_installed>='$start_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="purchase_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where purchase_date>='$start_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_installed")
               {
                  $sql= "SELECT * FROM lasg_staff_info where date_installed<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="purchase_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where purchase_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_installed")
               {
                  $sql= "SELECT * FROM lasg_staff_info where date_installed>='$start_date' and date_installed<='$end_date' and ((status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="purchase_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where purchase_date>='$start_date' and purchase_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }

           else
           {
             $sql= "SELECT * FROM lasg_staff_info";
             $query=$this->db->query($sql);
             return $query->result_array();
           }

    } //end if

  }


  function search_filter_deployed($uname)
  {
    if($uname==1)
    {
          $filter_by = $this->input->post('filter_by');
           $start_date = $this->input->post('start_date');
           $end_date = $this->input->post('end_date');
           $keyword = $this->input->post('keyword');
           
           if(empty($filter_by) && empty($start_date) && empty($end_date) && !empty($keyword))
           {
               $sql= "SELECT * FROM deployed where (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           else if(empty($filter_by) && !empty($keyword))
           {
               $sql= "SELECT * FROM deployed where (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           
           
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && empty($keyword))
           {
               if($filter_by=="request_date")
               {
                  $sql= "SELECT * FROM deployed where request_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="request_date")
               {
                  $sql= "SELECT * FROM deployed where request_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="request_date")
               {
                  $sql= "SELECT * FROM deployed where request_date>='$start_date' and request_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date' and date_deployed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && !empty($keyword))
           {
               if($filter_by=="request_date")
               {
                  $sql= "SELECT * FROM deployed where request_date>='$start_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="request_date")
               {
                  $sql= "SELECT * FROM deployed where request_date<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="request_date")
               {
                  $sql= "SELECT * FROM deployed where request_date>='$start_date' and request_date<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date' and date_deployed<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }

           else
           {
             $sql= "SELECT * FROM deployed";
             $query=$this->db->query($sql);
             return $query->result_array();
           }

    } //end if

  }


  function search_filter_returned($uname)
  {
    if($uname==1)
    {
          $filter_by = $this->input->post('filter_by');
           $start_date = $this->input->post('start_date');
           $end_date = $this->input->post('end_date');
           $keyword = $this->input->post('keyword');
           
           if(empty($filter_by) && empty($start_date) && empty($end_date) && !empty($keyword))
           {
               $sql= "SELECT * FROM returned where (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           else if(empty($filter_by) && !empty($keyword))
           {
               $sql= "SELECT * FROM returned where (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           
           
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned>='$start_date' and date_returned<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date' and date_deployed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned>='$start_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned>='$start_date' and date_returned<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned>='$start_date' and date_returned<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }

           else
           {
             $sql= "SELECT * FROM returned";
             $query=$this->db->query($sql);
             return $query->result_array();
           }

    } //end if

  }


  function search_filter_decommissioned($uname)
  {
    if($uname==1)
    {
          $filter_by = $this->input->post('filter_by');
           $start_date = $this->input->post('start_date');
           $end_date = $this->input->post('end_date');
           $keyword = $this->input->post('keyword');
           
           if(empty($filter_by) && empty($start_date) && empty($end_date) && !empty($keyword))
           {
               $sql= "SELECT * FROM decommissioned where (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           else if(empty($filter_by) && !empty($keyword))
           {
               $sql= "SELECT * FROM decommissioned where (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
               $query=$this->db->query($sql);
               return $query->result_array();
           }
           
           
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_decommissioned")
               {
                  $sql= "SELECT * FROM decommissioned where date_returned>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_decommissioned")
               {
                  $sql= "SELECT * FROM decommissioned where date_decommissioned<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && empty($keyword))
           {
               if($filter_by=="date_decommissioned")
               {
                  $sql= "SELECT * FROM decommissioned where date_decommissioned>='$start_date' and date_decommissioned<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date' and date_deployed<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date'";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_decommissioned")
               {
                  $sql= "SELECT * FROM decommissioned where date_returned>='$start_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed>='$start_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_decommissioned")
               {
                  $sql= "SELECT * FROM decommissioned where date_decommissioned<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_deployed")
               {
                  $sql= "SELECT * FROM deployed where date_deployed<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }
           else if(!empty($filter_by) && !empty($start_date) && !empty($end_date) && !empty($keyword))
           {
               if($filter_by=="date_decommissioned")
               {
                  $sql= "SELECT * FROM decommissioned where date_decommissioned>='$start_date' and date_decommissioned<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%' or employee_name like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="date_returned")
               {
                  $sql= "SELECT * FROM returned where date_returned>='$start_date' and date_returned<='$end_date' and (status like '%$keyword%' or deployed_by like '%$keyword%' or tag_no like '%$keyword%' or asset_type like '%$keyword%' or hostname like '%$keyword%' or ip_address like '%$keyword%' or serial_no like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="expiry_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where expiry_date>='$start_date' and expiry_date<='$end_date' and (status like '%$keyword%' or installer_name like '%$keyword%' or category like '%$keyword%' or asset_type like '%$keyword%' or asset_name like '%$keyword%' or model like '%$keyword%' or serial like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }
               /*else if($filter_by=="first_repayment_date")
               {
                  $sql= "SELECT * FROM lasg_staff_info where first_repayment_date>='$start_date' and first_repayment_date<='$end_date' and (status like '%$keyword%' or l2_approved like '%$keyword%' or oracle_number like '%$keyword%' or sname like '%$keyword%' or mname like '%$keyword%' or fname like '%$keyword%')";
                  $query=$this->db->query($sql);
                  return $query->result_array();
               }*/

           }

           else
           {
             $sql= "SELECT * FROM decommissioned";
             $query=$this->db->query($sql);
             return $query->result_array();
           }

    } //end if

  }
    

  

  function get_due_payments_csv($uname)
  {
    if($uname=="l2")
    {
       $filter_by=$this->input->post('filter_by');
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date'); 

       if($filter_by=="due_date" && empty($start_date) && empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM due_payments";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="last_repayment_date" && empty($start_date) && empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM due_payments";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="due_date" && !empty($start_date) && empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM due_payments where due_date>='$start_date'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="due_date" && empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM due_payments where due_date<='$end_date'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="due_date" && !empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM due_payments where due_date>='$start_date' and due_date<='$end_date'";
        $query=$this->db->query($sql);
        return $query;
      }

      else if($filter_by=="last_repayment_date" && !empty($start_date) && empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM deduction_report where last_repayment_date>='$start_date' and checked='yes'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="last_repayment_date" && empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM deduction_report where last_repayment_date<='$end_date' and checked='yes' ";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="last_repayment_date" && !empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT oracle_number,employee_name,booked_amount,tenure,repayment_amount,credit as amount_credited,balance,first_repayment_date,last_repayment_date,due_date FROM deduction_report where last_repayment_date>='$start_date' and last_repayment_date<='$end_date'";
        $query=$this->db->query($sql);
        return $query;
      }
      
    }

    else
    {
       $filter_by=$this->input->post('filter_by');
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date'); 

       if($filter_by=="due_date" && empty($start_date) && empty($end_date))
      {
        $sql= "SELECT due_payments.oracle_number,due_payments.employee_name,due_payments.booked_amount,due_payments.tenure,due_payments.repayment_amount,due_payments.credit as amount_credited,due_payments.balance,due_payments.first_repayment_date,due_payments.last_repayment_date,due_payments.due_date FROM due_payments inner join lasg_staff_info on due_payments.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="last_repayment_date" && empty($start_date) && empty($end_date))
      {
        $sql= "SELECT due_payments.oracle_number,due_payments.employee_name,due_payments.booked_amount,due_payments.tenure,due_payments.repayment_amount,due_payments.credit as amount_credited,due_payments.balance,due_payments.first_repayment_date,due_payments.last_repayment_date,due_payments.due_date FROM due_payments inner join lasg_staff_info on due_payments.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="due_date" && !empty($start_date) && empty($end_date))
      {
        $sql= "SELECT due_payments.oracle_number,due_payments.employee_name,due_payments.booked_amount,due_payments.tenure,due_payments.repayment_amount,due_payments.credit as amount_credited,due_payments.balance,due_payments.first_repayment_date,due_payments.last_repayment_date,due_payments.due_date FROM due_payments inner join lasg_staff_info on due_payments.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' and due_payments.due_date>='$start_date'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="due_date" && empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT due_payments.oracle_number,due_payments.employee_name,due_payments.booked_amount,due_payments.tenure,due_payments.repayment_amount,due_payments.credit as amount_credited,due_payments.balance,due_payments.first_repayment_date,due_payments.last_repayment_date,due_payments.due_date FROM due_payments inner join lasg_staff_info on due_payments.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' and due_payments.due_date<='$end_date'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="due_date" && !empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT due_payments.oracle_number,due_payments.employee_name,due_payments.booked_amount,due_payments.tenure,due_payments.repayment_amount,due_payments.credit as amount_credited,due_payments.balance,due_payments.first_repayment_date,due_payments.last_repayment_date,due_payments.due_date FROM due_payments inner join lasg_staff_info on due_payments.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' and due_payments.due_date>='$start_date' and due_payments.due_date<='$end_date'";
        $query=$this->db->query($sql);
        return $query;
      }

      else if($filter_by=="last_repayment_date" && !empty($start_date) && empty($end_date))
      {
        $sql= "SELECT deduction_report.oracle_number,deduction_report.employee_name,deduction_report.booked_amount,deduction_report.tenure,deduction_report.repayment_amount,deduction_report.credit as amount_credited,deduction_report.balance,deduction_report.first_repayment_date,deduction_report.last_repayment_date,deduction_report.due_date FROM deduction_report inner join lasg_staff_info on deduction_report.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' and deduction_report.last_repayment_date>='$start_date' and deduction_report.checked='yes'";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="last_repayment_date" && empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT deduction_report.oracle_number,deduction_report.employee_name,deduction_report.booked_amount,deduction_report.tenure,deduction_report.repayment_amount,deduction_report.credit as amount_credited,deduction_report.balance,deduction_report.first_repayment_date,deduction_report.last_repayment_date,deduction_report.due_date FROM deduction_report inner join lasg_staff_info on deduction_report.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' and deduction_report.last_repayment_date<='$end_date' and deduction_report.checked='yes' ";
        $query=$this->db->query($sql);
        return $query;
      }
      else if($filter_by=="last_repayment_date" && !empty($start_date) && !empty($end_date))
      {
        $sql= "SELECT deduction_report.oracle_number,deduction_report.employee_name,deduction_report.booked_amount,deduction_report.tenure,deduction_report.repayment_amount,deduction_report.credit as amount_credited,deduction_report.balance,deduction_report.first_repayment_date,deduction_report.last_repayment_date,deduction_report.due_date FROM deduction_report inner join lasg_staff_info on deduction_report.oracle_number=lasg_staff_info.oracle_number where lasg_staff_info.posted_by='$uname' and deduction_report.last_repayment_date>='$start_date' and deduction_report.last_repayment_date<='$end_date'";
        $query=$this->db->query($sql);
        return $query;
      }
      
    }

  }

  function get_recon_report($uname)
  {
    if($uname=="l2")
    {
       $filter_by=$this->input->post('filter_by');
       $month=$this->input->post('month');
       $year=$this->input->post('year');
        
        if($filter_by=="all" && $month=="all" && $year=="all")
        {
           $sql= "SELECT * FROM reconciliation";
           $query=$this->db->query($sql);
           return $query->result_array();
        }
        else if($filter_by=="all" && $month!="all" && $year!="all")
        {
           $sql= "SELECT * FROM reconciliation where month='$month' and year='$year'";
           $query=$this->db->query($sql);
           return $query->result_array();
        }
        else if($filter_by!="all" && $month=="all" && $year=="all")
        {
           $sql= "SELECT * FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by')";
           $query=$this->db->query($sql);
           return $query->result_array();
        }
        else if($filter_by!="all" && $month=="all" && $year!="all")
        {
           $sql= "SELECT * FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by') and year='$year'";
           $query=$this->db->query($sql);
           return $query->result_array();
        }
        else if($filter_by!="all" && $month!="all" && $year=="all")
        {
           $sql= "SELECT * FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by') and month='$month'";
           $query=$this->db->query($sql);
           return $query->result_array();
        }
        else if($filter_by!="all" && $month!="all" && $year!="all")
        {
           $sql= "SELECT * FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by') and month='$month' and year='$year'";
           $query=$this->db->query($sql);
           return $query->result_array();
        }
        else
        {
          $sql= "SELECT * FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by') and (month like  '%$month%') and year like ('%$year%') ";
          $query=$this->db->query($sql);
          return $query->result_array();
        }
        
       
    }

  }

  function get_recon_report_csv($uname)
  {
    if($uname=="l2")
    {
       $filter_by=$this->input->post('filter_by');
       $month=$this->input->post('month');
       $year=$this->input->post('year');
        
        if($filter_by=="all" && $month=="all" && $year=="all")
        {
           $sql= "SELECT file_id,oracle_number as oracle_no,employee_name_primera as name_on_primera_sheet,employee_name_qlip as name_on_qlip_sheet,month as repayment_month,year as repayment_year,credit_primera as amount_on_primera_sheet,credit_qlip as amount_on_qlip_sheet,difference,balance,matched,comment,recon_date FROM reconciliation";
           $query=$this->db->query($sql);
           return $query;
        }
        else if($filter_by=="all" && $month!="all" && $year!="all")
        {
           $sql= "SELECT file_id,oracle_number as oracle_no,employee_name_primera as name_on_primera_sheet,employee_name_qlip as name_on_qlip_sheet,month as repayment_month,year as repayment_year,credit_primera as amount_on_primera_sheet,credit_qlip as amount_on_qlip_sheet,difference,balance,matched,comment,recon_date FROM reconciliation where month='$month' and year='$year'";
           $query=$this->db->query($sql);
           return $query;
        }
        else if($filter_by!="all" && $month=="all" && $year=="all")
        {
           $sql= "SELECT file_id,oracle_number as oracle_no,employee_name_primera as name_on_primera_sheet,employee_name_qlip as name_on_qlip_sheet,month as repayment_month,year as repayment_year,credit_primera as amount_on_primera_sheet,credit_qlip as amount_on_qlip_sheet,difference,balance,matched,comment,recon_date FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by')";
           $query=$this->db->query($sql);
           return $query;
        }
        else if($filter_by!="all" && $month=="all" && $year!="all")
        {
           $sql= "SELECT file_id,oracle_number as oracle_no,employee_name_primera as name_on_primera_sheet,employee_name_qlip as name_on_qlip_sheet,month as repayment_month,year as repayment_year,credit_primera as amount_on_primera_sheet,credit_qlip as amount_on_qlip_sheet,difference,balance,matched,comment,recon_date FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by') and year='$year'";
           $query=$this->db->query($sql);
           return $query;
        }
        else if($filter_by!="all" && $month!="all" && $year=="all")
        {
           $sql= "SELECT file_id,oracle_number as oracle_no,employee_name_primera as name_on_primera_sheet,employee_name_qlip as name_on_qlip_sheet,month as repayment_month,year as repayment_year,credit_primera as amount_on_primera_sheet,credit_qlip as amount_on_qlip_sheet,difference,balance,matched,comment,recon_date FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by') and month='$month'";
           $query=$this->db->query($sql);
           return $query;
        }
        else if($filter_by!="all" && $month!="all" && $year!="all")
        {
           $sql= "SELECT file_id,oracle_number as oracle_no,employee_name_primera as name_on_primera_sheet,employee_name_qlip as name_on_qlip_sheet,month as repayment_month,year as repayment_year,credit_primera as amount_on_primera_sheet,credit_qlip as amount_on_qlip_sheet,difference,balance,matched,comment,recon_date FROM reconciliation where (matched = '$filter_by' or comment = '$filter_by') and month='$month' and year='$year'";
           $query=$this->db->query($sql);
           return $query;
        }
        
      }

  }

  function download_uploaded($file_id)
  {
     $sql= "SELECT oracle_number,employee_name,ministry_name,credit as Result_Value_SUM,element_name FROM deduction_report where file_id='$file_id'";
     $query=$this->db->query($sql);
     return $query ;

  }

  function get_matched_count($id)
  {
    $sql="select count(1) from reconciliation where matched='matched' and file_id='$id'";
    $query=$this->db->query($sql);
    return $query->row_array();

  } //get_unmatched_count

  function get_unmatched_count($id)
  {
    $sql="select count(1) from reconciliation where matched='not-matched' and file_id='$id'";
    $query=$this->db->query($sql);
    return $query->row_array();

  }

  function get_primera_count($id)
  {
    $sql="select count(1) from reconciliation where comment='record found on primera sheet only' and file_id='$id'";
    $query=$this->db->query($sql);
    return $query->row_array();

  }

  function get_qlip_count($id)
  {
    $sql="select count(1) from reconciliation where comment='record found on qlip sheet only' and file_id='$id'";
    $query=$this->db->query($sql);
    return $query->row_array();

  }

  function search_qlip_uploads()
  {
    $filter_by=$this->input->post('filter_by');
    $start_date=$this->input->post('start_date');
    $end_date=$this->input->post('end_date');
    $keyword=$this->input->post('keyword');
    
    if (empty($filter_by) && empty($start_date) && empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (empty($filter_by) && empty($start_date) && empty($end_date) && !empty($keyword))
    {
      $sql="select * from uploaded_files where (upload_month like '%$keyword%' or upload_year like '%$keyword%' or upload_month_year like '%$keyword%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (!empty($filter_by) && empty($start_date) && empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    
    else if (!empty($filter_by) && !empty($start_date) && empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (!empty($filter_by) && empty($start_date) && !empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date<='$end_date'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (!empty($filter_by) && empty($start_date) && !empty($end_date) && !empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date<='$end_date' and (upload_month like '%$keyword%' or upload_year like '%$keyword%' or upload_month_year like '%$keyword%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (!empty($filter_by) && !empty($start_date) && empty($end_date) && !empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date' and (upload_month like '%$keyword%' or upload_year like '%$keyword%' or upload_month_year like '%$keyword%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (!empty($filter_by) && !empty($start_date) && !empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date' and upload_date<='$end_date'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (!empty($filter_by) && !empty($start_date) && !empty($end_date) && !empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date' and upload_date<='$end_date' and (upload_month like '%$keyword%' or upload_year like '%$keyword%' or upload_month_year like '%$keyword%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }


    else if (empty($filter_by) && !empty($start_date) && empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (empty($filter_by) && empty($start_date) && !empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date<='$end_date'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (empty($filter_by) && empty($start_date) && !empty($end_date) && !empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date<='$end_date' and (upload_month like '%k$eyword%' or upload_year like '%$keyword%' or upload_month_year like '%$keyword%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (empty($filter_by) && !empty($start_date) && empty($end_date) && !empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date' and (upload_month like '%$keyword%' or upload_year like '%$keyword%' or upload_month_year like '%$keyword%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (empty($filter_by) && !empty($start_date) && !empty($end_date) && empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date' and upload_date<='$end_date'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else if (empty($filter_by) && !empty($start_date) && !empty($end_date) && !empty($keyword))
    {
      $sql="select * from uploaded_files where status = '$filter_by' and upload_date>='$start_date' and upload_date<='$end_date' and (upload_month like '%$keyword%' or upload_year like '%$keyword%' or upload_month_year like '%$keyword%')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    else
    {
      $sql="select * from uploaded_files";
      $query=$this->db->query($sql);
      return $query->result_array(); 
    }

  }

  function que_for_t24_push($id)
  {

    
    $result = mysql_query("select * from lasg_staff_info where lsid = '$id'");
    while($row = mysql_fetch_array($result))
    {
        $oracle_no = $row['oracle_number'];
        $customer_name = $row['sname']." ".$row['mname']." ".$row['fname'];
        $date_approved = $row['date_approved'];

        $data = array
       (
          'lsid' => $id,
          'oracle_number' => $oracle_no,
          'customer_name' => $customer_name,
          'date_approved' => $date_approved,
          'status' => 'pending'
       );
       $this->db->insert('push_24_status', $data);
        
    }

  }//end function que_for_t24_push

  function audit_trigger($id)
  {
    $sql = "insert into lasg_staff_info_audit (`lsid`, `unique_id`, `installer_name`, `project`, `department`, `state`, `city`, `lg`, `category`, `asset_type`, `asset_name`, `model`, `serial`, `specification`, `po_number`, `vendor`, `purchase_date`, `warranty`, `expiry_date`, `date_installed`, `posted_by`, `status`, `install_type`, `available`, `l2_approved`, `last_updated`, `date_applied`, `log_date`, `last_modified`, `view_mode`, `user_viewing`, `action_type`, `action_user`, `qlip_id`)select * from lasg_staff_info where lsid='$id' ";
    $query = $this->db->query($sql);

    $date_=date('Y-m-d');
    $sql = "update lasg_staff_info_audit set log_date='$date_' where lsid='$id'";
    $this->db->query($sql);

  }

  function audit_trigger_deployed($id)
  {
    $sql = "insert into `deployed_audit` (`did`, `install_id`, `return_id`, `serial_no`, `organisation`, `country`, `region`, `city`, `address`, `office_type`, `room_no`, `employee_name`, `employee_no`, `contact_no`, `department`, `email`, `request_date`, `user_approval`, `request_description`, `dept_manager_name`, `dept_manager_approval`, `dept_approval_date`, `it_manager_name`, `it_manager_approval`, `it_approval_date`, `asset_type`, `tag_no`, `hostname`, `product_id`, `port`, `ip_address`, `owned_by`, `specifications`, `date_deployed`, `engineer`, `deployed_by`, `project`, `status`, `log_date`, `action_type`, `action_user`)select * from deployed where did='$id'";
    $query = $this->db->query($sql);

    $date_=date('Y-m-d');
    $sql = "update deployed_audit set log_date='$date_' where did='$id'";
    $this->db->query($sql);
  }

  function audit_trigger_returned($id)
  {
    $sql = "INSERT INTO `returned_audit` (`rid`, `deploy_id`, `serial_no`, `organisation`, `country`, `region`, `city`, `address`, `office_type`, `room_no`, `employee_name`, `employee_no`, `contact_no`, `department`, `email`, `request_date`, `user_approval`, `request_description`, `dept_manager_name`, `dept_manager_approval`, `dept_approval_date`, `it_manager_name`, `it_manager_approval`, `it_approval_date`, `asset_type`, `tag_no`, `hostname`, `product_id`, `port`, `ip_address`, `owned_by`, `specifications`, `date_returned`, `engineer`, `deployed_by`, `project`, `status`, `log_date`, `action_type`, `action_user`)select * from returned where rid='$id'";
    $query = $this->db->query($sql);

    $date_=date('Y-m-d');
    $sql = "update returned_audit set log_date='$date_' where rid='$id'";
    $this->db->query($sql);
  }

  function audit_trigger_decommissioned($id)
  {
    $sql = "INSERT INTO `decommissioned_audit` (`rid`, `deploy_id`, `serial_no`, `organisation`, `country`, `region`, `city`, `address`, `office_type`, `room_no`, `employee_name`, `employee_no`, `contact_no`, `department`, `email`, `request_date`, `user_approval`, `request_description`, `dept_manager_name`, `dept_manager_approval`, `dept_approval_date`, `it_manager_name`, `it_manager_approval`, `log_date`, `asset_type`, `tag_no`, `hostname`, `product_id`, `port`, `ip_address`, `owned_by`, `specifications`, `date_returned`, `decommissioned_by`, `deployed_by`, `project`, `status`, `date_decommissioned`, `action_type`, `action_user`)select * from decommissioned where rid='$id'";
    $query = $this->db->query($sql);

    $date_=date('Y-m-d');
    $sql = "update decommissioned_audit set log_date='$date_' where rid='$id'";
    $this->db->query($sql);
  }

}//end class



?>