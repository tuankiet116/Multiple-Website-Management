var base_url = '../../../';
var post_type_id = [];
var post_type_id_update =[];
var web_id_create = '';
var cmp_id = '';
$(document).ready(function () {
  //Select2 For Pick Website
  $(".pick_website_select").select2({
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
        return {
            results: $.map(data, function (item) {
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

  $(".input-image-container i").on('click',function(e){
      var image_element = $(this).siblings('.input-image').find('img');
      var id_image = "#" + image_element.attr('id');
      $(id_image).attr('src', '#');
      $(id_image).css('display', 'none');
      $(id_image).siblings('svg').css('display', 'block');
  });

  $(".input-image-container i").hover(function(e){
      $(this).css("display", "block");
  });
  
  $(".input-image-container i").mouseout(function(e){
      $(this).css("display", "none");
  });

    // Input Image Processing When Image Is NULL
  $(".input-image").on("click", function(e){
    var id = $(this).attr("id");
    id = id.replace('input_image_', '');
    id = "input_" + id;
    $('#'+id)[0].click();  

    $('#'+id).change(function(e) {
      var filename = exGetImg(e.target, '#' + id);
      $('#submit_configuation').attr('disabled', false);
    });
  });

  $(".input-image img").hover(function(e){
    $(this).closest("div").siblings("i").css("display", "block");
  });

  $(".input-image img").mouseout(function(e){
    $(this).closest("div").siblings("i").css("display", "none");
  });

  $('.categories-add').on('click', function(){
    $('.categories-container-form').show();
  });

  $('.pick_website_select').on('change', function(){
    let web_id = $('.pick_website_select').select2('data')[0].id;
    web_id_create = web_id;
    getAllCate(web_id);
    
    getPostType(web_id);
    var select = document.querySelectorAll('.post_type_id');
    select.forEach((e)=>{
      e.onchange = function(){
        if(e.checked){
          post_type_id.push(e.value);
        }
      }
    })
    
  });

  $('#submit').click(function(){
      var cmp_name = $('#cmp_name').val();
      var cmp_rewrite_name = $('#cmp_rewrite_name').val();
      $('.loader-container').css('display', 'flex');
      if(cmp_name=="" || cmp_rewrite_name==""){
        $('.loader-container').css('display', 'none');
        showAlert('warning', '<p>vui những trường có dấu sao <span style="color: red">(*)</span></p>');
      }
      else{
        var data = dataCategory();
        $.ajax({
          url: base_url+'api/Controller/createCategories.php',
          method: 'POST',
          data: JSON.stringify(data),
          success: function(data){
            if(data.code == 200){
              $('.loader-container').css('display', 'none');
              showAlert('success', `<p>${data.message}</p>`);
              $('#formCategory')[0].reset();
              $('#image_background_homepage_1').attr('src', "#");
              $('#image_background_homepage_2').attr('src', "#");
              $('#image_background_homepage_3').attr('src', "#");
              $('#image_background_homepage_4').attr('src', "#");
              $('#image_background_homepage_5').attr('src', "#");

              $('#image_background_homepage_1').css('display', 'none');
              $('#image_background_homepage_2').css('display', 'none');
              $('#image_background_homepage_3').css('display', 'none');
              $('#image_background_homepage_4').css('display', 'none');
              $('#image_background_homepage_5').css('display', 'none');
              getAllCate(web_id_create);
            }
            else{
              $('.loader-container').css('display', 'none');
              showAlert('error', `<p>${data.message}</p>`);
            }
          },
        });
        
      }
    return false;
  })

  $('.overlay').click(function(){
    $('.modal-update').css("display", "none");
    $('body').removeAttr('style');
  });

  $('#submit_update').click(function(){
    var dataUpdate = updateDataCategory();
    $('.loader-container').css('display', 'flex');
    $.ajax({
      url: base_url+'api/Controller/updateCategories.php',
      method: "POST",
      data: JSON.stringify(dataUpdate),
      success: function(data){
        if(data.code == 200){
          $('.loader-container').css('display', 'none');
          showAlert('success', `<p>${data.message}</p>`);
          $('.modal-update').css("display", "none");
          $('body').removeAttr('style');
          getAllCate(web_id_create);
        }
        else{
          showAlert('error', `<p>${data.message}</p>`);
        }
      },
      error: function(data){
        console.log(data.responeText);
      }
      
    })
    return false;
  });

});

function getCateById(data){
  $.ajax({
    url: base_url+'api/Controller/getCategoriesByID.php',
    method: 'POST',
    data: JSON.stringify(data),
    success: function(data){
      renderFormUpdate(data);

    }
  })
}

function getPostType(web_id){
  var data ={
    "web_id": web_id
  }
  $.ajax({
      url: base_url + 'api/Controller/getPostType.php',
      method: "POST",
      data: JSON.stringify(data),
      async: false,
      success: function(data){
        if(data.code == 404){
          var err = `<p>${data.message}</p>`;
        }
        else{
          var pt = data.map((e)=>{
            return`
              <div class="post-item">
                <label for="2">${e.post_type_title}</label>
                <input type="checkbox" class="disable post_type_id" value="${e.post_type_id}">
              </div>
            `;
          });
        }
        $('.wrapper-post').html(pt ?? err);
      }
  });
}

function renderFormUpdate(data){
  $('#cmp_name_update').val(data.cmp_name);
  $('#cmp_rewrite_name_update').val(data.cmp_rewrite_name);
  $('#cmp_icon_update').val(data.cmp_icon);
  setImageData(data.cmp_background,'#image_background_homepage_', 1);
  $('#bgt_type_update').val(data.bgt_type).change();
  $('#cmp_meta_description_update').val(data.cmp_meta_description);
  if(data.cmp_active == "1"){
    $('#cmp_active_update').prop('checked', true);
  }
  else{
    $('#cmp_active_update').prop('checked', false);
  }
  var dataWebId = {
    "web_id": web_id_create
  }
  $.ajax({
    url: base_url+'api/Controller/getPostType.php',
    method: 'POST',
    async: false,
    data: JSON.stringify(dataWebId),
    success: function(dataPostType){
      if(dataPostType.code == 404){
        var err = `<p>Không có bài viết nào</p>`;
      }else{
        var render = dataPostType.map((e)=>{
          var a =``;
          a +=`<div class="post-item">
                  <label for="label_post_type_id">${e.post_type_title}</label>`;
          if(data.post_type_id.includes(e.post_type_id)){
                a+= `<input type="checkbox" class=" post_type_id" value="${e.post_type_id}" name="label_post_type_id" checked>`
          }
          else{
            a+= `<input type="checkbox" class=" post_type_id" value="${e.post_type_id}" name="label_post_type_id">`
          }
          a+= `</div>`
          return a;
        })
        $('.wrapper-post-update').html(render ?? err);

        var select = document.querySelectorAll('.post_type_id');
        select.forEach((e)=>{
          e.onchange = function(){
            if(e.checked){
              post_type_id_update.push(e.value);
            }
          }
        })
      } 
    }
  })
}

function updateDataCategory(){
  var cmp_name                    = $('#cmp_name_update').val();
  var cmp_rewrite_name            = $('#cmp_rewrite_name_update').val();
  var cmp_icon                    = $('#cmp_icon_update').val();
  var input_background_category_1 = $('#image_background_homepage_1_update').attr('src');
  var input_background_category_2 = $('#image_background_homepage_2_update').attr('src');
  var input_background_category_3 = $('#image_background_homepage_3_update').attr('src');
  var input_background_category_4 = $('#image_background_homepage_4_update').attr('src');
  var input_background_category_5 = $('#image_background_homepage_5_update').attr('src');
  var bgt_type                    = $('#bgt_type_update').val();
  var cmp_meta_description        = $('#cmp_meta_description_update').val();
  var cmp_active                  = $('#cmp_active_update').is(":checked") ? 1:0;
  
  data = {
    "cmp_name":                    cmp_name,
    "cmp_rewrite_name":            cmp_rewrite_name,
    "cmp_icon":                    cmp_icon,
    "image_background_category_1": input_background_category_1,
    "image_background_category_2": input_background_category_2,
    "image_background_category_3": input_background_category_3,
    "image_background_category_4": input_background_category_4,
    "image_background_category_5": input_background_category_5,
    "bgt_type":                    bgt_type,
    "cmp_meta_description":        cmp_meta_description,
    "cmp_active":                  cmp_active,
    "post_type_id":                post_type_id_update.join(","),
    "cmp_id":                      cmp_id,
    "web_id":                      web_id_create                      
  }
  return data;
}

function dataCategory(){
  var cmp_name                    = $('#cmp_name').val();
  var cmp_rewrite_name            = $('#cmp_rewrite_name').val();
  var cmp_icon                    = $('#cmp_icon').val();
  var input_background_category_1 = $('#image_background_homepage_1').attr('src');
  var input_background_category_2 = $('#image_background_homepage_2').attr('src');
  var input_background_category_3 = $('#image_background_homepage_3').attr('src');
  var input_background_category_4 = $('#image_background_homepage_4').attr('src');
  var input_background_category_5 = $('#image_background_homepage_5').attr('src');
  var bgt_type                    = $('#bgt_type').val();
  var cmp_meta_description        = $('#cmp_meta_description').val();
  var cmp_active                  = $('#cmp_active').is(":checked") ? 1:0;
  var cmp_parent_id               = $('#cmp_parent_id').val()==""? null: $('#cmp_parent_id').val();
  
  var data={
    "cmp_name":                    cmp_name,
    "cmp_rewrite_name":            cmp_rewrite_name,
    "cmp_icon":                    cmp_icon,
    "image_background_category_1": input_background_category_1,
    "image_background_category_2": input_background_category_2,
    "image_background_category_3": input_background_category_3,
    "image_background_category_4": input_background_category_4,
    "image_background_category_5": input_background_category_5,
    "bgt_type":                    bgt_type,
    "cmp_meta_description":        cmp_meta_description,
    "cmp_active":                  cmp_active,
    "cmp_parent_id":               cmp_parent_id,
    "web_id":                      web_id_create,
    "post_type_id":                post_type_id.join(",")
  }
   return data;
}

//Make Information Image Get The FUCK Out Of Chrome Security And Change Data To Base64
var exGetImg = function(extag, element) {
    var file = extag.files[0]; //The first file of the selected file (as a fixed format)
    var readers = new FileReader(); //Create a new file reading object to change the path
    var filename;
    readers.readAsDataURL(file); //Convert the read file path to a url type    
    readers.onload = function() {//Call onload() method after conversion
            var imgsSrc = this.result; //After the image address is read out, the result result is DataURL //this.result is the URL path of the image conversion
            console.log(imgsSrc); //The url path of the displayed image can be directly assigned to the src attribute of img
            $(element).siblings('img').css('display', 'block');
            $(element).siblings('svg').css('display', 'none');
            $(element).siblings('img').attr('src', imgsSrc);    
    }
}

  //set default image which null value
function checkdefault(default_value, check_parameter){
  if(check_parameter == null){
    return default_value;
  }
  return check_parameter;
}

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
  
    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", base_url + state.image);
  
    return $state;
  } //End Of Function Website Select2

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
  $('.alert').addClass('d-block');
  setTimeout(function(){ $('.alert').removeClass('d-block'); }, 3000);

  $('.alert button.close').on('click', function(){
    $('.alert').removeClass('d-block');
  });
}

function setImageData(data, element, max=0){
  if(data && element){
    if(max != 0){
      var data_arr = data.split(",");
      if(data_arr.length<=5){
        var i = 1;
        data_arr.forEach(function(value, key){
          value = value.trim();
          key = key+1;
          $(element + key +'_update').attr("src", base_url + value);
          $(element + key +'_update').siblings('svg').css('display', 'none');
          $(element + key +'_update').css('display', 'block');
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

function getAllCate(web_id){
  var data = {
    "web_id": web_id
  }
  $.ajax({
    url: base_url + 'api/Controller/getCategories.php',
    method: 'POST',
    async: false,
    data: JSON.stringify(data),
    success: function(data){
      if(data.code == 404){
        var err = `<p class="mess-err">chưa có danh mục nào!!</p>`;
      }
      else{
        var cate_child =[];
        var cate_parent = [];
        data.forEach((e)=>{
          if(e.cmp_parent_id !=null){
            cate_child.push(e);
          }
          else if(e.cmp_parent_id == null){
            cate_parent.push(e);
          }
        })

        var allCate = cate_parent.map((p)=>{
          var rs =``;
          rs +=`<div class="categories-item">`;
          rs +=` <div class="categories-parent-item">
                    <p>${p.cmp_name}</p>
                    <button id_cate="${p.cmp_id}" class="btn btn-warning btn-update d-none show-modal-update">sửa</button>
                 </div>`;
                cate_child.forEach((c)=>{
                  if(c.cmp_parent_id == p.cmp_id){
                    rs += `
                    <div class="wapper-categories-child">
                        <div class="categories-child-item">
                            <div>
                                <p>
                                  ${c.cmp_name}
                                  <button id_cate="${c.cmp_id}" class="btn btn-warning btn-update d-none show-modal-update">sửa</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    `;
                  }
                })
          rs +=`</div>`;
          return rs;
        })

        var cateHasChild = data.map((e)=>{
            if(e.cmp_parent_id==null){
              return`
                <option value="${e.cmp_id}">${e.cmp_name}</option>
              `;
            }
        })
      }
      
      $('.categories-content').html(allCate ?? err).ready(function(){
        $('#cmp_parent_id').html("<option value=''>không thuộc danh mục nào cả</option>"+cateHasChild);
        $('.disable').removeAttr('disabled');

        $('.categories-parent-item').hover(function(){
          $(this).children('button').removeClass('d-none');
        }, function(){
          $(this).children('button').addClass('d-none');
        })

        $('.categories-child-item > div > p').hover(function(){
          $(this).children('button').removeClass('d-none');
        }, function(){
          $(this).children('button').addClass('d-none');
        })

        $('.show-modal-update').click(function(){
          $('.modal-update').css("display", "block");
          $('body').css("overflow", "hidden");
          cmp_id = parseInt($(this).attr('id_cate'));
          var dataGetCateByID = {
            'cmp_id': $(this).attr('id_cate'),
            'web_id': web_id
          }
          getCateById(dataGetCateByID);
        })
        
      })
    }
  });
}

