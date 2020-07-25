<section class="dashboard-header reviews">
   <div class="container">
         <?php if(@$this->session->flashdata('term_update_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('term_update_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('term_update_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('term_update_f');?></b></div>

         <?php  } ?>
      <div class="form-card reviews">
         <div class="add_category">
            <h4 class="add_name">Edit Term</h4>
         </div>
         <form id="termForm" method="post" action="<?php echo base_url().'admin/terms/update_term'; ?>" enctype="multipart/form-data">
            <input type="hidden" name="termId" value="<?php echo $term['TERMID']; ?>">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Title English</label>
                     <input type="text" name="title_en" class="form-control" value="<?php echo $term['term_title']; ?>" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Title Arabic</label>
                     <input type="text" name="title_ar" class="form-control" value="<?php echo $term['term_title_ar']; ?>" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Term English</label>
                     <textarea name="term_en" class="form-control" required><?php echo $term['term']; ?></textarea>                  
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="icon">Term Arabic</label>
                     <textarea name="term_ar" class="form-control" required><?php echo $term['term_ar']; ?></textarea>
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
