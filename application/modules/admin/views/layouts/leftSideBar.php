<style>
    div.panel-body > ul > li {
        list-style: none;
        width: 100%;
    }
    .clear-padding {
        padding-left: 0px; 
    }
    li > ul > li >a{
        color: black;
        display: block;
        padding: 10px 15px 10px 16px;
    }
    li > ul > li > a:focus {
        background-color: transparent ; 
    }
    ul ,li {
        list-style: none;
    }
</style>
<div class="col-lg-3 col-xs-12">
    <div class="sidebar" style="border: 1px;">
        <div class="panel panel-default panel-info">
            <div class="panel-heading">Admin control panel</div>
            <div class="panel-body">
                <ul class="nav navbar-nav side-nav nav nav-pills nav-stacked nav-tabs">
                    <li class="active">
                        <a data-target="#user-manager" data-toggle="collapse" href="javascript:;" class="collapsed">Quản lý người dùng&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding list-group" id="user-manager">
                            <li><a href="<?php echo base_url();?>admin/user/index" class="list-group-item" class="collapsed">Danh sách người dùng</a></li>
                            <li><a href="<?php echo base_url();?>admin/user/add" class="list-group-item">Thêm người dùng</a></li>
                        </ul>                
                    </li>                        
                    <li class="active">
                        <a data-target="#brand-manager" data-toggle="collapse" href="javascript:;">Quản lý hãng sản xuất&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding list-group" id="brand-manager">
                            <li ><a class="list-group-item" href="<?php echo base_url();?>admin/brand/index">Danh sách hãng sản xuất</a></li>
                            <li><a class="list-group-item" href="<?php echo base_url();?>admin/brand/add">Thêm nhãn hàng</a></li>
                        </ul>    
                    </li>
                    <li class="active info">
                        <a href="javascript:;" data-target="#category-manager" data-toggle="collapse" href="javascript:;" class="collapsed">Quản lý hãng category&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding" id="category-manager">
                            <li ><a class="list-group-item" href="<?php echo base_url();?>admin/category/index">Danh sách hãng category</a></li>
                            <li><a class="list-group-item" href="<?php echo base_url();?>admin/category/add">Thêm nhãn hàng</a></li>    
                        </ul>
                    </li>
                
                    <li class="active info">                
                        <a href="javascript:;" data-target="#product-manager" data-toggle="collapse" href="javascript:;" class="collapsed">Quản lý sản phẩm&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding" id="product-manager">
                            <li ><a class="list-group-item" href="<?php echo base_url();?>admin/product/index">Danh sách hãng sản phẩm</a></li>
                            <li><a class="list-group-item" href="<?php echo base_url();?>admin/product/add">Thêm sản phẩm</a></li>            
                        </ul>
                    </li>
                    <li class="active info">                
                        <a href="javascript:;" data-target="#slider-manager" data-toggle="collapse" href="javascript:;" class="collapsed">Quản lý slider&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding" id="slider-manager">
                            <li ><a class="list-group-item" href="<?php echo base_url();?>admin/slider/index">Sắp xếp Slider</a></li>                            
                        </ul>
                    </li>
                    <li class="active info">                
                        <a href="javascript:;" data-target="#order-manager" data-toggle="collapse" href="javascript:;" class="collapsed">Quản lý Hóa đơn&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding" id="order-manager">
                            <li ><a class="list-group-item" href="<?php echo base_url();?>admin/product/index">Danh sách Hóa đơn</a></li>
                            <li><a class="list-group-item" href="<?php echo base_url();?>admin/product/add">Thêm sản phẩm</a></li>            
                        </ul>
                    </li>
                    <li class="active info">                
                        <a href="javascript:;" data-target="#system-manager" data-toggle="collapse" href="javascript:;" class="collapsed">Quản lý sản phẩm&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding" id="system-manager">
                            <li ><a class="list-group-item" href="<?php echo base_url();?>admin/product/index">Danh sách cấu hình </a></li>
                            <li><a class="list-group-item" href="<?php echo base_url();?>admin/product/add">Số item trên mỗi trang</a></li>            
                        </ul>
                    </li>
                    <li class="active info">                
                        <a href="javascript:;" data-target="#comment-manager" data-toggle="collapse" href="javascript:;" class="collapsed">Quản lý Comment&nbsp;<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse clear-padding" id="comment-manager">
                            <li ><a class="list-group-item" href="<?php echo base_url();?>admin/product/index">Danh sách Comment</a></li>
                            <li><a class="list-group-item" href="<?php echo base_url();?>admin/product/add">Danh sách comment black list</a></li>            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>