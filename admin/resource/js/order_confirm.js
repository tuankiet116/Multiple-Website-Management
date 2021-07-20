var base_url = '../../../';

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
        let web_id = $(this).select2('val');
        getOrder(true, web_id);
    })
    getOrder(false, null, "");
    searchTerm();
});

function getOrder(web_id = false, valueWebSite=null, term){
    let data = {
        "term": term
    };
    let urlApi = "getAllOrder";
    if(web_id == true && valueWebSite != null){
        data={
            "web_id": valueWebSite,
            "term": term
        }
        urlApi = "getOrderByWebId";
    }
    $.ajax({
        type: "POST",
        url: base_url+"api/Controller/"+urlApi+".php",
        data: JSON.stringify(data),
        dataType: "JSON",
        async: false,
        success: function (res) {
            if(res.code == 200){
                var viewData = res?.result.map(function(item, index){
                    let order_status = item.order_status == 1? `<p style="color: red">Chưa Xác Nhận <i class="fas fa-times"></i></p>`: ``;
                    let order_payment = '';
                    let notSp = `Null`

                    if(item.order_payment == 1){
                        order_payment = `COD`;
                    }
                    else if(item.order_payment == 2){
                        order_payment = `MOMO`;
                    }
                    else{
                        order_payment = `Khác`;
                    }
                    return`
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${item.order_id}</td>
                            <td>${item.product_name}</td>
                            <td>${item.user_name}</td>
                            <td>${item.user_number_phone}</td>
                            <td>${order_payment}</td>
                            <td>${item.order_trans_id ?? notSp}</td>
                            <td>${item.web_name}</td>
                            <td>${item.order_sum_price}</td>
                            <td>${order_status}</td>
                            <td>
                                <button class="btn btn-primary btn-detail" order_id="${item.order_id}" data-toggle="modal" data-target="#show-modal-detail">Chi Tiết</button>
                            </td>
                        </tr>
                    `
                });
            }
            else{
                var mes = `<tr style="background-color: white;">
                             <td colspan="11"><p style="color:red; text-align: center">${res?.message}</p></td>
                           </tr>`; 
            }
            $('.table > tbody').html(viewData ?? mes).ready(function(){
                getOrderById();
            });
        }
    });
}

function getOrderById(){
    $('.btn-detail').click(function () { 
        let data = {
            "order_id": $(this).attr('order_id')
        } 
        $.ajax({
            type: "POSR",
            url: base_url+"api/Controller/getOrderById.php",
            data: JSON.stringify(data),
            dataType: "JSON",
            success: function (res) {
                console.log(res);
                valueDetail(res);
            }
        });
    });
}

function searchTerm(){
    $('#btn-search').click(function(){
        let term = $('#order_search').val();
        getOrder(false, null, term);
    })
}

function valueDetail(data){
    let order_payment = '';
    if(data.result.order_payment == 1){
        order_payment ='COD';
    }
    else if(data.result.order_payment == 2){
        order_payment ='MOMO';
    }
    else{
        order_payment ='Khác';
    }
    $('#order_id').text(data.result.order_id);
    $('#user_name').text(data.result.user_name);
    $('#product_name').text(data.result.product_name);
    $('#order_detail_quantity').text(data.result.order_detail_quantity);
    $('#order_payment_status').text(data.result.order_payment_status);
    $('#order_payment').text(order_payment);
    $('#web_name').text(data.result.web_name);
    $('#order_request_id').text(data.result.order_request_id);
    $('#order_trans_id').text(data.result.order_trans_id);
    $('#order_sum_price').text(data.result.order_sum_price);
    $('#order_paytype').text(data.result.order_paytype);
    $('#order_datetime').text(data.result.order_datetime);
    $('#order_status').text(data.result.order_status);
    $('#order_detail_unit_price').text(data.result.order_detail_unit_price);
    $('#order_detail_amount').text(data.result.order_detail_amount);
    $('#user_number_phone').text(data.result.user_number_phone);
    $('#user_email').text(data.result.user_email);
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