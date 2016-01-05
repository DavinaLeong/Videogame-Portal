<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: browse_screenshot_type_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content � DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->

<?php
/**
 * @var $screenshot_types
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
    <?php $this->load->view("admin/admin_navbar"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o"></i> Browse Game Platforms&nbsp;
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#new_screenshot_type_modal">
                <i class="fa fa-plus"></i> Add Game Platform</button>
        </h1>
    </div>

    <?php $this->load->view("admin/template_user_message"); ?>

    <div class="table-responsive">
        <table class="table table-hover" id="ss_type_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Screenshot Type Name</th>
                <th>Screenshot Description</th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($screenshot_types as $index=>$screenshot_type): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?=$screenshot_type["ss_type_name"]?></td>
                    <td>
                        <?php
                        if($screenshot_type["ss_type_description"])
                        {
                            echo $screenshot_type["ss_type_description"];
                        }
                        else
                        {
                            echo '<span class="text-placeholder">No description</span>';
                        }
                        ?>
                    </td>

                    <td class="button-col">
                        <button name="edit" onclick="window.location.replace('<?=site_url("admin/screenshot_type/edit_screenshot_type") . "/" . $screenshot_type["ss_type_id"]?>')" type="button" class="btn btn-default" data-toggle="modal" data-target="#edit_modal"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        <button name="delete" onclick="onDeleteButtonClicked(<?=$screenshot_type['ss_type_id']?>)" type="button" class="btn btn-default confirm-delete" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i> Delete</button>
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
                    <h4 class="modal-title">Delete Screenshot Type</h4>
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

    <?php
    $this->load->view("admin/admin_footer");
    $this->load->view("templates/js_common");
    $this->load->view("templates/datatables_resources");
    ?>

    <script>
        $(document).ready(function()
        {
            $("#ss_type_table").dataTable();
        });

        var ss_type_id = 0;
        function onDeleteButtonClicked(delete_ss_type_id)
        {
            ss_type_id = delete_ss_type_id;
        }

        function onConfirmDelete()
        {
            window.location.href = "<?=site_url('admin/screenshot_type/delete_screenshot_type')?>/" + ss_type_id;
        }
    </script>
</div>
</body>
</html>
