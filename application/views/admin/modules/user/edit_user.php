<section class="dashboard-header reviews">
    <div class="container">
        <?php if(@$this->session->flashdata('user_update_s')) {  ?>

         <div class="alert alert-success"><b><?php echo $this->session->flashdata('user_update_s');?></b></div>

         <?php  } ?>
         <?php if(@$this->session->flashdata('user_update_f')) {  ?>

         <div class="alert alert-danger"><b><?php echo $this->session->flashdata('user_update_f');?></b></div>

         <?php } ?>
        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Edit User</h4>
            </div>
            <form id="BrandForm" method="post" action="<?php echo base_url(); ?>admin/user/update_user" enctype="multipart/form-data">
            <div class="row">
                 <div class="col-md-12 text-center">
                        <div class="avatar-upload">
        <div class="avatar-edit">
            <input type="hidden" name="userID" value="<?php echo $user['USERID']; ?>">
            <input type="hidden" name="useroldimg" value="<?php echo $user['user_photo']; ?>">
            <input type="file" name="usernewimg" id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"><i class="fa fa-edit"></i></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url(<?php if($user['user_photo']){ echo base_url().'uploads/users/'.$user['user_photo']; } else { echo base_url().'/assets/images/users/avatar-1.jpg)'; }  ?>">
            </div>
        </div>
        <label>Profile Image</label>
    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="full_name" value="<?php echo $user['full_name']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Member From</label>
                        <input type="text" class="form-control" value="<?php echo date('d M Y', strtotime($user['created_on'])); ?>" disabled >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Email</label>
                       <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="text" class="form-control" name="password" value="<?php echo @$this->encrypt->decode($user['password']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Number</label>
                        <input type="text" class="form-control" name="country_code" value="<?php echo $user['country_code']; ?>">
                        <input type="text" class="form-control" name="contact" value="<?php echo $user['contact']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Last Login</label>
                       <input type="text" class="form-control" value="<?php if($user['last_login']){ echo date('d M Y H:s A', strtotime($user['last_login'])); } else{ echo 'Not Login Yet.'; } ?>" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">About</label>
                        <textarea class="form-control" name="about"><?php echo $user['user_about']; ?></textarea>
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