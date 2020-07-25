<section class="dashboard-header reviews">
    <div class="container">
        <!-- <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Reviews</h4>
            </div>
            <button class="btn-primary btn">Unapproved Reviews</button>&nbsp;
            <button class="btn-warning btn">Active Reviews</button>&nbsp;
            <button class="btn-danger btn">Delete Selected Items</button>
        </div> -->
        <div class="form-card reviews mt-40">
            <?php  if(@$this->session->flashdata("city_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("city_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("city_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("city_delete_f"); ?>
            </div>
            <?php } ?>
            
            <div class="table-responsive p-t-20">
                <?php
                // var_dump($cities);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="add_name">Cities</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url().'add-city';?>" class="edit-btn right" style="float: right;">Add</a>
                    </div>
                    </div>
                <br>
                <table id="example" style="width: 100%;" class="dataTables_wrapper dt-bootstrap4 no-footer table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO.</th>
                            <th>Name</th>
                            <th>Arabic Name</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(@!empty($cities))
                        {
                            foreach ($cities as $city) 
                            {
                                ?>
                                <tr>                                    
                                    <td><?php echo $city['CITYID']; ?></td>
                                    <td><?php echo $city['name_en']; ?></td>
                                    <td><?php echo $city['name_ar']; ?></td>
                                    <td><?php echo $city['latitude']; ?></td>
                                    <td><?php echo $city['longitude']; ?></td>
                                    <td>
                                        <label class="toggle">
                                            <input class="toggle-checkbox" type="checkbox" name="city_status" value="<?php echo $city['CITYID']; ?>" <?php if($city['city_status'] == 0){ echo 'checked'; } ?>>
                                            <div class="toggle-switch"></div>
                                        </label>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                               <td> <a href="<?php echo base_url().'edit-city/'.$city['CITYID']; ?>" class="edit-btn" value="<?php echo $city['CITYID']; ?>">Edit</a>
                                                </td>
                                                <td> <button class="delete-btn delete_city" value="<?php echo $city['CITYID']; ?>">Delete</button>
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