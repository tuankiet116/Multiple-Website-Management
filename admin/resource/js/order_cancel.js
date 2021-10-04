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
        "order_status": "3"
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
                        let  order_payment ="";
                        let  order_reason = "";
                        let order_suspicious = '';
                        let order_refund_code = null;

                        if(item.order_payment == 1){
                            order_payment ='<span class="badge badge-secondary">COD</span>';
                        }
                        else if(item.order_payment == 2){
                            order_payment ='<span class="badge badge-danger">MOMO</span>';
                        }
                        else{
                            '<p style="color: red">N/A</p>';;
                        }
    
                        if(item.order_reason == 1){
                            order_reason = "Admin Hủy";
                        }
                        else if(item.order_reason == 2){
                            order_reason = "Không Xác Nhận Được Với Khách Hàng";
                        } 
                        else if(item.order_reason == 3){
                            order_reason = "Khách Hàng Hủy Đơn";
                        }
                        else if(item.order_reason == 4){
                            order_reason = "Trả Hàng";
                        }
                        else{
                            order_reason = '<p style="color: red">N/A</p>';
                        }
    
                        if(item.order_suspicious == 1 && item.order_payment == 2){
                            order_suspicious = `<span class="badge badge-danger" style="display: block; width: 100px">Giao Dịch Khả Nghi</span>`;
                        }

                        let order_payment_status = item.order_payment_status == 0 ? `<span class="badge badge-success">Đã Thanh Toán</span>`:`<span class="badge badge-danger">Chưa Thanh Toán</span>`

                        // if(item.order_refund_code == 0){
                        //     order_refund_code = `<p>Đã Hoàn Tiền</p>`;
                        // }
                    
                        // if(item.order_refund_code != 0 && item.order_refund_code != null){
                        //     order_refund_code = `<p>Chưa Hoàn Tiền</p> <span>(${item.order_refund_message})</span>`;
                        // }

                        // if(item.order_refund_code == null){
                        //     order_refund_code = '<p style="color: red">N/A</p>';
                        // }
                        
                        if(item.order_trans_id == null){
                            item.order_trans_id = '<p style="color: red">N/A</p>';
                        }
                        
                        if(item.user_name == null){
                            item.user_name = '<p style="color: red">N/A</p>';
                        }

                        return`
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td><p class="order_code">${item.order_id}</p> ${order_suspicious}</td>
                                <td>${item.user_name}</td>
                                <td>${order_payment} ${order_payment_status}</td>
                                <td>${item.order_trans_id}</td>
                                <td>${item.web_name}</td>
                                <td>${order_reason}</td>
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
    $('.btn-detail').unbind().click(function () { 
        let data = {
            "order_id": $(this).attr('order_id'),
            "order_status": "3"
        }
        order_id_g =  $(this).attr('order_id');
        $.ajax({
            type: "POST",
            url: base_url+"api/Controller/getOrderById.php",
            data: JSON.stringify(data),
            dataType: "JSON",
            async:false,
            success: function (res) {
                // console.log(res);
                if(res.code == 403){
                    window.location.href= '../../error.php';
                }
                else{
                    if(res.code == 200){
                        valueDetail(res);
                    }
                }
            }
        });
        tooltip('#order_description', 30);
    });
    
}

function searchTerm(){
    $('#btn-search').unbind().click(function(){
        let term = $('#search_code').val();
        getOrder(term);
    })
}

function clearTerm(){
    $('#btn-cancel').unbind().click(function(){
        $('#search_code').val("");
        getOrder("");
    })
}

function valueDetail(data){
    let order_payment = '';
    let order_status ='';
    let order_reason = '';
    let order_suspicious ='';
    let order_refund_code = null;
    if(data.result.order_payment == 1){
        order_payment ='<span class="badge badge-secondary">COD</span>';
    }
    else if(data.result.order_payment == 2){
        order_payment ='<span class="badge badge-danger">MOMO</span>';
    }
    else{
        order_payment ='<span class="badge badge-secondary">Khác</span>';
    }

    if(data.result.order_status == 3){
        order_status = 'Đơn Đã Hủy';
    }

    if(data.result.order_reason == 1){
        order_reason = "Admin Hủy";
    }
    else if(data.result.order_reason == 2){
        order_reason = "Không Xác Nhận Được Với Khách Hàng";
    } 
    else if(data.result.order_reason == 3){
        order_reason = "Khách Hàng Hủy Đơn";
    }
    else if(data.result.order_reason == 4){
        order_reason = "Trả Hàng";
    }
    else{
        order_reason = '<p style="color: red">N/A</p>';
    }

    if(data.result.order_suspicious == 1 && data.result.order_payment == 2){
        order_suspicious = `<span class="badge badge-danger">Giao dịch Khả Nghi</span>`   
    }

    let order_detail = data.result.order_detail.map(function(item){
        return `<tr>
                    <td style="border: 1px solid #dee2e6; padding: 5px"> ${item.product_name} </td>
                    <td style="border: 1px solid #dee2e6; padding: 5px"> ${item.order_detail_quantity} </td>
                    <td style="border: 1px solid #dee2e6; padding: 5px"> ${item.order_detail_amount} </td>
                </tr>`;
    })
    let order_payment_status = data.result.order_payment_status == 0 ? `<span class="badge badge-success">Đã Thanh Toán</span>`:`<span class="badge badge-danger">Chưa Thanh Toán</span>`

    // if(data.result.order_refund_code == 0){
    //     order_refund_code = `Đã Hoàn Tiền`;
    // }

    // if(data.result.order_refund_code != 0 && data.result.order_refund_code != null){
    //     order_refund_code = `Chưa Hoàn Tiền (${data.result.order_refund_message})`;
    // }
    
    // if(data.result.order_refund_code == null){
    //     order_refund_code = '<p style="color: red">N/A</p>'
    // }

    if(data.result.order_request_id == null){
        data.result.order_request_id = '<p style="color: red">N/A</p>';
    }

    if(data.result.order_id == null){
        data.result.order_id = '<p style="color: red">N/A</p>';
    }

    if(data.result.user_name == null){
        data.result.user_name = '<p style="color: red">N/A</p>';
    }

    if(order_payment == null){
        order_payment = '<p style="color: red">N/A</p>';
    }

    if(data.result.web_name == null){
        data.result.web_name = '<p style="color: red">N/A</p>';
    }

    if(data.result.order_request_id == null){
        data.result.order_request_id = '<p style="color: red">N/A</p>';
    }

    if(data.result.order_trans_id == null){
        data.result.order_trans_id = '<p style="color: red">N/A</p>';
    }

    if(data.result.order_paytype == null){
        data.result.order_paytype = '<p style="color: red">N/A</p>';
    }

    $('#order_id').html(data.result.order_id);
    $('#user_name').html(data.result.user_name);
    $('#order_payment_status').html(order_payment_status);
    $('#order_payment').html(order_payment);
    $('#web_name').html(data.result.web_name);
    $('#order_request_id').html(data.result.order_request_id);
    $('#order_trans_id').html(data.result.order_trans_id);
    $('#order_sum_price').html(data.result.order_sum_price);
    $('#order_paytype').html(data.result.order_paytype);
    $('#order_datetime').html(data.result.order_datetime);
    $('#order_status').html(order_status);
    $('#user_number_phone').html(data.result.user_number_phone);
    $('#user_email').html(data.result.user_email);
    $('#order_description').html(data.result.order_description);
    $('#order_reason').html(order_reason);
    $('#order_detail').html(order_detail);
    $('#order_suspicious').html(order_suspicious);
    // $('#order_refund_code').html(order_refund_code);

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