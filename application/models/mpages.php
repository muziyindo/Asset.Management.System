<?php
class Mpages extends CI_Model
{
    public function __construct()
	{
    parent::__construct();
		$this->load->database();// no need, guess hava already done that in auto load
	}
    
    


  public function get_data($id = 0)
  {
    if ($id === 0)
    {
      $query = $this->db->get('pages'); //select all members
          return $query->result_array(); // return an array of rows containing all members details
    }
    
    $query = $this->db->get_where('pages', array('id' => $id)); //get a member detail  whose column id = $id
    return $query->row_array();
  }

  public function set_data($id = 0, $save) 
  {
    if ($id === 0) 
    {
      return $this->db->insert('pages', $save);
    }
    else
    {
      $this->db->where('id', $id);
      return $this->db->update('pages', $save);
    }
  }

  public function delete_data($id)
  {
    
    $this->db->where('id',$id);
     $this->db->delete('pages'); 
  }

  public function fetch_site($id = 0)
  {
    if ($id === 0)
    {
      $query = $this->db->get('pages'); //select all members
          return $query->result_array(); // return an array of rows containing all members details
    }
    else if (!ctype_digit($id)) 
    {
      $query = $this->db->get_where('pages', array('page_name' => $id)); //get a member detail  whose column id = $id
      return $query->row_array();
    }
    else
    {
      $query = $this->db->get_where('pages', array('id' => $id)); //get a member detail  whose column id = $id
      return $query->row_array();
    }
    
   
  }

  function get_home_id() //this function gets the a value that determines the homepage
  {
      $this->db->order_by("id", "desc"); 
      $query = $this->db->get('home_page',1); //get a member detail  whose column id = $id
      return $query->row_array();

  }

 

  public function set_hp($save2) 
  {
      return $this->db->insert('home_page', $save2);
  }

  public function get_customize($id)// get customization settings to set it in page view
  {
      $query = $this->db->get_where('customize',array('id'=>$id));
      return $query->row_array();
  }

  public function add_customize($id,$save) //add new customization settings
  {
    $this->db->where('id', $id);
    return $this->db->update('customize', $save);
  }

}//end class



?>