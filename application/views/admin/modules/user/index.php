<section class="dashboard-header reviews">
    <div class="container">
        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">User</h4>
            </div>
            <button class="btn-danger btn" id="deleteAllusers">Delete Selected Items</button>
        </div>
            <?php  if(@$this->session->flashdata("user_delete_s")) { ?>
            <div class="alert alert-success" >
            <?php echo $this->session->flashdata("user_delete_s"); ?>
            </div>
            <?php } ?>
            <?php  if(@$this->session->flashdata("user_delete_f")) { ?>
            <div class="alert alert-danger" >
            <?php echo $this->session->flashdata("user_delete_f"); ?>
            </div>
            <?php } ?>
            
<!--         <div class="filter-div">
            <ul>
                <li>FILTER</li>
                   <li>
                       <select>
                            <option disabled selected value>Email</option>
                            <option>Ascending</option>
                            <option>Descending</option>
                            <option>Normal</option>
                        </select>
                    </li>
                <li> <select>
                            <option disabled selected value>Data Range</option>
                            <option>Ascending</option>
                            <option>Descending</option>
                            <option>Normal</option>
                        </select>
                    </li>
                    <li> <select>
                            <option disabled selected value>Phone Number</option>
                            <option>Ascending</option>
                            <option>Descending</option>
                            <option>Normal</option>
                        </select>
                    </li>
                    <li><button class="btn-remove">Remove Filters</button>
                    </li>
            </ul>
        </div> -->
        <div class="form-card reviews ">
            <div class="table-responsive p-t-20">
                <table id="example" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                               <input type="checkbox" id="selectall" />
                            </th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Verified Phone No.</th>
                            <th>Verfified Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(@!empty($users))
                        {
                            foreach ($users as $user) {
                               ?>
                               <tr>
                            <td>
                                <input type="checkbox" class="selectedId" name="selectedId" value="<?php echo $user['USERID']; ?>" />
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($user['created_on'])); ?></td>
                            <td><?php echo $user['full_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['country_code'].' '.$user['contact']; ?></td>
                            <td>
                                <label class="toggle">
                                    <input class="toggle-checkbox" type="checkbox" name="user_c_verify" value="<?php echo $user['USERID']; ?>" <?php if($user['verify'] == 1){ echo 'checked'; } ?>>
                                    <div class="toggle-switch"></div>
                                </label>
                            </td>
                            <td>
                                <label class="toggle">
                                    <input class="toggle-checkbox" type="checkbox" name="user_e_verify" value="<?php echo $user['USERID']; ?>" <?php if($user['email_verify'] == 1){ echo 'checked'; } ?>>
                                    <div class="toggle-switch"></div>
                                </label>
                            </td>
                            <td align="center">
                                <table>
                                    <tr>
                                       
                                        <td> <a href="<?php echo base_url().'edit-user/'.$user['USERID']; ?>" class="edit-btn" value="<?php echo $user['USERID']; ?>">Edit</a>
                                        </td>
                                        <td> <button class="delete-btn delete_user" value="<?php echo $user['USERID']; ?>">Delete</button>
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
        <div class="form-card reviews mt-40">
           <div class="add_category">
                <h4 class="add_name">Send Notification</h4>
            </div>
            <form action="#" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Select User</label>
                         <select id="multiple-checkboxes" multiple="multiple" class="form-control">
                        <?php
                        if(@!empty($users))
                        {
                        foreach ($users as $user) {
                           ?>
                           <option value="<?php echo $user['USERID']; ?>"><?php echo $user['full_name']; ?></option>
                           <?php
                           }
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Message</label>
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-2 offset-md-10" style="text-align: right;">
                    <button class="View-btn">SEND</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>