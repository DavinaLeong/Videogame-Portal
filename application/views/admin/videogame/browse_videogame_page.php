<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: browse_videogame_page.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 08 Jan 2016

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

        All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
 **********************************************************************************/
?>

<?php
/**
 * @var $videogames
 * @var $total_entries
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
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o"></i> Browse Videogames <span class="badge"><?=$total_entries?></span>&nbsp;
            <button onclick="window.location.replace('<?= site_url("admin/game_videogame/new_game_videogame/") ?>')" type="button"
                    class="btn btn-danger"><i class="fa
            fa-plus"></i> Add Game videogame
            </button>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <div class="table-responsive">
        <table class="table table-hover" id="videogame_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Platform</th>
                <th>Genre</th>
                <th>Logo</th>
                <th>Date Purchased</th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($videogames as $index=>$videogame): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?=$videogame["vg_name"]?></td>
                    <td><span class="badge" style="background: #<?=$videogame["platform_label_col"];?>"><?=$videogame["platform_abbr"]?></span></td>
                    <td><span class="label" style="background: #<?=$videogame["genre_label_col"]?>"><?=$videogame["genre_abbr"]?></span></td>
                    <td>
                        <?php if($videogame["platform_logo_url"]): ?>
                            <img class="img-rounded" src="<?=site_url('uploads/' . $videogame["platform_logo_url"])?>" alt="<?=$videogame['platform_abbr']?>_logo" width="50px" height="50px"/>
                        <?php else: ?>
                            <span class="text-placeholder">No logo</span>
                        <?php endif; ?>
                    </td>

                    <td>
                    <?php
                    $date_purchased = new DateTime($videogame["date_purchased"], new DateTimeZone(DATETIMEZONE));
                    echo $date_purchased->format("d M Y");
                    ?>
                    </td>

                    <td class="button-col">
                        <button name="view" onclick="window.location.replace('<?=site_url("admin/videogame/view_videogame/".$videogame["vg_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-eye"></i> View</button>
                        <button name="edit" onclick="window.location.replace('<?=site_url("admin/videogame/edit_videogame/".$videogame["vg_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        <button name="delete" onclick="onDeleteButtonClicked(<?=$videogame['vg_id']?>)" type="button" class="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i> Delete</button>
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
            $("#videogame_table").dataTable();
        });

        var delete_videogame_id = 0;
        function onDeleteButtonClicked(videogame_id)
        {
            delete_videogame_id = videogame_id;
        }

        function OnConfirmDelete()
        {
            var delete_videogame_url = "<?=site_url('admin/game_videogame/delete_game_videogame')?>" + "/" + delete_videogame_id;
            window.location.href = delete_videogame_url;
        }
    </script>
</div>
</body>
</html>
