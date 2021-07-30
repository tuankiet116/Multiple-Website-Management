$(document).ready(function () {
  var web_id = null;

  $('b[role="presentation"]').hide();
  $(".select2-arrow").append('<i class="fa fa-angle-down"></i>');

  $(".pick_website_select").select2({
    ajax: {
      url: "../../../api/Controller/searchTerm.php",
      type: "POST",
      dataType: "json",
      delay: 250,
      data: function (params) {
        if (params.term == null) {
          var obj = {
            term: "",
          };
        } else {
          var obj = {
            term: params.term.trim(),
          };
        }

        return JSON.stringify(obj);
      },
      processResults: function (data, params) {
        if (data.code == 404) {
          return;
        }
        return {
          results: $.map(data, function (item) {
            if (item == 404) {
              return;
            }
            return {
              text: item.web_name,
              id: item.web_id,
              image: checkdefault("data/web_icon/icon_default/default.png",item.web_icon),
              description: item.web_description,
              data: item,
            };
          }),
        };
      },
      cache: false,
    },
    placeholder: "Search for a Website",
    minimumInputLength: 0,
    templateResult: formatRepoWebsite,
    templateSelection: formatRepoSelectionWebsite,
  });

  //Categories Handle
  $(".pick_categories").select2({
    placeholder: "Search for categories",
  });

  $(".pick_website_select").on("change", function () {
    $(".pick_post_type").val("").trigger("change");
    $(".pick_post_type").select2({
      placeholder: "Search For Type Of Post",
    });
    $(".pick_post_type").prop("disabled", true);

    $(".pick_categories").val("").trigger("change");
    $(".pick_categories").select2({
      placeholder: "Search for categories",
    });

    $(".pick_categories").siblings(".select2-container").css("display", "none");
    $(".image-loading").css("display", "block");

    setTimeout(function () {
      $(".image-loading").css("display", "none");
      $(".pick_categories")
        .siblings(".select2-container")
        .css("display", "block");
      $(".pick_categories").prop("disabled", false);
      activePickCategories();
    }, 2000);

    function activePickCategories() {
      web_id = $(".pick_website_select").select2("data")[0].id;
      $(".pick_categories").select2({
        ajax: {
          url: "../../../api/Controller/searchTermCategoriesOptionGroup.php",
          type: "POST",
          dataType: "json",
          delay: 250,
          data: function (params) {
            if (params.term == null) {
              var obj = {
                term: "",
                web_id: web_id,
              };
            } else {
              var obj = {
                term: params.term.trim(),
                web_id: web_id,
              };
            }

            return JSON.stringify(obj);
          },
          processResults: function (data, params) {
            if (data.code == 404) {
              return null;
            }
            result = {
              results: $.map(data, function (item) {
                return optgroupSelect2(item);
              }),
            };
            console.log(result?.results);
            return result;
          },
          cache: false,
        },

        placeholder: "Search for categories",
        minimumInputLength: 0,
      });
    }
  });

  $(".pick_categories").on("select2:select", function () {
    $("input").attr("disabled", false);
    $("textarea").attr("disabled", false);
    $("select").prop("disabled", false);
  });

  $(".pick_show").select2();
  $(".pick_active").select2();
  $(".pick_allow_show").select2();

  $("#submit_button").on("click", function (e) {
    e.preventDefault();
    var data = {
      'web_id'               : $('.pick_website_select').select2('val'),
      'post_type_title'      : $("#postTypeTitle").val(),
      'post_type_description': $("#postTypeDescription").val(),
      'post_type_show'       : $(".pick_show").select2("val"),
      'post_type_active'     : $(".pick_active").select2("val"),
      'allow_show_homepage'  : $(".pick_allow_show").select2("val"),
      'cmp_id'               : $(".pick_categories").select2("val"),
    };

    var url = "../../../api/Controller/createPostType.php";

    $.ajax({
      type: "POST",
      data: JSON.stringify(data),
      async: true,
      dataType: "JSON",
      url: url,
      success: function (data) {
        createPostSuccess(data);
      },
      error: function (data) {
        createPostError(data);
      },
    });
    //ajax(JSON.stringify(data), url, createPostSuccess, createPossError );
  });
});

var base_url = "../../../";

function checkdefault(default_value, check_parameter) {
  if (check_parameter == null) {
    return default_value;
  }
  return check_parameter;
}

function formatRepoWebsite(repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-website clearfix' id='result_website_" +
      repo.id +
      "'>" +
      "<div class='select2-result-website__icon'><img src='" +
      base_url +
      repo.image +
      "' /></div>" +
      "<div class='select2-result-website__meta'>" +
      "<div class='select2-result-website__title'></div>" +
      "<div class='select2-result-website__description'></div>" +
      "</div>" +
      "</div>"
  );

  $container.find(".select2-result-website__title").text(repo.text);
  $container
    .find(".select2-result-website__description")
    .text(repo.description);

  return $container;
}

function formatRepoSelectionWebsite(state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<span id = "website_' +
      state.id +
      '"><img class="img-flag" /> <span></span></span>'
  );

  // Use .text() instead of HTML string concatenation to avoid script injection issues
  $state.find("span").text(state.text);
  $state.find("img").attr("src", base_url + state.image);

  return $state;
} //End Of Function Website Select2

//Select Categories select2 function
function formatRepoCategories(repo) {
  if (repo.loading) {
    return repo.text;
  }

  if (repo.hasOwnProperty("childrent")) {
    var $container = $(
      "<div class='select2-result-categories__parent clearfix' id='result_categories_" +
        repo.id +
        "'>" +
        "<div class='select2-result-categories__icon'><i class='fas fa-chevron-right'></i></div>" +
        "<div class='select2-result-categories__meta'>" +
        "<div class='select2-result-categories__title'></div>" +
        "</div>" +
        "</div>"
    );

    $container + formatRepoCategories(repo.childrent, space + " ");
  } else {
    var $container = $(
      "<div class='select2-result-categories clearfix' id='result_categories_" +
        repo.id +
        "'>" +
        "<div class='select2-result-categories__icon'><img src='" +
        base_url +
        repo.image +
        "' /></div>" +
        "<div class='select2-result-categories__meta'>" +
        "<div class='select2-result-categories__title'></div>" +
        "</div>" +
        "</div>"
    );
  }

  $container.find(".select2-result-categories__title").text(space + repo.text);

  return $container;
}

function formatRepoSelectionCategories(state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<span id = "categories_' +
      state.id +
      '"><img class="icon_cate" /> <span></span></span>'
  );

  // Use .text() instead of HTML string concatenation to avoid script injection issues
  $state.find("span").text(state.text);
  $state.find("img").attr("src", base_url + state.image);

  return $state;
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

function createPostSuccess(data){
  if(data.code == 200){
    showAlert('success', data.message);
  }
  else if(res.code == 403){
    showAlert('warning', 'Phiên đăng nhập hết hạn! Vui Lòng Tải Lại Trang Để Đăng Nhập Lại!');
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

 function optgroupSelect2(data) {
   if (data == 404) {
     return null;
   }
   var result = new Array();
   if (data.cmp_has_child === "1") {
     result = {
       text: data.cmp_name,
       //id: data.cmp_id,
     };
     child = data.cate_child;
     result.children = new Array();
     child.forEach(function (item, key) {
       if (item.cmp_has_child === "1") {
         result.children.push(optgroupSelect2(item));
       } else {
         arr = {
           text: item.cmp_name,
           id: item.cmp_id,
         };
         result.children.push(arr);
       }
     });
   } else {
     result = {
       text: data.cmp_name,
       id: data.cmp_id,
     };
   }
   return result;
 }