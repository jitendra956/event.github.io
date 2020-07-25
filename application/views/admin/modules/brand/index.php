<section class="dashboard-header reviews">
    <div class="container">
       <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Brand</h4>
            </div>
            <?php  if(@$this->session->flashdata("brand_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("brand_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("brand_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("brand_delete_f"); ?>
            </div>
            <?php } ?>
           <a href="<?php echo base_url(); ?>add-brand"><button class="btn-primary btn">Add New Brand</button></a>&nbsp;
            <button class="btn-danger btn" id="deleteAllbrand">Delete Selected Items</button>
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
                             <th>Logo</th>
                            <th>Ordering</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(@!empty($brands))
                        {
                            foreach ($brands as $brand) 
                            {
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="selectedId" name="selectedId" value="<?php echo $brand['BRANDID']; ?>" />
                                    </td>
                                    <td><?php echo $brand['brand_name']; ?></td>
                                    <td><?php echo $brand['brand_name_ar']; ?></td>
                                    <td><img  height="50%" src="<?php base_url(); ?>uploads/brands/<?php if($brand['brand_image']){ echo $brand['brand_image']; } else { echo 'favicon.ico'; } ?>"></td>
                                    <td><input type="text" class="form-control" name=""></td>

                                    <td align="center">
                                        <table>
                                            <tr>
                                                <td> <a href="<?php echo base_url().'edit-brand/'.$brand['BRANDID']; ?>" id="edit-btn-<?php echo $brand['BRANDID']; ?>" class="edit-btn">Edit</a>
                                                </td>
                                                    <button class="delete-btn delete_brand" value="<?php echo $brand['BRANDID']; ?>">Delete</button>
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