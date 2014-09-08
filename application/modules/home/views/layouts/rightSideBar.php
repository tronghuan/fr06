        <!--  filter - right: start-->
<div class="span3">
    <div class="block block-layered-nav first">
    <div class="block-title">
        <strong><span>Shop By</span></strong>
    </div>
    <div class="block-content">
        <p class="block-subtitle">Shopping Options</p>
        <!-- Acc1 Start -->
        <script>
            $(function() {
                $( "#slider" ).slider({
                    range: true,
                    min: 0,
                    max: 30000000,
                    step: 50000,
                    values: [ 0, 30000000 ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] + "VND");
                        $( "#min" ).attr("value",ui.values[ 0 ]);
                        $( "#max" ).attr( "value",ui.values[ 1 ]);
                    }
                });

                $( "#amount" ).val( $( "#slider" ).slider( "values", 0 ) +
                " - " + $( "#slider" ).slider( "values", 1 ) + "VND");
            });

        </script>
        <p>
        <label for="amount">Price range:</label>
        <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
        </p>
        <div id="slider"></div>
        <form action="<?php echo base_url(); ?>home/product/filter" method="post">
            <?php  
                foreach($brand as $key => $value){
                    echo "<input type='checkbox' name='brand_".$value['brand_id']."' value='".$value['brand_id']."' />".$value['brand_name']."<br />";
                }
            ?>
            <input hidden type="text" id="min" name="min" value="0" />
            <input hidden type="text" id="max" name="max" value="30000000" />
            <input type="submit" name="submit" value="Submit" />
        </form>

        <!-- Acc1 End -->
    </div>
</div>
    <div class="block block-cart">
        <div class="block-title">
            <strong><span>My Cart</span></strong>
        </div>
        <div class="block-content">
            <p class="empty">You have no items in your shopping cart.</p>
        </div>
    </div>
    
    <div class="block block-list block-compare">
        <div class="block-title">
            <strong><span>Compare Products                    </span></strong>
        </div>
        <div class="block-content">
            <p class="empty">You have no items to compare.</p>
        </div>
    </div>
</div>
        <!--  filter - right : end-->