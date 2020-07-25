<?php 
class admin_login_model extends CI_Model
{
    public function is_valid_login($username,$password)
   {

        $this->db->select('ADMINID,user_role');
        $this->db->from('administrators');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $result = $this->db->get()->row_array();
       
      

        return $result;        
            }    
    public function is_valid_password($id,$password){


        $this->db->select('ADMINID,user_role');
        $this->db->from('administrators');
        $this->db->where('ADMINID', $id);
        $this->db->where('password', md5($password));
        $result = $this->db->get()->row_array();
                
        return $result;        
            }        
     
            
}
?>