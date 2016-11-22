<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: new_game_genre_page.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 06 Jan 2016

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

    <title>Video Game Portal Admin</title>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1><i class="text-info fa fa-plus"></i> Add Game Genre</h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>
    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

    <form class="form-horizontal" method="post">

        <div class="row">
            <div class="col-md-10">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="genre_name">Name <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input class="form-control" name="genre_name" type="text" placeholder="Name" data-parsley-maxlength="32" data-parsley-required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="genre_abbr">Abbr. <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input class="form-control" name="genre_abbr" type="text" placeholder="abbr" data-parsley-maxlength="32" data-parsley-required/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="platform_label_col" class="col-sm-3 control-label">Label Color</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="platform_label_col" placeholder="000000" data-parsley-maxlength="7" data-parsley-pattern="<?=HEX_REGEX_PARSLEY;?>"/>
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
                <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/game_genre/browse_game_genre/")?>')" ><i class="fa fa-ban"></i> Cancel</button>
            </div>
        </div>

    </form>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>
<?php $this->load->view("templates/js_common"); ?>
</body>
</html>
