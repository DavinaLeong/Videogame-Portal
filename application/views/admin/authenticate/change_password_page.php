<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
		File name		: change_password_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $user
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>
    <title>Video Game Portal Admin</title>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1><i class="text-info fa fa-key"></i> Change <span class="text-info"><?=$user["name"]?>'s</span>
            Password</h1>
        <p class="lead">
            Click <span class="text-info">Submit</span> to save new password.
        </p>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>
    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

    <form class="form-horizontal" method="post" role="form" data-parsley-validate>
        <div class="row">
            <div class="col-md-10">

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?=$user["name"]?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?=$user["username"]?></p>
                    </div>
                </div>
                <div class="vgp-space col-sm-12">&nbsp;</div>

                <div class="form-group">
                    <label for="old_password" class="col-sm-3 control-label">Old Password <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input id="old_password" type="password" class="form-control" name="old_password" placeholder="password" value="<?=set_value('password')?>" required data-parsley-minlength="8"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password" class="col-sm-3 control-label">New Password <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input id="new_password" type="password" class="form-control" name="new_password" placeholder="password" value="<?=set_value('password')?>" required data-parsley-minlength="8"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="col-sm-3 control-label">Confirm New Password <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="password" value="<?=set_value('password')?>" required data-parsley-minlength="8" data-parsley-equalto="#new_password"/>
                    </div>
                </div>

                <div class="col-sm-9 col-sm-offset-3">
                    <p class="text-danger">* required fields</p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                <button type="button" class="btn btn-default" onclick="window.location.href = '<?=site_url("admin/user/browse_user/")?>'"><i class="fa fa-chevron-left"></i> Back</button>
            </div>
        </div>
    </form>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>
<?php $this->load->view("templates/js_common"); ?>
</body>
</html>
