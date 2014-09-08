<div class="wrapper">
    <?php
        if (isset($list_products) && ! empty ($list_products)) {
            foreach ($list_products as $product) {
                // summary of product
                echo '<div class="product_item">';
                    echo '<div class="main_image" style="float: left;"><img src="" class="thumbnail" width="150" height="150px" /></div>';
                    echo '<div class="product_detail" style="float: left; padding: 10px;">';
                        echo '<a href="'.base_url("home/product/detail/" . $product['product_id'].'/'. $product['product_name']).'" alt="'.$product['product_name'].'" >';
                            echo '<span><b>'.$product['product_name'].'</b></span>';
                        echo '</a><br/>';
                        echo '<span class="extra">';
                            echo 'category:'. $product['category_name'].'-' . 'brand:' . $product['brand_name'].'<br />';
                        echo '</span>';
                    echo '</div>';                
                echo '</div>';
                echo '<div class="clear"></div>';
            }
        }else {
            echo '<div class="message warning">';
            echo 'Mặt hàng chưa có sẵn.';
            echo '</div>';
        }
    ?>
</div>