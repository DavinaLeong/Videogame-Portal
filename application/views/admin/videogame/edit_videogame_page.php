<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: edit_videogame_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 15 Jan 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $videogame
 * @var $game_genres
 * @var $game_platforms
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
            <h1><i class="text-info fa fa-pencil-square-o"></i> Edit Owned Videogame</h1>

            <div class="btn-group" role="group" aria-label="actionButtonGroup">
                <button name="browse" onclick="window.location.replace('<?=site_url("admin/videogame/browse_videogame")?>')" class="btn btn-default">
                    <i class="fa fa-file-text-o"></i> Browse
                </button>

                <button name="back" onclick="window.location.replace('<?=site_url("admin/videogame/new_videogame/")?>')" type="button"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Add
                </button>

                <button name="edit" onclick="window.location.replace('<?=site_url("admin/videogame/view_videogame/".$videogame["vg_id"])?>')" type="button" class="btn btn-default">
                    <i class="fa fa-eye"></i> View
                </button>

                <button name="delete" onclick="onDeleteButtonClicked(<?=$videogame['vg_id']?>)"
                        class="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
        </div>

        <?php $this->load->view("admin/_templates/user_message_view"); ?>
        <?php $this->load->view("admin/_templates/form_validation_view");?>

        <form class="form-horizontal" method="post" role="form" data-parsley-validate>
            <div class="row">
                <div class="col-md-10">

                    <div class="form-group">
                        <label for="vg_name" class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vg_name" placeholder="Videogame" value="<?=$videogame["vg_name"]?>" required data-parsley-maxlength="64"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="genre_id" class="col-sm-3 control-label">Genre <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="genre_id" value="<?=$videogame['genre_id']?>">
                                <?php foreach($game_genres as $game_genre): ?>
                                <option value="<?=$game_genre['genre_id']?>"><?=$game_genre['genre_name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="platform_id" class="col-sm-3 control-label">Platform <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="platform_id" value="<?=$videogame['platform_id']?>">
                                <?php foreach($game_platforms as $game_platform): ?>
                                <option value="<?=$game_platform['platform_id']?>"><?=$game_platform['platform_name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_purchased" class="col-sm-3 control-label">Date Purchased <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <?php $date_purchased = new DateTime($videogame["date_purchased"], new DateTimeZone(DATETIMEZONE)); ?>
                            <input type="text" id="date_purchased" class="form-control" name="date_purchased" value="<?=$date_purchased->format('d-m-Y');?>" placeholder="dd-mm-yyyy" required data-parsley-maxlength="64"/>
                        </div>
                    </div>

                    <div class="col-sm-9 col-sm-offset-3 checkbox">
                        <?php
                        $checked = "";
                        if($videogame["from_steam"] && $videogame["from_steam"] == "1")
                        {
                            $checked = "checked";
                        }
                        ?>
                        <label>
                            <input type="checkbox" name="from_steam" checked="<?=$checked?>"> Steam Purchase
                        </label>
                    </div>

                    <div class="col-sm-9 col-sm-offset-3">
                        <p class="text-danger text-right">* required fields</p>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                    <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/videogame/browse_videogame/")?>')"><i class="fa fa-ban"></i> Cancel</button>
                </div>
            </div>
        </form>

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

    <script>
        var delete_platform_id = 0;
        function onDeleteButtonClicked(platform_id)
        {
            delete_platform_id = platform_id;
        }

        function OnConfirmDelete()
        {
            var delete_platform_url = "<?=site_url('admin/videogame/delete_videogame')?>" + "/" + delete_platform_id;
            window.location.href = delete_platform_url;
        }
    </script>
</body>
</html>
