<style>
    select > option {
        height : 36px;
    }
</style>
<div class="contanier">
    <div class="row col-lg-5">
        <form role="form" method="post" action="<?php echo base_url();?>admin/category/add">
            <fieldset>
                <legend>Thêm category</legend>
                <label for="category_name">Category name : </label>
                <input type="text" name="category_name" class="form-control"/>
                <label for="category_parentID">Category parent :</label>
                <select name="category_parentID" class="form-control">
                    <option value= '0'>default category</option>
                <?php
                    foreach ($cats as $c)
                    {
                        echo '<option value="'.$c->getID().'" >';
                        for ($i = 0; $i < $c->getLevel(); $i ++) echo '&ensp;&emsp;';
                         echo $c->getName().'</option>';
                    }
                ?>
                </select>
                <br />
                <label for="btnok">Save</label>
                <input type="submit" class="btn btn-success" name="btnok" value="Save"/>
            </fieldset>
        </form>
    </div>
    <br />
    <div class="row " >
        <span>
            <?php if (isset($success)) {?> <p class="alert alert-info"> <?php if ($success)echo $success;?> </p> <?php }?>
            <?php if (isset($errors)) {
                foreach ($errors as $error) {
                    ?> <p class="alert alert-warning "> <?php if($error)echo $error;?> </p> <?php }
                }?>
        </span>
    </div>    
</div>
