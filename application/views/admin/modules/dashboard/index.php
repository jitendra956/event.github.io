<section class="dashboard-header reviews">
    <div class="container">
        <div class=" reviews">
            <div class="add_category">
                <h4 class="add_name">Dashboard</h4>
            </div>
            <div class="row">
                 <div class="col-md-3">
                    <div class="dash-status-main bg-green">
                    <div class="dash-status-div ">
                        <div class="dash-status-cont">
                            <h4><?php echo count($total_ads); ?></h4>
                            <span>Total Ads</span>
                        </div>
                        <div class="dash-status-icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="view-more-div">
                        <span>more info <a href="<?php echo base_url().'all-ads-list';?>"><i class="fa fa-arrow-circle-right"></i> </a></span>
                    </div>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="dash-status-main bg-blue">
                    <div class="dash-status-div ">
                        <div class="dash-status-cont">
                            <h4><?php echo count($active_ads); ?></h4>
                            <span>Activated Ads</span>
                        </div>
                        <div class="dash-status-icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="view-more-div">
                        <span>more info <a href="<?php echo base_url().'active-ads';?>"><i class="fa fa-arrow-circle-right"></i></a></span>
                    </div>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="dash-status-main bg-orange">
                    <div class="dash-status-div ">
                        <div class="dash-status-cont">
                            <h4><?php echo count($pending_ads); ?></h4>
                            <span>Pending Ads</span>
                        </div>
                        <div class="dash-status-icon">
                            <i class="fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="view-more-div">
                        <span>more info <a href="<?php echo base_url().'pending-ads';?>"><i class="fa fa-arrow-circle-right"></i></a></span>
                    </div>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="dash-status-main bg-red">
                    <div class="dash-status-div ">
                        <div class="dash-status-cont">
                            <h4><?php echo count($expired_ads); ?></h4>
                            <span>Expired Ads</span>
                        </div>
                        <div class="dash-status-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="view-more-div">
                        <span>more info <a href="<?php echo base_url().'expire-ads';?>"><i class="fa fa-arrow-circle-right"></i></a></span>
                    </div>
                </div>
                </div>
            </div>
            
        </div>
        <div class=" reviews mt-40">
            <div class="row">
               
                 <div class="col-md-6">
                    <div class="dash-card">
                         <div class="add_category">
                <h4 class="add_name">Ads Stats</h4>
            </div>
                      <canvas id="chBar" height="100"></canvas>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="dash-card">
                     <div class="add_category">
                <h4 class="add_name">User Stats</h4>
            </div>
                      <canvas id="chBar1" height="100"></canvas>
                </div>
            </div>
                <div class="col-md-6 mt-40">
                    <div class="dash-card">
                         <div class="add_category">
                <h4 class="add_name">Latest Ads</h4>
            </div>
                    <div class="table-responsive p-t-20">
                <table style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(@!empty($total_ads))
                        {
                            $n = 1;
                            foreach ($total_ads as $ad) {
                            ?>
                            <tr>
                            <td><?php echo $ad['PRODUCTID']; ?></td>
                            <td>
                                <?php echo $ad['product_title']; ?>
                            </td>
                            
                            <td><?php echo $ad['email']; ?></td>
                            <td>
                                <?php if($ad['product_expiry'] <= date("Y-m-d h:i:s A")){ echo '<span class="badge badge-danger">Expired</span>'; }else { if($ad['product_status'] == 0){ echo '<span class="badge badge-success">Approved</span>'; }else { echo '<span class="badge badge-warning">Pending</span>'; } }?>

                            </td>
                             <td><?php echo date('d/m/Y', strtotime($ad['product_date'])); ?></td>
                        </tr>
                    <?php 
                    if($n ==2)
                    {
                        break;
                    }
                    $n++;
                          } 
                        }
                       ?>
                    </tbody>
                </table>
                <a href="<?php echo base_url(); ?>all-ads-list"><button style="float:right">View All</button></a>
            </div>
                </div>
            </div>
                 <div class="col-md-6 mt-40">
                    <div class="dash-card">
                         <div class="add_category">
                <h4 class="add_name">Latest Users</h4>
            </div>
                    <div class="table-responsive p-t-20">
                <table style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(@!empty($users))
                        {
                            $n = 1;
                            foreach ($users as $user) {
                               ?>
                          <tr>
                            <td><?php echo $user['USERID']; ?></td>
                            <td><?php echo $user['full_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <?php if($user['verify'] == 1 || $user['email_verify'] == 1){ echo '<span class="badge badge-success">Verify</span>'; }else{ echo '<span class="badge badge-warning">Pending</span>'; } ?>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($user['created_on'])); ?></td>
                        </tr>
                               <?php
                               if($n ==2)
                                {
                                    break;
                                }
                                $n++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href="<?php echo base_url(); ?>user"><button style="float:right">View All</button></a>
            </div>
        </div>
                </div>
            </div>
            
        </div>
    </div>
</section>