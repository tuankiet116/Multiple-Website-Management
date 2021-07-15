var base_url ='../../../';

$(document).ready(function () {
    pickWebsiteSelect('.pick_website_select');

    $('.pick_website_select').on('select2:select',function () { 
      let web_id = $(this).select2('val');
      $('.pick_service_gr_select').removeAttr('disabled');
      $('.pick_service_gr_select').empty();
      pickServiceGroupSelect('.pick_service_gr_select', web_id);
    });
    pickServiceGroupSelect('.pick_service_gr_select');
    $('#service-status').niceSelect();

    // $('.pick_website_select.add').change(function(){
    //   console.log($('.pick_website_select.add').select2('data')[0].id)
    // })

    //creat service
    createService();

    // load service
    getService({term: "", service_gr_id: null, service_active: null});

    //search service
    searchService();

});

function createService(){
  $('#btn-submit-add').click(function(){
    let data = {
      "service_name":         $('#service_name').val(),
      "service_description":  $('#service_description').val(),
      "service_content":      CKEDITOR.instances.content_service_add.getData(),
      "service_gr_id":        $('.pick_service_gr_select.add').select2('val')
    }

    $('.loader-container').css('display', 'flex');
    
    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/createService.php",
      data: JSON.stringify(data),
      dataType: "JSON",
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res.code == 200){
          showAlert('success', `<p>${res.message}</p>`);
          $('#form')[0].reset();
          $('#close-form-add').click();
        }
        else{
          showAlert('error', `<p>${res?.message}</p>`);
        }
      },
      error: function(res){
        $('.loader-container').css('display', 'none');
        console.log(res.responseText);
      }
    });
  });

}

function getService(data){
  $.ajax({
    type: "POST",
    url: base_url+"api/Controller/getAllService.php",
    data: JSON.stringify(data),
    dataType: "JSON",
    success: function (res) {
      if(res.code == 200){
        var viewData = res?.result.map(function(item, index){
          let status = item.service_active == 1 ? 
          `<button class="btn btn-success btn-status" sv_active="${item.service_active}">Đã Hiện</button>` :
          `<button class="btn btn-danger btn-status" sv_active="${item.service_active}">Đã Ẩn</button>`

          return `
            <tr>
              <th scope="row">${index + 1}</th>
              <td>${item.service_name}</td>
              <td>${item.service_description}</td>
              <td>${item.service_gr_name}</td>
              <td>${status}</td>
              <td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#form-update" sv_id="${item.service_id}">Chi Tiết</button></td>
            </tr>`
        })

      }
      else{
        var mes = `<tr style="background-color: white;">
                        <td colspan="6"><p style="color:red; text-align: center">${res?.message}</p></td>
                   </tr>`; 
      }
      $('.table > tbody').html(viewData ?? mes).ready(function(){

      })
    }
  });
}

function searchService(){
  $('#btn-search').click(function(){
    let data = {
      "term": $('#text-search').val().trim(),
      "service_gr_id":  $('.pick_service_gr_select.search').select2('val'),
      "service_active": $('#service-status').val() == '1' || $('#service-status').val() == '0'?  $('#service-status').val() : null
    }
    getService(data);
  });

  $('#btn-clear').click(function(){
    $('#text-search').val("");
    $('.pick_service_gr_select.search').empty();
    $('#service-status').val("#").niceSelect('update');
    $('.pick_website_select.search').empty();
    $('.pick_service_gr_select.search').attr('disabled', 'true');

  })
}

function pickWebsiteSelect(element){
    $(element).select2({
      ajax: { 
        url: "../../../api/Controller/searchTerm.php",
        type: "POST",
        dataType: 'json',
        async: false,
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
}

function pickServiceGroupSelect(element, web_id){
    $(element).select2({
        ajax: { 
            url: base_url+"api/Controller/serachTermServiceGroup.php",
            type: "POST",
            dataType: 'json',
            async: false,
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
              // console.log(JSON.stringify(obj));
              return JSON.stringify(obj);
            },
            processResults: function (data, params) {
              return {
                  results: $.map(data.result, function (item) {
                      return {
                          text: item.service_gr_name,
                          id: item.service_gr_id,
                      };
                  })
              };
            },
            cache: false
        },
        placeholder: 'Search for a Service Group',
        minimumInputLength: 0,
    })
}

function tooltip(element, maxLength){
    let description = $(element);
    $.each(description, function () { 
        if($(this).text().length > maxLength){
        var stringOriginal = $(this).text();
        var subString = $(this).text().substring(0, maxLength) + '...';
        $(this).text(subString);
        $(this).attr('title', stringOriginal);
        }
    });
}
  
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
    if(check_parameter == null || check_parameter==""){
    return default_value;
    }
    return check_parameter;
}
  
  // show alert
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