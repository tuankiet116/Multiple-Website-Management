$(document).ready(function(){
    url = window.location.href;
    debugger;
    url_split = url.split("detail.php?record_id=")[1];
    post_id = url_split.split("&web_id=")[0];
    web_id = url_split.split("&web_id=")[1];
    
    
    //Pick Product Select2
    $('.pick_product').select2({
        ajax: { 
        url: "../../../api/Controller/searchTermProductActive.php",
        type: "POST",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            if(params.term == null){
            var obj = {
                "term": "",
                "web_id": web_id
            } 
            }else{
            var obj = {
            "term": params.term.trim(),
            "web_id": web_id
            } 
            }
            
            return JSON.stringify(obj);
        },
        processResults: function (data, params) {
            if(data.code == 404){
            return null;
            }
            return {
                results: $.map(data, function (item) {
                    if(item == 404){
                    return null;
                    }
                    return {
                        text: item.product_name,
                        id: item.product_id,
                        image: checkdefault("data/product_icon/default/product.png",item.product_image_path),
                        data: item
                    };
                })
            };
        },
        cache: false
        },
        
        placeholder: 'Search For Product',
        minimumInputLength: 0,
        templateResult: formatRepoProduct,
        templateSelection: formatRepoSelectionProduct
    });

    // Input Image Processing When Image Is NULL
    $(".input-image").on("click", function(e){
        $('#input_image_post')[0].click();  

        $('#input_image_post').change(function(e) {
        var filename = exGetImg(e.target, '#input_image_post');
        });
    });

    $(".input-image-container i").on('click',function(e){
        var image_element = $(this).siblings('.input-image').find('img');
        var id_image = "#" + image_element.attr('id');
        $(id_image).attr('src', '#');
        $(id_image).css('display', 'none');
        $(id_image).siblings('svg').css('display', 'block');
    });

    $(".input-image img").hover(function(e){
        $(this).closest("div").siblings("i").css("display", "block");
    });

    $(".input-image img").mouseout(function(e){
        $(this).closest("div").siblings("i").css("display", "none");
    });

    $(".input-image-container i").hover(function(e){
        $(this).css("display", "block");
    });

    $(".input-image-container i").mouseout(function(e){
        $(this).css("display", "none");
    });

    data_getInfo =  {
        "post_id": post_id
    }

    //Call Ajax Set Information
    $.ajax({
        dataType: 'JSON',
        data: JSON.stringify(data_getInfo),
        type: 'POST',
        async: false,
        url: "../../../api/Controller/getPostByID.php",
        success: function(data){
            showInformation(data);
        },
        error: function (request, status, error){
            showAlert('error', error + request.responseText);
        }

    })
});

var base_url = "../../../";

function checkdefault(default_value, check_parameter){
    if(check_parameter == null || check_parameter == "undefined"){
      return default_value;
    }
    return check_parameter;
}

// Product function Select2
function formatRepoProduct (repo) {
    if (repo.loading) {
      return repo.text;
    }
  
    var $container = $(
      "<div class='select2-result-product clearfix' id='result_product_"+repo.id+"'>" +
        "<div class='select2-result-product__icon'><img src='" + base_url + repo.image + "' /></div>" +
        "<div class='select2-result-product__meta'>" +
          "<div class='select2-result-product__title'></div>" +
          "<div class='select2-result-product__description'></div>" +
        "</div>" +
      "</div>"
    );
  
    $container.find(".select2-result-product__title").text(repo.text);
    $container.find(".select2-result-product__description").text(repo.description)
  
    return $container;
  }
  
  function formatRepoSelectionProduct (state) {
    if (!state.id) {
      return state.text;
    }
    var $state = $(
      '<span id = "product_'+ state.id +'"><img class="img-flag" /> <span></span></span>'
    );
    
    var image = state.image != null ? state.image: checkdefault("data/product_icon/default/product.png",state.title);
    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", base_url + image);
  
    return $state;
  } //End Of Function Product Select2

function ajax(data,  url, success, error, type = 'POST', dataType = 'JSON', async = true){
    $.ajax({
      type: type,
      data: data,
      async: async,
      dataType: dataType,
      url: url,
      success: success,
      error: error
    });
  }

//Make Information Image Get The FUCK Out Of Chrome Security And Change Data To Base64
var exGetImg = function(extag, element) {
    var file = extag.files[0]; //The first file of the selected file (as a fixed format)
    var readers = new FileReader(); //Create a new file reading object to change the path
    var filename;
    readers.readAsDataURL(file); //Convert the read file path to a url type    
    readers.onload = function() {//Call onload() method after conversion
            var imgsSrc = this.result; //After the image address is read out, the result result is DataURL //this.result is the URL path of the image conversion
            $(element).siblings('img').css('display', 'block');
            $(element).siblings('svg').css('display', 'none');
            $(element).siblings('img').attr('src', imgsSrc);    
    }
  }

  //Function Set Selected Data||Value For Select2 Language
function setSelect2Data(id ,data_select = "", data){
    $(id)
        .empty()
        .append(data_select);

    $(id).trigger('change');
}

function showInformation(data){
    $('#postTitle').val(checkdefault("", data.post_title));
    $('#postDescription').val(checkdefault("", data.post_description));
    $('#metaDescription').val(checkdefault("", data.meta_description));
    $('#postColorBackground').val(checkdefault("#ffffff", data.post_color_background));
    $('#rewriteName').val(checkdefault("", data.post_rewrite_name));
    product_data = getProductData(parseInt(data.product_id));
    if(product_data != 'NOT_FOUND'){
        option = "<option selected value = '"+product_data.product_id+"' title = '"+product_data.product_image+"' >"+product_data.product_name+"</option>";
        setSelect2Data('.pick_product', option, product_data);
    }
    else{
        showAlert('warning', 'Sản Phẩm Liên Kết Không Tồn Tại Hoặc Bị Vô Hiệu Hóa.');
    }

    setImageData(data.post_image_background, '#image_post');

    var content = data.content?data.content:"<h2 style = 'color: red'>NOT FOUND</h2>";
    CKEDITOR.instances.post_editor.setData(content);

    if(data.post_active == 1){
      html = `<input  id="submit_button" class="btn btn-primary  btn-lg " type="submit" value="Xác Nhận">
              <input id="hide_button" class="btn btn-danger  btn-lg " type="button" value="Ẩn Bài Viết">`;
      $('.button-container').html(html);
      submitButton();
    }
    else{
      html = `<input  id="submit_button" class="btn btn-primary  btn-lg " type="submit" value="Xác Nhận">
              <input id="show_button" class="btn btn-success  btn-lg " type="button" value="Hiển Thị">`;
      $('.button-container').html(html);
      submitButton();
    }
}

function getProductData(product_id){
    result = "";
    data = {
        "product_id": product_id
    }
    $.ajax({
        dataType: 'JSON',
        type: 'POST',
        data: JSON.stringify(data),
        async: false,
        url: "../../../api/Controller/getProductByID.php",
        success: function(data){
            result = data;
        },
        error: function(request, status, error){
            showAlert('error', "request: " + request + " -- status: " + status);
            result = "NOT_FOUND";
        }
    });

    return result;
}

//Set Image Data Within String If Max != 0 And Without String If Max = 0 --> Customize later
function setImageData(data, element, max=0){
    if(data && element){
      if(max != 0){
        var data_arr = data.split(",");
        if(data_arr.length<=7){
          var i = 1;
          data_arr.forEach(function(value, key){
            value = value.trim();
            key = key+1;
            $(element + key).attr("src", base_url + value);
            $(element).siblings('svg').css('display', 'none');
            $(element + key).css('display', 'block');
          });
        }
      }
      else{
        $(element).attr("src", base_url + data);
        $(element).siblings('svg').css('display', 'none');
        $(element).css('display', 'block');
      }
    }
  }

  function updatePostSuccess(data){
    if(data.code == 200){
      showAlert('success', data.message);
    }
    else{
      showAlert('warning', data.message);
    }
  }
  
  function updatePostError(data){
    showAlert('error', '<strong>ERROR: </strong>' + data.message||data.statusText );
  }
  
  function showAlert(type, message){
    $('.alert').removeClass("alert-success");
    $('.alert').removeClass("alert-warning");
    $('.alert').removeClass("alert-danger");
  
    switch(String(type)){
      case "success":
        $('.alert').addClass('alert-success');
        $('.alert-heading').html('<i class="fas fa-check-circle"></i> Success!');
        break;
      case "error":
        $('.alert').addClass('alert-danger');
        $('.alert-heading').html('<i class="fas fa-exclamation-circle"></i> Error!');
        break;
      case "warning":
        $('.alert').addClass('alert-warning');
        $('.alert-heading').html('<i class="fa fa-warning"></i> Warning!');
        break;
    }
  
    $('.alert .message').html(message);
    $('.alert').addClass('show');
    setTimeout(function(){ $('.alert').removeClass('show'); }, 3000);
  
    $('.alert button.close').on('click', function(){
      $('.alert').removeClass('show');
    });
  }

  function submitButton(){
    $('#submit_button').on('click', function(e){
        e.preventDefault();
        var content = CKEDITOR.instances.post_editor.getData();
        var data = {
        'post_title' : $('#postTitle').val(),
        'post_description': $('#postDescription').val(),
        'post_meta_description': $('#metaDescription').val(),
        'post_color_background': $('#postColorBackground').val(),
        'post_rewrite_name': $('#rewriteName').val(),
        'product_id': $('.pick_product').select2('val'),
        'post_image_background': $('#image_post').attr('src'),
        'content': content,
        'post_id' : post_id
        }

        var url = '../../../api/Controller/updatePost.php';

        $.ajax({
            type: 'POST',
            data: JSON.stringify(data),
            async: true,
            dataType: 'JSON',
            url: url,
            success: function(data){
                updatePostSuccess(data);
            },
            error: function (request, status, error) {
                updatePostError(request.responseText);
            }
        });
        //ajax(JSON.stringify(data), url, createPostSuccess, createPossError );
    });
  }

  function reload(){
    
  }