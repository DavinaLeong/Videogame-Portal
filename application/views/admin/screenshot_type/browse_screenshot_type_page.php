<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_screenshot_type_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $screenshot_types
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
        .button-col
        {
            width: 15%;
        }
    </style>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o fa-fw"></i> Browse Screenshot Types <span class="badge"><?=$total_entries?></span>&nbsp;
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#new_screenshot_type_modal">
                <i class="fa fa-plus fa-fw"></i> New Screenshot Type</button>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

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
                            echo '<span class="vgp-text-placeholder">No description</span>';
                        }
                        ?>
                    </td>

                    <td class="button-col">
                        <div class="btn-group">
                            <button name="edit" onclick="window.location.href = '<?=site_url("admin/screenshot_type/edit_screenshot_type") . "/" . $screenshot_type["ss_type_id"]?>'" type="button" class="btn btn-default" data-toggle="modal" data-target="#edit_modal"><i class="fa fa-pencil-square-o"></i> Edit</button>
                            <button name="delete" onclick="onDeleteButtonClicked(<?=$screenshot_type['ss_type_id']?>)" type="button" class="btn btn-default confirm-delete" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- New Screenshot Type Modal -->
    <div class="modal fade" id="new_screenshot_type_modal">
        <div class="modal-dialog">

            <form method="post" action="<?=site_url('admin/screenshot_type/new_screenshot_type')?>" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus fa-fw"></i> Add New Screenshot Type</h4>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="ss_type_name">Name <span class="text-danger">*</span></label>
                            <input name="ss_type_name" class="form-control" type="text" placeholder="Name" data-parsley-maxlength="32" data-parsley-required />
                            <span class="help-block">Limited to 32 characters.</span>
                        </div>

                        <div class="form-group">
                            <label for="ss_type_description">Description</label>
                            <textarea name="ss_type_description" id="ss_type_description" class="form-control" rows="3" data-parsley-maxlength="512"></textarea>
                            <span class="help-block">Limited to 512 characters.</span>
                        </div>

                        <p class="text-danger text-right">* required fields</p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i
                                class="fa fa-check"></i> Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-trash fa-fw"></i> Delete Screenshot Type</h4>
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
</body>
</html>
