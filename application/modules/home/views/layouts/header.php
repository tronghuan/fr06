<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?php echo base_url();?>public/css/frontend/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>public/css/frontend/superfish.css" rel="stylesheet" type="text/css">
    <!-- CSS link Acc1 Start -->
    <link href="<?php echo base_url(); ?>public/css/frontend/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>public/css/frontend/jquery-ui.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>public/home/assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/home/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>public/js/home/jquery.fancybox.js"></script>
    <script src="<?php echo base_url(); ?>public/js/home/cookies.js"></script>
    <!-- CSS link Acc1 End -->

		<!-- Binh start editting add ome iles and odions -->
		<title><?php if (isset($title_for_layout)) echo $title_for_layout; else echo $site_name;?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("public/home/assets/ico/favicon.ico"); ?>"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>public/home/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/home/assets/css/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/home/assets/css/rating.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/home/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/home/assets/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- JS Acc1 Start -->
    
    <!-- JS Acc1 End -->
    <script src="<?php echo base_url()?>public/home/assets/js/bootstrap-datepicker.js"></script>

    <script src="<?php echo base_url()?>public/home/assets/js/my_js.js"></script>
    <script src="<?php echo base_url()?>public/home/assets/js/my_rating.js"></script>
    <!-- Finish include-->
    <script type="text/javascript">
    function openFancybox() {
            setTimeout(function () {
                $('#yt').trigger('click');
            }, 200);
        };
        $(document).ready(function () {
            var visited = $.cookie('visited');
            if (visited == 'yes') {
                return false; // second page load, cookie active
            } else {
                openFancybox(); // first page load, launch fancybox
            }
            $.cookie('visited', 'yes', {
                expires: 1 // the number of days cookie  will be effective
            });
            $("#yt").click(function () {
                $.fancybox({
                    content: "<img src='http://localhost/mock/public/images/MUATUUTRUONG2a.png'/>",
                    type: "iframe",
                });
                return false;
            });
        });
</script>
</head>
<body class=" cms-index-index cms-home">
<div id="yt"></div>
<div class="wrapper end-lang-class">
<noscript></noscript>
<div class="page">
<!-- ============START HEADER-CONTAINER============ -->
	<div class="header-container">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="header">
						<p class="welcome-msg"></p>

                    <div class="header-buttons">
                        <div class="row-1">
                            <div class="header-button top-login">
                                <ul style="display: none;" class="links">
                                    <li class="first last"><a
                                            href="#"
                                            title="Log In" class="Login_link">Log In</a></li>
                                </ul>
                            </div>
                            <div class="header-button menu-list">
                                <a href="#"></a>
                                <ul style="display: none;" class="links">
                                    <li class="first"><a
                                            href="http://livedemo00.template-help.com/magento_43805/customer/account/"
                                            title="My Account">My Account</a></li>
                                    <li><a href="http://livedemo00.template-help.com/magento_43805/checkout/cart/"
                                           title="My Cart" class="top-link-cart">My Cart</a></li>
                                    <li><a href="http://livedemo00.template-help.com/magento_43805/checkout/"
                                           title="Checkout" class="top-link-checkout">Checkout</a></li>
                                    <li class=" last"><a
                                            href="http://livedemo00.template-help.com/magento_43805/wishlist/"
                                            title="My Wishlist">My Wishlist</a></li>
                                </ul>
                            </div>
                            <div class="header-button currency-list">
                                <a href="#">$</a>
                                <ul style="display: none;">
                                    <li>
                                        <a href="images/image06.jpg"
                                           title="GBP">British Pound Sterling - GBP</a>
                                    </li>
                                    <li>
                                        <a href="images/file1.jpg"
                                           title="EUR">Euro - EUR</a>
                                    </li>
                                    <li>
                                        <a href="images/image05.jpg"
                                           title="USD">US Dollar - USD</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="header-button lang-list">
                                <a class="" href="#">
                                    en


                                </a>
                                <ul style="display: none;">
                                    <li>
                                        <a class=""
                                           href="file_1_4.jpg"
                                           title="en_US">English</a>
										<span>	en </span>
                                    </li>
                                    <li>
                                        <a class=""
                                           href="http://livedemo00.template-help.com/magento_43805/?___store=german&amp;___from_store=default"
                                           title="de_DE">German</a>
<span>
</span>
                                    </li>
                                    <li>
                                        <a class=""
                                           href="http://livedemo00.template-help.com/magento_43805/?___store=spanish&amp;___from_store=default"
                                           title="es_ES">Spanish</a>
<span>
</span>
                                    </li>
                                    <li>
                                        <a class=""
                                           href="http://livedemo00.template-help.com/magento_43805/?___store=russian&amp;___from_store=default"
                                           title="ru_RU">Russian</a>
<span>
</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="quick-access">
                        <div class="header-links">
                            <ul class="links">
                                <li class="first last"><a
                                        href="http://livedemo00.template-help.com/magento_43805/customer/account/login/"
                                        title="Log In" class="Login_link">Log In</a></li>
                            </ul>
                            <ul class="links">
                                <li class="first"><a
                                        href="http://livedemo00.template-help.com/magento_43805/customer/account/"
                                        title="My Account">My Account</a></li>
                                <li><a href="http://livedemo00.template-help.com/magento_43805/checkout/cart/"
                                       title="My Cart" class="top-link-cart">My Cart</a></li>
                                <li><a href="http://livedemo00.template-help.com/magento_43805/checkout/"
                                       title="Checkout" class="top-link-checkout">Checkout</a></li>
                                <li class=" last"><a href="http://livedemo00.template-help.com/magento_43805/wishlist/"
                                                     title="My Wishlist">My Wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                    <h1 class="logo"><strong>Magento Commerce</strong><a
                            href="http://livedemo00.template-help.com/magento_43805/" title="Magento Commerce"
                            class="logo"><img src="<?php echo base_url();?>public/images/frontend/logo.png" alt="Magento Commerce"></a></h1>

                    <div class="row-2">
                        <div class="block-cart-header">
                            <h3>My Cart:</h3>

                            <div class="block-content">
                                <div class="empty">
                                    0 item(s) - <span class="price">$0.00</span>

                                    <div style="display: none;" class="cart-content">
                                        You have no items in your shopping cart.
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div><!-- end div row-2 -->
                    <form id="search_mini_form" action="<?php echo base_url();?>home/product/result/" method="get">
                        <div class="form-search" >
                            <label for="search">Search:</label>
                            <input autocomplete="off" id="search" name="search_name" class="input-text form-control"
                                   type="text">
                            <button type="submit" title="Search" class="button"><span><span>Search</span></span>
                            </button>
                            <div style="z-index: 10000;display: none;position: absolute;left: 0; width: 100%;" id="search_autocomplete" class="search-autocomplete col-lg-12"></div>
                            <script type="text/javascript">
							  $(function(){
							  $("#search").keyup(function()
							  {
							  var searchid = $(this).val();
							  var dataString = 'search='+ searchid;
							  if(searchid !='')
							  {
								  $.ajax({
								  type: "POST",
								  url: "<?php echo base_url();?>home/product/search",
								  data: dataString,
								  cache: false,
								  success: function(html)
								  {
									json = JSON.parse(html);
									var result = '';
									for (i = 0; i < json.length; i ++)
									{
									  result += json[i];
									}
									$('#search_autocomplete').html(result).show();
									console.log(result);
								  }
								  });
							  }else {
								$('#search_autocomplete').html('');
							  }
							  return false;
							  });
							  $("#search_autocomplete").on("click",function(e){
								  var $clicked = $(e.target);
								  var $name = $clicked.find('.name').html();
								  var decoded = $("<div>").html($name).text();
								  $('#searchid').val(decoded);
							  });
							  $(document).on("click", function(e) {
								  var $clicked = $(e.target);
								  if (! $clicked.hasClass("search")){
								  $("#search_autocomplete").fadeOut();
								  }
							  });
							  $('#search_autocomplete').on(function(){
								alert('fade in');
								  $("#search_autocomplete").fadeIn();
							  });
							});
                            </script>
                        </div>
                    </form>
                    <div class="clear"></div>
					</div>
				</div>
			</div><!-- end div row -->
			<div class="clear"></div>
		</div><!-- end div container -->
	</div><!-- end div header container -->
<!-- ============END HEADER-CONTAINER============ -->

<!-- ============START NAV-CONTAINER============ -->
	<div class="nav-container">
		<div class="container">
			<div class="row">
				<div class="span12">
                <div id="menu-icon">Categories</div>
                <ul id="nav" class="sf-menu sf-js-enabled">
                    <li class="level0 nav-1 first level-top"><a
                            href="<?php echo base_url();?>home/product/index/MTXT"
                            class="level-top"><span>MTXT</span></a></li>
                    <li class="level0 nav-2 level-top"><a
                            href="<?php echo base_url();?>home/product/index/Dell"" class="level-top"><span>Dell</span></a>
                    </li>
                    <li class="level0 nav-3 level-top"><a
                            href="<?php echo base_url();?>home/product/index/Latitude"" class="level-top"><span>Latitude</span></a>
                    </li>
                    <li class="level0 nav-4 level-top"><a
                            href="<?php echo base_url();?>home/product/index/Iphone""
                            class="level-top"><span>Iphone</span></a></li>
                    <li class="level0 nav-5 last level-top parent"><a
                            href="<?php echo base_url();?>home/product/index/Ban-phim"
                            class="level-top"><span>Home appliances</span></a>
                        <ul style="display: none;" class="level0">
                            <li class="level1 nav-5-1 first"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/air-conditioners-fans.html"><span>Air Conditioners &amp; Fans</span></a>
                            </li>
                            <li class="level1 nav-5-2"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/irons.html"><span>Irons</span></a>
                            </li>
                            <li class="level1 nav-5-3"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/kitchen-appliances.html"><span>Kitchen appliances</span></a>
                            </li>
                            <li class="level1 nav-5-4 last"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/vacuums-floor-care.html"><span>Vacuums &amp; Floor Care</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="sf-menu-phone">
                    <li class="level0 nav-1 first level-top"><a
                            href="http://livedemo00.template-help.com/magento_43805/mobile-phones.html"
                            class="level-top"><span>Mobile phones</span></a></li>
                    <li class="level0 nav-2 level-top"><a
                            href="http://livedemo00.template-help.com/magento_43805/televisions.html" class="level-top"><span>Televisions</span></a>
                    </li>
                    <li class="level0 nav-3 level-top"><a
                            href="http://livedemo00.template-help.com/magento_43805/audio-video.html" class="level-top"><span>Audio / Video</span></a>
                    </li>
                    <li class="level0 nav-4 level-top"><a
                            href="http://livedemo00.template-help.com/magento_43805/cameras-camcorders.html"
                            class="level-top"><span>Cameras &amp; Camcorders</span></a></li>
                    <li class="level0 nav-5 last level-top parent"><a
                            href="http://livedemo00.template-help.com/magento_43805/home-appliances.html"
                            class="level-top"><span>Home appliances</span></a>
                        <ul class="level0">
                            <li class="level1 nav-5-1 first"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/air-conditioners-fans.html"><span>Air Conditioners &amp; Fans</span></a>
                            </li>
                            <li class="level1 nav-5-2"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/irons.html"><span>Irons</span></a>
                            </li>
                            <li class="level1 nav-5-3"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/kitchen-appliances.html"><span>Kitchen appliances</span></a>
                            </li>
                            <li class="level1 nav-5-4 last"><a
                                    href="http://livedemo00.template-help.com/magento_43805/home-appliances/vacuums-floor-care.html"><span>Vacuums &amp; Floor Care</span></a>
                            </li>
                        </ul>
                        <strong></strong></li>
                </ul>
            </div>
				</div>
			<div class="clear"></div>
		</div>
	</div>
<!-- ============END NAV-CONTAINER============ -->
