<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: edit_user_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->

<?php
/**
 * @var $user
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
            <h1><i class="text-info fa fa-pencil-square-o"></i> Edit User's Details</h1>

            <p class="lead">
                Edit in the fields and click <span class="text-info">Submit</span> to save changes.
            </p>

            <div class="btn-group" role="group" aria-label="actionButtonGroup">
                <button name="back" onclick="window.location.replace('<?=site_url("admin/user/browse_user/")?>')" class="btn btn-default">
                    <i class="fa fa-chevron-left"></i> Back
                </button>

                <button name="back" onclick="window.location.replace('<?=site_url("admin/user/add_user/")?>')"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Another User
                </button>

                <button name="edit_post" onclick="window.location.replace('<?=site_url("admin/user/view_user/".$user["uid"])?>')" type="button" class="btn btn-primary">
                    <i class="fa fa-eye"></i> View User
                </button>
            </div>
        </div>

        <?php if($this->session->userdata('message')):?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <?=$this->session->userdata('message')?>
            </div>
            <?php $this->session->unset_userdata('message') ?>
        <?php endif;?>
        <?php if(validation_errors()):?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <?=validation_errors();?>
            </div>
        <?php endif;?>

        <div class="row">
            <!-- Details Column -->
            <div class="col-md-7 col-md-offset-1">
                <form class="form-horizontal" method="post" role="form" data-parsley-validate>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="name" value="<?=$user["name"]?>" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" placeholder="username" value="<?=$user["username"]?>" required/>
                                </div>
                            </div>
                            <div class="space col-sm-12">&nbsp;</div>

                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">Account Status <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status">
                                        <option
                                            value="Active" <?= set_select('access', 'A', $user['access'] == "A" ? TRUE : FALSE) ?> >
                                            A
                                        </option>
                                        <option
                                            value="M" <?= set_select('access', 'M', $user['access'] == "M" ? TRUE : FALSE) ?> >
                                            M
                                        </option>
                                        <option
                                            value="U" <?= set_select('access', 'U', $user['access'] == "U" ? TRUE : FALSE) ?> >
                                            U
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="access" class="col-sm-3 control-label">Access Rights <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="access">
                                        <option>A</option>
                                        <option>M</option>
                                        <option>U</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-9 col-sm-offset-3">
                                <p class="text-danger">* required fields</p>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.replace('<?=site_url("admin/user/browse_user/")?>')"><i class="fa fa-chevron-left"></i> Back</button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Upload Image Column -->
            <div class="col-md-3">
                <div class="well well-sm" style="background-color: transparent;">
                    <p><b>Upload Avatar</b></p>
                    <div class="image-preview"><img src="<?=site_url('uploads/' . $user['avatar_url'])?>" alt="<?=$user['username']?> avatar" /></div>
                    <p class="text-danger"><?=$this->session->userdata("file_upload_errors")?></p>
                    <button class="btn btn-primary center-div" style="margin: 0 auto;"  data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"
></i> Upload Avatar</button>
                </div>
            </div>
        </div>

        <!-- Upload Image Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form role="form" action="<?=site_url('admin/user/upload_image/')?>" method="post"
              enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="uploadModalLabel">Upload New Avatar</h4>
                </div>
                <div class="modal-body">

                    <label><br/>Image cannot be more than <span class="text-danger">200px wide</span>
                        and <span class="text-danger">200px tall</span>.</label>
                    <input type="file" class="form-control" id="avatar_url" name="avatar_url"
                           placeholder="image url">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

        <?php $this->load->view("admin/admin_footer"); ?>
    </div>

</body>
</html>
