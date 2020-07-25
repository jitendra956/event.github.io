<?php  ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller 
 { 
   public function __construct()
   {
       parent::__construct();
       $this->load->model('apimodel');
	     $this->load->library('twilio');
       $this->load->library('encrypt');
   }
  
  public function sent_sms()
	{
		$this->load->library('twilio');
    $json = file_get_contents('php://input');
    $data = json_decode($json);    
    $to=$data->number;
		// $from = '+15709802063';
		$from = '+12162796694';
		if(@$to == NULL)
		{
			    $to = '+918962334644';
		}
		else
		{
			$to = '+'.$to;
		}
		$message = 'Success OTP is '.rand(11111,99999);
		$response = $this->twilio->sms($from, $to, $message);
		if($response->IsError)
			echo 'Error: ' . $response->ErrorMessage;
		else
			echo 'Sent message to ' . $to.':'.$message;
	}

     public function user_signup()
     {
       $json = file_get_contents('php://input');
        $data = json_decode($json);
        $chreck_email=@$data->email;
        $contact = @$data->contact;
        $get_contact_result=$this->apimodel->checked_contact($contact);
        if(@$get_contact_result)
        {
          echo json_encode(array("status"=>"0","message"=>$get_contact_result));
        }
        else
        {
          $get_email_result=$this->apimodel->checked_email($chreck_email);
          if($get_email_result)
           {
            echo json_encode(array("status"=>"0","message"=>$get_email_result));
           }
           else
           {

          $full_name = @$data->full_name;
          $user_photo = @$data->user_photo;
          // $country_code = '+91';
          $country_code = @$data->country_code;
          // $otp = rand(1111,9999);
          $otp = 1234;
          if($user_photo == "")
          {
            $full_img_name_post = "";
          }else
          {
            $data_post=base64_decode($user_photo);
            $full_img_name_post = "user_".time().".png";

            $imagename_post = "uploads/users/".$full_img_name_post;
            file_put_contents($imagename_post, $data_post);
          }

          $insert_data=array(
            "full_name"=>$full_name,
             "country_code"=>@$country_code,
              "contact"=>@$data->contact,
                "email"=>@$data->email,
                  "password"=>@$this->encrypt->encode($data->password),
                    "otp"=>$otp,
                      "device_token"=>@$data->device_token,
                        "user_photo"=>@$full_img_name_post,
                          "created_on"=>date("Y-m-d H:i:s A"),
                            "join_by"=>@$data->join_by
          );

          // $from = '+12162796694';
          // $to = $country_code.$contact;
          // // $to = $ccellphone;
          // $message = 'Hi! '.$full_name.', Your Event Registration OTP is '.$otp;
          // $response = $this->twilio->sms($from, $to, $message);
          $result=$this->db->insert("users",$insert_data);
          $insert_id = $this->db->insert_id();
          if(@$result)
            {
             echo json_encode(array("status"=>"1","message"=>"You have Successfully Registered","user_id"=>strval($insert_id)));
            }
          else
            {
              echo json_encode(array("status"=>"0","message"=>"Registration failed"));
            }
        }
      }
    }
    public function check_signup_otp()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $user_id=@$data->user_id;
        $otp=@$data->otp;
        $result = $this->db->query("SELECT * FROM users WHERE USERID = '".$user_id."' AND otp ='".$otp."'")->row_array();
        if($result)
        {
          $this->db->query("UPDATE `users` SET `verify` = '1' WHERE USERID = '".$user_id."'");
            echo json_encode(array("status"=>"1","message"=>"OTP Match"));
        }
        else
        {
            echo json_encode(array("status"=>"0","message"=>"You Have Entered Wrong OTP!"));
        }

    }
    public function user_login()
    {
       $json = file_get_contents('php://input');
       $data = json_decode($json);
       // $country_code='+91';
       $country_code=@$data->country_code;
       $contact=@$data->contact;
       $device_token=@$data->device_token;

       $data=$this->db->query("SELECT *  FROM users WHERE country_code ='".$country_code."' and contact ='".$contact."'")->row_array();   
       if ($data){
        if($data['status'] != 0){
          if($data['verify'] != 0){
            // $loginotp = rand(1111,9999);
            $loginotp = '1234';
            $login_data = array('temp_otp'=>$loginotp,'device_token' =>@$device_token,"last_login"=>date("Y-m-d H:i:s A"));
            $this->db->where('USERID',$data['USERID'])->update('users', $login_data);
            $user_data=$this->db->query("SELECT *  FROM users WHERE USERID ='".$data['USERID']."'")->row_array();
            echo json_encode(array("status"=>"1","message"=>"Login OTP Sent! to your Number.","user_id"=>$user_data['USERID']));
          }
          else
          {
            echo json_encode(array("status"=>"0","message"=>"Your Account is Not verified. Please try again"));
          }
        }
        else
        {
          echo json_encode(array("status"=>"0","message"=>"Your Account is deactivated. Please try again")); 
        }
  
       }else{
          echo json_encode(array("status"=>"0","message"=>"You’ve entered the wrong  Contact OR Country Code. Please try again")); 
       }   
    }

    public function check_login_otp()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $user_id=@$data->user_id;
        $loginotp=@$data->loginotp;
        $result = $this->db->query("SELECT * FROM users WHERE USERID = '".$user_id."' AND temp_otp ='".$loginotp."'")->row_array();
        if($result)
        {
          $login_data = array('temp_otp'=>'','device_token' =>@$device_token,"online"=>"1","last_login"=>date("Y-m-d H:i:s A"));
          $this->db->where('USERID',$result['USERID'])->update('users', $login_data);
          $user_data=$this->db->query("SELECT *  FROM users WHERE USERID ='".$result['USERID']."'")->row_array();
            echo json_encode(array("status"=>"1","message"=>"Login OTP Matched.","data"=>$user_data));
        }
        else
        {
            echo json_encode(array("status"=>"0","message"=>"You Have Entered Wrong Login OTP!"));
        }

    }

    public function set_user_location()
    {
       $json = file_get_contents('php://input');
        $data = json_decode($json);
        $user_id=@$data->user_id;
        $latitude =@$data->latitude;
        $longitude =@$data->longitude;
        $other =@$data->other;
        
        $get_location = $this->apimodel->check_user_location($user_id);
        if(@$get_location)
        {
            $locationArray = array(
            					'latitude' => $latitude,
            					'longitude' => $longitude,
            					'other' => $other            
            );
            $set_location = $this->apimodel->update_user_location($user_id,$locationArray);                           
        }
        else
        {
        	$locationArray = array(
            					'user_id' => $user_id,
            					'latitude' => $latitude,
            					'longitude' => $longitude,
            					'other' => $other            
            );
            $set_location = $this->apimodel->insert_user_location($locationArray);
        }
        if($set_location)
        {
        	echo json_encode(array("status"=>"1","message"=>"Location Set Successfully"));
        }
        else
        {
            echo json_encode(array("status"=>"0","message"=>"Failed to set Location!"));
        }
  }
  public function get_categories()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json);
    $locations = array();
    $lang = @$data->lang;    
    if($lang == 'arabic')
    {
      $categories=$this->db->query("SELECT CATID,category_name_ar AS category_name,category_parent,category_image,category_description,category_created_date ,category_order,category_status,category_delete_sts FROM `categories` WHERE category_parent = 0 AND category_status = 0 AND `category_delete_sts` = 0 ORDER BY `category_order` ASC")->result_array();
    }
    else
    {
      // $categories=$this->db->query("SELECT * FROM `categories` WHERE category_parent = 0 AND category_status = 0 AND `category_delete_sts` = 0 ORDER BY `category_order` ASC")->result_array();
      $categories=$this->db->query("SELECT CATID,category_name,category_name_ar,category_parent,category_image,category_description,category_created_date,category_order,category_status,category_delete_sts FROM `categories` WHERE category_parent = 0 AND category_status = 0 AND `category_delete_sts` = 0 ORDER BY `category_order` ASC")->result_array();
    } 
		if ($categories){

		  echo json_encode(array("status"=>"1","message"=>"Success","data"=>$categories));
		}else{
		  echo json_encode(array("status"=>"0","message"=>"Failed to get Categories!")); 
		}
	}
  public function get_sub_categories()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $categories = array();
    $category_id=@$data->category_id;
    $lang = @$data->lang;    
    if($lang == 'arabic')
    {
      $categories=$this->db->query("SELECT CATID,category_name_ar AS category_name,category_parent,category_image,category_description, category_created_date,category_order,category_status,category_delete_sts FROM `categories` WHERE category_parent = '".$category_id."' AND category_status = 0 AND `category_delete_sts` = 0 ORDER BY `CATID` DESC")->result_array();
    }
    else
    {
      $categories=$this->db->query("SELECT CATID,category_name,category_name_ar,category_parent,category_image,category_description,category_created_date,category_order,category_status,category_delete_sts FROM `categories` WHERE category_parent = '".$category_id."' AND category_status = 0 AND `category_delete_sts` = 0 ORDER BY `CATID` DESC")->result_array();
    } 
    if ($categories){

      echo json_encode(array("status"=>"1","message"=>"Success","data"=>$categories));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No Sub Categories Found !","data"=>$categories)); 
    }
  }
  public function get_settings()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);


    $settings=$this->db->query("SELECT ads_max_image_limit FROM `settings` WHERE SETTINGID = 1")->row_array(); 
    if ($settings){

      echo json_encode(array("status"=>"1","message"=>"Success","data"=>$settings));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to get settings!")); 
    }
  } 
  public function add_product()
  {
    $images = array();
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id;
    $cat_id = @$data->cat_id;
    $subcat_id = @$data->subcat_id;
    $brand_id = @$data->brand_id;
    $title = @$data->title;
    $description= @$data->description;
    @$images= @$data->images;
    $cost= @$data->cost;
    $duration= @$data->duration;
    // $currency= @$data->currency;
    $currency= 4;
    $state_id= @$data->state_id;
    $negotiable_status= @$data->negotiable_status;
    $contact_status= @$data->contact_status;
    @$brandId = @$brand_id[0];
    @$stateId = $state_id[0];

    $settings =$this->apimodel->get_settings();
    $expiry = (int)$settings['ads_expiry'];
    // var_dump($expiry);
    // $product_date= date("Y-m-d h:i:s A");
    // $product_expiry = date('Y-m-d h:i:s A', strtotime('+'.$expiry.' days', strtotime(date("Y-m-d h:i:s A"))));
    // var_dump($product_date);
    // echo "###############";
    // var_dump($product_expiry);
     if($settings['ads_approval'] == 'Enable')
    {
       $product_status = 0;
    }
    else
    {
      $product_status = 1;
    }
    if(@!empty($stateId))
    {
      $city = $this->apimodel->get_city($stateId);
        $latitude =$city['latitude'];
        $longitude =$city['longitude'];
    }
    else
    {
      $latitude =@$data->latitude;
        $longitude =@$data->longitude;
        @$stateId = 0;
    }
    // var_dump($images);
    $uniqid = uniqid($user_id);
    // $uniqid = uniqid($user_id);
    for($i=0;$i<count(@$images);$i++)
    {
      // if($images == "")
      // {
      //   $add_img_name = "";
      // }else
      // {
        $data_post=base64_decode($images[$i]);
        $add_img_name = "add-".$user_id.'-'.$i.'-'.$uniqid.".png";

        $imagename_post = "uploads/products/".$add_img_name;
        if(file_put_contents($imagename_post, $data_post))
        {
          $this->db->query("INSERT INTO `product_images` (`image_code`,`product_images_name`) VALUES ('".$uniqid."', '".$add_img_name."')");
        }

        // echo $add_img_name;
      // }
    }
    if(@empty($images))
    {
      $add_img = "";
    }else
    {
      $add_img = "add-".$user_id.'-0-'.$uniqid.".png"; 
    }

    if($duration == 'Hour'){ $duration_ar = 'ساعة'; }
    if($duration == 'Day'){ $duration_ar = 'يوم'; }
    if($duration == 'Week'){ $duration_ar = 'أسبوع'; }

$productArray = array(
            'catID'=> $cat_id,
            'subcatID'=> $subcat_id,
            'userID'=> $user_id,
            'brandID'=> @$brandId,
            'stateID'=> $stateId,
            'product_title'=> $title,
            'product_description'=> $description,
            'product_duration'=> $duration,
            'product_duration_ar'=> $duration_ar,
            'product_image'=> $add_img,
            'product_image_count'=> count($images),
            'product_price'=> $cost,
            'product_currencyID'=> $currency,
            'product_negotiable_status'=> $negotiable_status,
            'product_contact_status'=> $contact_status,
            'product_latitude'=> $latitude,
            'product_longitude'=> $longitude,
            'product_date_string'=> date("d M Y"),
            'product_date'=> date("Y-m-d H:i:s A"),
            'product_expiry'=> date('Y-m-d H:i:s A', strtotime('+'.$expiry.' days', strtotime(date("Y-m-d h:i:s A")))),
            'product_status'=> $product_status

            );
    $product = $this->db->insert('products',$productArray);
    if ($product){
      $product_id = $this->db->insert_id();
      if($product_status == 1)
      {
        $notificationsArray = array(
        'userID' => $user_id, 
        'notification_fromID' => $user_id, 
        'notification_for_productID' => $product_id, 
        'notification' => 'Your ad is not active.', 
        'notification_ar' => 'إعلانك غير نشط.', 
        'notification_date' => date("d M Y"), 
        'notification_time' => date("H:i"),
        'notification_date_time' => date("Y-m-d H:i:s A") 
        );
        $this->apimodel->insert_notifications($notificationsArray);
      }
      $this->db->where('image_code',$uniqid)->update('product_images', array('prodictID' => $product_id));
      echo json_encode(array("status"=>"1","message"=>"Ad posted successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to post add!")); 
    }
  }
  public function get_products()
  {
    $response = array();
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $user_id=@$data->user_id;
    $catid=@$data->catid;
    $subcatid=@$data->subcatid;
    $brandid=@$data->brandid;
    $productid=@$data->productid;
    $product_features=@$data->product_features;
    $lang = @$data->lang;   
    @$latitude = @$data->latitude;
    @$longtitude = @$data->longtitude; 
    $search = @$data->search; 
    $products = array();
    if(@$catid)
    {
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID  AND p.product_expiry >='".date("Y-m-d H:i:s A")."' AND c.CATID = p.catID AND p.catID = '".$catid."' AND p.product_status = 0 ORDER BY `p`.`PRODUCTID` DESC")->result_array();
    }
    elseif(@$subcatid)
    {
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID  AND p.product_expiry >='".date("Y-m-d H:i:s A")."' AND p.subcatID = '".$subcatid."' AND p.product_status = 0 ORDER BY `p`.`PRODUCTID` DESC")->result_array();
    }
    elseif(@$brandid)
    {
      $brandids = implode("','" ,@$brandid);
    	 $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign  FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID  AND p.product_expiry >='".date("Y-m-d H:i:s A")."' AND p.brandID IN ('".$brandids."') AND p.product_status = 0 ORDER BY `p`.`PRODUCTID` DESC")->result_array();
    }
    elseif(@$productid)
    {
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID AND p.product_expiry >='".date("Y-m-d H:i:s A")."' AND p.PRODUCTID = '".$productid."' AND p.product_status = 0 ORDER BY `p`.`PRODUCTID` DESC")->result_array();      
    }
    elseif(@$product_features && $latitude == "" && $longtitude == "")
    {
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID AND p.product_expiry >='".date("Y-m-d H:i:s A")."' AND p.product_features = '1' AND p.product_status = 0 ORDER BY `p`.`PRODUCTID` DESC")->result_array();
    }
    elseif($latitude!="" && $longtitude!="" && @$product_features=="")
    {
      $lat = intval($latitude);
      $latto = ceil($lat / 10) * 10;
      $long = intval($longtitude);
      $longto = ceil($long / 10) * 10;
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID AND p.product_expiry >= '".date("Y-m-d H:i:s A")."' AND p.`product_latitude` LIKE '".$lat."%' AND p.`product_longitude` LIKE '".$long."%' ORDER BY `p`.`PRODUCTID` DESC")->result_array();
    }
    elseif($latitude!="" && $longtitude!="" && @$product_features)
    {
      $lat = intval($latitude);
      $long = intval($longtitude);
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID AND p.product_expiry >= '".date("Y-m-d H:i:s A")."' AND p.product_features = '1' AND p.`product_latitude` LIKE '".$lat."%' AND p.`product_longitude` LIKE '".$long."%' ORDER BY `p`.`PRODUCTID` DESC")->result_array();
    }
    elseif($search)
    {
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID AND p.product_expiry >= '".date("Y-m-d H:i:s A")."' AND p.`product_title` LIKE '%".$search."%' ORDER BY `p`.`PRODUCTID` DESC")->result_array();
    }
    else
    {
      $products=$this->db->query("SELECT p.PRODUCTID,p.brandID,p.subcatID,p.product_title,p.product_description,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_negotiable_status,p.stateID,p.product_liked_by,p.product_liked_by_total,p.product_date_string,p.product_latitude,p.product_longitude,p.product_date,c.CATID,c.category_name,c.category_parent,c.category_image,u.USERID,u.full_name,u.contact,u.user_photo,u.country_code,u.user_phone_status,u.user_notification_status,u.created_on AS join_date,u.blocked_users,cr.currency,cr.currency_sign FROM `products` AS p ,`categories` AS c ,`users` AS u,`currencies` AS cr WHERE p.catID = c.CATID AND p.userID = u.USERID AND p.product_currencyID = cr.CURRENCYID AND p.product_expiry >='".date("Y-m-d H:i:s A")."' AND p.product_status = 0 ORDER BY `p`.`PRODUCTID` DESC")->result_array(); 

    }  
    // var_dump($this->db->last_query());
    if ($products){
      $pproducts =array();
         foreach ($products as $product) {
          $category = '';
          $user = $this->apimodel->get_user($user_id);
          $images = $this->apimodel->get_product_images($product['PRODUCTID']);
          $reviews = $this->apimodel->get_product_reviews_by_id($product['PRODUCTID']);
          $favourites = $this->apimodel->get_users_favourites($user_id);
          $category = $this->apimodel->get_category($product['CATID']);
          $subcategory = $this->apimodel->get_category($product['subcatID']);
          $brand = $this->apimodel->get_brand($product['brandID']);
          $city = $this->apimodel->get_city($product['stateID']);
          $pimages =array();
          if($images)
          {
	          foreach ($images as $image) {
	              array_push($pimages, [ 
	                        'PRODUCTIMGID'=>$image['PRODUCTIMGID'] , 
	                        'prodictID'=>$image['prodictID'],
	                        'product_images_name'=>$image['product_images_name'], 
	                        ]);
	          }
          }
          $previews =array();
          $previewsavg =array();
          $review_avg = '';
          if($reviews)
          {
	          foreach ($reviews as $review) {
                array_push($previewsavg, $review['review_points']);
	              array_push($previews, [ 
	                        'review_points'=>$review['review_points'], 
	                        'review_details'=>$review['review_details'], 
	                        'review_date'=>$review['review_date'], 
	                        'review_time'=>$review['review_time'], 
	                        'full_name'=>$review['full_name'], 
	                        'user_photo'=>$review['user_photo'], 
	                        ]);
	          }
          }
          if(count($previewsavg) > 0)
          {
            @$review_avg = array_sum($previewsavg) / count($previewsavg);
          }
          else
          {
            @$review_avg = 0;
          }
          $pfavourites =array();
          if($favourites)
          {
	          foreach ($favourites as $favourite) {
	          	// if(!in_array($favourite['productID'], $pfavourites)){
	              array_push($pfavourites, $favourite['productID']);
	          	// }
	          }
          }

          if($lang == 'arabic')
          {
            if($product['product_duration'] == 'Hour'){ $duration = 'ساعة'; }
            if($product['product_duration'] == 'Day'){ $duration = 'يوم'; }
            if($product['product_duration'] == 'Week'){ $duration = 'أسبوع'; }
            $city_name = $city['name_ar'];
            $catname = $category['category_name_ar'];
            $subcatname = $subcategory['category_name_ar'];
            $brandname = $brand['brand_name_ar'];
          }
          else
          {
             $duration = $product['product_duration'];
             $city_name = $city['name_en'];
             $catname = $category['category_name'];
             $subcatname = $subcategory['category_name'];
             $brandname = $brand['brand_name'];
          }
          if($city['CITYID'])
          {
          	$cityid = $city['CITYID'];
          }
          else
          {
          	$cityid = "";
          }

          if($city_name)
          {
          	$cityname = $city_name;
          }
          else
          {
          	$cityname = "";
          }

              array_push($pproducts, [
                            'PRODUCTID'=>$product['PRODUCTID'],
                            'brandID'=>$product['brandID'],
                            'subcatID'=>$product['subcatID'],
                            'brand_name'=>@$brandname,
                            'product_title'=>$product['product_title'],
                            'product_description'=>$product['product_description'] , 
                            'product_image'=>@$pimages[0]['product_images_name'],
                            'product_images'=>$pimages,
                            'product_image_count'=>count($pimages),
                            'product_price'=>$product['product_price'],
                            'product_duration'=>$duration,
                            'product_negotiable_status'=>$product['product_negotiable_status'],
                            'cityID'=>$cityid,
                            'city_name'=>$cityname,
                            'product_latitude'=>$product['product_latitude'],
                            'product_longitude'=>$product['product_longitude'],
                            'product_liked_by'=>$product['product_liked_by'],
                            'product_liked_by_total'=>$product['product_liked_by_total'],
                            'product_date_time'=>date("Y-m-d H:i", strtotime($product['product_date'])),
                            'product_date_string'=>$product['product_date_string'],
                            'product_reviews'=>$previews,
                            'product_reviews_avg'=>$review_avg,
                            'CATID'=>$product['CATID'],
                            'category_parent'=>$product['category_parent'],
                            'category_parent_name'=>@$catname,
                            'sub_category_name'=>@$subcatname,
                            'category_image'=>$product['category_image'],
                            'USERID'=>$product['USERID'], 
                            'full_name'=>$product['full_name'], 
                            'user_photo'=>$product['user_photo'], 
                            'contact'=>$product['contact'], 
                            'country_code'=>$product['country_code'], 
                            'user_phone_status'=>$product['user_phone_status'], 
                            'user_notification_status'=>$product['user_notification_status'], 
                            'join_date'=>date("d M Y", strtotime($product['join_date'])), 
                            'followup_products'=>$user['followup_products'], 
                            'blocked_users'=>$user['blocked_users'], 
                            'currency'=>$product['currency'], 
                            'currency_sign'=>$product['currency_sign'], 
                            'myfavourites'=>implode(",", $pfavourites), 
                          ]); 

         }
             $response["status"]= "1";
             $response["message"]= "Success";
             $response["data"]= $pproducts;
       }
       else
         {
              $response["status"]= "0";
              $response["message"]= "No Ads Found!";
              $response["data"]= array();
         }
         
        
         

    //   echo json_encode(array("status"=>"1","message"=>"Success","data"=>$products));
    // }else{
    //   echo json_encode(array("status"=>"0","message"=>"No Ads Found!","data"=>$products)); 
    // }
         echo json_encode($response);
  }
  public function remove_product()
  {
    $response = array();
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $user_id=@$data->user_id;
    $productid=@$data->productid;
    $delete_product =  $this->db->query("DELETE FROM `products` WHERE `userID` = '".$user_id."' AND PRODUCTID = '".$productid."'");
    if ($this->db->affected_rows() >0){
      echo json_encode(array("status"=>"1","message"=>"Ad Removed Successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to Remove Ad!")); 
    }
  }
  public function edit_product()
  {
    $response = array();
    $new_images = array();
    $old_images = array();
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $user_id=@$data->user_id;
    $productid=@$data->productid;
    $new_images= @$data->new_images;
    $old_images= @$data->old_images;
    $uniqid = uniqid($user_id);
    if(count($old_images) > 0)
    {
      @$oldIMG = implode(",", $old_images);
      @$this->db->query("DELETE FROM `product_images` WHERE `PRODUCTIMGID` NOT IN(".$oldIMG.") AND `prodictID` = '".$productid."'");
    }
    else
    {
      $this->db->query("UPDATE `products` SET `product_image` = '' WHERE PRODUCTID = '".$productid."'");
      @$this->db->query("DELETE FROM `product_images` WHERE `prodictID` = '".$productid."'");
    }
      for($i=0;$i<count($new_images);$i++)
      {
          $data_post=base64_decode($new_images[$i]);
          $add_img_name = "add-".$user_id.'-'.$i.'-'.$uniqid.'-'.$productid.".png";
          $imagename_post = "uploads/products/".$add_img_name;
          if(file_put_contents($imagename_post, $data_post))
          {
            if(count($old_images) ==  count($new_images))
            {
               $this->db->query("UPDATE `product_images` SET `product_images_name` = '".$add_img_name."' WHERE PRODUCTIMGID = '".$old_images[$i]."'");
               $this->db->query("UPDATE `products` SET `product_image` = '".$add_img_name."' WHERE PRODUCTID = '".$productid."'");
            }
            else
            {
              $this->db->query("INSERT INTO `product_images` (`prodictID`,`image_code`,`product_images_name`) VALUES ('".$productid."','".$uniqid."', '".$add_img_name."')");
              $this->db->query("UPDATE `products` SET `product_image` = '".$add_img_name."' WHERE PRODUCTID = '".$productid."'");
            }
          }
      }  


    $cat_id = @$data->cat_id;
    $brand_id = @$data->brand_id;
    $title = @$data->title;
    $description= @$data->description;
    $cost= @$data->cost;
    $duration= @$data->duration;
    // $currency= @$data->currency;
    $currency= 4;
    // $state_id= @$data->state_id;
    $negotiable_status= @$data->negotiable_status;
    $contact_status= @$data->contact_status;
    $brandId = $brand_id[0];
    // @$stateId = $state_id[0];
    @$stateId = @$data->state_id;

    if(@!empty($stateId))
    {
    	$city = $this->apimodel->get_city($stateId);
        $latitude =$city['latitude'];
        $longitude =$city['longitude'];
    }
    else
    {
    	$latitude =@$data->latitude;
        $longitude =@$data->longitude;
        @$stateId = 0;
    }


    $productArray = array(
            'catID'=> $cat_id,
            'brandID'=> $brandId,
            'stateID'=> $stateId,
            'product_title'=> $title,
            'product_description'=> $description,
            'product_duration'=> $duration,
            'product_price'=> $cost,
            'product_currencyID'=> $currency,
            'product_negotiable_status'=> $negotiable_status,
            'product_contact_status'=> $contact_status,
            'product_latitude'=> $latitude,
            'product_longitude'=> $longitude
            );
    $update_product = $this->db->where('PRODUCTID',$productid)->where('userID',$user_id)->update('products', $productArray);
    if ($this->db->affected_rows() >0){
      echo json_encode(array("status"=>"1","message"=>"Ad Updated Successfully."));
    }else{
      echo json_encode(array("status"=>"1","message"=>"Ad Updated Successfully."));
      // echo json_encode(array("status"=>"0","message"=>"Failed to update ad,nothing to change!")); 
    }
  }
  public function product_like()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id=@$data->user_id;     
    $product_id=@$data->product_id;  
    $user = $this->apimodel->get_user($user_id);
    $product = $this->apimodel->get_product($product_id);
    if($user && $product)
    {
	    if($user["liked_product"])
	    {
	      $ulikes = explode(",", $user["liked_product"]);
	      if(in_array($product_id, $ulikes))
	      {
	      $keyy=array_search($product_id,$ulikes);
	      unset($ulikes[$keyy]);
	      }
	      else
	      {
	       array_push($ulikes,$product_id);
	      }
	      $userArray["liked_product"] = implode(',', $ulikes);
	      $update_user_likes = $this->apimodel->update_user($user_id,$userArray);   
	    }
	    else
	    {
	      $userArray["liked_product"] = $product_id;
	      $update_user_likes = $this->apimodel->update_user($user_id,$userArray);   
	    }

	    if($product["product_liked_by"])
	    {
	      $set_likes = explode(",", $product["product_liked_by"]);
	      if(in_array($user_id, $set_likes))
	      {
	      $key=array_search($user_id,$set_likes);
	      unset($set_likes[$key]);
	      $productArray["product_liked_by_total"]=$product["product_liked_by_total"]-1;
	     }
	     else
	     {
	      array_push($set_likes,$user_id);
	      $productArray["product_liked_by_total"]=$product["product_liked_by_total"]+1;
	     }
	      $productArray["product_liked_by"] = implode(',', $set_likes);
	      $update_likes = $this->apimodel->update_product($product_id,$productArray);

	        echo json_encode(array("status"=>"1","message"=>"Successed."));
	      
	      }else{
	      $productArray["product_liked_by"] = $user_id;
	      $productArray["product_liked_by_total"]= 1 ;
	      $update_likes = $this->apimodel->update_product($product_id,$productArray);
	        echo json_encode(array("status"=>"1","message"=>"Successed.")); 
	      }
	}
	else
	{
	   echo json_encode(array("status"=>"0","message"=>"Failed!"));
	}
  }

  public function get_product_images()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $product_id = @$data->product_id; 
    $images = array();
    $images = $this->apimodel->get_product_images($product_id); 
    if ($images){
      echo json_encode(array("status"=>"1","data"=>$images));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No images found!","data"=>$images)); 
    }
  }
  public function get_locations()
  {
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $lang = @$data->lang;
    $locations = array();    
    if($lang == 'arabic')
    {
    	$locations = $this->db->query("SELECT CITYID,name_ar AS name_en,latitude,longitude,city_status FROM `city` WHERE `city_status` = 0")->result_array();
    }
    else
    {
    	$locations = $this->db->query("SELECT CITYID,name_en AS name_en,latitude,longitude,city_status FROM `city` WHERE `city_status` = 0")->result_array();
    }
    if ($locations){
      echo json_encode(array("status"=>"1","data"=>$locations));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No locations found!","data"=>$locations)); 
    }
  }
  public function get_brands()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $brands = array();
    $catID = @$data->catID; 
    $lang = @$data->lang;    
    if($lang == 'arabic')
    {
      $brands = $this->db->query("SELECT BRANDID,pcatID,catID,brand_name_ar AS brand_name,brand_image,brand_created_date,brand_status FROM `brands` WHERE `catID` = '".$catID."' AND `brand_status` = 0")->result_array();
    }
    else
    {
      $brands = $this->db->query("SELECT * FROM `brands` WHERE `catID` = '".$catID."' AND `brand_status` = 0")->result_array();
    }
    if ($brands){
      echo json_encode(array("status"=>"1","data"=>$brands));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to get brands!","data"=>$brands)); 
    }
  }
  public function add_review()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id;
    $product_id = @$data->product_id;
    $review_points = @$data->points;
    $review_details = @$data->detalis;

$reviewArray = array(
            'userID'=> $user_id,
            'productID'=> $product_id,
            'review_points'=> $review_points,
            'review_details'=> $review_details,
            'review_date_time'=> date("Y-m-d H:i:s A"),
            'review_date'=> date("d M Y"),
            'review_time'=> date("H:i A"),
            'review_date_string'=> date("d M Y")
            );
    $review = $this->db->insert('reviews',$reviewArray);
    if ($review){
      $product = $this->apimodel->get_product($product_id);
      $notificationsArray = array(
        'userID' => $product['userID'], 
        'notification_fromID' => $user_id, 
        'notification_for_productID' => $product_id, 
        'notification' => 'Your ad is being reviewed.', 
        'notification_ar' => 'إعلانك قيد المراجعة.', 
        'notification_date' => date("d M Y"), 
        'notification_time' => date("H:i"),
        'notification_date_time' => date("Y-m-d H:i:s A") 
      );
      
      $this->apimodel->insert_notifications($notificationsArray);
      echo json_encode(array("status"=>"1","message"=>"Review add successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed add review!")); 
    }
  }
  public function add_favourites()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id;
    $product_id = @$data->product_id;
	$favouritesArray = array(
	            'userID'=> $user_id,
	            'productID'=> $product_id,
	            'favourites_date_string'=> date("d M Y"),
	            'favourites_date'=> date("Y-m-d H:i:s A")
	            );
    $favourites = $this->db->insert('favourites',$favouritesArray);
    if ($favourites){
      echo json_encode(array("status"=>"1","message"=>"Add to favourites successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed Add to favourites!")); 
    }
  }
  public function update_profile()
  {
	  $json = file_get_contents('php://input');

	  $data = json_decode($json);
	  $user_id=@$data->user_id;    
	  $what=@$data->what;    
	  $value=@$data->value;
	  // if($value)
	  // {   
	  	$user = $this->apimodel->get_user($user_id);
	    if($what == 'user_photo')
	    {
	      if($value == "")
          {
            $value = "";
          }else
          {
            $data_post=base64_decode($value);
            $full_img_name_post = "user_".$user_id."_".time().".png";

            $imagename_post = "uploads/users/".$full_img_name_post;
            file_put_contents($imagename_post, $data_post);
            $value = $full_img_name_post;
          }
	    }
	    else
	    {
	    	$value = $value;
	    }
	    $update_data=array($what=>$value);
	    $update = $this->db->where('USERID',$user_id)->update('users', $update_data);
	    if(@$update)
	    {
	        echo json_encode(array("status"=>"1","message"=>"Success! Profile Updated."));
	    }
	    else
	    {
	        echo json_encode(array("status"=>"0","message"=>"Failed Update Profile!"));
	    }
	  // }
	  // else
	  // {
	  	// echo json_encode(array("status"=>"0","message"=>"Profile can't be update!"));
	  // }
  }
  public function user_chat()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
 
    $send_by=@$data->chat_from;

    $send_to=@$data->chat_to;

    $chat_message=@$data->chat_text;

    $status="0";

    $ids=$send_by."','".$send_to;
    $check_chats = $this->db->query("SELECT * FROM chat_message WHERE send_by IN('".$ids."') and send_to IN('".$ids."')")->result_array();
  	$chat_message_insert = array(
                        "send_by"=>$send_by,
                        "send_to"=>$send_to,
                        "message"=>$chat_message,
                        "status"=>$status,
                        "date_time"=>date("Y-m-d H:i:s A"),
                        "date_time_string"=>date("d-M-Y H:i A"),
                        "chat_date"=>date("d M Y"),
                        "chat_time"=>date("H:i A")
    );
    if(@!$check_chats)
    {
         $user = $this->apimodel->get_user($send_by);
         $notificationsArray = array(
        'userID' => $send_to, 
        'notification_fromID' => $send_by, 
        'notification_for_productID' => '0', 
        'notification' => $user['full_name'].' send you a message.', 
        'notification_ar' => 'نرسل لك رسالة. '.$user['full_name'], 
        'notification_date' => date("d M Y"), 
        'notification_time' => date("H:i"),
        'notification_date_time' => date("Y-m-d H:i:s A") 
      );
      
      $this->apimodel->insert_notifications($notificationsArray);
    }
    $chats = $this->db->insert("chat_message",$chat_message_insert);
    if ($chats){
      echo json_encode(array("status"=>"1","message"=>"Message send successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to send Message!")); 
    }
  }
  public function get_chat_list()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $chats = array();
    $chats = $this->db->query("SELECT chat_message.`id`,users.USERID as USERID,users.full_name,users.user_photo,(select chat_message.message from chat_message where (send_by='".$user_id."' and send_to=users.USERID) or (send_by=users.USERID and send_to='".$user_id."') ORDER BY id DESC LIMIT 1) as last_message,(select chat_message.chat_date from chat_message where (send_by='".$user_id."' and send_to=users.USERID) or (send_by=users.USERID and send_to='".$user_id."') ORDER BY id DESC LIMIT 1) as chat_date,(select chat_message.chat_time from chat_message where (send_by='".$user_id."' and send_to=users.USERID) or (send_by=users.USERID and send_to='".$user_id."') ORDER BY id DESC LIMIT 1) as chat_time,(select chat_message.chat_date from chat_message where (send_by='".$user_id."' and send_to=users.USERID) or (send_by=users.USERID and send_to='".$user_id."') ORDER BY id DESC LIMIT 1) as chat_date,chat_message.delete_by as deleteby,chat_message.delete_from ,(select chat_message.date_time from chat_message where (send_by='".$user_id."' and send_to=users.USERID) or (send_by=users.USERID and send_to='".$user_id."') ORDER BY id DESC LIMIT 1) as date_time FROM `chat_message`, `users` WHERE (chat_message.send_by='".$user_id."' and chat_message.send_to=users.USERID) or (chat_message.send_by=users.USERID and send_to='".$user_id."') GROUP BY users.USERID ORDER BY `date_time` DESC")->result_array();
     
    if ($chats){
      echo json_encode(array("status"=>"1","data"=>$chats));
    }else{
      echo json_encode(array("status"=>"0","message"=>"You don't have any chat!","data"=>$chats)); 
    }
  }
  public function get_chat_with_otherUser()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $other_user_id = @$data->other_user_id; 
    $chats = array();
    $ids=$user_id."','".$other_user_id;
    $chats = $this->db->query("SELECT * FROM chat_message WHERE send_by IN('".$ids."') and send_to IN('".$ids."') ORDER BY `chat_message`.`date_time` ASC")->result_array();
    if ($chats){
      echo json_encode(array("status"=>"1","data"=>$chats));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No Chat Found!","data"=>$chats)); 
    }
  }
  public function get_notifications()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $notifications = array();
    $lang = @$data->lang;
    if($lang == 'arabic')
    {
       $notifications = $this->db->query("SELECT n.NOTIFICATIONID,n.userID,n.notification_ar AS notification, n.notification_fromID,n.notification_for_productID,n.notification_date_time,n.notification_time,n.notification_date,n.notification_status,u.USERID,u.full_name,u.user_photo FROM `notifications` AS n ,users AS u WHERE n.notification_fromID = u.USERID AND n.userID = '".$user_id."' ORDER BY n.`notification_date_time` DESC")->result_array();
    }
    else
    {
       $notifications = $this->db->query("SELECT n.NOTIFICATIONID,n.userID,n.notification,n.notification_ar,n.notification_fromID,n.notification_for_productID,n.notification_date_time,n.notification_time,n.notification_date,n.notification_status,u.USERID,u.full_name,u.user_photo FROM `notifications` AS n ,users AS u WHERE n.notification_fromID = u.USERID AND n.userID = '".$user_id."' ORDER BY n.`notification_date_time` DESC")->result_array();
    }
    if ($notifications){
      echo json_encode(array("status"=>"1","data"=>$notifications));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No notifications found!","data"=>$notifications)); 
    }
  }
  public function get_my_favourites()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $favourites = array();
    $user_id = @$data->user_id; 
    $lang = @$data->lang;
    if($lang == 'arabic')
    {
      $favourites = $this->db->query("SELECT f.FAVID,p.PRODUCTID,p.catID,p.product_title,p.product_date_string,p.product_price,p.product_duration_ar AS product_duration,p.product_image,u.full_name,(select count(REVIEWID) from reviews WHERE productID = p.PRODUCTID) AS review_count FROM `favourites` AS f, products AS p,users AS u WHERE f.userID = '".$user_id."' AND f.productID = p.PRODUCTID AND p.userID = u.USERID ORDER BY f.`favourites_date` DESC")->result_array();
    }
    else
    {
      $favourites = $this->db->query("SELECT f.FAVID,p.PRODUCTID,p.catID,p.product_title,p.product_date_string,p.product_price,p.product_duration,p.product_duration_ar,p.product_image,u.full_name,(select count(REVIEWID) from reviews WHERE productID = p.PRODUCTID) AS review_count FROM `favourites` AS f, products AS p,users AS u WHERE f.userID = '".$user_id."' AND f.productID = p.PRODUCTID AND p.userID = u.USERID ORDER BY f.`favourites_date` DESC")->result_array();
    }
    if ($favourites){
      echo json_encode(array("status"=>"1","data"=>$favourites));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No favourites found!","data"=>$favourites)); 
    }
  }
  public function remove_favourites()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $fav_id = @$data->fav_id; 
    $remove = $this->db->query("DELETE FROM `favourites` WHERE `FAVID` = '".$fav_id."' AND userID = '".$user_id."'");
    if ($this->db->affected_rows() >0){
      echo json_encode(array("status"=>"1","message"=>"Removed Successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to Remove favourites!")); 
    }
  }
  public function get_my_ads()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $products = array();
    $lang = @$data->lang;
    if($lang == 'arabic')
    {
      $products = $this->db->query("SELECT p.PRODUCTID,p.catID,p.product_title,p.product_date_string,p.product_price,p.product_duration_ar AS product_duration,p.product_image,u.full_name,(select count(REVIEWID) from reviews WHERE productID = p.PRODUCTID) AS review_count FROM  products AS p, users AS u WHERE p.userID = u.USERID AND p.userID = '".$user_id."' ORDER BY p.`product_date` DESC")->result_array();
    }
    else
    {
      $products = $this->db->query("SELECT p.PRODUCTID,p.catID,p.product_title,p.product_date_string,p.product_price,p.product_duration,p.product_duration_ar,p.product_image,u.full_name,(select count(REVIEWID) from reviews WHERE productID = p.PRODUCTID) AS review_count FROM  products AS p, users AS u WHERE p.userID = u.USERID AND p.userID = '".$user_id."' ORDER BY p.`product_date` DESC")->result_array();
    }
    if ($products){
      echo json_encode(array("status"=>"1","data"=>$products));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No products found!","data"=>$products)); 
    }
  }
	public function block_unblock()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id=@$data->user_id;     
    $block_user_id=@$data->block_user_id;  

    $blocked_users = $this->apimodel->get_user($user_id);
    if($blocked_users['blocked_users'])
    {
      $blocked_users = explode(",", $blocked_users['blocked_users']);
      if(in_array($block_user_id, $blocked_users))
      {
      $key=array_search($block_user_id,$blocked_users);
      unset($blocked_users[$key]);
      }
      else
      {
       array_push($blocked_users,$block_user_id);
      }
      $blockedUsersArray["blocked_users"] = implode(',', $blocked_users);
      $update_block_unblock = $this->apimodel->update_user($user_id,$blockedUsersArray);

        echo json_encode(array("status"=>"1","message"=>"Successed."));
      
    }
    else
    {
      $blockedUsersArray["blocked_users"] = $block_user_id;
      $update_likes = $this->apimodel->update_user($user_id,$blockedUsersArray);
        echo json_encode(array("status"=>"1","message"=>"Successed.")); 
    }
  }
  public function get_my_blockList()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $blockList = array();
    $blocked_list = $this->apimodel->get_user($user_id);
    $blockedUsers = implode("','",explode(",", $blocked_list['blocked_users']));
    $blockList = $this->db->query("SELECT u.USERID,u.full_name,u.user_photo,(SELECT count(PRODUCTID) from products WHERE userID = u.USERID) AS total_ads FROM  users AS u WHERE USERID IN('".$blockedUsers."')")->result_array();
    if ($blockList){
      echo json_encode(array("status"=>"1","data"=>$blockList));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No Blocked Users found!","data"=>$blockList)); 
    }
  }
  public function add_followup()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id;
    $product_id = @$data->product_id;
    $favouritesArray = array(
              'userID'=> $user_id,
              'productID'=> $product_id,
              'favourites_date_string'=> date("d M Y"),
              'favourites_date'=> date("Y-m-d H:i:s A")
    );
    $favourites = $this->db->insert('favourites',$favouritesArray);
    if ($favourites){
      echo json_encode(array("status"=>"1","message"=>"Add to favourites successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed Add to favourites!")); 
    }
  }
  public function followup_unfollowup()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id=@$data->user_id;     
    $followup_product_id=@$data->followup_product_id;  

    $followup_users = $this->apimodel->get_user($user_id);
    if($followup_users['followup_products'])
    {
      $followUpusers = explode(",", $followup_users['followup_products']);
      if(in_array($followup_product_id, $followUpusers))
      {
      $key=array_search($followup_product_id,$followUpusers);
      unset($followUpusers[$key]);
      }
      else
      {
       array_push($followUpusers,$followup_product_id);
      }
      $followupUsersArray["followup_products"] = implode(',', $followUpusers);
      $update_followup = $this->apimodel->update_user($user_id,$followupUsersArray);

        echo json_encode(array("status"=>"1","message"=>"Successed."));
      
    }
    else
    {
      $followupUsersArray["followup_products"] = $followup_product_id;
      $update_followup = $this->apimodel->update_user($user_id,$followupUsersArray);
        echo json_encode(array("status"=>"1","message"=>"Successed.")); 
    }
  }
  public function get_my_followup_unfollowup()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $followup = array();
    $followup_list = $this->apimodel->get_user($user_id);
    $followupUsers = implode("','",explode(",", $followup_list['followup_products']));
    $lang = @$data->lang;
    if($lang == 'arabic')
    {
      $followup = $this->db->query("SELECT p.PRODUCTID,p.catID,p.product_date_string,p.product_image,p.product_image_count,p.product_price,p.product_duration_ar AS product_duration,p.userID,p.product_title,u.USERID,u.full_name,u.user_photo,(SELECT count(REVIEWID) FROM `reviews` WHERE `productID` = p.PRODUCTID) AS total_product_reviews FROM  products AS p,users AS u WHERE p.userID = u.USERID AND p.PRODUCTID IN('".$followupUsers."') ORDER BY p.`PRODUCTID` DESC")->result_array();
    }
    else
    {
      $followup = $this->db->query("SELECT p.PRODUCTID,p.catID,p.product_date_string,p.product_image,p.product_image_count,p.product_price,p.product_duration,p.product_duration_ar,p.userID,p.product_title,u.USERID,u.full_name,u.user_photo,(SELECT count(REVIEWID) FROM `reviews` WHERE `productID` = p.PRODUCTID) AS total_product_reviews FROM  products AS p,users AS u WHERE p.userID = u.USERID AND p.PRODUCTID IN('".$followupUsers."') ORDER BY p.`PRODUCTID` DESC")->result_array();
    }
    if ($followup){
      echo json_encode(array("status"=>"1","data"=>$followup));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No Followup Products found!","data"=>$followup)); 
    }
  }
  public function get_me()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $me = array();
    $me = $this->db->query("SELECT u.*,(SELECT COUNT(PRODUCTID) from products WHERE userID = u.USERID) AS total_ads FROM `users` AS u WHERE u.USERID = '".$user_id."'")->row_array();
    if ($me){
      echo json_encode(array("status"=>"1","data"=>$me));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No User not found!","data"=>$me)); 
    }
  }
  public function get_terms_services()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $terms = array();
    $lang = @$data->lang;    
    if($lang == 'arabic')
    {
      $terms = $this->db->query("SELECT TERMID,term_title_ar AS term_title,term_ar AS term,term_create,term_status from terms_services WHERE term_status = 0")->result_array();
    }
    else
    {
      $terms = $this->db->query("SELECT * from terms_services WHERE term_status = 0")->result_array();
    }
    if ($terms){
      echo json_encode(array("status"=>"1","data"=>$terms));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No terms services not found!","data"=>$terms)); 
    }
  }
  public function get_information()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $info = array();
    $info = $this->db->query("SELECT * from information")->row_array();
    if ($info){
      echo json_encode(array("status"=>"1","data"=>$info));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No information not found!","data"=>$info)); 
    }
  }
  public function get_banners()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $banners = array();
    $banners = $this->db->query("SELECT * FROM `banner` WHERE `banner_status` = 0 ORDER BY `banner`.`banner_order` ASC")->result_array();
    if ($banners){
      echo json_encode(array("status"=>"1","data"=>$banners));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No banners not found!","data"=>$banners)); 
    }
  }
  public function report_ads()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $product_id = @$data->product_id;
    $comment = @$data->comment;
    $reportArray = array(
              'userID'=> $user_id,
              'productID'=> $product_id,
              'report_comment'=> $comment,
              'report_time_string'=> date("d M Y"),
              'report_time'=> date("Y-m-d H:i:s A")
    );
    $report = $this->db->insert('reports',$reportArray);
    if ($report){
      echo json_encode(array("status"=>"1","message"=>"Add reported successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to report ad!")); 
    }
  }

  public function nearby()
  {
  	$arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
  	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=26.1616,43.6567&key=AIzaSyB4elPWt2ckWW3aymuIk9ecBhyOaLgQY_I";
    $data = file_get_contents($url, false, stream_context_create($arrContextOptions)); // put the contents of the file into a variable
    // var_dump(json_decode($data));
    $citiesdata = json_decode($data);
    $cities = $citiesdata->results;
    // echo count($cities);
  //   echo "<pre>";
 	// print_r($cities);
 	// echo "</pre>";
  //   echo "<pre>";
 	// print_r($cities->results[0]->address_components[1]->long_name);
 	// echo "</pre>";
	 // if($citiesdata['result']['results']->status!='ZERO_RESULTS')
	 // {
	 // $n=0;
    $citiesNameArray = array();
	 foreach($cities as $key =>$city){
		if(@!in_array(@$city->address_components[1]->long_name, $citiesNameArray) AND @$city->address_components[1]->long_name != NULL)
		{
			array_push($citiesNameArray , @$city->address_components[1]->long_name);
		}
	 // echo @$city->address_components[1]->long_name;
	     // $n=$n+1;
	 }
    // }
    // var_dump($latitudes);
	 var_dump($citiesNameArray);
	 $nearbycity = implode("','", $citiesNameArray);
	 // echo $nearbycity;
	 $getdbcity = $this->db->query("SELECT * FROM `city` WHERE name_en IN('".$nearbycity."') AND city_status = 0")->result_array();
	 // var_dump($getdbcity);
	 $citiesIdArray = array();
	 foreach ($getdbcity as $key => $dbcity) {
	 	// echo $dbcity['CITYID'];
	 	if(@!in_array(@$dbcity['CITYID'], $citiesIdArray))
		{
			array_push($citiesIdArray , @$dbcity['CITYID']);
		}
	 }
	 // var_dump($citiesIdArray);
	 $citiesIds = implode("','", $citiesIdArray);
	 echo $citiesIds;
  }

  public function near()
  {
  	$arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json);
    $latitude = $data->latitude;
    $longtitude = $data->longtitude;
    if($latitude!="" && $longtitude!=""){
     $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$latitude,$longtitude&radius=5000&key=AIzaSyBFffBBAkxKlHcYqWafNgQwmD-pH4JMizk";
     $data = file_get_contents($url, false, stream_context_create($arrContextOptions)); // put the contents of the file into a variable

     $citydata['result']['results'] = json_decode($data);
	     if($citydata['result']['results']->status!='ZERO_RESULTS')
	     {
	     $n=0;
		     foreach($citydata['result'] as $key =>$cityvalue){
		         $latitudes = intval($cityvalue->results[$n]->geometry->location->lat);
		         $longtitudes = intval($cityvalue->results[$n]->geometry->location->lng);
		         $n=$n+1;
		     }
         echo ceil($latitudes / 10) * 10;
         echo ceil($longtitudes / 10) * 10;
         // $number = ceil($input / 10) * 10;
		 }
 	}
  }

  public function user_search_set()
  {
    $brand_id = array();
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $cat_id = @$data->cat_id;
    $catname = @$data->catname;
    $subcat_id = @$data->subcat_id;
    $subcat_name = @$data->subcat_name;
    $brand_id = @$data->brand_id;
    $brands_name = @$data->brands_name;
    $searchArray = array(
              'search_userID'=> $user_id,
              'search_catID'=> $cat_id,
              'search_subcatID'=> $subcat_id,
              'search_catname'=> $catname,
              'search_subcatname'=> $subcat_name,
              'search_brandID'=> @implode(",", $brand_id),
              'search_brandsname'=> @implode(",", $brands_name),
              'search_date'=> date("Y-m-d H:i:s A")
    );
    $search = $this->db->query("SELECT * FROM user_search WHERE search_userID = '".$user_id."'")->result_array();
    if($search)
    {
      $this->db->where('search_userID',$user_id)->update('user_search', $searchArray);
    }
    else
    {
      $addsearch = $this->db->insert('user_search',$searchArray);
    }
    if($this->db->affected_rows() >0){
      echo json_encode(array("status"=>"1","message"=>"search set successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed set search!")); 
    }
  }
  public function user_search_get()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $arraySearch = array();
    $search = $this->db->query("SELECT * FROM user_search WHERE search_userID = '".$user_id."'")->row_array();
    if ($search){
      $brand_idArray = array();
      $brand_nameArray = array();
      $brand_ids = explode(",", $search['search_brandID']);
      $brand_names = explode(",", $search['search_brandsname']);
      for($i=0;$i<count($brand_ids);$i++)
      {
        if(!empty($brand_ids[$i]))
        {
          array_push($brand_idArray,$brand_ids[$i]);
        }
      }
      for($i=0;$i<count($brand_names);$i++)
      {
        if(!empty($brand_names[$i]))
        {
          array_push($brand_nameArray,$brand_names[$i]);
        } 
      }
      array_push($arraySearch, [
        'SEARCHID' =>  $search['SEARCHID'], 
        'search_userID' => $search['search_userID'], 
        'search_catID' => $search['search_catID'], 
        'search_catname' => $search['search_catname'], 
        'search_subcatID' => $search['search_subcatID'], 
        'search_subcatname' => $search['search_subcatname'], 
        'search_brandID' => $brand_idArray, 
        'search_brandsname' => $brand_nameArray, 
        'search_date' => $search['search_date']
      ]);
      echo json_encode(array("status"=>"1","message"=>"success.","data"=>$arraySearch));
    }else{
      echo json_encode(array("status"=>"0","message"=>"No search found!","data"=>$arraySearch)); 
    }
  }
  public function user_search_delete()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user_id = @$data->user_id; 
    $search_id = @$data->search_id; 
    $delete = $this->db->query("DELETE FROM user_search WHERE search_userID = '".$user_id."'");
    if($this->db->affected_rows() >0){
      echo json_encode(array("status"=>"1","message"=>"Search Removed Successfully."));
    }else{
      echo json_encode(array("status"=>"0","message"=>"Failed to Remove Search!")); 
    }
  }
  // public function user_search_update()
  // {
  //   $json = file_get_contents('php://input');
  //   $data = json_decode($json);
  //   $user_id = @$data->user_id; 
  //   $cat_id = @$data->cat_id;
  //   $subcat_id = @$data->subcat_id;
  //   $brand_id = @$data->brand_id;
  //   $search_id = @$data->search_id;
  //   $searchArray = array(
  //             'search_catID'=> $cat_id,
  //             'search_subcatID'=> $subcat_id,
  //             'search_brandID'=> @implode(",", $brand_id),
  //   );
  //   $this->db->where('SEARCHID',$search_id)->update('user_search', $searchArray);
  //   if($this->db->affected_rows() >0){
  //     echo json_encode(array("status"=>"1","message"=>"Search Updated Successfully."));
  //   }else{
  //     echo json_encode(array("status"=>"0","message"=>"Failed to Update Search!")); 
  //   }
  // }
	
}
 ?>