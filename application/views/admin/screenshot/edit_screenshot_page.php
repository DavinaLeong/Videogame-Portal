<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: edit_screenshot_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 01 Feb 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $screenshot
 * @var $videogames
 * @var $screenshot_types
 */
?>

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
        <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

        <div class="page-header">
            <h1><i class="text-info fa fa-plus"></i> Add Screenshot <button name="browse" onclick="window.location.replace('<?=site_url("admin/screenshot/browse_screenshot/")?>')" class="btn btn-default">
                <i class="fa fa-file-text-o"></i> Browse Screenshots
            </button> </h1>
            <p class="lead">
                Fill in the fields and click <span class="text-info">Submit</span> to add a new screenshot.
            </p>
        </div>

        <?php $this->load->view("admin/_templates/user_message_view"); ?>
        <?php $this->load->view("admin/_templates/form_validation_view"); ?>

        <form class="form-horizontal" method="post" role="form" data-parsley-validate>
            <div class="row">
                <div class="col-md-10">

                    <div class="form-group">
                        <label for="ss_name" class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ss_name" placeholder="Name" value="<?=$screenshot['name']?>" required data-parsley-maxlength="512"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="vg_id" class="col-sm-3 control-label">Videogame <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="vg_id">
                                <?php
                                foreach($videogames as $videogame):
                                    if($screenshot["vg_id"] == $videogame["vg_id"])
                                    {
                                        $selected_vg_id = TRUE;
                                    }
                                    else
                                    {
                                        $selected_vg_id = FALSE;
                                    }
                                    ?>
                                    <option value="<?=$videogame['vg_id']?>" <?=set_select("vg_id", $videogame["vg_id"], $selected_vg_id)?>><?=$videogame['vg_name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea name="ss_description" id="ss_description" class="form-control" rows="3" data-parsley-maxlength="256"><?=$screenshot["ss_description"]?></textarea>
                            <span class="help-block">Limited to 256 characters.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ss_type_id" class="col-sm-3 control-label">Type <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="ss_type_id">
                                <?php
                                foreach($screenshot_types as $screenshot_type):
                                    if($screenshot["ss_type_id"] == $screenshot_type["ss_type_id"])
                                    {
                                        $selected_ss_type_id = TRUE;
                                    }
                                    else
                                    {
                                        $selected_ss_type_id = FALSE;
                                    }
                                    ?>
                                    <option value="<?=$screenshot_type['ss_type_id']?>" <?=set_select("ss_type_id", $screenshot_type["ss_type_id"], $selected_ss_type_id)?>><?=$screenshot_type['ss_type_name']?></option>
                                <?php endforeach; ?>
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
                    <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/user/browse_user/")?>')"><i class="fa fa-ban"></i> Cancel</button>
                </div>
            </div>
        </form>

        <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
    </div>

</body>
</html>
