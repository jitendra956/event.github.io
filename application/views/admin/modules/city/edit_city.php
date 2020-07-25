<section class="dashboard-header reviews">
   <div class="container">
         <?php if(@$this->session->flashdata('city_update_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('city_update_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('city_update_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('city_update_f');?></b></div>

         <?php  } ?>
      <div class="form-card reviews">
         <div class="add_category">
            <h4 class="add_name">Edit City</h4>
         </div>
         <form id="cityForm" method="post" action="<?php echo base_url().'admin/cities/update_city'; ?>" enctype="multipart/form-data">
            <input type="hidden" name="cityId" value="<?php echo $city['CITYID']; ?>">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">English Name</label>
                     <input type="text" name="name_en" class="form-control" value="<?php echo $city['name_en']; ?>" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Arabic Name</label>
                     <input type="text" name="name_ar" class="form-control" value="<?php echo $city['name_ar']; ?>" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Latitude</label>
                     <input type="text" name="latitude" class="form-control" value="<?php echo $city['latitude']; ?>" required>                  
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Longitude</label>
                     <input type="text" name="longitude" class="form-control" value="<?php echo $city['longitude']; ?>" required>                  
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
