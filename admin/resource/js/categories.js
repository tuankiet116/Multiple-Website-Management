var base_url = '../../../';
$(document).ready(function () {
  //Select2 For Pick Website
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

  $('.pick_website_select').on('change', function(){
    let web_id = $('.pick_website_select').select2('data')[0].id;
    var data = {
      "web_id": web_id
    }
    $.ajax({
      url: base_url + 'api/Controller/getCategories.php',
      method: 'POST',
      data: JSON.stringify(data),
      success: function(data){
        if(data.code == 404){
          var err = `<p class="mess-err">chưa có danh mục nào!!</p>`;
        }
        else{
          var cate_child =[];
          var cate_parent = [];
          data.forEach((e)=>{
            if(e.cmp_parent_id !=null){
              cate_child.push(e);
            }
            else if(e.cmp_parent_id == null){
              cate_parent.push(e);
            }
          })

          var allCate = cate_parent.map((p)=>{
            var rs =``;
            rs +=`<div class="categories-item">`;
            rs +=` <div class="categories-parent-item">
                      <p>${p.cmp_name}</p>
                      <i class="fas fa-chevron-down"></i>
                  </div>`;
                  cate_child.forEach((c)=>{
                    if(c.cmp_parent_id == p.cmp_id){
                      rs += `
                      <div class="wapper-categories-child">
                          <div class="categories-child-item">
                              <div>
                                  <p>${c.cmp_name}</p>
                              </div>
                          </div>
                      </div>
                      `;
                    }
                  })
            rs +=`</div>`;
            return rs;
          })

          var cateHasChild = data.map((e)=>{
              if(e.cmp_has_child==1){
                return`
                  <option value="${e.cmp_id}">${e.cmp_name}</option>
                `;
              }
          })
        }

        $('#cmp_parent_id').html(cateHasChild);
        $('.categories-content').html(allCate ?? err);

        $('.categories-parent-item').on('click', function(){
          $(this).siblings('.wapper-categories-child').toggle();
          $(this).children('i').toggleClass('rotage');
        });
        
        $('.categories-child-item > div > p').on('click', function(){
            $(this).siblings('.categories-child-item > div > div').slideToggle();
        });

        var toggleDisabled = $('.disabled').removeAttr('disabled');
      }
    });
  });


  // console.log($("input[name='test']:checked"));
  // var arr =[];
  // $("input[name='test']:checked").each(function(){
  //   arr.push($(this).val());
  // });
  // console.log(arr.join(","));
  
});



//Make Information Image Get The FUCK Out Of Chrome Security And Change Data To Base64
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