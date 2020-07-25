<section class="dashboard-header reviews">
    <div class="container">
        <div class="form-card reviews">
            <div class="add_category">
                <h4 class="add_name">Chat</h4>
            </div>
            
        </div>
        <?php 
        // var_dump($chats); 
        ?>
        <!-- <div class="form-card reviews mt-40"> -->
            <div class="chat-responsive">
                  <!-- <div class="container clearfix"> -->
    <div class="people-list" id="people-list">
      <!-- <div class="search">
        <input type="text" placeholder="Search" />
        <i class="fa fa-search"></i>
      </div> -->
      <ul class="list user_box">
        <?php
        if(!empty($chats))
        {
          $byArray = array();
          $toArray = array();
          foreach ($chats as $chat) {
            if(!in_array($chat['send_by'], $byArray) || !in_array($chat['send_to'], $toArray))
            {
            ?>
              <a href="javascript:;" class="chat-off-user" data-index="<?php echo $chat['id']; ?>">
                <li class="clearfix">
                <div class="float-left">
                <div class="about">
				<img src="<?php if($chat['user_photo']){ echo base_url().'uploads/users/'.$chat['user_photo']; } else { echo base_url().'/assets/images/users/avatar-1.jpg'; } ?>" alt="avatar" />
                  <div class="name"><?php echo $chat['full_name']; ?></div>
                  <div class="status">
                    <!-- <i class="fa fa-circle online"></i> online -->
                  </div>
                </div>
				</div>
                <div class="float-right">
                <?php $other = $this->admin_panel_model->get_single_users($chat['send_to']); ?>
                 
                  <div class="about">
				   <img src="<?php if($other['user_photo']){ echo base_url().'uploads/users/'.$other['user_photo']; } else { echo base_url().'/assets/images/users/avatar-1.jpg'; } ?>" alt="avatar" />
                    <div class="name"><?php echo $other['full_name']; ?></div>
                    <div class="status">
                      <!-- <i class="fa fa-circle online"></i> online -->
                    </div>
                  </div>
                </div>
              </li>
              <input type="hidden" id="send-by-<?php echo $chat['id']; ?>" value="<?php echo $chat['send_by']; ?>">
              <input type="hidden" id="send-to-<?php echo $chat['id']; ?>" value="<?php echo $chat['send_to']; ?>">
            </a>
            <?php
           }
           array_push($toArray, $chat['send_to']);
           array_push($byArray, $chat['send_by']);
          }
        }
        ?>


      </ul>
    </div>
    
    <div class="chat">
 
    </div> 
    
            </div>
    </div>
</section>

