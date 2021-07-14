var base_url = '../../../';
var web_id   = null;
var sv_gr_id = null;
$(document).ready(function () {
  pickWebsiteSelect(".pick_website_select");
  pickWebsiteSelect(".pick_website_select_add");
    
  $('.pick_website_select').change(function () { 
    let web_id = $('.pick_website_select').select2('data')[0].id;
    // console.log(web_id);
    getServiceGroup(web_id, true);
  });
  getServiceGroup();
  createServiceGroup();
});

// func get service group
function getServiceGroup(web_id = null, checkWebId = false){
  let urlApi = 'getAllServiceGroup';
  let data = null;
  if( checkWebId == true && web_id != null){
    data = {
      "web_id": web_id
    }
    urlApi = 'getServiceGroupByWebID';
  }

  $.ajax({
    method: "POST",
    url: base_url+"api/Controller/"+urlApi+".php",
    data: JSON.stringify(data),
    async: false,
    dataType: "JSON",
    success: function (res) {
      if(res.code == 200){
        var viewData = res?.result.map(function(item, index){
          let status = item.service_gr_active == 1 ? 
          `<button class="btn btn-success btn-show-hide" sv_gr_id="${item.service_gr_id}" web_id="${item.web_id}" sv_gr_active=${item.service_gr_active}>Đã Hiện Thị</button>` :
          `<button class="btn btn-danger btn-show-hide" sv_gr_id="${item.service_gr_id}" web_id="${item.web_id}" sv_gr_active=${item.service_gr_active}>Đã Ẩn</button>`; 
          return `
              <tr>
                <td scope="row">${index + 1}</td>
                <td>${item.service_gr_name}</td>
                <td class="service-gr-description">${item.service_gr_description}</td>
                <td>${item.web_name}</td>
                <td>${status}</td>
                <td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal" sv_gr_id="${item.service_gr_id}" web_id="${item.web_id}">Chi tiết</button></td>
              </tr>
          `;
        })
      }
      else{
        var mes = `<tr style="background-color: white;">
                        <td colspan="6"><p style="color:red">${res?.message}</p></td>
                   </tr>`;
      }
      $('.table > tbody').html(viewData ?? mes).ready(function(){
          tooltip('.service-gr-description', 30);
          activeStatus();
          getServiceGroupById();
          updateServiceGroup();
      })
    },
    error: function(res){
      console.log(res.responseText);
    }
  });
}

// func create service
function createServiceGroup(){
  $('#submit-add').click(function(){
    $('.loader-container').css('display', 'flex');

    let data ={
      "service_gr_name":           $('#name-service-group').val(),
      "service_gr_description":    $('#description-service-group').val(),
      "web_id":                    $('.pick_website_select_add').select2('val')
    }
    // console.log(data)
    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/createServiceGroup.php",
      data: JSON.stringify(data),
      dataType: "JSON",
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res.code == 200){
          showAlert('success', `<p>${res?.message}</p>`);
          $('#form')[0].reset();
          $('#close-addModal').click();
        }
        else{
          showAlert('error', `<p>${res?.message}</p>`);
        }
      },
      error: function(res){
        console.log(res.responseText);
        $('.loader-container').css('display', 'none');
      }
    });
    return false;
  })
}

// func active status
function activeStatus(){
  $('.btn-show-hide').click(function(){
    let data={
      "web_id":            $(this).attr('web_id'),
      "service_gr_active": $(this).attr('sv_gr_active') == 1 ? "0" : "1",
      "service_gr_id":     $(this).attr('sv_gr_id')
    }
    $('.loader-container').css('display', 'flex');

    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/activeServiceGroup.php",
      data: JSON.stringify(data),
      async: false,
      dataType: "JSON",
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res.code == 200){
          showAlert('success', `<p>${res?.message}</p>`);
          $('.pick_website_select').empty();
        }else{
          showAlert('success', `<p>${res?.message}</p>`);
        }
      },
      error: function(res){
        $('.loader-container').css('display', 'none');
        console.log(res.responseText);
      }
    });
    getServiceGroup();
    
  })
}

//func get service group bu Id
function getServiceGroupById(){
  $('.btn-edit').click(function(){
    sv_gr_id = $(this).attr('sv_gr_id');
    web_id =   $(this).attr('web_id');
    let data = {
      "service_gr_id": $(this).attr('sv_gr_id')
    }
    console.log(data);
    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/getServiceGroupById.php",
      data: JSON.stringify(data),
      dataType: "JSON",
      success: function (res) {
        if(res.code ==200){
          $('#name-service-group-update').val(res.result.service_gr_name);
          $('#description-service-group-update').val(res.result.service_gr_description);
        }
        else{
          showAlert('error', `<p>${res?.message}</p>`);
        }
      },
      error: function(res){
        console.log(res.responseText);
      }
    });
    
  });
}

// func update service group
function updateServiceGroup(){
  $('#submit-update').click(function(){
    let data ={
      "web_id" :                web_id,
      "service_gr_id":          sv_gr_id,
      "service_gr_name":        $('#name-service-group-update').val(),
      "service_gr_description": $('#description-service-group-update').val()
    }
    $('.loader-container').css('display', 'flex');
    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/updateServiceGroup.php",
      data: JSON.stringify(data),
      dataType: "JSON",
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res.code == 200){
          showAlert('success', `<p>${res?.message}</p>`);
          $('#close-updateModal').click();
          $('.pick_website_select').empty();
          getServiceGroup();
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
    return false;
  });
}

// pick website select2
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

// func handle tooltip
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