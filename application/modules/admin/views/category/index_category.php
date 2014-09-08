<div class="col-lg-6 col-md-4 col-xs-6" >
  <!--<h3>Danh sach category</h3>-->
  <div class="panel panel-default panel-info">
    <div class="panel-heading">
      Danh sách Category
    </div>
    <div>
      <a href="<?php echo base_url(); ?>admin/category/move">Move</a>
    </div>
    <div class="panel-body">
      <?php
          foreach ($cats as $c)
          {
              echo '<p><b>';
              for ($i = 0; $i < $c->getLevel(); $i ++) echo '&ensp;&emsp;&emsp;';
               {
                echo $c->getName().'</b>';
                echo '&ensp;<a href="'.base_url("admin/category/update/" . $c->getID()).'" alt="edit">Sửa | </a>';
                echo '<a href="'.base_url("admin/category/delete/" . $c->getID()).'" alt="edit">Xóa</a>';
               }
               echo '</p>';
          }
      ?>
    </div>
  </div>
</div>