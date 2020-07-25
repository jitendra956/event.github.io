<section class="dashboard-header reviews">
    <div class="container">
        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Reviews</h4>
            </div>
            <button class="btn-primary btn">Unapproved Reviews</button>&nbsp;
            <button class="btn-warning btn">Active Reviews</button>&nbsp;
            <!-- <button class="btn-danger btn">Delete Selected Items</button> -->
        </div>
        <div class="form-card reviews mt-40">
            <?php  if(@$this->session->flashdata("review_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("review_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("review_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("review_delete_f"); ?>
            </div>
            <?php } ?>
            
            <div class="table-responsive p-t-20">
                <table id="example" style="width: 100%;" class="dataTables_wrapper dt-bootstrap4 no-footer table table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>
                                <a href="javascript:void(0)" class="text-muted">
                                    <input type="checkbox">
                                </a>
                            </th> -->
                            <th>Stars</th>
                            <th>AD ID</th>
                            <th>Ad Title</th>
                            <th>Review Date</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(@!empty($reviews))
                        {
                            foreach ($reviews as $review) 
                            {
                                ?>
                                <tr>
                                    <!-- <td>
                                        <a href="javascript:void(0)" class="text-muted">
                                            <input type="checkbox">
                                        </a>
                                    </td> -->
                                    <td>
                                        <?php 
                                        for($i=0;$i<$review['review_points'];$i++)
                                        {
                                            echo '<span class="days-new"><i class="fa fa-star"></i></span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $review['productID']; ?></td>
                                    <td><?php echo $review['product_title']; ?></td>
                                    <td><?php echo $review['review_date_string']." ".$review['review_time']; ?></td>
                                    <td>
                                        <label class="toggle">
                                            <input class="toggle-checkbox" type="checkbox" name="review_status" value="<?php echo $review['REVIEWID']; ?>" <?php if($review['review_status'] == 1){ echo 'checked'; } ?>>
                                            <div class="toggle-switch"></div>
                                        </label>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td><a href="#" class="approved-btn">Approved</a>
                                                </td>
                                                <td> <a href="review-detail.php" class="edit-btn">Edit</a>
                                                </td>
                                                <td> <button class="delete-btn delete_review" value="<?php echo $review['REVIEWID']; ?>">Delete</button>
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