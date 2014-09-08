<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if (isset($title_for_layout)) echo $title_for_layout; else echo $site_name;?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("public/home/assets/ico/favicon.ico"); ?>"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>public/home/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/home/assets/css/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/admin/style.list.css"><!-- Acc1 -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/admin/style.header.css"><!-- Acc1 -->

    <script src="<?php echo base_url()?>public/home/assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>public/home/assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url()?>public/home/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>public/js/admin/jquery.nestable.js"></script>
    <script src="<?php echo base_url()?>public/js/admin/jquery-ui.js"></script>
    <script src="<?php echo base_url()?>public/js/admin/js.js"></script>
    <!-- include -->
    <!-- Include your script-->
    <script src="<?php echo base_url()?>public/home/assets/js/my_js.js"></script>
    <!-- Finish include-->

    <script type="text/javascript">
    // $(document).ready(function () {

    //         var updateOutput = function (e) {
    //             var list = e.length ? e : $(e.target),
    //                 output = list.data('output');
    //             if (window.JSON) {
    //                 output.val(window.JSON.stringify(list.nestable('serialize')));
    //             } else {
    //                 output.val('JSON browser support required for this demo.');
    //             }
    //         };

    //         // activate Nestable for list 1
    //         $('#nestable').nestable({
    //             group: 1
    //         }).on('change', updateOutput);

    //         // output initial serialised data
    //         updateOutput($('#nestable').data('output', $('#nestable-output')));

    //     });
    </script>
  </head>
  <body>
        <!-- navigation top header -->
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('admin/user');?>"><?php if (isset($title_for_layout)) echo $title_for_layout; else echo $site_name;?></a>
        </div>
        <!-- navbar collapse -->
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
          <!-- nav left -->
          <ul class="nav navbar-nav">
            <?php
              $uris = uri_string();
              $uris = explode('/', $uris);
              $uri = '';
              if (isset($uris[1]))$uri = $uris[1];
            ?>
            <li <?php if ($uri == 'home' || $uri == 'admin') echo 'class="active"';?>><a href="">Home</a></li>
            <li <?php if ($uri == 'user') echo 'class="active"';?> ><a href="<?php echo base_url('admin/user');?>">Users</a></li>
            <li <?php if ($uri == 'category') echo 'class="active"';?>><a href="<?php echo base_url('admin/category');?>">Categories</a></li>
            <li <?php if ($uri == 'product' ) echo 'class="active"';?>><a href="<?php echo base_url('admin/product/index/0');?>">Products</a></li>
            <li <?php if ($uri == 'brand') echo 'class="active"';?>><a href="<?php echo base_url('admin/brand');?>">Brands</a></li>
            <li <?php if ($uri == 'report') echo 'class="active"';?>><a href="<?php echo base_url('admin/report');?>">Report Task</a></li>
          </ul>
          <!-- end nav left -->
          <ul class = "nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url('admin/user/logout');?>">Logout</a></li>

          </ul>
        </div>
      </div>
    </nav>
    <!-- end  navbar top -->
    <div class="container" >
      <div class="row">
