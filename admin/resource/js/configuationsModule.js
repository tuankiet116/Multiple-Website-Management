/*
  Select2 Data Template --optional :
    id
    path --> use for select2 language
    description --> use for select2 website choosing
    image
    text --> mean 'title' 
*/

var oldValue;
var newValue;

$(document).ready(function(){
  $('b[role="presentation"]').hide();
  $('.select2-arrow').append('<i class="fa fa-angle-down"></i>');

  //Disable Form Input Before Choose Website
  $('.configuations input').attr('disabled', true);
  $('.configuations select').attr('disabled', true);
  $('.configuations textarea').attr('disabled', true);
  $('.configuations #submit_configuation  ').attr('disabled', true);

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

  //Select2 For Pick Language
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

  // Get Configuration Information From Database when Select website
  $(".pick_website_select").on("change", function(e){
    //Enable Form Input
    $('.configuations input').attr('disabled', false);
    $('.configuations select').attr('disabled', false);
    $('.configuations textarea').attr('disabled', false);
    $('#cancel_configuration').attr('disabled', false);

    var id = $('.pick_website_select').select2('data');
    var data = {
      "web_id": id[0].data.web_id
    }
    $.ajax({
      url: 'http://cleaning.com:8080/api/Controller/getConfiguations.php',
      dataType: 'json',
      data: JSON.stringify(data),
      type: 'POST',
      async: false,
      success: function(data){
        if(parseInt(data.code) == 200){// Request OK
          getSuccessDataConfiguration(data);
          oldValue = data;
          //console.log(oldValue);
        }
        if(parseInt(data.code) == 404){
          ResetForm();
        }
      },
      error: function(){

      }
    });
  });

  //Check Old Value With New Value
  $('.configuations input').on('keyup', function(){
    GetAllData();
  });

  // Input Image Processing When Image Is NULL
  $(".input-image").on("click", function(e){
    var id = $(this).attr("id");
    id = id.replace('input_image_', '');
    id = "input_" + id;
    $('#'+id)[0].click();  

    $('#'+id).change(function(e) {
      var filename = exGetImg(e.target, '#' + id);
    });
  });

  $(".input-image-container i").on('click',function(e){
    
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

  $(".form-input-background-homepage").on("change", function(e){
    
  });
});

var base_url = "../../../";
var data_language_default = {
  id: 1,
  lang_name: 'Tiếng Việt',
  lang_path: 'vn',
  lang_image: 'data/lang_icon/icon/vietnam-512.png',
  lang_domain: null
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


//Language Function Select2
function formatRepoLanguage (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-language clearfix'>" +
      "<div class='select2-result-language__icon'><img src='" + base_url + repo.image + "' /></div>" +
      "<div class='select2-result-language__meta'>" +
        "<div class='select2-result-language__title'></div>" +
        "<div class='select2-result-language__description'></div>" +
      "</div>" +
    "</div>"
  );

  $container.find(".select2-result-language__title").text(repo.text);
  $container.find(".select2-result-language__description").text(repo.path);

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
  var image = state.image||state.title; 
  $state.find("img").attr("src", base_url + image);

  return $state;
} //End Of Language Function Select2


//set default image which null value
function checkdefault(default_value, check_parameter){
  if(check_parameter == null){
    return default_value;
  }
  return check_parameter;
}

//Call Ajax Language Table
function getLanguage(data){
  var result = "";
  data = {
    'lang_id': data
  }

  $.ajax({ 
    url: "../../../api/Controller/getLangByID.php",
    type: "POST",
    async: false,
    dataType: 'json',
    data: JSON.stringify(data),
    success: function(data){
      result = data;
    },
    error: function(){
      result = "NOT_FOUND";
    }
  });
  return result;
}

//Function Set Selected Data||Value For Select2 Language
function setSelect2DataLanguage(id ,data_select = "", data){
  $(id)
      .empty()
      .append(data_select);

  $(id).trigger('change');
}

//Function Fill Information configuration Into Input Form
function getSuccessDataConfiguration(data){
  $('#input-admin-email').val(data.con_admin_email);
  $('#input-site-title').val(data.con_site_title);
  $('#input-meta-description').val(data.con_meta_description);
  $('#input-meta-keyword').val(data.con_meta_keyword);
  
  //Set mode_rewrite
  if(parseInt(data.con_mod_rewrite) == 1){
    $('#input-rewrite').prop('checked', true);
  }
  else{
    $('#input-rewrite').prop('checked', false);
  }
  $('#input-extention').val(data.con_extenstion);
  var lang_data     = getLanguage(data.lang_id);
  
  //Set select element language
  var select_option = "<option selected value = '"+lang_data.lang_id+"' title = '"+lang_data.lang_image+"' >"+lang_data.lang_name+"</option>";
  setSelect2DataLanguage('.pick_language', select_option, lang_data);

  $('#input-hotline').val(data.con_hotline);
  $('#input-hotline-banhang').val(data.con_hotline_banhang);
  $('#input-hotline-kythuat').val(data.con_hotline_hotro_kythuat);
  $('#input-address').val(data.con_address);
  
  //Set active contact
  if(parseInt(data.con_active_contact) == 1){
    $('#check-active-contact').prop('checked', true);
  }
  else{
    $('#check-active-contact').prop('checked', false);
  }

  //Set image Data
  setImageData(data.con_background_homepage, '#image_background_homepage_', 7);

  $('#input-payment').val(data.con_info_payment);
  $('#input-fee-transport').val(data.con_fee_transport);
  $('#input-contact-sale').val(data.con_contact_sale);
  $('#input-info-company').val(data.con_info_company);

  //Set Logo-Top and Bottom Data
  setImageData(data.con_logo_top, '#image_logo_top');
  setImageData(data.con_logo_bottom, '#image_logo_bottom');

  $('#input-page-fb').val(data.con_page_fb);
  $('#input-link-fb').val(data.con_link_fb);
  $('#input-link-insta').val(data.con_link_insta);
  $('#input-link-twitter').val(data.con_link_twitter);
  $('#input-map').val(data.con_map);

  //Set Image Banner
  setImageData(data.con_banner_image, '#image_banner');

  $('#input-banner-title').val(data.con_banner_title);
  $('#input-banner-description').val(data.con_banner_description);

  //Set Check Active Banner
  if(parseInt(data.con_banner_active) == 1){
    $('#check-active-banner').prop('checked', true);
  }
  else{
    $('#check-active-banner').prop('checked', false);
  }

  //End Of Call Data
}


//Set Image Data Within String If Max != 0 And Without String If Max = 0 --> Customize later
function setImageData(data, element, max=0){
  if(data && element){
    if(max != 0){
      var data_arr = data.split(",");
      //console.log(data_arr);
      if(data_arr.length<=7){
        var i = 1;
        data_arr.forEach(function(value, key){
          value = value.trim();
          key = key+1;
          $(element + key).attr("src", base_url + value);
          $(element + key).css('display', 'block');
          $(element).siblings('svg').css('display', 'none');
        });
      }
    }
    else{
      $(element).attr("src", base_url + data);
      $(element).css('display', 'block');
      $(element).siblings('svg').css('display', 'none');
    }
  }
}

//Reset Form
function ResetForm(){
  $('.configuations input').val('');
  $('.check-box').prop('checked', false);
  $('.configuations textarea').val('');
  $('.configuations #submit_configuation').attr('disabled', false);
  var select_option = "<option selected value = '"+data_language_default.lang_id+"' title = '"+data_language_default.lang_image+"' >"+data_language_default.lang_name+"</option>";
  setSelect2DataLanguage('.pick_language', select_option, data_language_default);
}

//Get Data From Input
function GetAllData(){
  input_email = $('#input-admin-email').val();
  input_site_title = $('#input-site-title').val();
  input_meta_description = $('#input-meta-description').val();
  input_meta_keyword = $('#input-meta-keyword').val();
  input_rewrite = $('#input-rewrite').val();
  input_extention = $('#input-extention').val();
  pick_language = $('.pick_language').select2('val');
  input_hotline = $('#input-hotline').val();
  input_hotline_banhang = $('#input-hotline-banhang').val();
  input_hotline_kythuat = $('#input-hotline-kythuat').val();
  input_address = $('#input-address').val();
  check_active_contact = $('#check-active-contact').val();

  // //Set image Data
  // setImageData(data.con_background_homepage, '#image_background_homepage_', 7);

  // $('#input-payment').val(data.con_info_payment);
  // $('#input-fee-transport').val(data.con_fee_transport);
  // $('#input-contact-sale').val(data.con_contact_sale);
  // $('#input-info-company').val(data.con_info_company);

  // //Set Logo-Top and Bottom Data
  // setImageData(data.con_logo_top, '#image_logo_top');
  // setImageData(data.con_logo_bottom, '#image_logo_bottom');

  // $('#input-page-fb').val(data.con_page_fb);
  // $('#input-link-fb').val(data.con_link_fb);
  // $('#input-link-insta').val(data.con_link_insta);
  // $('#input-link-twitter').val(data.con_link_twitter);
  // $('#input-map').val(data.con_map);

  // //Set Image Banner
  // setImageData(data.con_banner_image, '#image_banner');

  // $('#input-banner-title').val(data.con_banner_title);
  // $('#input-banner-description').val(data.con_banner_description);

  // //Set Check Active Banner
  // if(parseInt(data.con_banner_active) == 1){
  //   $('#check-active-banner').prop('checked', true);
  // }
  // else{
  //   $('#check-active-banner').prop('checked', false);
  // }

  data = {
    con_admin_email           : input_email.trim(),
    con_site_title            : input_site_title,
    con_meta_description      : input_meta_description,
    con_meta_keyword          : input_meta_keyword,
    con_mod_rewrite           : input_rewrite,
    con_extenstion            : input_extention,
    lang_id                   : pick_language,
    con_active_contact        : check_active_contact,
    con_hotline               : input_hotline,
    con_hotline_banhang       : input_hotline_banhang,
    con_hotline_hotro_kythuat : input_hotline_kythuat,
    con_address               : input_address,
    // con_background_homepage   : con_background_homepage,
    // con_info_payment          : con_info_payment,
    // con_fee_transport         : con_fee_transport,
    // con_contact_sale          : con_contact_sale,
    // con_info_company          : con_info_company,
    // con_logo_top              : con_logo_top,
    // con_logo_bottom           : con_logo_bottom,
    // con_page_fb               : con_page_fb,
    // con_link_fb               : con_link_fb,
    // con_link_twitter          : con_link_twitter,
    // con_link_insta            : con_link_insta,
    // con_map                   : con_map,
    // con_banner_title          : con_banner_title,
    // con_banner_description    : con_banner_description,
    // con_banner_active         : con_banner_active
  }
  console.log(data);
}

