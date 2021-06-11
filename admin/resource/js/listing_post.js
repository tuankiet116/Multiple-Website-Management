$(document).ready(function(){
    $('.loader-container').css('display', 'flex');
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

    //Show Post 
    debugger;
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
    $('#post-status').niceSelect();
    $('#post-type-status').niceSelect();
});



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
  
    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", base_url + state.image);
  
    return $state;
} //End Of Function Website Select2

function checkdefault(default_value, check_parameter){
    if(check_parameter == null){
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

        if(value.post_title == null){
            value.post_title = "<p style = 'color: red'>NULL</p>";
        }

        if(value.description == null){
            value.description = "<p style = 'color: red'>NULL</p>";
        }

        if(value.post_type_title == null){
            value.post_type_title = "<p style = 'color: red'>NULL</p>";
        }

        if(value.web_name == null){
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
                    <td><div><p style = 'word-wrap: break-word'>`+ value.description +`</p></div></td>
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

function IActiveButton(){
  
  $('.status_button').on('click', function(){
    element = $(this).attr('id');
    id = element.split("_")[2];
    type = element.split("_")[1] == 'show'? 0:1;

    $('.loader-container').css('display', 'flex');
    data = {
      "post_id": id,
      "post_active": type
    }
    $.ajax({
      type: 'POST',
      dataType: 'JSON',
      data: JSON.stringify(data),
      async: false,
      url: "../../../api/Controller/ActiveInactivePost.php",
      success: function(data){
        if(data.code == 200){
          showAlert('success', data.message);
          
        }
        else{
          showAlert('error',data.code+": " +data.message);
        }
      },
      error: function(request, status, error){
        showAlert('error', request.responseText);
      }
    });

    ajaxSearchingPost(null);
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