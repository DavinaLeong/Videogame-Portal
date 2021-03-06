<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: admin_navbar_view.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content (c) DAVINA Leong Shi Yun. All Rights Reserved.
**********************************************************************************/
?>

<nav class="navbar navbar-default" xmlns="http://www.w3.org/1999/html">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin_navbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=site_url('admin/authenticate/start')?>">
		  <img src="<?=RESOURCES_FOLDER?>/images/site_logo.png" alt="Site Logo" width="24px" height="24px"/>
	  </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="admin_navbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users fa-fw"> </i> Users <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('admin/user/add_user')?>"><i class="fa fa-plus fa-fw"></i> Add User</a></li>
            <li><a href="<?=site_url('admin/user/browse_user')?>"><i class="fa fa-file-text-o fa-fw"></i> Browse Users</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-gamepad fa-fw"></i> Videogames <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('admin/videogame/new_videogame')?>"><i class="fa fa-plus fa-fw"></i> Add Video Game</a></li>
            <li><a href="<?=site_url('admin/videogame/browse_videogame')?>"><i class="fa fa-file-text-o fa-fw"></i> Browse Video Games</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa
          fa-laptop fa-fw"></i> Game Platforms <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('admin/game_platform/new_game_platform')?>"><i class="fa fa-plus fa-fw"></i> Add Game
                Platform</a></li>
            <li><a href="<?=site_url('admin/game_platform/browse_game_platform/0')?>"><i class="fa
            fa-file-text-o fa-fw"></i> Browse
                Game Platforms</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa
          fa-sitemap fa-fw"></i> Game Genres <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('admin/game_genre/new_game_genre')?>"><i class="fa fa-plus fa-fw"></i> Add Game
                Genre</a></li>
            <li><a href="<?=site_url('admin/game_genre/browse_game_genre')?>"><i class="fa fa-file-text-o fa-fw"></i> Browse
                Game Genres</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa
          fa-picture-o fa-fw"></i> Screenshots <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Screenshots</li>
            <li><a href="<?=site_url('admin/screenshot/new_screenshot')?>"><i class="fa fa-plus fa-fw"></i> Add
                Screenshot</a></li>
            <li><a href="<?=site_url('admin/screenshot/browse_screenshot')?>"><i class="fa fa-file-text-o fa-fw"></i> Browse
                Screenshots</a></li>
            <li class="divider" role="separator"></li>
            <li class="dropdown-header">Screenshot Types</li>
            <li><a href="<?=site_url('admin/screenshot_type/browse_screenshot_type')?>"><i class="fa fa-file-text-o fa-fw"></i>
                Browse Screenshot Types</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php if($this->session->userdata("avatar_url")): ?>&nbsp;
                  <img class="img-rounded" src="<?=site_url('uploads/' . $this->session->userdata("avatar_url"))?>"
                       width="24px" height="24px"/>
              <?php else: ?>
                  <i class="fa fa-user"></i>&nbsp;
              <?php endif; ?>
              <?=$this->session->userdata("name");?>&nbsp;
              <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('admin/authenticate/change_password')?>"><i class="fa fa-key fa-fw"></i> Change
                Password</a></li>
            <li><a href="<?=site_url('admin/authenticate/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
            <?php if($this->User_log_model->validate_access("A", $this->session->userdata("access"))): ?>
            <li role="separator" class="divider"></li>
            <li><a href="<?=site_url('admin/authenticate/browse_userlogs')?>"><i class="fa fa-list fa-fw"></i> View Logged Messages</a></li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
