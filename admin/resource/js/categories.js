var base_url = '../../../';
var post_type_id = [];
var web_id_create = '';
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
                      <i class="fas fa-chevron-down"></i>
                  </div>`;
                  cate_child.forEach((c)=>{
                    if(c.cmp_parent_id == p.cmp_id){
                      rs += `
                      <div class="wapper-categories-child">
                          <div class="categories-child-item">
                              <div>
                                  <p>${c.cmp_name}</p>
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
        
        $('.categories-content').html(allCate ?? err);
        $('#cmp_parent_id').html("<option value=''>không thuộc danh mục nào cả</option>"+cateHasChild);

        $('.categories-parent-item').on('click', function(){
          $(this).siblings('.wapper-categories-child').toggle();
          $(this).children('i').toggleClass('rotage');
        });
        
        $('.categories-child-item > div > p').on('click', function(){
            $(this).siblings('.categories-child-item > div > div').slideToggle();
        });

        $('.disable').removeAttr('disabled');
      }
    });
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
      if(cmp_name=="" || cmp_rewrite_name==""){
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
              showAlert('success', `<p>${data.message}</p>`);
            }
            else{
              showAlert('error', `<p>${data.message}</p>`);
            }
          },
        });
        $('#formCategory')[0].reset();
        $('#image_background_homepage_1').attr('src', "#");
        $('#image_background_homepage_2').attr('src', "#");
        $('#image_background_homepage_3').attr('src', "#");
        $('#image_background_homepage_4').attr('src', "#");
        $('#image_background_homepage_5').attr('src', "#");
      }
    
    return false;
  })
});

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

function dataCategory(){
  var cmp_name                    = $('#cmp_name').val();
  var cmp_rewrite_name            = $('#cmp_rewrite_name').val();
  var cmp_icon                    = $('#cmp_icon').val();
  var cmp_has_child               = $('#cmp_has_child').val();
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
    "cmp_has_child":               cmp_has_child,
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