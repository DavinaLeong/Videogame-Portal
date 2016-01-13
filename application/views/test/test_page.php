<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
        File name		: view_page.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 30 Dec 2015

        Email	        : leong.shi.yun@gmail.com
        Phone	        : +65 9369 3752
----------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("templates/meta_view"); ?>
    <?php $this->load->view("templates/resources_view"); ?>
</head>

<body>
<div class="container">
    <div class="page-header">
        <h1><?=$header?></h1>
        <p class="lead">This is a test page</p>
        <a type="button" class="btn btn-primary">Dummy Button</a>
    </div>

    <ul class="list-group">
      <li class="list-group-item"><a href="http://getbootstrap.com/" target="_blank">Bootstrap <span class="badge"><i class="fa fa-css3"></i></span></a></li>
      <li class="list-group-item"><a href="https://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome <span class="badge"><i class="fa fa-font"></i></span></a></li>
      <li class="list-group-item"><a href=https://secure.php.net/manual/en/index.php"" target="_blank">PHP <span class="badge"><i class="fa fa-code"></i></span></a></li>
      <li class="list-group-item"><a href="https://codeigniter.com/" target="_blank">Code Igniter <span class="badge"><i class="fa fa-fire"></i></span></a></li>
      <li class="list-group-item"><a href="https://jquery.com/" target="_blank">jQuery <span class="badge"><i class="fa fa-dollar"></i></span></a></li>
      <li class="list-group-item"><a href="https://www.datatables.net/" target="_blank">Data Tables <span class="badge"><i class="fa fa-table"></i></span></a></li>
    </ul>

    <?php $this->load->view("templates/footer_view"); ?>
</div><!-- /.container -->
</body>
</html>
