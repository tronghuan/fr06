<?php
    $breadcrumbs = $this->uri->uri_string();
    $breadcrumbs = explode('/', $breadcrumbs);
?>
<div class="Wraper Content-container">
  <div class="container">
    <div class="row">
      <div class='col-lg-9 col-md-12 col-sm-12'>
            <div class="breadcrumb">
                <ol class='breadcrumb'>
                    <?php
                        if (isset($breadcrumbs)) {
                            $i = 0;
                            $result = '';
                            $url_breadcum = base_url();
                            $disable_links = explode(',', $disable_links);
                            foreach ($breadcrumbs as $breadcrumb) {
                              $url_breadcum .= $i == 0 ? $breadcrumb : '/' . $breadcrumb;
                              if (in_array($breadcrumb, $disable_links)) continue;
                                $result .= '<li ';
                                    if (isset($nums) && $nums == $i)$result .= 'class="active"';
                                $result .=  '><a href="'.$url_breadcum.'">';
                                    $result .=  $breadcrumb;
                                $result .=  '</a></li>';
                                $i ++;
                            }
                            if ($i > 1)echo $result;
                        }
                    ?>
                </ol>
            </div>
            <div class="Main content">
                       <div class="col-lg-12"> <?php echo $content_for_layout; ?></div>
            </div>
        </div>
      <div class="col-lg-3 col-md-3">