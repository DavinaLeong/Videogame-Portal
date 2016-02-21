<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_userlog_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 07 Feb 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $user_logs
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
            <i class="text-info fa fa-list"></i> User Log for <span class="text-primary"><?= $user_logs[0]["username"]; ?></span>&nbsp;
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <div class="table-responsive">
        <table class="table table-hover" id="user_logs_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Log ID</th>
                <th>User</th>
                <th>Message</th>
                <th>Timestamp</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($user_logs as $index=>$user_log): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><em><?= $user_log["ulid"]; ?></em></td>
                    <td>
                        <?= $user_log["uid"]; ?> | <strong><?= $user_log["username"]; ?></strong><br>
                        (<?= $user_log["name"]; ?> /
                        <?php switch($user_log["access"])
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
                        ?>)
                    </td>
                    <td><?= $user_log["message"]; ?></td>
                    <td>
                        <?php
                        $timestamp = new Datetime($user_log["timestamp"], new DateTimeZone(DATETIMEZONE));
                        echo $timestamp->format("Y/m/d");
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view("admin/_templates/admin_footer_view"); ?>
<?php $this->load->view("templates/js_common"); ?>
<script type="text/javascript" src="<?=RESOURCES_FOLDER?>js/datatables.min.js"></script>

<script>
    $(document).ready(function()
    {
        $("#user_logs_table").dataTable();
    });
</script>
</body>
</html>
