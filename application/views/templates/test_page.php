<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!----------------------------------------------------------------------------------
	- File Info -
		File name		: test_page.php
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
    ?>

    <title>Test Page</title>

</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1><?=$header?></h1>
            <p class="lead">Test Page for CodeIgniter, Bootstrap and Font Awesome</p>
            <div class="btn-group" role="group">
                <a class="btn btn-default" href="http://www.codeigniter.com/" target="_blank"><i class="fa fa-code"></i> CodeIgniter</a>
                <a class="btn btn-default" href="http://getbootstrap.com/" target="_blank"><i class="fa fa-css3"></i> Bootstrap</a>
                <a class="btn btn-default" href="http://fortawesome.github.io/Font-Awesome/" target="_blank"><i class="fa fa-font"></i> Font Awesome</a>
                <a class="btn btn-default" href="<?=site_url('admin/authenticate/login')?>" target="_blank"><i class="fa fa-database"></i> Admin Portal</a>
            </div>
        </div>

        <h1>Font Awesome Icons</h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#web" aria-expanded="true" aria-controls="collapseOne">
                  Static Icons
                </a>
              </h4>
            </div>
            <div id="web" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <div class="row">
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-adjust"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-anchor"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-archive"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-area-chart"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-arrows"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-arrows-h"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-arrows-v"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-asterisk"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-at"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-automobile"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-balance-scale"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-ban"></i></div>
                </div>
                <div class="row">
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-bank"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-bar-chart"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-barcode"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-bars"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-0"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-1"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-2"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-3"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-4"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-empty"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-full"></i></div>
                    <div class="col-sm-1" style="text-align: center;"><i class="fa fa-battery-half"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Animated Icons
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="panel-body">
                  <div class="row">
                      <div class="col-sm-3" style="text-align: center;"><i class="fa fa-spin fa-circle-o-notch"></i></div>
                      <div class="col-sm-3" style="text-align: center;"><i class="fa fa-spin fa-cog"></i></div>
                      <div class="col-sm-3" style="text-align: center;"><i class="fa fa-spin fa-refresh"></i></div>
                      <div class="col-sm-3" style="text-align: center;"><i class="fa fa-spin fa-spinner"></i></div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <?php $this->load->view("templates/js_common"); ?>
</body>
</html>
