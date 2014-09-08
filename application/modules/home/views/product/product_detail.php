<?php
if (isset($product) && !empty($product)) {
    $product = $product[0];
    ?>
    <script>
        var rate = 0; function rating(a) {
        $(document).ready(function() {
        rate = a;
                $('.customer_rate span.star').each(function(index) {
        var filled = $(this).hasClass('filled');
                if (filled)
                return false;
                var class_name = $(this).hasClass('star');
                var id = $(this).attr('id');
                var id_array = id.split('_');
                var id = id_array[1]; if (id <= a && class_name === true) {
        $(this).removeClass('haft-star');
                $(this).removeClass('haft-star-near');
                $(this).removeClass('haft-star-far');
                $(this).addClass('filler');
        } else if (id > a) {
        $(this).removeClass('filler'); $(this).removeClass('haft-star');
                $(this).removeClass('haft-star-near');
                $(this).removeClass('haft-star-far');
        }
        });
                });
                }
        function refresh_captcha() {
        var address = "<?php echo base_url("index.php/home/product/get_captcha") ?>";
                var id = 'captcha-container';
                product_get_captcha(id, address);
                $(document).ready(function() {
        //$('.for_test').remove; $('.for_test').append('Gửi ý kiến của bạn ( for
        //test :' + "<?php $this->session->userdata('captcha'); ?>" + ' )');
        });
                }
        function review() {
        $(document).ready(function(event) {
        $('.customer-message').remove();
                var status = true; var data = [];
                var result = [];
                var address = "<?php echo base_url(); ?>index.php/home/product/rating";
                data['name'] = $('#customer_name').val();
                data['email'] = $('#customer_email').val();
                data['title'] = $('#customer_title').val();
                data['review'] = $('#customer_review').val();
                data['captcha'] = $('#customer_captcha').val();
                data['product_id'] = $('#product_id').val();
                // validate name
                var validate = [];
                var validated_email = [];
                validate['name'] = required(data['name'], 'Truong ten');
                validate['email'] = required(data['email'], 'Email'); validate['title'] =
                required(data['title'], 'Title');
                validate['review'] = required(data['review'], 'Review');
                validate['captcha'] = required(data['captcha'], 'Captcha');
                validated_email['email'] = validate_email(data['email'], 'Email');
                status = status && validate['name']['status'] && validate['email']['status'] && validate['title']['status'] && validate['review']['status'] && validate['captcha']['status'] && rate > 0 && validated_email['email']['status'];
                // show alert warning
                if (validate['name']['status'] === false)
                $('#customer_name').after('<div class="col-lg-12 col-lg-offset-1 customer-message" style="color: orange;">' + validate['name']['error'] + '</div>');
                if (validate['email']['status'] === false)
                $('#customer_email').after('<div class="col-lg-12 col-lg-offset-1 customer-message" style="color: orange;">' + validate['email']['error'] + '</div>');
                if (validate['title']['status'] === false)
                $('#customer_title').after('<div class="col-lg-12 col-lg-offset-1 customer - message" style="color: orange; ">' + validate['title']['error'] + '</div>');
                if (validate['review']['status'] === false)
                $('#customer_review').after('<div class="col-lg-12 col-lg-offset-1 customer - message" style="color: orange; ">' + validate['review']['error'] + '</div>');
                if (validate['captcha']['status'] === false)
                $('#customer_captcha').after('<div class="col-lg-12 col-lg-offset-1 customer - message" style="color: orange; ">' + validate['captcha']['error'] + '</div>');
                if (validated_email['email']['status'] === false)
                $('#customer_email').after('<div class="col-lg-12 col-lg-offset-1 customer - message" style="color: orange; ">' + validated_email['email']['error'] + '</div>');
                if (rate <= 0)
                $('.customer_rate').after('<div class="col-lg-12 col-lg-offset-8 customer - message" style="color: orange; ">' + 'you forgot rate :)' + '</div>');
                console.log(data['name']);
                if (status) {
                  product_rating(rate, data, address); refresh_captcha();
                } else {
                  refresh_captcha();
                }
        });
      }
    </script> <div class="wrapper" id="product-wraper">
        <div class="page-title">
            <span><h3><?php echo $product['product_name']; ?></h3></span>
        </div> <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="wrapper"><div class="main-image">
    <?php echo $imgs['main']; ?>
                    </div>
                </div> <div>

                </div>
            </div> <!-- end image div -->

            <!-- start product detail infor --> <div class="col-lg-6 col-md-5
                                                     col-sm-12">
                <div class="wrapper">
                    <h3>Name header tag</h3> <div class="col-lg-6 col-md-8
                                                  col-sm-12" style="text-align:center;">
                                                    <!--<input id="input-1" class="rating" data-min="0"
                                                    data-max="5" data-step="1">-->
                        <div id="r1" class="rate_widget" style="color: orange;">
                                    <?php echo $rating['product']; ?> <p style="display:
                               inline;"><span class="message_number">(<?php echo
                                    $rating['nums'];
                                    ?>)</span></p> <p
                                class="message_rating">Scored <?php
                                $total = $rating['nums'] > 0 ? round($rating['total'] /
                                                $rating['nums'], 1) : 0;
                                echo $total . ' over ' .
                                $rating['nums'] . ' rated'
                                ?></p>
                        </div>
                    </div> <div>
                        <span><p>product desc</p></span> <span><p>Price:
                            </p></span> <span><p>But: , take xx % sale</span> <div
                            class="col-lg-6">
                            <h4>product description</h4> <span class="">
                                Canon WS1400H Minidesk Calculator, 14-Digit LCD
                                - Large key tops help ensure accurate entries.
                                Conversion key roll-over system for quick entry.
                                0i0 and 000 keys for faster calculations. Dual
                                solar/battery power for operation in any
                                lighting. Auto power off.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="panel panel-default panel-info"
                 id="customer-review-container">
                <div class="panel-heading">Nhận xét về sản phẩm</div>
                <div class="panel panel-default panel-waring">
                    <div class="panel-body">
                        <div class="wrapper">
                            <form class="form-inline" action="post"
                                  id="customer_form_review">
                                <input type="hidden" name="product_id"
                                       value="<?php echo $product['product_id'];
                                ?>" id="product_id"/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="cusomer_name"
                                               class="control-label" style="width:18%;"
                                               >Name</label> <input type="text"
                                               name="customer_name" class="form-control
                                               input-sm customer_input"
                                               id="customer_name"style="width:80%;"/><br/>
                                    </div> <div class="col-lg-6">
                                        <label for="customer_email"
                                               class="control-label"
                                               style="width:18%;">Email</label> <input
                                               type="text" name="customer_email"
                                               id="customer_email" class="form-control
                                               input-sm customer_input"
                                               style="width:80%;"/>
                                    </div> <br /><br /> <div class="col-lg-8">
                                        <label for="customer_title"
                                               class="control-label"
                                               style="width:18%;">Review title</label>
                                        <input type="text" name="customer_title"
                                               id="customer_title" class="form-control
                                               input-sm customer_input"
                                               style="width:80%;">
                                    </div> <div class="col-lg-4 col-sm-12
                                                rate_widget_dynamic">
                                        <label class="control-label">Your
                                            rating</label> <?php echo
                                $rating['customer'];
                                ?>
                                    </div> <div class="col-lg-8">
                                        <label for="customer_review"
                                               class="control-label"
                                               style="width:18%;">Review</label>
                                        <textarea name="customer_review"
                                                  id="customer_review" class="form-control
                                                  input-sm customer_input" cols="50"
                                                  rows="7" style="width: 80%"></textarea>
                                    </div> <div class="col-lg-4 col-sm-12">
                                        <hr /> <div class="col-lg-12"
                                                    id="captcha-container">
                                            <label for="catcha"
                                                   class="control-label">captcha
                                                code</label> <?php echo $captcha;
                                ?><a id="renew" class="btn
                                               btn-default input-sm" style="color:
                                               red;" onclick="refresh_captcha();"
                                               ><span class="glyphicon
                                                   glyphicon-refresh"></span></a>
                                        </div> <div class="col-lg-12">
                                            <input type="text"
                                                   class="form-control input-sm
                                                   customer_input"
                                                   name="customer_captcha"
                                                   id="customer_captcha" style="width:
                                                   80%; padding: " placeholder="type
                                                   captcha here .."/> <hr />
                                        </div> <label
                                            class="control-label">Save</label> <a
                                            name="revieư" class="btn btn-default
                                            input-sm" onclick="review();">save</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <div class="panel-heading"><span
                            class="for_test">Gửi ý kiến của bạn<?php echo '(for test
                        captcha:
                        ' . $this->session->userdata('captcha') . ')'; ?></span></div>
                </div>

                <div class="panel-body">
                    <div class="wrapper-comment wrapper">
                                                    <?php foreach ($comments as $comment) { ?>
                            <div class="comment_item">
                                <div class="width_comment_item width_common"
                                     id="comment_items">
                                    <div class='comment_title'>
                                        <span><p><small><b><?php echo
                                                        $comment['comment_title'];
                                                        ?></b></small></p></span>
                                        <span>
                                            <?php
                                            $rate = new
                                                    Rating($comment['comment_rate']);
                                            $comment_rate = $rate->create_rate($comment['comment_rate'], 'product_rate', 'filled');
                                            ?>
        <?php echo $comment_rate; ?>
                                        </span> </div> <div class="width_common">
                                        <p class="full_content"><?php echo
        $comment['comment_content'];
        ?></p> <div
                                            class="user_status width_common">
                                            <span class="left txt_666 txt_11">
                                                <a class="nickname txt_666"
                                                   href="javascript:;"><b><?php
                                                   echo $comment['comment_name'];
                                                   ?></b></a> - 11 giờ trước
                                            </span> <p class="txt_666 txt_11
                                                       right block_like_web">
                                                <a id="<?php echo
                                                   $comment['comment_id'];
        ?>"
                                                   class="txt_666 txt_11
                                                   link_thich" href="javascript:;"
                                                   rel="8464299">
                                                    <span id="like_number_<?php
                                                  echo
                                                  $comment['comment_id'];
                                                  ?>">
        <?php
        if
        ($comment['comment_like'] >
                0)
            echo
            $comment['comment_like'];
        ?>
                                                    </span><span
                                                        class="like_text">&nbsp;Thích&nbsp;</span>
                                                    <span class="icon_portal
                                                          icon_like glyphicon
                                                          glyphicon-thumbs-up">&nbsp;</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div> <div class="sub_comment"> </div> <hr
                                        />
                                </div> <div class="clear">&nbsp; </div>
                            </div>
    <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } ?> <script>
            $(document).ready(function(){
              $('.link_thich').click(function(){
              var id = $(this).attr('id'); $.ajax({
              url: "<?php echo base_url(); ?>home/product/link_thich/" + id, type:
                      'post', datatype: 'json', data: {
                      id: id, ajax: true,
                      }, success: function (json) {
              json = JSON.parse(json); var status = json['status']; if (status
                      === 1) {
              // update number like
              $('.link_thich #like_number_' + id).remove;
                      console.log('.link_thich #like_number_' + id); if (json['number']
                      > 0) {
              $('.link_thich #like_number_' + id).html(json['number']);
              } else {
                $('.link_thich #like_number_' + id).html('');
              }
              var like;
              var disk_like;
              $('a#' + id + ' span').each (function (index) {
                like = $(this).hasClass('like_text');
                dis_like = $(this).hasClass('dis_like_text');
                console.log('a#' + id + '> span'); if (like == true || dis_like == true) {
                return false;
              }
              });
              console.log(like);
              if (like === true) {
                console.log('fine');
                $('a#' + id + ' span.icon_portal').remove();
                $('a#'+id + ' span.like_text').remove();
                $('a#'+id).append(' < span class = "dis_like_text" > & nbsp; bỏ thích & nbsp; < /span>');
                $('a#' + id).append('<span class="icon_portal icon_dis_like glyphicon glyphicon - thumbs - down">&nbsp;</span>');
              }
              if (dis_like === true) {
                console.log('not ok'); $('a#' + id + ' span.icon_portal').remove(); $('a#'+id + ' span.dis_like_text').remove();
                $('a#'+id).append(' < span class = "like_text" > & nbsp; thích & nbsp; < /span>');
               $('a#' + id).append('<span class="icon_portal icon_like glyphicon glyphicon - thumbs - up">&nbsp;</span>');
              }
            }
          }
        });
      });
    });
</script>