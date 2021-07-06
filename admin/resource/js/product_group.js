var base_url = '../../../';
var web_id_create = null;
$(document).ready(function () {
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

    $(".pick_website_select").change(function(){
        let web_id = $('.pick_website_select').select2('data')[0].id;
        web_id_create = web_id;
        getProductGroup(web_id);
        $('#btn-add').removeAttr('disabled');
    });

    $(".table > tbody").html(
      ` <tr style="background-color: white;">
            <td colspan="5"><p style="color:red">Vui lòng chọn website</p></td>
        </tr>`
    );

    // create product group
    createProductGroup();
});

// func get product group
function getProductGroup(web_id){
  let data = {
    "web_id": web_id
  }
    $.ajax({
        method: 'POST',
        url: base_url+"api/Controller/getProductgroupById.php",
        async: true,
        data: JSON.stringify(data),
        success: function (res) {
          console.log(res);
          var viewsData =  res.map(function(productGroup){
              let result ='';
              result+= `<tr>`;
              result+= `
                          <td scope="row">${productGroup.product_gr_id}</td>
                          <td>${productGroup.product_gr_name}</td>
                          <td class="product-gr-description">${productGroup.product_gr_description}</td>`;
              if(productGroup.product_gr_active == 1){
                result+= `<td><button class="btn btn-success btn-show-hide">Đã Hiện Thị</button></td>`;
              }
              else{
                result+= `<td><button class="btn btn-danger btn-show-hide">Đã Ẩn</button></td>`;
              }
              result+=   `<td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal">Sửa</button></td>`
              result+= `</tr>`;  
              return result;    
          })
          $('.table > tbody').html(viewsData).ready(function(){
            tooltip();
          })
        },
        error: function(res){
          console.log(res.responseText);
        }
    });
}

// func create product group
function createProductGroup(){
  $('#submit-add').click(function(){
    let data={
      "web_id":                 web_id_create,
      "product_gr_name":        $("#name-product-group").val(),
      "product_gr_description": $("#description-product-group").val()
    }
    $.ajax({
      method: 'POST',
      url: base_url+"api/Controller/createProductGroup.php",
      data: JSON.stringify(data),
      success: function (res) {
        if(res?.code == 200){
          
        }
        web_id_create = null;
      },
      error: function(res){
        console.log(res.responseText);
        web_id_create = null;
      }
    });
    // console.log(data);
    return false;
  })
}

// handle tooltip
function tooltip(){
  let description = $('.product-gr-description');
  $.each(description, function () { 
    if($(this).text().length > 40){
      var stringOriginal = $(this).text();
      var subString = $(this).text().substring(0, 40) + '...';
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