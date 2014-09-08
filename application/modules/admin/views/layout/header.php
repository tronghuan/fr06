<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Trang quản trị </title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin/style.list.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>public/js/admin/jquery.nestable.js"></script>
    <script src="<?php echo base_url() ?>public/js/admin/js.js"></script>
    <script>
        $(document).ready(function () {

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            }).on('change', updateOutput);

            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));

        });
    </script>
</head>
<body>
<div id="container">
    <div id="banner">&nbsp;</div>
    <div id="menu"><h1>Trang quản lý</h1></div>
    <div id="main">
        <div id="left">
            <div class="category">
                <h1>MENU CHỨC NĂNG</h1>
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php/admin/user/listuser">Quản
                            lý thành viên</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/admin/category/move">Quản lý chuyên mục</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/admin/product/listproduct">Quản lý sản phẩm</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/admin/brand/search">Quản lý nhãn hiệu</a></li>
                    <li><a href="#">Quản lý đơn hàng </a></li>
                    <li><a href="#">Quản lý cấu hình </a></li>
                    <li><a href="#">Quản lý comment </a></li>
                </ul>
            </div>
            <div class="category" style="margin-top:10px; border-top:1px solid #CCC; background:#FFF;">
                <p>Chào bạn:
                    <?php if(session_id() == '') {
                        session_start();
                    };
                    // print_r($_SESSION['user']);
                    echo  isset($_SESSION['user']['username']) ?  $_SESSION['user']['username'] : "";
                    ?></p>
                <p><a href=' <?php echo base_url("index.php/admin/user/login") ?> '>Đăng xuất</a></p>
            </div>

        </div>