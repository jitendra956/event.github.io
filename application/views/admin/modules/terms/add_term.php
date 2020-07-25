<section class="dashboard-header reviews">
   <div class="container">

         <?php if(@$this->session->flashdata('term_add_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('term_add_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('term_add_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('term_add_f');?></b></div>

         <?php  } ?>
      <div class="form-card reviews">
         <div class="add_category">
            <h4 class="add_name">Add a New Term</h4>
         </div>
         <form id="termForm" method="post" action="<?php echo base_url().'admin/terms/insert_term'; ?>" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Title English</label>
                     <input type="text" name="title_en" class="form-control" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Title Arabic</label>
                     <input type="text" name="title_ar" class="form-control" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Term English</label>
                     <textarea name="term_en" class="form-control" required></textarea>                  
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Term Arabic</label>
                     <textarea name="term_ar" class="form-control" required></textarea>
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
