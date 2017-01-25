<?php
ob_start();
class qlip_controller extends CI_Controller 
{

   public function __construct()
   {
       parent::__construct();

       //$this->load->library('encrypt');
       $this->load->library('session');
       $this->load->model('Qlip_model');
        $this->load->library('form_validation');

        $ud = $this->session->userdata('userid');
           if ($ud < 1)
           {
              redirect('user_login_c/index','refresh');
           }
           $this->load->helper(array('form', 'url'));

           $this->clear_uploads(); // clears all the excel sheet uploaded

   }

  public function index()
  {
     
    
  }

 function open_admin_section($search=0)
 {
     /*$data['title'] = 'Admin Dashboard';
     $data['content'] = 'admin_dashboard';
     $this->load->view('admin_template',$data);*/


     if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     /*$data['breakdown_data'] = $this->Qlip_model->get_data('breakdown');
     $booked_sum = $this->Qlip_model->get_data('booked_sum');
    $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
     $data['report_data'] = $this->Qlip_model->get_reports(); //get status(pend,appro,decli) for all users,show in spool page
     $data['breakdown'] = 'Admin Dashboard';
     $data['director']="blanck"; //this is an indictor to direct the level2 dashboard to either ledger balance or search page 
     $data['title'] = 'Admin Dashboard';
     $data['content'] = 'admin_dashboard';
     $this->load->view('admin_template',$data);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['breakdown'] = 'User(level 2) Dashboard';
               /*$data['breakdown_data'] = $this->Qlip_model->get_data('breakdown');
               $booked_sum = $this->Qlip_model->get_data('booked_sum');
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
               $data['director']="blanck";
               $data['title'] = 'Admin Dashboard';
               $data['content'] = 'admin_dashboard';
               $this->load->view('admin_template',$data);
            } 
            else if($search==1)
            {
              
              
               //$data['level2_data'] = $this->Qlip_model->get_data('search_l2',$key);
               
               /*$booked_sum = $this->Qlip_model->get_data('booked_sum_search',$key);
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
               $data['breakdown'] = 'Admin Dashboard';
               $key = $this->input->post('search') ;
               $data['breakdown_data'] = $this->Qlip_model->get_data('breakdown_search',$key);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['director']="ledger_balance";
               $data['title'] = 'Admin Dashboard'; // Capitalize the first letter
               $data['content'] = 'admin_dashboard';
               $this->load->view('admin_template',$data);

            } 

          }
 }


 function search_filter_dashboard()
 {
   $uname = $this->uri->segment(3);
   $status = $this->uri->segment(4);
   if($uname == "level2")
   {
       $empty1="";
       $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
       $data['level1_data'] = $this->Qlip_model->search_filter_dashboard($uname,$status);
       $data['title'] = 'Assets Record';
       $data['content'] = 'view_loan_level1';
       $this->load->view('level1_template',$data);
   }
   
 }

  function open_level1_section($search=0)
 {   
     

     if($search==0)
   {     
     $uname = $this->uri->segment(3);
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['breakdown'] = 'User(level 1) Dashboard';
     $data['director']="blanck"; //this is an indictor to direct the level2 dashboard to either ledger balance or search page 
     $data['title'] = 'User Dashboard';
     $data['cd'] = $this->get_chart_data();
     $data['report_data'] = $this->Qlip_model->get_reports_l1($uname);//for report
     $data['content'] = 'level1_dashboard';
     $this->load->view('level1_template',$data);
    }
    else
            {
              //$uname = $this->uri->segment(4);
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               //$data['breakdown'] = 'User(level 2) Dashboard';
               /*$data['breakdown_data'] = $this->Qlip_model->get_data('breakdown');
               $booked_sum = $this->Qlip_model->get_data('booked_sum');
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
               $data['director']="blanck";
               $data['title'] = 'User Dashboard';
               $data['content'] = 'level1_dashboard';
               $this->load->view('level1_template',$data);
            } 
            else if($search==1)
            {
              
               $uname = $this->uri->segment(4);
               echo $uname ;
               //$data['level2_data'] = $this->Qlip_model->get_data('search_l2',$key);
               
               /*$booked_sum = $this->Qlip_model->get_data('booked_sum_search',$key);
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
              
               //$data['breakdown'] = 'User(level 2) Dashboard';
               $key = $this->input->post('search') ;
               $data['breakdown_data'] = $this->Qlip_model->get_data("breakdown_search_l1",$key,$uname);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['director']="ledger_balance";
               $data['title'] = 'User(level1) Dashboard'; // Capitalize the first letter
               $data['content'] = 'level1_dashboard';
               $this->load->view('level1_template',$data);

            } 

          }
 }

  function open_level2_section($search=0)
 {   
    
     if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     /*$data['breakdown_data'] = $this->Qlip_model->get_data('breakdown');
     $booked_sum = $this->Qlip_model->get_data('booked_sum');
    $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
     $data['report_data'] = $this->Qlip_model->get_reports(); //get status(pend,appro,decli) for all users,show in spool page
     $data['breakdown'] = 'User(level 2) Dashboard';
     $data['director']="blanck"; //this is an indictor to direct the level2 dashboard to either ledger balance or search page 
     $data['title'] = 'User(level 2) Dashboard';
     $data['content'] = 'level2_dashboard';
     $this->load->view('level2_template',$data);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['breakdown'] = 'User(level 2) Dashboard';
               /*$data['breakdown_data'] = $this->Qlip_model->get_data('breakdown');
               $booked_sum = $this->Qlip_model->get_data('booked_sum');
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
               $data['director']="blanck";
               $data['title'] = 'User(level 2) Dashboard';
               $data['content'] = 'level2_dashboard';
               $this->load->view('level2_template',$data);
            } 
            else if($search==1)
            {
              
              
               //$data['level2_data'] = $this->Qlip_model->get_data('search_l2',$key);
               
               /*$booked_sum = $this->Qlip_model->get_data('booked_sum_search',$key);
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
               $data['breakdown'] = 'User(level 2) Dashboard';
               $key = $this->input->post('search') ;
               $data['breakdown_data'] = $this->Qlip_model->get_data('breakdown_search',$key);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['director']="ledger_balance";
               $data['title'] = 'User(level 2) Dashboard'; // Capitalize the first letter
               $data['content'] = 'level2_dashboard';
               $this->load->view('level2_template',$data);

            } 

          }
 }

  function open_primera_section($search=0)
 {   
     /*$data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['title'] = 'User(level 2) Dashboard';
     $data['content'] = 'level2_dashboard';
     $this->load->view('level2_template',$data);*/

     if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     
     /*$data['breakdown_data'] = $this->Qlip_model->get_data('breakdown');
     $booked_sum = $this->Qlip_model->get_data('booked_sum');
    $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
     $data['report_data'] = $this->Qlip_model->get_reports_primera(); //get status(pend,appro,decli) for all users,show in spool page
     $data['breakdown'] = 'User(primera) Dashboard';
     $data['director']="blanck"; //this is an indictor to direct the level2 dashboard to either ledger balance or search page 
     $data['title'] = 'User(primera) Dashboard';
     $data['content'] = 'primera_dashboard';
     $this->load->view('primera_template',$data);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               /*$data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;*/
               $data['breakdown'] = 'User(primera) Dashboard';
               /*$data['breakdown_data'] = $this->Qlip_model->get_data('breakdown');
               $booked_sum = $this->Qlip_model->get_data('booked_sum');
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
               $data['director']="blanck";
               $data['title'] = 'User(primera) Dashboard';
               $data['content'] = 'primera_dashboard';
               $this->load->view('primera_template',$data);
            } 
            else if($search==1)
            {
              
              
               //$data['level2_data'] = $this->Qlip_model->get_data('search_l2',$key);
               
               /*$booked_sum = $this->Qlip_model->get_data('booked_sum_search',$key);
               $data['booked_sum']=$booked_sum['sum(booked_amount)'];*/
               $data['breakdown'] = 'User(primera) Dashboard';
               $key = $this->input->post('search') ;
               $data['breakdown_data'] = $this->Qlip_model->get_data('breakdown_search',$key);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               /*$data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;*/
               $data['director']="ledger_balance";
               $data['title'] = 'User(primera) Dashboard'; // Capitalize the first letter
               $data['content'] = 'primera_dashboard';
               $this->load->view('primera_template',$data);

            } 

          }
 }

  function create_user()
 {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['title'] = 'Create User';
     $data['content'] = 'create_user';
     $this->load->view('level1_template',$data);
 }


 function post_loan()
 {
     $uname = $this->uri->segment(3);
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['title'] = 'Install new asset';
     $data['content'] = 'post_loan';
     $this->load->view('level1_template',$data);
 }

 function view_log($search=0)
 {  
    //$id = $this->uri->segment(3);
    $uname = $this->uri->segment(3);
    if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
     $data['title'] = 'Logs';
     $data['content'] = 'view_log';
     $this->load->view('level1_template',$data);
     //echo print_r($data['level1_data']);
    }
  }

 function view_loan_level1($search=0)
 {  
    //$id = $this->uri->segment(3);
    $uname = $this->uri->segment(3);
    if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
     $data['title'] = 'Installed Asset';
     $data['content'] = 'view_loan_level1';
     $this->load->view('level1_template',$data);
     //echo print_r($data['level1_data']);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             { 
               $uname = $this->uri->segment(4);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
               $data['title'] = 'asset';
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);
            } 
            else if($search==1)
            {
               $uname = $this->uri->segment(4);
               $key = $this->input->post('search') ;
               $data['level1_data'] = $this->Qlip_model->get_data('search_l1',$key,$uname);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'asset'; // Capitalize the first letter
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);

            } 

          }

 }

 function view_deployed_asset($search=0)
 {  
    //$id = $this->uri->segment(3);
    $uname = $this->uri->segment(3);
    if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['level1_data'] = $this->Qlip_model->get_data('deployed_data',$uname);
     $data['title'] = 'Deployed Asset';
     $data['content'] = 'view_deployed_asset';
     $this->load->view('level1_template',$data);
     //echo print_r($data['level1_data']);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             { 
               $uname = $this->uri->segment(4);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
               $data['title'] = 'asset';
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);
            } 
            else if($search==1)
            {
               $uname = $this->uri->segment(4);
               $key = $this->input->post('search') ;
               $data['level1_data'] = $this->Qlip_model->get_data('search_l1',$key,$uname);
               $data['approved_count']=$this->get_approved_count($uname) ;
               $data['pending_count']=$this->get_pending_count($uname) ;
               $data['declined_count']=$this->get_declined_count($uname) ;
               $data['authorized_count']=$this->get_authorized_count($uname) ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
               $data['title'] = 'Posted Loan'; // Capitalize the first letter
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);

            } 

          }

 }

 function view_returned_asset($search=0)
 {  
    //$id = $this->uri->segment(3);
    $uname = $this->uri->segment(3);
    if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['level1_data'] = $this->Qlip_model->get_data('returned_data',$uname);
     $data['title'] = 'Returned Asset';
     $data['content'] = 'view_returned_asset';
     $this->load->view('level1_template',$data);
     //echo print_r($data['level1_data']);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             { 
               $uname = $this->uri->segment(4);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
               $data['title'] = 'Posted Loan';
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);
            } 
            else if($search==1)
            {
               $uname = $this->uri->segment(4);
               $key = $this->input->post('search') ;
               $data['level1_data'] = $this->Qlip_model->get_data('search_l1',$key,$uname);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'asset'; // Capitalize the first letter
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);

            } 

          }

 }

 function view_decommissioned_asset($search=0)
 {  
    //$id = $this->uri->segment(3);
    $uname = $this->uri->segment(3);
    if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['level1_data'] = $this->Qlip_model->get_data('decommissioned_data',$uname);
     $data['title'] = 'Decommissioned Asset';
     $data['content'] = 'view_decommissioned_asset';
     $this->load->view('level1_template',$data);
     //echo print_r($data['level1_data']);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             { 
               $uname = $this->uri->segment(4);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
               $data['title'] = 'Posted Loan';
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);
            } 
            else if($search==1)
            {
               $uname = $this->uri->segment(4);
               $key = $this->input->post('search') ;
               $data['level1_data'] = $this->Qlip_model->get_data('search_l1',$key,$uname);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'asset'; // Capitalize the first letter
               $data['content'] = 'view_loan_level1';
               $this->load->view('level1_template',$data);

            } 

          }

 }

 function delete_user()
 {
	 $id = $this->uri->segment(3);
	 
	 $sql = "delete from qusers where uid = '$id'";
	 $this->db->query($sql);
	 
	 $num_inserts = $this->db->affected_rows();
     if($num_inserts=="1")
     {
                 $this->session->set_flashdata('message', 'user_deleted');
                 redirect('qlip_controller/view_users','refresh');
                 //echo ('<script>setTimeout(function() { alert("User successfull created!"); }, 1);</script>');
     }
	 
 }
 
 function view_users($search=0)
 {  
    //$id = $this->uri->segment(3);
    //$uname = $this->uri->segment(3);
    if($search==0)
   {     
     /*$data['approved_count']=$this->get_approved_count($uname) ;
     $data['pending_count']=$this->get_pending_count($uname) ;
     $data['declined_count']=$this->get_declined_count($uname) ;*/
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['users_data'] = $this->Qlip_model->get_data('users_data');
     $data['title'] = 'System Users';
     $data['content'] = 'view_users';
     $this->load->view('level1_template',$data);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             { 
               //$uname = $this->uri->segment(4);
               /*$data['approved_count']=$this->get_approved_count($uname) ;
               $data['pending_count']=$this->get_pending_count($uname) ;
               $data['declined_count']=$this->get_declined_count($uname) ;*/
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['users_data'] = $this->Qlip_model->get_data('users_data');
               $data['title'] = 'System users';
               $data['content'] = 'view_users';
               $this->load->view('admin_template',$data);
            } 
            else if($search==1)
            {
               //$uname = $this->uri->segment(4);
               $key = $this->input->post('search') ;
               $data['users_data'] = $this->Qlip_model->get_data('search_admin',$key);
               /*$data['approved_count']=$this->get_approved_count($uname) ;
               $data['pending_count']=$this->get_pending_count($uname) ;
               $data['declined_count']=$this->get_declined_count($uname) ;*/
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'System users'; // Capitalize the first letter
               $data['content'] = 'view_users';
               $this->load->view('admin_template',$data);

            } 

          }

 }

 function view_loan_level2($search=0)
 {  
    if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['level2_data'] = $this->Qlip_model->get_data('level2_data');
     $data['title'] = 'Posted Loan';
     $data['content'] = 'view_loan_level2';
     $this->load->view('level2_template',$data);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['level2_data'] = $this->Qlip_model->get_data('level2_data');
               $data['title'] = 'Posted Loan';
               $data['content'] = 'view_loan_level2';
               $this->load->view('level2_template',$data);
            } 
            else if($search==1)
            {
              
              $key = $this->input->post('search') ;
               $data['level2_data'] = $this->Qlip_model->get_data('search_l2',$key);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'Posted Loan'; // Capitalize the first letter
               $data['content'] = 'view_loan_level2';
               $this->load->view('level2_template',$data);

            } 

          }
 }

 function view_loan_primera($search=0)
 {  
     /*$data['primera_data'] = $this->Qlip_model->get_data('primera_data');
     $data['title'] = 'Posted Loan';
     $data['content'] = 'view_loan_primera';
     $this->load->view('primera_template',$data);*/

     if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;

     $data['primera_data'] = $this->Qlip_model->get_data('primera_data');
     $data['title'] = 'Posted Loan';
     $data['content'] = 'view_loan_primera';
     $this->load->view('primera_template',$data);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;

               $data['primera_data'] = $this->Qlip_model->get_data('primera_data');
               $data['title'] = 'Posted Loan';
               $data['content'] = 'view_loan_primera';
               $this->load->view('primera_template',$data);
            } 
            else if($search==1)
            {
              
              $key = $this->input->post('search') ;
               $data['primera_data'] = $this->Qlip_model->get_data('search_pr',$key);
               
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;

               $data['title'] = 'Posted Loan'; // Capitalize the first letter
               $data['content'] = 'view_loan_primera';
               $this->load->view('primera_template',$data);

            } 

          }
 }

 function view_t24push_status($search=0)
 {  
     /*$data['primera_data'] = $this->Qlip_model->get_data('primera_data');
     $data['title'] = 'Posted Loan';
     $data['content'] = 'view_loan_primera';
     $this->load->view('primera_template',$data);*/

     if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;

     $data['primera_data'] = $this->Qlip_model->get_data('t24_data');
     $data['title'] = 'T24 push status';
     $data['content'] = 'view_t24push_status';
     $this->load->view('primera_template',$data);
    }
    /*else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;

               $data['primera_data'] = $this->Qlip_model->get_data('primera_data');
               $data['title'] = 'Posted Loan';
               $data['content'] = 'view_loan_primera';
               $this->load->view('primera_template',$data);
            } 
            else if($search==1)
            {
              
              $key = $this->input->post('search') ;
               $data['primera_data'] = $this->Qlip_model->get_data('search_pr',$key);
               
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;

               $data['title'] = 'Posted Loan'; // Capitalize the first letter
               $data['content'] = 'view_loan_primera';
               $this->load->view('primera_template',$data);

            } 

          }*/
 }

 function fetch_postedloan_readonly()
 {
   

   $id = $this->uri->segment(3);
   $user = $this->uri->segment(4);
   $uname = $this->uri->segment(5);
   

   $data['postedloan_data'] = $this->Qlip_model->get_data('installed_info',$id);
   $data['title'] = 'Asset record'; // Capitalize the first letter
   $data['content'] = 'post_loan_readonly';
   if($user=="l1")
   {
     $data['approved_count']=$this->get_approved_count($uname) ;
     $data['pending_count']=$this->get_pending_count($uname) ;
     $data['declined_count']=$this->get_declined_count($uname) ;
     $data['authorized_count']=$this->get_authorized_count($uname) ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
     $this->load->view('level1_template',$data);
   }
   else if($user=="l2")
   {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
    $this->load->view('level1_template',$data);
   }

 } //

 
 function fetch_deployed_readonly()
 {
   

   $id = $this->uri->segment(3);
   $user = $this->uri->segment(4);
   $uname = $this->uri->segment(5);

   $data['postedloan_data'] = $this->Qlip_model->get_data('deployed_info',$id);
   $data['title'] = 'Asset record'; // Capitalize the first letter
   $data['content'] = 'deployed_asset_readonly';
   if($user=="l1")
   {
      
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $this->load->view('level1_template',$data);
   }
   else if($user=="l2")
   {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
    $this->load->view('level2_template',$data);
   }

 } //

 function fetch_postedloan_primera_readonly()
 {
   $id = $this->uri->segment(3);
   //$user = $this->uri->segment(4);
   $data['postedloan_data'] = $this->Qlip_model->get_data('loan_info',$id);

   //get id to determine if someone is currently viewing this particular record
      $sql = "select view_mode,user_viewing from lasg_staff_info where lsid='$id'";
      $query = $this->db->query($sql);
      foreach ($query->result() as $mode_val)
      {
          $view_mode = $mode_val->view_mode ;
          $user_viewing = $mode_val->user_viewing ;
          $uname = $this->session->userdata('uname');
      }

      if(empty($view_mode))
      {
          //update view_mode table
          $sql = "update lasg_staff_info set view_mode='on',user_viewing='$uname' where lsid='$id'";
          $query = $this->db->query($sql);

          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          $data['title'] = 'Loan record'; // Capitalize the first letter
          $data['content'] = 'post_loan_primera_readonly';
          $this->load->view('primera_template',$data);
      }
      else if($view_mode == "on")
      {
        $this->session->set_flashdata('message', 'view_mode_on');
        redirect('qlip_controller/view_loan_primera','refresh');
      }
      else if($view_mode == "off")
      {
          //update view_mode table
          $sql = "update lasg_staff_info set view_mode='on',user_viewing='$uname' where lsid='$id'";
          $query = $this->db->query($sql);

          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          $data['title'] = 'Loan record'; // Capitalize the first letter
          $data['content'] = 'post_loan_primera_readonly';
          $this->load->view('primera_template',$data);
      } 

   /*$data['approved_count']=$this->get_approved_count("dummy","l2") ;
   $data['pending_count']=$this->get_pending_count("dummy","l2") ;
   $data['declined_count']=$this->get_declined_count("dummy","l2") ;

   $data['title'] = 'Loan record'; // Capitalize the first letter
   $data['content'] = 'post_loan_primera_readonly';
   $this->load->view('primera_template',$data);*/

 }

function insert_user()
{
           $this->load->library('encrypt');
           $this->load->helper('form','url');
           $this->load->library('form_validation');

           $this->form_validation->set_rules('fname', 'Firstname', 'required');
           $this->form_validation->set_rules('lname', 'Lastname', 'required');
           //$this->form_validation->set_rules('oname', 'Othername(s)', 'required');

           //$this->form_validation->set_rules('email', 'Email', 'required');
           $this->form_validation->set_rules('uname', 'Uname', 'required|is_unique[qusers.uname]');
           $this->form_validation->set_rules('pword', 'Password', 'trim|required|matches[pword2]');
           $this->form_validation->set_rules('pword2', 'Password Confirmation', 'required');
           $this->form_validation->set_rules('role', 'Role', 'required');

           $role = $this->input->post('role');
           if($role=="level1" || $role=="level2")
           {
             //$this->form_validation->set_rules('project', 'Project', 'required');
           }

           //$this->form_validation->set_rules('company', 'Company/Organisation', 'required');
            

           if ($this->form_validation->run() === FALSE)
           {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'Create User';
               $data['content'] = 'create_user';
               $this->load->view('level1_template',$data);
           }
           else
           {
              $this->load->model('qlip_model');
              $date=date('Y-m-d');
               $this->qlip_model->insert_user($date);
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                 $this->session->set_flashdata('message', 'user_created');
                 redirect('qlip_controller/create_user','refresh');
                 //echo ('<script>setTimeout(function() { alert("User successfull created!"); }, 1);</script>');

               }
              
           }
           
    }//end insert_user()

    function insert_loan()//insert asset
   {

           $uname = $this->uri->segment(3);
           $this->load->helper('form','url');
           $this->load->library('form_validation');
           
           $this->form_validation->set_rules('installer_name', 'Installer Name', 'required');
           //$this->form_validation->set_rules('project', 'Project', 'required');
           $this->form_validation->set_rules('state', 'State', 'required');
           $this->form_validation->set_rules('category', 'Category', 'required');
           $this->form_validation->set_rules('asset_type', 'Type', 'required');
           $this->form_validation->set_rules('asset_name', 'Asset Name', 'required');
           $this->form_validation->set_rules('serial', 'Serial', 'required|is_unique[lasg_staff_info.serial]');
           //$this->form_validation->set_rules('email', 'Email', 'required|is_unique[lasg_staff_info.email]');
           $this->form_validation->set_rules('specification', 'Specification', 'required');
           $this->form_validation->set_rules('purchase_date', 'Purchase date', 'required');
           $this->form_validation->set_rules('warranty', 'Warranty', 'required');
           $this->form_validation->set_rules('date_installed', 'Date Installed', 'required');
           $this->form_validation->set_rules('unique_id', 'Unique ID', 'required|is_unique[lasg_staff_info.unique_id]');
           
           if ($this->form_validation->run() === FALSE)
           {
                $data['title'] = 'Install Asset';
                $data['approved_count']=$this->get_approved_count("dummy","l2") ;
                $data['pending_count']=$this->get_pending_count("dummy","l2") ;
                $data['declined_count']=$this->get_declined_count("dummy","l2") ;
                $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
                $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;

               $data['content'] = 'post_loan';
               $this->load->view('level1_template',$data);
           }
           else
           {
              //$oracle_number = $this->input->post('oracle_number');

              
              $this->load->model('qlip_model');
              $date=date('Y-m-d');
               $this->qlip_model->insert_loan($date);
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                    $unique_id = $this->input->post('unique_id');
                    $this->view_upload_documents($uname,$unique_id);
                 //$this->session->set_flashdata('message', 'loan_inserted');
                 //redirect('qlip_controller/post_loan/'.$uname,'refresh');
                 //echo ('<script>setTimeout(function() { alert("User successfull created!"); }, 1);</script>');
               }
              
           }
           
    }//end insert_loan()

    function insert_loan_images()
    {
          $uname = $this->uri->segment(3);
          $oracle_no = $this->uri->segment(4);
          
            $storeFolder = './uploads/images/';

           if ($_FILES["pay_slip"]["error"]!=4) 
           {
              $max_filesize=100000000 ; //100MB, 1000000bytes = 1 Mega bytes
              $base_uploadSize = $_FILES['pay_slip']['size'];
          
              if($base_uploadSize<$max_filesize)
              {
                $base_tempFile = $_FILES['pay_slip']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["pay_slip"]["name"]);
                $base_filename = time().$_FILES["pay_slip"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Composite',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
         }

      /*if ($_FILES["loan_application"]["error"]!=4) 
           {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['loan_application']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['loan_application']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["loan_application"]["name"]);
                $base_filename = time().$_FILES["loan_application"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Loan Application',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }
      if ($_FILES["letter_of_authority"]["error"]!=4) 
           {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['letter_of_authority']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['letter_of_authority']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["letter_of_authority"]["name"]);
                $base_filename = time().$_FILES["letter_of_authority"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Letter Of Authority',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }

      if ($_FILES["offer_letter"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['offer_letter']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['offer_letter']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["offer_letter"]["name"]);
                $base_filename = time().$_FILES["offer_letter"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Offer Letter',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }
      if ($_FILES["staff_id"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['staff_id']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['staff_id']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["staff_id"]["name"]);
                $base_filename = time().$_FILES["staff_id"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Staff ID',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }

      if ($_FILES["bvn"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['bvn']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['bvn']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["bvn"]["name"]);
                $base_filename = time().$_FILES["bvn"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Bank verification Number',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }
      if ($_FILES["bank_statement"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['bank_statement']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['bank_statement']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["bank_statement"]["name"]);
                $base_filename = time().$_FILES["bank_statement"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Bank Statement',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }

      if ($_FILES["employment_letter"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['employment_letter']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['employment_letter']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["employment_letter"]["name"]);
                $base_filename = time().$_FILES["employment_letter"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Employment Letter',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
       }*/

        $this->session->set_flashdata('message', 'loan_inserted');
        redirect('qlip_controller/post_loan/'.$uname,'refresh');

    }

    function update_loan_images()
    {
          $uname = $this->uri->segment(3);
          $oracle_no = $this->uri->segment(4);
          $id = $this->uri->segment(5);
          
            $storeFolder = './uploads/images/';

           if ($_FILES["pay_slip"]["error"]!=4) 
           {
              $max_filesize=100000000 ;
              $base_uploadSize = $_FILES['pay_slip']['size'];
          
              if($base_uploadSize<$max_filesize)
              {
                $base_tempFile = $_FILES['pay_slip']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["pay_slip"]["name"]);
                $base_filename = time().$_FILES["pay_slip"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Composite',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
         }

      /*if ($_FILES["loan_application"]["error"]!=4) 
           {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['loan_application']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['loan_application']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["loan_application"]["name"]);
                $base_filename = time().$_FILES["loan_application"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Loan Application',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }
      if ($_FILES["letter_of_authority"]["error"]!=4) 
           {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['letter_of_authority']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['letter_of_authority']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["letter_of_authority"]["name"]);
                $base_filename = time().$_FILES["letter_of_authority"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Letter Of Authority',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }

      if ($_FILES["offer_letter"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['offer_letter']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['offer_letter']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["offer_letter"]["name"]);
                $base_filename = time().$_FILES["offer_letter"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Offer Letter',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }
      if ($_FILES["staff_id"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['staff_id']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['staff_id']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["staff_id"]["name"]);
                $base_filename = time().$_FILES["staff_id"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Staff ID',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }

      if ($_FILES["bvn"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['bvn']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['bvn']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["bvn"]["name"]);
                $base_filename = time().$_FILES["bvn"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Bank verification Number',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }
      if ($_FILES["bank_statement"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['bank_statement']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['bank_statement']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["bank_statement"]["name"]);
                $base_filename = time().$_FILES["bank_statement"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Bank Statement',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
      }

      if ($_FILES["employment_letter"]["error"]!=4) 
        {
              $max_filesize=2000000 ;
              $base_uploadSize = $_FILES['employment_letter']['size'];
              
              if($base_uploadSize<$max_filesize)
              {

                $base_tempFile = $_FILES['employment_letter']['tmp_name']; 
                         
                //moving the base image
                $targetPath =$storeFolder;
                $temp = explode(".", $_FILES["employment_letter"]["name"]);
                $base_filename = time().$_FILES["employment_letter"]["name"];
                $targetFile =  $targetPath. $base_filename;  
                move_uploaded_file($base_tempFile,$targetFile); 
                $base_path=$file_name='uploads/images/'.$base_filename;

                $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => 'Employment Letter',
              'path' =>$base_path
                );
               $this->db->insert('documents', $data);

            }//end base if
       }*/

        //$this->session->set_flashdata('message', 'loan_inserted');
        redirect('qlip_controller/fetch_postedloan_readonly/'.$id.'/l1/'.$uname,'refresh');

    }
    function delete_documents()
    {
        $uname = $this->uri->segment(3);
        $document_id = $this->uri->segment(4);
        $customer_id = $this->uri->segment(5);
        $path=0;
        $result11 = mysql_query("SELECT * from documents where did='$document_id'");
        while($row=mysql_fetch_array($result11))
        {
            $path = $row['path'];
        }
          
        unlink('./'.$path);

        $this->db->delete('documents', array('did' => $document_id));

        $num_inserts = $this->db->affected_rows();
        if($num_inserts=="1")
        {
            redirect('qlip_controller/fetch_postedloan_readonly/'.$customer_id.'/l1/'.$uname,'refresh');
        }
        else
        {
            redirect('qlip_controller/fetch_postedloan_readonly/'.$customer_id.'/l1/'.$uname,'refresh');
        }

    }


    public function update_loan()
    {
           $id = $this->uri->segment(3); //get lsid
           $uname = $this->uri->segment(4);//get username
           $this->load->helper('form','url');
           $this->load->library('form_validation');
           
           $this->form_validation->set_rules('installer_name', 'Installer Name', 'required');
           //$this->form_validation->set_rules('project', 'Project', 'required');
           $this->form_validation->set_rules('state', 'State', 'required');
           $this->form_validation->set_rules('category', 'Category', 'required');
           $this->form_validation->set_rules('asset_type', 'Type', 'required');
           $this->form_validation->set_rules('asset_name', 'Asset Name', 'required');
           $this->form_validation->set_rules('serial', 'Serial', 'required');
           //$this->form_validation->set_rules('email', 'Email', 'required|is_unique[lasg_staff_info.email]');
           $this->form_validation->set_rules('specification', 'Specification', 'required');
           $this->form_validation->set_rules('purchase_date', 'Purchase date', 'required');
           $this->form_validation->set_rules('warranty', 'Warranty', 'required');
           $this->form_validation->set_rules('date_installed', 'Date Installed', 'required');
           //$this->form_validation->set_rules('unique_id', 'Unique ID', 'required|is_unique[lasg_staff_info.unique_id]');
           
           $valuex=$this->input->post('btn_update');

           if($valuex=="Deploy")
           {
              if ($this->form_validation->run() === FALSE)
              {
                $data['approved_count']=$this->get_approved_count($uname) ;
                $data['pending_count']=$this->get_pending_count($uname) ;
                $data['declined_count']=$this->get_declined_count($uname) ;
                $data['authorized_count']=$this->get_authorized_count($uname) ;
                $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;

                $data['postedloan_data'] = $this->Qlip_model->get_data('loan_info',$id);
                $data['title'] = 'Asset record'; // Capitalize the first letter
                $data['content'] = 'post_loan_readonly';
                $this->load->view('level1_template',$data);
              }
              else
             {

                redirect('qlip_controller/view_deploy/'.$id,'refresh');
               
             }
           }

          else if($valuex=="Update")
          {
             if ($this->form_validation->run() === FALSE)
              {
                $data['approved_count']=$this->get_approved_count($uname) ;
                $data['pending_count']=$this->get_pending_count($uname) ;
                $data['declined_count']=$this->get_declined_count($uname) ;
                $data['authorized_count']=$this->get_authorized_count($uname) ;
                $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;

                $data['postedloan_data'] = $this->Qlip_model->get_data('loan_info',$id);
                $data['title'] = 'Asset record'; // Capitalize the first letter
                $data['content'] = 'post_loan_readonly';
                $this->load->view('level1_template',$data);


              }
              else
             {
               $this->load->model('qlip_model');
               $last_updated=date('Y-m-d');
               $this->qlip_model->update_loan($last_updated,$id);
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                 $this->session->set_flashdata('message', 'asset_updated');
                 redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
               } 
               else
              {
                 $this->session->set_flashdata('message', 'asset_updated_0');
                 redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
              }

             }
            
          }     
  
  }//end update_loan

  public function update_deployed()
    {
           $id = $this->uri->segment(3); //get deploy_id
           $uname = $this->uri->segment(4);//get username
           $this->load->helper('form','url');
           $this->load->library('form_validation');
           
           $this->form_validation->set_rules('user_name', 'Employee Name', 'required');
           $this->form_validation->set_rules('contact_no', 'Contact No', 'required');
           $this->form_validation->set_rules('department', 'Department', 'required');
           $this->form_validation->set_rules('email', 'Email', 'required');
           $this->form_validation->set_rules('description', 'Description', 'required');
           $this->form_validation->set_rules('dept_manager_name', 'Department Manager Name', 'required');
           $this->form_validation->set_rules('dept_manager_approval', 'Department manager Approval', 'required');
           //$this->form_validation->set_rules('email', 'Email', 'required|is_unique[lasg_staff_info.email]');
           $this->form_validation->set_rules('it_manager_name', 'IT Manager Name', 'required');
           $this->form_validation->set_rules('it_manager_approval', 'IT Manager Approval', 'required');
           $this->form_validation->set_rules('tag_no', 'Asset Tag No', 'required');
           $this->form_validation->set_rules('deployed_by', 'Deployed By', 'required');
           //$this->form_validation->set_rules('project', 'Project', 'required');
           $this->form_validation->set_rules('date_deployed', 'Date Deployed', 'required');
           
           $valuex=$this->input->post('btn_update');

           if($valuex=="Return")
           {
              if ($this->form_validation->run() === FALSE)
              {
                $data['postedloan_data'] = $this->Qlip_model->get_data('deployed_info',$id);
                $data['title'] = 'Deployed Asset record'; // Capitalize the first letter
                $data['content'] = 'deployed_asset_readonly';
                $data['approved_count']=$this->get_approved_count($uname) ;
                $data['pending_count']=$this->get_pending_count($uname) ;
                $data['declined_count']=$this->get_declined_count($uname) ;
                $data['authorized_count']=$this->get_authorized_count($uname) ;
                $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
                $this->load->view('level1_template',$data);
              }
              else
             {
                 $this->load->model('qlip_model');
                $this->qlip_model->insert_return($id);
                /*$num_inserts = $this->db->affected_rows();
                if($num_inserts=="1")
                {*/

                      //get install_id using deploy_id
                      
                      $sql = "select * from deployed where did = '$id'";
                      $query = $this->db->query($sql);
                      foreach ($query->result() as $val_user)
                      {
                          $serial_no = $val_user->serial_no ;
                          //echo $install_id;
                      }
                      $date_=date('Y-m-d');
                      $sql="update lasg_staff_info set status='returned',last_modified='$date_' where serial='$serial_no'";
                      $query = $this->db->query($sql);

                        
                        
                        $sql="update deployed set status='returned' where did='$id' and status='deployed'";
                        $query = $this->db->query($sql);
                        $num_inserts = $this->db->affected_rows();
                        if($num_inserts=="1")
                        {
                            $this->session->set_flashdata('message', 'asset_returned');
                            redirect('qlip_controller/view_deployed_asset/'.$uname,'refresh');
                        }
               /* } */
               
             }
           }

          else if($valuex=="Update")
          {
             if ($this->form_validation->run() === FALSE)
              {
                $data['postedloan_data'] = $this->Qlip_model->get_data('deployed_info',$id);
                $data['title'] = 'Deployed Asset record'; // Capitalize the first letter
                $data['content'] = 'deployed_asset_readonly';
                $data['approved_count']=$this->get_approved_count($uname) ;
                $data['pending_count']=$this->get_pending_count($uname) ;
                $data['declined_count']=$this->get_declined_count($uname) ;
                $data['authorized_count']=$this->get_authorized_count($uname) ;
                $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
                $this->load->view('level1_template',$data);

              }
              else
             {
               $this->load->model('qlip_model');
               $last_updated=date('Y-m-d');
               $this->qlip_model->update_deployed($id);
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                 $this->session->set_flashdata('message', 'asset_updated');
                 redirect('qlip_controller/view_deployed_asset/'.$uname,'refresh');
               } 
               else
              {
                 $this->session->set_flashdata('message', 'asset_updated_0');
                 redirect('qlip_controller/view_deployed_asset/'.$uname,'refresh');
              }

             }
            
          }     
  
  }//end update_loan

  function view_deploy()
  {
      $uname = $this->session->userdata('uname');
      $install_id_ = $this->uri->segment(3);
  
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['title'] = 'Deploy Asset';
     $data['install_id'] = $install_id_ ;
     $data['content'] = 'view_deploy';
     $this->load->view('level1_template',$data);

  }

  function view_deploy_returned()
  {
      $uname = $this->session->userdata('uname');
      $return_id_ = $this->uri->segment(3);
      $deploy_id_ = $this->uri->segment(4);
      $serial_no_ = $this->uri->segment(5);
  
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['title'] = 'Deploy Asset';
     $data['return_id'] = $return_id_ ;
     $data['deploy_id'] = $deploy_id_ ;
     $data['serial_no11'] = $serial_no_ ;
     $data['content'] = 'view_deploy_returned';
     $this->load->view('level1_template',$data);

  }


  function insert_deploy()//insert asset
   {

           $uname = $this->uri->segment(3);
           $install_id_ = $this->uri->segment(4);
           $this->load->helper('form','url');
           $this->load->library('form_validation');
           
           $this->form_validation->set_rules('user_name', 'Employee Name', 'required');
           $this->form_validation->set_rules('contact_no', 'Contact No', 'required');
           $this->form_validation->set_rules('department', 'Department', 'required');
           $this->form_validation->set_rules('email', 'Email', 'required');
           $this->form_validation->set_rules('description', 'Description', 'required');
           $this->form_validation->set_rules('dept_manager_name', 'Department Manager Name', 'required');
           $this->form_validation->set_rules('dept_manager_approval', 'Department manager Approval', 'required');
           //$this->form_validation->set_rules('email', 'Email', 'required|is_unique[lasg_staff_info.email]');
           $this->form_validation->set_rules('it_manager_name', 'IT Manager Name', 'required');
           $this->form_validation->set_rules('it_manager_approval', 'IT Manager Approval', 'required');
           $this->form_validation->set_rules('tag_no', 'Asset Tag No', 'required');
           $this->form_validation->set_rules('deployed_by', 'Deployed By', 'required');
           //$this->form_validation->set_rules('project', 'Project', 'required');
           $this->form_validation->set_rules('date_deployed', 'Date Deployed', 'required');
           
           if ($this->form_validation->run() === FALSE)
           {
              $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
              $data['title'] = 'Deploy Asset';
              $data['install_id'] = $install_id_ ;
              $data['content'] = 'view_deploy';
              $this->load->view('level1_template',$data);
           }
           else
           {
              //validate serial
              $serial = $this->input->post('serial');
              $sql = "select * from lasg_staff_info where serial = '$serial' and lsid = '$install_id_' and status='installed'";
              $query = $this->db->query($sql);
              $rowcount = $query->num_rows();
              if($rowcount>0)
              {
                    $this->load->model('qlip_model');
                    $this->qlip_model->insert_deploy($install_id_);
                    /*$num_inserts = $this->db->affected_rows();
                    if($num_inserts=="1")
                    {  */ $date_=date('Y-m-d');
                        $sql="update lasg_staff_info set status='deployed',last_modified='$date_' where lsid='$install_id_' and serial='$serial'";
                        $query = $this->db->query($sql);
                        $num_inserts = $this->db->affected_rows();
                        if($num_inserts=="1")
                        {
                            $this->session->set_flashdata('message', 'deployed');
                            redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
                        }
                    /*}*/

              }
              else
              {
                  $this->session->set_flashdata('message', 'invalid_serial');
                  redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
                  //echo "Invalid serial Number or asset is already deployed,contact system administrator<br>" ;
                  
              }

              
              /*$this->load->model('qlip_model');
              $date=date('Y-m-d');
               $this->qlip_model->insert_deploy($date);
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                    $unique_id = $this->input->post('unique_id');
                    $this->view_upload_documents($uname,$unique_id);
                 //$this->session->set_flashdata('message', 'loan_inserted');
                 //redirect('qlip_controller/post_loan/'.$uname,'refresh');
                 //echo ('<script>setTimeout(function() { alert("User successfull created!"); }, 1);</script>');
               }*/
              
           }
           
    }//end insert_loan()

    function insert_deploy_returned()//deploy an asset fr
   {

           $uname = $this->session->userdata('uname');
           $serial_no = $this->uri->segment(3);
           $deploy_id_ = $this->uri->segment(4);
           $return_id_ = $this->uri->segment(5);
           $this->load->helper('form','url');
           $this->load->library('form_validation');
           
           $this->form_validation->set_rules('user_name', 'Employee Name', 'required');
           $this->form_validation->set_rules('contact_no', 'Contact No', 'required');
           $this->form_validation->set_rules('department', 'Department', 'required');
           $this->form_validation->set_rules('email', 'Email', 'required');
           $this->form_validation->set_rules('description', 'Description', 'required');
           $this->form_validation->set_rules('dept_manager_name', 'Department Manager Name', 'required');
           $this->form_validation->set_rules('dept_manager_approval', 'Department manager Approval', 'required');
           //$this->form_validation->set_rules('email', 'Email', 'required|is_unique[lasg_staff_info.email]');
           $this->form_validation->set_rules('it_manager_name', 'IT Manager Name', 'required');
           $this->form_validation->set_rules('it_manager_approval', 'IT Manager Approval', 'required');
           $this->form_validation->set_rules('tag_no', 'Asset Tag No', 'required');
           $this->form_validation->set_rules('deployed_by', 'Deployed By', 'required');
           //$this->form_validation->set_rules('project', 'Project', 'required');
           $this->form_validation->set_rules('date_deployed', 'Date Deployed', 'required');
           
           if ($this->form_validation->run() === FALSE)
           {
              $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
              $data['title'] = 'Deploy Asset';
              $data['install_id'] = $install_id_ ;
              $data['deploy_id'] = $deploy_id_ ;
              $data['return_id'] = $return_id_ ;
              $data['content'] = 'view_deploy_returned';
              $this->load->view('level1_template',$data);
           }
           else
           {
              //validate serial
              $serial = $this->input->post('serial');
              $sql = "select * from returned where serial_no = '$serial_no' and rid = '$return_id_' and status='returned'";
              $query = $this->db->query($sql);
              $rowcount = $query->num_rows();
              if($rowcount>0)
              {
                    $this->load->model('qlip_model');
                    $this->qlip_model->insert_deploy_returned($return_id_);
                    /*$num_inserts = $this->db->affected_rows();
                    if($num_inserts=="1")
                    {*/
                        $date_=date('Y-m-d');
                        $sql="update lasg_staff_info set status='deployed',last_modified='$date_' where serial='$serial_no'";
                        $query = $this->db->query($sql);
                        $num_inserts = $this->db->affected_rows();
                        if($num_inserts=="1")
                        {
                            $sql="update returned set status='deployed' where rid='$return_id_' and serial_no='$serial'";
                            $query = $this->db->query($sql);

                            $this->session->set_flashdata('message', 'deployed');
                            redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
                        }
                    /*}*/

              }
              else
              {
                  $this->session->set_flashdata('message', 'invalid_serial');
                  redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
                  //echo "Invalid serial Number or asset is already deployed,contact system administrator<br>" ;
                  
              }

              
           }
           
    }//end insert_loan()


    function insert_decommissioned()//deploy an asset fr
   {

           $uname = $this->session->userdata('uname');
           $return_id_ = $this->uri->segment(3);
           $deploy_id_ = $this->uri->segment(4);
           $serial_no_ = $this->uri->segment(5);

           $sql = "insert into decommissioned(select * from returned where rid='$return_id_')";
           $query = $this->db->query($sql);

           $date_=date('Y-m-d');
           $sql = "update decommissioned set status='decommissioned',date_decommissioned='$date_',decommissioned_by='$uname',action_type='insert' where rid='$return_id_'";
           $query = $this->db->query($sql);
           //$id_ = $this->db->insert_id();
           $this->load->model('qlip_model');
           $this->qlip_model->audit_trigger_decommissioned($return_id_);



           $sql="update lasg_staff_info set status='decommissioned',last_modified='$date_' where serial='$serial_no_'";
           $query = $this->db->query($sql);

           $sql="update returned set status='decommissioned' where rid='$return_id_'";
           $query = $this->db->query($sql);

           $sql="update deployed set status='decommissioned' where did='$deploy_id_'";
           $query = $this->db->query($sql);
           $num_inserts = $this->db->affected_rows();
           if($num_inserts=="1")
           {
              $this->session->set_flashdata('message', 'decommissioned');
              redirect('qlip_controller/view_returned_asset/','refresh');
           }
           

           
           
           /*if ($this->form_validation->run() === FALSE)
           {
              $data['approved_count']=$this->get_approved_count($uname) ;
              $data['pending_count']=$this->get_pending_count($uname) ;
              $data['declined_count']=$this->get_declined_count($uname) ;
              $data['authorized_count']=$this->get_authorized_count($uname) ;
              $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
              $data['title'] = 'Deploy Asset';
              $data['install_id'] = $install_id_ ;
              $data['deploy_id'] = $deploy_id_ ;
              $data['return_id'] = $return_id_ ;
              $data['content'] = 'view_deploy_returned';
              $this->load->view('level1_template',$data);
           }
           else
           {
              //validate serial
              $serial = $this->input->post('serial');
              $sql = "select * from returned where serial_no = '$serial' and rid = '$return_id_' and status='returned'";
              $query = $this->db->query($sql);
              $rowcount = $query->num_rows();
              if($rowcount>0)
              {
                    $this->load->model('qlip_model');
                    $this->qlip_model->insert_deploy_returned($return_id_);
                    $num_inserts = $this->db->affected_rows();
                    if($num_inserts=="1")
                    {
                        $date_=date('Y-m-d');
                        $sql="update lasg_staff_info set status='returned',last_modified='$date_' where lsid='$install_id_' and serial='$serial'";
                        $query = $this->db->query($sql);
                        $num_inserts = $this->db->affected_rows();
                        if($num_inserts=="1")
                        {
                            $sql="update returned set status='deployed' where rid='$return_id_' and serial_no='$serial'";
                            $query = $this->db->query($sql);

                            $this->session->set_flashdata('message', 'deployed');
                            redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
                        }
                    }

              }
              else
              {
                  $this->session->set_flashdata('message', 'invalid_serial');
                  redirect('qlip_controller/view_loan_level1/'.$uname,'refresh');
                  //echo "Invalid serial Number or asset is already deployed,contact system administrator<br>" ;
                  
              }

              
           }*/
           
    }//end insert_loan()

  function get_approved_count($uname=0,$level="l1")
  {
    if($level=="l1")
    {
       $count1= $this->Qlip_model->get_approved_count($uname);
       return $count1['count(1)'] ;
    }
    else if($level=="l2")
    {
       $count1= $this->Qlip_model->get_approved_count($uname,"l2");
       return $count1['count(1)'] ;
    }

  }


  function get_authorized_count($uname=0,$level="l1")
  {
    if($level=="l1")
    {
       $count1= $this->Qlip_model->get_authorized_count($uname);
       return $count1['count(1)'] ;
    }
    else if($level=="l2")
    {
       $count1= $this->Qlip_model->get_authorized_count($uname,"l2");
       return $count1['count(1)'] ;
    }

  }

  function get_pending_count($uname=0,$level="l1")
  {
    
    if($level=="l1")
    {
       $count1= $this->Qlip_model->get_pending_count($uname);
       return $count1['count(1)'] ;
    }
    else if($level=="l2")
    {
       $count1= $this->Qlip_model->get_pending_count($uname,"l2");
       return $count1['count(1)'] ;
    }
  }

  function get_pending_authorized_count($uname=0,$level="l1")
  {
    
    if($level=="l1")
    {
       $count1= $this->Qlip_model->get_pending_authorized_count($uname);
       return $count1['count(1)'] ;
    }
    else if($level=="l2")
    {
       $count1= $this->Qlip_model->get_pending_authorized_count($uname,"l2");
       return $count1['count(1)'] ;
    }
  }


  function get_declined_count($uname=0,$level="l1")
  {
    if($level=="l1")
    {
        $count1= $this->Qlip_model->get_declined_count($uname);
        return $count1['count(1)'] ;
    }
    else if($level=="l2")
    {
       $count1= $this->Qlip_model->get_declined_count($uname,"l2");
       return $count1['count(1)'] ;
    }
  }

  function change_password($user)
  {
       if($user=="l2")
       {
          $uname = $this->uri->segment(4);
          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
          $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
          $data['title'] = 'Change Password';
          $data['content'] = 'change_password_l2';
          $this->load->view('level1_template',$data);
       }
       
  }

  function update_password($uname,$level="l1")
  {

           $this->load->library('encrypt');
           $this->load->helper('form','url');
           $this->load->library('form_validation');

           $this->form_validation->set_rules('old_password', 'Old Password', 'required');
           $this->form_validation->set_rules('new_password', 'Password', 'trim|required|matches[retype_password]');
           $this->form_validation->set_rules('retype_password', 'Password Confirmation', 'required');
          
        if($level=="l2")
        {

           if ($this->form_validation->run() === FALSE)
           {
                $data['approved_count']=$this->get_approved_count("dummy","l2") ;
                $data['pending_count']=$this->get_pending_count("dummy","l2") ;
                $data['declined_count']=$this->get_declined_count("dummy","l2") ;
                $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
                $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'Change Password';
               $data['content'] = 'change_password_l2';
               $this->load->view('level1_template',$data);
           }
           else
           {
               $old_password_db=$this->Qlip_model->get_old_password($uname);
               $old_password_db=$this->encrypt->decode($old_password_db['pword']);
                $old_password=$this->input->post('old_password');
               if($old_password_db==$old_password)
               {
                 $this->Qlip_model->update_password($uname); 
                 $num_inserts = $this->db->affected_rows();
                 if($num_inserts=="1")
                 {
                 $this->session->set_flashdata('message', 'pword_changed');
                 redirect('qlip_controller/change_password/l2/'.$uname,'refresh');
                 }
                 else
                 {
                  $this->session->set_flashdata('message', 'pword_same');
                  redirect('qlip_controller/change_password/l2/'.$uname,'refresh');
                 }
               }
               else
               {
                  $data['approved_count']=$this->get_approved_count("dummy","l2") ;
                  $data['pending_count']=$this->get_pending_count("dummy","l2") ;
                  $data['declined_count']=$this->get_declined_count("dummy","l2") ;
                  $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
                  $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
                  $data['title'] = 'Change Password';
                  $data['wrong_old_password'] = 'The old password entered is incorrect';
                  $data['content'] = 'change_password_l1';
                  $this->load->view('level1_template',$data);

               }
           }
      }

      

      

  }

    public function update_loan_primera()
    {
           $id = $this->uri->segment(3); //get lsid
           $this->load->helper('form','url');
           $this->load->library('form_validation');
           
           //$this->form_validation->set_rules('outstanding', 'Outstanding', 'required');
           //$this->form_validation->set_rules('disbursed_amount', 'Disbursed Amount', 'required');
           //$this->form_validation->set_rules('booked_amount', 'Booked Amount', 'required');
          // $this->form_validation->set_rules('email', 'Email', 'required|is_unique[lasg_staff_info.email]');
           
           
           $valuex=$this->input->post('btn_update');

           if($valuex=="Approve")
           {
              /*$this->form_validation->set_rules('disbursed_amount', 'Disbursed Amount', 'required');
              $this->form_validation->set_rules('booked_amount', 'Booked Amount', 'required');//repayment_date
              $this->form_validation->set_rules('repayment_date', 'First Repayment Date', 'required');
              $this->form_validation->set_rules('date_disbursed', 'Date Disbursed', 'required');
              $this->form_validation->set_rules('loan_amount', 'Loan Amount', 'required'); */
              $this->form_validation->set_rules('monthly_salary', 'monthly salary', 'required'); //
              if ($this->form_validation->run() === FALSE)
              {
               $data['postedloan_data'] = $this->Qlip_model->get_data('loan_info',$id);
               
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;

               $data['title'] = 'Loan record'; // Capitalize the first letter
               $data['content'] = 'post_loan_primera_readonly';
               $this->load->view('primera_template',$data);
              }
              else
             {
               $this->load->model('qlip_model');
               $last_updated=date('Y-m-d');
               
               
               $this->qlip_model->update_loan_primera("approved",$id);
               $this->qlip_model->insert_in_due_payments_first($id);//first approval
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                 /*unlock view mode*/
                  $uname = $this->session->userdata('uname');
                  //update view_mode table
                  $sql = "update lasg_staff_info set view_mode='off' where user_viewing='$uname'";
                  $query = $this->db->query($sql);
 
                 $this->qlip_model->que_for_t24_push($id);
                 $this->session->set_flashdata('message', 'loan_approved');
                 redirect('qlip_controller/view_loan_primera','refresh');
               } 
               else
               {
                 /*unlock view mode*/
                  $uname = $this->session->userdata('uname');
                  //update view_mode table
                  $sql = "update lasg_staff_info set view_mode='off' where user_viewing='$uname'";
                  $query = $this->db->query($sql);
 
                 $this->session->set_flashdata('message', 'loan_approved11');
                 redirect('qlip_controller/view_loan_primera','refresh');
               } 
             }
           }

          else if($valuex=="Decline")
          {
               $this->form_validation->set_rules('rejection_reason', 'Reason for declining loan', 'required');
              if ($this->form_validation->run() === FALSE)
              {
               $data['postedloan_data'] = $this->Qlip_model->get_data('loan_info',$id);

               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;

               $data['title'] = 'Loan record'; // Capitalize the first letter
               $data['content'] = 'post_loan_primera_readonly';
               $this->load->view('primera_template',$data);
              }
              else
             {
               $this->load->model('qlip_model');
               $last_updated=date('Y-m-d');
               $this->qlip_model->update_loan_primera("declined",$id);
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                 /*unlock view mode*/
                  $uname = $this->session->userdata('uname');
                  //update view_mode table
                  $sql = "update lasg_staff_info set view_mode='off' where user_viewing='$uname'";
                  $query = $this->db->query($sql);
    
                 $this->session->set_flashdata('message', 'loan_declined');
                 redirect('qlip_controller/view_loan_primera','refresh');
               } 
               else
               {
                 /*unlock view mode*/
                  $uname = $this->session->userdata('uname');
                  //update view_mode table
                  $sql = "update lasg_staff_info set view_mode='off' where user_viewing='$uname'";
                  $query = $this->db->query($sql);

                 $this->session->set_flashdata('message', 'loan_declined_0');
                 redirect('qlip_controller/view_loan_primera','refresh');
               }

              }
             
            
          }
  
  }//end update_loan

  function upload_files_view()//when called it open interface to upload a file
 {   
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['title'] = 'User(level 2) Dashboard';
     $data['content'] = 'upload_files';
     $this->load->view('level2_template',$data);
 }

 function view_uploaded_files($search=0)
 {
   if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['upload_file_data'] = $this->Qlip_model->get_data('upload_file_data');
     $data['title'] = 'Deduction Report';
     $data['indicator'] = 'upload_search';//passed to view to indicate search is for uploaded files
     $data['content'] = 'view_uploaded_files';
     $this->load->view('level2_template',$data);
    }
    else
            {
              $this->load->helper('form','url');
              $this->load->library('form_validation');
              $this->form_validation->set_rules('search', 'Search content', 'required');

              if ($this->form_validation->run() === FALSE)
             {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['upload_file_data'] = $this->Qlip_model->get_data('upload_file_data');
               $data['title'] = 'Deduction report';
               $data['indicator'] = 'upload_search';//passed to view to indicate search is for uploaded files
               $data['content'] = 'view_uploaded_files';
               $this->load->view('level2_template',$data);
            } 
            else if($search==1)
            {
              
              $key = $this->input->post('search') ;
               $data['upload_file_data'] = $this->Qlip_model->get_data('search_upload',$key);
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;
               $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
               $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
               $data['title'] = 'Deduction report'; // Capitalize the first letter
               $data['indicator'] = 'upload_search';//passed to view to indicate search is for uploaded files
               $data['content'] = 'view_uploaded_files';
               $this->load->view('level2_template',$data);

            } 

          }

 }

 function upload_files()
 {   

     $this->form_validation->set_rules('narration', 'Narration', 'required');
     $this->form_validation->set_rules('sum_amount', 'Sum Amount', 'required');
     $this->form_validation->set_rules('month', 'Month', 'required');
     //$this->form_validation->set_rules('myuploadFile', 'Upload file', 'required');
     if (empty($_FILES['myuploadFile']['name']))
    {
        $this->form_validation->set_rules('myuploadFile', 'Document', 'required');
    }
      if ($this->form_validation->run() === FALSE)
     {
      $data['approved_count']=$this->get_approved_count("dummy","l2") ;
      $data['pending_count']=$this->get_pending_count("dummy","l2") ;
      $data['declined_count']=$this->get_declined_count("dummy","l2") ;
      $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
      $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
      $data['title'] = 'User(level 2) Dashboard';
      $data['content'] = 'upload_files';
      $this->load->view('level2_template',$data);
     }
     else
     {
       $storeFolder = './uploads/';
      if (!empty($_FILES)) 
      { 
        $tempFile = $_FILES['myuploadFile']['tmp_name'];            
        $targetPath =$storeFolder;
        $temp = explode(".", $_FILES["myuploadFile"]["name"]);
        $newfilename = time().$_FILES["myuploadFile"]["name"];
        $targetFile =  $targetPath. $newfilename;  
        move_uploaded_file($tempFile,$targetFile); 
        $path=$file_name='uploads/'.$newfilename;
        
        $month=$this->input->post('month');
        $year=$this->input->post('year');
        $narration=$this->input->post('narration');//get narration, to be used in ledger balance view
        $sum_amount=$this->input->post('sum_amount');
        $month_year=$month."_".$year ;
        $filename1=$month."_".$newfilename;
        
        //loop through
         $sum_credit=$this->sum_credit_get_sheet($path);     
        if(trim($sum_credit)==trim($sum_amount))
        {
           $this->Qlip_model->insert_file_details($filename1);
           $num_inserts = $this->db->affected_rows();
           if($num_inserts=="1")
           {
             $this->insert_from_uploaded($path,$filename1,$month_year,$sum_amount,$narration);
             //$this->session->set_flashdata('message', 'file_inserted');
             //redirect('qlip_controller/upload_files_view','refresh');
           }
          else 
          { echo "There is problem inserting record to database"; }

       }
       else
       {
          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
          $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
          $data['title'] = 'User(level 2) Dashboard';
          $data['error1'] = 'The Credit sum entered ('.$sum_amount.') does not equal the actual sum('.$sum_credit.') on the submitted sheet';
          $data['content'] = 'upload_files';
          $this->load->view('level2_template',$data);

       }
       /* $this->Qlip_model->insert_file_details($filename1);
        $num_inserts = $this->db->affected_rows();
        if($num_inserts=="1")
        {
          $this->insert_from_uploaded($path,$filename1,$month_year,$sum_amount);
          //$this->session->set_flashdata('message', 'file_inserted');
          //redirect('qlip_controller/upload_files_view','refresh');
        }
        else 
        { echo "There is problem inserting record to database"; }*/
     }
     else 
     { echo "There is no upload document"; }
       
    }
 }

  function sum_credit_get_sheet($path) //this function read the sheet in the workbook
  {

     $this->load->library('PHPExcel/Classes/PHPExcel');
     $inputFileType = PHPExcel_IOFactory::identify($path);
     $objReader1     = PHPExcel_IOFactory::createReader($inputFileType);
     $objPHPExcel1   = $objReader1->load($path);
     $sheetList      = $objReader1->listWorksheetNames($path); 
     foreach ($sheetList as $sheetName)
     {
        $currentObjectName  = $objPHPExcel1->setActiveSheetIndexByName($sheetName);
        $credit_sum=$this->sum_credit($currentObjectName);
     }
     return $credit_sum ;
  }

 function sum_credit($objWorksheet1)
{
    $this->load->library('form_validation');
    $highestRow1 = $objWorksheet1->getHighestRow(); // e.g. 10
    $row1=1; // row in which customers description starts in a work sheet
    $row_start= $row1+1;

    $credit_sum=0;

    for ($row_start; $row_start <= $highestRow1; $row_start++) //$highestRow
    {
          $row1=$row_start;
          $credit=$objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue():'';
          $credit_sum=$credit_sum+$credit ;

    }

    return $credit_sum ;
} 

  function insert_from_uploaded($path,$filename1,$month_year,$sum_amount,$narration)
  {

     $this->load->library('PHPExcel/Classes/PHPExcel');
     $inputFileType = PHPExcel_IOFactory::identify($path);
     $objReader1     = PHPExcel_IOFactory::createReader($inputFileType);
     $objPHPExcel1   = $objReader1->load($path);
     $sheetList      = $objReader1->listWorksheetNames($path); 
     foreach ($sheetList as $sheetName)
     {
        $currentObjectName  = $objPHPExcel1->setActiveSheetIndexByName($sheetName);
        $result=$this->insertintodb($currentObjectName,$filename1,$month_year,$sum_amount,$narration);
     }
  }


  function insertintodb($objWorksheet1,$filename1,$month_year,$sum_amount,$narration)
  { 
    $entry_date=date('Y-m-d');
    $this->load->library('form_validation');
    $highestRow1 = $objWorksheet1->getHighestRow(); // e.g. 10
    $row1=1; // row in which customers description starts in a work sheet
    $row_start= $row1+1;

     $error_report=0;
     $fileid=$this->Qlip_model->get_fileid_uploaded($filename1);
    //$credit_sum=0;
    
    //design error page ;
    echo '<html>';
    echo '<head>';
    echo '<title>Result</title>';
    echo '<head>';
    echo '<link href="'.base_url().'asset/bs_css/bootstrap.min.css" rel="stylesheet">';
    //echo '<link href="'.base_url().'asset/bs_css/style.css" rel="stylesheet">';
    echo '<link href="'.base_url().'asset/bs_js/bootstrap.min.js"></script>';
    echo '<link href="'.base_url().'asset/bs_js/jquery-1.8.3.min.js"></script>';
    echo '</head>';

    echo '<body>';

    

    
    echo '<p><div class="container">';
    echo '<div class="panel panel-primary">';
    echo '<div class="panel-heading">File Upload Report(s)</div>';
    echo '<div class="panel-body">';

    

  $result = mysql_query("SELECT * from deduction_report");
  if( mysql_num_rows($result)==0 )
  {
    for ($row_start; $row_start <= $highestRow1; $row_start++) //$highestRow
    {
          $row1=$row_start;
          $emp_no=$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue():'';
          $emp_name=$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue():'';
          $ministry_name=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          $credit=$objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue():'';
          $element_name=$objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() : ''; 
          
          $fileid=$this->Qlip_model->get_fileid_uploaded($filename1);
          /*$savedata=array(
          'oracle_number'=>$emp_no,
          'employee_name'=>$emp_name,
          'ministry_name'=>$ministry_name,
          'credit'=>$credit,
          'element_name'=>$element_name,
          'entry_date'=>$entry_date,
          'month_year'=>$month_year,
          'file_id'=>$fileid['file_id']
          );*/
           

          //validate if oracle number is in subscribe base
          $result3 = mysql_query("SELECT * from lasg_staff_info where oracle_number=$emp_no and status='approved'");
          if(mysql_num_rows($result3)>0)
          {
            $result5 = mysql_query("SELECT * from deduction_report where oracle_number='$emp_no' and month_year='$month_year'");
             if( mysql_num_rows($result5)>0 )
             {
                echo '<center><strong>Error!</strong><span class="text-danger">record already exist for this staff('.$emp_no.') with the same year </span></center>';
                $error_report=1 ;
             }
             else
             {
               //declare variables to be used inside this else
               $booked_amount_c=0; $interest=0; $principal_amount=0; $tenure=0; $repayment_amount=0; $first_repayment_date=0 ;  //needed

               //$this->Qlip_model->insert_from_uploaded($savedata);
               //echo '<center><strong>Success!</strong><span class="text-success">Employee record successfully uploaded! '.$emp_no.'</span></center>';

               /*computer principal amount,decreasing ledger balance and interest*/
               //use booked amount if first repayment otherwise use balance
                $result_ledger = mysql_query("SELECT ledger_balance from deduction_report where oracle_number='$emp_no' order by rid desc limit 1");
               if( mysql_num_rows($result_ledger)==0 )
               {
                  //get the booked amount for the last approved loan
                   $result_bm = mysql_query("SELECT booked_amount,loan_tenure_months,first_repayment_date from lasg_staff_info where oracle_number='$emp_no' and status='approved' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_bm))
                   {
                     $booked_amount_c=$row['booked_amount'];
                     $tenure=$row['loan_tenure_months'];
                     $first_repayment_date=$row['first_repayment_date'];
                     
                   }
                   //below are needed to prepare the formular to computeinterest
                   $interest=((4/100)*$booked_amount_c);
                   $principal_amount=($booked_amount_c/$tenure);
                   $repayment_amount=($principal_amount+$interest);
                   
                   $interest_from_credited = (($credit * $interest)/$repayment_amount);
                   $principal_from_credited = ($credit-$interest_from_credited);
                   $balance = ($booked_amount_c-$principal_from_credited);

                   //get month and year from form filled by qlip staff
                   $month=$this->input->post('month');
                   $year=$this->input->post('year');

                   //obtaining due date which also equals next_repayment_date
                   $date = DateTime::createFromFormat("Y-m-d", $first_repayment_date);//obtaining day from last_repayment_date
                   $day1 = $date->format("d"); //obtaining day from last_repayment_date
                   $month1 = $date->format("m"); //obtaining month from last_repayment_date
                   $year1 = $date->format("Y"); //obtaining day from last_repayment_date
                   if($month==12){
                   $next_repayment_date= ($year1+1)."-01"."-".$day1 ; }
                   else{
                          $next_repayment_date= ($year1)."-".($month1+1)."-".$day1 ; } 


                   $savedata=array(
                   'oracle_number'=>$emp_no,
                   'employee_name'=>$emp_name,
                   'ministry_name'=>$ministry_name,
                   'credit'=>$credit,
                   'ledger_balance'=>$balance,
                   'principal_from_credited'=>$principal_from_credited,
                   'interest_from_credited'=>$interest_from_credited,
                   'interest'=>$interest,
                   'principal_amount'=>$principal_amount,
                   'repayment_amount'=>$repayment_amount,
                   'balance'=>$balance,
                   'booked_amount'=>$booked_amount_c,
                   'tenure'=>$tenure,
                   'narration'=>$narration,
                   'element_name'=>$element_name,
                   'entry_date'=>date('Y-m-d'),
                   'month_year'=>$month_year,
                   'month'=>$month,
                   'year'=>$year,
                   'first_repayment_date'=>$first_repayment_date,
                   'last_repayment_date'=>$first_repayment_date,
                   'due_date'=>$next_repayment_date,
                   'file_id'=>$fileid['file_id']
                   );
                   $this->Qlip_model->insert_from_uploaded($savedata);
                   
                   //update this oracle loan application as old,first get the lsid of the last record and use to update
                   
                   $result_lsid = mysql_query("select lsid from lasg_staff_info where oracle_number='$emp_no' order by lsid desc limit 1"); // might add status approved to this
                   while($row=mysql_fetch_array($result_lsid))
                   {
                     $lsid=$row['lsid'];
                     $result_19 = mysql_query("update lasg_staff_info set new_old='old' where lsid='$lsid' and oracle_number='$emp_no'");
                   }
                   
               }
               else if( mysql_num_rows($result_ledger)>0 ) //meaning it already has record on deduction report table, well it's not likely to happen
               {
                  


                 /*
                  $new_old=0; $ledger_balance=0;
                  //get and check the new_old column to know if this is new loan application or coninue from ledger balance
                  $result_newold = mysql_query("select new_old from lasg_staff_info where oracle_number='$emp_no' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_newold))
                   {
                     $new_old=$row['new_old'];
                   }
                    
                  if($new_old=="old")
                {
                    //get the ledger balance
                    while($row=mysql_fetch_array( $result_ledger))
                   {
                     $ledger_balance=$row['ledger_balance'];
                     
                   }

                    //get the booked amount for the last approved loan
                   $result_bm = mysql_query("SELECT booked_amount,loan_tenure_months from lasg_staff_info where oracle_number='$emp_no' and status='approved' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_bm))
                   {
                     $booked_amount_c=$row['booked_amount'];
                     $tenure=$row['loan_tenure_months'];
                   }
                   //below are needed to prepare the formular to computeinterest
                   $interest=((4/100)*$booked_amount_c);
                   $principal_amount=($booked_amount_c/$tenure);
                   $repayment_amount=($principal_amount+$interest);
                   
                   $interest_from_credited = (($credit * $interest)/$repayment_amount);
                   $principal_from_credited = ($credit-$interest_from_credited);
                   $balance = ($ledger_balance-$principal_from_credited);
                   
                   $savedata=array(
                   'oracle_number'=>$emp_no,
                   'employee_name'=>$emp_name,
                   'ministry_name'=>$ministry_name,
                   'credit'=>$credit,
                   'ledger_balance'=>$balance,
                   'principal_from_credited'=>$principal_from_credited,
                   'interest_from_credited'=>$interest_from_credited,
                   'interest'=>$interest,
                   'principal_amount'=>$principal_amount,
                   'repayment_amount'=>$repayment_amount,
                   'balance'=>$balance,
                   'booked_amount'=>$booked_amount_c,
                   'tenure'=>$tenure,
                   'element_name'=>$element_name,
                   'entry_date'=>$entry_date,
                   'month_year'=>$month_year,
                   'file_id'=>$fileid['file_id']
                   );
                   $this->Qlip_model->insert_from_uploaded($savedata);
                }//end innermost if
                */
               }
  
                  
             }     

          }
          else
          {
            echo '<center><strong>Error!</strong><span class="text-danger">Invalid oracle_number'.$emp_no.'</span></center>';
            $error_report=1 ;
          }

          //$credit_sum=$credit_sum+$credit ;
    
   }//end for loop

  //bounce back all inserted record if any error is discovered
   if($error_report==1)
   {
       $this->Qlip_model->delete_from_upload_files($filename1,$fileid['file_id']);
       echo '<center><strong>Notification!</strong><span class="bg-info">All records have been bounced back, kindly rectify and re-upload</span></center>';
       echo '<a href="'.site_url().'/qlip_controller/upload_files_view" class="btn btn-primary">Return to deduction report upload page</a>';
   }
   else
   {
      $highestRow1=($highestRow1-1);
      echo '<center><strong>Notification!</strong><span class="bg-success">All '.$highestRow1.' record(S) were successfully uploaded</span></center>';
      echo '<a href="'.site_url().'/qlip_controller/upload_files_view" class="btn btn-primary">Return to deduction report upload page</a>';
   }
  

 }//end outermost if
 else if(mysql_num_rows($result)>0)
 {
    
    for ($row_start; $row_start <= $highestRow1; $row_start++) //$highestRow
    {
          $row1=$row_start;
          $emp_no=$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue():'';
          $emp_name=$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue():'';
          $ministry_name=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          $credit=$objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue():'';
          $element_name=$objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() : ''; 
          
          $fileid=$this->Qlip_model->get_fileid_uploaded($filename1);
          $savedata=array(
          'oracle_number'=>$emp_no,
          'employee_name'=>$emp_name,
          'ministry_name'=>$ministry_name,
          'credit'=>$credit,
          'element_name'=>$element_name,
          'entry_date'=>date('Y-m-d'),
          'month_year'=>$month_year,
          'file_id'=>$fileid['file_id']
          );

          $result4 = mysql_query("SELECT * from lasg_staff_info where oracle_number=$emp_no and status='approved'");
          if(mysql_num_rows($result4)>0)
          {
             $result2 = mysql_query("SELECT * from deduction_report where oracle_number='$emp_no' and month_year='$month_year' and checked !='declined'");
             if( mysql_num_rows($result2)>0 )
             {
                echo '<center><strong>Error!</strong><span class="text-danger">record already exist for this staff('.$emp_no.')with the same year </span></center>';
                $error_report=1 ;
             }
             else
             {
                   
                  //declare variables to be used inside this else
               $booked_amount_c=0; $interest=0; $principal_amount=0; $tenure=0; $repayment_amount=0; $first_repayment_date=0;

               //$this->Qlip_model->insert_from_uploaded($savedata);
               //echo '<center><strong>Success!</strong><span class="text-success">Employee record successfully uploaded! '.$emp_no.'</span></center>';

               /*computer principal amount,decreasing ledger balance and interest*/
               //use booked amount if first repayment otherwise use balance
                $result_ledger = mysql_query("SELECT ledger_balance from deduction_report where oracle_number='$emp_no' and checked = 'yes' order by rid desc limit 1");
               if( mysql_num_rows($result_ledger)==0 )
               {
                  //get the booked amount for the last approved loan
                   $result_bm = mysql_query("SELECT booked_amount,loan_tenure_months,first_repayment_date from lasg_staff_info where oracle_number='$emp_no' and status='approved' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_bm))
                   {
                     $booked_amount_c=$row['booked_amount'];
                     $tenure=$row['loan_tenure_months'];
                     $first_repayment_date=$row['first_repayment_date'];
                   }
                   //below are needed to prepare the formular to computeinterest
                   $interest=((4/100)*$booked_amount_c);
                   $principal_amount=($booked_amount_c/$tenure);
                   $repayment_amount=($principal_amount+$interest);
                   
                   $interest_from_credited = (($credit * $interest)/$repayment_amount);
                   $principal_from_credited = ($credit-$interest_from_credited);
                   $balance = ($booked_amount_c-$principal_from_credited);
                   
                   //get month and year from form filled by qlip staff
                   $month=$this->input->post('month');
                   $year=$this->input->post('year');

                   //obtaining due date which also equals next_repayment_date
                   $date = DateTime::createFromFormat("Y-m-d", $first_repayment_date);//obtaining day from last_repayment_date
                   $day1 = $date->format("d"); //obtaining day from last_repayment_date
                   $month1 = $date->format("m"); //obtaining month from last_repayment_date
                   $year1 = $date->format("Y"); //obtaining day from last_repayment_date
                   if($month==12){
                   $next_repayment_date= ($year1+1)."-01"."-".$day1 ; }
                   else{
                          $next_repayment_date= ($year1)."-".($month1+1)."-".$day1 ; } 

                   $savedata=array(
                   'oracle_number'=>$emp_no,
                   'employee_name'=>$emp_name,
                   'ministry_name'=>$ministry_name,
                   'credit'=>$credit,
                   'ledger_balance'=>$balance,
                   'principal_from_credited'=>$principal_from_credited,
                   'interest_from_credited'=>$interest_from_credited,
                   'interest'=>$interest,
                   'principal_amount'=>$principal_amount,
                   'repayment_amount'=>$repayment_amount,
                   'balance'=>$balance,
                   'booked_amount'=>$booked_amount_c,
                   'tenure'=>$tenure,
                   'narration'=>$narration,
                   'element_name'=>$element_name,
                   'entry_date'=>date('Y-m-d'),
                   'month_year'=>$month_year,
                   'month'=>$month,
                   'year'=>$year,
                   'first_repayment_date'=>$first_repayment_date,
                   'last_repayment_date'=>$first_repayment_date, //first time repayment for this customer
                   'due_date'=>$next_repayment_date,
                   'file_id'=>$fileid['file_id']
                   );
                   $this->Qlip_model->insert_from_uploaded($savedata);
                   
                   //update this oracle loan application as old,first get the lsid of the last record and use to update
                   $result_lsid = mysql_query("select lsid from lasg_staff_info where oracle_number='$emp_no' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_lsid))
                   {
                     $lsid=$row['lsid'];
                     $result_19 = mysql_query("update lasg_staff_info set new_old='old' where lsid='$lsid' and oracle_number='$emp_no'");
                   }
                   
               }
               else if( mysql_num_rows($result_ledger)>0 ) //meaning it already has record on deduction report table
               {
                  $result_33 = mysql_query("SELECT * from deduction_report where oracle_number='$emp_no' order by rid desc limit 1");
                   while($row=mysql_fetch_array($result_33))
                   {
                    $checked33=$row['checked'];
                    $month_year33=$row['month_year'];
                   }

                  if($checked33=='0')
                  {
                     echo '<center><strong>Error!</strong><span class="text-danger">The last repayment ('.$month_year33.') for this staff('.$emp_no.') is still pending and must be approved/declined, before a new upload  </span></center>';
                     $error_report=1 ;
                  }
                  else
                  {


                 
                  $new_old=0; $ledger_balance=0; $first_repayment_date=0;
                  //get and check the new_old column to know if this is new loan application or coninue from ledger balance
                  $result_newold = mysql_query("select new_old from lasg_staff_info where oracle_number='$emp_no' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_newold))
                   {
                     $new_old=$row['new_old'];
                   }
                    
                  if($new_old=="old")
                {
                    //get the ledger balance
                    while($row=mysql_fetch_array( $result_ledger))
                   {
                     $ledger_balance=$row['ledger_balance'];
                     
                   }

                    //get the booked amount for the last approved loan
                   $result_bm = mysql_query("SELECT booked_amount,loan_tenure_months,first_repayment_date from lasg_staff_info where oracle_number='$emp_no' and status='approved' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_bm))
                   {
                     $booked_amount_c=$row['booked_amount'];
                     $tenure=$row['loan_tenure_months'];
                     $first_repayment_date=$row['first_repayment_date'];
                   }
                   //below are needed to prepare the formular to computeinterest
                   $interest=((4/100)*$booked_amount_c);
                   $principal_amount=($booked_amount_c/$tenure);
                   $repayment_amount=($principal_amount+$interest);
                   
                   $interest_from_credited = (($credit * $interest)/$repayment_amount);
                   $principal_from_credited = ($credit-$interest_from_credited);
                   $balance = ($ledger_balance-$principal_from_credited);
                   
                   //get month and year from form filled by qlip staff
                   $month=$this->input->post('month');
                   $year=$this->input->post('year');

                   //compute last_repayment_date
                   $this->load->library('../controllers/month_number');
                   $month_no=$this->month_number->get_month_number($month);
                   $date = DateTime::createFromFormat("Y-m-d", $first_repayment_date);//obtaining day from last_repayment_date
                   $day = $date->format("d"); //obtaining day from last_repayment_date
                   $last_repayment_date=$year."-".$month_no."-".$day ;
                   //echo $year."-".$month_no."-".$day ;

                    //obtaining due date which also equals next_repayment_date
                   $date = DateTime::createFromFormat("Y-m-d", $last_repayment_date);//obtaining day from last_repayment_date
                   $day1 = $date->format("d"); //obtaining day from last_repayment_date
                   $month1 = $date->format("m"); //obtaining month from last_repayment_date
                   $year1 = $date->format("Y"); //obtaining day from last_repayment_date
                   if($month1==12){
                   $next_repayment_date= ($year1+1)."-01"."-".$day1 ; }
                   else{
                          $next_repayment_date= ($year1)."-".($month1+1)."-".$day1 ; } 

                   $savedata=array(
                   'oracle_number'=>$emp_no,
                   'employee_name'=>$emp_name,
                   'ministry_name'=>$ministry_name,
                   'credit'=>$credit,
                   'ledger_balance'=>$balance,
                   'principal_from_credited'=>$principal_from_credited,
                   'interest_from_credited'=>$interest_from_credited,
                   'interest'=>$interest,
                   'principal_amount'=>$principal_amount,
                   'repayment_amount'=>$repayment_amount,
                   'balance'=>$balance,
                   'booked_amount'=>$booked_amount_c,
                   'tenure'=>$tenure,
                   'narration'=>$narration,
                   'element_name'=>$element_name,
                   'entry_date'=>date('Y-m-d'),
                   'month_year'=>$month_year,
                   'month'=>$month,
                   'year'=>$year,
                   'first_repayment_date'=>$first_repayment_date,
                   'last_repayment_date'=>$last_repayment_date,
                   'due_date'=>$next_repayment_date,
                   'file_id'=>$fileid['file_id']
                   );
                   $this->Qlip_model->insert_from_uploaded($savedata);
                }//end innermost if
                else if($new_old=="new")
                {
                  echo "this is an existing customer that re-apply for a new loan, hence first ledger balance will be computed from booked amount";
                   //get the booked amount for the last approved loan
                   $result_bm = mysql_query("SELECT booked_amount,loan_tenure_months,first_repayment_date from lasg_staff_info where oracle_number='$emp_no' and status='approved' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_bm))
                   {
                     $booked_amount_c=$row['booked_amount'];
                     $tenure=$row['loan_tenure_months'];
                   }
                   //below are needed to prepare the formular to computeinterest
                   $interest=((4/100)*$booked_amount_c);
                   $principal_amount=($booked_amount_c/$tenure);
                   $repayment_amount=($principal_amount+$interest);
                   
                   $interest_from_credited = (($credit * $interest)/$repayment_amount);
                   $principal_from_credited = ($credit-$interest_from_credited);
                   $balance = ($booked_amount_c-$principal_from_credited);

                   $month=$this->input->post('month');
                   $year=$this->input->post('year');

                   //obtaining due date which also equals next_repayment_date
                   $date = DateTime::createFromFormat("Y-m-d", $first_repayment_date);//obtaining day from last_repayment_date
                   $day1 = $date->format("d"); //obtaining day from last_repayment_date
                   $month1 = $date->format("m"); //obtaining month from last_repayment_date
                   $year1 = $date->format("Y"); //obtaining day from last_repayment_date
                   if($month==12){
                   $next_repayment_date= ($year1+1)."-01"."-".$day1 ; }
                   else{
                          $next_repayment_date= ($year1)."-".($month1+1)."-".$day1 ; } 
                   
                   $savedata=array(
                   'oracle_number'=>$emp_no,
                   'employee_name'=>$emp_name,
                   'ministry_name'=>$ministry_name,
                   'credit'=>$credit,
                   'ledger_balance'=>$balance,
                   'principal_from_credited'=>$principal_from_credited,
                   'interest_from_credited'=>$interest_from_credited,
                   'interest'=>$interest,
                   'principal_amount'=>$principal_amount,
                   'repayment_amount'=>$repayment_amount,
                   'balance'=>$balance,
                   'booked_amount'=>$booked_amount_c,
                   'tenure'=>$tenure,
                   'narration'=>$narration,
                   'element_name'=>$element_name,
                   'entry_date'=>date('Y-m-d'),
                   'month_year'=>$month_year,
                   'month'=>$month,
                   'year'=>$year,
                   'first_repayment_date'=>$first_repayment_date,
                   'last_repayment_date'=>$first_repayment_date,
                   'due_date'=>$next_repayment_date,
                   'file_id'=>$fileid['file_id']
                   );
                   $this->Qlip_model->insert_from_uploaded($savedata);
                   
                   //update this oracle loan application as old,first get the lsid of the last record and use to update
                   $result_lsid = mysql_query("select lsid from lasg_staff_info where oracle_number='$emp_no' order by lsid desc limit 1");
                   while($row=mysql_fetch_array($result_lsid))
                   {
                     $lsid=$row['lsid'];
                     $result_19 = mysql_query("update lasg_staff_info set new_old='old' where lsid='$lsid' and oracle_number='$emp_no'");
                   }
                }

                }
               }
                //$this->Qlip_model->insert_from_uploaded($savedata);
                //echo '<center><strong>Success!</strong><span class="text-success">Employee record successfully uploaded! '.$emp_no.'</span></center>';
             }

        }
        else
        {
           echo '<center><strong>Error!</strong><span class="text-danger">Invalid oracle_number'.$emp_no.'</span></center>';
           $error_report=1 ;
        }
          
        //$credit_sum=$credit_sum+$credit ;
        
   }//end for loop
   
   //bounce back all inserted record if any error is discovered
   if($error_report==1)
   {
       $this->Qlip_model->delete_from_upload_files($filename1,$fileid['file_id']);
       echo '<center><strong>Notification!</strong><span class="bg-info">All records have been bounced back, kindly rectify and re-upload</span></center>';
       echo '<a href="'.site_url().'/qlip_controller/upload_files_view" class="btn btn-primary">Return to deduction report upload page</a>';
   }
   else
   {
      $highestRow1=($highestRow1-1);
      echo '<center><strong>Notification!</strong><span class="bg-success">All '.$highestRow1.' record(S) were successfully uploaded</span></center>';
      echo '<a href="'.site_url().'/qlip_controller/upload_files_view" class="btn btn-primary">Return to deduction report upload page</a>';
   }

     
 }
   echo '</div>'; //close panel body div
   echo '</div>'; //close panel div
   echo '</container></p>';
   echo '</body>';
   echo '</html>';
}//end function insertintodb

  function logout()
  {
      /*Unlock all views locked by this user*/
      $uname = $this->session->userdata('uname');
      //update view_mode table
      $sql = "update lasg_staff_info set view_mode='off' where user_viewing='$uname'";
      $query = $this->db->query($sql);

      /*Unset every session*/
      $this->session->unset_userdata('userid');
      $this->session->unset_userdata('uname');
      $this->session->unset_userdata('fname');
      $this->session->unset_userdata('lname');
      $this->session->unset_userdata('role');

      redirect('user_login_c/index','refresh');
  }

  /*function get_report()
  {
    $this->load->dbutil();
    $this->load->helper('file');
    // get the object 
    $report = $this->Qlip_model->get_report();
    //  pass it to db utility function 
    $new_report = $this->dbutil->csv_from_result($report);
    //Now use it to write file. write_file helper function will do it
    write_file('asset/csv_file.csv',$new_report);
    
 }*/

 function get_csv()
{
    $this->file_path = realpath(APPPATH . '../asset/csv');
    //$this->load->model('csv_m');
    $this->load->dbutil();
    $this->load->helper('file');
    //get the object
    $report = $this->Qlip_model->get_csv();

    $delimiter = ",";
    $newline = "\r\n";
    $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
    // write file
    write_file($this->file_path . '/csv_file.csv', $new_report);
    //force download from server
    $this->load->helper('download');
    $data = file_get_contents($this->file_path . '/csv_file.csv');
    $name = 'name-'.date('d-m-Y').'.csv';
    force_download($name, $data);
 }

 function view_report($count=0) //view report on the admin section
 {
     
     if($count==0)
     {
       $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
       $data['title'] = 'Spool report';
       $data['report_data'] = $this->Qlip_model->get_reports();
       $data['content'] = 'report';
       $this->load->view('admin_template',$data);
    }
     else if($count==1)
     {
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date');
       $report_type=$this->input->post('report_type');
       $submit=$this->input->post('submit');
       if($submit=="View")
       {
          $data['report_type']=$report_type ;
          $data['start_date']=$start_date ;
          $data['end_date']=$end_date ;
           
           $data['approved_count']=$this->get_approved_count("dummy","l2") ;
           $data['pending_count']=$this->get_pending_count("dummy","l2") ;
           $data['declined_count']=$this->get_declined_count("dummy","l2") ;
           $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
           $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;

          $data['title'] = 'Spool report';
          $data['report_data'] = $this->Qlip_model->get_reports(1);
          $data['content'] = 'report';
          $this->load->view('admin_template',$data);

       }
       else if($submit=="Spool")
       {

          $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_report_csv(1);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'name-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }
    }
       
 }  
 
 function download_log()
 {
            $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_log_csv();

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'name-'.date('d-m-Y').'.csv';
            force_download($name, $data);
 } 

 function view_report_l2($count=0)
 {
     
     if($count==0)
     {
       /*$data['title'] = 'Spool report';
       $data['report_data'] = $this->Qlip_model->get_reports();
       $data['content'] = 'report';
       $this->load->view('admin_template',$data);*/
    }
     else if($count==1)
     {
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date');
       $report_type=$this->input->post('report_type');
       $submit=$this->input->post('submit');
       if($submit=="View")
       {
          $data['report_type']=$report_type ;
          $data['start_date']=$start_date ;
          $data['end_date']=$end_date ;
          $data['report_data'] = $this->Qlip_model->get_reports(1);

          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
          $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
          
          $data['breakdown'] = 'User(level 2) Dashboard';
          $data['director']="blanck"; //this is an indictor to direct the level2 dashboard to either ledger balance or search page 
          $data['title'] = 'User Dashboard';
          $data['content'] = 'level2_dashboard';
          $this->load->view('level2_template',$data);

       }
       else if($submit=="Spool")
       {

           $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_report_csv(1);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'name-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }
    }
       
 }   

 function view_report_primera($count=0)
 {
     
     if($count==0)
     {
       /*$data['title'] = 'Spool report';
       $data['report_data'] = $this->Qlip_model->get_reports();
       $data['content'] = 'report';
       $this->load->view('admin_template',$data);*/
    }
     else if($count==1)
     {
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date');
       $report_type=$this->input->post('report_type');
       $submit=$this->input->post('submit');
       if($submit=="View")
       {
          $data['report_type']=$report_type ;
          $data['start_date']=$start_date ;
          $data['end_date']=$end_date ;
          $data['report_data'] = $this->Qlip_model->get_reports_primera(1);

          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          /*$data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
          $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;*/
          
          $data['breakdown'] = 'User(primera) Dashboard';
          $data['director']="blanck"; //this is an indictor to direct the level2 dashboard to either ledger balance or search page 
          $data['title'] = 'Primera Dashboard';
          $data['content'] = 'primera_dashboard';
          $this->load->view('primera_template',$data);

       }
       else if($submit=="Spool")
       {

           $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_report_csv_primera(1);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'name-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }
    }
       
 }   

 function view_report_l1($count=0)
 {
     $uname = $this->uri->segment(4);
     if($count==0)
     {
       /*$data['title'] = 'Spool report';
       $data['report_data'] = $this->Qlip_model->get_reports();
       $data['content'] = 'report';
       $this->load->view('admin_template',$data);*/
    }
     else if($count==1)
     {

       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date');
       $report_type=$this->input->post('report_type');
       $submit=$this->input->post('submit');
       if($submit=="View")
       {
          $data['report_type']=$report_type ;
          $data['start_date']=$start_date ;
          $data['end_date']=$end_date ;
          $data['report_data'] = $this->Qlip_model->get_reports_l1($uname,1);

          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
          $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;

          $data['director']="blanck"; //this is an indictor to direct the level2 dashboard to either ledger balance or search page 
          $data['title'] = 'User Dashboard';
          $data['content'] = 'level1_dashboard';
          $this->load->view('level1_template',$data);

       }
       else if($submit=="Spool")
       {

           $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_report_csv_l1($uname,1);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'name-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }
    }
       
 }


 function download_summary()
 {
   $id = $this->uri->segment(3);
   
   $sql="select * from lasg_staff_info inner join customer_group on lasg_staff_info.group_id=customer_group.group_id where lasg_staff_info.lsid='$id'";
   $query = $this->db->query($sql);

   foreach($query->result() as $customer) 
   {  
      $name = $customer->sname.' '.$customer->mname.' '.$customer->fname ;
      $group_code = $customer->group_name.' / '.$customer->description ;
      $business_loc = $customer->bus_full_addr.' , '.$customer->lg_bus.' , '.$customer->city_bus.' , '.$customer->state_bus ;

     $sql="update customer_summary set value='$name' where property='CUSTOMER_NAME'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->qlip_id' where property='CUSTOMER_CODE'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$group_code' where property='GROUP_CODE'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->name_of_trade_assoc' where property='TRADE_ASSOCIATION'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->bus_type' where property='NATURE_OF_BUSINESS'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->age_of_bus' where property='NUMBER_OF_YEARS_IN_BUSINESS'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$business_loc' where property='BUSINESS_LOCATION'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->amount_requested' where property='AMOUNT_REQUESTED'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->use_of_loan' where property='PURPOSE_OF_LOAN'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->loan_term' where property='LOAN_TENURE'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->total_exp' where property='MONTHLY_BUSINESS_EXPENSES'";
     $this->db->query($sql);
     $sql="update customer_summary set value='$customer->gross_margin' where property='GROSS_MARGIN'";
     $this->db->query($sql);

      $this->spool_summary($name);
     break ;
   }

 }

 function spool_summary($name)
 {
          $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->spool_summary($name);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = $name.'-'.date('d-m-Y').'.csv';
            force_download($name, $data);

 }


  function search_filter()
  {
       $empty1="";
       $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
       $data['level1_data'] = $this->Qlip_model->search_filter(1);
       $data['title'] = 'Posted Loan';
       $data['content'] = 'view_loan_level1';
       $this->load->view('level1_template',$data);
  }
  
  function search_filter_deployed()
  {
       $empty1="";
       $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
       $data['level1_data'] = $this->Qlip_model->search_filter_deployed(1);
       $data['title'] = 'Deployed Asset';
       $data['content'] = 'view_deployed_asset';
       $this->load->view('level1_template',$data);
  }  
  
  function search_filter_returned()
  {
       $empty1="";
       $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
       $data['level1_data'] = $this->Qlip_model->search_filter_returned(1);
       $data['title'] = 'Returned Asset';
       $data['content'] = 'view_returned_asset';
       $this->load->view('level1_template',$data);
  } 
  
  function search_filter_decommissioned()
  {
       $empty1="";
       $data['approved_count']=$this->get_approved_count("dummy","l2") ;
       $data['pending_count']=$this->get_pending_count("dummy","l2") ;
       $data['declined_count']=$this->get_declined_count("dummy","l2") ;
       $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
       $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
       $data['level1_data'] = $this->Qlip_model->search_filter_decommissioned(1);
       $data['title'] = 'Returned Asset';
       $data['content'] = 'view_decommissioned_asset';
       $this->load->view('level1_template',$data);
  }   



  function view_due_payments_l1($search=0)
  {
    $uname = $this->uri->segment(4);

    if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count($uname) ;
     $data['pending_count']=$this->get_pending_count($uname) ;
     $data['declined_count']=$this->get_declined_count($uname) ;
     $data['authorized_count']=$this->get_authorized_count($uname) ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
     $data['due_data'] = $this->Qlip_model->get_data('due_data_l1','',$uname);
     $data['title'] = 'Due Payments';
     $data['content'] = 'view_due_payments_l1';
     $this->load->view('level1_template',$data);
    }
    else
    {
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date');
       $btn_submit=$this->input->post('btn_submit');
       if($btn_submit=="View")
       {
          
          $data['start_date']=$start_date ;
          $data['end_date']=$end_date ;
          $data['approved_count']=$this->get_approved_count($uname) ;
     $data['pending_count']=$this->get_pending_count($uname) ;
     $data['declined_count']=$this->get_declined_count($uname) ;
     $data['authorized_count']=$this->get_authorized_count($uname) ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
          $data['title'] = 'Spool report';
          $data['due_data'] = $this->Qlip_model->get_due_payments($uname);
          $data['content'] = 'view_due_payments_l1';
          $this->load->view('level1_template',$data);

       }
       else if($btn_submit=="Spool")
       {

           $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_due_payments_csv($uname);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'Due_payments-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }


  }//end else

  }

  

  function view_due_payments_primera($search=0)
  {
      if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     
     $data['due_data'] = $this->Qlip_model->get_data('due_data');
     $data['title'] = 'Due Payments';
     $data['content'] = 'view_due_payments_primera';
     $this->load->view('primera_template',$data);
    }
    else
    {
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date');
       $btn_submit=$this->input->post('btn_submit');
       if($btn_submit=="View")
       {
          
          $data['start_date']=$start_date ;
          $data['end_date']=$end_date ;
          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          
          $data['title'] = 'Spool report';
          $data['due_data'] = $this->Qlip_model->get_due_payments("l2");
          $data['content'] = 'view_due_payments_primera';
          $this->load->view('primera_template',$data);

       }
       else if($btn_submit=="Spool")
       {

           $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_due_payments_csv("l2");

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'Due_payments-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }


  }//end else

  } 

  function view_qlip_uploads() //for primera
  {
     $level = $this->uri->segment(3);
    if(empty($level)){
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('qlip_upload_data');
     $data['title'] = 'Qlip Upload Loan';
     $data['content'] = 'view_qlip_uploads';
     $this->load->view('primera_template',$data);
     }
     else {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('qlip_upload_data');
     $data['title'] = 'Qlip Upload Loan';
     $data['content'] = 'view_qlip_uploads_l2';
     $this->load->view('level2_template',$data);
     }
  }

  function view_reconciliation($search=0) //for primera
  {
     if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('view_reconciliation');
     $data['title'] = 'Qlip Upload Loan';
     $data['content'] = 'reconciliation';
     $this->load->view('primera_template',$data);
    }
    else
    {
       
       $btn_submit=$this->input->post('btn_submit');
       if($btn_submit=="View")
       {
          
          
          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          
          $data['title'] = 'Spool report';
          $data['qlip_upload_data'] = $this->Qlip_model->get_recon_report("l2");
          $data['content'] = 'reconciliation';
          $this->load->view('primera_template',$data);

       }
       else if($btn_submit=="Spool")
       {

           $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_recon_report_csv("l2");

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'reconciliation-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }


  }//end else

  }//end method view_reconciliation

  function view_reconciliation_l2($search=0) //for primera
  {
     if($search==0)
   {     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('view_reconciliation');
     $data['title'] = 'Qlip Upload Loan';
     $data['content'] = 'reconciliation_l2';
     $this->load->view('level2_template',$data);
    }
    else
    {
       
       $btn_submit=$this->input->post('btn_submit');
       if($btn_submit=="View")
       {
          
          
          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
         $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
          
          $data['title'] = 'Spool report';
          $data['qlip_upload_data'] = $this->Qlip_model->get_recon_report("l2");
          $data['content'] = 'reconciliation_l2';
          $this->load->view('level2_template',$data);

       }
       else if($btn_submit=="Spool")
       {

           $this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->Qlip_model->get_recon_report_csv("l2");

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'reconciliation-'.date('d-m-Y').'.csv';
            force_download($name, $data);
      }


  }//end else

  }//end method view_reconciliation

  function get_single_recon($file_id) //for primera
  {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('single_recon',$file_id);
     $data['title'] = 'Qlip Upload Loan';
     $data['content'] = 'reconciliation';
     $this->load->view('primera_template',$data);

  }

   function view_uploaded_status() //for level2
 {
   $id = $this->uri->segment(3);
   $type = $this->uri->segment(4);
   
   if($type=="edit")
   {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('qlip_upload_data_each',$id);
     $data['title'] = 'Qlip Upload Loan';
     $data['content'] = 'edit_qlip_uploads';
     $this->load->view('level2_template',$data);

   }

}


  function edit_uploaded() //for primera
 {
   $id = $this->uri->segment(3);
   $type = $this->uri->segment(4);
   
   if($type=="edit")
   {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('qlip_upload_data_each',$id);
     $data['title'] = 'Qlip Upload Loan';
     $data['content'] = 'edit_qlip_uploads';
     $this->load->view('primera_template',$data);

   }
   else if($type=="update")
   {
     $valuex=$this->input->post('btn_submit');
     if($valuex=="Approve")
     {
           $this->form_validation->set_rules('statement_id', 'Statement ID', 'required');
           $this->form_validation->set_rules('credit_bank', 'Amount Credited', 'required');
           $this->form_validation->set_rules('value_date', 'Value Date', 'required');
           $this->form_validation->set_rules('narration_bank', 'Narration on Bank Statement', 'required');

           if ($this->form_validation->run() === FALSE)
              {
               $data['approved_count']=$this->get_approved_count("dummy","l2") ;
               $data['pending_count']=$this->get_pending_count("dummy","l2") ;
               $data['declined_count']=$this->get_declined_count("dummy","l2") ;

               $data['qlip_upload_data'] = $this->Qlip_model->get_data('qlip_upload_data_each',$id);
               $data['title'] = 'Qlip Upload Loan';
               $data['content'] = 'edit_qlip_uploads';
               $this->load->view('primera_template',$data);
              }
              else
             {
               $this->load->model('qlip_model');
               $this->qlip_model->update_qlip_upload($id,"approved");
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                 $this->session->set_flashdata('message', 'upload_updated');
                 redirect('qlip_controller/view_qlip_uploads','refresh');
               } 
               else
               {
                 $this->session->set_flashdata('message', 'upload_updated_0');
                 redirect('qlip_controller/view_qlip_uploads','refresh');
               }
             }
           
     }
     else if($valuex=="Decline")
     {
         $this->form_validation->set_rules('rejection_reason', 'Reason for declining upload', 'required');
         if ($this->form_validation->run() === FALSE)
          {
           $data['approved_count']=$this->get_approved_count("dummy","l2") ;
           $data['pending_count']=$this->get_pending_count("dummy","l2") ;
           $data['declined_count']=$this->get_declined_count("dummy","l2") ;

            $data['qlip_upload_data'] = $this->Qlip_model->get_data('qlip_upload_data_each',$id);
            $data['title'] = 'Qlip Upload Loan';
            $data['content'] = 'edit_qlip_uploads';
            $this->load->view('primera_template',$data);
           }
           else
           {
             $this->load->model('qlip_model');
             $this->qlip_model->update_qlip_upload($id,"declined");
             $num_inserts = $this->db->affected_rows();
             if($num_inserts=="1")
             {
               $this->session->set_flashdata('message', 'upload_declined');
               redirect('qlip_controller/view_qlip_uploads','refresh');
             } 
             else
             {
               $this->session->set_flashdata('message', 'upload_updated_0');
               redirect('qlip_controller/view_qlip_uploads','refresh');
             }
           }
     }


   }

 }

  function file_upload_primera() //for primera
 {
   $id = $this->uri->segment(3);
   $type = $this->uri->segment(4);
   
   if($type=="edit")
   {
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;

     $data['qlip_upload_data'] = $this->Qlip_model->get_data('qlip_upload_data_each',$id);
     $data['title'] = 'Upload expected repayment';
     $data['content'] = 'file_upload_primera';
     $this->load->view('primera_template',$data);

   }
   else if($type=="upload")
   {
     $this->load->library('../controllers/validate_file_upload_primera');
     $status=$this->validate_file_upload_primera->upload_files($id);
     
     

   }

 }

 function download_uploaded($file_id)
 {
    $this->file_path = realpath(APPPATH . '../asset/csv');
    //$this->load->model('csv_m');
    $this->load->dbutil();
    $this->load->helper('file');
    //get the object
    
    $report=$this->Qlip_model->download_uploaded($file_id);

    //generate the csv report
     $delimiter = ",";
     $newline = "\r\n";
     $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
     // write file
     write_file($this->file_path . '/csv_file.csv', $new_report);
     //force download from server
     $this->load->helper('download');
     $data = file_get_contents($this->file_path . '/csv_file.csv');
     $name = 'Repayment_upload-'.date('d-m-Y').'.csv';
     force_download($name, $data);

 }

 function view_upload_documents($uname,$oracle_number)
 {
     //$uname = $this->uri->segment(3);     
     $data['approved_count']=$this->get_approved_count($uname) ;
     $data['pending_count']=$this->get_pending_count($uname) ;
     $data['declined_count']=$this->get_declined_count($uname) ;
     $data['authorized_count']=$this->get_authorized_count($uname) ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
     $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
     $data['title'] = 'Upload Documents';
     $data['oracle_no'] = $oracle_number;
     $data['content'] = 'view_upload_documents';
     $this->load->view('level1_template',$data);
 }

 function view_bulk_upload($uname)
 {
     $uname = $this->uri->segment(3);     
     $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
     $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
     $data['title'] = 'Bulk Upload';
     ///$data['oracle_no'] = $oracle_number;
     $data['content'] = 'view_bulk_upload';
     $this->load->view('level1_template',$data);
 }

 function insert_bulk_upload()
 {
    
    $uname = $this->session->userdata('uname');
    $role = $this->session->userdata('role');
   $this->form_validation->set_rules('flag_', 'Document', 'required');
   if (empty($_FILES['myuploadFile']['name']))
    {
        $this->form_validation->set_rules('myuploadFile', 'Document', 'required');
    }

    if ($this->form_validation->run() === FALSE)
    {
      if($role=="level1")
      {
          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
     $data['pending_count']=$this->get_pending_count("dummy","l2") ;
     $data['declined_count']=$this->get_declined_count("dummy","l2") ;
     $data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;
          $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
          $data['title'] = 'Bulk Upload';
          $data['content'] = 'view_bulk_upload';
          $this->load->view('level1_template',$data);
      }
    }
    else
    {
        $storeFolder = './uploads/';
        if (!empty($_FILES)) 
        { 
          $tempFile = $_FILES['myuploadFile']['tmp_name'];            
          $targetPath =$storeFolder;
          $temp = explode(".", $_FILES["myuploadFile"]["name"]);
          $newfilename = time().$_FILES["myuploadFile"]["name"];
          $targetFile =  $targetPath. $newfilename;  
          move_uploaded_file($tempFile,$targetFile); 
          $path=$file_name='uploads/'.$newfilename;

          $this->insert_from_uploaded_bulk($path);
        }

    }

 }

 function insert_from_uploaded_bulk($path)
 {

     $this->load->library('PHPExcel/Classes/PHPExcel');
     $inputFileType = PHPExcel_IOFactory::identify($path);
     $objReader1     = PHPExcel_IOFactory::createReader($inputFileType);
     $objPHPExcel1   = $objReader1->load($path);
     $sheetList      = $objReader1->listWorksheetNames($path); 
     foreach ($sheetList as $sheetName)
     {
        $currentObjectName  = $objPHPExcel1->setActiveSheetIndexByName($sheetName);
        $result=$this->insertintodb_bulk($currentObjectName);
     }
  }

function insertintodb_bulk($objWorksheet1)
{ 
    $unames = $this->session->userdata('uname');

    $entry_date=date('Y-m-d');
    $this->load->library('form_validation');
    $highestRow1 = $objWorksheet1->getHighestRow(); // e.g. 10
    $row1=1; // row in which customers description starts in a work sheet
    $row_start= $row1+1;
    
    //design error page ;
    echo '<html>';
    echo '<head>';
    echo '<title>Result</title>';
    echo '<head>';
    echo '<link href="'.base_url().'asset/bs_css/bootstrap.min.css" rel="stylesheet">';
    //echo '<link href="'.base_url().'asset/bs_css/style.css" rel="stylesheet">';
    echo '<link href="'.base_url().'asset/bs_js/bootstrap.min.js"></script>';
    echo '<link href="'.base_url().'asset/bs_js/jquery-1.8.3.min.js"></script>';
    echo '</head>';

    echo '<body>';

    echo '<p><div class="container">';
    echo '<div class="panel panel-primary">';
    echo '<div class="panel-heading">File Upload Report(s)</div>';
    echo '<div class="panel-body">';

    for ($row_start; $row_start <= $highestRow1; $row_start++) //$highestRow
    {
          $row1=$row_start;
          $category=$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue():'';
          $asset_type=$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue():'';
          $asset_name=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          $model=$objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue():'';
          $serial=$objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() : ''; 
          $spec=$objWorksheet1->getCellByColumnAndRow(5, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(5, $row1)->getValue() : '';
          $po_number=$objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() : '';
          $vendor=$objWorksheet1->getCellByColumnAndRow(7, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(7, $row1)->getValue() : '';
          $purchase_date=$objWorksheet1->getCellByColumnAndRow(8, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(8, $row1)->getValue() : '';
          $warranty=$objWorksheet1->getCellByColumnAndRow(9, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(9, $row1)->getValue() : '';
          $date_installed=$objWorksheet1->getCellByColumnAndRow(10, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(10, $row1)->getValue() : '';
          $state=$objWorksheet1->getCellByColumnAndRow(11, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(11, $row1)->getValue() : '';
          $city=$objWorksheet1->getCellByColumnAndRow(12, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(12, $row1)->getValue() : '';
          $lg=$objWorksheet1->getCellByColumnAndRow(13, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(13, $row1)->getValue() : '';
          /*echo $category."".$asset_type."".$asset_name."".$model."".$serial."".$spec."".$po_number."".$vendor."".$purchase_date."".$warranty."".$date_installed."".$state."".$city."".$lg ;*/
          //format date
          $purchase_date = PHPExcel_Style_NumberFormat::toFormattedString($purchase_date,'YYYY-MM-DD' );
          $date_installed = PHPExcel_Style_NumberFormat::toFormattedString($date_installed,'YYYY-MM-DD' );
          
          //validate mandatory fields
          if(!empty($category)&& !empty($asset_type) && !empty($asset_name) && !empty($model) && !empty($serial) && !empty($spec) && !empty($purchase_date) && !empty($warranty) && !empty($date_installed) && !empty($state) && !empty($city))
          {

              //validate duplicacy
              $result3 = mysql_query("SELECT * from lasg_staff_info where serial='$serial'");
              if(mysql_num_rows($result3)>0)
              {
                  echo '<center><strong>Error!</strong><span class="text-danger">record already exist for this serial('.$serial.') with the same serial </span></center>';
                  $error_report=1 ;
              }
              else
              {

              //generate device_id
              $result1 = mysql_query("select * from qlip_id order by id desc limit 1");
              while($row = mysql_fetch_array($result1))
              {
                  $qlip_id = $row['id_series'] + 1 ;
                  $id = $row['id'];
                  //update with the new qlip id
                  mysql_query("update qlip_id set id_series = '$qlip_id' where id = '$id'");
    
              }
              
              /*Auto generate d2rs_id, serves as oracle_no*/
              $sql = "select d2rs_id from d2rs_unique_id";
              $query = $this->db->query($sql);
              foreach ($query->result() as $val_d2rs_id)
              {
                  $d2rs_id = $val_d2rs_id->d2rs_id ;
                  $today = date('Y-m-d');
                  $date11 = DateTime::createFromFormat("Y-m-d", $today);
                  $year = $date11->format("Y");
                  $year = substr($year,1,4);
                  $d2rs_number = "2".$year."".$d2rs_id ;

                  //increment and update d2rs_id
                  $d2rs_id = $d2rs_id + 1 ;
                  $sql = "update d2rs_unique_id set d2rs_id = '$d2rs_id'";
                  $query = $this->db->query($sql);
              }

              //calculate the warranty expiry_date
              //echo "<br>1113".$purchase_date;
              $date12 = DateTime::createFromFormat("Y-m-d", "2016-05-30");//obtaining day from last_repayment_date
              $day1 = $date12->format("d"); //obtaining day from last_repayment_date
              $month1 = $date12->format("m"); //obtaining month from last_repayment_date
              $year1 = $date12->format("Y"); //obtaining day from last_repayment_date

              $expiry_year=$year1+$warranty;
              $warranty_expiry = $expiry_year."-".$month1."-".$day1;

              //get installer info
              
              $sql="select * from qusers where uname = '$unames'";
              $query = $this->db->query($sql);
              foreach ($query->result() as $val_user)
              {
                    $fname = $val_user->fname ;
                    $lname = $val_user->lname ;
                    $project = $val_user->project ;
              }

              $error_report = 0 ;
              $installer_name = $lname.' '.$fname ;                    
              $l2_approved='no';
              $status='installed';
              $data = array(
              'unique_id' => $d2rs_number,
              'installer_name' => $installer_name,
              'project' => $project,
              'department' => $this->input->post('department'),
              'state' => $state,
              'city' => $city,
              'lg' => $lg,
              'category' => $category,
              'asset_type' => $asset_type,
              'asset_name' => $asset_name,
              'model' => $model,
              'serial' => $serial,
              'specification' => $spec,
              'po_number' => $po_number,
              'vendor' => $vendor,
              'purchase_date' => $purchase_date,
              'warranty' => $warranty,
              'expiry_date' => $warranty_expiry,
              'date_installed' => $date_installed,
              'posted_by' =>$unames,
              'status' => $status,
              'install_type' => 'bulk',
              'available' => 'yes',
              'l2_approved' => $l2_approved,
              'date_applied' => date('Y-m-d'),
              'action_type' =>'insert',
              'action_user' =>$uname = $this->session->userdata('uname'),
              'qlip_id' =>$qlip_id
              );
              $this->db->insert('lasg_staff_info', $data);
              $id_ = $this->db->insert_id();
              $num_inserts = $this->db->affected_rows();
              if($num_inserts=="1")
              {
                  echo '<center><strong>Sucess!</strong><span class="text-success"> Serial'.$serial.'Successfully installed</span></center>';
                  $this->load->model('qlip_model');
                  $this->qlip_model->audit_trigger($id_);
              }

              }//end duplicacy validation
          }//end fields validation if
          else
          {
              echo '<center><strong>Error!</strong><span class="text-danger">ASSET_TYPE, ASSET_NAME_BRAND,  MODEL SERIAL,  SPEC,PURCHASE_DATE(yyy-mm-dd),  WARRANTY  DATE_INSTALLED(yyyy-mm-dd) , STATE, CITY are mandatory</span></center>';
              $error_report=1 ;
          }
    }//end for
    if($error_report==1)
    {
       echo '<a href="'.site_url().'/qlip_controller/view_bulk_upload/'.$unames.'" class="btn btn-primary">Return to bulk upload page</a>';
    }
    else
    {
        echo '<a href="'.site_url().'/qlip_controller/view_bulk_upload/'.$unames.'" class="btn btn-primary">Return to bulk upload page</a>';
    }
}

 function change_upload_documents($uname,$oracle_number,$id)
 {
     //$uname = $this->uri->segment(3);     
     $data['approved_count']=$this->get_approved_count($uname) ;
     $data['pending_count']=$this->get_pending_count($uname) ;
     $data['declined_count']=$this->get_declined_count($uname) ;
     $data['authorized_count']=$this->get_authorized_count($uname) ;
     $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
     $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
     $data['title'] = 'Upload Documents';
     $data['oracle_no'] = $oracle_number;
     $data['id'] = $id;
     $data['content'] = 'change_upload_documents';
     $this->load->view('level1_template',$data);
 }

 function upload_documents()
 {
     $uname = $this->uri->segment(3);     
     $this->form_validation->set_rules('oracle_number', 'Oracle Number', 'required');
     $this->form_validation->set_rules('document_type', 'Document Type', 'required');
     //$this->form_validation->set_rules('myuploadFile', 'Upload file', 'required');
     if (empty($_FILES['myuploadFile']['name']))
    {
        $this->form_validation->set_rules('myuploadFile', 'Document', 'required');
    }
      if ($this->form_validation->run() === FALSE)
     {
      $data['approved_count']=$this->get_approved_count($uname) ;
      $data['pending_count']=$this->get_pending_count($uname) ;
      $data['declined_count']=$this->get_declined_count($uname) ;
      $data['authorized_count']=$this->get_authorized_count($uname) ;
      $data['pending_authorized_count']=$this->get_pending_authorized_count($uname) ;
      $data['level1_data'] = $this->Qlip_model->get_data('level1_data',$uname);
      $data['title'] = 'Upload Documents';
      $data['content'] = 'view_upload_documents';
      $this->load->view('level1_template',$data);
     }
     else
     {
       $oracle_number=$this->input->post('oracle_number');
       $result11 = mysql_query("SELECT * from lasg_staff_info where oracle_number='$oracle_number'");
       if( mysql_num_rows($result11)>0 )
       {
           $storeFolder = './uploads/images/';
           if (!empty($_FILES)) 
           {  
              $max_filesize=2000000 ;
              $uploadSize = $_FILES['myuploadFile']['size'];

              if($uploadSize<$max_filesize){

              $tempFile = $_FILES['myuploadFile']['tmp_name'];            
              $targetPath =$storeFolder;
              $temp = explode(".", $_FILES["myuploadFile"]["name"]);
              $newfilename = time().$_FILES["myuploadFile"]["name"];
              $targetFile =  $targetPath. $newfilename;  
              move_uploaded_file($tempFile,$targetFile); 
              $path=$file_name='uploads/images/'.$newfilename;
              
              $data = array(
              'oracle_number' => $this->input->post('oracle_number'),
              'document_type' => $this->input->post('document_type'),
              'path' =>$path
                );
               $this->db->insert('documents', $data);
               $num_inserts = $this->db->affected_rows();
               if($num_inserts=="1")
               {
                 $this->session->set_flashdata('message', 'uploaded');
                 redirect('qlip_controller/view_upload_documents/'.$uname,'refresh');
                 
               }
              }
              else{
                    $this->session->set_flashdata('message', 'too_big');
                    redirect('qlip_controller/view_upload_documents/'.$uname,'refresh');
              }

          }   
        }  
        else
        {
          $this->session->set_flashdata('message', 'invalid_on');//invalid oracle number
          redirect('qlip_controller/view_upload_documents/'.$uname,'refresh');
        }
     }      
 }      

 function download_documents()
 {
  $p1=$this->uri->segment(3);
  $p2=$this->uri->segment(4);
  $p3=$this->uri->segment(5);
  $full_path = $p1."/".$p2."/".$p3;
  echo $full_path." ".base_url().$full_path;

  $this->load->helper('file');
  $this->load->helper('download');

  ob_clean();
  $data = file_get_contents(base_url().$full_path);
  $name = 'document.pdf';
  force_download($name,$data);

 }

 function ajax_call1()
 {
   if ($_POST) 
   {
        $role = $_POST['table1']; //obtain group id
        
        if($role == "level1")
        {
          echo'<div class="form-group" id="year">
                                               <label for="examplerole">Project</label>
                                               <select class="form-control" name="project" value="" required>
                                                 <option value="" >Select</option>
                                                 <option value="NWSM">NWSM</option>
                                                 <option value="ACIS">ACIS</option>
                                                 <option value="IBM">IBM</option>
                                               </select>
                                           </div>' ;
        }
        else if($role == "level2")
        {
            echo'<div class="form-group" id="year">
                                               <label for="examplerole">Project</label>
                                               <select class="form-control" name="project" value="" required>
                                                 <option value="" >Select</option>
                                                 <option value="NWSM">NWSM</option>
                                                 <option value="ACIS">ACIS</option>
                                                 <option value="IBM">IBM</option>
                                               </select>
                                           </div>' ;

        }
        else if($role == "admin")
        {
            echo'<div class="form-group" id="year">
                                               
                                           </div>' ;
        }
        else
        {
            echo'<div class="form-group" id="year">
                                               
                                           </div>' ;
        }


    }

 }
      

function clear_uploads() //clears all the excel sheet uploaded
{
  //deletes all uploaded excel files
     $this->load->helper('file');
     //delete_files('./uploads/');
     $files = glob('./uploads/*.xlsx');
     foreach($files as $file)
     { 
       if(is_file($file))
        unlink($file);
     }
}

   function search_qlip_uploads()
   {
     
       $start_date=$this->input->post('start_date');
       $end_date=$this->input->post('end_date');
       $filter_by=$this->input->post('filter_by');
       $keyword=$this->input->post('keyword');
       
          $data['filter_by']=$filter_by ;
          $data['start_date']=$start_date ;
          $data['end_date']=$end_date ;
          $data['keyword']=$keyword ;

          $data['qlip_upload_data'] = $this->Qlip_model->search_qlip_uploads();

          $data['approved_count']=$this->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->get_declined_count("dummy","l2") ;
          /*$data['authorized_count']=$this->get_authorized_count("dummy","l2") ;
          $data['pending_authorized_count']=$this->get_pending_authorized_count("dummy","l2") ;*/
          
          $data['title'] = 'Qlip Upload Loan';
          $data['content'] = 'view_qlip_uploads';
          $this->load->view('primera_template',$data);
  }
  
  function push_to_t24()
  {
  $customer_id = $this->uri->segment(3);
  $push_id = $this->uri->segment(4);
  //get last qlip_id and increment by 1
  $qlip_id = 0 ;
  /*$result1 = mysql_query("select * from qlip_id order by id desc limit 1");
  while($row = mysql_fetch_array($result1))
  {
      $qlip_id = $row['id_series'] + 1 ;
      $id = $row['id'];
      //update with the new qlip id
      mysql_query("update qlip_id set id_series = '$qlip_id' where id = '$id'");
    
  }*/
  

  $result = mysql_query("select * from lasg_staff_info where lsid='$customer_id'");
  while($row = mysql_fetch_array($result))
  {

     //emp_status exchange
    if(strtolower($row['emp_status'])==strtolower('full time employment'))
    $row['emp_status']= 1 ;
    else if(strtolower($row['emp_status'])==strtolower('part time employment'))
    $row['emp_status']= 2 ;
    else if(strtolower($row['emp_status'])==strtolower('pensioner'))
    $row['emp_status']= 3 ;
    else if(strtolower($row['emp_status'])==strtolower('casual'))
    $row['emp_status']= 4 ;
    else if(strtolower($row['emp_status'])==strtolower('unemployed'))
    $row['emp_status']= 5 ;
    else if(strtolower($row['emp_status'])==strtolower('student'))
    $row['emp_status']= 6 ;
    else if(strtolower($row['emp_status'])==strtolower('self employed'))
    $row['emp_status']= 7 ;

    //means_of_id exchange
    if(strtolower($row['means_of_id'])==strtolower('Social security card'))
    $row['means_of_id']= 1 ;
    else if(strtolower($row['means_of_id'])==strtolower('PPS number'))
    $row['means_of_id']= 2 ;
    else if(strtolower($row['means_of_id'])==strtolower('Passport'))
    $row['means_of_id']= 3 ;
    else if(strtolower($row['means_of_id'])==strtolower('Drivers licence'))
    $row['means_of_id']= 4 ;
    else if(strtolower($row['means_of_id'])==strtolower('Employees card'))
    $row['means_of_id']= 5 ;
    else if(strtolower($row['means_of_id'])==strtolower('Birth certificate'))
    $row['means_of_id']= 6 ;
    else if(strtolower($row['means_of_id'])==strtolower('Known to officer'))
    $row['means_of_id']= 7 ;
    else if(strtolower($row['means_of_id'])==strtolower('Utility bill'))
    $row['means_of_id']= 8 ;

    
    //level_of_edu exchange
    if(strtolower($row['level_of_edu'])==strtolower('primary'))
    $row['level_of_edu']= 1 ;
    else if(strtolower($row['level_of_edu'])==strtolower('secondary'))
    $row['level_of_edu']= 2 ;
    else if(strtolower($row['level_of_edu'])==strtolower('tertiary'))
    $row['level_of_edu']= 3 ;
    else if(strtolower($row['level_of_edu'])==strtolower('Licenced Practioner'))
    $row['level_of_edu']= 4 ;
    else if(strtolower($row['level_of_edu'])==strtolower('Post Graduate'))
    $row['level_of_edu']= 5 ;
    else if(strtolower($row['level_of_edu'])==strtolower('None'))
    $row['level_of_edu']= 10 ;

    //relationship exchange
    if(strtolower($row['relationship'])==strtolower('Husband'))
    $row['relationship']= 1 ;
    else if(strtolower($row['relationship'])==strtolower('Partner'))
    $row['relationship']= 2 ;
    else if(strtolower($row['relationship'])==strtolower('Father'))
    $row['relationship']= 3 ;
    else if(strtolower($row['relationship'])==strtolower('Mother'))
    $row['relationship']= 4 ;
    else if(strtolower($row['relationship'])==strtolower('Child'))
    $row['relationship']= 5 ;
    else if(strtolower($row['relationship'])==strtolower('Cousin'))
    $row['relationship']= 6 ;
    else if(strtolower($row['relationship'])==strtolower('Brother'))
    $row['relationship']= 7 ;
    else if(strtolower($row['relationship'])==strtolower('Nephew'))
    $row['relationship']= 8 ;
    else if(strtolower($row['relationship'])==strtolower('Niece'))
    $row['relationship']= 9 ;
    else if(strtolower($row['relationship'])==strtolower('Wife'))
    $row['relationship']= 10 ;
    else if(strtolower($row['relationship'])==strtolower('Uncle'))
    $row['relationship']= 11 ;
    else if(strtolower($row['relationship'])==strtolower('Aunt'))
    $row['relationship']= 12 ;
    else if(strtolower($row['relationship'])==strtolower('Sister'))
    $row['relationship']= 13 ;
    else if(strtolower($row['relationship'])==strtolower('Grand Child'))
    $row['relationship']= 14 ;
    else if(strtolower($row['relationship'])==strtolower('Guard'))
    $row['relationship']= 15 ;
    else if(strtolower($row['relationship'])==strtolower('Business'))
    $row['relationship']= 16 ;
    else if(strtolower($row['relationship'])==strtolower('Business Manager'))
    $row['relationship']= 17 ;
    else if(strtolower($row['relationship'])==strtolower('Guarantor'))
    $row['relationship']= 18 ;
    else if(strtolower($row['relationship'])==strtolower('Borrower'))
    $row['relationship']= 19 ;
    else if(strtolower($row['relationship'])==strtolower('Club'))
    $row['relationship']= 20 ;
    else if(strtolower($row['relationship'])==strtolower('Member of the Club'))
    $row['relationship']= 21 ;
    else if(strtolower($row['relationship'])==strtolower('Entity'))
    $row['relationship']= 22 ;
    else if(strtolower($row['relationship'])==strtolower('Trustee of the Entity'))
    $row['relationship']= 23 ;
    else if(strtolower($row['relationship'])==strtolower('Member'))
    $row['relationship']= 24 ;
    else if(strtolower($row['relationship'])==strtolower('Group'))
    $row['relationship']= 25 ;
    else if(strtolower($row['relationship'])==strtolower('Employee'))
    $row['relationship']= 99 ;

    $today=date('Y-m-d');
    $age=$today-$row['dob'];
    $fullname = $row['sname']." ".$row['mname']." ".$row['fname'];

    $datat24 = array
    (
      $row['qlip_id'],//$qlip_id,
      strtoupper($row['title']),
      $row['sname'].' '.$row['mname'].' '.$row['fname'],
      $row['sname'].' '.$row['mname'].' '.$row['fname'],
      $row['sname'].' '.$row['mname'].' '.$row['fname'],
      strtoupper($row['marital_status']),
      'NA',
      str_replace("-","",$row['dob']),
      $age,
      substr($row['sname'],0,1),
      $this->genRandomString(), //$this->genRandomString(), MNEMONIC
      '1000',
      '4005',//'SECTOR'
      //'',//'ACCOUNT OFFICER',
      str_replace("-","",$today), //customer opening date
      strtoupper($row['gender']),
      //'',//'RESIDENT YN',
      //'',//'NATIONALITY',
      //'',//'RESIDENCE',
      //'',//'LANGUAGE',
      //$row['home_addr'], //Address
      $row['application_type'],
      str_replace(","," ",$row['home_addr']), //GB Home Address str_replace(","," ",$row['home_addr']),
      $row['lga'],//:SUBURB.TOWN:=":CUS.TOWN  
      'NA', //PROVINCE.STATE:=":CUS.ST
      '234',// postal Code
      //'CURRENT ADDR',
      //'', //date addr occupied
      //'',//Period at current addr
      //'',//home phone
      //'',//Work phone
      $row['mobile_number'],//Mobile phone
      $row['email'],
      //'',//Fax No
      //Postal Address details
      //'',//correspondent name
      //'',//postal code
      //Employment details
      $row['emp_status'],
      $row['level_of_edu'],
      //'',//occupation 1
      $row['current_emp'],
      str_replace(","," ",$row['current_emp_addr']), //str_replace(","," ",$row['current_emp_addr']),
      'NA',//town 1
      'N/A',//Employer state on T24
      $row['official_email'],
      $row['existing_loan'],//do you have an existing loan
      $row['monthly_salary'],
      $row['nok_name'],
      $row['nok_phone'],
      $row['relationship'],
      '99999', //rel.cust
      'NA',//Occupation
      str_replace(","," ",$row['nok_addr']), //str_replace(","," ",$row['nok_addr']),
      'NA',//NExt of kin lga
      'NA',//NExt of kin City
      $row['account_number'],
      $row['bank_name'],
      $row['means_of_id'],
      $row['bank_account'],
      $row['oracle_number']
      //$row['dependents'],//No of Dependents
      //$row['existing_loan_repayment_amount'],//existing loan repayment amount
      //'',//Debt Income
      //$row['monthly_expense'],
      //$row['pay_day'],
      //Next of Kin info
      //'',//Related Customer
      //'',//Occupation
      //$row['nok_employer_name'],
      //$row['relationship'],
      //'',//Town
      //'',//Country
      //'',//State
      //Other accounts
      //'99999', //Related customer
      //$row['nok_employer_name'],
      //$row['nok_addr'],
      //'', //Next of Kin Town = SP.EMP.SUB
      //'', //Next of Kin Country = SP.EMP.Country
      //'', //Next state
      //$row['bank_branch'],
      //'',//Signatory Code Name
      //'',
      //'',//pport expiry date
      //'',//account classification
      //''
      ); //end array

      //Concatenate every item in the above array and seperate with comma
      $t24_string='';
    foreach($datat24 as $val)
    {
      $t24_string.=$val.',';
    }

    $t24_string=rtrim($t24_string,",");
    $t24_string=ltrim($t24_string,",");
    $t24_string.=PHP_EOL;
    $file = 'bnk'.date('ymdhis');
    $fp = fopen('./asset/ofs/'.$file.'.csv','w+');
    //$fp = fopen('http://41.76.193.103/MCBPack/t24test/bnk/bnk.run/MIGR.BP'.$file.'.csv','w+');
    fwrite($fp,$t24_string);
    fclose($fp); 

    /*$ftp_server = "41.76.193.103";
  $ftp_username  = "apptest";
  $ftp_password   =  "123456@Pcl";
  $connection = ftp_connect($ftp_server) or die("could not connect to $ftp_server");*/
  
  
  $ftp_server = "41.76.193.103";
  $ftp_username  = "apptest";
  $ftp_password   =  "123456@Pcl";
  $connection = ftp_connect($ftp_server); // or die("could not connect to $ftp_server");

  if(@$connection)
  {
    
      if(@ftp_login($connection, $ftp_username, $ftp_password))
      { 
        //turn passive mode on
        ftp_pasv($connection, true);

        if(ftp_put($connection, $file.'.csv', './asset/ofs/'.$file.'.csv', FTP_BINARY))
        {
          rename("./asset/ofs/".$file.".csv", "./asset/archive/".$file.".csv"); //move to archive
          $date_pushed=date('Y-m-d');
          mysql_query("update push_24_status set response='Successfully uploaded to T24 server',status='success',date_pushed='$date_pushed' where pid='$push_id'");
          $this->session->set_flashdata('message', 'upload_success');//invalid oracle number
          redirect('qlip_controller/view_t24push_status/','refresh');
        }
       else
       {
           unlink("./asset/ofs/".$file.".csv"); //delete from ofs directory
           mysql_query("update push_24_status set response='Couldnt upload to T24 server',status='pending' where pid='$push_id' ");

          $this->session->set_flashdata('message', 'upload_failed');//invalid oracle number
          redirect('qlip_controller/view_t24push_status/','refresh');
       }
     } 
    else 
    { 
        unlink("./asset/ofs/".$file.".csv"); //delete from ofs directory
        mysql_query("update push_24_status set response='Couldnt login to T24 server',status='pending' where pid='$push_id'");

        $this->session->set_flashdata('message', 'login_failed');//invalid oracle number
        redirect('qlip_controller/view_t24push_status/','refresh');
    }
    ftp_close($connection);
 
 }//end outmost if for connection
 else
 {
    unlink("./asset/ofs/".$file.".csv"); //delete from ofs directory
    mysql_query("update push_24_status set response='Couldnt connect to T24 server',status='pending' where pid='$push_id'");

    $this->session->set_flashdata('message', 'connect_failed');//invalid oracle number
    redirect('qlip_controller/view_t24push_status/','refresh');
 }


  }//end while


}//end function

function genRandomString() {
 $character_set_array = array();
    $character_set_array[] = array('count' => 3, 'characters' => 'abcdef');
    $character_set_array[] = array('count' => 1, 'characters' => '0123456789');
    $temp_array = array();
    foreach ($character_set_array as $character_set) {
        for ($i = 0; $i < 3; $i++) {
            $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
        }
    }
// shuffle($temp_array);
    return strtoupper(implode('', $temp_array));
}   

function unlock_view_mode() //unlock view mode for primera
{
    $uname = $this->session->userdata('uname');
    //update view_mode table
    $sql = "update lasg_staff_info set view_mode='off' where user_viewing='$uname'";
    $query = $this->db->query($sql);

    $this->session->set_flashdata('message', 'view_mode_off');
    redirect('qlip_controller/view_loan_primera','refresh');
}

function ajax_call_category()
 {
   if ($_POST) 
   {
        $category = $_POST['category']; //obtain means of id

        if($category == "hardware")
        {
            echo '<div class="form-group">
                                               <label for="examplerole">Type<strong style="color:red"> *</strong></label>
                                               <select class="form-control" name="asset_type" value="" required>
                                                 <option value="" >-Select-</option>
                                                 <option value="Laptop" >Laptop</option>
                                                 <option value="Monitor">Monitor</option>
                                                 <option value="CPU" >CPU</option>
                                                 <option value="Switches">Switches</option>
                                                 <option value="Router" >Router</option>
                                                 <option value="Printer">Printer</option>
                                                 <option value="Battery" >Battery</option>
                                                 <option value="Power_pack">Power pack</option>
                                                 <option value="Mouse" >Mouse</option>
                                                 <option value="KYC Kit">KYC kit</option>
                                                 <option value="Others" >Others</option>
                                               </select>
                                      </div>';
        }
        else if($category == "software")
        {
            echo '<div class="form-group">
                                               <label for="examplerole">Type<strong style="color:red"> *</strong></label>
                                               <select class="form-control" name="asset_type" value="" required>
                                                 <option value="" >-Select-</option>
                                                 <option value="Operating system" >Operating system</option>
                                                 <option value="Application software">Application software</option>
                                                 
                                               </select>
                                      </div>';
           
        }
        
    }

 }

 function get_chart_data()
 {
   
   $sql="select * from lasg_staff_info";
   $query=$this->db->query($sql);
   $arr = $query->result_array();
   //$json_arr= json_encode($arr);
   return $arr ;

   /*$data = array(
    "cols" => array(
        array("lsid"=>"", "label"=>"Topping", "pattern"=>"", "type"=>"string"),
        array("id"=>"", "label"=>"Slices", "pattern"=>"", "type"=>"number")
    ),
    "rows" => $arr
);

   //$string = file_get_contents($json_arr);
   echo json_encode($data);*/
   
 }
      
      
   
}//end controller class
   
   
   
   ?>   