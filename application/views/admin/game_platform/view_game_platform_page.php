<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: view_game_platform_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 16 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->

<?php
/**
 * @var $game_platform
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $this->load->view("templates/meta_common");
    $this->load->view("templates/css_common");
    ?>
    <title>Video Game Portal Admin</title>

    <style type="text/css">
    th
    {
        text-align: left;
        background-color: #eee;
        width: 16%;
    }

    .platform-info
    {
        font-size: 16pt;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php $this->load->view("admin/admin_navbar"); ?>

        <div class="page-header">
            <h1><i class="text-info fa fa-eye"></i> View Game Platform</h1>

            <div class="btn-group" role="group" aria-label="actionButtonGroup">
                <button name="browse" onclick="window.location.replace('<?=site_url("admin/game_platform/browse_game_platform")?>')" class="btn btn-default">
                    <i class="fa fa-file-text-o"></i> Browse
                </button>

                <button name="back" onclick="window.location.replace('<?=site_url("admin/game_platform/add_game_platform")?>')"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Add
                </button>

                <button name="edit" onclick="window.location.replace('<?=site_url("admin/game_platform/edit_game_platform/".$game_platform["platform_id"])?>')" type="button" class="btn btn-default">
                    <i class="fa fa-pencil-square-o"></i> Edit
                </button>

                <button name="delete" onclick="onDeleteButtonClicked(<?=$game_platform['platform_id']?>)"
                        class="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
        </div>

        <?php $this->load->view("admin/template_user_message"); ?>

        <h2>
            <?php
            echo $game_platform["platform_name"];
            if($game_platform["abbr"])
            {
                echo '&nbsp;<span class="badge">' . $game_platform['abbr'] . '</span>';
            }
            ?>
        </h2>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="row">
                    <div class="image-preview">
                        <img class="img-rounded" src="<?=site_url('uploads/' . $game_platform['logo_url'])?>" alt="<?=$game_platform['platform_name']?>
                        avatar" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 platform-info" style="font-weight: bold;">Platform ID:</div>
                    <div class="col-sm-2 platform-info"><?=$game_platform["platform_id"]?></div>

                    <div class="col-sm-3 platform-info" style="font-weight: bold;">Platform Develper:</div>
                    <div class="col-sm-5 platform-info"><?=$game_platform["developer"]?></div>
                </div>
            </div>
        </div>

        <?php $this->load->view("admin/admin_footer"); ?>
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
