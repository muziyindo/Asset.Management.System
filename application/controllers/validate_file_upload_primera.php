<?php

class Validate_file_upload_primera extends CI_Controller 
{

   public function __construct()
   {
       parent::__construct();
       $this->load->library('form_validation');
       $this->load->library('../controllers/qlip_controller');
       $this->load->model('Qlip_model');
   }

   function upload_files($id)
 {   

     $this->form_validation->set_rules('year', 'Year', 'required');
     $this->form_validation->set_rules('sum_amount', 'Sum Amount', 'required');
     $this->form_validation->set_rules('month', 'Month', 'required');
     //$this->form_validation->set_rules('myuploadFile', 'Upload file', 'required');
     if (empty($_FILES['myuploadFile']['name']))
    {
        $this->form_validation->set_rules('myuploadFile', 'Document', 'required');
    }
      if ($this->form_validation->run() === FALSE)
     {
      $data['approved_count']=$this->qlip_controller->get_approved_count("dummy","l2") ;
      $data['pending_count']=$this->qlip_controller->get_pending_count("dummy","l2") ;
      $data['declined_count']=$this->qlip_controller->get_declined_count("dummy","l2") ;
      
     $data['qlip_upload_data'] =$this->qlip_controller->Qlip_model->get_data('qlip_upload_data_each',$id);
     $data['title'] = 'Upload expected repayment';
     $data['content'] = 'file_upload_primera';
     $this->load->view('primera_template',$data);
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
        
        $repayment_month=$this->input->post('repayment_month');
        $repayment_year=$this->input->post('repayment_year');
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
             //$this->insert_from_uploaded($path,$filename1,$month_year,$sum_amount,$narration);
             if(($repayment_month==$month) && ($repayment_year!=$year))
             {
                 $data['approved_count']=$this->qlip_controller->get_approved_count("dummy","l2") ;
                 $data['pending_count']=$this->qlip_controller->get_pending_count("dummy","l2") ;
                 $data['declined_count']=$this->qlip_controller->get_declined_count("dummy","l2") ;
                 $data['qlip_upload_data'] = $this->qlip_controller->Qlip_model->get_data('qlip_upload_data_each',$id);
                 $data['title'] = 'Upload expected repayment';
                  $data['error1'] = 'The expected repayment year is not the same as the repayment year submitted by qlip ';
                 $data['content'] = 'file_upload_primera';
                 $this->load->view('primera_template',$data);
             }
             else if(($repayment_month!=$month) && ($repayment_year==$year))
             {
                 $data['approved_count']=$this->qlip_controller->get_approved_count("dummy","l2") ;
                 $data['pending_count']=$this->qlip_controller->get_pending_count("dummy","l2") ;
                 $data['declined_count']=$this->qlip_controller->get_declined_count("dummy","l2") ;
                 $data['qlip_upload_data'] = $this->qlip_controller->Qlip_model->get_data('qlip_upload_data_each',$id);
                 $data['title'] = 'Upload expected repayment';
                  $data['error1'] = 'The expected repayment month is not the same as the repayment month submitted by qlip ';
                 $data['content'] = 'file_upload_primera';
                 $this->load->view('primera_template',$data);
             }
             else if(($repayment_month!=$month) && ($repayment_year!=$year))
             {
                  $data['approved_count']=$this->qlip_controller->get_approved_count("dummy","l2") ;
                 $data['pending_count']=$this->qlip_controller->get_pending_count("dummy","l2") ;
                 $data['declined_count']=$this->qlip_controller->get_declined_count("dummy","l2") ;
                 $data['qlip_upload_data'] = $this->qlip_controller->Qlip_model->get_data('qlip_upload_data_each',$id);
                 $data['title'] = 'Upload expected repayment';
                  $data['error1'] = 'The expected repayment month and year is not the same as the repayment month and year submitted by qlip ';
                 $data['content'] = 'file_upload_primera';
                 $this->load->view('primera_template',$data);
             }
             else if(($repayment_month==$month) && ($repayment_year==$year))
             {
                $this->insert_from_uploaded($path,$filename1,$month_year,$sum_amount,$id);
             }
       }
       else
       {
          $data['approved_count']=$this->qlip_controller->get_approved_count("dummy","l2") ;
          $data['pending_count']=$this->qlip_controller->get_pending_count("dummy","l2") ;
          $data['declined_count']=$this->qlip_controller->get_declined_count("dummy","l2") ;
          $data['qlip_upload_data'] = $this->qlip_controller->Qlip_model->get_data('qlip_upload_data_each',$id);
          $data['title'] = 'Upload expected repayment';
           $data['error1'] = 'The Credit sum entered ('.$sum_amount.') does not equal the actual sum('.$sum_credit.') on the submitted sheet';
          $data['content'] = 'file_upload_primera';
          $this->load->view('primera_template',$data);
          
       }
       
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
          $credit=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          $credit_sum=$credit_sum+$credit ;

    }

    return $credit_sum ;
} 

 function insert_from_uploaded($path,$filename1,$month_year,$sum_amount,$id)
 {

     $this->load->library('PHPExcel/Classes/PHPExcel');
     $inputFileType = PHPExcel_IOFactory::identify($path);
     $objReader1     = PHPExcel_IOFactory::createReader($inputFileType);
     $objPHPExcel1   = $objReader1->load($path);
     $sheetList      = $objReader1->listWorksheetNames($path); 
     foreach ($sheetList as $sheetName)
     {
        $currentObjectName  = $objPHPExcel1->setActiveSheetIndexByName($sheetName);
        $result=$this->insertintodb($currentObjectName,$filename1,$month_year,$sum_amount,$id);
     }
  }

  function insertintodb($objWorksheet1,$filename1,$month_year,$sum_amount,$id)
  { 
    $entry_date=date('Y-m-d');
    $this->load->library('form_validation');
    $highestRow1 = $objWorksheet1->getHighestRow(); // e.g. 10
    $row1=1; // row in which customers description starts in a work sheet
    $row_start= $row1+1;

     $error_report=0;
     //$fileid=$this->Qlip_model->get_fileid_uploaded($filename1);
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

    echo '<div class="container">';
    echo '<p><div class="panel panel-primary">';
    echo '<div class="panel-heading">File Upload Report(s)</div>';
    echo '<div class="panel-body">';
    
    for ($row_start; $row_start <= $highestRow1; $row_start++) //$highestRow
    {
          $row1=$row_start;
          $emp_no=$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue():'';
          $emp_name=$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue():'';
          //$ministry_name=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          $credit_primera=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          //$element_name=$objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() : ''; 
          
          $result4 = mysql_query("SELECT * from lasg_staff_info where oracle_number=$emp_no and status='approved'");
          if(mysql_num_rows($result4)>0)
          {
            $result_bm = mysql_query("SELECT * from deduction_report where oracle_number='$emp_no' and file_id = '$id' order by rid desc limit 1");
            if(mysql_num_rows($result_bm)>0)
            {
               while($row=mysql_fetch_array($result_bm))
               {
                 $file_id=$row['file_id'];
                 $oracle_number=$row['oracle_number'];
                 $employee_name=$row['employee_name'];
                 $month=$row['month'];
                 $year=$row['year'];
                 $credit_qlip=$row['credit'];
                 $balance=$row['balance'];
                 $difference = ($credit_primera-$credit_qlip) ;
                 
                 if($difference==0){
                 $data = array(
                 'file_id' => $id,
                 'oracle_number' => $emp_no,
                 'employee_name_primera' => $emp_name,
                 'employee_name_qlip' => $employee_name,
                 'month' => $month,
                 'year' => $year,
                 'credit_primera' => $credit_primera,
                 'credit_qlip' => $credit_qlip,
                 'difference' => ($credit_primera-$credit_qlip),
                 'balance' => $balance,
                 'matched' => 'matched',
                 'comment' => 'found on both sheet',
                 'recon_date' => date('Y-m-d')
                  );
                 $rs=$this->db->insert('reconciliation', $data);
                 if(!$rs){
                  echo ("You tried uploading duplicate entry<br>");
                  $error_report=1 ; }
                }
                else{
                    $data = array(
                 'file_id' => $id,
                 'oracle_number' => $emp_no,
                 'employee_name_primera' => $emp_name,
                 'employee_name_qlip' => $employee_name,
                 'month' => $month,
                 'year' => $year,
                 'credit_primera' => $credit_primera,
                 'credit_qlip' => $credit_qlip,
                 'difference' => ($credit_primera-$credit_qlip),
                 'balance' => $balance,
                 'matched' => 'not-matched',
                 'comment' => 'found on both sheet',
                 'recon_date' => date('Y-m-d')
                  );
                 $rs=$this->db->insert('reconciliation', $data);
                 if(!$rs){
                  echo ("You tried uploading duplicate entry<br>");
                  $error_report=1 ; }
                }
                
                
               }

            }
            else if(mysql_num_rows($result_bm)==0)
            {
               $data = array(
                 'file_id' => $id,
                 'oracle_number' => $emp_no,
                 'employee_name_primera' => $emp_name,
                 'employee_name_qlip' => 'N/F',
                 'month' => $month_year,
                 'year' => $month_year,
                 'credit_primera' => $credit_primera,
                 'credit_qlip' => 'N/F',
                 'difference' => 'N/F',
                 'balance' => 'N/F',
                 'matched' => 'not-matched',
                 'comment' => 'record found on primera sheet only',
                 'recon_date' => date('Y-m-d')
                  );
                 $rs=$this->db->insert('reconciliation', $data);
                 if(!$rs){
                  echo ("You tried uploading duplicate entry<br>");
                  $error_report=1 ; }
 
            }
               
             

          }
        else
        {
           echo '<center><strong>Error!</strong><span class="text-danger">Invalid oracle_number'.$emp_no.'</span></center>';
           $error_report=1 ;
           $rs2 = mysql_query ("delete from reconciliation where file_id='$id'") ;
        }
          
        
        
   }//end for loop


   if($error_report==1)
   {
       //echo '<a href="'.site_url().'/qlip_controller/upload_files_view" class="btn btn-primary">Return to deduction report upload page</a>';

       echo '<center><strong>Notification!</strong><span class="bg-info">All records have been bounced back, kindly rectify and re-upload</span></center>';
       echo '<a href="'.site_url().'/qlip_controller/file_upload_primera/'.$id.'/edit" class="btn btn-primary">Return to repayment upload page</a>';
   }
   else
   {
      $highestRow1=($highestRow1-1);
      echo '<center><strong>Notification!</strong><span class="bg-success">All '.$highestRow1.' record(S) were successfully uploaded</span></center>';
      //echo '<a href="'.site_url().'/qlip_controller/get_single_recon/'.$id.'" class="btn btn-primary">View reconciliation Report</a>';
      $rs3 = mysql_query ("update uploaded_files set recon='yes' where file_id='$id'") ;

      //get and insert record on qlip sheet not on primera sheet
      $result81 = mysql_query("SELECT * from deduction_report where file_id = '$id' ");
      if(mysql_num_rows($result81)>0)
      {
        while($row=mysql_fetch_array($result81))
        {
          $file_id1=$row['file_id'];
          $oracle_number_qlip=$row['oracle_number'];
           $month=$row['month'];
           $year=$row['year'];
           $credit_qlip=$row['credit'];
          $result11 = mysql_query("SELECT * from reconciliation where file_id = '$file_id1' and oracle_number='$oracle_number_qlip' ");
          if(mysql_num_rows($result11)==0)
          {
              $data = array(
              'file_id' => $file_id,
              'oracle_number' => $oracle_number_qlip,
              'employee_name_primera' => 'N/F',
              'employee_name_qlip' => $employee_name,
              'month' => $month,
              'year' => $year,
              'credit_primera' => 'N/F',
              'credit_qlip' => $credit_qlip,
              'difference' => 'N/F',
              'balance' => 'N/F',
              'matched' => 'not-matched',
              'comment' => 'record found on qlip sheet only',
              'recon_date' => date('Y-m-d')
               );
               $rs=$this->db->insert('reconciliation', $data);
               if(!$rs){
                echo ("You tried uploading duplicate entry1<br>");
                $error_report=1 ; }
          }
          
        }
      }
      $mcount =$this->qlip_controller->Qlip_model->get_matched_count($id);
      $ucount =$this->qlip_controller->Qlip_model->get_unmatched_count($id);
      $pcount=$this->qlip_controller->Qlip_model->get_primera_count($id);//get count on primera sheet
      $qcount=$this->qlip_controller->Qlip_model->get_qlip_count($id);//get count on qlip sheet
       echo '<a href="#" class="btn btn-default" role="button">Matched = '.$mcount['count(1)'].' </a>';
       echo '<a href="#" class="btn btn-default" role="button">Not-Matched = '.$ucount['count(1)'].' </a>';
       echo '<a href="#" class="btn btn-default" role="button">On Primera sheet only = '.$pcount['count(1)'].' </a>';
       echo '<a href="#" class="btn btn-default" role="button">On Qlip sheet only = '.$qcount['count(1)'].' </a><br><br>';
      echo '<a href="'.site_url().'/qlip_controller/get_single_recon/'.$id.'" class="btn btn-primary">View reconciliation Report</a>';
   }

     
 
   echo '</div>'; //close panel body div
   echo '</div></p>'; //close panel div
   echo '</container>';
   echo '</body>';
   echo '</html>';
}//end function insertintodb




}//end controller class



?>