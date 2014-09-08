<meta charset="utf-8">
<style>
    #gallery, #upload {
        border: 1px solid #ccc;
        margin: 10px auto;
        width: 1000px;
        padding: 10px;
    }

    #blank_gallery {
        font-family: Arial;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }

    .thumb {
        float: left;
        width: 150px;
        height: 100px;
        padding: 10px;
        margin: 10px;
        background-color: #ddd;
    }

    .thumb:hover {
        outline: 1px solid #999;
    }

    img {
        border: 0;
    }

    #gallery:after {
        content: ".";
        visibility: hidden;
        display: block;
        clear: both;
        height: 0;
        font-size: 0;
    }

</style>
<h1>Update Product</h1>
<?php foreach ($single_product as $product); ?>
<?php foreach($check_cate as $key=>$value){
    $value_new[]=$value['category_id'];
}; ?>
<form method="post" enctype="multipart/form-data">
        <table>
    <tr><td><label>Name product:</label></td> <td><input type="text" name="txt_name" value="<?php echo  $product['product_name'];  ?>"/></td>
    </tr>
   <tr><td> <label>Product describle:</label></td><td><textarea name="txt_desc"><?php echo  $product['product_desc'];  ?></textarea></td>
            </tr>
            <div id="gallery">
                <?php if (isset($image_main)){
                    foreach($image_main as $image):	?>
                        <div class="thumb">
                            <a href="<?php echo $image['url']; ?>">
                                <img src="<?php echo $image['thumb_url']; ?>" />
                            </a>
                        </div>


                        <input type="text" hidden="hidden" value="<?php
                            echo $image['name'];
                        ?>"/>
                    <?php endforeach; } else{
                    ?>
                        <div id="blank_gallery">NO MAIN IMAGE - NEW</div>
                <?php ;} ?>
            </div>
           <tr><td><label>Product Price:</label></td><td> <input type="text" name="txt_price" value="<?php echo  $product['product_price'];  ?>"/>.000 VND
               </td>
           </tr>
            <tr><td><label>Product Sale:</label></td><td> <input type="text" name="txt_sale" value="<?php echo  $product['product_sale'];  ?>" maxlength="2"/>%
                </td>
            </tr>
            <tr>
                <td>
                    <label>Brand : </label>
                </td>
                <td><select name="Brand">

                        <?php foreach($list_brand as $brand){
                            if($brand['brand_id'] == $product['brand_id']){
                                echo '<option value="'.$brand['brand_id'].'" selected>'.$brand['brand_name'].'</option>';

                            }
                            else
                            {
                                echo '<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
                            }
                        }
                        ?>

                        <?php ; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Countries</label>
                </td>
                <td><select name="countries">
                        <?php foreach($countries as $country){
                            if($country['country_id'] == $product['country_id']){
                                echo '<option value="'.$country['country_id'].'" selected>'.$country['country_name'].'</option>';

                            }
                            else
                            {
                                echo '<option value="'.$country['country_id'].'">'.$country['country_name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Category</label>
                    <div>

                        <?php foreach($list_category as $category){
                            if(in_array($category['category_id'],$value_new)){

                                echo "<input type='checkbox' name='checkbox[]' value='".$category['category_id']."' checked='checked'/>
                                        <label>".$category['category_name']."</label></br>";
                            }else{

                                echo "<input type='checkbox' name='checkbox[]' value='".$category['category_id']."'/>
                                        <label>".$category['category_name']."</label></br>";
                            }
                        }
                        ?>
                    </div>
            </select>
            </td>
            </tr>
            <tr>   <td>  <label>Product images:</label></td>
                <?php if($count >= 10 ){
                    echo "<td>Không thể upload thêm ảnh nữa ! Lưu trữ tối đa</td>";
                }else{ ?>
                <td><input type="file" name="images" value=""/></td>
                <td><input type="submit" value="UPLOAD IMAGE" name="Upload"></td>
                    <td>Bạn còn có thể upload thêm <?php $a = 10 - $count; echo $a; ?> ảnh nữa</td>
                <?php } ?>
            </tr>
        </table>

<div id="gallery">
    <?php if (isset($image_all)):
        foreach($image_all as $images):

            ?>

            <div class="thumb">
                <a href="<?php echo $images['url']; ?>">
                    <img src="<?php echo $images['thumb_url']; ?>" />
                </a>
                <?php if($images['image_id'] == $product['product_mainImageId'] ){?>
                <input type="radio" value="<?php echo $images['image_id']?>" name="img_box" checked="checked"/>Ảnh chính</br>
                    <?php }else{?>
                    <input type="radio" value="<?php echo $images['image_id']?>" name="img_box"/>Ảnh chính</br>
                <?php }?>
            <a href="<?php echo base_url().'admin/product/delete_images/'.$images['image_id'];?>">Delete</a>
            </div>
        <?php endforeach; else: ?>
        <div id="blank_gallery">Please Upload an Image</div>
    <?php endif; ?>

</div>
    <input type="submit" value="Hoàn tất" name="update"></td>
</form>