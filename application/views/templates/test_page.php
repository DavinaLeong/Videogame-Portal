<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
            </div>
        </div>

        <h1>Font Awesome Icons</h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#web" aria-expanded="true" aria-controls="collapseOne">
                  Web Application Icons
                </a>
              </h4>
            </div>
            <div id="web" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <div class="row">
                    <div class="col-sm-1"><i class="fa fa-adjust"></i></div>
                    <div class="col-sm-1"><i class="fa fa-anchor"></i></div>
                    <div class="col-sm-1"><i class="fa fa-archive"></i></div>
                    <div class="col-sm-1"><i class="fa fa-area-chart"></i></div>
                    <div class="col-sm-1"><i class="fa fa-arrows"></i></div>
                    <div class="col-sm-1"><i class="fa fa-arrows-h"></i></div>
                    <div class="col-sm-1"><i class="fa fa-arrows-v"></i></div>
                    <div class="col-sm-1"><i class="fa fa-asterisk"></i></div>
                    <div class="col-sm-1"><i class="fa fa-at"></i></div>
                    <div class="col-sm-1"><i class="fa fa-automobile"></i></div>
                    <div class="col-sm-1"><i class="fa fa-balance-scale"></i></div>
                    <div class="col-sm-1"><i class="fa fa-ban"></i></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><i class="fa fa-bank"></i></div>
                    <div class="col-sm-1"><i class="fa fa-bar-chart"></i></div>
                    <div class="col-sm-1"><i class="fa fa-barcode"></i></div>
                    <div class="col-sm-1"><i class="fa fa-bars"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-0"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-1"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-2"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-3"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-4"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-empty"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-full"></i></div>
                    <div class="col-sm-1"><i class="fa fa-battery-half"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Collapsible Group Item #2
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="panel-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Collapsible Group Item #3
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
              <div class="panel-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>
    </div>

    <?php $this->load->view("templates/js_common"); ?>
</body>
</html>
