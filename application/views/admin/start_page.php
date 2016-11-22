<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: start_page.php
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
    <?php
    $this->load->view("templates/meta_common");
    $this->load->view("templates/css_common");
    ?>
    <title>Video Game Portal Admin</title>
</head>
<body>
    <div class="container">
        <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

        <div class="page-header">
            <h1><i class="text-info fa fa-gamepad"></i> Welcome to <span class="text-primary"><?=SITE_NAME?></span></h1>
        </div>
        <p class="lead">
            Click on any of the links listed in the navbar above.
        </p>

        <?php $this->load->view("admin/_templates/user_message_view"); ?>

        <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
    </div>

    <?php $this->load->view("templates/js_common"); ?>
</body>
</html>
