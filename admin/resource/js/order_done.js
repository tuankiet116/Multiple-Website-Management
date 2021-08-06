var base_url = "../../../";
$(document).ready(function () {
    $('#search_reason').niceSelect();
    getOrder("");
    searchTerm();
    clearTerm();
});

function getOrder(term){
    let data ={
        "term": term,
        "order_status": "4"
    }
    $.ajax({
        type: "POST",
        url: base_url+"api/Controller/getAllOrder.php",
        data: JSON.stringify(data),
        async: false,
        dataType: "JSON",
        success: function (res) {
            if(res.code == 403){
                window.location.href= '../../error.php';
            }
            else{

                if(res.code == 200){
                    var viewData = res.result.map(function(item, index){
                        let order_payment ="";
                        let order_status = item.order_status == 4? `<p style="color: green">Đã Giao Thành Công<i class="fas fa-check"></i></p>`: ``;
                        let order_suspicious = '';
    
                        if(item.order_payment == 1){
                            order_payment ='<span class="badge badge-secondary">COD</span>';
                        }
                        else if(item.order_payment == 2){
                            order_payment ='<span class="badge badge-danger">MOMO</span>';
                        }
                        else{
                            order_payment ='<span class="badge badge-secondary">Khác</span>';
                        }
    
                        if(item.order_suspicious == 1 && item.order_payment == 2){
                            order_suspicious = `<span class="badge badge-danger" style="display: block; width: 100px">Giao Dịch Khả Nghi</span>`;
                        }
                        return`
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td><p class="order_code">${item.order_id}</p> ${order_suspicious}</td>
                                <td>${item.user_name}</td>
                                <td>${order_payment}</td>
                                <td>${item.order_trans_id}</td>
                                <td>${item.web_name}</td>
                                <td>${order_status}</td>
                                <td>
                                    <button class="btn btn-primary btn-detail" order_id="${item.order_id}" data-toggle="modal" data-target="#show-modal-detail">Chi Tiết</button>
                                </td>
                            </tr>
                        `;
                    })
                }
                else{
                    var mes = `<tr style="background-color: white;">
                                 <td colspan="9"><p style="color:red; text-align: center">${res?.message}</p></td>
                               </tr>`; 
                }
    
                $('.table > tbody').html(viewData ?? mes).ready(function(){
                    getOrderById();
                    tooltip('.order_code', 20);
                });
            }
        },
        error: function(res){
            console.log(res.responseText);
        }
    });
}

function getOrderById(){
    $('.btn-detail').click(function () { 
        let data = {
            "order_id": $(this).attr('order_id'),
            "order_status": "4"
        }
        $.ajax({
            type: "POST",
            url: base_url+"api/Controller/getOrderById.php",
            data: JSON.stringify(data),
            dataType: "JSON",
            async:false,
            success: function (res) {
                if(res.code == 403){
                    window.location.href= '../../error.php';
                }
                else{
                    if(res.code == 200){
                        valueDetail(res);
                    }
                }
            },
            error: function(res){
                console.log(res.responeText);
            }
        });
        tooltip('#order_description', 30);
    });
    
}

function searchTerm(){
    $('#btn-search').click(function(){
        let term = $('#search_code').val();
        getOrder(term);
    })
}

function clearTerm(){
    $('#btn-cancel').click(function(){
        $('#search_code').val("");
        getOrder("");
    })
}

function valueDetail(data){
    let order_payment = '';
    let order_status ='';
    let order_suspicious ='';

    if(data.result.order_payment == 1){
        order_payment ='<span class="badge badge-secondary">COD</span>';
    }
    else if(data.result.order_payment == 2){
        order_payment ='<span class="badge badge-danger">MOMO</span>';
    }
    else{
        order_payment ='<span class="badge badge-secondary">Khác</span>';
    }

    if(data.result.order_status == 4){
        order_status = 'Đơn Đã Giao Thành Công';
    }

    if(data.result.order_suspicious == 1 && data.result.order_payment == 2){
        order_suspicious = `<span class="badge badge-danger">Giao dịch Khả Nghi</span>`   
    }

    let order_payment_status = data.result.order_payment_status == 0 ? `<span class="badge badge-success">Đã Thanh Toán</span>`:`<span class="badge badge-danger">Chưa Thanh Toán</span>`
    let order_detail = data.result.order_detail.map(function(item){
        return `<tr>
                    <td style="border: 1px solid #dee2e6; padding: 5px"> ${item.product_name} </td>
                    <td style="border: 1px solid #dee2e6; padding: 5px"> ${item.order_detail_quantity} </td>
                    <td style="border: 1px solid #dee2e6; padding: 5px"> ${item.order_detail_amount} </td>
                </tr>`;
    })
    
    $('#order_id').text(data.result.order_id);
    $('#user_name').text(data.result.user_name);
    $('#order_payment_status').html(order_payment_status);
    $('#order_payment').html(order_payment);
    $('#web_name').text(data.result.web_name);
    $('#order_request_id').text(data.result.order_request_id);
    $('#order_trans_id').text(data.result.order_trans_id);
    $('#order_sum_price').text(data.result.order_sum_price);
    $('#order_paytype').text(data.result.order_paytype);
    $('#order_datetime').text(data.result.order_datetime);
    $('#order_status').text(order_status);
    $('#user_number_phone').text(data.result.user_number_phone);
    $('#user_email').text(data.result.user_email);
    $('#order_description').text(data.result.order_description);
    $('#order_detail').html(order_detail);
    $('#order_suspicious').html(order_suspicious);

    $.fn.digits = function () {
      return this.each(function () {
        $(this).text(
          $(this)
            .text()
            .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        );
      });
    };

    $(".amount-number").digits();
    $("#order_sum_price").digits();
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