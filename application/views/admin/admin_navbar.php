<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: admin_navbar.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
----------------------------------------------------------------------------------->
<nav class="navbar navbar-default">
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
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users"> </i> User <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('admin/user/add_user')?>"><i class="fa fa-plus"></i> Add User</a></li>
            <li><a href="<?=site_url('admin/user/browse_user')?>"><i class="fa fa-file-text-o"></i> Browse Users</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-gamepad"></i> Owned Videogames <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('admin/videogame/add_videogame')?>"><i class="fa fa-plus"></i> Add Video Game</a></li>
            <li><a href="<?=site_url('admin/videogame/browse_videogame')?>"><i class="fa fa-file-text-o"></i> Browse Video Games</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?=$this->session->userdata("name");?>&nbsp;
              <?php if($this->session->userdata("avatar_url")): ?>&nbsp;
                  <img class="img-rounded" src="<?=site_url('uploads/' . $this->session->userdata("avatar_url"))?>" width="32px" height="32px"/>
              <?php else: ?>
                  <i class="fa fa-user"></i>&nbsp;
              <?php endif; ?>
              <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
