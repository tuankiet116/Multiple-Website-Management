var base_url ='../../../';
var policies_id_update = null
$(document).ready(function () {
    pickWebsiteSelect('.pick_website_select');

    $('.pick_website_select').on('select2:select',function () { 
      let web_id = $(this).select2('val');
      $('.pick_service_gr_select').removeAttr('disabled');
      $('.pick_service_gr_select').empty();
    });
    $('#service-status').niceSelect();

    //creat service
    $('#btn-submit-add').click(createPolicies);

    // load service
    getPolicies({term: "", policies_active: null});

    //search service
    // searchPolicies();
    $('#btn-search').click(searchPolicies);

    $('#btn-clear').click(function(){
      $('#text-search').val("");
      $('#service-status').val("#").niceSelect('update');
      $('.pick_website_select.search').empty();
      $('.pick_service_gr_select.search').attr('disabled', 'true');
      getPolicies({term: "", policies_active: null});
    })
    
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
});

function getPolicies(data){
  $.ajax({
    type: "POST",
    url: base_url+"api/Controller/getAllPolicies.php",
    data: JSON.stringify(data),
    async: false,
    dataType: "JSON",
    success: function (res) {
      if(res.code == 403){
        window.location.href = '../../error.php';
      }

      if(res.code == 200){
        var viewData = res?.result.map(function(item, index){
          let status = item.policies_active == 1 ? 
          `<button class="btn btn-success btn-status" policies_active="${item.policies_active}" policies_id="${item.policies_id}">Đã Hiện</button>` :
          `<button class="btn btn-danger btn-status" policies_active="${item.policies_active}"  policies_id="${item.policies_id}">Đã Ẩn</button>`

          return `
            <tr>
              <th scope="row">${index + 1}</th>
              <td>${item.policies_title}</td>
              <td class="service-description">${item.policies_description}</td>
              <td>${status}</td>
              <td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#form-update" policies_id="${item.policies_id}">Chi Tiết</button></td>
            </tr>`
        })

      }
      else{
        var mes = `<tr style="background-color: white;">
                        <td colspan="6"><p style="color:red; text-align: center">${res?.message}</p></td>
                   </tr>`; 
      }
      $('.table > tbody').html(viewData ?? mes).ready(function(){
        $('.btn-status').click(activeStatus)
        $('.btn-edit').click(getPoliciesById);
        $('#btn-submit-update').click(updatePolicies);
        tooltip('.service-description', 30);
      })
    }
  });
}

function createPolicies(){
  let data = {
    "policies_title":        $('#policies_title').val(),
    "policies_description":  $('#policies_description').val(),
    "policies_content":      CKEDITOR.instances.content_policies_add.getData(),
    "policies_image":        $('#image_icon_1').attr("src")
  }
  $('.loader-container').css('display', 'flex');
  
  $.ajax({
    method: "POST",
    url: base_url+"api/Controller/createPolicies.php",
    data: JSON.stringify(data),
    async: false,
    dataType: "JSON",
    success: function (res) {
      $('.loader-container').css('display', 'none');

      if(res.code == 403){
        window.location.href = '../../error.php';
      }

      if(res.code == 200){
        showAlert('success', `<p>${res.message}</p>`);
        $('#form')[0].reset();
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
  getPolicies({term: "", policies_active: null});
}

function getPoliciesById(){
  let data = {
    "policies_id": $(this).attr('policies_id'), 
  }
  policies_id_update = $(this).attr('policies_id')
  $.ajax({
    type: "POST",
    url: base_url+"api/Controller/getPoliciesById.php",
    data: JSON.stringify(data),
    async: false,
    dataType: "JSON",
    success: function (res) {
      if(res.code == 403){
        window.location.href = '../../error.php';
      }

      if(res.code == 200){
        $('#policies_title_update').val(res.result.policies_title);
        $('#policies_description_update').val(res.result.policies_description);
        CKEDITOR.instances.content_policies_update.setData(res.result.policies_content);
        if(res.result.policies_image!== null){
          setImageData(res.result.policies_image, "#image_icon_", 1);
        }
        else{
          $("#image_icon_1_update").attr("src", "#");
          $("#image_icon_1_update").css("display", "none");
          $("#input_image_icon_1_update").children("svg").css("display", "inherit");
        }
      }
      else {
        console.log(res?.message);
      }
    },
    error: function(res){
      console.log(res.responseText);
    }
  });
}

function updatePolicies(){
  let data = {
    "policies_title":        $('#policies_title_update').val(),
    "policies_description": $('#policies_description_update').val(),
    "policies_content":     CKEDITOR.instances.content_policies_update.getData(),
    "policies_id":          policies_id_update,
    "policies_image":       $('#image_icon_1_update').attr('src')   
  }
  console.log(data);
  $('.loader-container').css('display', 'flex');
  $.ajax({
    type: "POST",
    url: base_url+"api/Controller/updatePolicies.php",
    data: JSON.stringify(data),
    async: false,
    dataType: "JSON",
    success: function (res) {
      $('.loader-container').css('display', 'none');
      if(res.code == 403){
        window.location.href = '../../error.php';
      }

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
  getPolicies({term: "", policies_active: null});
}

function searchPolicies(){
  let data = {
    "term": $('#text-search').val().trim(),
    "policies_active": $('#service-status').val() == '1' || $('#service-status').val() == '0'?  $('#service-status').val() : null
  }
  getPolicies(data);
}

function activeStatus(){
  let data ={
    "policies_id":     $(this).attr('policies_id'),
    "policies_active": $(this).attr('policies_active') == "1" ? "0" : "1"
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
      if(res.code == 403){
        window.location.href = '../../error.php';
      }

      if(res.code == 200){
        showAlert('success', `<p>${res.message}</p>`);
      }
      else{
        showAlert('error', `<p>${res.message}</p>`);
      }
    },
    error: function(){
      $('.loader-container').css('display', 'none');
      console.log(res.responseText);
    }
  });
  getPolicies({term: "", policies_active: null});
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
          if(data.code == 403){
            window.location.href = '../../error.php';
          }
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
    // console.log(imgsSrc); //The url path of the displayed image can be directly assigned to the src attribute of img
    $(element).siblings("img").css("display", "block");
    $(element).siblings("svg").css("display", "none");
    $(element).siblings("img").attr("src", imgsSrc);
  };
};

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
