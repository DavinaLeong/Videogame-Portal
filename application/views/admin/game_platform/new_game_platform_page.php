<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: new_game_platform_page.php
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
        <h1><i class="text-info fa fa-plus"></i> New Game Platform</h1>
        <p class="lead">
            Fill in the fields and click <span class="text-info">Submit</span> to add a new Game Platform.
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
                    <label for="name" class="col-sm-3 control-label">Platform Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="platform_name" placeholder="Platform Name" value="<?=set_value('Platform Name')?>" required data-parsley-maxlength="20"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Year Introduced <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="year_intro" placeholder="0" value="<?=set_value('0')?>" required data-parsley-type="digits" data-parsley-maxlength="4"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Platform Manufacturer <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="manufacturer" placeholder="Manufacturer" value="<?=set_value('Manufacturer')?>" data-parsley-maxlength="20"/>
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
                <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/game_platform/browse_game_platform/")?>')"><i class="fa fa-chevron-left"></i> Back</button>
            </div>
        </div>
    </form>

    <?php $this->load->view("admin/admin_footer"); ?>
</div>

</body>
</html>