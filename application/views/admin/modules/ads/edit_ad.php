<section class="dashboard-header reviews">
    <div class="container">
        <?php if(@$this->session->flashdata('ad_update_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('ad_update_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('ad_update_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('ad_update_f');?></b></div>

         <?php } ?>
        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Edit Ad</h4>
            </div>
            <form id="BrandForm" method="post" action="<?php echo base_url(); ?>admin/ads/update_ad" enctype="multipart/form-data">
            <input type="hidden" name="porductID" value="<?php echo $product['PRODUCTID']; ?>">
            <div class="row">
                <!--  <div class="col-md-12 text-center">
                        <div class="avatar-upload">
        <div class="avatar-edit">
            
            <input type="file" name="usernewimg" id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"><i class="fa fa-edit"></i></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url(<?php //if($user['user_photo']){ echo base_url().'uploads/users/'.$user['user_photo']; } else { echo base_url().'/assets/images/users/avatar-1.jpg)'; }  ?>">
            </div>
        </div>
        <label>Profile Image</label>
    </div>
                </div> -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="product_title" value="<?php echo $product['product_title']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Post Date</label>
                        <input type="text" class="form-control" value="<?php echo date('d M Y', strtotime($product['product_date'])); ?>" disabled >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea class="form-control" name="product_description"><?php echo $product['product_description']; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Duration</label>
                        <select class="form-control" name="product_duration">
                        	<option value="Hour" <?php if($product['product_duration'] == 'Hour'){ echo "selected"; } ?>>Hour</option>
                        	<option value="Day" <?php if($product['product_duration'] == 'Day'){ echo "selected"; } ?>>Day</option>
                        	<option value="Week" <?php if($product['product_duration'] == 'Week'){ echo "selected"; } ?>>Week</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input type="number" class="form-control" name="product_price" value="<?php echo $product['product_price']; ?>" >
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