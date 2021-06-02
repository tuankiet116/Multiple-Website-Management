
$(document).ready(function(){
  var web_id =  null;

  $('b[role="presentation"]').hide();
  $('.select2-arrow').append('<i class="fa fa-angle-down"></i>');
  
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

  //Categories Handle
  $('.pick_categories').select2({
    placeholder: 'Search for categories'
  });

  $('.pick_website_select').on('change', function(){
    $('.pick_post_type').val('').trigger('change');
    $('.pick_post_type').select2({
      placeholder: 'Search For Type Of Post'
    });
    $('.pick_post_type').prop('disabled', true);

    $('.pick_categories').val('').trigger('change');
    $('.pick_categories').select2({
      placeholder: 'Search for categories'
    });

    $('.pick_categories').siblings('.select2-container').css('display', 'none');
    $('.image-loading').css('display', 'block');
    
    setTimeout(function(){
      $('.image-loading').css('display', 'none');
      $('.pick_categories').siblings('.select2-container').css('display', 'block');
      $('.pick_categories').prop('disabled', false);
      activePickCategories(); 
    }, 2000)
    
    function activePickCategories(){
      web_id = $('.pick_website_select').select2('data')[0].id;
      $('.pick_categories').select2({
        ajax: { 
          url: "../../../api/Controller/searchTermCategories.php",
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
                        text: item.cmp_name,
                        id: item.cmp_id,
                        image: checkdefault("data/categories_icon/default/tag-2.png",item.cmp_icon),
                        data: item
                    };
                })
            };
          },
          cache: false
          },
          
          placeholder: 'Search for categories',
          minimumInputLength: 0,
          templateResult: formatRepoCategories,
          templateSelection: formatRepoSelectionCategories
      })
    }
  });


  //Post Type Handle
  $('.pick_post_type').select2({
    placeholder: 'Search For Type Of Post'
  });

  $('.pick_categories').on('select2:select', function(){
    $('.pick_post_type').val('').trigger('change');
    $('.pick_post_type').select2({
      placeholder: 'Search For Type Of Post'
    });

    $('.pick_post_type').siblings('.select2-container').css('display', 'none');
    $('.image-loading-post-type').css('display', 'block');
    
    setTimeout(function(){
      $('.image-loading-post-type').css('display', 'none');
      $('.pick_post_type').siblings('.select2-container').css('display', 'block');
      $('.pick_post_type').prop('disabled', false);
      activePickPostType(); 
    }, 2000)
    
    function activePickPostType(){
      var cmp_id = $('.pick_categories').select2('data')[0].id;

      $('.pick_post_type').select2({
        ajax: { 
          url: "../../../api/Controller/searchTermPostType.php",
          type: "POST",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            if(params.term == null){
              var obj = {
                "term": "",
                "cmp_id": cmp_id
              } 
            }else{
              var obj = {
              "term": params.term.trim(),
              "cmp_id": cmp_id
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
                        text: item.post_type_title,
                        id: item.post_type_id,
                        data: item
                    };
                })
            };
          },
          cache: false
          },
          
          placeholder: 'Search For Type Of Post',
          minimumInputLength: 0,
      })
    }
  });


  //Pick Product Select2
  $('.pick_product').select2({
    ajax: { 
      url: "../../../api/Controller/searchTermProduct.php",
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

  $('.pick_post_type').on('select2:select', function(){
    $('input').attr('disabled', false);
    $('textarea').attr('disabled', false);
    $('select').prop('disabled', false);
  });

  $('#postTitle').on('keyup', function(){
    // if($(this).val() != null || $(this).val() != ""){
    //   CKEDITOR.instances.post_editor.readOnly = false;
    // } -- Not Finished Yet

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
      'cmp_id': $('.pick_categories').select2('val'),
      'post_type_id': $('.pick_post_type').select2('val'),
      'content': content,
    }

    var url = '../../../api/Controller/createPost.php';

    $.ajax({
      type: 'POST',
      data: JSON.stringify(data),
      async: true,
      dataType: 'JSON',
      url: url,
      success: function(data){
        createPostSuccess(data);
      },
      error: function(data){
        createPostError(data);
      }
    });
    //ajax(JSON.stringify(data), url, createPostSuccess, createPossError );
  });
  
});


var base_url = "../../../";

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



//Select Categories select2 function
function formatRepoCategories (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-website clearfix' id='result_categories_"+repo.id+"'>" +
      "<div class='select2-result-categories__icon'><img src='" + base_url + repo.image + "' /></div>" +
      "<div class='select2-result-categories__meta'>" +
        "<div class='select2-result-categories__title'></div>" +
      "</div>" +
    "</div>"
  );

  $container.find(".select2-result-categories__title").text(repo.text);

  return $container;
}

function formatRepoSelectionCategories (state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<span id = "categories_'+ state.id +'"><img class="icon_cate" /> <span></span></span>'
  );

  // Use .text() instead of HTML string concatenation to avoid script injection issues
  $state.find("span").text(state.text);
  $state.find("img").attr("src", base_url + state.image);

  return $state;
} 

//Select Post Type select2 function
function formatRepoPostType (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-posttype clearfix' id='result_posttype_"+repo.id+"'>" +
      "<div class='select2-result-posttype__meta'>" +
        "<div class='select2-result-posttype__title'></div>" +
      "</div>" +
    "</div>"
  );

  $container.find(".select2-result-posttype__title").text(repo.text);

  return $container;
}

function formatRepoSelectionPostType (state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<span id = "posttype_'+ state.id +'"><span></span></span>'
  );

  // Use .text() instead of HTML string concatenation to avoid script injection issues
  $state.find("span").text(state.text);

  return $state;
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

  // Use .text() instead of HTML string concatenation to avoid script injection issues
  $state.find("span").text(state.text);
  $state.find("img").attr("src", base_url + state.image);

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

function createPostSuccess(data){
  if(data.code == 200){
    showAlert('success', data.message);
  }
  else{
    showAlert('warning', data.message);
  }
}

function createPostError(data){
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
