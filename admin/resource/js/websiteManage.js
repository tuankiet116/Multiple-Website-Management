var base_url = '../../../';
var web_id = '';
$(document).ready(function(){
    $(".input-image-container i").on('click',function(e){
        var image_element = $(this).siblings('.input-image').find('img');
        var id_image = "#" + image_element.attr('id');
        $(id_image).attr('src', '#');
        $(id_image).css('display', 'none');
        $(id_image).siblings('svg').css('display', 'block');
    });
  
    $(".input-image-container i").hover(function(e){
        $(this).css("display", "block");
    });
    
    $(".input-image-container i").mouseout(function(e){
        $(this).css("display", "none");
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
  
    $(".input-image img").hover(function(e){
      $(this).closest("div").siblings("i").css("display", "block");
    });
  
    $(".input-image img").mouseout(function(e){
      $(this).closest("div").siblings("i").css("display", "none");
    });
  
    $('.categories-add').on('click', function(){
      $('.categories-container-form').show();
    });

    //call api and render
    getDataTable(); 
    
    //create
    create();

    // reset form
    $('#show-modal-form-update').on('hidden.bs.modal', function(){
        $('#form-update')[0].reset();
        $('#image_icon_1_update').attr('src', "#");
        $('#image_icon_1_update').css('display', 'none');
        $('#input_image_icon_1_update').children('svg').css('display', 'inherit');
    })
})

// api get Data of table
function getDataTable(){
  $.ajax({
    url: base_url+"api/Controller/getAllWebsite.php",
    method: "POST",
    async: false,
    success: function (res){
      var view = res.map((e, index)=>{
        var checkIcon = checkdefault("data/web_icon/icon_default/default.png", e.web_icon);
        rs =``;
        rs += `<tr>`;
        rs += `
                <td>${index + 1}</td>
                <td><p class="web_name">${e.web_name}</p></td>
                <td><p class="web_url">${e.domain_name_list}</p></td>
                <td><img src="${base_url}${checkIcon}" alt="icon" class="icon-website"></td>
                <td><p class="web_description">${e.web_description}</p></td>
              `
              if(e.web_active ==1){
                rs += `<td><button class="btn btn-success btn-show-hide" status="${e.web_active}" w_id="${e.web_id}">Đang Hiển Thị</button></td>`;
              }
              else{
                rs += `<td><button class="btn btn-danger btn-show-hide" status="${e.web_active}" w_id="${e.web_id}">Đã Ẩn</button></td>`
              }
        rs += ` <td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#show-modal-form-update" w_id="${e.web_id}">Sửa</button></td>`      
        rs += `</tr>`;
        return rs;
      });
      $('.table > tbody').html(view).ready(function(){
        activeWeb();
        getWebsiteByID();
        update();
        $('.web_description').each(function(){
          if($(this).text().length > 40){
            var stringOriginal = $(this).text();
            var subString = $(this).text().substring(0, 40) + '...';
            $(this).text(subString);
            $(this).attr('title', stringOriginal);
          }
        })
      });
    },
    error: function(res){
      console.log(res.responseText);
    }
  });
}

function create(){
  $('#submit').click(function(){
    var data = dataFormCreate();
    $('.loader-container').css('display', 'flex');

    $.ajax({
      url: base_url+'api/Controller/createWebsite.php',
      method: 'POST',
      async: false,
      data: JSON.stringify(data),
      success: function(res){
        if(res?.code ==200){
          $('.loader-container').css('display', 'none');
          showAlert('success', `<p>${res?.message}</p>`);
          $('#form')[0].reset();
          $('#image_icon_1').attr('src', "#");
          $('#image_icon_1').css('display', 'none');
          $('#input_image_icon_1').children('svg').css('display', 'inherit');
          $('.close-form-create').click();
        }
        else {
          $('.loader-container').css('display', 'none');
          showAlert('error', `<p>${res?.message}</p>`);
        }
      },
      error: function(res){
        console.log(res.responseText);
      }
    })
    getDataTable();
    return false;
  })
}

function update(){
  $('#submit-update').click(function(){
    var data = dataFormUpdate();
    $('.loader-container').css('display', 'flex');

    $.ajax({
      url: base_url+'api/Controller/updateWebsite.php',
      method: 'POST',
      async: false,
      data: JSON.stringify(data),
      success :function(res){
        if(res?.code == 200){
          $('.loader-container').css('display', 'none');
          showAlert('success', `<p>${res?.message}</p>`);
          $('.close-form-update').click();
        }
        else {
          $('.loader-container').css('display', 'none');
          showAlert('error', `<p>${res?.message}</p>`);
        }
      },
      error: function(res){
        console.log(res.responseText);
      }
    })
    getDataTable();
    return false;
  })
}

// toggle status
function activeWeb(){
  $('.btn-show-hide').click(function(){
    var data ={
      "web_active": $(this).attr('status') == "1"? "0": "1",
      "web_id"    : $(this).attr('w_id')
    }
    $.ajax({
      url: base_url+'api/Controller/activeWebsite.php',
      method: 'POST',
      async: false,
      data: JSON.stringify(data),
      success: function(res){
        if(res?.code==200){
          showAlert("success", `<p>${res.message}</p>`);
        }
        else {
          showAlert("error", `<p>${res.message}</p>`);
        }
      },
      error: function(res){
        console.log(res.responseText);
      }
    })
    getDataTable();
  })
}

function getWebsiteByID(){
  $('.btn-edit').click(function(){
    web_id = $(this).attr('w_id');
    var data = {
      "web_id": $(this).attr('w_id')
    }
    $.ajax({
      url: base_url+ 'api/Controller/getWebsiteByID.php',
      method: 'POST',
      data: JSON.stringify(data),
      success: function(res){
        renderDataFormUpdate(res);
      }
    })
  })
}

function renderDataFormUpdate(data){
  $('#web_name_update').val(data.web_name);
  $('#web_url_update').val(data.web_url);
  setImageData(data.web_icon, '#image_icon_', 1);
  $('#web_description_update').val(data.web_description);
}

function dataFormCreate(){
  return data ={
    "web_name":        $('#web_name').val(),
    "web_url":         $('#web_url').val(),
    "web_icon":        $('#image_icon_1').attr('src'),
    "web_description": $('#web_description').val()
  }
}

function dataFormUpdate(){
  return data ={
    "web_id":          web_id,
    "web_name":        $('#web_name_update').val(),
    "web_url":         $('#web_url_update').val(),
    "web_icon":        $('#image_icon_1_update').attr('src'),
    "web_description": $('#web_description_update').val()
  }
}


var exGetImg = function(extag, element) {
    var file = extag.files[0]; //The first file of the selected file (as a fixed format)
    var readers = new FileReader(); //Create a new file reading object to change the path
    var filename;
    readers.readAsDataURL(file); //Convert the read file path to a url type    
    readers.onload = function() {//Call onload() method after conversion
            var imgsSrc = this.result; //After the image address is read out, the result result is DataURL //this.result is the URL path of the image conversion
            console.log(imgsSrc); //The url path of the displayed image can be directly assigned to the src attribute of img
            $(element).siblings('img').css('display', 'block');
            $(element).siblings('svg').css('display', 'none');
            $(element).siblings('img').attr('src', imgsSrc);    
    }
}

  //set default image which null value
function checkdefault(default_value, check_parameter){
    if(check_parameter == null || check_parameter==""){
        return default_value;
    }
    return check_parameter;
}

function setImageData(data, element, max=0){
    if(data && element){
      if(max != 0){
        var data_arr = data.split(",");
        if(data_arr.length<=5){
          var i = 1;
          data_arr.forEach(function(value, key){
            value = value.trim();
            key = key+1;
            $(element + key +'_update').attr("src", base_url + value);
            $(element + key +'_update').siblings('svg').css('display', 'none');
            $(element + key +'_update').css('display', 'block');
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