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
            <button onclick="window.location.replace('<?= site_url("admin/game_platform/add_game_platform/") ?>')" type="button"
                    class="btn btn-danger"><i class="fa
            fa-plus"></i> Add Game Platform
            </button>
        </h1>

        <div id="react">
            <span class="text-danger">React is not working!</span>
        </div>
    </div>

    <?php $this->load->view("admin/template_user_message"); ?>

    <div class="table-responsive" id="ProductTable">
        <table class="table table-hover" id="platform_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Platform Name</th>
                <th>Platform Abbr</th>
                <th>Platform Logo</th>
                <th>Platform Developer</th>
                <th>First Release (Year)</th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <div id=""></div>
        </table>
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

<!-- Other scripts -->
<script src="<?=RESOURCES_FOLDER?>js/react.min.js"></script>
<script src="<?=RESOURCES_FOLDER?>js/react-dom.min.js"></script>
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

<script type="text/jsx">
    var TestFunction = React.createClass({
        render: function() {
            return (
              <span className="text-success">React is working</span>
            );
        }
    });

    var gamePlatforms = <?=json_encode($game_platforms)?>;
    var index = 0;
    var uploads_url = "<?=site_url('')?>";

    var GamePlatformRow = React.createClass({
        render: function() {
            ++index;
            var abbr = this.props.game_platform.abbr ?
                <span className="badge">{this.props.gamePlatform.abbr}</span> :
                <span className="text-placeholder">none</span>";

            var developer = this.props.gamePlatform.developer ?
                this.props.game_platform.developer :
                <span className="text-placeholder">none</span>;

            var year_intro = this.props.gamePlatform.year_intro ?
                this.props.game_platform.year_intro :
                <span className="text-placeholder">0</span>;

            var logo_url = this.props.gamePlatform.logo_url ?
                <img className="img-rounded"
                     src={<?=site_url("./uploads")?>this.props.gamePlatform.logo_url}
                     alt={this.props.gamePlatform.abbr + " avatar"}
                     width={"50px"}
                     height={"50px"}
                /> :
                <span className="text-placeholder">No logo</span>;

            return (
                <tr>
                    <td>{index}</td>
                    <td>{this.props.gamePlatform.platform_name}</td>
                    <td>{abbr}</td>
                    <td>{logl_url}</td>
                    <td>{developer}</td>
                    <td>{year_intro}</td>
                    <td className="button-col">



                    </td>
                </tr>
            );
        }
    });

    var GamePlatformTable = React.createClass({
        render: function() {
            var rows = [];
            this.props.gamePlatforms.forEach(function(gamePlatform) {
                rows.push(<GamePlatformRow gamePlatform={gamePlatform} key={gamePlatform.id} />);
            }.bind(this));

            return (<tbody>{rows}</tbody>);
        }
    });

    ReactDOM.render(
        <TestFunction />,
        document.getElementById('content')
    );
</script>
</body>
</html>