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
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>

    <title>Video Game Portal Admin</title>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1><i class="text-info fa fa-plus"></i> New Game Platform</h1>
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
                    </div>
                </div>

                <div class="form-group">
                    <label for="platform_abbr" class="col-sm-3 control-label">Abbr. <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="platform_abbr" placeholder="Abbreviation" value="" data-parsley-required data-parsley-type="alphanum" data-parsley-maxlength="16"/>
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
                    </div>
                </div>

                <div class="form-group">
                    <label for="platform_label_col" class="col-sm-3 control-label">Label Color</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="platform_label_col" placeholder="Hex value" data-parsley-maxlength="7" data-parsley-pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$"/>
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
                <button type="button" class="btn btn-default" onclick="window.location.href = '<?=site_url("admin/game_platform/browse_game_platform/")?>'"><i class="fa fa-ban"></i> Cancel</button>
            </div>
        </div>
    </form>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>
<?php $this->load->view("templates/js_common"); ?>
<script src="<?=RESOURCES_FOLDER?>js/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function()
    {
        $("#date_purchased").datepicker({
            format: "dd-mm-yyyy"
        });
    });
</script>
</body>
</html>
