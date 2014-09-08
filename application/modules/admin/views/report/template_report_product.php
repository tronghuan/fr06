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
                </div>