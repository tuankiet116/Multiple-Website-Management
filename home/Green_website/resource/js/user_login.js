$(document).ready(function () {
  $(".user-submit").on("click", function (e) {
    // e.preventDefault();
    var data = {
      'user_name'          : $(".user-name").val(),
      'user_password'      : $(".user-pass").val(),
    };

    var url = "../../../api/Controller/userLogin.php";

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
    //ajax(JSON.stringify(data), url, createPostSuccess, createPossError );
    return false;
  });
});

function loginSuccess(data){
  if(data.code == 200){
    showAlert('success', data.message);
  }
  else{
    showAlert('warning', data.message);
  }
}

function loginError(data){
  showAlert('error', '<strong>ERROR: </strong>' + data.message||data.statusText );
}
