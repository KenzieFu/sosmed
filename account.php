<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user    = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: index.php' );
}

if ( isset( $_POST['submit'] ) ) {
    $username  = $_POST['username'];
//    $email     = $_POST['email'];
    $error     = array();

    if ( !empty( $username )) {
        if ( preg_match( '/[^a-zA-Z0-9\!]/', $username ) ) {
            $error['username']  = 'Only characters and numbers allowed';
        }if ( $user->username != $username and $getFromU->checkUsername( $username ) === true ) {
            $error['username'] = 'Username is not available';
        }
//        else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
//            $error['email'] = 'Invalid email format';
//        } else if ( $user->email != $email and $getFromU->checkEmail( $email ) === true ) {
//            $error['email'] = 'Email is already in use';
//        } 
            else {
            $getFromU->update( 'users', $user_id, array( 'username' => $username));
            header( 'Location:'.BASE_URL.'account.php' );
        }
    } else {
        $error['fields']  = 'Please fill all the fields';
    }
}
?>
<html>

<head>
    <title>Accounts Settings - SAVEYU</title>
    <meta charset='UTF-8' />

    <link rel='shortcut icon' type='image/x-icon' href='<?php echo BASE_URL; ?>assets/images/saveyu.png'>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css' />
    <script src='https://code.jquery.com/jquery-1.10.2.js'></script>

    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>
</head>

<body style="background-color: black;">
    <div class='grid-container'>

        <?php require 'left-sidebar.php' ?>

        <div class='main' style="border: none;">
            <p class='page_title mb-0' style='background-color: #1d2226; color: white; border:white'><i class='fa fa-cog mr-4' style='color: white;'></i>Settings</p>

            <div class='setting-head'>
                <div class='account-text active'  style="background-color:#1d2226">
                    <a class='bold' style="color:white;" href='<?php echo BASE_URL?>account.php'>Account</a>
                </div>
                <div class='password-text' style='border-bottom:none; background-color: #1d2226; color:white;'>
                    <a style="color: white" href='<?php echo BASE_URL;?>password.php'>Password</a>
                </div>
            </div>

            <div class='righter mt-4' style="padding: 0;">
                <div class='inner-righter'>
                    <div class='acc'>
                        <div class='acc-heading'>
                            <h5>Change your basic account settings</h5>
                        </div>
                        <div class='acc-content'>
                            <form id='account-form' method='POST'>
                                <div class='acc-wrap'>
                                    <label class='ml-3' for=''>Username</label>
                                    <div class='form-group col-auto'>
                                        <input class='form-control' style="background-color: #1d2226; border: 1px solid #38434f; color: white;" type='text' name='username' value="<?php echo $user->username;?>" />
                                        <span>
                                            <?php if ( isset( $error['username'] ) ) {
    echo $error['username'];
}
?>
                                        </span>
                                    </div>
                                </div>

<!--
                                <div class='acc-wrap'>
                                    <label class='ml-3' for=''>Email</label>
                                    <div class='form-group col-auto'>
                                        <input class='form-control' type='text' name='email' value="" />
                                        <span>
                                        </span>
                                    </div>
                                </div>
-->
                                <div class='acc-wrap'>
                                    <div class='acc-right mt-3'>
                                        <button class='new-btn' style="background-color: white; color: black; border: none;" type='Submit' id='save' name='submit' value='Save changes'>Save</button>
                                    </div>
                                    <div class='settings-error'>
                                        <?php if ( isset( $error['fields'] ) ) {
                                            echo $error['fields'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class='content-setting'>
                        <div class='content-heading'>

                        </div>
                        <div class='content-content'>
                            <div class='content-left'>

                            </div>
                            <div class='content-right'>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--RIGHTER ENDS-->
        </div>
        <!--CONTAINER_WRAP ENDS-->

        <div class='popupPost'></div>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/search.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/hashtag.js'></script>

        <?php require 'right-sidebar.php' ?>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/follow.js'></script>

        <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/popper.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/bootstrap.min.js'></script>

        <!-- SCRIPTS -->
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/like.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/repost.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/popupposts.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/delete.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/comment.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/popupForm.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/fetch.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/messages.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/notification.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/postMessage.js'></script>

</body>

</html>
