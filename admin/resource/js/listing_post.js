
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
            "web_id": $('.pick_website_select').select2('val'),
            "term"  : $('#searching').val().trim()
        }

        ajaxSearchingPost(data);
    });
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
        success: function(data){
            postSuccess(data);
        },
        error: function(data){
            postError(data);
        }
    });
}

function postSuccess(data){
    html = "";
    stt = 0;
    data.forEach(function(value, key){
        action = '';

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
          status = '<button style = "width: 100px;" id="post_'+ value.post_id +'" type="button" class="btn btn-success status_button">Đã Hiển Thị</button>';
          IActiveButton(0, '#post_'+ value.post_id);
        }
        else{
          status = '<button style = "width: 100px;" id="post_'+ value.post_id +'" type="button" class="btn btn-danger status_button">Đã Ẩn</button>';
          IActiveButton(1, '#post_'+ value.post_id);
        }

        action = '<a style = "color: white; text-decoration: none;" href="detail.php?record_id='+value.post_id+'&web_id='+value.web_id+'">'+
                    '<button style = "margin-left: 10px; width: 60px;" id = "info_post_'+ value.post_id +'" type="button" class="btn btn-info">Chi Tiết</button></a>';

        stt ++;
        html += `<tr>
                    <th scope="row">`+stt+`</th>
                    <td>`+ value.post_title  +`</td>
                    <td>`+ value.description +`</td>
                    <td>`+ value.post_type_title +`</td>
                    <td>`+ value.web_name +`</td>
                    <td>`+ status +`</td>
                    <td>`+ action +` </td>
                </tr>`
    });
    $('tbody').html(html);
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

function IActiveButton(post_active, element){
  $(element).on('click', function(){
    $('.loader-container').css('display', 'flex');
    data = {
      "post_id": post_id,
      "post_active": post_active
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
          ajaxSearchingPost(null);
        }
        else{
          showAlert('error',data.code+": " +data.message);
        }
      },
      error: function(request, status, error){
        showAlert('error', request.responseText);
      }
    });
  });
}