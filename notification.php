<?php 
	include 'core/init.php';
 	$user_id = $_SESSION['user_id'];
	$user    = $getFromU->userData($user_id);
	$getFromM->notificationViewed($user_id);
	$notify  = $getFromM->getNotificationCount($user_id);
	if($getFromU->loggedIn() === false){
		header('Location: index.php');
	}
	$notification  = $getFromM->notification($user_id);
 
 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Notifications - Dreamify</title>
    <meta charset="UTF-8" />
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/images/bird.svg">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>

   <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
    <link rel='stylesheet' href='<?php echo BASE_URL;?>assets/css/style.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL;?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL;?>assets/css/bootstrap.css' />   
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style-complete.css" />
</head>

<body style="background-color: black;">
    <div class="grid-container">

        <?php require 'left-sidebar.php' ?>


        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/search.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/like.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/repost.js"></script>


        <div class="main" style="border: none;">
<!--            <div class="in-center">-->
<!--                <div class="in-center-wrap">-->

                    <!--NOTIFICATION WRAPPER FULL WRAPPER-->
                    <p class="page_title mb-0" style="background-color: #1d2226; color:white;">Notifications</p>
                    <div class="space" style="height:10px; width:100%; background-color:black; border:none;">
                </div>
                
                    <div class="notification-full-wrapper" style="border-radius:20px;">
<!-- 
                        <div class="notification-full-head">
                            <div>
                                <a href="#">All</a>
                            </div>
                            <div>
                                <a href="#">Mention</a>
                            </div>
                            <div>
                                <a href="#">settings</a>
                            </div>
                        </div> -->
                        <?php foreach($notification as $data) :?>
                        <?php if($data->type == 'follow') :?>
                        <!-- Follow Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper" style="background-color: #1d2226; border:none; ">
                            <div class="notification-inner">
                                <div class="notification-header">

                                    <div class="notification-img">
                                        <span class="follow-logo">
                                            <i class="fa fa-child" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-name">
                                        <div>
                                            <img src="<?php echo BASE_URL.$data->profileImage;?>" />
                                        </div>

                                    </div>
                                    <div class="notification-post">
                                        <a href="<?php echo BASE_URL.'profile.php?username='.$data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> Followed you - <span><?php echo $getFromU->timeAgo($data->time);?></span>

                                    </div>

                                </div>

                            </div>
                            <!--NOTIFICATION-INNER END-->
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Follow Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'like') :?>
                        <!-- Like Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">
                                    <div class="notification-img">
                                        <span class="heart-logo">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-name">
                                        <div>
                                            <img src="<?php echo BASE_URL.$data->profileImage;?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-post">
                                    <a href="<?php echo BASE_URL.'profile.php?username='.$data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> liked your <?php if($data->postBy === $user_id){echo 'Post';}else{echo 'Repost';}?> - <span><?php echo $getFromU->timeAgo($data->time);?></span>
                                </div>
                                <div class="notification-footer">
                                    <div class="noti-footer-inner">
                                        <div class="noti-footer-inner-left">
                                            <div class="t-h-c-name" style="color: white;">
                                                <span><a href="<?php echo BASE_URL.'profile.php?username='.$user->username;?>"><?php echo $user->username;?></a></span>
                                                <span>@<?php echo $user->username;?></span>
                                                <span><?php echo $getFromU->timeAgo($data->postedOn);?></span>
                                            </div>
                                            <div class="noti-footer-inner-right-text">
                                                <?php echo $getFromT->getPostlinks($data->status);?>
                                            </div>
                                        </div>
                                        <?php if(!empty($data->postImage)) :?>
                                        <div class="noti-footer-inner-right">
                                            <img src="<?php echo BASE_URL.$data->postImage;?>" />
                                        </div>
                                        <?php endif;?>

                                    </div>
                                    <!--END NOTIFICATION-inner-->
                                </div>
                            </div>
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Like Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'repost') :?>
                        <!-- Repost Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">

                                    <div class="notification-img">
                                        <span class="repost-logo">
                                            <i class="fa fa-repost" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-post">
                                        <a href="<?php echo BASE_URL.'profile.php?username='.$data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> repost your <?php if($data->postBy === $user_id){echo 'Post';}else{echo 'Repost';}?> - <span><?php echo $getFromU->timeAgo($data->time);?></span>
                                    </div>
                                    <div class="notification-footer">
                                        <div class="noti-footer-inner">

                                            <div class="noti-footer-inner-left">
                                                <div class="t-h-c-name" style="color: white;">
                                                    <span><a href="<?php echo BASE_URL.'profile.php?username='.$user->username;?>"><?php echo $user->screenName;?></a></span>
                                                    <span>@<?php echo $user->username;?></span>
                                                    <span><?php echo $getFromU->timeAgo($data->postedOn);?></span>
                                                </div>
                                                <div class="noti-footer-inner-right-text">
                                                    <?php echo $getFromT->getPostLinks($data->status)?>
                                                </div>
                                            </div>


                                            <?php if(!empty($data->postImage)) :?>
                                            <div class="noti-footer-inner-right">
                                                <img src="<?php echo BASE_URL.$data->postImage;?>" />
                                            </div>
                                            <?php endif;?>

                                        </div>
                                        <!--END NOTIFICATION-inner-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Repost Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'mention') :?>
                        <?php 
			$post = $data;
			$likes        = $getFromT->likes($user_id, $post->postID);
			$repost      = $getFromT->checkRepost($post->postID, $user_id);
    			echo '<div class="all-post-inner">
					<div class="t-show-wrap">	
					 <div class="t-show-inner"> 
							<div class="t-show-popup" data-post="'.$post->postID.'" data-user="'.$post->postBy.'">
								<div class="t-show-head">
									<div class="t-show-img">
										<img src="'.BASE_URL.$post->profileImage.'"/>
									</div>
									<div class="t-s-head-co	ntent">
										<div class="t-h-c-name" style="color: white;">
											<span><a href="'.BASE_URL.'profile.php?username='.$post->username.'">'.$post->screenName.'</a></span>
											<span>Mentioned you - </span>
											<span>'.$getFromT->timeAgo($post->postedOn).'</span>
										</div>
										<div class="t-h-c-dis">
											'.$getFromT->getPostLinks($post->status).'
										</div>
									</div>
								</div>'.

						 ((!empty($post->postImage)) ?  
					       '<div class="t-show-body">
								  <div class="t-s-b-inner">
									   <div class="t-s-b-inner-in">
									     <img src="'.BASE_URL.$post->postImage.'" class="imagePopup" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"/>
									   </div>
								  </div>	
							   </div>' : '' ) .'
						
				       </div>
						<div class="t-show-footer">
							<div class="t-s-f-right">
								<ul> 
								
									<li>'.(((isset($repost['repostID'])) ? $post->postID === $repost['repostID'] OR $user_id === $repost['repostBy'] : '') ? '<button class="reposted" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i style="color:skyblue" class="fa fa-repost" aria-hidden="true"></i><span class="repostsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>' : '<button class="repost" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i class="fa fa-repost" aria-hidden="true"></i><span class="repostsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>').'</li>
									<li>'.(((isset($likes['likeOn'])) ?$likes['likeOn'] == $post->postID : '') ? '<button class="unlike-btn" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '').'</span></button>' : '<button class="like-btn" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '').'</span></button>').'</li>
									'.(($post->postBy === $user_id) ? ' 
									<li>
										<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
										<ul> 
										  <li><label class="deletePost" data-post="'.$post->postID.'">Delete Post</label></li>
										</ul>
									</li>' : '').'
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>';		 
			?>
                        <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <!--NOTIFICATION WRAPPER FULL WRAPPER END-->

                    <div class="loading-div" style="border: none;">
                        <img id="loader" src="<?php echo BASE_URL;?>assets/images/loading.svg" style="display: none;" />
                    </div>
                    <div class="popupPost"></div>
                    <!--Post END WRAPER-->
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popupposts.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/hashtag.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/delete.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popupForm.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/messages.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/postMessage.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/notification.js"></script>
                </div><!-- in left wrap-->
<!--            </div> in center end -->
<!--        </div>-->

        <script type='<?php echo BASE_URL;?>text/javascript' src='assets/js/search.js'></script>
        <script type='<?php echo BASE_URL;?>text/javascript' src='assets/js/hashtag.js'></script>

        <?php require 'right-sidebar.php' ?>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/follow.js'></script>

        <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/popper.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/bootstrap.min.js'></script>

</body>

</html>
