<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: browse_user_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $this->load->view("templates/meta_common");
    $this->load->view("templates/css_common");
    $this->load->view("templates/js_common");
    ?>
    <title>Video Game Portal Admin</title>

    <style text="type/css">
    .button-col
    {
        width: 15%;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php $this->load->view("admin/admin_navbar"); ?>

        <div class="page-header">
            <h1><i class="text-info fa fa-file-text-o"></i> Browse Users</h1>
        </div>

        <?php if($this->session->userdata('message')):?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <?=$this->session->userdata('message')?>
            </div>
            <?php $this->session->unset_userdata('message') ?>
        <?php endif;?>

        <div class="table-responsive">
            <p class="search-results">
            <?php
            if($offset <= 0)
            {
                $offset_str = "1";
            }
            else
            {
                $offset_str = $offset;
            }

            $current_showen = $offset + $per_page;
            if($current_showen > $total_rows)
            {
                $current_showen = $total_rows;
            }
            echo $offset_str . " &ndash; " . $current_showen . " of " .  $total_rows . " users shown."
            ?>
            </p>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Access</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Last Updated</th>
                    <th class="button-col">&nbsp;</th>
                </tr>

                <?php foreach($users as $index=>$user): ?>
                    <tr>
                        <td><?= $index + 1 + $offset; ?></td>
                        <td><?=$user["name"]?></td>
                        <td><?=$user["username"]?></td>
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
                        echo $display_date_added->format("d M Y");
                        ?>
                        </td>
                        <td>
                        <?php
                        $display_last_updated = new Datetime($user["last_updated"], new DateTimeZone(DATETIMEZONE));
                        echo $display_last_updated->format("d M Y");
                        ?>
                        </td>
                        <td class="button-col">
                            <button name="view_post" onclick="window.location.replace('<?=site_url("admin/user/view_user/".$user["uid"])?>')" type="button" class="btn btn-default"><i class="fa fa-eye"></i> View</button>
                            <button name="edit_post" onclick="window.location.replace('<?=site_url("admin/user/edit_user/".$user["uid"])?>')" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p class="search-results"><?= $offset_str . " &ndash; " . $current_showen . " of " .  $total_rows . " users shown." ?></p>
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-sm-12">
                <?php
                $config=$this->pagination_helper->pagination_config(site_url("admin/user/browse_user/"), $total_rows, $per_page);
                $this->pagination->initialize($config);
                echo $this->pagination->create_links();
                ?>
            </div>
        </div>

        <?php $this->load->view("admin/admin_footer"); ?>
    </div>
</body>
</html>
