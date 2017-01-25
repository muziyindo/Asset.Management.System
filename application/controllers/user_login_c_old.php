<?php

class User_login_c extends CI_Controller 
{

   public function __construct()
   {
       parent::__construct();

       //$this->load->library('encrypt');
       $this->load->library('session');
       $this->load->model('Qlip_model');
        $this->load->library('form_validation');
   }

  public function index()
  {
      
      $this->load->library('encrypt');
     if ($this->input->post('uname')) //check if user entered a username
     {
       $uname = $this->input->post('uname');
       $pword = $this->input->post('pword');
       $row = $this->Qlip_model->verifyUser($uname,$pword);// pass username and password to MAdmins model for verification

       if (count($row))
       {
            
        $pword_db=$this->encrypt->decode($row['pword']);//decode password gotten from db and compare with just-entered password
        if($pword_db==$pword)
        {
           if($row['role']=="level1")
           {
             $this->session->set_userdata('userid', $row['uid']);
             $this->session->set_userdata('uname', $row['uname']);
             $this->session->set_userdata('fname', $row['fname']);
             $this->session->set_userdata('lname', $row['lname']);
             $this->session->set_userdata('role', $row['role']);
             redirect('qlip_controller/open_level1_section/'.$uname,'refresh');
              
           }
           else if($row['role']=="level2")
           {
            $this->session->set_userdata('userid', $row['uid']);
             $this->session->set_userdata('uname', $row['uname']);
             $this->session->set_userdata('fname', $row['fname']);
             $this->session->set_userdata('lname', $row['lname']);
             $this->session->set_userdata('role', $row['role']);
             redirect('qlip_controller/open_level2_section','refresh');
           }
           else if($row['role']=="level3")
           {
            $this->session->set_userdata('userid', $row['uid']);
             $this->session->set_userdata('uname', $row['uname']);
             $this->session->set_userdata('fname', $row['fname']);
             $this->session->set_userdata('lname', $row['lname']);
             $this->session->set_userdata('role', $row['role']);
             redirect('qlip_controller/open_primera_section','refresh');
           }
           else if($row['role']=="admin")
           {
             $this->session->set_userdata('userid', $row['uid']);
             $this->session->set_userdata('uname', $row['uname']);
             $this->session->set_userdata('fname', $row['fname']);
             $this->session->set_userdata('lname', $row['lname']);
             $this->session->set_userdata('role', $row['role']);
             redirect('qlip_controller/open_admin_section','refresh');

           }
         }
        else
        {
           $this->session->set_flashdata('message', 'incorrect_data');
           redirect('user_login_c/show_login','refresh');
        }
      }


      else
      {
         $this->session->set_flashdata('message', 'incorrect_data');
         redirect('user_login_c/show_login','refresh');
      }

    }

    else
    {
       $this->session->set_flashdata('message', 'no_data');
      redirect('user_login_c/show_login','refresh');
    }

    

    
 }

 function show_login()
 {
     $data['title'] = 'User login';
     $this->load->view('login',$data);
 }

 
}//end controller class



?>