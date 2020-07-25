<section class="dashboard-header reviews">
    <div class="container">
       <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Banner</h4>
            </div>
           <a href="<?php echo base_url(); ?>add-banner"><button class="btn-primary btn">Add Banner</button></a>&nbsp;
           <?php  if(@$this->session->flashdata("banner_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("banner_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("banner_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("banner_delete_f"); ?>
            </div>
            <?php } ?>
        </div>
        <div class="form-card reviews mt-40">
          <div class="table-responsive p-t-20">
                <table id="example" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO.</th>
                            <th>Image</th>
                            <th>Url</th>
                            <th>Ordering</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        if(@!empty($banners))
                        {
                            foreach ($banners as $banner) { 
                            ?>
                            <tr>
                            <td><?php echo $banner['BANNERID']; ?></td>
                            <td><img style="width: 100px; height: 100px;" src="<?php echo base_url().'uploads/banner/'.$banner["banner_image"]; ?>" title="<?php echo $banner['banner_image']; ?>-image">
                            </td>
                            <td><?php echo $banner['banner_url']; ?></td>
                            <td><?php echo $banner['banner_order']; ?></td>
                            <td>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id="cat_checkbox-<?php echo $banner['BANNERID']; ?>" type="checkbox" value="<?php echo $banner['BANNERID']; ?>" name="banner_checkbox" <?php if($banner['banner_status'] == 0){ echo 'checked'; } ?>>
                                    <div class="toggle-switch"></div>
                                </label>
                            </td>
                            <td align="center">
                                <table>
                                    <tr>
                                        <td> <button class="delete-btn delete_banner" value="<?php echo $banner['BANNERID']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                             <?php  
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
</section>