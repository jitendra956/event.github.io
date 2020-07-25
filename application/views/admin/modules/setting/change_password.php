 <section class="dashboard-header">
    <div class="container">
        <div class="form-card">
            <div class="add_category">
                <h4 class="add_name">Change Password</h4>
            </div>
            <?php  if(@$this->session->flashdata("warning")) { ?>
            <div class="alert alert-warning" >
            <?php echo $this->session->flashdata("warning"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("warni")) { ?>
            <div class="alert alert-warning" >
            <?php echo $this->session->flashdata("warni"); ?>
            </div>
            <?php } ?>

             <?php  if(@$this->session->flashdata("message")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("message"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("warn")) { ?>
            <div class="alert alert-warning" >
            <?php echo $this->session->flashdata("warn"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("wa")) { ?>
            <div class="alert alert-warning" >
            <?php echo $this->session->flashdata("wa"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("su")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("su"); ?>
            </div>
            <?php } ?>
            <form action="<?php echo base_url(); ?>admin/setting/change" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Old Password</label>
                            <input type="Password" name="oldp" id="oldp" class="form-control" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">New Password</label>
                            <input type="Password" name="newp" id="newp" class="form-control" placeholder="New Password">
                        </div>
                    </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Confirm Password</label>
                            <input type="Password" name="conp" id="conp" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="update_pass" class="View-btn btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
  
                         