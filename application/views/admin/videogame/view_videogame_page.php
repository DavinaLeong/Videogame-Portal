<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: view_videogam_page.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 13 Jan 2016

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
 **********************************************************************************/
?>

<?php
/**
 * @var $videogame
 * @var $screenshots
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
    <?php $this->load->view("admin/_templates/admin_navbar_view");?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-eye"></i> View Owned Videogame&nbsp;
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?= site_url('admin/videogame/edit_videogame/' . $videogame['vg_id']) ?>"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit Videogame</a></li>
                    <li><a style="cursor: pointer;" onclick="onDeleteButtonClicked(<?=$videogame['vg_id']?>)" data-toggle="modal" data-target="#confirm_delete_modal"><i class="fa fa-trash"></i>&nbsp;Delete Videogame</a></li>
                </ul>
            </div>
        </h1>
    </div>

    <?php $this->load->view("admin/_templates/user_message_view"); ?>

    <h2><?=$videogame["vg_name"];?></h2>

    <?php
    if($screenshots && count($screenshots) > 0):
        $li_class = "";
        $div_class = "item";
        ?>
    <!-- Screenshot Carousel -->
    <div id="screenshots_carousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            if(count($screenshots) <= 10):
                foreach($screenshots as $key=>$screenshot):
                    if($key == 0)
                    {
                        $li_class = "class=\"active\"";
                    }
                    else
                    {
                        $li_class = "";
                    }
                    ?>
                    <li data-target="#screenshots_carousel" data-slide-to="<?=$key?>" <?=$li_class?> ></li>
                    <?php
                endforeach;
            endif;
            ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php
            foreach($screenshots as $key=>$screenshot):
                if($key == 0)
                {
                    $div_class = "item active";
                }
                else
                {
                    $div_class = "item";
                }
                ?>
                <div class="<?=$div_class?>">
                    <img src="<?=UPLOADS_FOLDER.$screenshot['ss_url']?>" alt="<?=$screenshot['ss_name']?>" width="854px">
                    <div class="carousel-caption">
                        <h3><?=$screenshot["ss_name"]?></h3>
                        <p><?=$screenshot["ss_description"]?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php else: ?>
    <div class="text-center text-muted" style="margin: auto; height: 480px; background-color: #eee; border: thin solid #ccc; vertical-align: middle;">
        No images ...
    </div>
    <?php endif; ?>
    <div style="margin: auto; height: 30px"></div>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Screenshots&nbsp;
                        <?php if($screenshots): ?>
                        <span class="badge"><?=count($screenshots);?></span>
                        <?php else: ?>
                        <span class="badge">0</span>
                        <?php endif; ?>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?php foreach($screenshots as $screenshot): ?>
                        <div class="col-sm-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><a href="<?=site_url('admin/screenshot/view_screenshot/' . $screenshot['ss_id'])?>"><?=$screenshot["ss_name"]?></a></h3>
                                </div>
                                <div class="panel-body">
                                    <a href="<?=site_url('admin/screenshot/view_screenshot/' . $screenshot['ss_id'])?>"><img class="img-rounded img-responsive" src="<?=UPLOADS_FOLDER . $screenshot["ss_url"];?>" alt="<?=$screenshot['ss_name']?>"></a><br>
                                    <p><?=$screenshot["ss_description"]?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        More Details
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID:</th>
                                <td><span class="text-placeholder-left"><?= $videogame["vg_id"] ?></span></td>
                            </tr>
                            <tr>
                                <th>Abbr:</th>
                                <td>
                                    <?php if($videogame["vg_abbr"]): ?>
                                        <span class="vg-abbr"><?=$videogame["vg_abbr"]?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Platform:</th>
                                <td><span class="badge" style="background-color: <?=$videogame["platform_label_col"]?>;"><?= $videogame["platform_abbr"] ?></span></td>
                            </tr>
                            <tr>
                                <th>Genre:</th>
                                <td><span class="label" style="background-color: <?=$videogame["genre_label_col"]?>;"><?= $videogame["genre_abbr"] ?></span></td>
                            </tr>
                            <tr>
                                <th>Date Purchased:</th>
                                <td>
                                    <?php
                                    $date_purchased = new DateTime($videogame["date_purchased"], new DateTimeZone(DATETIMEZONE));
                                    echo $date_purchased->format("d M Y");
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Date Added:</th>
                                <td><span class="text-muted"><?=$videogame["vg_date_added"]?></span></td>
                            </tr>
                            <tr>
                                <th>Last Updated:</th>
                                <td><span class="text-muted"><?=$videogame["vg_last_updated"]?></span></td>
                            </tr>
                            <tr>
                                <th>Bought from Steam:</th>
                                <td>
                                    <?php
                                    if($videogame["from_steam"])
                                    {
                                        echo '<span class="text-success">Yes</span>';
                                    }
                                    else
                                    {
                                        echo '<span class="text-danger">No</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view("admin/_templates/admin_footer_view"); ?>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Videogame</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
                <p>This action <strong class="text-danger">cannot</strong> be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="OnConfirmDelete()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->load->view("templates/js_common"); ?>

<script>
    var delete_vg_id = 0;
    function onDeleteButtonClicked(vg_id)
    {
        delete_vg_id = vg_id;
    }

    function OnConfirmDelete()
    {
        window.location.href = "<?=site_url('admin/videogame/delete_videogame')?>" + "/" + delete_vg_id;
    }
</script>
</body>
</html>
