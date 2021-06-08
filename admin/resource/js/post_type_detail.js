$(document).ready(function () {
  url = window.location.href;
  url_split = url.split("detail.php?record_id=")[1];
  post_type_id = url_split.split("&web_id=")[0];
  web_id = url_split.split("&web_id=")[1];
  debugger;

  $(".loader-container").css("display", "flex");

  data_getInfo = {
    "post_type_id": post_type_id,
  };

  $(".pickPostTypeShow").select2();

  //Call Ajax Set Information
  $.ajax({
    dataType: "JSON",
    data: JSON.stringify(data_getInfo),
    type: "POST",
    async: false,
    url: "../../../api/Controller/getPostTypeByID.php",
    success: function (data) {
      showInformation(data);
    },
    error: function (request, status, error) {
      showAlert("error", error + request.responseText);
    },
  });
});

var base_url = "../../../";

function checkdefault(default_value, check_parameter) {
  if (check_parameter == null || check_parameter == "undefined") {
    return default_value;
  }
  return check_parameter;
}

function ajax(
  data,
  url,
  success,
  error,
  type = "POST",
  dataType = "JSON",
  async = true
) {
  $.ajax({
    type: type,
    data: data,
    async: async,
    dataType: dataType,
    url: url,
    success: success,
    error: error,
  });
}


function showInformation(data) {
  $("#postTypeTitle").val(checkdefault("", data.post_type_title));
  $("#postTypeDescription").val(checkdefault("", data.post_type_description));
  $(".pickPostTypeShow").val(data.post_type_show); 
  $(".pickPostTypeShow").trigger("change"); 
  if (data.post_type_active == 1) {
    html = `<input id="submit_button" class="btn btn-primary  btn-lg " type="submit" value="Xác Nhận">
              <input id="hide_button" class="btn btn-danger  btn-lg " type="button" value="Ẩn Bài Viết">`;
    $(".button-container").html(html);
    submitButton();
    IActiveStatusButton(0, "#hide_button");
  } else {
    html = `<input id="submit_button" class="btn btn-primary  btn-lg " type="submit" value="Xác Nhận">
              <input id="show_button" class="btn btn-success  btn-lg " type="button" value="Hiển Thị">`;
    $(".button-container").html(html);
    submitButton();
    IActiveStatusButton(1, "#show_button");
  }

  $(".loader-container").css("display", "none");
}

function setSelect2Data(id, data_select = "") {
  $(id).empty().append(data_select);
  $(id).trigger("change");
}


function updatePostTypeSuccess(data) {
  if (data.code == 200) {
    showAlert("success", data.message);
  } else {
    showAlert("warning", data.message);
  }
}

function updatePostTypeError(data) {
  showAlert("error", "<strong>ERROR: </strong>" + data);
}

function showAlert(type, message) {
  $(".alert").removeClass("alert-success");
  $(".alert").removeClass("alert-warning");
  $(".alert").removeClass("alert-danger");

  switch (String(type)) {
    case "success":
      $(".alert").addClass("alert-success");
      $(".alert-heading").html('<i class="fas fa-check-circle"></i> Success!');
      break;
    case "error":
      $(".alert").addClass("alert-danger");
      $(".alert-heading").html(
        '<i class="fas fa-exclamation-circle"></i> Error!'
      );
      break;
    case "warning":
      $(".alert").addClass("alert-warning");
      $(".alert-heading").html('<i class="fa fa-warning"></i> Warning!');
      break;
  }

  $(".alert .message").html(message);
  $(".alert").addClass("show");
  setTimeout(function () {
    $(".alert").removeClass("show");
  }, 3000);

  $(".alert button.close").on("click", function () {
    $(".alert").removeClass("show");
  });
}

function submitButton() {
  $("#submit_button").on("click", function (e) {
    e.preventDefault();
    var data = {
      'post_type_title': $("#postTypeTitle").val(),
      'post_type_description': $("#postTypeDescription").val(),
      'post_type_show': $(".pickPostTypeShow").select2("val"),
      'post_type_id': post_type_id,
    };

    var url = "../../../api/Controller/updatePostType.php";

    $.ajax({
      type: "POST",
      data: JSON.stringify(data),
      async: true,
      dataType: "JSON",
      url: url,
      success: function (data) {
        updatePostTypeSuccess(data);
        reload();
        showAlert("success", data.message);
      },
      error: function (request, status, error) {
        updatePostTypeError(request.responseText);
      },
    });
    //ajax(JSON.stringify(data), url, createPostSuccess, createPossError );
  });
}

function IActiveStatusButton(post_type_active, element) {
  $(element).on("click", function () {
    $(".loader-container").css("display", "flex");
    data = {
      "post_type_id": post_type_id,
      "post_type_active": post_type_active,
    };
    $.ajax({
      type: "POST",
      dataType: "JSON",
      data: JSON.stringify(data),
      async: false,
      url: "../../../api/Controller/ActiveInactivePostType.php",
      success: function (data) {
        if (data.code == 200) {
          showAlert("success", data.message);
          reload();
        } else {
          showAlert("error", data.code + ": " + data.message);
        }
      },
      error: function (request, status, error) {
        showAlert("error", request.responseText);
      },
    });
  });
}

function reload() {
  $(".loader-container").css("display", "flex");
  //Call Ajax Set Information
  $.ajax({
    dataType: "JSON",
    data: JSON.stringify(data_getInfo),
    type: "POST",
    async: false,
    url: "../../../api/Controller/getPostTypeByID.php",
    success: function (data) {
      showInformation(data);
    },
    error: function (request, status, error) {
      showAlert("error", error + request.responseText);
    },
  });
}
