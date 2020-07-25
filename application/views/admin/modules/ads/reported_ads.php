<section class="dashboard-header reviews">
    <div class="container">
        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Reported Ads</h4>
            </div>
           <button class="btn-danger btn" id="deleteAllads">Delete Selected Items</button>
        </div>
        
        <?php
         // var_dump($reports); 
        ?>
        <div class="form-card reviews">
            <div class="table-responsive p-t-20">
                <!--  <select class="form-control bulk-select"><option selected disabled value>Bulk Action</option>
                         <option>Delete All</option>
                         <option>Select All</option>
                         
                </select> -->
                <table id="example" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectall" />
                            </th>
                            <th>ID</th>
                            <th>Ad Title</th>
                            <th>Comment</th>
                            <th>Posted on</th>
                            <th>Report on</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(@!empty($reports))
                        {
                            foreach ($reports as $report) {
                            ?>
                            <tr>
                            <td>
                                <input type="checkbox" class="selectedId" name="selectedId" value="<?php echo $report['PRODUCTID']; ?>" />
                            </td>
                            <td><?php echo $report['PRODUCTID']; ?></td>
                            <td>
                                <div class="title-div">
                                    <div class="title-div-img">
                                        <img src="<?php echo base_url();?>uploads/products/<?php if($ad['product_image']){ echo  $ad['product_image']; } else { echo 'No_image_available.png'; } ?>">
                                    </div>
                                    <div class="title-div-cont">
                                        <p><?php echo $report['product_title']; ?></p>
                                        <span><?php echo $report['name_en']; ?></span>
                                    </div>
                                </div>
                            </td>
                            
                            <td><?php echo $report['report_comment']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($report['product_date'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($report['report_time'])); ?></td>
                            

                            <td>
                                <?php if($ad['product_status'] == 0){ echo '<span class="badge badge-success">Approved</span>'; }else { echo '<span class="badge badge-warning">Pending</span>'; } ?>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <!-- <td><a href="#" class="approved-btn">Approved</a>
                                        </td> -->
                                        <td> <a href="edit-ads/<?php echo $report['PRODUCTID']; ?>" class="edit-btn">Edit</a>
                                        </td>
                                        <td> <button class="delete-btn delete_product" value="<?php echo $report['PRODUCTID']; ?>">Delete</button>
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