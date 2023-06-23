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
        <div class="sidebar" style="background-color:#1d2226; border: none;">
        <div style="margin-bottom:80px;"></div>
            <ul class="side-bar" style="color: gray;" >
                <li>
                <a href="<?php echo BASE_URL; ?><?="profile.php?username="?><?php echo $user->username;?>" ?>
                    <div class="sidebar_profile-box">
                        <div style="margin-right: 5px;">
                            <img  class="sidebar_profile-image" width="60px" height="100%" src=<?= BASE_URL.$user->profileImage?> alt="">
                        </div>
                        <div class="sidebar_profile-info">
                            <p><?=$user->screenName?></p>
                            <p style="font-size: 10px; align-items:center; color: #5b7083">@<?=$user->username?></p>
                        </div>
                    </div>
                    </a>
                </li>
           
                <li><a href='<?php echo BASE_URL; ?>home.php'><i class="fa fa-home"></i><span>Home</span></a></li>
                <?php if ( $getFromU->loggedIn() === true ) {
                ?>
               <!--  <li><a href="<?php echo BASE_URL;?>hashtag.php"><i class="fa fa-hashtag"></i><span>Explore</span></a></li> -->

                <li><a href='<?php echo BASE_URL; ?>notification.php'><i class="fa fa-bell" aria-hidden="true"></i><span>Notifications</span><span id="notificaiton" class="ml-0"><?php if($notify->totalN > 0){echo '<span 
                    style="    background: #6dbeef;
                    padding: 1px 10px;
                    border-radius: 7px;
                    border: 2px solid #fff;
                    color: #fff;
                    position: relative;
                    right: 0px;
                    top: -1px;
                    font-size: 14px;"
                    class="span-i">'.$notify->totalN.'</span>';}?></span></a></li>
                
                <li id='messagePopup'><a><i class="fa fa-envelope" aria-hidden='true'></i><span>Messages</span><span id='messages'>
                            <?php if ( $notify->totalM > 0 ) {
                            echo '<span class="span-i">'.$notify->totalM.'</span>';
                            }?>
                        </span></a></li>
                <!-- <li><a href="<?php echo BASE_URL; ?><?="profile.php?username="?><?php echo $user->username; ?>"><i class="fa fa-user"></i><span>Profile</span></a></li> -->
                <li><a href='<?php echo BASE_URL; ?>account.php'><i class="fa fa-cog"></i><span>Settings</span></a></li>
                <li><a href='<?php echo BASE_URL; ?>includes/logout.php'><i class="fa fa-power-off"></i><span>Logout</span></a></li>
                <li style="padding:10px 40px;"><button class="sidebar_post button addPostBtn" style="outline:none;">Post</button></li>
                <li style="padding:10px 40px;"><button onclick="location.href='https://wa.me/+6285770010048'" class="sidebar_post button addPostBtn" style="outline:none;">Contact Us (Whatsapp)</button></li>
                <?php }?>
                <?php if ( $getFromU->loggedIn() === false ) {
                ?>
                <a href='<?php echo BASE_URL; ?>' style="text-decoration:none;"><li style="padding:10px 40px;"><button class="sidebar_post button" style="outline:none;">Login</button></li></a>
                <?php }?>
                </ul>
        </div>