<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: add_user_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $this->load->view("templates/meta_common");
    $this->load->view("templates/css_common");
    $this->load->view("templates/js_common");
    ?>
    <title>Video Game Portal Admin</title>
</head>
<body>
    <div class="container">
        <?php $this->load->view("admin/admin_navbar"); ?>

        <div class="page-header">
            <h1><i class="text-info fa fa-plus"></i> Add New User</h1>
            <p class="lead">
                Fill in the fields and click <span class="text-info">Submit</span> to add a new user.
            </p>
        </div>

        <?php if($this->session->userdata('message')):?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <?=$this->session->userdata('message')?>
            </div>
            <?php $this->session->unset_userdata('message') ?>
        <?php endif;?>
        <?php if(validation_errors()):?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <?=validation_errors();?>
            </div>
        <?php endif;?>
        <form class="form-horizontal" method="post" role="form" data-parsley-validate>
            <div class="row">
                <div class="col-md-10">

                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="name" value="<?=set_value('name')?>" required data-parsley-maxlength="512"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" placeholder="username" value="<?=set_value('username')?>" required data-parsley-maxlength="512"/>
                        </div>
                    </div>
                    <div class="space col-sm-12">&nbsp;</div>

                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="password" type="password" class="form-control" name="password" placeholder="password" value="<?=set_value('password')?>" required data-parsley-minlength="8"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-3 control-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="password" value="<?=set_value('password')?>" required data-parsley-minlength="8" data-parsley-equalto="#password"/>
                        </div>
                    </div>
                    <div class="space col-sm-12">&nbsp;</div>

                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Account Status <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status">
                                <option>Active</option>
                                <option>Not Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="access" class="col-sm-3 control-label">Access Rights <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="access">
                                <option>A</option>
                                <option>M</option>
                                <option>U</option>
                            </select>
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
                    <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/user/browse_user/")?>')"><i class="fa fa-chevron-left"></i> Back</button>
                </div>
            </div>
        </form>

        <?php $this->load->view("admin/admin_footer"); ?>
    </div>

</body>
</html>
