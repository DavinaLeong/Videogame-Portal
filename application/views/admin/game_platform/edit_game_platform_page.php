<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: edit_game_platform_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
 **********************************************************************************/
?>

<?php
/**
 * @var $game_platform
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
            <i class="text-info fa fa-pencil-square-o"></i> Edit Game Platform&nbsp;
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?=site_url("admin/game_platform/view_game_platform/".$game_platform["platform_id"])?>"><i class="fa fa-pencil-square-o"></i>&nbsp;View Platform</a></li>
                    <li><a style="cursor: pointer;" onclick="onDeleteButtonClicked(<?=$game_platform['platform_id']?>)" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i>&nbsp;Delete Platform</a></li>
                </ul>
            </div>
        </h1>

        <p class="lead">
            Edit in the fields and click <span class="text-info">Submit</span> to save changes.
        </p>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>
    <?php $this->load->view("admin/_templates/form_validation_view"); ?>

    <div class="row">
        <!-- Details Column -->
        <div class="col-md-7 col-md-offset-1">
            <form class="form-horizontal" method="post" role="form" data-parsley-validate>

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="platform_id" class="col-sm-3 control-label">Platform ID</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?=$game_platform["platform_id"]?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="platform_name" class="col-sm-3 control-label">Platform Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="platform_name" placeholder="Name" value="<?=$game_platform["platform_name"]?>" data-parsley-required data-parsley-maxlength="64"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="platform_abbr" class="col-sm-3 control-label">Abbreviation <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="platform_abbr" placeholder="Abbreviation" value="<?=$game_platform["platform_abbr"]?>" data-parsley-required data-parsley-type="alphanum" data-parsley-maxlength="64"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="year_intro" class="col-sm-3 control-label">First Release (Year)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="year_intro" placeholder="0" value="<?=$game_platform["year_intro"]?>" data-parsley-type="digits" data-parsley-maxlength="4"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="platform_developer" class="col-sm-3 control-label">Platform Developer</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="platform_developer" placeholder="Developer" value="<?=$game_platform["platform_developer"]?>" data-parsley-maxlength="128"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="platform_label_col" class="col-sm-3 control-label">Label Color</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="platform_label_col" placeholder="Hex value" value="<?=$game_platform['platform_label_col']?>" data-parsley-maxlength="7" data-parsley-pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$"/>
                                    <div class="input-group-addon"><div style="display: inline-block; background-color: <?=$game_platform['platform_label_col']?>; width: 16px; height: 16px; border: thin solid #ccc;"></div></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_added" class="col-sm-3 control-label">Date Added</label>
                            <p class="col-sm-9 form-control-static text-muted"><?=$game_platform["date_added"]?></p>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Updated</label>
                            <p class="col-sm-9 form-control-static text-muted"><?=$game_platform["last_updated"]?></p>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                        <button type="button" class="btn btn-default" onclick="window.location.href = '<?=site_url("admin/game_platform/browse_game_platform/")?>'"><i class="fa fa-ban"></i> Cancel</button>
                    </div>
                </div>

            </form>
        </div>

        <!-- Upload Image Column -->
        <div class="col-md-3">
            <div class="well well-sm" style="background-color: transparent;">
                <p><b>Upload Logo</b></p>
                <div class="image-preview"><img src="<?=site_url('uploads/' . $game_platform['platform_logo_url'])?>" alt="<?=$game_platform['platform_name']?> avatar" /></div>
                <?php if($this->session->userdata("logo_upload_errors")): ?>
                    <div class="text-danger"><?="Error:\n" . $this->session->userdata("logo_upload_errors")?></div>
                <?php endif; ?>
                <button class="btn btn-success center-div" style="margin: 0 auto;"  data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"
></i> Upload Logo</button>
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
                        <label >Image cannot be more than <span class="text-danger">200px wide</span>
                            and <span class="text-danger">200px tall</span>.</label>
                        <input type="file" class="form-control" id="platform_logo_url" name="platform_logo_url"
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

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>
<?php $this->load->view("templates/js_common"); ?>

<script>
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
