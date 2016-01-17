<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: login_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
 **********************************************************************************/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>
    <link href="<?=RESOURCES_FOLDER?>/css/parsley.css" rel="stylesheet"/>
    <script src="<?=RESOURCES_FOLDER?>/js/parsley.js"></script>

    <title>Video Game Portal Admin</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-4">
                <h1>Welcome to <span class="text-info"><?=SITE_NAME?></span> Admin Portal</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <form class="form-signin" action="login" method="post" data-parsley-validate>
                    <h2 class="form-signin-heading"><i class="fa fa-sign-in text-info"></i> Please sign in</h2>

                    <?php $this->load->view("admin/_templates/user_message_view"); ?>
                    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                    <div style="height: 5px"></div>
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required >
                    <div style="height: 20px"></div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>

                <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
            </div>
        </div>
    </div>
</body>
</html>
