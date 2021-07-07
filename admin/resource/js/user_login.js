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
      async: false,
      dataType: "JSON",
      url: url,
      success: function (data) {
        console.log(data);
      },                    
      error: function (data) {
        console.log(data);
      },
    });
    //ajax(JSON.stringify(data), url, createPostSuccess, createPossError );
    return false;
  });
});
