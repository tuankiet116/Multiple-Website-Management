$(document).ready(function () {
  $(".user-submit").on("click", function (e) {
    // e.preventDefault();
    var data = {
      'user_name'          : $(".user-name").val(),
      'user_password'      : $(".user-pass").val(),
    };

    var url = base_url + "api/Controller/userLogin.php";

    $.ajax({
      method: "POST",
      data: JSON.stringify(data),
      async: true,
      dataType: "JSON",
      url: url,
      success: function (data) {
        loginSuccess(data);
      },                    
      error: function (data) {
        loginError(data);
      },
    });
    return false;
  });
});

function loginSuccess(data){
  if(data.code == 200){
    showAlert('success', 'Đăng Nhập Thành Công');
  }
  else{
    if(data.code == 3){
      showAlert('warning', 'Sai Tên Đăng Nhập Hoặc Mật Khẩu');
    }
    else if(data.code == 4){
      showAlert('warning', 'Hệ Thống Đang Gặp Lỗi!');
    }
  }
}

function loginError(data){
  showAlert('error', '<strong>ERROR: </strong>' + data.message||data.statusText );
}
