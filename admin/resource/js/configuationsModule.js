/*
  Select2 Data Template --optional :
    id
    path --> use for select2 language
    description --> use for select2 website choosing
    image
    text --> mean 'title' 
*/

var oldValue;
var found = false;
var web_id = null;

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
    web_id = id[0].data.web_id;
    var data = {
      "web_id": web_id
    }
    url = 'http://cleaning.com:8080/api/Controller/getConfiguations.php';

    ajax(JSON.stringify(data),url, loadSuccessConfiguration, errorLoadConfiguration);
  });

  $('.input-image-container i').on('click', function(){
    $('#submit_configuation').attr('disabled', false);
  });

  //Check Old Value With New Value
  $('.configuations input, .configuations textarea').on('keyup', function(){
    data_new = GetAllData();
    if(JSON.stringify(data_new) == JSON.stringify(oldValue)){
      $('#submit_configuation').attr('disabled', true);
    }
    else{
      $('#submit_configuation').attr('disabled', false);
    }
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

  $("#submit_configuation").on('click', function(e){
    e.preventDefault();
    uploadInformation();
  });

  $("#cancel_configuation").on('click', function(e){
    $('.configuations input').attr('disabled', false);
    $('.configuations select').attr('disabled', false);
    $('.configuations textarea').attr('disabled', false);
    $('#cancel_configuration').attr('disabled', false);

    var id = $('.pick_website_select').select2('data');
    web_id = id[0].data.web_id;
    var data = {
      "web_id": web_id
    }
    url = 'http://cleaning.com:8080/api/Controller/getConfiguations.php';

    ajax(JSON.stringify(data),url, loadSuccessConfiguration, errorLoadConfiguration);
  });

  $('.form-check span').on('click', function(){
    $('#submit_configuation').attr('disabled', false);
    if($(this).siblings('input').val() == 'on'){
      $(this).siblings('input').val('off');
    }
    else{
      $(this).siblings('input').val('on');
    }
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
          $(element).siblings('img').css('display', 'block');
          $(element).siblings('svg').css('display', 'none');
          $(element).siblings('img').attr('src', imgsSrc);    
  }
}

function loadSuccessConfiguration(data){
  if(parseInt(data.code) == 200){// Request OK
          
    found = true;
    getSuccessDataConfiguration(data);
    oldValue = data;
    delete oldValue.code;
    delete oldValue.con_banner_image;
    delete oldValue.con_background_homepage;
    delete oldValue.con_logo_bottom;
    delete oldValue.con_logo_top;
    delete oldValue.con_id;
  }
  if(parseInt(data.code) == 404){
    ResetForm();
    found = false;
  }
}

function errorLoadConfiguration(data){
  showAlert('error','<strong>ERROR:</strong> Get Configuration');
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
    '<span class="language-picker" id = "language_'+ state.id +'"><img class="img-flag" /> <span></span></span>'
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
    error: function(data){
      showAlert('error','<strong>ERROR:</strong> Get Language')
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
    $('#input-rewrite').val('on');
  }
  else{
    $('#input-rewrite').prop('checked', false);
    $('#input-rewrite').val('off');
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
    $('#check-active-contact').val('on');
  }
  else{
    $('#check-active-contact').prop('checked', false);
    $('#check-active-contact').val('off');
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
    $('#check-active-banner').val('on');
  }
  else{
    $('#check-active-banner').prop('checked', false);
    $('#check-active-banner').val('off');
  }

  //End Of Call Data
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

//Reset Form
function ResetForm(){
  $('.configuations input').val('');
  $('.check-box').prop('checked', false);
  $('.configuations textarea').val('');
  $('.configuations #submit_configuation').attr('disabled', false);
  $('.input-image img').attr('src', '#');
  $('.input-image img').css('display', 'none');
  $('.input-image svg').css('display', 'block');
  var select_option = "<option selected value = '"+data_language_default.lang_id+"' title = '"+data_language_default.lang_image+"' >"+data_language_default.lang_name+"</option>";
  setSelect2DataLanguage('.pick_language', select_option, data_language_default);
}

//Get Data From Input
function GetAllData(){
  input_email              = $('#input-admin-email').val().replace(/"/g, "'");
  input_site_title         = $('#input-site-title').val().replace(/"/g, "'");
  input_meta_description   = $('#input-meta-description').val().replace(/"/g, "'");
  input_meta_keyword       = $('#input-meta-keyword').val().replace(/"/g, "'");
  input_rewrite            = $('#input-rewrite').val() == 'on'? 1:0;
  input_extention          = $('#input-extention').val().replace(/"/g, "'");
  pick_language            = $('.pick_language').select2('val').replace(/"/g, "'");
  input_hotline            = $('#input-hotline').val().replace(/"/g, "'");;
  input_hotline_banhang    = $('#input-hotline-banhang').val().replace(/"/g, "'");
  input_hotline_kythuat    = $('#input-hotline-kythuat').val().replace(/"/g, "'");
  input_address            = $('#input-address').val().replace(/"/g, "'");
  check_active_contact     = $('#check-active-contact').val() == 'on'? 1:0;
  input_payment            = $('#input-payment').val().replace(/"/g, "'");
  input_fee_transport      = $('#input-fee-transport').val().replace(/"/g, "'");
  input_contact_sale       = $('#input-contact-sale').val().replace(/"/g, "'");
  input_info_company       = $('#input-info-company').val().replace(/"/g, "'");
  input_page_fb            = $('#input-page-fb').val().replace(/"/g, "'");
  input_link_fb            = $('#input-link-fb').val().replace(/"/g, "'");
  input_link_insta         = $('#input-link-insta').val().replace(/"/g, "'");
  input_link_twitter       = $('#input-link-twitter').val().replace(/"/g, "'");
  input_map                = $('#input-map').val().replace(/"/g, "'");
  input_banner_title       = $('#input-banner-title').val().replace(/"/g, "'");
  input_banner_description = $('#input-banner-description').val().replace(/"/g, "'");
  check_active_banner      = $('#check-active-banner').val() == 'on'? 1:0;

  data = {
    con_admin_email           : input_email.trim(),
    con_site_title            : input_site_title.trim(),
    con_meta_description      : input_meta_description.trim(),
    con_meta_keyword          : input_meta_keyword.trim(),
    con_mod_rewrite           : input_rewrite,
    con_extenstion            : input_extention.trim(),
    lang_id                   : pick_language.trim(),
    con_active_contact        : check_active_contact,
    con_hotline               : input_hotline.trim(),
    con_hotline_banhang       : input_hotline_banhang.trim(),
    con_hotline_hotro_kythuat : input_hotline_kythuat.trim(),
    con_address               : input_address.trim(),
    con_info_payment          : input_payment.trim(),
    con_fee_transport         : input_fee_transport.trim(),
    con_contact_sale          : input_contact_sale.trim(),
    con_info_company          : input_info_company.trim(),
    con_page_fb               : input_page_fb.trim(),
    con_link_fb               : input_link_fb.trim(),
    con_link_twitter          : input_link_twitter.trim(),
    con_link_insta            : input_link_insta.trim(),
    con_map                   : input_map.trim(),
    con_banner_title          : input_banner_title.trim(),
    con_banner_description    : input_banner_description.trim(),
    con_banner_active         : check_active_banner
  }
  return data;
}

function uploadInformation(){
  data = GetAllData();
  data.web_id                      = web_id;
  data.image_background_homepage_1 = $('#image_background_homepage_1').attr('src');
  data.image_background_homepage_2 = $('#image_background_homepage_2').attr('src');
  data.image_background_homepage_3 = $('#image_background_homepage_3').attr('src');
  data.image_background_homepage_4 = $('#image_background_homepage_4').attr('src');
  data.image_background_homepage_5 = $('#image_background_homepage_5').attr('src');
  data.image_background_homepage_6 = $('#image_background_homepage_6').attr('src');
  data.image_background_homepage_7 = $('#image_background_homepage_7').attr('src');
  data.image_logo_top              = $('#image_logo_top').attr('src');
  data.image_logo_bottom           = $('#image_logo_bottom').attr('src');
  data.image_banner                = $('#image_banner').attr('src');

  var url = '../../../api/Controller/createConfigurations.php';
  if(found){
    var url = '../../../api/Controller/updateConfigurations.php';
  }
  data = JSON.stringify(data);
  ajax(data, url, successUpload, errorUpload, 'POST', 'JSON');
}

function successUpload(data){
  if(data.code == 200){
    found = true;
    $('#submit_configuation').attr('disabled', true);
    showAlert('success', data.message)
    var data_webID = {
      "web_id": web_id
    }
    url = 'http://cleaning.com:8080/api/Controller/getConfiguations.php';
    ajax(JSON.stringify(data_webID), url, loadSuccessConfiguration, errorLoadConfiguration);
  }
  else{
    showAlert('warning', data.message);
  }
}

function errorUpload(data){
  found = false;
  showAlert('error', '<strong>ERROR:</strong> Update Or Create get trouble!')
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
