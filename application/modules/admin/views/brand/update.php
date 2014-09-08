<?php
    if (isset($single_brand))
    {
        $brand = $single_brand[0];
    }
    if((isset($brand) && $brand != NULL) || $action="insert" || $action="inserted") {
?>
<form method="POST" action="<?php if (! isset($action)){echo base_url();?>admin/brand/edit/<?php echo $brand['brand_id'];} else { echo base_url();?>admin/brand/insert" <?php }?>>
       <label>Brand name:</label>
            <input type="text" name="txt_name" class="form-control"value="<?php if ((isset($action) && $action != 'insert') || ! isset($action))echo $brand['brand_name']; ?>" />
        <label>Describe:</label>
        <textarea name="txt_desc" class="form-control" >
            <?php if (isset($action) && $action != 'insert' || ! isset($action))echo $brand['brand_name']; ?>
        </textarea>
            <input type="submit"  name="submit" value="Update" class="btn btn-success" />
</form>
<?php } ?>