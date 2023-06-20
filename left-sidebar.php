<?php
 if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
  $username = $getFromU->checkInput($_GET['username']);
  $profileId = $getFromU->userIdByUsername($username);
  $profileData = $getFromU->userData($profileId);
  $user_id = @$_SESSION['user_id'];
  $user = $getFromU->userData($user_id);
  $notify  = $getFromM->getNotificationCount($user_id);

 
  if (!$profileData) {
    header('Location: '.BASE_URL.'index.php');
  }
}

?>
           <div class="sidebar">
          <div style="margin-bottom:80px;"></div>
            <ul style="list-style:none;">
                <li >
                <a href="<?php echo BASE_URL; ?><?="profile.php?username="?><?php echo $user->username;?>" ?>
                    <div class="sidebar_profile-box">
                        <div style="margin-right: 5px;">
                            <img class="sidebar_profile-image" width="60px" height="100%" src=<?= BASE_URL.$user->profileImage?> alt="">
                        </div>
                        <div class="sidebar_profile-info">
                            <p style="color: white;"><?=$user->screenName?></p>
                            <p style="font-size: 10px;color:black;">@<?=$user->username?></p>
                        </div>
                    </div>
                    </a>
            </li>
           
                <li class="active_menu"><a href='<?php echo BASE_URL; ?>home.php'><i class="fa fa-home" style="color: white;"></i><span style="color: white;" >Home</span></a></li>
                <?php if ( $getFromU->loggedIn() === true ) {
                ?>
               <!--  <li><a href="<?php echo BASE_URL;?>hashtag.php"><i class="fa fa-hashtag"></i><span>Explore</span></a></li> -->

                <li><a href="<?php echo BASE_URL;?>notification.php"><i class="fa fa-bell" aria-hidden="true"></i><span>Notifications</span><span id="notificaiton" class="ml-0"><?php if($notify->totalN > 0){echo '<span class="span-i">'.$notify->totalN.'</span>';}?></span></a></li>
                
                <li id='messagePopup'><a><i class="fa fa-envelope" aria-hidden='true'></i><span>Messages</span><span id='messages'>
                            <?php if ( $notify->totalM > 0 ) {
                            echo '<span class="span-i">'.$notify->totalM.'</span>';
                            }?>
                        </span></a></li>
                <!-- <li><a href="<?php echo BASE_URL; ?><?="profile.php?username="?><?php echo $user->username; ?>"><i class="fa fa-user"></i><span>Profile</span></a></li> -->
                <li><a href='<?php echo BASE_URL; ?>account.php'><i class="fa fa-cog"></i><span>Settings</span></a></li>
                <li><a href='<?php echo BASE_URL; ?>includes/logout.php'><i class="fa fa-power-off"></i><span>Logout</span></a></li>
                <li style="padding:10px 40px;"><button class="sidebar_post button addPostBtn" style="outline:none;">Post</button></li>
                <?php }?>
                <?php if ( $getFromU->loggedIn() === false ) {
                ?>
                <a href='<?php echo BASE_URL; ?>' style="text-decoration:none;"><li style="padding:10px 40px;"><button class="sidebar_post button" style="outline:none;">Login</button></li></a>
                <?php }?>
            </ul>
         <!--    <ul>
               <?php if ( $getFromU->loggedIn() === true ) {
                ?>
                <div class="media" style="margin-top:150px;">
                    <li class="media-inner">
                        <a href="<?php echo BASE_URL.$user->username; ?>">
                            <img class="mr-1" src="<?php echo BASE_URL;?><?php echo $user->profileImage; ?>" style="height:40px; width:40px; border-radius:50%;" />
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">
                                    <a href="<?php echo $user->username; ?>"><span><?php echo '<b>' . $user->screenName . '</b>';
                    ?></span></a>
                                </h5>
                                <span class="text-muted"><?php echo "@".$user->username;
                    ?></span>
                            </div>
                        </a>
                    </li>
                </div>
                <?php } ?>
            </ul> -->
        </div>