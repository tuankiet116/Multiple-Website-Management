$(document).ready(function(){
  // $(".pick_website_select").on('select2:opening', function(e){
  //   alert('open');
  // });
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
        return {
            results: $.map(data, function (item) {
                return {
                    text: item.web_name,
                    id: item.web_id,
                    web_icon: checkdefault("data/web_icon/icon_default/default.png",item.web_icon),
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

  $(".pick_language").select2({
    ajax: { 
      url: "../../../api/Controller/searchLang.php",
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
        return {
            results: $.map(data, function (item) {
                return {
                    text: item.lang_name,
                    id: item.lang_id,
                    image: checkdefault("data/lang_icon/icon_default/default.png",item.lang_image),
                    path: item.lang_path,
                    data: item
                };
            })
        };
      },
      cache: false
    },
    placeholder: 'Search for a Language',
    minimumInputLength: 0,
    templateResult: formatRepoLanguage,
    templateSelection: formatRepoSelectionLanguage
  });
});

var base_url_icon = "../../../";

// Website function Select2
function formatRepoWebsite (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-website clearfix'>" +
      "<div class='select2-result-website__icon'><img src='" + base_url_icon + repo.web_icon + "' /></div>" +
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
  $state.find("img").attr("src", base_url_icon + state.web_icon.toLowerCase());

  return $state;
}

//Language Function Select2
function formatRepoLanguage (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-language clearfix'>" +
      "<div class='select2-result-language__icon'><img src='" + base_url_icon + repo.image + "' /></div>" +
      "<div class='select2-result-language__meta'>" +
        "<div class='select2-result-language__title'></div>" +
        "<div class='select2-result-language__description'></div>" +
      "</div>" +
    "</div>"
  );

  $container.find(".select2-result-language__title").text(repo.text);
  $container.find(".select2-result-language__description").text(repo.path)

  return $container;
}

function formatRepoSelectionLanguage (state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<span id = "language_'+ state.id +'"><img class="img-flag" /> <span></span></span>'
  );

  // Use .text() instead of HTML string concatenation to avoid script injection issues
  $state.find("span").text(state.text);
  $state.find("img").attr("src", base_url_icon + state.image.toLowerCase());

  return $state;
}

//set default image which null value
function checkdefault(default_value, check_parameter){
  if(check_parameter == null){
    return default_value;
  }
  return check_parameter;
}