<style>
    ul , li {
        list-style: none;
    }
</style>

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
    <div class="panel-heading">Best seller products report</div>
    <div class="panel-body">
        <div class="table-responsive table table-hover">
            <div class="dataTables_wrapper form-inline" role="grid">
                <div class="row">
                <?php 		//$title = $this->session->flashdata('search_name');
                                    //$order = $this->session->flashdata('search_type');
                                    if (report::$_searchName != NULL && report::$_searchName){
                                        $title = report::$_searchName;
                                        $this->session->set_flashdata('product_search_name', report::$_searchName);
                                        }else $title = 'product_name';
                                    if (report::$_searchType != NULL && report::$_searchType){
                                        $order = report::$_searchType;
                                        $this->session->set_flashdata('product_search_type', report::$_searchType);
                                    } else $order = 'ASC';

                ?>

                    <div class="product_sort col-lg-offset-1    " >
                        <form class="form-inline" method="post" action="" role="form" >
                            <div class="form-group">
                                <label for="start_name" class="control-label"> Start date:</label>
                                <div class="input-group date">
                                  <input type="text" class="form-control input-sm "  name="start_date" <?php if(isset($start_date)) echo 'value="'.$start_date.'"';?> id="start-date"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label name="type_search">End date:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" <?php if(isset($end_date)) echo 'value="' .$end_date.'"';?> name="end_date" id="end_date"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                                <input type="submit" name="btnok" value="best seller" class="btn btn-warning btn-sm"/>
                            </div>
                        </form>
                    </div>
                </div>
                <hr />
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
                    $('div.form-group .input-group.date').datepicker({
                        format: "dd-mm-yyyy",
                        todayHighlight: true
                    });
                </script>
                <table id="list-product" class="table table-responsive table-hover table-condensed " role="table">
                    <thead>
                    <tr>
                        <td>STT</td>
                        <td>Image</td>
                        <td>Extra information</td>
                    </tr>
                    </thead>
                    <tbody id="i-love-u">
                    <?php $i = isset($i) ? $i : 1?>
                    <?php if(isset($results) ) {?>
                        <?php foreach($results as $listPro){ ?>
                        <?php
                        ?>
                        <tr <?php if ($i < 4) echo 'class="warning"'; else echo 'class="success"'?>>
                            <td><?php echo $i ++ ?></td>
                            <td><ul class="nav-pills nav-stacked"><li class="image-main-product"><?php echo $listPro['product_mainImageId'];?></li><br/>
                                <li >
                                    <a  href="#"><span class="badge pull-right" style="color: white; background: red;"><?php echo $listPro['nums'];?></span><?php echo $listPro['product_name'];?> </a>
                                </li>
                            </ul></td>
                            <td><?php echo $listPro['product_extra_info']; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php }?>
                <div class="row">
                    <div class= "col-sm-6 col-sm-offset-6" style="height: 36px;">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <?php if (isset($page_links)) echo $page_links;?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<?php if(isset($cat_pros)) {?>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">Best seller 's Categories</div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <?php
                        $i = 0;
                        foreach($cat_pros as $cat)
                        {
                            echo '<li ';
                            if ($cat->getLevel() == 0){ echo 'class="active"';
                                $i ++;
                                }
                                echo '><a href="#">';
                                    echo '<span class="badge pull-right"';
                                        if($cat->getLevel() == 0 && $i < 4) echo 'style="color: white;background: red"';
                                    echo ' >' . $cat->getNums(). '</span>';
                                    $tmp = '';

                                    for($i = $cat->getLevel(); $i > 1; $i --){
                                        $tmp .= '&nbsp;&nbsp;';
                                    }
                                    echo $tmp . $cat->getName();
                                echo '</a>';
                            echo '</li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php }?>