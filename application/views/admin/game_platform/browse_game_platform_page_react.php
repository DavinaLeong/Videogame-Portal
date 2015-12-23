<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: browse_user_page_react.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content ï¿½ DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->

<?php
/**
 * @var $game_platforms
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
    <?php $this->load->view("admin/admin_navbar"); ?>

    <div class="page-header">
        <h1>
            <i class="text-info fa fa-file-text-o"></i> Browse Game Platforms&nbsp;
            <span class="badge">REACT JS</span>
            <button onclick="window.location.replace('<?= site_url("admin/game_platform/add_game_platform/") ?>')" type="button"
                    class="btn btn-danger"><i class="fa
            fa-plus"></i> Add Game Platform
            </button>
        </h1>
    </div>

    <?php $this->load->view("admin/template_user_message"); ?>

    <div id="GamePlatformTable">
    </div>

    <?php $this->load->view("admin/admin_footer"); ?>
</div>

<?php $this->load->view("templates/js_common"); ?>

<script src="<?=RESOURCES_FOLDER?>js/react.js"></script>
<script src="<?=RESOURCES_FOLDER?>js/react-dom.js"></script>
<script src="<?=RESOURCES_FOLDER?>js/JSXTransformer.js"></script>
<script src="<?=RESOURCES_FOLDER?>jsx/BrowseGamePlatform.js" type="text/jsx;harmony=true"></script>

<script type="text/jsx">
var gamePlatforms = <?=json_encode($game_platforms)?>;

ReactDOM.render(
    <GamePlatformTable
        gamePlatforms = {gamePlatforms}
        siteUrl = "<?=site_url()?>"
    />,
    document.getElementById("GamePlatformTable")
);
</script>

</body>
</html>
