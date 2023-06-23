<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}

if ( isset( $_POST['post'] ) ) {
    $status = $getFromU->checkinput( $_POST['status'] );
    $postImage = '';

    if ( !empty( $status ) or !empty( $_FILES['file']['name'][0] ) ) {
        if ( !empty( $_FILES['file']['name'][0] ) ) {
            $postImage = $getFromU->uploadImage( $_FILES['file'] );
        }

        if ( strlen( $status ) > 1000 ) {
            $error = 'The text of your post is too long';
        }
        $post_id = $getFromU->create( 'posts', array( 'status' => $status, 'postBy' => $user_id, 'postImage' => $postImage, 'postedOn' => date( 'Y-m-d H:i:s' ) ) );
        preg_match_all( '/#+([a-zA-Z0-9_]+)/i', $status, $hashtag );

        if ( !empty( $hashtag ) ) {
            $getFromT->addTrend( $status );
        }
        $getFromT->addMention( $status, $user_id, $post_id );
        header( 'Location: home.php' );
    } else {
        $error = 'Type or choose image to post';
    }
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Home - Dreamify</title>
    <meta charset='UTF-8' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg">
    <link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'/>
    
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.css' />
    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>

    <script src = 'https://code.jquery.com/jquery-3.2.1.min.js'></script>


</head>

<body style="background-color: black;">

    <div class="grid-container">
        <!--    <div class='wrapper'>-->

        <?php require 'left-sidebar.php' ?>

        <div class="main" style="border: none; border-radius: 20px;">
            <div class=''>
                <div class=''>
                    <!--POST WRAPPER-->
                    <p class="page_title mb-0" style="background-color: white; color: white; background-color: #1d2226;">Home</p>
                    <div class='post_box post_add' style="background-color: #1d2226">
                        <div class='left-post ml-3'>
                            <!-- PROFILE-IMAGE -->
                            <img class="mr-3" src="<?php echo $user->profileImage; ?>" style="width: 53px;height:53px;border-radius:50%;" />
                        </div>
                        
                        <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/search.js'></script>
                        <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/hashtag.js'></script>

                        <div class='post_body'>
                            <form method='post' enctype='multipart/form-data'>
                                <textarea class='status' maxlength='1000' name='status' placeholder="What's happening?" rows='3' cols='100%' style="font-size:17px;"></textarea>
                                <div>
                                <img width="500px" id="output">
                                
                                </img>
                                </div>
                                
                               <!--  <div class='hash-box'>
                                    <ul>
                                    
                                    </ul>
                                </div> -->

                                <div class='post_icons-wrapper'>
                                    <div class='t-fo-left post_icons-add'>
                                        <ul>
                                            <input type='file' name='file' id='file' onchange="loadFile(event)" />
                                            <li><label for='file'><i class='fa fa-image' style="color: white;" aria-hidden='true'></i></label>
                                    
                                            </li>
                                            <span class='post-error'><?php if ( isset( $error ) ) {
                                                echo $error;
                                            } else if ( isset( $imgError ) ) {
                                                echo '<br>' . $imgError;
                                            }
                                            ?></span>
                                            

                                        </ul>
                                    </div>
                                    <div class='t-fo-right'>
                                        <!--<span id='count'>140</span>-->
                                        <!--<input type='submit' name='post' value='post' />-->

                                        <button class="button_post" type="submit" name="post" style="outline:none; color: black; background-color:white;">Post</button>

                                    </div>
                            </form>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="space" style="height:10px; width:100%; background-color:black; border:none;">
                </div>
                <!--POST WRAP END-->

                <!--Post SHOW WRAPPER-->
                <div class='posts'>
                    <?php $getFromT->posts( $user_id, 20 );
                    ?>
                </div>
                <!--POSTS SHOW WRAPPER-->

                <div class='loading-div' style="border: none;">
                    <img id='loader' src='assets/images/loading.svg' style='display: none;' />
                </div>
                <div class='popupPost'></div>
                <!--Post END WRAPER-->
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/like.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/repost.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popupposts.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/delete.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/comment.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popupForm.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/fetch.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/messages.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/notification.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/postMessage.js'></script>

            </div><!-- in left wrap-->
        </div><!-- in center end -->
    </div>

    

    <?php require 'right-sidebar.php' ?>

    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/follow.js'></script>

    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>
    <script src='<?php echo BASE_URL; ?>assets/js/popper.min.js'></script>
    <script src='<?php echo BASE_URL; ?>assets/js/bootstrap.min.js'></script>

    <script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script

</body>

</html>
