<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: browse_game_genre_page.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 05 Jan 2016

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $game_genres
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
        .button-col {
            width: 30%;
        }
    </style>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o"></i> Browse Game Genres <span class="badge"><?=$total_entries?></span>&nbsp;
            <button type="button" class="btn btn-danger" onclick="window.location.replace('<?=site_url("admin/game_genre/new_game_genre/")?>')" >
                <i class="fa fa-plus"></i> Add Game Genre
            </button>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <div class="table-responsive">
        <table class="table table-hover" id="genre_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Genre Abbr</th>
                <th>Genre Name</th>
                <th>Date Added</th>
                <th>Last Updated</th>
                <th class="button-col"></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($game_genres as $index=>$game_genre): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?=$game_genre["genre_name"]?></td>
                    <td>
                        <?php if (strtolower($game_genre["genre_abbr"]) == "none"): ?>
                            <span class="text-placeholder"><?=$game_genre["genre_abbr"]?></span>
                        <?php elseif ($game_genre["genre_abbr"]): ?>
                            <span class="label" style="background: #<?=$game_genre["genre_label_col"]?>"><?=$game_genre["genre_abbr"]?></span>
                        <?php else: ?>
                            <span class="text-placeholder">no abbr</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $date_added = new DateTime($game_genre["date_added"], new DateTimeZone(DATETIMEZONE)); ?>
                        <span class="text-muted">
                            <?=$date_added->format("Y-m-d");?><br/>
                            <?=$date_added->format("H:i:s");?>
                        </span>
                    </td>
                    <td>
                        <?php $last_updated = new DateTime($game_genre["last_updated"], new DateTimeZone(DATETIMEZONE)); ?>
                        <span class="text-muted">
                            <?=$last_updated->format("Y-m-d");?><br/>
                            <?=$last_updated->format("H:i:s");?>
                        </span>
                    </td>
                    <td class="button-col">
                        <button name="edit" onclick="window.location.replace('<?=site_url("admin/game_genre/edit_game_genre/".$game_genre["genre_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        <button name="delete" onclick="onDeleteButtonClicked(<?=$game_genre['genre_id']?>)" type="button" class="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i> Delete</button>
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

    <?php
    $this->load->view("admin/_templates/admin_footer_view");
    $this->load->view("templates/js_common");
    $this->load->view("templates/datatables_resources");
    ?>

    <script>
        $(document).ready(function()
        {
            $("#genre_table").dataTable();
        });

        var delete_game_genre_id = 0;
        function onDeleteButtonClicked(game_genre_id)
        {
            delete_game_genre_id = game_genre_id;
        }

        function OnConfirmDelete()
        {
            window.location.href = "<?=site_url('admin/game_genre/delete_game_genre')?>" + "/" + delete_game_genre_id;;
        }
    </script>
</div>
</body>
</html>