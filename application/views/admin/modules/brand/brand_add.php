<section class="dashboard-header reviews">
    <div class="container">
        <?php if(@$this->session->flashdata('brand_add_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('brand_add_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('brand_add_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('brand_add_f');?></b></div>

         <?php } ?>

        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Add a New Brand</h4>
            </div>
            
            <form id="BrandForm" method="post" action="<?php echo base_url(); ?>admin/brand/insert_brand" enctype="multipart/form-data">
            <div class="row">
                 <div class="col-md-12 text-center">
                        <div class="avatar-upload">
        <div class="avatar-edit">
            <input type="file" name="brandlogo" id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"><i class="fa fa-edit"></i></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url(<?php echo base_url(); ?>assets/images/logo-sm.png);">
            </div>
        </div>
        <label>Upload Logo</label>
    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Category</label>
                        <select class="form-control required" name="brandcat_id" id="brandcat_id">
                            <option value selected disabled>Select Category</option> 
                            <?php 
                           if(@!empty($categories))
                           {
                               foreach ($categories as $category) 
                               {
                                   ?>
                              <option value="<?php echo $category['CATID']; ?>"><?php echo $category['category_name']; ?></option>
                            <?php
                               }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Sub-Category</label>
                       <select class="form-control required" name="brandsubcat_id" id="brandsubcat_id">
                        <option value selected disabled>Select</option> 
                           
                        </select>
                    </div>
                </div>
               
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Brand Name</label>
                        <input type="text" class="form-control" name="brandname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Brand Arabic Name</label>
                        <input type="text" class="form-control" name="brandname_ar">
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