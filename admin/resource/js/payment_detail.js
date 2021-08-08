$(document).ready(function () {
  $(".loader-container").css("display", "none");

  // Get Information From URL
  url = window.location.href;
  url_split = url.split("detail.php?record_id=")[1];
  payment_id = url_split.split("&web_id=")[0];
  web_id = url_split.split("&web_id=")[1];

  //Get Payment Data
  getPaymentByID();
});

var status_payment = null;

function getPaymentDataSuccess(data) {
  if(data.code == 403){
    window.location.href = '../../error.php';
  }
  
  if (data.code == 200) {
    if (data.payment_method == 1) {
      $("#payment_partner_code").attr("disabled", true);
      $("#payment_access_key").attr("disabled", true);
      $("#payment_secret_key").attr("disabled", true);

      $("#payment_partner_code")
        .siblings("small")
        .text("Phương Thức Thanh Toán Không Hỗ Trợ");
      $("#payment_access_key")
        .siblings("small")
        .text("Phương Thức Thanh Toán Không Hỗ Trợ");
      $("#payment_secret_key")
        .siblings("small")
        .text("Phương Thức Thanh Toán Không Hỗ Trợ");

      //Destroy component which's not necessary
      $("#payment_partner_code").remove();
      $("#payment_access_key").remove();
      $("#payment_secret_key").remove();
    } else {
      $("#payment_partner_code").attr("disabled", false);
      $("#payment_access_key").attr("disabled", false);
      $("#payment_secret_key").attr("disabled", false);
    }

    status_payment = data.payment_active;

    $("#payment_partner_code").val(data.payment_partner_code);
    $("#payment_access_key").val(data.payment_access_key);
    $("#payment_secret_key").val(data.payment_secret_key);

    $("#payment_method").text(data.payment_name);
    $("#website").text(data.web_name);

    var button_status = `<a href="payment_momo.php">
                            <button style="margin-top: 30px; width: 100px;" type="button" class="btn btn-primary">
                                <i class="fas fa-arrow-circle-left"></i> Quay Lại
                            </button>
                        </a>
                        <button id="btn_update" style="margin-top: 30px; width: 100px" type="button" class="btn btn-success">Cập Nhật</button>`;
    if (data.payment_active == 1) {
      button_status +=
        '<button style="margin-top: 30px; width: 100px; margin-left: 5px;" id="payment_show_' +
        data.payment_id +
        '" type="button" class="btn btn-danger status_button"> Vô Hiệu Hóa </button>';
    } else {
      button_status +=
        '<button style="margin-top: 30px; width: 100px; margin-left: 5px;" id="payment_hide_' +
        data.payment_id +
        '" type="button" class="btn btn-primary status_button">Kích Hoạt</button>';
    }

    $(".btn_action").html(button_status);

    //event denination update button
    $("#btn_update").click(function () {
      data = {
        payment_id: payment_id,
        payment_access_key: $("#payment_access_key").val(),
        payment_partner_code: $("#payment_partner_code").val(),
        payment_secret_key: $("#payment_secret_key").val(),
      };
      ajax(
        JSON.stringify(data),
        "../../../api/Controller/updatePayment.php",
        updateSuccess,
        updateError
      );
    });

    //event defination status button
    $(".status_button").click(function () {
      if (status_payment !== null) {
        data = {
          payment_id: payment_id,
          payment_active: status_payment == 0 ? 1 : 0,
        };

        ajax(
          JSON.stringify(data),
          "../../../api/Controller/ActiveInactivePayment.php",
          updateStatusSuccess,
          updateStatusError
        );
      } else {
        showAlert("warning", "Không Thể Cập Nhật Trạng Thái!");
      }
    });
  } else {
    window.location.href = "../../resource/Error/500/500.html";
  }
}

function getPaymentDataError(jqXHR, textStatus, errorThrown) {
  showAlert("error", jqXHR.responseText);
  console.log(textStatus);
  console.log(errorThrown);
}

function updateSuccess(data) {
  if(data.code == 403){
    window.location.href = '../../error.php';
  }

  if (data.code == 200) {
    getPaymentByID();
    showAlert("success", data.message);
  } else {
    showAlert("warning", data.message);
  }
}

function updateError(jqXHR, textStatus, errorThrown) {
  showAlert("error", jqXHR.responseText);
  console.log(textStatus);
  console.log(errorThrown);
}

function updateStatusSuccess(data) {
  if(data.code == 403){
    window.location.href = '../../error.php';
  }

  if (data.code == 200) {
    getPaymentByID();
    showAlert("success", data.message);
  } else {
    showAlert("warning", data.message);
  }
}

function updateStatusError(jqXHR, textStatus, errorThrown) {
  showAlert("error", errorThrown);
  console.log(textStatus);
}

function getPaymentByID() {
  var data = {
    payment_id: payment_id,
  };
  ajax(
    JSON.stringify(data),
    "../../../api/Controller/getPaymentByID.php",
    getPaymentDataSuccess,
    getPaymentDataError
  );
}
