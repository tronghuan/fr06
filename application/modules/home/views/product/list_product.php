<div class="padding-s">
        <div class="page-title category-title">
            <h1>All Product</h1>
        </div>

            <div class="category-products">
                <div class="toolbar">
                    <div class="pager">
                        <p class="amount">
                            <strong><?php if (isset($nums))echo $nums . ' items';?></strong>
                        </p>
                    </div>

                <!--  Create Unity navbar -->
                <div class="row">
                <?php
                    if (product::$_searchName != NULL && product::$_searchName){
                        $title = product::$_searchName;
                        $this->session->set_flashdata('product_search_name', product::$_searchName);
                        }else $title = 'product_name';
                    if (product::$_searchType != NULL && product::$_searchType){
                        $order = product::$_searchType;
                        $this->session->set_flashdata('product_search_type', product::$_searchType);
                    } else $order = 'ASC';
                ?>
                    <div class="product_sort col-sm-6">
                        <form class="form-inline " method="post" action="" role="form" >
                            <div class="form-group"><label for="search_name" class="control-label">Sắp xếp:</label>
                                <select name="search_name" class="form-control input-sm"id="product_order_header">
                                    <option value="product_name" <?php if (isset($title) && ($title == 'product_name')) echo 'selected';?> >Tên sản phẩm</option>
                                    <option value="product_price" <?php if (isset($title) && ($title == 'product_price')) echo 'selected';?> >Giá</option>
                                    <option value="product_sale" <?php if (isset($title) && ($title == 'product_sale')) echo 'selected';?> >Khuyến mại(%)</option>
                                    <option value="product_date" <?php if (isset($title) && ($title == 'product_date')) echo 'selected';?> >Ngày nhập hàng</option>
                                    <option value="brand_id" <?php if (isset($title) && ($title == 'brand_id')) echo 'selected';?> >Nhãn hiệu</option>
                                </select></div>
                            <div class="form-group"><label name="type_search" id="type_seach" class="control-label">Thứ tự:</label>
                            <select  name="type_search" class="input-sm form-control" id="product_order_type_header">
                                <option value="ASC"  <?php if (isset($order) && ($order == 'ASC')) echo 'selected';?> >ASC</option>
                                <option value="DESC"  <?php if (isset($order) && ($order == 'DESC')) echo 'selected';?> >DESC</option>
                            </select></div>
                            <a name="btnok" id="btn_order"value="sort" class="btn btn-warning btn-sm" >Sort</a>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-2">
                                <label>
                                    <select id="limit" class="form-control input-sm" arria-controls="datatable-examples">
                                        <?php if (isset($limit) && $limit) echo '<option>'.$limit.'</option>'; else {?>
                                        <option value="0"> </option>
                                        <?php }?>
                                        <option >3</option>
                                        <option >5</option>
                                        <option>10</option>
                                        <option>15</option>
                                    </select>
                                </label>
                        </div>
                        <div class="input-group custom-search-form col-sm-offset-3">
                            <input class="form-control input-sm" type="text" placeholder="search ..." autocomplete="on" id="search-text"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" id="search-button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                </div>
                <script>
                    var ajax_pagination = 0;
                    var base_url = "<?php echo base_url();?>";
                    var address = "<?php echo  base_url("home/product/index")?>";
                    <?php
                        if ($ajax_pagination != 0) {
                            echo 'ajax_pagination = 1';
                        }
                    ?>
                    $(document).ready(function () {
                        $('#btn_order').click(function () {
                            var order_name = $('#product_order_header').val();
                            var order_type = $('#product_order_type_header').val();
                            ajax_product_home_sort(order_name, order_type,address,"#list-product", base_url);
                        });
                        $('ul.pagination li a').on('click', function (event){
                            var con = $(this).html();
                            con = con.toLowerCase();
                            var has_class = $(this).parent().attr('class');
                            if (con === 'prev' || con === 'next') {
                                $li_highlevel = $(this).parent().parent().children('li');
                                $li_highlevel.each(function () {
                                    var cur_page = $(this).attr('class');
                                    if (typeof cur_page !== 'undefined' && cur_page === 'active') {
                                        if (con == 'prev') {
                                            con = $(this).children('a').html();
                                            con = parseInt(con) - 1;
                                        }else {
                                            con = $(this).children('a').html();
                                            con = parseInt(con) + 1;
                                        }
                                    }
                                });
                            }
                            if (has_class != 'active')ajax_get_product_content(con, address,"#list-product",base_url);
                            event.preventDefault();
                        })
                    });
                </script>
                <!-- End Unity navbar -->

                <!--  list product: start-->
                <div class="products-grid row" id="list-product">
                    <?php if(isset($new_product) ) {?>
                    <?php  foreach ($new_product as $product){?>
                    <?php
                        $url = $product['product_name'];
                        mb_internal_encoding('utf-8');
                        $url = str_replace(' ', '-', $url);
                        $url = base_url("home/product/detail/" . $product['product_id'] . '/' . $url);
                    ?>
                    <div class="item col-lg-3 col-sm-12">
                        <div class="row item-row">
                            <div class="product_info col-lg-12 col-sm-4">
                                <a href="<?php echo $url;?>" title="<?php echo $product['product_name'] ?>" class="product-image">
                                    <?php echo $product['product_mainImageId']?>
                                </a>
                            </div>
                            <div class="product-shop col-lg-12 col-sm-8">
                                <h2 class="product-name"><a href="<?php echo $url;?>" title="<?php echo $product['product_name']?>"><?php echo $product['product_name']; ?></a></h2>
                                <div class="price-box">
                                       <span class="regular-price" id="product-price-1">
                                            <span class="price"><?php

                                                echo $product['sale_price']; ?>&nbsp;VND</span>
                                       </span>

                                </div>
                                  <div class="actions">
                                    <button type="button" title="Add to Cart" class="button btn-cart" onclick=""><span><span>Add to Cart</span></span></button>
                                        <ul class="add-to-links">
                                            <li><a data-original-title="Add to Wishlist" href="" rel="tooltip" class="link-wishlist">Add to Wishlist</a></li>
                                            <li><span class="separator">|</span> <a data-original-title="Add to Compare " href="" rel="tooltip" class="link-compare ">Add to Compare</a></li>
                                        </ul>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                <!-- list product : end -->
                <div class="toolbar-bottom">
                    <div class="toolbar">
                        <div class="pager">
                            <p class="amount">
                                <input type="hidden" id="ajax_pagination" value="<?php if(isset($ajax_pagination)) echo $ajax_pagination; else echo 0;?>"/>
                                <strong><?php if (isset($nums))echo $nums . ' items';?></strong>
                                <div class="navigation" id="pagination-div-wrapp"style="float:right">
                                    <ul class="pagination"><?php if (isset($pagination))echo $pagination;?></ul>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
</div>


