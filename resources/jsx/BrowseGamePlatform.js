/**********************************************************************************
	- File Info -
		File name		: BrowseGamePlatform.js
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/

/**
 * -----------------------------------
 *  Notes:
 *  v0.13.3 -> v0.14.3
 * -----------------------------------
 *  React.render -> ReactDOM.render
 */

var rowIndex = 0;

var GamePlatformRow = React.createClass({

    deleteButtonClicked: function(platform_id) {
        console.log("GamePlatformRow.deleteButtonClicked\nplatform_id: " + this.props.platform_id);
        this.props.deleteButtonClicked(platform_id);
    },

    render: function(){
        ++rowIndex;

        var developer = !this.props.gamePlatform.developer || this.props.gamePlatform.developer == "none" ? <span className="text-placeholder">none</span> : this.props.gamePlatform.developer;

        var year_intro = !this.props.gamePlatform.year_intro || this.props.gamePlatform.year_intro == "0" ? <span className="text-placeholder">0</span> : this.props.gamePlatform.year_intro;

        var logo_img = this.props.gamePlatform.logo_url ? <img className="img-rounded" src={this.props.siteUrl + "/uploads/" + this.props.gamePlatform.logo_url} alt={this.props.gamePlatform.abbr} width="50px" height="50px" /> : <span className="text-placeholder">no logo</span>;

        var view_action = <a href={this.props.siteUrl + "/admin/game_platform/view_game_platform/" + this.props.gamePlatform.platform_id} type="button" className="btn btn-default"><i className="fa fa-eye"></i> View</a>;

        var edit_action = <a href={this.props.siteUrl + "/admin/game_platform/view_game_platform/" + this.props.gamePlatform.platform_id} type="button" className="btn btn-default"><i className="fa fa-file-text-o"></i> Edit</a>;

        return (
            <tr>
                <td>{rowIndex}</td>
                <td>{this.props.gamePlatform.platform_name}</td>
                <td><span className="badge">{this.props.gamePlatform.abbr}</span></td>
                <td>{logo_img}</td>
                <td>{developer}</td>
                <td>{year_intro}</td>
                <td>
                    {view_action}&nbsp;
                    {edit_action}&nbsp;
                    <DeleteGamePlatformButton deleteButtonClicked={this.deleteButtonClicked} platform_id={this.props.gamePlatform.platform_id} />
                </td>
            </tr>
        );
    }
}); //end GamePlatformRow

var GamePlatformTable = React.createClass({

    getInitalState: function() {
        return {
            gamePlatforms: this.props.gamePlatforms,
            deletePlatformId: null
        };
    },

    refreshTableData: function() {
        var data = {
            "gamePlatforms": this.props.gamePlatforms
        };

        $.ajax({
            url: this.props.siteUrl + "game_platform/json_get_all_platforms",
            dataType: "json",
            data: data,
            cache: false,
            success: function(data) {
                this.setState({ gamePlatforms: data.gamePlatforms });
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.siteUrl + "game_platform/json_get_by_platform_id", status, err.toString());
            }.bind(this)
        });
    },

    confirmDeleteClicked: function() {
        var data = {
            "platform_id": this.state.deletePlatformId
        }

        $.ajax({
            type: "POST",
            url: this.props.siteUrl + "game_platform/json_delete_by_platform_id",
            dataType: "json",
            data: data,
            success: function(data) {
                this.refreshTableData();
            }.bind(this),
            error: function(xhr, status, err) {
                this.refreshTableData();
            }.bind(this)
        });
    },

    deleteButtonClicked: function(platform_id){
        console.log("GamePlatformTable.deleteButtonClicked\nplatform_id: " + this.props.platform_id);
        $("#ConfirmDeleteModal").modal("show");
        this.forceUpdate(); // warning's suggestion
        this.setState()({
            deletePlatformId: platform_id
        });
    },

    render: function() {
        var rows = [];
        this.props.gamePlatforms.forEach(
            function(gamePlatform) {
                rows.push(<GamePlatformRow gamePlatform={gamePlatform} key={gamePlatform.platform_id} siteUrl={this.props.siteUrl} deleteButtonClicked={this.deleteButtonClicked} />);
            }.bind(this)
        );

        return (
            <div className="table-responsive">
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

                <div className="modal fade" id="ConfirmDeleteModal">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 className="modal-title">Delete Game Platform</h4>
                            </div>
                            <div className="modal-body">
                                <p>Are you sure?</p>
                                <p>This action <strong className="text-danger">cannot</strong> be undone.</p>
                            </div>
                            <div className="modal-footer">
                                <button type="button" onclick={this.confirmDeleteClicked} className="btn btn-danger" data-dismiss="modal"><i className="fa fa-trash"></i> Delete</button>
                                <button type="button" className="btn btn-default" data-dismiss="modal"><i className="fa fa-ban"></i> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

}); // end GamePlatformTable

var DeleteGamePlatformButton = React.createClass({
    deleteButtonClicked: function() {
        console.log("DeleteGamePlatformButton.deleteButtonClicked\nplatform_id: " + this.props.platform_id);
        this.props.deleteButtonClicked(this.props.platform_id);
    },

    render: function() {
        return (
            <button type="button" className="btn btn-default" onClick={this.deleteButtonClicked} ><i className="fa fa-trash"></i> Delete</button>
        );
    }
}); //end DeleteGamePlatformButton