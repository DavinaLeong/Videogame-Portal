<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: browse_user_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->

<?php
/**
 * @var $game_platforms
 * @var $per_page
 * @var $offset
 * @var $total_rows
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

    <style type="type/css">
        .button-col
        {
            width: 10%;
        }
    </style>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/admin_navbar"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o"></i> Browse Game Platforms&nbsp;
            <button onclick="window.location.replace('<?= site_url("admin/game_platform/add_game_platform/") ?>')" type="button"
                    class="btn btn-danger"><i class="fa
            fa-plus"></i> Add Game Platform
            </button>
        </h1>
    </div>

    <?php if ($this->session->userdata('message')): ?>
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>
            <?= $this->session->userdata('message') ?>
        </div>
        <?php $this->session->unset_userdata('message') ?>
    <?php endif; ?>

    <p class="search-results">
        <?php
        if($offset <= 0)
        {
            $offset_str = "1";
        }
        else
        {
            $offset_str = $offset;
        }

        $current_showed = $offset + $per_page;
        if($current_showed > $total_rows)
        {
            $current_showed = $total_rows;
        }
        echo "Showing " . $offset_str . " &ndash; " . $current_showed . " of " . $total_rows . " entries";
        ?>
    </p>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Platform Name</th>
                <th>Platform Logo</th>
                <th>Platform Developer</th>
                <th>Year Intro</th>
                <th class="button-col">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($game_platforms as $index=>$game_platform): ?>
                <tr>
                    <td><?= $index + 1 + $offset; ?></td>
                    <td><?=$game_platform["platform_name"]?></td>
                    <td>
                        <?php if($game_platform["logo_url"]): ?>
                            <img class="img-rounded" src="<?=site_url('uploads/' . $game_platform["logo_url"])?>" alt="<?=$game_platform['platform_name']?>_avatar" width="50px" height="50px"/>
                        <?php else: ?>
                            <span class="text-placeholder">No logo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($game_platform["manufacturer"]): ?>
                            <?=$game_platform["manufacturer"]?>
                        <?php else: ?>
                            <span class="text-placeholder">No Manufacturer</span>
                        <?php endif; ?>
                    </td>

                    <td><?=$game_platform["year_intro"]?></td>

                    <td class="button-col">
                        <button name="view_post" onclick="window.location.replace('<?=site_url("admin/game_platform/view_game_platform/".$game_platform["platform_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-eye"></i> View</button>
                        <button name="edit_post" onclick="window.location.replace('<?=site_url("admin/game_platform/edit_game_platform/".$game_platform["platform_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        <button name="edit_post" onclick="window.location.replace('<?=site_url("admin/game_platform/edit_game_platform/".$game_platform["platform_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-trash"></i> Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="search-results">
        <?= "Showing " . $offset_str . " &ndash; " . $current_showed . " of " . $total_rows . " entries"; ?>
    </p>

    <?php $this->load->view("admin/admin_footer"); ?>
</div>
</body>
</html>
