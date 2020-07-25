<section class="dashboard-header reviews">
   <div class="container">

         <?php if(@$this->session->flashdata('subcat_update_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('subcat_update_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('subcat_update_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('subcat_update_f');?></b></div>

         <?php  } ?>
      <div class="form-card reviews">
         <div class="add_category">
            <h4 class="add_name">Edit Sub-Category</h4>
         </div>
         <form id="subCategoryForm" method="post" action="<?php echo base_url().'admin/Categories/update_subcategory'; ?>" enctype="multipart/form-data">
            <input type="hidden" name="subcatID" value="<?php echo $sub_category['CATID']; ?>">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="name">Category</label>
                     <select class="form-control" name="parent_cat">
                        <option value selected disabled>Select</option>
                        <?php 
                           if(@!empty($categories))
                           {
                               foreach ($categories as $category) 
                               {
                                   ?>
                              <option value="<?php echo $category['CATID']; ?>" <?php if($category['CATID'] == $sub_category['category_parent']){ echo "selected"; } ?>><?php echo $category['category_name']; ?></option>
                        <?php
                           }
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Sub-Category Name</label>
                     <input type="text" name="subcatname" class="form-control" placeholder="" value="<?php echo $sub_category['category_name']; ?>">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Sub-Category Name</label>
                     <input type="text" name="subcatname_ar" class="form-control" placeholder="" value="<?php echo $sub_category['category_name_ar']; ?>">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="name">Description</label>
                     <textarea class="form-control" rows="5" name="desc"><?php echo $sub_category['category_description']; ?></textarea>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Ordering</label>
                     <input type="text" name="order" class="form-control" id="icon">                  
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Attach Icon</label>
                     <input type="hidden" name="oldsubcatimg" value="<?php echo $sub_category['category_image']; ?>">
                     <input type="file" name="newsubcatimg" class="form-control" id="icon">                  
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="icon">Active</label>
                     <label class="toggle">
                        <input class="toggle-checkbox" name="status" type="checkbox" <?php if($sub_category['category_status'] == 0){ echo 'checked'; } ?>>
                        <div class="toggle-switch"></div>
                     </label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-center">
                  <button type="submit" class="View-btn">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>