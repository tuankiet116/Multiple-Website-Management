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

    
})




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
    if(check_parameter == null){
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