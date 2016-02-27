<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: edit_screenshot_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 01 Feb 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $screenshot
 * @var $videogames
 * @var $screenshot_types
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
            <i class="text-info fa fa-plus"></i> Edit Screenshot&nbsp;
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?= site_url('admin/screenshot/view_screenshot/' . $screenshot['ss_id']) ?>"><i class="fa fa-eye"></i>&nbsp;View Screenshot</a></li>
                    <li><a style="cursor: pointer;" onclick="onDeleteButtonClicked(<?=$screenshot['ss_id']?>)" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i>&nbsp;Delete Screenshot</a></li>
                </ul>
            </div>
        </h1>
        <p class="lead">
            Fill in the fields and click <span class="text-info">Submit</span> to add a new screenshot.
        </p>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>
    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

    <div class="row">
        <div class="col-md-10">
            <div class="well well-sm" style="background-color: transparent">
                <p><b>Upload Screenshot</b></p>
                <?php
                $str_display_width_height = "";
                if($screenshot["ss_width"] > DISPLAY_SCREENSHOT_WIDTH)
                {
                    $str_display_width_height .= 'width="' . DISPLAY_SCREENSHOT_WIDTH . 'px"';
                }

                if($screenshot["ss_height"] > DISPLAY_SCREENSHOT_HEIGHT)
                {
                    $str_display_width_height .= 'height="' . DISPLAY_SCREENSHOT_HEIGHT . 'px"';
                }
                ?>
                <div class="text-center">
                    <img src="<?=UPLOADS_FOLDER.$screenshot['ss_url']?>"
                         alt="<?=$screenshot['ss_name']?>" <?=$str_display_width_height?>/>
                </div>
                <p class="text-danger"><?= $this->session->userdata("file_upload_errors") ?></p>
                <button class="btn btn-success center-div" style="margin: 0 auto;" data-toggle="modal"
                        data-target="#uploadModal"><i class="fa fa-upload"></i> Upload Screenshot
                </button>
            </div>
        </div>
    </div>

    <form class="form-horizontal" method="post" role="form" data-parsley-validate>
        <div class="row">
            <div class="col-md-10">

                <div class="form-group">
                    <label for="ss_name" class="col-md-3 control-label">Name <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="ss_name" <?=$str_display_width_height?> placeholder="Name" value="<?=$screenshot['ss_name']?>" required data-parsley-maxlength="512"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="vg_id" class="col-md-3 control-label">Videogame <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="vg_id">
                            <?php
                            foreach($videogames as $videogame):
                                if($screenshot["vg_id"] == $videogame["vg_id"])
                                {
                                    $selected_vg_id = TRUE;
                                }
                                else
                                {
                                    $selected_vg_id = FALSE;
                                }
                                ?>
                                <option value="<?=$videogame['vg_id']?>" <?=set_select("vg_id", $videogame["vg_id"], $selected_vg_id)?>><?=$videogame['vg_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Description</label>
                    <div class="col-md-9">
                        <textarea name="ss_description" id="ss_description" class="form-control" rows="3" data-parsley-maxlength="256"><?=$screenshot["ss_description"]?></textarea>
                        <span class="help-block">Limited to 512 characters.</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ss_type_id" class="col-md-3 control-label">Type <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="ss_type_id">
                            <?php
                            foreach($screenshot_types as $screenshot_type):
                                if($screenshot["ss_type_id"] == $screenshot_type["ss_type_id"])
                                {
                                    $selected_ss_type_id = TRUE;
                                }
                                else
                                {
                                    $selected_ss_type_id = FALSE;
                                }
                                ?>
                                <option value="<?=$screenshot_type['ss_type_id']?>" <?=set_select("ss_type_id", $screenshot_type["ss_type_id"], $selected_ss_type_id)?>><?=$screenshot_type['ss_type_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-9 col-md-offset-3">
                    <p class="text-danger">* required fields</p>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                <button type="button" class="btn btn-default" onclick="window.location.href = '<?=site_url("admin/user/browse_user/")?>'"><i class="fa fa-ban"></i> Cancel</button>
            </div>
        </div>
    </form>

    <!-- Upload Image Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form role="form" action="<?= site_url('admin/screenshot/upload_screenshot/') ?>" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="uploadModalLabel">Upload New Screenshot</h4>
                    </div>
                    <div class="modal-body">
                        <input type="file" class="form-control" id="ss_url" name="ss_url"
                               placeholder="screenshot url">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i>
                            Cancel
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
<script>
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
