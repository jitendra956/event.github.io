<section class="dashboard-header reviews">
   <div class="container">

         <?php if(@$this->session->flashdata('banner_add_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('banner_add_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('banner_add_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('banner_add_f');?></b></div>

         <?php  } ?>
      <div class="form-card reviews">
         <div class="add_category">
            <h4 class="add_name">Add a New Banner</h4>
         </div>
         <form id="subCategoryForm" method="post" action="<?php echo base_url().'admin/banner/insert_banner'; ?>" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Ordering</label>
                     <input type="text" name="order" class="form-control" value="<?php echo count($banners)+1; ?>" required>                  
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Attach Icon</label>
                     <input type="file" name="banner_image" class="form-control" id="icon" required>                  
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="icon">Banner Url</label>
                        <input type="text" name="banner_url" class="form-control">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="icon">Active</label>
                     <label class="toggle">
                        <input class="toggle-checkbox" name="status" type="checkbox" checked>
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