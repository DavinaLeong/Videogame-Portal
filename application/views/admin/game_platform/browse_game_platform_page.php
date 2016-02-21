<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_user_page.php
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
 * @var $game_platforms
 * @var $total_entries
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>
    <link rel="stylesheet" type="text/css" href="<?=RESOURCES_FOLDER?>css/datatables.min.css"/>

    <title>Video Game Portal Admin</title>

    <style type="text/css">
        .button-col {
            width: 22%;
        }
    </style>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o"></i> Browse Game Platforms <span class="badge"><?=$total_entries?></span>&nbsp;
            <button onclick="window.location.replace('<?= site_url("admin/game_platform/new_game_platform/") ?>')" type="button"
                    class="btn btn-danger"><i class="fa
            fa-plus"></i> Add Game Platform
            </button>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <div class="table-responsive">
        <table class="table table-hover" id="platform_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Platform Name</th>
                <th>Platform Abbr</th>
                <th>Platform Logo</th>
                <th>Platform Developer</th>
                <th>First Release (Year)</th>
                <th class="button-col">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($game_platforms as $index=>$game_platform): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?=$game_platform["platform_name"]?></td>
                    <td><span class="badge" style="background-color: <?=$game_platform["platform_label_col"]?>;"><?=$game_platform["platform_abbr"]?></span></td>
                    <td>
                        <?php if($game_platform["platform_logo_url"]): ?>
                            <img class="img-rounded" src="<?=site_url('uploads/' . $game_platform["platform_logo_url"])?>" alt="<?=$game_platform['platform_name']?>_avatar" width="50px" height="50px"/>
                        <?php else: ?>
                            <span class="text-placeholder">No logo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($game_platform["platform_developer"] == "none"): ?>
                            <span class="text-placeholder"><?=$game_platform["platform_developer"]?></span>
                        <?php elseif($game_platform["platform_developer"]):
                            echo $game_platform["platform_developer"];
                        else:
                            ?>
                            <span class="text-placeholder-left">NA</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if($game_platform["year_intro"] == "0"): ?>
                            <span class="text-placeholder-left"><?= $game_platform["year_intro"] ?></span>
                        <?php else: ?>
                            <?= $game_platform["year_intro"] ?>
                        <?php endif; ?>
                    </td>

                    <td class="button-col">
                        <div class="btn-group">
                            <button name="view" onclick="window.location.replace('<?=site_url("admin/game_platform/view_game_platform/".$game_platform["platform_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-eye"></i> View</button>
                            <button name="edit" onclick="window.location.replace('<?=site_url("admin/game_platform/edit_game_platform/".$game_platform["platform_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                            <button name="delete" onclick="onDeleteButtonClicked(<?=$game_platform['platform_id']?>)" type="button" class="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Game Platform</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                    <p>This action <strong class="text-danger">cannot</strong> be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="OnConfirmDelete()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>
<?php $this->load->view("templates/js_common"); ?>
<script type="text/javascript" src="<?=RESOURCES_FOLDER?>js/datatables.min.js"></script>

<script>
    $(document).ready(function()
    {
        $("#platform_table").dataTable();
    });

    var delete_platform_id = 0;
    function onDeleteButtonClicked(platform_id)
    {
        delete_platform_id = platform_id;
    }

    function OnConfirmDelete()
    {
        var delete_platform_url = "<?=site_url('admin/game_platform/delete_game_platform')?>" + "/" + delete_platform_id;
        window.location.href = delete_platform_url;
    }
</script>
</body>
</html>
