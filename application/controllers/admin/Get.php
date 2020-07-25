<?php
class Get extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->load->model('admin_panel_model');    
}
    public function get_categories()
    {           
        $categories = $this->admin_panel_model->get_categories();
        $categories_str = '';
        foreach ($categories as $category) {
            $categories_str .= '<option value="'.$category["CATID"].'"">'.$category["category_name"].'</option>';
        }
    // encoding array to json format
    echo $categories_str;
    }
    public function get_categoriesJSON()
    {           
        $pcatid = $this->input->post('pcatid');
        $categories = $this->admin_panel_model->get_sub_categories($pcatid);
        $categories_arr = array();
        foreach ($categories as $category) {
                $CATID = $category['CATID'];
                $category_name = $category['category_name'];

            $categories_arr[] = array("id" => $CATID, "name" => $category_name);
        }
    // encoding array to json format
    echo json_encode($categories_arr);
    }
   
}

?>
