<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: view_screenshot_page.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 27 Feb 2016

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content © DAVINA Leong Shi Yun. All Rights Reserved.
 **********************************************************************************/
?>
<?php
/**
 * @var $screenshot
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_common"); ?>
    <?php $this->load->view("templates/css_common"); ?>

    <title>Video Game Portal Admin</title>

    <style type="text/css">
        th
        {
            text-align: left;
            background-color: #eee;
            width: 30%;
        }
    </style>
</head>
<body>
<div class="container">
<?php $this->load->view("admin/_templates/admin_navbar_view"); ?>

    <div class="page-header">
        <h1><i class="text-info fa fa-eye"></i> View Screenshot</h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view");?>

    <h2><?=$screenshot["ss_name"]?></h2>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <img class="img-responsive img-rounded" src="<?=UPLOADS_FOLDER . $screenshot['ss_url']?>" alt="<?=$screenshot['ss_name']?>">
            <br>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Videogame</th>
            <td><?=$screenshot["vg_name"]?>&nbsp;<span class="vg-abbr-block"><?=$screenshot["vg_abbr"]?></td>
        </tr>
        <tr>
            <th>Screenshot Type</th>
            <td><?=$screenshot["ss_type_name"]?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?=$screenshot["ss_description"]?></td>
        </tr>
        <tr>
            <th>Date Added</th>
            <td>
                <?php
                $date_added = new DateTime($screenshot["date_added"], new DateTimeZone(DATETIMEZONE));
                echo $date_added->format("d M Y");
                ?>
            </td>
        </tr>
        <tr>
            <th>Last Updated</th>
            <td>
                <?php
                $last_updated = new DateTime($screenshot["last_updated"], new DateTimeZone(DATETIMEZONE));
                echo $last_updated->format("d M Y");
                ?>
            </td>
        </tr>
    </table>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>
<?php $this->load->view("templates/js_common"); ?>
</body>
</html>
