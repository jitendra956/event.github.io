<section class="dashboard-header reviews">
    <div class="container">
       <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Categories</h4>
            </div>
           <a href="<?php echo base_url(); ?>add-categories"><button class="btn-primary btn">Add Category</button></a>&nbsp;
           <a href="<?php echo base_url(); ?>add-sub-categories"><button class="btn-info btn">Add Sub-Category</button></a>&nbsp;
           <?php  if(@$this->session->flashdata("category_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("category_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("category_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("category_delete_f"); ?>
            </div>
            <?php } ?>
            <button class="btn-danger btn" id="deleteAllcategories">Delete Selected Items</button>
        </div>
        <div class="form-card reviews mt-40">
          <div class="table-responsive p-t-20">
                <table id="example" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectall" />
                            </th>
                            <th>Name</th>
                            <th>Arabic Name</th>
                            <th>Image</th>
                            <th>Ordering</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        if(@!empty($categories))
                        {
                            foreach ($categories as $category) { 
                            ?>
                            <tr>
                            <td>
                                <input type="checkbox" class="selectedId" name="selectedId" value="<?php echo $category['CATID']; ?>" />
                            </td>
                            <td><?php echo $category['category_name']; ?></td>
                            <td><?php echo $category['category_name_ar']; ?></td>
                            <td><img style="width: 20%; height: 20%;" src="<?php echo base_url().'uploads/categories/'.$category["category_image"]; ?>" title="<?php echo $category['category_name']; ?>-image">
                            </td>
                            <td><?php echo $category['category_order']; ?></td>
                            <td>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id="cat_checkbox-<?php echo $category['CATID']; ?>" type="checkbox" value="<?php echo $category['CATID']; ?>" name="cat_checkbox" <?php if($category['category_status'] == 0){ echo 'checked'; } ?>>
                                    <div class="toggle-switch"></div>
                                </label>
                            </td>
                            <td align="center">
                                <table>
                                    <tr>
                                       <td> <a href="<?php echo base_url().'sub-categories/'.$category['CATID']; ?>" class="edit-btn">Sub-categories</a>
                                        </td>
                                        <td> <a href="<?php echo base_url().'edit-category/'.$category['CATID']; ?>" class="edit-btn">Edit</a>
                                        </td>
                                        <td> <button class="delete-btn delete_category" value="<?php echo $category['CATID']; ?>">Delete</button>
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