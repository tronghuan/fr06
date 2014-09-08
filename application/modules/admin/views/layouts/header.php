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
    <link href="<?php echo base_url();?>public/home/assets/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>public/css/admin/style.header.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
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

    <link type="text/css" rel="stylesheet" href="<?php echo base_url('public/home/assets');?>/font-awesome-4.1.0/css/font-awesome.min.css">
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
            <li <?php if ($uri == 'product' ) echo 'class="active"';?>><a href="<?php echo base_url('admin/product');?>">Products</a></li>
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
