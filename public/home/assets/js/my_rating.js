function is_array(what)
{
    return Object.prototype.toString.call(what) === '[object Array]';
}
function add_comment(id_target, title,comment_id,name, content, rate, time)
{
  var html;
  html = '<div class="comment_item">';
  html += '<div class="width_comment_item width_common">';
      html += "<div class='comment_title'>";
      html += '<span><p><small><b>'+ title +'</b></small></p></span>'
      html += '<span>';
              html += rate;
      html += '</span>';
      html += '</div>';
      html += '<div class="width_common">';
          html += '<p class="full_content">' + content+ '</p>';
          html += '<div class="user_status width_common">';
              html += '<span class="left txt_666 txt_11">';
                  html += '<a class="nickname txt_666" href="javascript:;"><b>' + name + '</b></a> - 11 giờ trước';
              html += '</span>';
              html += '<p class="txt_666 txt_11 right block_like_web">';
                  html += '<a id="' + comment_id + '" class="txt_666 txt_11 link_thich" href="javascript:;" rel="8464299">';
                    html += '<span id="like_number_'+ '">';                        
                    html += '</span><span class="like_text">&nbsp;Thích&nbsp;</span>';
                    html += '<span class="icon_portal icon_like glyphicon glyphicon-thumbs-up">&nbsp;</span>'
                  html += '</a>';
                                          html += '</p>';
                  html += '</div>';
              html += '</div>';
              html += '<div class="sub_comment">';
              html += '</div>';
              html += '<hr />';
          html += '</div>';
          html += '<div class="clear">&nbsp;';
          html += '</div>';
      html += '</div>';
    $(document).ready(function () {
        $(id_target).prepend(html);
        });
}    
function product_rating(a,data, address)
{
    $(document).ready(function (e) {
        var cur_class = $('#' + a).hasClass('filled');
        if (cur_class == true) {
          return false;
        }
        var my_data = data;
        console.log(my_data);
        $.ajax({
            url : address,
            data : {
                name: data['name'],
                email: data['email'],
                product_id: data['product_id'],
                title: data['title'],
                captcha: data['captcha'],
                review: data['review'],
                rated: a,
                ajax: true,
            },
            type: 'POST',
            datatype: 'json',
            success: function (json) {                
                json = JSON.parse(json);                
                if (json['status'] === 1){
                    var number = json['total'] / json['nums'];
                    number = number.toFixed(1) * 1;
                    var message = 'Scored ' + number + ' over ' + json['nums'];
                    $('.rate_widget .product_rate').remove();$('.rate_widget').prepend(json['product']);
                    $('.rate_widget_dynamic .customer_rate').remove();$('.rate_widget_dynamic').append(json['customer']);
                    $('.message_number').remove;$('.message_number').html("(" + json['nums'] + ")");
                    $('.message_rating').remove;$('.message_rating').html(message);
                    $('.customer_input').each(function(index) {
                        $(this).val('');
                    });
                    add_comment('#comment_items', data['title'],json['comment_id'], data['name'],data['review'], json['rate'],0);                                       
                    return true;
                }else {
                    $('#customer_captcha').after('<div class="col-lg-12 col-lg-offset-1 customer-message" style="color: orange;">' + 're type again captcha' + '</div>');
                    return false;
                }
            },
            error: function(json) {
                alert('some error');
                return false;
            }
            });
    });
}