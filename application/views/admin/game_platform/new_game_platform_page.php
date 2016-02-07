<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: new_game_platform_page.php
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
 * @var $total_entries
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $this->load->view("templates/meta_common");
    $this->load->view("templates/css_common");
    $this->load->view("templates/js_common");
    $this->load->view("admin/_templates/datepicker_view");
    ?>

    <title>Video Game Portal Admin</title>

    <script>
        $(document).ready(function()
        {
            $("#date_purchased").datepicker({
                format: "dd-mm-yyyy"
            });
        });
    </script>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1><i class="text-info fa fa-plus"></i> New Game Platform <button name="browse" onclick="window.location.replace('<?=site_url("admin/game_platform/browse_game_platform/")?>')" class="btn btn-default">
            <i class="fa fa-file-text-o"></i> Browse Game Platforms
        </button></h1>
        <p class="lead">
            Fill in the fields and click <span class="text-info">Submit</span> to add a new Game Platform.
        </p>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>
    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

    <form class="form-horizontal" method="post" role="form" data-parsley-validate>
        <div class="row">
            <div class="col-md-10">

                <div class="form-group">
                    <label for="platform_name" class="col-sm-3 control-label">Platform Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="platform_name" placeholder="Platform Name <?=$total_entries?>" data-parsley-required data-parsley-maxlength="64"/>
                        <span class="help-block">Limited to 64 characters.</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="platform_abbr" class="col-sm-3 control-label">Abbr. <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="platform_abbr" placeholder="Abbreviation" value="" data-parsley-required data-parsley-type="alphanum" data-parsley-maxlength="16"/>
                        <span class="help-block">Limited to 16 characters.</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="year_intro" class="col-sm-3 control-label">First Release (Year) <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="year_intro" placeholder="0" data-parsley-required data-parsley-type="digits" data-parsley-maxlength="4"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="platform_developer" class="col-sm-3 control-label">Platform Developer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="platform_developer" placeholder="Developer" data-parsley-maxlength="128"/>
                        <span class="help-block">Limited to 128 characters.</span>
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
                <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/game_platform/browse_game_platform/")?>')"><i class="fa fa-ban"></i> Cancel</button>
            </div>
        </div>
    </form>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>

</body>
</html>
