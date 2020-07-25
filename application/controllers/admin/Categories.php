<?php
class Categories extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'categories';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['categories'] = $this->admin_panel_model->get_categories();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
	public function sub_category()
	{   
		$id = $this->uri->segment(2);
        $this->data['page'] = 'sub_category';
        $this->data['categories'] = $this->admin_panel_model->get_sub_categories($id);        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
	public function category_add()
	{         	
        $this->data['page'] = 'category_add';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
	public function sub_category_add()
	{         	
        $this->data['page'] = 'sub_category_add';
        $this->data['categories'] = $this->admin_panel_model->get_categories();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
	public function add_category()
	{         	
        $cat_icon=isset($_FILES['icon_image']) && $_FILES["icon_image"]["error"] == 0;
		if($cat_icon)
		{
			$file_name     	= 	$_FILES['icon_image']['name'];

			$file_type     	= 	$_FILES['icon_image']['type'];

			$tmp_name 		= 	$_FILES['icon_image']['tmp_name'];

			$error	     	= 	$_FILES['icon_image']['error'];

			$file_size     	= 	$_FILES['icon_image']['size'];

			$file_ext   	= 	explode('.',$file_name);

			$ext			=	strtolower(end($file_ext));

			$_icon_image		=	'category-'.uniqid().'.'.$ext;

			$store='uploads/categories/'.$_icon_image;

			if(move_uploaded_file($tmp_name,$store))
			{
				$cat_icon = $_icon_image;
			}
			else
			{
				$cat_icon = "";
			}

			if($this->input->post('status'))
			{
				$status = 0;
			}
			else
			{
				$status = 1;
			}
			$cat_count = $this->admin_panel_model->get_categories();
			$arraysubcat = array(
				'category_name' => $this->input->post('subcatname'), 
				'category_name_ar' => $this->input->post('subcatname_ar'), 
				'category_parent' => 0, 
				'category_order' => count($cat_count)+1, 
				'category_image' => $cat_icon, 
				'category_description' => $this->input->post('desc'), 
				'category_created_date' =>date("Y-m-d h:i:s A"), 
				'category_status' =>$status 
			);
			$add_subcategory = $this->admin_panel_model->insert_category($arraysubcat);
			if($add_subcategory){
				 $this->session->set_flashdata('subcat_add_s','Sub-Category Add Sucessfully.');
			}
			else{
				 $this->session->set_flashdata('subcat_add_f','Failed to Add Sub-Category!');
			}
			redirect (base_url().'add-categories');
	    }
    }
    public function add_subcategory()
	{         	
        $cat_icon=isset($_FILES['icon_image']) && $_FILES["icon_image"]["error"] == 0;
		if($cat_icon)
		{
			$file_name     	= 	$_FILES['icon_image']['name'];

			$file_type     	= 	$_FILES['icon_image']['type'];

			$tmp_name 		= 	$_FILES['icon_image']['tmp_name'];

			$error	     	= 	$_FILES['icon_image']['error'];

			$file_size     	= 	$_FILES['icon_image']['size'];

			$file_ext   	= 	explode('.',$file_name);

			$ext			=	strtolower(end($file_ext));

			$_icon_image		=	'subcategory-'.uniqid().'.'.$ext;

			$store='uploads/categories/'.$_icon_image;

			if(move_uploaded_file($tmp_name,$store))
			{
				$cat_icon = $_icon_image;
			}
			else
			{
				$cat_icon = "";
			}

			if($this->input->post('status'))
			{
				$status = 0;
			}
			else
			{
				$status = 1;
			}

			$arraysubcat = array(
				'category_name' => $this->input->post('subcatname'), 
				'category_name_ar' => $this->input->post('subcatname_ar'),
				'category_parent' => $this->input->post('subcat'), 
				'category_image' => $cat_icon, 
				'category_description' => $this->input->post('desc'), 
				'category_created_date' =>date("Y-m-d h:i:s A"), 
				'category_status' =>$status 
			);
			$add_subcategory = $this->admin_panel_model->insert_category($arraysubcat);
			if($add_subcategory){
				 $this->session->set_flashdata('subcat_add_s','Sub-Category Add Sucessfully.');
			}
			else{
				 $this->session->set_flashdata('subcat_add_f','Failed to Add Sub-Category!');
			}
			redirect (base_url().'add-sub-categories');
	    }
    }
	public function category_update_status()
	{        
		$catid = $this->input->post('catid'); 	
		$category = $this->admin_panel_model->get_single_category($catid);
		if($category)
		{
			if($category["category_status"] == 0){
				$status = 1;
			}
			else{
				$status = 0;
			}
			$categoryArray = array('category_status' => $status);
			$category_update = $this->admin_panel_model->update_categories($catid,$categoryArray);
			if($category_update)
			{
				echo json_encode(array('status'=>'true','message'=>'Category Status Changed.','title'=>'Success.','type'=>'success'));
			}
			else
			{
				echo json_encode(array('status'=>'failed','message'=>'Category Status can not Changed!','title'=>'Warning!','type'=>'warning'));
			}

		}
		else
		{
			echo json_encode(array('status'=>'failed','message'=>'Failed to Change status!','title'=>'Failed!.','type'=>'danger'));
		}
	}
	public function category_delete()
    {           
        $category_id = $this->input->post('delete_category_id');
        $category_delete = $this->admin_panel_model->category_delete($category_id); 
        if($category_delete)
        {
            $this->session->set_flashdata("category_delete_s","Category Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("category_delete_f","Failed to Delete Category!");
        }
        redirect(base_url('categories'));       
      
    }
    public function edit_category()
    {      
    	$category_id = $this->uri->segment(2);     
        $this->data['category'] = $this->admin_panel_model->get_single_category($category_id); 
        $this->data['page'] = 'edit_category';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');   
    }
    public function edit_sub_category()
    {      
    	$category_id = $this->uri->segment(2);     
    	$this->data['categories'] = $this->admin_panel_model->get_categories();
        $this->data['sub_category'] = $this->admin_panel_model->get_single_category($category_id); 
        $this->data['page'] = 'edit_sub_category';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');   
    }
    public function update_category()
    {      
    	$catid = $this->input->post('catID');
    	$newimage=isset($_FILES['newcatimg']) && $_FILES["newcatimg"]["error"] == 0;
    	if($newimage)
    	{
    		$file_name     	= 	$_FILES['newcatimg']['name'];

			$file_type     	= 	$_FILES['newcatimg']['type'];

			$tmp_name 		= 	$_FILES['newcatimg']['tmp_name'];

			$error	     	= 	$_FILES['newcatimg']['error'];

			$file_size     	= 	$_FILES['newcatimg']['size'];

			$file_ext   	= 	explode('.',$file_name);

			$ext			=	strtolower(end($file_ext));

			$new_image_name		=	'category-'.uniqid().'.'.$ext;

			$store='uploads/categories/'.$new_image_name;
			if(move_uploaded_file($tmp_name,$store))
			{
				$new_cat_image = $new_image_name;
			}
			else
			{
				$new_cat_image = "";
			}
    	}
    	else
    	{
    		$new_cat_image = $this->input->post('oldcatimg');
    	}
    	$updatecatArray = array(
				'category_name' => $this->input->post('subcatname'), 
				'category_name_ar' => $this->input->post('subcatname_ar'),
				'category_image' => $new_cat_image, 
				'category_description' => $this->input->post('desc'), 
				'category_order' => $this->input->post('category_order'), 
				'category_status' =>$this->input->post('status')
			);
		$category_update = $this->admin_panel_model->update_categories($catid,$updatecatArray);
    	if($category_update)
        {
            $this->session->set_flashdata("cat_update_s","Category Updated Successfully.");
        }
        else
        {
            $this->session->set_flashdata("cat_update_f","Failed to Update Category!");
        }
        redirect(base_url('edit-category/'.$catid));
    }
    public function update_subcategory()
    {      
    	$catid = $this->input->post('subcatID');
    	$newimage=isset($_FILES['newsubcatimg']) && $_FILES["newsubcatimg"]["error"] == 0;
    	if($newimage)
    	{
    		$file_name     	= 	$_FILES['newsubcatimg']['name'];

			$file_type     	= 	$_FILES['newsubcatimg']['type'];

			$tmp_name 		= 	$_FILES['newsubcatimg']['tmp_name'];

			$error	     	= 	$_FILES['newsubcatimg']['error'];

			$file_size     	= 	$_FILES['newcatimg']['size'];

			$file_ext   	= 	explode('.',$file_name);

			$ext			=	strtolower(end($file_ext));

			$new_image_name		=	'sub-category-'.uniqid().'.'.$ext;

			$store='uploads/categories/'.$new_image_name;
			if(move_uploaded_file($tmp_name,$store))
			{
				$new_cat_image = $new_image_name;
			}
			else
			{
				$new_cat_image = "";
			}
    	}
    	else
    	{
    		$new_cat_image = $this->input->post('oldsubcatimg');
    	}
    	$updatecatArray = array(
				'category_name' => $this->input->post('subcatname'), 
				'category_name_ar' => $this->input->post('subcatname_ar'),
				'category_image' => $new_cat_image, 
				'category_parent' => $this->input->post('parent_cat'),
				'category_description' => $this->input->post('desc'), 
				'category_status' =>$this->input->post('status')
			);
		$category_update = $this->admin_panel_model->update_categories($catid,$updatecatArray);
    	if($category_update)
        {
            $this->session->set_flashdata("subcat_update_s","Sub-Category Updated Successfully.");
        }
        else
        {
            $this->session->set_flashdata("subcat_update_f","Failed to Update Sub-Category!");
        }
        redirect(base_url('edit-sub-category/'.$catid));
    }
    public function multiCategories_delete()
    {   
        $ids =  $this->input->post('checkbox_value');
        $delete_categories = $this->admin_panel_model->multiple_delete_categories($ids);     
        if($delete_categories)
        {
            echo json_encode(array('status'=>'true','message'=>"Categories deleted Successfully.",'title'=>'Success.','type'=>'success'));
        }
        else
        {
             echo json_encode(array('status'=>'failed','message'=>"Failed to delete Categories !",'title'=>'Warning!','type'=>'warning'));
        }
    }
   
   
}

?>
