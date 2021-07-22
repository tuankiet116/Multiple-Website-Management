var base_url ='../../../';
var service_gr_id_update = null;
var service_id_update = null
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

    //creat service
    createService();

    // load service
    getService({term: "", service_gr_id: null, service_active: null});

    //search service
    searchService();
    
    $(".input-image-container i").on("click", function (e) {
      var image_element = $(this).siblings(".input-image").find("img");
      var id_image = "#" + image_element.attr("id");
      $(id_image).attr("src", "#");
      $(id_image).css("display", "none");
      $(id_image).siblings("svg").css("display", "block");
    });

    $(".input-image-container i").hover(function (e) {
      $(this).css("display", "block");
    });
  
    $(".input-image-container i").mouseout(function (e) {
      $(this).css("display", "none");
    });

    $(".input-image").on("click", function (e) {
      var id = $(this).attr("id");
      id = id.replace("input_image_", "");
      id = "input_" + id;
      $("#" + id)[0].click();
  
      $("#" + id).change(function (e) {
        exGetImg(e.target, "#" + id);
        $("#submit_configuation").attr("disabled", false);
      });
    });
    
    $(".input-image img").hover(function (e) {
      $(this).closest("div").siblings("i").css("display", "block");
    });
  
    $(".input-image img").mouseout(function (e) {
      $(this).closest("div").siblings("i").css("display", "none");
    });
  
    $(".categories-add").on("click", function () {
      $(".categories-container-form").show();
    });

    $("#form-update, #close-form-update").on("click", function () {
      $("#image_icon_1_update").attr("src", "#");
      $("#image_icon_1_update").css("display", "none");
      $("#input_image_icon_1_update").children("svg").css("display", "inherit");
    })
});

function getService(data){
  $.ajax({
    type: "POST",
    url: base_url+"api/Controller/getAllService.php",
    data: JSON.stringify(data),
    async: false,
    dataType: "JSON",
    success: function (res) {
      if(res.code == 200){
        var viewData = res?.result.map(function(item, index){
          let status = item.service_active == 1 ? 
          `<button class="btn btn-success btn-status" sv_active="${item.service_active}" sv_id="${item.service_id}" sv_gr_id="${item.service_gr_id}">Đã Hiện</button>` :
          `<button class="btn btn-danger btn-status" sv_active="${item.service_active}"  sv_id="${item.service_id}" sv_gr_id="${item.service_gr_id}">Đã Ẩn</button>`

          return `
            <tr>
              <th scope="row">${index + 1}</th>
              <td>${item.service_name}</td>
              <td class="service-description">${item.service_description}</td>
              <td>${item.service_gr_name}</td>
              <td>${status}</td>
              <td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#form-update" sv_id="${item.service_id}" sv_gr_id="${item.service_gr_id}">Chi Tiết</button></td>
            </tr>`
        })

      }
      else{
        var mes = `<tr style="background-color: white;">
                        <td colspan="6"><p style="color:red; text-align: center">${res?.message}</p></td>
                   </tr>`; 
      }
      $('.table > tbody').html(viewData ?? mes).ready(function(){
        activeStatus();
        getServiceById();
        tooltip('.service-description', 30);
        updateService();
        
      })
    }
  });
}

function createService(){
  $('#btn-submit-add').click(function(){
    let data = {
      "service_name":         $('#service_name').val(),
      "service_description":  $('#service_description').val(),
      "service_content":      CKEDITOR.instances.content_service_add.getData(),
      "service_gr_id":        $('.pick_service_gr_select.add').select2('val'),
      "service_image":        $('#image_icon_1').attr("src")
    }

    $('.loader-container').css('display', 'flex');
    
    $.ajax({
      method: "POST",
      url: base_url+"api/Controller/createService.php",
      data: JSON.stringify(data),
      async: false,
      dataType: "JSON",
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res.code == 200){
          showAlert('success', `<p>${res.message}</p>`);
          $('#form')[0].reset();
          $('.pick_service_gr_select.add').empty();
          $('.pick_service_gr_select.add').attr('disabled','true');
          $('.pick_website_select.add').empty();
          $("#image_icon_1").attr("src", "#");
          $("#image_icon_1").css("display", "none");
          $("#input_image_icon_1").children("svg").css("display", "inherit");
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
    getService({term: "", service_gr_id: null, service_active: null});
  });

}

function getServiceById(){
  $('.btn-edit').click(function(){
    let data = {
        "service_id": $(this).attr('sv_id'),
        "service_gr_id": $(this).attr('sv_gr_id')
    }
    service_gr_id_update = $(this).attr('sv_gr_id');
    service_id_update    = $(this).attr('sv_id')
    $.ajax({
      type: "POST",
      url: base_url+"api/Controller/getServiceById.php",
      data: JSON.stringify(data),
      async: false,
      dataType: "JSON",
      success: function (res) {
        if(res.code == 200){
          $('#service_name_update').val(res.result.service_name);
          $('#service_description_update').val(res.result.service_description);
          CKEDITOR.instances.content_service_update.setData(res.result.service_content);
          setImageData(res.result.service_image, "#image_icon_", 1);
        }
        else {
          console.log(res?.message);
        }
      },
      error: function(res){
        console.log(res.responseText);
      }
    });
  })
}

function updateService(){
  $('#btn-submit-update').click(function(){
    let data = {
      "service_name":        $('#service_name_update').val(),
      "service_description": $('#service_description_update').val(),
      "service_content":     CKEDITOR.instances.content_service_update.getData(),
      "service_gr_id":       service_gr_id_update,
      "service_id":          service_id_update,
      "service_image":       $('#image_icon_1_update').attr('src')   
    }
    // console.log(data);
    $('.loader-container').css('display', 'flex');
    $.ajax({
      type: "POST",
      url: base_url+"api/Controller/updateService.php",
      data: JSON.stringify(data),
      async: false,
      dataType: "JSON",
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res.code == 200){
          showAlert('success', `<p>${res.message}</p>`);
          $('#close-form-update').click();
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
    getService({term: "", service_gr_id: null, service_active: null});
  })
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

function activeStatus(){
  $('.btn-status').click(function(){
    let data ={
      "service_id":     $(this).attr('sv_id'),
      "service_gr_id":  $(this).attr('sv_gr_id'),
      "service_active": $(this).attr('sv_active') == "1" ? "0" : "1"
    }
    console.log(data)
    $('.loader-container').css('display', 'flex');

    $.ajax({
      type: "POST",
      url: base_url+"api/Controller/activeService.php",
      data: JSON.stringify(data),
      async:false,
      dataType: "JSON",
      success: function (res) {
        $('.loader-container').css('display', 'none');
        if(res.code == 200){
          showAlert('success', `<p>${res.message}</p>`);
        }
        else{
          showAlert('success', `<p>${res.message}</p>`);
        }
      },
      error: function(){
        $('.loader-container').css('display', 'none');
        console.log(res.responseText);
      }
    });
    getService({term: "", service_gr_id: null, service_active: null});
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


var exGetImg = function (extag, element) {
  var file = extag.files[0]; //The first file of the selected file (as a fixed format)
  var readers = new FileReader(); //Create a new file reading object to change the path
  var filename;
  readers.readAsDataURL(file); //Convert the read file path to a url type
  readers.onload = function () {
    //Call onload() method after conversion
    var imgsSrc = this.result; //After the image address is read out, the result result is DataURL //this.result is the URL path of the image conversion
    console.log(imgsSrc); //The url path of the displayed image can be directly assigned to the src attribute of img
    $(element).siblings("img").css("display", "block");
    $(element).siblings("svg").css("display", "none");
    $(element).siblings("img").attr("src", imgsSrc);
  };
};

//set default image which null value
function checkdefault(default_value, check_parameter) {
  if (check_parameter == null || check_parameter == "") {
    return default_value;
  }
  return check_parameter;
}

function setImageData(data, element, max = 0) {
  if (data && element) {
    if (max != 0) {
      var data_arr = data.split(",");
      if (data_arr.length <= 5) {
        var i = 1;
        data_arr.forEach(function (value, key) {
          value = value.trim();
          key = key + 1;
          $(element + key + "_update").attr("src", base_url + value);
          $(element + key + "_update")
            .siblings("svg")
            .css("display", "none");
          $(element + key + "_update").css("display", "block");
        });
      }
    } else {
      $(element).attr("src", base_url + data);
      $(element).siblings("svg").css("display", "none");
      $(element).css("display", "block");
    }
  }
}
