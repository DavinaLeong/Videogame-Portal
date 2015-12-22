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

    <div class="table-responsive" id="GamePlatformTable">
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

    <?php $this->load->view("admin/admin_footer"); ?>
</div>

<?php $this->load->view("templates/js_common"); ?>

<script src="<?=RESOURCES_FOLDER?>js/react.js"></script>
<script src="<?=RESOURCES_FOLDER?>js/react-dom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.6.15/browser.js"></script>

<script type="text/javascript">
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

<script>
    var delete_platform_id = 0;
    function onDeleteButtonClicked(platform_id)
    {
        alert("Clicked");
        delete_platform_id = platform_id;
    }

    function OnConfirmDelete()
    {
        var delete_platform_url = "<?=site_url('admin/game_platform/delete_game_platform')?>" + "/" + delete_platform_id;
        window.location.href = delete_platform_url;
    }
</script>

<script type="text/babel">
    var TestFunction = React.createClass({
        render: function() {
            return (
                <span style={{color: "green"}}>React IS working</span>
            );
        }
    });

    var gamePlatforms = <?=json_encode($game_platforms)?>;
    var rowIndex = 0;

    var GamePlatformRow = React.createClass({
        render: function(){
            ++rowIndex;

            var developer = !this.props.gamePlatform.developer || this.props.gamePlatform.developer == "none" ? <span className="text-placeholder">none</span> : this.props.gamePlatform.developer;

            var year_intro = !this.props.gamePlatform.year_intro || this.props.gamePlatform.year_intro == "0" ? <span className="text-placeholder">0</span> : this.props.gamePlatform.year_intro;

            var logo_img = this.props.gamePlatform.logo_url ? <img className="img-rounded" src={"<?=site_url("uploads")?>" + "/" + this.props.gamePlatform.logo_url} alt={this.props.gamePlatform.abbr} width="50px" height="50px" /> : <span className="text-placeholder">no logo</span>;

            var view_action = <a href={"<?=site_url("admin/game_platform/view_game_platform")?>" + "/" + this.props.gamePlatform.platform_id} type="button" className="btn btn-default"><i className="fa fa-eye"></i> View</a>;

            var edit_action = <a href={"<?=site_url("admin/game_platform/edit_game_platform")?>" + "/" + this.props.gamePlatform.platform_id} type="button" className="btn btn-default"><i className="fa fa-file-text-o"></i> Edit</a>;

            //Can't delete item
            var delete_action = <button type="button" className="btn btn-default" data-toggle="modal" data-target="#confirm_delete_modal" onclick={'onDeleteButtonClicked(' + this.props.gamePlatform.platform_id + ')'}><i className="fa fa-trash"></i> Delete</button>;

            return (
                <tr>
                    <td>{rowIndex}</td>
                    <td>{this.props.gamePlatform.platform_name}</td>
                    <td><span className="badge">{this.props.gamePlatform.abbr}</span></td>
                    <td>{logo_img}</td>
                    <td>{developer}</td>
                    <td>{year_intro}</td>
                    <td>
                        {view_action}
                        {edit_action}
                        TODO: Delete Button
                    </td>
                </tr>
            );
        }
    });

    var GamePlatformTable = React.createClass({
        render: function() {
            var rows = [];
            this.props.gamePlatforms.forEach(function(gamePlatform){
                rows.push(<GamePlatformRow gamePlatform={gamePlatform} key={gamePlatform.platform_id}   />);
            }.bind(this));

            return (
                <table className="table table-hover" id="GamePlatformTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Platform Name</th>
                            <th>Platform Abbr</th>
                            <th>Platform Logo</th>
                            <th>Platform Developer</th>
                            <th>First Release Year</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>{rows}</tbody>
                </table>
            );
        }

    });

    ReactDOM.render(
        <GamePlatformTable gamePlatforms={gamePlatforms} />,
        document.getElementById("GamePlatformTable")
    );
</script>
</body>
</html>
