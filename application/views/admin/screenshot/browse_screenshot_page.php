<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_screenshot_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 01 Feb 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $screenshots
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>
    <link rel="stylesheet" type="text/css" href="<?=RESOURCES_FOLDER?>css/datatables.min.css"/>

    <title>Video Game Portal Admin</title>

</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o"></i> Browse Screenshots&nbsp;
            <button onclick="window.location.href = '<?=site_url("admin/screenshot/new_screenshot/")?>'" type="button"
                    class="btn btn-danger"><i class="fa
        fa-plus"></i> Add Screenshot</button>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <div class="table-responsive">
        <table class="table table-hover" id="screenshots_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th style="width: 20%;">Thumbnail</th>
                <th>Videogame</th>
                <th>Type</th>
                <th>Date Added</th>
                <th>Last Updated</th>
                <th style="width: 20%;">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($screenshots as $index=>$screenshot): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?=$screenshot["ss_name"]?></td>
                    <td class="text-center" style="width: 20%;"><img src="<?=UPLOADS_FOLDER.$screenshot['ss_url']?>" alt="<?=$screenshot['ss_name']?> - <?=$screenshot['vg_name']?>" width="150px"/></td>
                    <td><?=$screenshot["vg_name"]?></td>
                    <td><?=$screenshot["ss_type_name"]?></td>
                    <td>
                        <?php
                        $display_date_added = new Datetime($screenshot["date_added"], new DateTimeZone(DATETIMEZONE));
                        echo $display_date_added->format("Y/m/d");
                        ?>
                    </td>
                    <td>
                        <?php
                        $display_last_updated = new Datetime($screenshot["last_updated"], new DateTimeZone(DATETIMEZONE));
                        echo $display_last_updated->format("Y/m/d");
                        ?>
                    </td>
                    <td style="width: 20%;">
                        <button name="view_videogame" onclick="window.location.href = '<?=site_url("admin/videogame/view_videogame/".$screenshot["vg_id"])?>'" type="button" class="btn btn-default"><i class="fa fa-gamepad"></i> View Videogame</button>
                        <div class="btn-group btn-group-sm">
                            <button name="view" onclick="window.location.href = '<?=site_url("admin/screenshot/view_screenshot/".$screenshot["ss_id"])?>'" type="button" class="btn btn-default"><i class="fa fa-eye"></i> View</button>
                            <button name="edit" onclick="window.location.href = '<?=site_url("admin/screenshot/edit_screenshot/".$screenshot["ss_id"])?>'" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                            <button name="delete" onclick="onDeleteButtonClicked(<?=$screenshot['ss_id']?>)" type="button" class="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i> Delete</button>
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
                    <h4 class="modal-title">Delete Screenshot</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                    <p>This action <strong class="text-danger">cannot</strong> be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="onConfirmDelete()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>
<?php $this->load->view("templates/js_common"); ?>
<script type="text/javascript" src="<?=RESOURCES_FOLDER?>js/datatables.min.js"></script>

<script>
    $(document).ready(function()
    {
        $("#screenshots_table").dataTable();
    });

    var ss_id = 0;
    function onDeleteButtonClicked(delete_ss_id)
    {
        ss_id = delete_ss_id;
    }

    function onConfirmDelete()
    {
        window.location.href = "<?=site_url('admin/screenshot/delete_screenshot')?>/" + ss_id;
    }
</script>
</body>
</html>
