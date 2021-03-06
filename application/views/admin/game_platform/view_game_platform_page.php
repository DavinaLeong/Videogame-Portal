<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: view_game_platform_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 16 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $game_platform
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>

    <title>Video Game Portal Admin</title>

    <style type="text/css">
    th
    {
        text-align: left;
        background-color: #eee;
        width: 30%;
    }

    .platform-info
    {
        font-size: 16pt;
    }
    </style>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-eye"></i> View Game Platform&nbsp;
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?=site_url("admin/game_platform/edit_game_platform/".$game_platform["platform_id"])?>"><i class="fa fa-eye"></i>&nbsp;Edit Platform</a></li>
                    <li><a style="cursor: pointer;" onclick="onDeleteButtonClicked(<?=$game_platform['platform_id']?>)" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i>&nbsp;Delete Platform</a></li>
                </ul>
            </div>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <h2><?=$game_platform["platform_name"];?></h2>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="vgp-image-preview">
                    <?php if($game_platform["platform_logo_url"]): ?>
                        <img class="img-rounded" src="<?=site_url('uploads/' . $game_platform["platform_logo_url"])?>" alt="<?=$game_platform['platform_name']?>_avatar"/>
                    <?php else: ?>
                        <span class="vgp-text-placeholder">No logo</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Platform ID:</th>
                        <td><span class="vgp-text-placeholder-left"><?= $game_platform["platform_id"] ?></span></td>
                    </tr>
                    <tr>
                        <th>Platform Abbr:</th>
                        <td><span class="vgp-badge-platform" style="background-color: #<?=$game_platform["platform_label_col"]?>;"><?= $game_platform["platform_abbr"] ?></span></td>
                    </tr>
                    <tr>
                        <th>Platform Developer:</th>
                        <td>
                            <?php if($game_platform["platform_developer"] == "none"): ?>
                                <span class="vgp-text-placeholder-left"><?=$game_platform["platform_developer"]?></span>
                            <?php elseif($game_platform["platform_developer"]):
                                echo $game_platform["platform_developer"];
                            else:
                                ?>
                                <span class="vgp-text-placeholder">NA</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>First Year Released:</th>
                        <td>
                            <?php if(intval($game_platform["year_intro"]) == 0): ?>
                                <span class="vgp-text-placeholder-left">0</span>
                            <?php else: ?>
                                <?= $game_platform["year_intro"]; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Label Colour:</th>
                        <td><?= $game_platform["platform_label_col"]; ?></td>
                    </tr>
                    <tr>
                        <th>Date Added:</th>
                        <td><span class="text-muted"><?=$game_platform["date_added"]?></span></td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td><span class="text-muted"><?=$game_platform["last_updated"]?></span></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view("templates/js_common"); ?>

<script>
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
