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
          //obtain user company/organisation
          //$company = $row['company_type'];


          /*User role/level check for QLip users*/
           
           if($row['role']=="level1" || $row['role']=="level2")
           {
             $this->session->set_userdata('userid', $row['uid']);
             $this->session->set_userdata('uname', $row['uname']);
             $this->session->set_userdata('fname', $row['fname']);
             $this->session->set_userdata('lname', $row['lname']);
             $this->session->set_userdata('role', $row['role']);
             redirect('qlip_controller/open_level1_section/'.$uname,'refresh');
              
           }
           /*else if($row['role']=="level2")
           {
            $this->session->set_userdata('userid', $row['uid']);
             $this->session->set_userdata('uname', $row['uname']);
             $this->session->set_userdata('fname', $row['fname']);
             $this->session->set_userdata('lname', $row['lname']);
             $this->session->set_userdata('role', $row['role']);
             redirect('qlip_controller/open_level2_section','refresh');
           }*/
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

 function pickt24_updateqlip()
 {
   //echo rand() . "\n";

      $file = "bnk160129120245";
   
      $ftp_server = "41.76.193.103";
      $ftp_username  = "QLIPTEST";
      $ftp_password   =  "123456@Pcl";
      $connection = ftp_connect($ftp_server); // or die("could not connect to $ftp_server");

      if(@$connection)
      {
          if(@ftp_login($connection, $ftp_username, $ftp_password))
          { 
              //turn passive mode on
              ftp_pasv($connection, true);
              //if (ftp_get($connection, './asset/t24_pend/'.$file.'.csv', 'qlip.csv', FTP_BINARY))
              if(ftp_get($connection, './asset/t24_pend/'.$file.'.csv', 'bnk160129120245.csv', FTP_BINARY))
              {

                  $path = '/asset/t24_pend/'.$file.'.csv' ;
                  //$this->insert_from_uploaded_t24($path);
                  echo "success";

                  /*rename("./asset/ofs/".$file.".csv", "./asset/archive/".$file.".csv"); //move to archive
                  $date_pushed=date('Y-m-d');
                  mysql_query("update push_24_status set response='Successfully uploaded to T24 server',status='success',date_pushed='$date_pushed' where pid='$push_id'");
                  $this->session->set_flashdata('message', 'upload_success');//invalid oracle number
                  redirect('qlip_controller/view_t24push_status/','refresh'); */
              }
              else
              {
                  echo "failed to pick file from t24 folder".rand() ;
                  /*unlink("./asset/ofs/".$file.".csv"); //delete from ofs directory
                  mysql_query("update push_24_status set response='Couldnt upload to T24 server',status='pending' where pid='$push_id' ");

                  $this->session->set_flashdata('message', 'upload_failed');//invalid oracle number
                  redirect('qlip_controller/view_t24push_status/','refresh');*/
              }
         } 
        else 
        { 
            /*unlink("./asset/ofs/".$file.".csv"); //delete from ofs directory
            mysql_query("update push_24_status set response='Couldnt login to T24 server',status='pending' where pid='$push_id'");

            $this->session->set_flashdata('message', 'login_failed');//invalid oracle number
            redirect('qlip_controller/view_t24push_status/','refresh');*/
        }
        ftp_close($connection);
    }//end outmost if for connection
    else
    {
          echo "could not connect".rand() ;
          /*unlink("./asset/ofs/".$file.".csv"); //delete from ofs directory
          mysql_query("update push_24_status set response='Couldnt connect to T24 server',status='pending' where pid='$push_id'");

          $this->session->set_flashdata('message', 'connect_failed');//invalid oracle number
          redirect('qlip_controller/view_t24push_status/','refresh');*/
    }
 }



}//end controller class



?>