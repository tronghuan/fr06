<style>
</style>

<div class="panel panel-default panel-info">
    <div class="panel-heading">Danh sách người dùng</div>
    <div class="panel-body">
        <div class="table-responsive ">
            <div class="dataTables_wrapper form-inline" role="grid">
                <div class="row">
                <?php 		//$title = $this->session->flashdata('search_name'); 
                                    //$order = $this->session->flashdata('search_type'); 
                                    if (user::$_searchName != NULL && user::$_searchName){
                                        $title = user::$_searchName;
                                        $this->session->set_flashdata('user_search_name', user::$_searchName);
                                        }else $title = 'user_name';
                                    if (user::$_searchType != NULL && user::$_searchType){
                                        $order = user::$_searchType;
                                        $this->session->set_flashdata('user_search_type', user::$_searchType);
                                    } else $order = 'ASC';
                ?>
                    <div class="user_sort col-sm-6">
                        <form class="form-inline " method="post" action="" role="form" >
                            <div class="form-group"><label for="search_name" class="control-label">Sắp xếp:</label>
                                <select name="search_name" class="form-control input-sm"id="search">
                                    <option value="user_name" <?php if (isset($title) && ($title == 'user_name')) echo 'selected';?> >User name</option>
                                    <option value="user_fullName" <?php if (isset($title) && ($title == 'user_fullName')) echo 'selected';?> >Tên đầy đủ</option>
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
                                <option >5</option>
                                <option>10</option>
                                <option>15</option>                                                                
                            </select> per page
                        </label>
                        <div class="input-group custom-search-form col-sm-offset-1">
                            <input class="form-control input-sm" type="text" placeholder="search ..." autocomplete="on" id="search-text"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" id="search-button">
                                    <i class="fa fa-search">S</i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function delete_user()
                    {
                        return confirm('xóa người dùng');
                    }
                    var base_url = "<?php echo base_url();?>";
                    var address =  "<?php echo base_url();?>admin/user/index<?php if (isset($i)) echo '/'. $i;?>";                    
                    $(document).ready(function () {
                        $('#limit').change(function (){
                            var name = [];                            
                            name[0] = 'limit';
                            name[1] = 'ajax';
                            value = [];
                            value[0] = $(this).val();
                            value[1] = true;
                            var result;
                            result = ajax_user_send(address, name, value, base_url);
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
                            result = ajax_user_send(address, name, value, base_url);                            
                        });
                    });
                </script>                
                <?php
                if (isset($listUsers) &&  $listUsers != NULL) {
                    ?>
                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên tài khoản</th>
                            <th>Tên người dùng</th>
                            <th>Địa chỉ Email</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Giới tính</th>
                            <th>Cập nhật</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="i-love-u">
                        <?php
                            foreach($listUsers as $user)
                            {
                                echo '<tr class="tr-user">';
                                    if ($user['user_gender'] == 1)$gender = 'Nam';
                                    else if ($user['user_gender'] == 2)$gender = 'Nữ';
                                    else $gender = 'N/A';
                                
                                    echo '<td>'.$i ++.'</td>';
                                    echo '<td>'.$user['user_name'].'</td>';
                                    echo '<td>'.$user['user_fullName'].'</td>';
                                    echo '<td>'.$user['user_email'].'</td>';
                                    echo '<td>'.$user['user_address'].'</td>';
                                    echo '<td>'.$user['user_phone'].'</td>';
                                    echo '<td>'.$gender.'</td>';
                                    echo '<td><a href="'.base_url().'admin/user/edit/'.$user['user_id'].'" ><i class="fa fa-gear fa-fw"></i>Thay đổi</a>';
                                    echo '<td><a href="'.base_url().'admin/user/delete/'.$user['user_id'].'" onClick="return delete_user();">Xóa</a> </td>';
                                echo '</tr>';
                            }
                        ?>    
                    </tbody>
                </table>
                    <?php
                }
                 ?>
                <div class="row">
                    <div class= "col-sm-6 col-sm-offset-6">
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