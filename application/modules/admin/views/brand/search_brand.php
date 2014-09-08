    <script type="text/javascript">
        function checkdel(){
            if(confirm("Bạn có muốn xóa không?")){
                return true;
            }else{
                return false;
            }
        }
    </script>

<div class="panel panel-default panel-info">
    <div class="panel-heading">Danh sách nhà sản xuất</div>
    <div class="panel-body">
        <div class="table-responsive table table-hover">
            <div class="dataTables_wrapper form-inline" role="grid">
                <div class="row">     
                    <div class="col-sm-6 col-sm-offset-1">
                        <div id="content">
                        <div id="brand_search">
                            <form action="" method="post">
                                <input type="text" id="search" name="search" placeholder="Search brand here..." value="" size="30">
                                <select name="type">
                                        <option value="0">Search by id</option>
                                        <option value="1" selected>Search by name</option>
                                </select>
                                <br>
                                <input type="submit" name="submit" value="Search" id="button">
                                <br>
                            </form>
                        </div>
                        
                        <table class="table table-responsive table-hover table-bordered" >
                            <tr align='center'>
                                <td width="10%" > ID </td>
                                <td width='30%'> Name of bran</td>
                                <td width="40%"> Description</td>
                                <td width="10%"> Edit </td>
                                <td width="10%"> Delete </td>
                            </tr>
                            <?php if(!empty($brand)){ ?>
                            <?php foreach($brand as $items){ ?>
                            <tr>
                                <td><?php echo $items['brand_id']; ?></td>
                                <td><?php echo $items['brand_name']; ?></td>
                                <td><?php echo $items['brand_desc'] ; ?></td>
                                <td><a href="<?php echo base_url() ."admin/brand/edit/".$items['brand_id']; ?>">Sửa</a></td>
                                <td><a href="<?php echo base_url() ."admin/brand/del/".$items['brand_id']; ?>" onClick="return checkdel()">Xóa</a></td>
                            </tr>
                            <?php }}else { ?>
                            <tr>
                                <td colspan="5">Ko co san pham nao</td>
                            </tr>
                            <?php } ?>
                        </table>
                        </div>
                    </div>
                                                
                <div class="row">
                    <div class= "col-sm-6 col-sm-offset-3" style="height: 36px;">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <?php
                                // if ( $padding > 1){
                                //     echo '<li><a href="'.base_url().'admin/brand/index?padding='.($padding-1).'"/> << &nbsp </a></li>';
                                // }
                                // for($i = 1; $i <= $total_page; $i++){
                                //     if ($i == $padding) {
                                //         echo '<li class="active"><a href="">['.$i.']</a></li>';
                                //     } else {
                                //         echo '<li><a href="'.base_url().'admin/brand/index?padding='.$i . '"> '. $i . '</a></li>';
                                //     }
                                // }
                                // if($padding < $total_page){ //url hiện tại < tổng số trang đang có thì in dấu >>
                                //     echo '<li><a href="'.base_url().'admin/brand/index?padding=' . ($padding + 1) . '">&nbsp;&nbsp;>></a></li> ';
                                // }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
</div>