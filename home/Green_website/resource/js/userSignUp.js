$(document).ready(function () {
  var base_url = "http://localhost:8093/";

  $(".signup-submit").click(function (e) {
    e.preventDefault();
    var data = {
      'user_name'             : $(".signup-account").val() == null ? "" : $(".signup-account").val(),
      'user_password_first'   : $(".signup-password").val() == null ? "" : $(".signup-password").val(),
      'user_password'         : $(".signup-password-again").val() == null ? "" : $(".signup-password-again").val(),
      'user_email'            : $(".signup-email").val() == null ? "" : $(".signup-email").val(),
      'user_number_phone'     : $(".signup-phone").val() == null ? "" : $(".signup-phone").val(),
      'user_address'          : $(".signup-address").val() == null ? "" : $(".signup-address").val(),
    };

    var url = base_url + "api/Controller/userSignUp.php";

    var account_name = $(".signup-account").val();
    var password_first = $(".signup-password").val();
    var password_main = $(".signup-password-again").val();

    if (isValid(account_name)) {
      $("#modal-account-name small").remove();
      $("#modal-account-name").append(`<small class="text-danger modal-alert-position">Tài khoản không chứa ký tự đặc biệt</small>`);
      $("#modal-account-password small").remove();
      $("#modal-account-password-main small").remove();
      $("#modal-account-email small").remove();
      $("#modal-account-phone small").remove();
      $("#modal-account-address small").remove();
      return false;
    } 
    else if (isValid(password_first)) {
      $("#modal-account-password small").remove();
      $("#modal-account-password").append(`<small class="text-danger modal-alert-position">Mật khẩu không chứa ký tự đặc biệt</small>`);
      $("#modal-account-name small").remove();
      $("#modal-account-password-main small").remove();
      $("#modal-account-email small").remove();
      $("#modal-account-phone small").remove();
      $("#modal-account-address small").remove();
      return false;
    }
    else if (isValid(password_main)) {
      $("#modal-account-password-main small").remove();
      $("#modal-account-password-main").append(`<small class="text-danger modal-alert-position">Mật khẩu không chứa ký tự đặc biệt</small>`);
      $("#modal-account-name small").remove();
      $("#modal-account-password small").remove();
      $("#modal-account-email small").remove();
      $("#modal-account-phone small").remove();
      $("#modal-account-address small").remove();
      return false;
    }

    if (password_first.length < 6) {
      $("#modal-account-password small").remove();
      $("#modal-account-password").append(`<small class="text-danger modal-alert-position">Mật khẩu không nhỏ hơn 6 ký tự</small>`);
      $("#modal-account-name small").remove();
      $("#modal-account-password-main small").remove();
      $("#modal-account-email small").remove();
      $("#modal-account-phone small").remove();
      $("#modal-account-address small").remove();
      return false;
    }

    if (password_first != password_main) {
      $("#modal-account-password-main small").remove();
      $("#modal-account-password-main").append(`<small class="text-danger modal-alert-position">Mật khẩu không trùng khóp</small>`);
      $("#modal-account-password small").remove();
      $("#modal-account-name small").remove();
      $("#modal-account-email small").remove();
      $("#modal-account-phone small").remove();
      $("#modal-account-address small").remove();
      return false;
    }

    $.ajax({
      method: "POST",
      data: JSON.stringify(data),
      async: true,
      dataType: "JSON",
      url: url,
      success: function (data) {
        signupSuccess(data);
      },
      error: function (data) {
        signupError(data);
      },
    });
    //ajax(JSON.stringify(data), url, createPostSuccess, createPossError );
    return false;
  });
});

function ajax(data,  url, success, error, type = 'POST', dataType = 'JSON', async = true){
  $.ajax({
    type: type,
    data: data,
    async: async,
    dataType: dataType,
    url: url,
    success: success,
    error: error
  });
}

function signupSuccess(data) {
  if (data.code == 200) {
    showAlert("success", "Đăng ký tài khoản thành công!");
    $(".modal-account-content input").val("");
    $("#modal-account-phone").remove();
    $("#modal-account-name small").remove();
    $("#modal-account-password small").remove();
    $("#modal-account-password-main small").remove();
    $("#modal-account-email small").remove();
    $("#modal-account-address small").remove();
  } 
  else {
    switch(data.code){
      case 2: 
        showAlert('warning', 'Tài khoản đã tồn tại, vui lòng chọn tên đăng nhập khác!');
        break;
      case 3:
        $("#modal-account-name small").remove();
        $("#modal-account-name").append(`<small class="text-danger modal-alert-position">Tài khoản không được để trống</small>`);
        $("#modal-account-password small").remove();
        $("#modal-account-password-main small").remove();
        $("#modal-account-email small").remove();
        $("#modal-account-phone small").remove();
        $("#modal-account-address small").remove();
        break;
      case 4:
        $("#modal-account-password small").remove();
        $("#modal-account-password").append(`<small class="text-danger modal-alert-position">Mật khẩu không được để trống</small>`);
        $("#modal-account-password-main small").remove();
        $("#modal-account-name small").remove();
        $("#modal-account-email small").remove();
        $("#modal-account-phone small").remove();
        $("#modal-account-address small").remove();
        break;
      case 5:
        $("#modal-account-email").append(`<small class="text-danger modal-alert-position">Email không được để trống</small>`);
        $("#modal-account-name small").remove();
        $("#modal-account-password small").remove();
        $("#modal-account-password-main small").remove();
        $("#modal-account-phone small").remove();
        $("#modal-account-address small").remove();
        break;
      case 6:
        $("#modal-account-phone").append(`<small class="text-danger modal-alert-position">Số điện thoại không được để trống</small>`);
        $("#modal-account-name small").remove();
        $("#modal-account-password small").remove();
        $("#modal-account-password-main small").remove();
        $("#modal-account-email small").remove();
        $("#modal-account-address small").remove();
        break;
      case 7:
        $("#modal-account-address").append(`<small class="text-danger modal-alert-position">Địa chỉ không được để trống</small>`);
        $("#modal-account-name small").remove();
        $("#modal-account-password small").remove();
        $("#modal-account-password-main small").remove();
        $("#modal-account-email small").remove();
        $("#modal-account-phone small").remove();
        break;
      default:
        showAlert('error', 'Hệ thống lỗi, vui lòng thử lại sau!');
        break;
    }
    //showAlert("warning", data.message);
  }
}

function signupError(data) {
  showAlert(
    "error",
    "<strong>ERROR: </strong>" + data.message || data.statusText
  );
}

function showAlert(type, message){
  switch(String(type)){
    case "success":
      Swal.fire("Thành Công", message, "success");
      $("#close-signup").click();
      break;
    case "error":
      Swal.fire("Thất Bại", message, "error");
      break;
    case "warning":
      Swal.fire("Cảnh Báo", message, "warning");
      $("#modal-account-phone").remove();
      $("#modal-account-name small").remove();
      $("#modal-account-password small").remove();
      $("#modal-account-password-main small").remove();
      $("#modal-account-email small").remove();
      $("#modal-account-address small").remove();
      break;
  }
}

function isValid(str) {
  return /[^\w]|_/g.test(str);
}

