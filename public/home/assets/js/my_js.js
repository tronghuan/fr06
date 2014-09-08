function ajax_user_send(address, keys, values, base_url)
{
    $(document).ready(function (){
        var n = keys.length;
        $.ajax ({
            type : 'POST',
            dataType: 'json',
            url: address,
            data: {
                key : keys,
                value : values,
                ajax : true,
            },
            success : function(data) {                
                /*
                 * replace old datas table
                 */
                var listUsers = data.listUsers;
                $('#i-love-u tr').remove();
                var stt = data.i;
                $.each(listUsers, function (k,  v) {
                    var html = '<tr>';
                    html += '<td>' + (stt ++)+ '</td>';
                    html += '<td>' + v.user_name + '</td>';
                    html += '<td>' + v.user_fullName + '</td>';
                    html += '<td>' + v.user_email + '</td>';
                    html += '<td>' + v.user_address + '</td>';
                    html += '<td>' + v.user_phone + '</td>';
                    if (v.user_gender == '1') {
                        html += '<td>Nam</td>';        
                    } else if (v.user_gender == '2') {
                        html += '<td>Nữ</td>';
                    } else html += '<td>'+v.user_gender+'</td>';
                    html += '<td><a href="' + base_url+ 'admin/user/edit/'+v.user_id+'">thay đổi</a></td>';
                    html += '<td><a href="' + base_url+ 'admin/user/delete/'+v.user_id+'">xóa</a></td>';
                    html += '</tr>';
                    $('#i-love-u').append(html);
                });
                
                /*
                 * replace page links 
                 */
                $('ul.pagination li').remove();
                $('ul.pagination').append(data.page_links);                
            },
            error : function (data){
                alert(data.listUsers.length);
                return false;
            },
            });
        });
}

function ajax_product_send(address, keys, values, base_url)
{
    $(document).ready(function (){
        var n = keys.length;
        $.ajax ({
            type : 'POST',
            dataType: 'json',
            url: address,
            data: {
                key : keys,
                value : values,
                ajax : true,
            },
            success : function(data) {                
                /*
                 * replace old datas table
                 */
                var listProducts = data.listProducts;
                $('#i-love-u tr').remove();
                var stt = (data.i + 1);
                $.each(listProducts, function (k,  v) {
                    var html = '<tr>';
                    html += '<td>' + (stt ++)+ '</td>';
                    html += '<td>' + v.product_mainImageId + '</td>';
                    html += '<td>' + v.product_name + '</td>';
                    html += '<td>' + v.product_date + '</td>';
                    html += '<td>' + v.product_price + '</td>';
                    html += '<td>' + v.product_sale  + '</td>';
                    html += '<td>' + v.brand_id + '</td>';
                    html += '<td>' + v.country_id + '</td>';
                    html += '<td><a href="' + base_url+ 'admin/product/edit/'+v.product_id+'">thay đổi</a></td>';
                    html += '<td><a href="' + base_url+ 'admin/product/delete/'+v.product_id+'">xóa</a></td>';
                    html += '</tr>';
                    $('#i-love-u').append(html);
                });
                
                /*
                 * replace page links 
                 */
                $('ul.pagination li').remove();
                $('ul.pagination').append(data.links);
            },
            error : function (data){
                alert(data.listUsers.length);
                return false;
            },
            });
        });
}
function required(name, field)
  {
      var result =[];
      result['status'] = true;
      result['error'] = '';
      if (name == null || name == '')
      {
          result['status'] = false;
          result['error'] = field + ' must not be empty!';
      }
      return result;
  }
function validate_email(name, field)
{
    var atpos = name.indexOf("@");
    var dotpos = name.indexOf('.');
    var result = [];
    result['status'] = true;
    result['error'] = '';
    if (atpos < 1 || dotpos < atpos+2 || dotpos+ 2 >= name.length) {
        result['status'] = false;
        result['error'] = field + ' is not valid an email';
     }
    return result;
}
function product_get_captcha(id,address)
{
    $(document).ready(function (){
       $.ajax({
          type: 'POST',
          datatype: 'json',
          url: address,
          data: {
              ajax: true,
          },
          success: function (data){
              data = JSON.parse(data);
              $('#' +id + ' img').remove();
              $('#' +id).append(data);
          },
          error: function (data) {
              alert('some thing error');
          }
       }); 
    });
}
function validate_captcha(word, address)
{
    alert('a');
}
function rating(a) 
 {       
     $(document).ready(function (){
      rate = a;
      $('.rating span.star').each(function (index){
       var filled = $(this).hasClass('filled');
       if (filled) return false;
       var class_name = $(this).hasClass('star');                            
       var id = $(this).attr('id');
       var id_array = id.split('_');
       var id = id_array[1];
       if (id <= a && class_name === true) {
         $(this).removeClass('haft-star');
         $(this).removeClass('haft-star-near');
         $(this).removeClass('haft-star-far');            
         $(this).addClass('filler');                              
       }else if (id > a) {                          
         $(this).removeClass('filler');
         $(this).removeClass('haft-star');
         $(this).removeClass('haft-star-near');
         $(this).removeClass('haft-star-far');
       }         
     });
     });
 }
 /** make a list product home by sort **/
 function ajax_product_home_sort(order_name, order_type,address,id_target, base_address)
 {
    var action = 'sort';
    $(document).ready(function () {
       $.ajax({           
            type: 'POST',
            url: address,
            datatype: 'json',
            data: {
                btn_order: true,
                ajax: true,
                order_name: order_name,
                order_type: order_type,
            },
            success: function (json){
                json = JSON.parse(json);
                console.log(json);
                console.log(json.length);
                var products = json['product'];
                $(id_target).html('&nbsp;');
                $.each(products, function (k, v) {
                    tmp = add_product(base_address, v.product_id,v.product_name, v.product_price,v.product_sale, v.sale_price, v.product_mainImageId);
                    $(id_target).append(tmp);
                });
                if (action != 'sort'){
                    $('ul.pagination').remove();                
                    $('#pagination-div-wrapp').append(json['links']);
                }
            },
            error: function ()
            {
                alert('error while make a connect to server');
            }
        }); 
    });
 }
 function add_product(base_address,product_id, product_name, product_price, product_sale, sale_price, product_mainImage)
 {
    var result = '';
    var url = base_address + 'home/product/detail/'+ product_id + '/' + product_name.replace(' ', '-');
    result += '<div class="item col-lg-3 col-sm-12">';
        result += '<div class="row item-row">';
            result += '<div class="product_info col-lg-12 col-sm-4">';
                result += '<a href="'+url+'" title="'+product_name+'" class="product-image">';
                    result += product_mainImage;
                result += '</a>';
            result += '</div>';
            result += '<div class="product-shop col-lg-12 col-sm-8">';
                result += '<h2 class="product-name"><a href="'+ url+'" title="'+product_name+'">'+ product_name + '</a></h2>';
                result += '<div class="price-box">';
                       result += '<span class="regular-price" id="product-price-1">';
                            result += '<span class="price">';
                                result += sale_price;
                       result += '</span>';
                result += '</div>';
                  result += '<div class="actions">';
                    result += '<button type="button" title="Add to Cart" class="button btn-cart" onclick=""><span><span>Add to Cart</span></span></button>';
                        result += '<ul class="add-to-links">';
                            result += '<li><a data-original-title="Add to Wishlist" href="" rel="tooltip" class="link-wishlist">Add to Wishlist</a></li>';
                            result += '<li><span class="separator">|</span> <a data-original-title="Add to Compare " href="" rel="tooltip" class="link-compare ">Add to Compare</a></li>';
                        result += '</ul>';
                  result += '</div>';
            result += '</div>';
        result += '</div>';
    result += '</div>';
    return result;
 }
function ajax_get_product_content(pos_offset,address,id_target, base_address) {
    var action = 'ajax_pagination';
    $(document).ready(function () {
        $.ajax({           
            type: 'POST',
            url: address,
            datatype: 'json',
            data: {
                ajax: true,
                pos_offset: pos_offset,
                action: 'ajax_pagination',
            },
            success: function (json){
                json = JSON.parse(json);
                console.log(json);
                console.log(json.length);
                var products = json['product'];
                $(id_target).html('&nbsp;');
                $.each(products, function (k, v) {
                    console.log('ok');
                    tmp = add_product(base_address, v.product_id,v.product_name, v.product_price,v.product_sale, v.sale_price, v.product_mainImageId);
                    $(id_target).append(tmp);
                });
                if (action != 'search'){
                    $('ul.pagination').html('');                
                    $('ul.pagination').html(json['links']);
                }
            },
            error: function ()
            {
                alert('error while make a connect to server');
            }
           }); 
       });
}