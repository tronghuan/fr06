<?php
    $breadcrumbs = $this->uri->uri_string();
    $breadcrumbs = explode('/', $breadcrumbs);
?>
<div class='breadcrumb col-lg-9 col-md-12 col-sm-12'>
    <ol class='breadcrumb'>
        <?php
            if (isset($breadcrumbs)) {
                $i = 0;                
                $disable_links = $this->layout->get_disable_links();
                var_dump($disable_links);
                foreach ($breadcrumbs as $breadcrumb) {
                    if  (in_array ($breadcrumb, $disable_links)) continue;
                    echo '<li ';
                        if (isset($nums) && $nums == $i)echo 'class="active"';                        
                    echo '>';
                        echo $breadcrumb;
                    echo '</li>';
                }
            }
        ?>
    </ol>
</div>