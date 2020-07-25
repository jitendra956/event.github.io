<?php
class admin_panel_model extends CI_Model
{
########################### Event Model Start ###############################
    public function get_categories()
    {        
        $query = $this->db->query("SELECT * FROM `categories` WHERE category_parent = 0 AND CATID != 0  ORDER BY CATID DESC");
        $result = $query->result_array();
        return $result;                  
    }
    public function get_sub_categories($id)
    {        
        $query = $this->db->query("SELECT * FROM `categories` WHERE category_parent = '".$id."'  ORDER BY CATID DESC");
        $result = $query->result_array();
        return $result;                  
    }
    public function get_single_category($id)
    {        
        $query = $this->db->query("SELECT * FROM `categories` WHERE CATID = '".$id."'");
        $result = $query->row_array();
        return $result;                  
    }
    public function update_categories($id,$update_data)
    {           
        $this->db->where('CATID', $id);
        $this->db->update('categories', $update_data);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        } 
    }
    public function insert_category($data)
    {
        $query = $this->db->insert('categories',$data);
        if($query){

            return true;

        }else{

            return false;

        } 
    }
    public function insert_brand($data)
    {
        $query = $this->db->insert('brands',$data);
        if($query){

            return true;

        }else{

            return false;

        } 
    }
    public function insert_notifications($notificationsArray)
    {
        $result = $this->db->insert('notifications',$notificationsArray);
        if(@$result == false)
        {
            return false;
        }
        else
        {

            return $result;
        }

    }
    public function get_users()
    {        
        $query = $this->db->query("SELECT * FROM `users` ORDER BY `users`.`USERID` DESC");
        $result = $query->result_array();
        return $result;                  
    }
    public function get_single_users($id)
    {        
        $query = $this->db->query("SELECT * FROM `users` WHERE USERID = '".$id."'");
        $result = $query->row_array();
        return $result;                  
    }
    public function update_user($id,$update_data)
    {           
        $this->db->where('USERID', $id);
        $this->db->update('users', $update_data);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        } 
    }
    public function update_review($id,$update_data)
    {           
        $this->db->where('REVIEWID', $id);
        $this->db->update('reviews', $update_data);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        } 
    }
    public function get_brands()
    {
        // $this->db->order_by('BRANDID', 'DESC');
        $query = $this->db->order_by('BRANDID', 'DESC')->get('brands');
        $result = $query->result_array();
        return $result;                        
                                    
    }
    public function get_brand_single($id)
    {
        $query = $this->db->where('BRANDID', $id)->get('brands');
        $result = $query->row_array();
        return $result;                        
                                    
    }
    public function get_all_products()
    {
        // $result = $this->db->query("SELECT p.*,u.*,c.* FROM `products` AS p ,users AS u,city AS c WHERE p.userID = u.USERID AND p.stateID = c.CITYID")->result_array();
        $result = $this->db->query("SELECT p.*,u.* FROM `products` AS p ,users AS u WHERE p.userID = u.USERID ORDER BY p.`PRODUCTID` DESC")->result_array();
        return $result;                        
                                    
    }
    public function get_active_products()
    {
        $result = $this->db->query("SELECT p.*,u.* FROM `products` AS p ,users AS u WHERE p.product_expiry >='".date("Y-m-d h:i:s A")."' AND p.product_status = 0 AND p.userID = u.USERID ORDER BY p.`PRODUCTID` DESC")->result_array();
        return $result;                        
                                    
    }
    public function get_features_products()
    {
        $result = $this->db->query("SELECT p.*,u.* FROM `products` AS p ,users AS u WHERE p.product_expiry >='".date("Y-m-d h:i:s A")."' AND p.product_status = 0 AND product_features = 1 AND p.userID = u.USERID ORDER BY p.`PRODUCTID` DESC")->result_array();
        return $result;                        
                                    
    }
    public function get_pending_products()
    {
        $result = $this->db->query("SELECT p.*,u.* FROM `products` AS p ,users AS u WHERE p.product_status = 1 AND p.userID = u.USERID ORDER BY p.`PRODUCTID` DESC")->result_array();
        return $result;                        
                                    
    }
    public function get_expire_products()
    {
        $result = $this->db->query("SELECT p.*,u.* FROM `products` AS p ,users AS u WHERE p.product_expiry <='".date("Y-m-d h:i:s A")."' AND p.userID = u.USERID ORDER BY p.`PRODUCTID` DESC")->result_array();
        return $result;                        
                                    
    }
    public function get_resubmitted_products()
    {
        $result = $this->db->query("SELECT p.*,u.* FROM `products` AS p ,users AS u WHERE p.product_expiry <='".date("Y-m-d h:i:s A")."' AND p.userID = u.USERID ORDER BY p.`PRODUCTID` DESC")->result_array();
        return $result;                        
                                    
    }
    public function get_single_products($id)
    {
        $result = $this->db->query("SELECT * FROM `products` WHERE `PRODUCTID` = '".$id."'")->row_array();
        return $result;                        
                                    
    }
    public function get_single_review($id)
    {
        $result = $this->db->query("SELECT * FROM `reviews` WHERE `REVIEWID` = '".$id."'")->row_array();
        return $result;                        
                                    
    }
    public function get_single_city($id)
    {
        $result = $this->db->query("SELECT * FROM `city` WHERE `CITYID` = '".$id."'")->row_array();
        return $result;                        
                                    
    }
    public function get_single_term($id)
    {
        $result = $this->db->query("SELECT * FROM `terms_services` WHERE `TERMID` = '".$id."'")->row_array();
        return $result;                        
                                    
    }
    public function get_single_banner($id)
    {
        $result = $this->db->query("SELECT * FROM `banner` WHERE `BANNERID` = '".$id."'")->row_array();
        return $result;                        
                                    
    }
    public function update_city($id,$update_data)
    {           
        $this->db->where('CITYID', $id);
        $this->db->update('city', $update_data);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        } 
    }
    public function update_products($id,$update_data)
    {           
        $this->db->where('PRODUCTID', $id);
        $this->db->update('products', $update_data);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        } 
    }
    public function update_term($id,$update_data)
    {           
        $this->db->where('TERMID', $id);
        $this->db->update('terms_services', $update_data);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        } 
    }
    public function update_banner($id,$update_data)
    {           
        $this->db->where('BANNERID', $id);
        $this->db->update('banner', $update_data);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        } 
    }
    public function get_reviews()
    {
        $result = $this->db->query("SELECT r.*,p.* FROM `reviews` AS r,`products` AS p WHERE p.PRODUCTID = r.REVIEWID")->result_array();
        return $result;                        
                                    
    }
    public function get_cities()
    {
        $result = $this->db->query("SELECT * FROM `city`")->result_array();
        return $result;                        
                                    
    }
    public function get_chats()
    {
        $result = $this->db->query("SELECT c.*,u.* FROM `chat_message` AS c,users AS u WHERE c.send_by = u.USERID ORDER BY c.`id`  ASC")->result_array();
        return $result;                        
                                    
    }
    public function get_terms()
    {
        $result = $this->db->query("SELECT * FROM `terms_services`  ORDER BY TERMID  ASC")->result_array();
        return $result;                        
                                    
    }
    public function get_banners()
    {
        $result = $this->db->query("SELECT * FROM `banner`  ORDER BY BANNERID  DESC")->result_array();
        return $result;                        
                                    
    }
########################### Event Model End #################################

  

     public function get_password()
    {        
        $query = $this->db->query("SELECT * FROM `administrators` ");
        $result = $query->result_array();
        return $result;                  
    }
    public function getcurrentpassword($userid)
    {
        $query = $this->db->where(['ADMINID' => $userid])
                                    ->get('administrators');
                                    if($query->num_rows() > 0){
                                        return $query->row();
                                    }
    }
    
    public function updatepassword($new_pass, $userid){
        
        $data = array(
            'password' => $new_pass
            
            );
            return $this->db->where('ADMINID',$userid)
                                    ->update('administrators', $data);
        
    }
    
    public function get_system_settings()
    {        
        $query = $this->db->query("SELECT * FROM `system_settings`");
        $result = $query->result_array();
        return $result;                  
    }
    public function get_settings()
    {        
        $query = $this->db->query("SELECT * FROM `settings` WHERE SETTINGID  = 1");
        $result = $query->row_array();
        return $result;                  
    }
    public function get_information()
    {        
        $query = $this->db->query("SELECT * FROM `information` WHERE INFOID  = 1");
        $result = $query->row_array();
        return $result;                  
    }
    public function delete_user($id)
    {
        $this->db->where('USERID', $id);
        $this->db->delete('users');
        // $this->db->delete('users', array('USERID' => $id));
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }
    public function delete_product($id)
    {
        $this->db->where('PRODUCTID', $id);
        $this->db->delete('products');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function category_delete($id)
    {
        $this->db->where('CATID', $id);
        $this->db->delete('categories');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function brand_update($id,$updateArray)
    {
        $this->db->where('BRANDID', $id);
        $this->db->update('brands',$updateArray);
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function brand_delete($id)
    {
        $this->db->where('BRANDID', $id);
        $this->db->delete('brands');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function delete_banner($id)
    {
        $this->db->where('BANNERID', $id);
        $this->db->delete('banner');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function delete_term($id)
    {
        $this->db->where('TERMID', $id);
        $this->db->delete('terms_services');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function delete_review($id)
    {
        $this->db->where('REVIEWID', $id);
        $this->db->delete('reviews');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function delete_city($id)
    {
        $this->db->where('CITYID', $id);
        $this->db->delete('city');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function get_reported_ads()
    {
        $result = $this->db->query("SELECT r.*,p.*,u.* FROM `products` AS p ,users AS u , reports AS r WHERE  r.productID = p.PRODUCTID AND p.userID = u.USERID ORDER BY p.`PRODUCTID` DESC")->result_array();
        return $result;                                                        
    }
    public function multiple_delete_ads($ids)
    {
        $this->db->where_in('PRODUCTID', $ids);
        $this->db->delete('products');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function multiple_delete_categories($ids)
    {
        $this->db->where_in('CATID', $ids);
        $this->db->delete('categories');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function multiple_delete_brand($ids)
    {
        $this->db->where_in('BRANDID', $ids);
        $this->db->delete('brands');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
    public function multiple_delete_user($ids)
    {
        $this->db->where_in('USERID', $ids);
        $this->db->delete('users');
        if($this->db->affected_rows() > 0){

            return true;

        }else{

            return false;

        }
    }
}
?>