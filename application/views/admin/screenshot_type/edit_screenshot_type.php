<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: edit_screenshot_type_page.php
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
 * @var $screenshot_type
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $this->load->view("templates/meta_common");
    $this->load->view("templates/css_common");
    $this->load->view("templates/js_common");
    ?>
    <title>Video Game Portal Admin</title>
</head>
<body>
<div class="container">
    <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1><i class="text-info fa fa-pencil-square-o"></i> Edit Screenshot Type</h1>

        <p class="lead">
            Edit the fields and click <span class="text-info">Submit</span> to save changes.
        </p>

        <div class="btn-group" role="group" aria-label="actionButtonGroup">
            <button name="browse" onclick="window.location.replace('<?=site_url("admin/screenshot_type/browse_screenshot_type")?>')" class="btn btn-default">
                <i class="fa fa-file-text-o"></i> Browse
            </button>

            <button name="back" data-toggle="modal" data-target="#confirm_delete_modal" class="btn btn-default" onclick="onDeleteButtonClicked(<?=$screenshot_type['ss_type_id']?>)">
                <i class="fa fa-trash"></i> Delete
            </button>
        </div>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>
    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

    <div class="row">
        <!-- Details Column -->
        <div class="col-md-10 col-md-offset-1">
            <form class="form-horizontal" method="post" role="form" data-parsley-validate>

                <div class="row">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ss_type_name" placeholder="name"
                                   value="<?= $screenshot_type["ss_type_name"] ?>" data-parsley-maxlength="512"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ss_type_description" placeholder="username"
                                   value="<?= $screenshot_type["ss_type_description"] ?>" data-parsley-maxlength="512"/>
                        </div>
                    </div>

                    <div class="col-sm-9 col-sm-offset-3">
                        <p class="text-danger">* required fields</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                        <button type="button" class="btn btn-default"
                                onclick="window.location.replace('<?= site_url("admin/screenshot_type/browse_screenshot_type") ?>')">
                            <i class="fa fa-ban"></i> Cancel
                        </button>
                    </div>
                </div>

            </form>
        </div>
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
    $this->load->view("admin/_templates/admin_footer_view");
    $this->load->view("templates/js_common");
    ?>

    <script>
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
