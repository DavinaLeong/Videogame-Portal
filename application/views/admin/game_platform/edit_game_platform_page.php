<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: edit_game_platform_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->

<?php
/**
 * @var $game_platform
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
        <?php $this->load->view("admin/admin_navbar"); ?>

        <div class="page-header">
            <h1><i class="text-info fa fa-pencil-square-o"></i> Edit Game Platform</h1>

            <p class="lead">
                Edit in the fields and click <span class="text-info">Submit</span> to save changes.
            </p>

            <div class="btn-group" role="group" aria-label="actionButtonGroup">
                <button name="browse" onclick="window.location.replace('<?=site_url("admin/game_platform/browse_game_platform")?>')" class="btn btn-default">
                    <i class="fa fa-file-text-o"></i> Browse
                </button>

                <button name="back" onclick="window.location.replace('<?=site_url("admin/game_platform/add_game_platform")?>')"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Add
                </button>

                <button name="view" onclick="window.location.replace('<?=site_url("admin/game_platform/view_game_platform/".$game_platform["platform_id"])?>')" type="button" class="btn btn-default">
                    <i class="fa fa-pencil-square-o"></i> Edit
                </button>

                <button name="delete" onclick="onDeleteButtonClicked(<?=$game_platform['platform_id']?>)"
                        class="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
        </div>

        <?php $this->load->view("admin/template_user_message"); ?>
        <?php $this->load->view("admin/template_form_validation"); ?>

        <div class="row">
            <!-- Details Column -->
            <div class="col-md-7 col-md-offset-1">
                <form class="form-horizontal" method="post" role="form" data-parsley-validate>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Platform ID</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static"><?=$game_platform["platform_id"]?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="platform_name" class="col-sm-3 control-label">Platform Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="platform_name" placeholder="Name" value="<?=$game_platform["platform_name"]?>" data-parsley-maxlength="64"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="abbr" class="col-sm-3 control-label">Abbreviation</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="abbr" placeholder="Abbreviation" value="<?=$game_platform["abbr"]?>" data-parsley-type="alphanum" data-parsley-maxlength="64"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="year_intro" class="col-sm-3 control-label">First Release (Year)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="year_intro" placeholder="0" value="<?=$game_platform["year_intro"]?>" data-parsley-type="digits" data-parsley-maxlength="4"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="developer" class="col-sm-3 control-label">Platform Developer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="developer" placeholder="Developer" value="<?=$game_platform["developer"]?>" data-parsley-maxlength="128"/>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/game_platform/browse_game_platform/")?>')"><i class="fa fa-ban"></i> Cancel</button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Upload Image Column -->
            <div class="col-md-3">
                <div class="well well-sm" style="background-color: transparent;">
                    <p><b>Upload Logo</b></p>
                    <div class="image-preview"><img src="<?=site_url('uploads/' . $game_platform['logo_url'])?>" alt="<?=$game_platform['platform_name']?> avatar" /></div>
                    <?php if($this->session->userdata("logo_upload_errors")): ?>
                        <div class="text-danger"><?="Error:\n" . $this->session->userdata("logo_upload_errors")?></div>
                    <?php endif; ?>
                    <button class="btn btn-default center-div" style="margin: 0 auto;"  data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"
></i> Upload Avatar</button>
                </div>
            </div>
        </div>

        <!-- Upload Image Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <form role="form" action="<?=site_url('admin/game_platform/upload_image/')?>" method="post"
                      enctype="multipart/form-data">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="uploadModalLabel">Upload New Logo</h4>
                        </div>

                        <div class="modal-body">
                            <label><br/>Image cannot be more than <span class="text-danger">200px wide</span>
                                and <span class="text-danger">200px tall</span>.</label>
                            <input type="file" class="form-control" id="logo_url" name="logo_url"
                                   placeholder="image url">

                            <?php if($this->session->userdata("logo_upload_errors")): ?>
                                <div class="text-danger"><?="Error:\n" . $this->session->userdata("logo_upload_errors")?></div>
                            <?php endif; ?>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
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
                </div>
            </div>
        </div>

        <?php $this->load->view("admin/admin_footer"); ?>
    </div>

    <script>
        $(document).ready(function()
        {
            $("#platform_table").dataTable();
        });

        var delete_platform_id = 0;
        function onDeleteButtonClicked(platform_id)
        {
            delete_platform_id = platform_id;
        }

        function OnConfirmDelete()
        {
            var delete_platform_url = "<?=site_url('admin/game_platform/delete_game_platform')?>" + "/" + delete_platform_id;
            window.location.href = delete_platform_url;
        }
    </script>
</body>
</html>
