<section class="dashboard-header">
    <div class="container">
        <div class="form-card">
            <div class="add_category">
                <h4 class="add_name">Information</h4>
            </div>
            <?php  if(@$this->session->flashdata("update_information_f")) { ?>
            <div class="alert alert-warning" >
            <?php echo $this->session->flashdata("update_information_f"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("update_information_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("update_information_s"); ?>
            </div>
            <?php } ?>
            <form action="<?php echo base_url(); ?>admin/information/update_information" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Site Name</label>
                            <input type="text" class="form-control" name="site_name" value="<?php echo $information['site_name']; ?>" required >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Site Mail</label>
                            <input type="text" class="form-control" name="site_mail" value="<?php echo $information['site_mail']; ?>" required >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Site Support Mail</label>
                            <input type="text" class="form-control" name="site_support_mail" value="<?php echo $information['site_support_mail']; ?>" required >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Site Contact</label>
                            <input type="text" class="form-control" name="site_contact" value="<?php echo $information['site_contact']; ?>" required >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Site Address</label>
                            <textarea class="form-control" name="site_address" required><?php echo $information['site_address']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <center><button type="submit" class="View-btn btn">Save</button></center>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>