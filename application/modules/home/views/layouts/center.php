<head>
    <title><?php echo $title;?></title>
</head>
<!-- ============START MAIN-CONTAINER============ -->
	<div class="main-container col2-right-layout">
		<div class="container">
			<div class="row">
				<div class="span12">
                    <!-- ===== Slider : Start === 
                        // Slider sẽ hiển thị 3 - 4 sản phẩm của product đã config trong admin.
                        // Cấu hình slide: Tùy chọn 
                    -->
                    <div class="home-class">
                    </div>  
                    <!-- ===== Slider : END ==== -->
                    <!-- ===== Main : start
                        // Thực hiện list product ở đây theo sản phẩm mới nhất và sale product
                        // Sale product có dán nhãn ở trên và in giá thật và giá khuyến mãi.
                        // Sản phẩm mới nhất : 3 sản phẩm list ở trang đầu tiên.
                        // Ghi chú: đây không phải là trang list all product.
                    -->
					<div class="main">
						<div class="row">
                          <div class="col-main ">
                            <div class="padding-s">
                        
                                <div class="clear"></div>
                                    <div class="page-title category-title">
                                    <h1 class="subtitle">New Products</h1>
                                </div>
                                    <!-- ===== New product list  ==== -->
                                    
                                <ul class="products-grid">
                                 <?php if(isset($new_product) ) {?>
                                    <?php  foreach ($new_product as $product){?>
									<?php
										$url = $product['product_name'];
										mb_internal_encoding('utf-8');
										$url = str_replace(' ', '-', $url);
										$url = base_url("home/product/detail/" . $product['product_id'] . '/' . $url);
									?>
									
                                    <li class="item">
                                        <a href="" title="" class="product-image">
                                           <?php echo $product['product_mainImageId']?></a>

                                        <div style="height: 111px;" class="product-shop">
                                            <h3 class="product-name"><a
                                                    href=""
                                                    title="<?php echo $product['product_name'] ?>"><?php echo $product['product_name'] ?></a>
                                            </h3>

                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-38-new">
                                                
                                                <span class="price"><?php 
                                                    
                                                echo number_format($product['product_price']); ?>&nbsp;VND</span> </span>
                                            </div>
                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart"
                                                        onclick="">
                                                    <span><span>Add to Cart</span></span></button>
                                                <button type="button" title="Details" class="button btn-details"
                                                        onclick="">
                                                    <span><span>Details</span></span></button>
                                            </div>
                                        </div>
                                    </li>
                                      <?php }}?>
                                </ul>
                              
                            </div>
                        </div>
                        <!-- ===== Random: sale product ==== -->
                        <div class="col-right sidebar span3">
                            <div class="widget widget-catalogsale-products">
                                <div class="block last_block first">
                                    <div class="block-title">
                                        <strong><span>Sale Products</span></strong>
                                    </div>
                                    <div class="block-content">
                                        <ol class="mini-products-list"
                                            id="">
                                            <?php if(isset($sale_product) ) {?>
                                               <?php  foreach ($sale_product as $product_s);?>
                                            <li class="item last odd">
                                                <a class="product-image"
                                                   href=""
                                                   title=""><?php echo $product_s['product_mainImageId']?></a></a>

                                                <div class="product-details">
                                                    <p class="product-name"><a
                                                            href=""
                                                            title=""><?php echo $product_s['product_name']?></a></p>

                                                    <div class="price-box map-info">
                                                        <span class="old-price" 
                                                              id=""><span
                                                                class="price" style="font-size: 14px;color:grey"><?php 
                                                    
                                                        echo number_format($product_s['product_price']); ?>&nbsp;VND</span></span>
                                                        <span class="regular-price" id="product-price-38-new">
                                                
                                                      <span class="price"><?php 
                                                    
                                                     echo number_format($product_s['product_price']); ?>&nbsp;VND</span> </span>
                                                    </div>
                                                    
                                                    <div class="actions">
                                                        <button type="button" title="Add to Cart"
                                                                class="button btn-cart"
                                                                onclick="">
                                                            <span><span>Add to Cart</span></span></button>
                                                        <button type="button" title="Details" class="button btn-details"
                                                                onclick="">
                                                            <span><span>Details</span></span></button>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php }?>
                                        </ol>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- ============END MAIN-CONTAINER============ -->