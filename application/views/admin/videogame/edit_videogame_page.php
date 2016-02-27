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
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>
    <link href="<?=RESOURCES_FOLDER?>css/bootstrap-datepicker.css" rel="stylesheet"/>

    <title>Video Game Portal Admin</title>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-pencil-square-o"></i> Edit Owned Videogame&nbsp;
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?= site_url('admin/videogame/view_videogame/' . $videogame['vg_id']) ?>"><i class="fa fa-eye"></i>&nbsp;View Videogame</a></li>
                    <li><a style="cursor: pointer;" onclick="onDeleteButtonClicked(<?=$videogame['vg_id']?>)" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i>&nbsp;Delete Videogame</a></li>
                </ul>
            </div>
        </h1>
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
                    <label for="vg_abbr" class="col-sm-3 control-label">Abbr <span class="text-danger"></span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="vg_abbr" placeholder="Abbr" value="<?=$videogame["vg_abbr"]?>" data-parsley-maxlength="32"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="genre_id" class="col-sm-3 control-label">Genre <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="genre_id">
                            <?php
                            foreach($game_genres as $game_genre):
                                if($videogame["genre_id"] === $game_genre["genre_id"])
                                {
                                    $selected_genre = TRUE;
                                }
                                else
                                {
                                    $selected_genre = FALSE;
                                }
                                ?>
                            <option value="<?=$game_genre['genre_id']?>" <?=set_select("genre_id", $game_genre["genre_id"], $selected_genre);?>><?=$game_genre['genre_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="platform_id" class="col-sm-3 control-label">Platform <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="platform_id">
                            <?php
                            foreach($game_platforms as $game_platform):
                                if($videogame["platform_id"] === $game_platform["platform_id"])
                                {
                                    $selected_platform = TRUE;
                                }
                                else
                                {
                                    $selected_platform = FALSE;
                                }
                                ?>
                            <option value="<?=$game_platform['platform_id']?>" <?=set_select("platform_id", $game_platform["platform_id"], $selected_platform);?>><?=$game_platform['platform_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Date Purchased</label>
                    <div class="col-sm-9">
                        <?php $date_purchased = new DateTime($videogame["date_purchased"], new DateTimeZone(DATETIMEZONE)); ?>
                        <input type="text" id="date_purchased" class="form-control" name="date_purchased" placeholder="dd-mm-yyyy" value="<?=$date_purchased->format('d-m-Y')?>" data-parsley-maxlength="64"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_added" class="col-sm-3 control-label">Date Added</label>
                    <p class="col-sm-9 form-control-static text-muted"><?=$videogame["vg_date_added"]?></p>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Last Updated</label>
                    <p class="col-sm-9 form-control-static text-muted"><?=$videogame["vg_last_updated"]?></p>
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
                <h4 class="modal-title">Delete Videogame</h4>
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
<script src="<?=RESOURCES_FOLDER?>js/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function(){
        $("#date_purchased").datepicker({
            format: "dd-mm-yyyy"
        });
    });

    var delete_vg_id = 0;
    function onDeleteButtonClicked(vg_id)
    {
        delete_vg_id = vg_id;
    }

    function OnConfirmDelete()
    {
        window.location.href = "<?=site_url('admin/videogame/delete_videogame')?>" + "/" + delete_vg_id;
    }
</script>
</body>
</html>
