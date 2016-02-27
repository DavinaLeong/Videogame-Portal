<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: edit_game_genre_page.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 06 Jan 2016

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
 **********************************************************************************/
?>

<?php
/**
 * @var $game_genre
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
        <h1>
            <i class="text-info fa fa-plus"></i> Edit Game Genre&nbsp;
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a style="cursor: pointer;" onclick="onDeleteButtonClicked(<?=$game_genre['genre_id']?>)" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i>&nbsp;Delete Game Genre</a></li>
                </ul>
            </div>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>
    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

    <form class="form-horizontal" method="post">

        <div class="row">
            <div class="col-md-10">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="genre_name">Name <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input class="form-control" name="genre_name" type="text" value="<?=$game_genre['genre_name']?>" data-parsley-maxlength="32" data-parsley-required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="genre_abbr">Abbr. <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input class="form-control" name="genre_abbr" type="text" value="<?=$game_genre['genre_abbr']?>" data-parsley-maxlength="32" data-parsley-required/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="genre_label_col" class="col-sm-3 control-label">Label Color</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" name="genre_label_col" placeholder="Hex value" value="<?=$game_genre['genre_label_col']?>" data-parsley-maxlength="7" data-parsley-pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$"/>
                            <div class="input-group-addon"><div style="display: inline-block; background-color: <?=$game_genre['genre_label_col']?>; width: 16px; height: 16px; border: thin solid #ccc;"></div></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_added" class="col-sm-3 control-label">Date Added</label>
                    <p class="col-sm-9 form-control-static text-muted"><?=$game_genre["date_added"]?></p>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Last Updated</label>
                    <p class="col-sm-9 form-control-static text-muted"><?=$game_genre["last_updated"]?></p>
                </div>

                <div class="col-sm-9 col-sm-offset-3">
                    <p class="text-danger">* required fields</p>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                <button type="button" class="btn btn-default" onclick="window.location.href = '<?=site_url("admin/game_genre/browse_game_genre/")?>'" ><i class="fa fa-ban"></i> Cancel</button>
            </div>
        </div>

    </form>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Game Genre</h4>
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

<script>
    var delete_game_genre_id = 0;
    function onDeleteButtonClicked(game_genre_id)
    {
        delete_game_genre_id = game_genre_id;
    }

    function OnConfirmDelete()
    {
        var delete_genre_url = "<?=site_url('admin/game_genre/delete_game_genre')?>" + "/" + delete_game_genre_id;
        window.location.href = delete_genre_url;
    }
</script>
</body>
</html>
