<section class="dashboard-header reviews">
    <div class="container">
        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Features Ads</h4>
            </div>
            <?php  if(@$this->session->flashdata("product_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("product_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("product_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("product_delete_f"); ?>
            </div>
            <?php } ?>
            
           <button class="btn-danger btn" id="deleteAllads">Delete Selected Items</button>
        </div>
         
        <?php //var_dump($ads); ?>
        <div class="form-card reviews">
            <div class="table-responsive p-t-20">
                 <select class="form-control bulk-select"><option selected disabled value>Bulk Action</option>
                         <option>Delete All</option>
                         <option>Select All</option>
                         
                </select>
                <table id="example" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectall" />
                            </th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Posted</th>
                            <th>Verified</th>
                            <th>Features</th>
                            <th>Status</th>
                            <th style="display: block!important;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(@!empty($ads))
                        {
                            foreach ($ads as $ad) {
                            ?>
                            <tr>
                            <td>
                                <input type="checkbox" class="selectedId" name="selectedId" value="<?php echo $ad['PRODUCTID']; ?>" />
                            </td>
                            <td><?php echo $ad['PRODUCTID']; ?></td>
                            <td>
                                <div class="title-div">
                                    <div class="title-div-img">
                                        <img src="<?php echo base_url();?>uploads/products/<?php if($ad['product_image']){ echo  $ad['product_image']; } else { echo 'No_image_available.png'; } ?>">
                                    </div>
                                    <div class="title-div-cont">
                                        <p><?php echo $ad['product_title']; ?></p>
                                        <span><?php echo $ad['name_en']; ?></span>
                                    </div>
                                </div>
                            </td>
                            
                            <td><?php echo $ad['email']; ?></td>
                            <td><?php
                                if($ad['stateID'] == 0)
                                {
                                    echo "No City";
                                }
                                else
                                {
                                    $city = $this->admin_panel_model->get_single_city($ad['stateID']);
                                    echo $city['name_en'];
                                    // echo $ad['stateID'];
                                    // var_dump($city);
                                }
                                ?></td>
                            <td><?php echo date('d/m/Y', strtotime($ad['product_date'])); ?></td>

                            <td>
                                <label class="toggle">
                                    <input class="toggle-checkbox" type="checkbox" name="product_status_change" value="<?php echo $ad['PRODUCTID']; ?>" <?php if($ad['product_status'] == 0){ echo 'checked'; } ?>>
                                    <div class="toggle-switch"></div>
                                </label>
                            </td>
                            <td>
                                <label class="toggle">
                                    <input class="toggle-checkbox" type="checkbox" name="product_features" value="<?php echo $ad['PRODUCTID']; ?>" <?php if($ad['product_features'] == 1){ echo 'checked'; } ?>>
                                    <div class="toggle-switch"></div>
                                </label>
                            </td>
                            <td>
                                <?php if($ad['product_status'] == 0){ echo '<span class="badge badge-success">Approved</span>'; }else { echo '<span class="badge badge-warning">Pending</span>'; } ?>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <!-- <td><a href="#" class="approved-btn">Approved</a>
                                        </td> -->
                                        <td> <a href="edit-ads/<?php echo $ad['PRODUCTID']; ?>" class="edit-btn">Edit</a>
                                        </td>
                                        <td> <button class="delete-btn delete_product" value="<?php echo $ad['PRODUCTID']; ?>">Delete</button>
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