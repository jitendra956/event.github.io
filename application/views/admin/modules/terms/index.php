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
            <?php  if(@$this->session->flashdata("term_add_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("term_add_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("term_add_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("term_add_f"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("term_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("term_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("term_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("term_delete_f"); ?>
            </div>
            <?php } ?>
            
            <div class="table-responsive p-t-20">
                <?php
                // var_dump($terms);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="add_name">Cities</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url().'add-term';?>" class="edit-btn right" style="float: right;">Add</a>
                    </div>
                    </div>
                <br>
                <table id="example" style="width: 100%;" class="dataTables_wrapper dt-bootstrap4 no-footer table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO.</th>
                            <th>Title</th>
                            <th>Term</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(@!empty($terms))
                        {
                            foreach ($terms as $term) 
                            {
                                ?>
                                <tr>                                    
                                    <td><?php echo $term['TERMID']; ?></td>
                                    <td><?php echo $term['term_title']; ?></td>
                                    <td><?php echo $term['term']; ?></td>
                                    <td>
                                        <label class="toggle">
                                            <input class="toggle-checkbox" type="checkbox" name="term_status" value="<?php echo $term['TERMID']; ?>" <?php if($term['term_status'] == 0){ echo 'checked'; } ?>>
                                            <div class="toggle-switch"></div>
                                        </label>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td> <a href="<?php echo base_url().'edit-term/'.$term['TERMID']; ?>" class="edit-btn" value="<?php echo $term['TERMID']; ?>">Edit</a>
                                                </td>
                                                <td> <button class="delete-btn delete_term" value="<?php echo $term['TERMID']; ?>">Delete</button>
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