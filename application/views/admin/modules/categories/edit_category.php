<section class="dashboard-header reviews">
   <div class="container">

         <?php if(@$this->session->flashdata('cat_update_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('cat_update_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('cat_update_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('cat_update_f');?></b></div>

         <?php  } ?>
      <div class="form-card reviews">
         <div class="add_category">
            <h4 class="add_name">Edit Category</h4>
         </div>
         <form id="subCategoryForm" method="post" action="<?php echo base_url().'admin/Categories/update_category'; ?>" enctype="multipart/form-data">
            <input type="hidden" name="catID" value="<?php echo $category['CATID']; ?>">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="name">Category Name</label>
                     <input type="text" name="subcatname" class="form-control" placeholder="" value="<?php echo $category['category_name']; ?>">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="name">Category Arabic Name</label>
                     <input type="text" name="subcatname_ar" class="form-control" placeholder="" value="<?php echo $category['category_name_ar']; ?>">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="name">Description</label>
                     <textarea class="form-control" rows="5" name="desc"><?php echo $category['category_description']; ?></textarea>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Ordering</label>
                     <input type="number" name="category_order" class="form-control" value="<?php echo $category['category_order']; ?>">                  
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Attach Icon</label>
                     <input type="hidden" name="oldcatimg" value="<?php echo $category['category_image']; ?>">
                     <input type="file" name="newcatimg" class="form-control" id="icon">                  
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="icon">Active</label>
                     <label class="toggle">
                        <input class="toggle-checkbox" name="status" type="checkbox" <?php if($category['category_status'] == 0){ echo 'checked'; } ?>>
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