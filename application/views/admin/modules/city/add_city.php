<section class="dashboard-header reviews">
   <div class="container">

         <?php if(@$this->session->flashdata('city_add_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('city_add_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('city_add_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('city_add_f');?></b></div>

         <?php  } ?>
      <div class="form-card reviews">
         <div class="add_category">
            <h4 class="add_name">Add a New City</h4>
         </div>
         <form id="cityForm" method="post" action="<?php echo base_url().'admin/cities/insert_city'; ?>" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">English Name</label>
                     <input type="text" name="name_en" class="form-control" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Arabic Name</label>
                     <input type="text" name="name_ar" class="form-control" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Latitude</label>
                     <input type="text" name="latitude" class="form-control" required>                  
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Longitude</label>
                     <input type="text" name="longitude" class="form-control" required>                  
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
