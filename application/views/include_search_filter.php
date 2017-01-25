<?php

function search_filter($uname)
{
	if(!empty($uname))
    {
	     $filter_by = $this->input->post('filter_by');
         $start_date = $this->input->post('start_date');
         $end_date = $this->input->post('end_date');
         $keyword = $this->input->post('keyword');
         
         if(empty($filter_by) && empty($start_date) && empty($end_date) && empty($keyword))
         {
             $sql= "SELECT * FROM lasg_staff_info where posted_by='$uname'";
             $query=$this->db->query($sql);
             return $query->result_array();
         }

    }
}

?>