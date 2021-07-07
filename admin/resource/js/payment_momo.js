$(document).ready(function(){
  $('.loader-container').css('display', 'none');
  $('b[role="presentation"]').hide();
  $('.select2-arrow').append('<i class="fa fa-angle-down"></i>');
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
            "term": ''
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

  ajaxSearchingPost(null);

  $('#search_button').on('click', function(){
      var data = {
          "web_id"          : $('.pick_website_select').select2('val'),
          "term"            : $('#searching').val().trim(),
          "post_active"     : $('#post-status').val() == '1' ||  $('#post-status').val() == '0'? $('#post-status').val():null,
          "post_type_active": $('#post-type-status').val() == '1' ||  $('#post-type-status').val() == '0'? $('#post-type-status').val():null,
      }

      ajaxSearchingPost(data);
  });

  $('#clear_button').on('click', function(){
    $('#searching').val('');
    $('.pick_website_select').empty();
    $('#post-status').val('#').niceSelect('update');
    $('#post-type-status').val('#').niceSelect('update');
  });

  //Nice Select 
  $('#payment-status').niceSelect();
  $('#payment-method').niceSelect();
});


var base_url = "../../../";

function ajax(){

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

  //set default image which null value
function checkdefault(default_value, check_parameter){
    if(check_parameter == null || check_parameter == ""){
      return default_value;
    }
    return check_parameter;
}

function ajaxSearchingPost(data){
  $.ajax({
      type: 'POST',
      dataType: 'JSON',
      url: '../../../api/Controller/getAllPost.php',
      data: JSON.stringify(data),
      async: false,
      success: function(data){
          postSuccess(data);
          
      },
      error: function(data){
          postError(data);
      }
  });
  $('.loader-container').css('display', 'none');
}

function postSuccess(data){
  html = "";
  stt = 0;
  data.forEach(function(value, key){
      var action = '';
      var status = '';
      var post_type_status = '';

      if(value.post_title == null || value.post_title == ""){
          value.post_title = "<p style = 'color: red'>NULL</p>";
      }

      if(value.post_description == null || value.post_description == ""){
          value.post_description = "<p style = 'color: red'>NULL</p>";
      }

      if(value.post_type_title == null || value.post_type_title == ""){
          value.post_type_title = "<p style = 'color: red'>NULL</p>";
      }

      if(value.web_name == null || value.web_name == ""){
          value.web_name = "<p style = 'color: red'>NULL</p>";
      }

      if(value.post_active == 1){
        status = '<button style = "width: 100px;" id="post_show_'+ value.post_id +'" type="button" class="btn btn-basic status_button">Đã Hiển Thị</button>';
      }
      else{
        status = '<button style = "width: 100px;" id="post_hide_'+ value.post_id +'" type="button" class="btn btn-danger status_button">Đã Ẩn</button>';
      }

      action = '<a style = "color: white; text-decoration: none;" href="detail.php?record_id='+value.post_id+'&web_id='+value.web_id+'">'+
                  '<button style = "margin-left: 10px; width: 60px;" id = "info_post_'+ value.post_id +'" type="button" class="btn btn-info">Chi Tiết</button></a>';

      if(value.post_type_active == 0){
        post_type_status = '<span class="badge badge-danger">Vô Hiệu Hóa</span>';
      }

      stt ++;
      html += `<tr>
                  <th scope="row">`+stt+`</th>
                  <td><div><p style = 'word-wrap: break-word'>`+ value.post_title  +`</p></div></td>
                  <td><div><p style = 'word-wrap: break-word'>`+ value.post_description +`</p></div></td>
                  <td><div><p style = 'word-wrap: break-word'>`+ value.post_type_title + `</p></div>
                      <div style = 'margin-top: -10px'>` + post_type_status +`</div></td>
                  <td><div><p style = 'word-wrap: break-word'>`+ value.web_name +`</p></div></td>
                  <td>`+ status +`</td>
                  <td>`+ action +` </td>
              </tr>`;
  });
  $('tbody').html(html).ready(function(){
    IActiveButton();
  });
}

function postError(data){
  if(data.status == 404){
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
}