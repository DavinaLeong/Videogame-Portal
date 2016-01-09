<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: new_videogame_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 08 Jan 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var game_genres
 * @var game_platforms
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
    $(document).ready(function(){
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
            <h1><i class="text-info fa fa-plus"></i> Add Owned Videogame <button name="browse" onclick="window.location.replace('<?=site_url("admin/videogame/browse_videogame/")?>')" class="btn btn-default">
                <i class="fa fa-file-text-o"></i> Browse Owned Videogames
            </button> </h1>
            <p class="lead">
                Fill in the fields and click <span class="text-info">Submit</span> to save.
            </p>
        </div>

        <?php $this->load->view("admin/_templates/user_message_view"); ?>
        <?php $this->load->view("admin/_templates/form_validation_view");?>

        <form class="form-horizontal" method="post" role="form" data-parsley-validate>
            <div class="row">
                <div class="col-md-10">

                    <div class="form-group">
                        <label for="vg_name" class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vg_name" placeholder="Videogame" required data-parsley-maxlength="64"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="genre_id" class="col-sm-3 control-label">Genre <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="genre_id">
                                <?php foreach($game_genres as $game_genre): ?>
                                <option value="<?=$game_genre['genre_id']?>"><?=$game_genre['genre_name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="platform_id" class="col-sm-3 control-label">Platform <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="platform_id">
                                <?php foreach($game_platforms as $game_platform): ?>
                                <option value="<?=$game_platform['platform_id']?>"><?=$game_platform['platform_name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_purchased" class="col-sm-3 control-label">Date Purchased <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="date_purchased" class="form-control" name="date_purchased" placeholder="dd-mm-yyyy" required data-parsley-maxlength="64"/>
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
