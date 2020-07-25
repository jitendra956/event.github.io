<section class="dashboard-header">
    <div class="container">
        <div class="form-card">
            <div class="add_category">
                <h4 class="add_name">Setting</h4>
            </div>
            <?php  if(@$this->session->flashdata("update_f")) { ?>
            <div class="alert alert-warning" >
            <?php echo $this->session->flashdata("update_f"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("update_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("update_s"); ?>
            </div>
            <?php } ?>
            <form action="<?php echo base_url(); ?>admin/setting/update_settings" method="post">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Change Logo</label>
                            <input type="file" class="form-control" id="name" placeholder="Category name">
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Admin Email</label>
                            <input type="email" class="form-control" name="admin_email" id="admin_email" placeholder="Admin Email" value="<?php echo $settings['admin_email']; ?>" required >
                        </div>
                    </div>
                    <hr>
                    <div class="add_category">
                        <h4 class="add_name">SMTP Setting</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">SMTP Host</label>
                            <input type="text" class="form-control" name="smtp_host" id="smtp_host" placeholder="SMTP Host" value="<?php echo $settings['smtp_host']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">SMTP Port</label>
                            <input type="text" class="form-control" name="smtp_port" id="smtp_port" placeholder="SMTP Port" value="<?php echo $settings['smtp_port']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">SMTP Username</label>
                            <input type="text" class="form-control" name="smtp_username" id="smtp_username" placeholder="SMTP Username" value="<?php echo $settings['smtp_username']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">SMTP Password</label>
                            <input type="password" class="form-control" name="smtp_password" id="smtp_password" placeholder="SMTP Password" value="<?php echo $settings['smtp_password']; ?>" required>
                        </div>
                    </div>
                    <hr>
                    <div class="add_category">
                        <h4 class="add_name">AD's Setting</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Ads Auto Approval</label>
                            <select class="form-control" name="ads_approval" required>
                                <option selected disabled value>Select One</option>
                                <option value="Disable" <?php if($settings['ads_approval'] == 'Disable'){ echo 'selected'; } ?>>Disable</option>
                                <option value="Enable" <?php if($settings['ads_approval'] == 'Enable'){ echo 'selected'; } ?>>Enable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Max Image Upload</label>
                            <input type="number" class="form-control" name="ads_max_image_limit" id="ads_max_image_limit" placeholder="" value="<?php echo $settings['ads_max_image_limit']; ?>" required>
                        </div>
                    </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Add Expiry (Days)</label>
                            <input type="number" class="form-control"  name="ads_expiry" id="ads_expiry" placeholder="Days" value="<?php echo $settings['ads_expiry']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Privacy Policy</label>
                            <textarea class="form-control" name="privacy_policy" id="privacy_policy" placeholder="Privacy Policy" required><?php echo $settings['privacy_policy']; ?></textarea>
                        </div>
                    </div>
                </div>
				<style>
				.note-editor .note-toolbar>.note-btn-group, .note-popover .popover-content>.note-btn-group {
    width: auto;
}

.note-editor .note-btn-group .note-btn {
    color: #000;
}

.note-editor .note-toolbar .note-color .dropdown-toggle, .note-popover .popover-content .note-color .dropdown-toggle {
    width: auto;
}
ul.note-dropdown-menu.dropdown-menu.note-check.dropdown-fontname.show a {
    color: #000;
}
				</style>
                <div class="row">
                    <div class="col-12">
                        <center><button type="submit" class="View-btn btn">Save</button></center>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

