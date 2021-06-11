$(document).ready(function(){
    $('.loader-container').css('display', 'flex');
    var web_id =  null;
  
    $('b[role="presentation"]').hide();
    $('.select2-arrow').append('<i class="fa fa-angle-down"></i>');

    $('#product-status').niceSelect();
    $('.currency-select').niceSelect();

    websiteSelect2('.pick_website_select');
    websiteSelect2('.website_select');

    //Show Product 
    debugger;
    ajaxSearchingProduct(null);

    // Input Image Processing When Image Is NULL -- Image Update
    $(".input-image").on("click", function(e){
      var id = $(this).find('input').attr('id');
      $('#' + id)[0].click();  

      $('#' + id).change(function(e) {
      var filename = exGetImg(e.target, '#' + id);
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
    }); //End 


    $('#search_button').unbind().on('click', function(){
        var data = {
            "web_id": $('.pick_website_select').select2('val'),
            "term"  : $('#searching').val().trim(),
            "product_active": $('#product-status').val() == '1' || $('#product-status').val() == '0'? $('#product-status').val() : null, 
        }
        $('.loader-container').css('display', 'flex');
        ajaxSearchingProduct(data);
    });

    $('#clear_button').unbind().on('click', function(){
      $('#searching').val('');
      $('.pick_website_select').empty();
      $('#product-status').val('#').niceSelect('update');
    });

    $('#modal-add').unbind().on('click', function(){
      var data = {
        "product_name": $('#add-title').val(),
        "product_description": $('#add-description').val(),
        "product_price": $('#add-price').val(),
        "product_currency": $('#Modal-add select.currency-select').val(),
        "product_image_path": $('#image_product_add').attr('src'),
        "web_id":  $('.website_select').select2('val')
      }
      if(data.product_name == ""  || data.product_name == null){
        showAlert('warning', "Tên Sản Phẩm Không Được Bỏ Trống");
      }
      else{
        if(data.web_id == "" || data.web_id == null){
          showAlert('warning', "Website Không Được Trống");
        }
        else{
          ajax(JSON.stringify(data), "../../../api/Controller/createProduct.php",
            createSuccess, createError, 'POST', 'JSON', false);
        }
      }
    });

});



//Funtion

var base_url = "../../../"

// Website function Select2
function formatRepoWebsite (repo) {
    if (repo.loading) {
      return repo.text;
    }
  
    var $container = $(
      "<div class='select2-result-website clearfix' id='result_website_"+repo.id+"'>" +
        "<div class='select2-result-website__icon'><img src='" + base_url + repo.image + "' /></div>" +
        "<div class='select2-result-website__meta'>" +
          "<div class='select2-result-website__title'></div>" +
          "<div class='select2-result-website__description'></div>" +
        "</div>" +
      "</div>"
    );
  
    $container.find(".select2-result-website__title").text(repo.text);
    $container.find(".select2-result-website__description").text(repo.description)
  
    return $container;
}
  
function formatRepoSelectionWebsite (state) {
    if (!state.id) {
      return state.text;
    }
    var $state = $(
      '<span id = "website_'+ state.id +'"><img class="img-flag" /> <span></span></span>'
    );
      
    var image = state.image != null ? state.image: checkdefault("data/web_icon/icon_default/default.png",state.title);
    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", base_url + image);
  
    return $state;
} //End Of Function Website Select2

function checkdefault(default_value, check_parameter){
    if(check_parameter == null || check_parameter == ""){
      return default_value;
    }
    return check_parameter;
}

function ajaxSearchingProduct(data){
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '../../../api/Controller/getAllProduct.php',
        data: JSON.stringify(data),
        async: false,
        success: function(data){
            if(data.code == 404){
                productError(data);
            }
            else{
                productSuccess(data);
            }
            
        },
        error: function(data){
            productError(data);
        }
    });
    $('.loader-container').css('display', 'none');
}

function productSuccess(data){
    html = "";
    stt = 0;
    data.forEach(function(value, key){
        action = '';

        if(value.product_name == null || value.product_name == ""){
            value.product_name = "<p style = 'color: red'>NULL</p>";
        }

        if(value.product_description == null || value.product_description == ""){
            value.product_description = "<p style = 'color: red'>NULL</p>";
        }

        if(value.product_price == null || value.product_price == ""){
            value.product_price = "<p style = 'color: red'>NULL</p>";
        }

        if(value.web_name == null || value.web_name == ""){
            value.web_name = "<p style = 'color: red'>NULL</p>";
        }

        if(value.product_active == 1){
          status = '<button style = "width: 100px;" id="product_show_'+ value.product_id +'" type="button" class="btn btn-success status_button">Đã Kích Hoạt</button>';
        }
        else{
          status = '<button style = "width: 100px;" id="product_hide_'+ value.product_id +'" type="button" class="btn btn-danger status_button">Đã Ẩn</button>';
        }

        action = `<button style = "margin-left: 10px; width: 60px;" 
                          web_id = `+value.web_id+` 
                          id = "info_product_`+ value.product_id +`" 
                          type="button" 
                          data-toggle="modal" data-target="#Modal"
                          class="btn btn-info">Chi Tiết</button>`;

        stt ++;
        html += `<tr>
                    <th scope="row">`+stt+`</th>
                    <td><div><p>`+ value.product_name  +`</p></div></td>
                    <td><div><p>`+ value.product_description +`</p></div></td>
                    <td><div><img style = 'width: 40px' src = '../../../`+ checkdefault("data/product_icon/default/product.png",value.product_image_path)
                    +`'></div></td>
                    <td><div><p>`+ value.product_price +`</p></div></td>
                    <td><div><p>`+ value.product_currency +`</p></div></td>
                    <td><div><p>`+ value.web_name +`</p></div></td>
                    <td><div><p>`+ status +`</p></div></td>
                    <td><div><p>`+ action +`</p></div> </td>
                </tr>`
    });
    $('tbody').html(html).ready(function(){
      IActiveButton();
      $('.btn-info').unbind().click(function(){
        web_id = $(this).attr('web_id');
        product_id = $(this).attr('id').split('_')[2];
        loadModal(product_id, web_id);

        $('#modal-update').unbind().click(function(){
          data = {
            "web_id": $('.website_select').select2('val'),
            "product_id": product_id,
            "product_name": $('#update-title').val(),
            "product_description": $('#update-description').val(),
            "product_price": $('#update-price').val(),
            "product_currency": $('#Modal select.currency-select').val(),
            "product_image_path": $('#image_product_update').attr('src')
          }

          if(data.product_name == ""  || data.product_name == null){
            showAlert('warning', "Tên Sản Phẩm Không Được Bỏ Trống");
          }
          else{
            if(data.web_id == "" || data.web_id == null){
              showAlert('warning', "Website Không Được Trống");
            }
            else{
              $('.loader-container').css('display', 'flex');
              ajax(JSON.stringify(data), 
                  "../../../api/Controller/updateProduct.php",
                  updateSuccess, updateError, 'POST', 'JSON', false);
              $('.loader-container').css('display', 'none');
            }
          }
          
        });
      });
    });
    $('.loader-container').css('display', 'none');
}

function productError(data){
    html = `<tr>
                <td colspan = 6 style="
                text-align: center;
                font-size: 20px;
                color: red;
                "> 
                NOT FOUND</td>
            </tr>`;
    $('tbody').html(html);
}

function IActiveButton(){
  $('.status_button').click(function(){
    element = $(this).attr('id');
    id = element.split("_")[2];
    type = element.split("_")[1] == 'show'? 0:1;

    $('.loader-container').css('display', 'flex');
    data = {
      "product_id": id,
      "product_active": type
    }

    $.ajax({
      type: 'POST',
      dataType: 'JSON',
      data: JSON.stringify(data),
      async: false,
      url: "../../../api/Controller/ActiveInactiveProduct.php",
      success: function(data){
        if(data.code == 200){
          showAlert('success', data.message);
          
        }
        else{
          showAlert('error',data.code+": " +data.message);
        }
      },
      error: function(request, status, error){
        showAlert(status, error);
      }
    });

    ajaxSearchingProduct(null);
  });
}

function showAlert(type, message){
  $('.alert-message').css('display', 'block');
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
  setTimeout(function(){ $('.alert').removeClass('show'); 
  $('.alert-message').css('display', 'none');}, 3000);

  $('.alert button.close').on('click', function(){
    $('.alert').removeClass('show');
    $('.alert-message').css('display', 'none');
  });
}

function websiteSelect2(element){
  $(element).select2({
    ajax: { 
      url: "../../../api/Controller/searchTerm.php",
      type: "POST",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        if(params.term == null){
          var obj = {
            "term": ""
          } 
        }else{
          var obj = {
          "term": params.term.trim()
          } 
        }
        
        return JSON.stringify(obj);
      },
      processResults: function (data, params) {
        if(data.code == 404){
          return;
        }
        return {
            results: $.map(data, function (item) {
                if(item == 404){
                  return;
                }
                return {
                    text: item.web_name,
                    id: item.web_id,
                    image: checkdefault("data/web_icon/icon_default/default.png",item.web_icon),
                    description: item.web_description,
                    data: item
                };
            })
        };
      },
      cache: false
    },
    placeholder: 'Search for a Website',
    minimumInputLength: 0,
    templateResult: formatRepoWebsite,
    templateSelection: formatRepoSelectionWebsite
  });
}

function clearModal(){
  $('.title').val("");
  $('.description').val("");
  $('.price').val("");
  $('select.currency-select').val("VND").niceSelect('update');
  $('.website_select').empty();
  $('.input-image img').attr('src', '#');
  $('.input-image img').css('display', 'none');
  $('.input-image img').siblings('svg').css('display', 'block');
}

function loadModal(product_id, web_id){
  product_data = loadProductByID(product_id);
  web_data = loadWebsiteByID(web_id);
  if(product_data == '' || web_data == ''){
    showAlert('error', "Cannot Get Data Of Product");
  }
  else{
    $('.modal-title').text('Chỉnh Sửa Sản Phẩm '+product_data.product_name);
    $('#update-title').val(product_data.product_name);
    $('#update-description').val(product_data.product_description);
    $('#update-price').val(product_data.product_price);
    $('#Modal select.currency-select').val(product_data.product_currency).niceSelect('update');
    option = "<option selected value = '"+web_data.web_id+"' title = '"+web_data.web_icon+"' >"+web_data.web_name+"</option>";
    setSelect2Data('.website_select', option, product_data);
    setImageData(product_data.product_image_path, '#image_product_update');
  }
}

function loadProductByID(product_id){
  result = '';
  data = {
    "product_id":product_id
  }
  $.ajax({
    data: JSON.stringify(data),
    dataType: 'JSON',
    type: 'POST',
    url: "../../../api/Controller/getProductByIDAll.php",
    async: false,
    success:function(data){
      result = data;
    },
    error:function(data){
      showAlert('error', data.responseText);
    },
  })

  return result;
}

function loadWebsiteByID(web_id){
  result = '';
  data = {
    "web_id":web_id
  }
  $.ajax({
    data: JSON.stringify(data),
    dataType: 'JSON',
    type: 'POST',
    url: "../../../api/Controller/getWebsiteByID.php",
    async: false,
    success:function(data){
      result = data;
    },
    error:function(data){
      showAlert('error', data.responseText);
    },
  })

  return result;
}


// Image Function
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

function updateSuccess(data){
  if(data.code == 200){
    showAlert('success', data.message);
    $('#modal-update-close').click();
    clearModal();
    ajaxSearchingProduct(null);
  }
  else{
    showAlert('error', data.message);
  }
}

function updateError(data){
  showAlert('error', data.responseText);
}

function createSuccess(data){
  if(data.code == 200){
    showAlert('success', data.message);
    $('#modal-add-close').click();
    clearModal();
    ajaxSearchingProduct(null);
  }
  else{
    showAlert('error', data.message);
  }
}

function createError(data){
  showAlert('error', data.responseText);
}
