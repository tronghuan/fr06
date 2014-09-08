<?php if (isset ($errors) || (isset($message))) {?>
<div class="panel panel-default panel-warning">
    <div class="panel-heading">Administrator warning</div>
    <div class="panel-body">
        <?php
            if (isset($errors)) {
                foreach ($errors as $error)
                {
                    echo '<p class="warning">' . $error . '</p>';
                }
            }
        ?>    
    </div>
</div>
<?php }?>
<?php if (isset ($success) || (isset($message))) {?>
<div class="panel panel-default panel-info">
    <div class="panel-heading">Administrator success</div>
    <div class="panel-body">
        <?php
            echo '<p class="warning">' . $success . '</p>';
        ?>    
    </div>
</div>
<?php }?>
<div class="panel panel-default panel-info">
    <div class="panel-heading">Danh sách sản phẩm</div>
    <div class="panel-body">
        <div class="table-responsive table table-hover">
            <div class="dataTables_wrapper form-inline" role="grid">
                <div class="row">
                <?php 		//$title = $this->session->flashdata('search_name'); 
                                    //$order = $this->session->flashdata('search_type'); 
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
                                <select name="search_name" class="form-control input-sm"id="search">
                                    <option value="product_name" <?php if (isset($title) && ($title == 'product_name')) echo 'selected';?> >Tên sản phẩm</option>
                                    <option value="product_price" <?php if (isset($title) && ($title == 'product_price')) echo 'selected';?> >Giá</option>
                                    <option value="product_sale" <?php if (isset($title) && ($title == 'product_sale')) echo 'selected';?> >Khuyến mại(%)</option>
                                    <option value="brand_id" <?php if (isset($title) && ($title == 'brand_id')) echo 'selected';?> >Nhãn hiệu</option>
                                </select></div>
                            <div class="form-group"><label name="type_search" id="type_seach" class="control-label">Thứ tự:</label>
                            <select  name="type_search" class="input-sm form-control" id="search_type">
                                <option value="ASC"  <?php if (isset($order) && ($order == 'ASC')) echo 'selected';?> >ASC</option>
                                <option value="DESC"  <?php if (isset($order) && ($order == 'DESC')) echo 'selected';?> >DESC</option>
                            </select></div>
                            <input type="submit" name="btnok" value="sort" class="btn btn-warning btn-sm"/>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <label>
                            <select id="limit" class="form-control input-sm" arria-controls="datatable-examples">
                                <?php if (isset($limit) && $limit) echo '<option>'.$limit.'</option>'; else {?> 
                                <option value="0"> </option>
                                <?php }?>   
                                <option >3</option>
                                <option >5</option>
                                <option>10</option>
                                <option>15</option>                                                                
                            </select> per page
                        </label>
                        <div class="input-group custom-search-form col-sm-offset-1">
                            <input class="form-control input-sm" type="text" placeholder="search ..." autocomplete="on" id="search-text"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" id="search-button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function delete_product()
                    {
                        return confirm('xóa sản phẩm');
                    }
                    var base_url = "<?php echo base_url();?>";
                    var address =  "<?php echo base_url();?>admin/product/index<?php if (isset($i)) echo '/'. $i;?>";                    
                    $(document).ready(function () {
                        $('#limit').change(function (){
                            var name = [];                            
                            name[0] = 'limit';
                            name[1] = 'ajax';
                            value = [];
                            value[0] = $(this).val();
                            value[1] = true;
                            var result;
                            result = ajax_product_send(address, name, value, base_url);
                        });
                    });
                    $(document).ready(function () {
                         $('#search-button').click(function (e) {
                            var name = [];
                            name[0] = 'search';
                            name[1] = 'ajax';
                            var value = [];
                            value[0] = $('#search-text').val();
                            value[1] = true;
                            var result;
                            result = ajax_product_send(address, name, value, base_url);                            
                        });
                    });
                </script>                
                <div class="col-sm-6">
                    <table id="list-product" class="table table-responsive table-hover " role="table">
                        <thead>
                        <tr>
                            <td>STT</td>
                            <td>Slider</td><!-- Acc1 -->
                            <td>Image</td>            
                            <td>Name</td>
                            <td>Date</td>
                            <td>Price</td>
                            <td>Sale</td>
                            <td>Brand</td>
                            <td>Country</td>
                            <td>Cập nhật</td>
                            <td>Xóa</td>
                        </tr>
                        </thead>
                        <tbody id="i-love-u">
                        <?php $i = isset($i) ? $i : 0?>
                        <?php if(isset($results) ) {?>
                            <?php foreach($results as $listPro){ ?>
                            <?php                      
                            ?>
                            <tr>
                                <td><?php echo $i ++ ?></td>
                                <td><input type='checkbox' class='slider-select' name='slider'
                                    <?php 
                                        foreach($slider as $key => $value){
                                            if($listPro['product_id'] == $value['pro_id']){
                                                echo "checked='checked'";
                                                echo " order='".$value['img_order']."' ";
                                                break;
                                            }
                                        }
                                        echo " img='".$listPro['image_name']."' pro='".$listPro['product_id']."' proname='".$listPro['product_name']."' ";
                                        echo "value='".$listPro['product_id']."'";
                                        // print_r($order);
                                    ?> 
                                    onclick="window.location='<?php echo base_url()?>admin/slider/add_delete_slider?pro_id=<?php echo $listPro['product_id'];?>'; return true;"
                                ></td>
                                <td><?php echo $listPro['product_mainImageId']  ?></td>            
                                <td><?php echo $listPro['product_name'] ?></td>
                                <td><?php echo $listPro['product_date']; ?></td>
                                <td><?php echo $listPro['product_price'] ?></td>
                                <td><?php echo $listPro['product_sale'] ?></td>
                                <td><?php echo $listPro['brand_id'] ?></td>
                                <td><?php echo $listPro['country_id'] ?></td>
                                <td><a href="<?php echo base_url('admin/product/update/' .$listPro['product_id']);?>">Thay đổi</a></td>
                                <td><a href="<?php echo base_url('admin/product/delete/' .$listPro['product_id']);?>">Xóa</a></td>                            
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php }?>
                </div>
                <div class="row">
                    <div class= "col-sm-6 col-sm-offset-6" style="height: 36px;">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <?php if (isset($links)) echo $links;?>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
</div>