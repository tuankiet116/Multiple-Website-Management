var base_url = '../../../';
var web_id_create = null;
var product_gr_id = null;
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
        $('.loader-container').css('display', 'flex');
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
        url: base_url+"api/Controller/getProductgroupByWebId.php",
        async: false,
        data: JSON.stringify(data),
        success: function (res) {
          $('.loader-container').css('display', 'none');
          if(res?.code == 200){
            var viewsData =  res.result.map(function(productGroup){
              let result ='';
              result+= `<tr>`;
              result+= `
                          <td scope="row">${productGroup.product_gr_id}</td>
                          <td>${productGroup.product_gr_name}</td>
                          <td class="product-gr-description">${productGroup.product_gr_description}</td>`;
              if(productGroup.product_gr_active == 1){
                result+= `<td><button class="btn btn-success btn-show-hide" product_gr_active="${productGroup.product_gr_active}" product_gr_id="${productGroup.product_gr_id}">Đã Hiện Thị</button></td>`;
              }
              else{
                result+= `<td><button class="btn btn-danger btn-show-hide" product_gr_active="${productGroup.product_gr_active}" product_gr_id="${productGroup.product_gr_id}">Đã Ẩn</button></td>`;
              }
              result+=   `<td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal" product_gr_id="${productGroup.product_gr_id}">Xem Chi Tiết</button></td>`
              result+= `</tr>`;  
              return result;    
            })
          }
          else{
            var mes = `<tr style="background-color: white;">
                            <td colspan="5"><p style="color:red">${res?.message}</p></td>
                      </tr>`;
          }
          $('.table > tbody').html(viewsData ?? mes).ready(function(){
            tooltip();
            getProductGroupById();
            updateProductGroup();
            activeStatusProductGroup();
          })
        },
        error: function(res){
          console.log(res.responseText);
          $('.loader-container').css('display', 'none');
        }
    });
}

//  func get product group by id
function getProductGroupById(){
  $('.btn-edit').click(function(){
    product_gr_id = $(this).attr('product_gr_id')
    let data={
      "product_gr_id": $(this).attr('product_gr_id')
    }
    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/getProductGroupById.php",
      async: false,
      data: JSON.stringify(data),
      success: function (res) {
        $('#name-product-group-update').val(res?.result.product_gr_name);
        $('#description-product-group-update').val(res?.result.product_gr_description);
      },
      error: function(res){
        console.log(res.responseText);
      }
    });
  })
}

// func create product group
function createProductGroup(){
  $('#submit-add').click(function(){
    let data={
      "web_id":                 web_id_create,
      "product_gr_name":        $("#name-product-group").val(),
      "product_gr_description": $("#description-product-group").val()
    }
    $('.loader-container').css('display', 'flex');
    $.ajax({
      method: 'POST',
      url: base_url+"api/Controller/createProductGroup.php",
      async: false,
      data: JSON.stringify(data),
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res?.code == 200){
          showAlert('success', `<p>${res?.message}</p>`);
          $('#form')[0].reset();
          $('#close-addModal').click();
          // console.log(res);
        }
        else{
          showAlert('error', `<p>${res?.message}</p>`);
          // console.log(res);
        }
      },
      error: function(res){
        console.log(res.responseText);
      }
    });
    getProductGroup(web_id_create);
    return false;
  })
}

// func update product group
function updateProductGroup(){
  $('#submit-update').click(function(){
    let data ={
      "web_id":                 web_id_create,
      "product_gr_id":          product_gr_id,
      "product_gr_name":        $('#name-product-group-update').val(),
      "product_gr_description": $('#description-product-group-update').val()
    }
    $('.loader-container').css('display', 'flex');

    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/updateProductGroup.php",
      async: false,
      data: JSON.stringify(data),
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res?.code == 200){
          showAlert('success', `<p>${res?.message}</p>`);
          $('#close-updateModal').click();
        }
        else{
          showAlert('error', `<p>${res?.message}</p>`);
        }
      }
    });
    getProductGroup(web_id_create);

    return false;
  })
}

// func active status
function activeStatusProductGroup(){
  $('.btn-show-hide').click(function(){
    let data ={
      "product_gr_active": $(this).attr('product_gr_active') == "1"? "0": "1",
      "web_id": web_id_create,
      "product_gr_id": $(this).attr('product_gr_id')
    }
    $.ajax({
     method: "POST",
      url: base_url+"api/Controller/activeProductGroup.php",
      async: false,
      data: JSON.stringify(data),
      success: function (res) {
        console.log(res)
        if(res.code == 200){
          showAlert("success", `<p>${res.message}</p>`);
        }
        else {
          showAlert("error", `<p>${res.message}</p>`);
        }
      }
    });
    getProductGroup(web_id_create);
  })
}

// func handle tooltip
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