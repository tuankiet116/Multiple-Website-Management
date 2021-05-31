
$(document).ready(function(){
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
              "term": params.term
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

  $('.pick_categories').select2({
    placeholder: 'Search for categories'
  });

  $('.pick_website_select').on('change', function(){
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
      var web_id = $('.pick_website_select').select2('data')[0].id;
      console.log(web_id);
      $('.pick_categories').select2({
        ajax: { 
          url: "../../../api/Controller/searchTermCategories.php",
          type: "POST",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            if(params.term == null){
              var obj = {
                "term": params.term,
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
    
    $('#submit_button').on('click', function(e){
      e.preventDefault();
      var data = CKEDITOR.instances.post_editor.getData();
      console.log(data);
    });
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