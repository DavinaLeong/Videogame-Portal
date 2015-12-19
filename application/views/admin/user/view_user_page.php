<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: view_user_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 16 Dec 2015

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
    ?>
    <title>Video Game Portal Admin</title>

    <style type="text/css">
    th
    {
        text-align: left;
        background-color: #eee;
        width: 16%;
    }
    </style>
</head>
<body>
    <div class="container">
        
        <?php $this->load->view("admin/admin_navbar"); ?>
        <div class="page-header">
            <h1><i class="text-info fa fa-eye"></i> View User: <span class="text-info"><?=$user["name"]?></span></h1>

            <div class="btn-group" role="group" aria-label="actionButtonGroup">
                <button name="back" onclick="window.location.replace('<?=site_url("admin/user/browse_user/")?>')" class="btn btn-default">
                    <i class="fa fa-chevron-left"></i> Back
                </button>

                <button name="back" onclick="window.location.replace('<?=site_url("admin/user/add_user/")?>')"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Another User
                </button>

                <button name="edit_post" onclick="window.location.replace('<?=site_url("admin/user/edit_user/".$user["uid"])?>')" type="button" class="btn btn-primary">
                    <i class="fa fa-pencil-square-o"></i> Edit User
                </button>
            </div>
        </div>

        <?php $this->load->view("admin/template_user_message"); ?>

        <p>User's details:</p>
        <div class="image-preview">
            <img class="img-rounded" src="<?=site_url('uploads/' . $user['avatar_url'])?>" alt="<?=$user['username']?>
            avatar" />
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td><?=$user["uid"]?></td>

                    <th>Username</th>
                    <td><?=$user["username"]?></td>
                </tr>
                <tr>
                    <th>Access Rights</th>
                    <td>
                    <?php switch($user["access"])
                    {
                        case "A":
                            echo "Admin";
                            break;

                        case "U":
                            echo "User";
                            break;

                        case "M":
                            echo "Manager";
                            break;

                        default:
                            echo "<span class='text-danger'>invalid</span>";
                            break;
                    }
                    ?>
                    </td>

                    <th>Status</th>
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
                </tr>
                <tr>
                    <th>Last Updated</th>
                    <td>
                    <?php
                    $display_last_updated = new Datetime($user["last_updated"], new DateTimeZone(DATETIMEZONE));
                    echo $display_last_updated->format("d M Y");
                    ?>
                    </td>

                    <th>Date Added</th>
                    <td>
                    <?php
                    $display_date_added = new Datetime($user["date_added"], new DateTimeZone(DATETIMEZONE));
                    echo $display_date_added->format("d M Y");
                    ?>
                    </td>
                </tr>
            </table>
        </div>

        <?php
        $this->load->view("admin/admin_footer");
        $this->load->view("templates/js_common");
        ?>
    </div>
</body>
</html>
