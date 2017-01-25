<?php
class MAdmins extends CI_Model
{
    public function __construct()
	{
    parent::__construct();
		$this->load->database();// no need, guess hava already done that in auto load
	}
    
    function verifyUser($u,$pw)
    {
      /*select id from ms_admins where username = '$u',password = '$pw' limit 1--an alternative way to do this which is my way is*/
      /*$this->db->select('id');
      $this->db->where('username',$u);
      $this->db->where('password', $pw); //$this->db->where('password', md5($pw));
      $this->db->where('status', 'active');
      $this->db->limit(1);
      $Q = $this->db->get('ms_admins');*/

      $this->db->select('id');
      $Q = $this->db->get_where('ms_admins', array('username'=>$u,'password'=>$pw));
      
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


  public function get_data($id = 0)
  {
    if ($id === 0)
    {
      $query = $this->db->get('ms_admins'); //select all members
          return $query->result_array(); // return an array of rows containing all members details
    }
    
    $query = $this->db->get_where('ms_admins', array('id' => $id)); //get a member detail  whose column id = $id
    return $query->row_array();
  }

  public function set_data($id = 0, $save) 
  {
    if ($id === 0) 
    {
      return $this->db->insert('ms_admins', $save);
    }
    else
    {
      $this->db->where('id', $id);
      return $this->db->update('ms_admins', $save);
    }
  }

  public function delete_data($id)
  {
    
    $this->db->where('id',$id);
     $this->db->delete('pages'); 
  }


}//end class



?>