<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_user_page.php
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
 * @var $users
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>
    <link rel="stylesheet" type="text/css" href="<?=RESOURCES_FOLDER?>css/datatables.min.css"/>

    <title>Video Game Portal Admin</title>

    <style type="type/css">
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
            <i class="text-info fa fa-file-text-o"></i> Browse Users&nbsp;
            <button onclick="window.location.href = '<?=site_url("admin/user/add_user/")?>'" type="button"
                    class="btn btn-danger"><i class="fa
        fa-plus"></i> Add New User</button>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <div class="table-responsive">
        <table class="table table-hover" id="users_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Access</th>
                <th>Avatar</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Last Updated</th>
                <th class="button-col">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($users as $index=>$user): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?=$user["name"]?></td>
                    <td><?=$user["username"]?></td>
                    <td>
                        <?php switch($user["access"])
                        {
                            case "A":
                                echo '<span class="access-admin">Admin</span>';
                                break;

                            case "U":
                                echo '<span class="access-user">User</span>';
                                break;

                            case "M":
                                echo '<span class="access-manager">Manager</span>';
                                break;

                            default:
                                echo "<span class='text-danger'>invalid</span>";
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <?php if($user["avatar_url"]): ?>
                            <img class="img-rounded" src="<?=site_url('uploads/' . $user["avatar_url"])?>" alt="<?=$user['username']?>_avatar" width="50px" height="50px"/>
                        <?php else: ?>
                            <span class="text-placeholder">No avatar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        switch($user["status"])
                        {
                            case "Active":
                                echo "<span class='text-success'>" . $user["status"] . "</span>";
                                break;

                            case "Not Active":
                                echo "<span class='text-danger'>" . $user["status"] . "</span>";
                                break;

                            default:
                                echo "";
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $display_date_added = new Datetime($user["date_added"], new DateTimeZone(DATETIMEZONE));
                        echo $display_date_added->format("Y/m/d");
                        ?>
                    </td>
                    <td>
                        <?php
                        $display_last_updated = new Datetime($user["last_updated"], new DateTimeZone(DATETIMEZONE));
                        echo $display_last_updated->format("Y/m/d");
                        ?>
                    </td>
                    <td class="button-col">
                        <div class="btn-group">
                            <button name="view_post" onclick="window.location.href = '<?=site_url("admin/user/view_user/".$user["user_id"])?>'" type="button" class="btn btn-default"><i class="fa fa-eye"></i> View</button>
                            <button name="edit_post" onclick="window.location.href = '<?=site_url("admin/user/edit_user/".$user["user_id"])?>'" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>

</div>
<?php $this->load->view("templates/js_common"); ?>
<script type="text/javascript" src="<?=RESOURCES_FOLDER?>js/datatables.min.js"></script>

<script>
    $(document).ready(function()
    {
        $("#users_table").dataTable();
    });
</script>
</body>
</html>
