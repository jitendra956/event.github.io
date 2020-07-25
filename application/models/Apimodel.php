<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apimodel extends CI_Model {

public function checked_email($email)
{
    $check_email=$this->db->query("select * from users where email='".$email."'")->row_array();
    if(@$check_email)
    {
        $email_status="Email id already exist";
    }
    else
    {
         $email_status=false;
    }


// var_dump($num_status);
    if(@$email_status==false)
    {
        return false;
    }
    else
    {

        return $email_status;
    }

}

public function checked_contact($contact)
{
    $check_contact=$this->db->query("select * from users where contact='".$contact."'")->row_array();
    if(@$check_contact)
    {
        $contact_status="Contact already exist";
    }
    else
    {
         $contact_status=false;
    }


// var_dump($num_status);
    if(@$contact_status==false)
    {
        return false;
    }
    else
    {

        return $contact_status;
    }

}

public function get_notification_for_all()
{
    $check_note = $this->db->query("SELECT * FROM notification WHERE send_to='all' AND status = 0 ORDER BY `id` DESC")->row_array();
    if(@$check_note)
    {
        $result = $check_note;
    }
    else
    {
         $result = false;
    }
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}

public function check_user_password($user_id,$oldpass)
{
    $this->db->select('id,email');
    $this->db->from('users');
    $this->db->where('id', $client_id);
    $this->db->where('password', md5($oldpass));
    $result = $this->db->get()->row_array();
    return $result;        
}

public function check_user_location($user_id)
{
    $result = $this->db->query("SELECT * FROM nearby WHERE user_id='".$user_id."'")->row_array();
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}

public function insert_user_location($locationArray)
{
    $result = $this->db->insert('nearby',$locationArray);
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}

public function update_user_location($user_id,$locationArray)
{
    $result = $this->db->where('NEARBYID',$user_id)->update('nearby', $locationArray);
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}

public function get_user($user_id)
{
    $result = $this->db->query("SELECT * FROM users WHERE USERID='".$user_id."'")->row_array();
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}
public function update_user($user_id,$updateArray)
{
    $result = $this->db->where('USERID',$user_id)->update('users', $updateArray);
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}

public function get_product($product_id)
{
    $result = $this->db->query("SELECT * FROM `products` WHERE PRODUCTID='".$product_id."'")->row_array();
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}

public function update_product($product_id,$productArray)
{
    $update = $this->db->where('PRODUCTID',$product_id)->update('products', $productArray);
    if(@$update)
    {
        return $update;
    }
    else
    {

        return false;
    }

}

public function get_product_images($product_id)
{
    $result = $this->db->query("SELECT * FROM `product_images` WHERE `prodictID` = '".$product_id."'")->result_array();
    if(@$result == false)
    {
        return false;
    }
    else
    {

        return $result;
    }

}

public function get_product_reviews_by_id($product_id)
{
    $result = $this->db->query("SELECT r.*,u.full_name,u.user_photo FROM `reviews` As r,users AS u WHERE r.review_status = 1 AND u.USERID = r.userID AND r.`productID` = '".$product_id."'")->result_array();
    return $result;
}

public function get_users_favourites($id)
{
    $result = $this->db->query("SELECT * FROM `favourites` WHERE `userID` = '".$id."'")->result_array();
    return $result;
}
public function get_category($id)
{
    $result = $this->db->query("SELECT * FROM `categories` WHERE `CATID` ='".$id."'")->row_array();
    return $result;
}
public function get_brand($id)
{
    $result = $this->db->query("SELECT * FROM `brands` WHERE `BRANDID` ='".$id."'")->row_array();
    return $result;
}

public function get_city($id)
{
    $result = $this->db->query("SELECT * FROM `city` WHERE `CITYID` ='".$id."'")->row_array();
    return $result;
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

public function get_settings()
{        
    $query = $this->db->query("SELECT * FROM `settings` WHERE SETTINGID  = 1");
    $result = $query->row_array();
    return $result;                  
}

}
?>