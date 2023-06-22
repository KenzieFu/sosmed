<?php 
	include '../init.php';
	
	if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){
		$postID = $_POST['showpopup'];
		$user_id = @$_SESSION['user_id'];
		$post   = $getFromT->postPopup($postID);
		$user    = $getFromU->userData($user_id);
		$likes   = $getFromT->likes($user_id, $postID);
		$repost = $getFromT->checkRepost($postID,$user_id);
		$comments = $getFromT->comments($postID);

   	}
?>
<div class="post-show-popup-wrap">
<input type="checkbox" id="post-show-popup-wrap">
<div class="wrap4">
	<label for="post-show-popup-wrap">
		<div class="post-show-popup-box-cut">
			<i class="fa fa-times" aria-hidden="true"></i>
		</div>
	</label>
	<div class="post-show-popup-box">
	<div class="post-show-popup-inner">
		<div class="post-show-popup-head">
			<div class="post-show-popup-head-left">
				<div class="post-show-popup-img">
					<img src="<?php echo BASE_URL.$post->profileImage;?>"/>
				</div>
				<div class="post-show-popup-name">
					<div class="t-s-p-n">
					
						<a href=<?= BASE_URL?><?="profile.php?username="?><?=$post->username?>>
							<?php echo $post->screenName;?>
						</a>
					</div>
					<div class="t-s-p-n-b">
						<a href=<?=BASE_URL?><?="profile.php?username="?><?=$post->username?>>
							@<?php echo $post->username;?>
						</a>
					</div>
				</div>
			</div>
			<div class="post-show-popup-head-right">
			<?php echo $getFromF->followBtn($post->postBy, $user_id, $user_id);?>
 			</div>
		</div>
		<div class="post-show-popup-post-wrap">
			<div class="post-show-popup-post">
				<?php echo $getFromT->getPostLinks($post->status);?>
			</div>
			<div class="post-show-popup-post-ifram mb-0">
			<?php 
				if(!empty($post->postImage)){
  			    	echo '<img src="'.$post->postImage.'"/>'; 
  				}
  			?>	
			</div>
		</div>
		<div class="post-show-popup-footer-wrap">
			<div class="post-show-popup-repost-like">
				<div class="post-show-popup-repost-left">
					<div class="post-repost-count-wrap">
						<div class="post-repost-count-head">
							REPOST
						</div>
						<div class="post-repost-count-body">
							<?php echo $post->repostCount;?>
						</div>
					</div>
					<div class="post-like-count-wrap">
						<div class="post-like-count-head">
							LIKES
						</div>
						<div class="post-like-count-body">
							<?php echo $post->likesCount;?>
						</div>
					</div>
				</div>
				<div class="post-show-popup-repost-right">
				 
				</div>
			</div>
<!--
			<div class="post-show-popup-time">
				<span><?php echo $getFromU->timeAgo($post->postedOn);?></span>
			</div>
-->
			<div class="post-show-popup-footer-menu mb-0">
				<?php 
					echo '<ul> 
						'.(($getFromU->loggedIn()) ?   '
								
							<li>'.(((isset($repost['repostID'])) ? $post->postID === $repost['repostID'] OR $user_id === $repost['repostBy'] : '') ? '<button class="reposted" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i style="color:skyblue;" class="fa fa-retweet" aria-hidden="true"></i><span class="repostsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>' : '<button class="repost" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="repostsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>').'</li>
							<li>'.(((isset($likes['likeOn'])) ? $likes['likeOn'] == $post->postID : '') ? '<button class="unlike-btn" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>' : '<button class="like-btn" data-post="'.$post->postID.'" data-user="'.$post->postBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '').'</span></button>').'</li>
							'.(($post->postBy === $user_id) ? ' 
							<li>
								<a href="" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
								<ul> 
								  <li><label class="deletePost" data-post="'.$post->postID.'">Delete Post</label></li>
								</ul>
							</li>' : '').'
						' : '
								
							<li><button><i class="fa fa-retweet" aria-hidden="true"></i></button></li>	
							<li><button><i class="fa fa-heart-o" aria-hidden="true"></i></button></li>	
						').'
						</ul>';
				?>
			</div>
		</div>
	</div><!--post-show-popup-inner end-->
	<?php if($getFromU->loggedIn() === true){?>
 	<div class="post-show-popup-footer-input-wrap">
		<div class="post-show-popup-footer-input-inner">
			<div class="post-show-popup-footer-input-left">
				<img src="<?php echo BASE_URL.$user->profileImage;?>"/>
			</div>
			<div class="post-show-popup-footer-input-right">
				<input id="commentField" type="text" name="comment"  data-post="<?php echo $post->postID;?>" placeholder="Reply to @<?php echo $post->username;?>">
			</div>
		</div>
		<div class="post-footer">
		 	<div class="t-fo-left">
		 		<ul>
		 			<li>
		 				<!-- <label for="t-show-file"><i class="fa fa-camera" aria-hidden="true"></i></label>
		 				<input type="file" id="t-show-file"> -->
		 			</li>
		 		</ul>
		 	</div>
		 	<div class="t-fo-right">
 		 		<input type="submit" id="postComment" value="Post">
 		 		<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/comment.js"></script>
 		 		<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/follow.js"></script>
  		 	</div>
		 </div>
	</div><!--post-show-popup-footer-input-wrap end-->
	<?php }?>

<div class="post-show-popup-comment-wrap">
	<div id="comments">
	 	<?php 
	 		foreach ($comments as $comment) {
	 			echo '<div class="post-show-popup-comment-box">
						<div class="post-show-popup-comment-inner">
							<div class="post-show-popup-comment-head">
								<div class="post-show-popup-comment-head-left">
									 <div class="post-show-popup-comment-img">
									 	<img src="'.BASE_URL.$comment->profileImage.'">
									 </div>
								</div>
								<div class="post-show-popup-comment-head-right">
									  <div class="post-show-popup-comment-name-box">
									 	<div class="post-show-popup-comment-name-box-name"> 
									 		<a href="'.BASE_URL.'profile.php?username='.$comment->username.'">'.$comment->screenName.'</a>
									 	</div>
									 	<div class="post-show-popup-comment-name-box-tname">
									 		<a href="'.BASE_URL.'profile.php?username='.$comment->username.'">@'.$comment->username.'</a>
									 	</div>
									 </div>
									 <div class="post-show-popup-comment-right-post">
									 		<p><a href="'.BASE_URL.'profile.php?username='.$post->username.'">@'.$post->username.'</a> '.$comment->comment.'</p>
									 </div>
								 	<div class="post-show-popup-footer-menu">
										<ul>
										
										
											'.(($comment->commentBy === $user_id) ?  
											'<li>
												
												  <label class="deleteComment" data-post="'.$post->postID.'" data-comment="'.$comment->commentID.'"><i class="fa fa-trash"/></label>
												
											</li>' : '').'
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!--TWEET SHOW POPUP COMMENT inner END-->
						</div>
						';
	 		}
	 	?>
	</div>

</div>
<!--post-show-popup-box ends-->
</div>
</div>