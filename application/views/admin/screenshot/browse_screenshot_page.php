<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_screenshot_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 01 Feb 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<?php
/**
 * @var $screenshots
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
        <?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

        <div class="page-header">
            <h1>
                <i class="text-info fa fa-file-text-o"></i> Browse Screenshots&nbsp;
                <button onclick="window.location.replace('<?=site_url("admin/screenshot/new_screenshot/")?>')" type="button"
                        class="btn btn-danger"><i class="fa
            fa-plus"></i> Add Screenshot</button>
            </h1>
        </div>

        <?php $this->load->view("admin/_templates/user_message_view"); ?>

        <div class="table-responsive">
            <table class="table table-hover" id="users_table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th style="width: 20%;">Thumbnail</th>
                    <th>Videogame</th>
                    <th>Type</th>
                    <th>Date Added</th>
                    <th>Last Updated</th>
                    <th style="width: 15%;">&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($screenshots as $index=>$screenshot): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?=$screenshot["ss_name"]?></td>
                        <td class="text-center" style="width: 20%;"><img src="<?=UPLOADS_FOLDER.$screenshot['ss_thumb_url']?>" alt="<?=$screenshot['ss_name']?> thumbnail - <?=$screenshot['vg_name']?>" width="<?=$screenshot['ss_thumb_width']?>px"  height="<?=$screenshot['ss_thumb_height']?>px"/></td>
                        <td><?=$screenshot["vg_name"]?></td>
                        <td><?=$screenshot["ss_type_name"]?></td>
                        <td>
                            <?php
                            $display_date_added = new Datetime($screenshot["date_added"], new DateTimeZone(DATETIMEZONE));
                            echo $display_date_added->format("Y/m/d");
                            ?>
                        </td>
                        <td>
                            <?php
                            $display_last_updated = new Datetime($screenshot["last_updated"], new DateTimeZone(DATETIMEZONE));
                            echo $display_last_updated->format("Y/m/d");
                            ?>
                        </td>
                        <td style="width: 15%;">
                            <button name="view_videogame" onclick="window.location.replace('<?=site_url("admin/videogame/view_videogame/".$screenshot["vg_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-gamepad"></i> View Videogame</button>
                            <button name="view_post" onclick="window.location.replace('<?=site_url("admin/screenshot/view_screenshot/".$screenshot["ss_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-eye"></i> View</button>
                            <button name="edit_post" onclick="window.location.replace('<?=site_url("admin/screenshot/edit_screenshot/".$screenshot["ss_id"])?>')" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php
        $this->load->view("admin/_templates/admin_footer_view");
        $this->load->view("templates/js_common");
        $this->load->view("templates/datatables_resources");
        ?>

        <script>
            $(document).ready(function()
            {
                $("#users_table").dataTable();
            });
        </script>
    </div>

</body>
</html>
