var base_url = "../../../";
var web_id = "";
$(document).ready(function () {
  $(".input-image-container i").on("click", function (e) {
    var image_element = $(this).siblings(".input-image").find("img");
    var id_image = "#" + image_element.attr("id");
    $(id_image).attr("src", "#");
    $(id_image).css("display", "none");
    $(id_image).siblings("svg").css("display", "block");
  });

  $(".input-image-container i").hover(function (e) {
    $(this).css("display", "block");
  });

  $(".input-image-container i").mouseout(function (e) {
    $(this).css("display", "none");
  });

  // Input Image Processing When Image Is NULL
  $(".input-image").on("click", function (e) {
    var id = $(this).attr("id");
    id = id.replace("input_image_", "");
    id = "input_" + id;
    $("#" + id)[0].click();

    $("#" + id).change(function (e) {
      exGetImg(e.target, "#" + id);
      $("#submit_configuation").attr("disabled", false);
    });
  });

  $(".input-image img").hover(function (e) {
    $(this).closest("div").siblings("i").css("display", "block");
  });

  $(".input-image img").mouseout(function (e) {
    $(this).closest("div").siblings("i").css("display", "none");
  });

  $(".categories-add").on("click", function () {
    $(".categories-container-form").show();
  });

  //call api and render
  getDataTable();
  getWebsiteByID(".btn-back-modal");
  //create
  create();

  // reset form
  $("#show-modal-form-update").on("hidden.bs.modal", function () {
    $("#form-update")[0].reset();
    $("#image_icon_1_update").attr("src", "#");
    $("#image_icon_1_update").css("display", "none");
    $("#input_image_icon_1_update").children("svg").css("display", "inherit");
    $("#label-domain").html("Tên Miền Website:");
    $(".domain-listing tbody").html("");
    $(".domain-listing").css("display", "table");
    $("#domain-status").html("");
    $(".modal").css("overflow-y", "auto");
    getDataTable();
  });

  $("#modal-domain-detail, #modal-domain, #modal-add-domain").on(
    "hidden.bs.modal",
    function () {
      $("small").css("display", "none");
    }
  );

  $("#redirect-domain-manage").click(function () {
    $(".close-form-update").click();
    getDomain(web_id);
  });

  $(".btn-back-modal-info").click(function () {
    getDomain(web_id);
  });

  $("#update-domain-btn")
    .unbind()
    .click(function () {
      domainID = $(this).attr("domain-id");
      domainName = $("#input-domain-detail").val();

      $.ajax({
        data: JSON.stringify({
          domain_id: domainID,
          domain_name: domainName,
        }),
        type: "POST",
        dataType: "JSON",
        async: false,
        url: base_url + "api/Controller/updateDomain.php",
        success: function (data) {
          switch (data.code) {
            case "200":
              showAlert("success", "Cập Nhật Domain Thành Công");
              $("#domain-small").css("display", "none");
              getDataTable();
              break;
            case 1:
              showAlert("error", "Hệ Thống Lỗi Không Thể Cập Nhật Tên Miền");
              break;
            case 2:
              $("#domain-small").text(
                "Tên Miền Đã Được Sử Dụng Cho Trang Web Khác, Vui Lòng Chọn Tên Miền Khác!"
              );
              $("#domain-small").css("display", "block");
              break;
            case 500:
              $("#domain-small").text("Không Được Để Trống Tên Miền.");
              $("#domain-small").css("display", "block");
              break;
            case 403:
              showAlert(
                "warning",
                "Phiên đăng nhập hết hạn! Vui Lòng Tải Lại Trang Để Đăng Nhập Lại!"
              );
              break;
            default:
              showAlert("error", "Lỗi Không Xác Định.");
              break;
          }
        },
        error: function (data) {
          showAlert("error", data.responseText);
        },
      });
    });

  $("#add-domain-btn")
    .unbind()
    .click(function () {
      domainName = $("#input-domain-add").val();
      $.ajax({
        data: JSON.stringify({ domain_name: domainName, web_id: web_id }),
        type: "POST",
        dataType: "JSON",
        async: false,
        url: base_url + "api/Controller/createDomain.php",
        success: function (data) {
          switch (data.code) {
            case 200:
              showAlert("success", "Cập Nhật Domain Thành Công");
              $("#domain-add-small").css("display", "none");
              getDataTable();
              break;
            case 1:
              showAlert("error", "Hệ Thống Lỗi Không Thể Cập Nhật Tên Miền");
              break;
            case 2:
              $("#domain-add-small").text(
                "Tên Miền Đã Được Sử Dụng Cho Trang Web Khác, Vui Lòng Chọn Tên Miền Khác!"
              );
              $("#domain-add-small").css("display", "block");
              break;
            case 500:
              $("#domain-add-small").text("Không Được Để Trống Tên Miền.");
              $("#domain-add-small").css("display", "block");
              break;
            case 403:
              showAlert(
                "warning",
                "Phiên đăng nhập hết hạn! Vui Lòng Tải Lại Trang Để Đăng Nhập Lại!"
              );
              break;
            default:
              showAlert("error", "Lỗi Không Xác Định.");
              break;
          }
        },
        error: function (data) {},
      });
    });
});

// api get Data of table
function getDataTable() {
  $.ajax({
    url: base_url + "api/Controller/getAllWebsite.php",
    method: "POST",
    async: false,
    success: function (res) {
      if (res.code == 403) {
        showAlert(
          "warning",
          "Phiên đăng nhập hết hạn! Vui Lòng Tải Lại Trang Để Đăng Nhập Lại!"
        );
      } else {
        var view = res.map((e, index) => {
          if (e.domain_name_list !== null && e.domain_name_list !== "") {
            var list_url = e.domain_name_list.split(",");
            list_url = list_url.join(", ");
          }

          var checkIcon = checkdefault(
            "data/web_icon/icon_default/default.png",
            e.web_icon
          );
          rs = ``;
          rs += `<tr>`;
          rs += `
                <td>${index + 1}</td>
                <td><p class="web_name">${e.web_name}</p></td>
                <td>${
                  list_url !== undefined
                    ? '<p class="web_url">' + list_url + "</p>"
                    : '<span class="badge badge-danger">Domain Không Tồn Tại</span>'
                }</td>
                <td><img src="${base_url}${checkIcon}" alt="icon" class="icon-website"></td>
                <td><p class="web_description">${e.web_description}</p></td>
              `;
          if (e.web_active == 1) {
            rs += `<td><button class="btn btn-success btn-show-hide" status="${e.web_active}" w_id="${e.web_id}">Đang Hiển Thị</button></td>`;
          } else {
            rs += `<td><button class="btn btn-danger btn-show-hide" status="${e.web_active}" w_id="${e.web_id}">Đã Ẩn</button></td>`;
          }
          rs += ` <td><button style="width: auto; " class="btn btn-primary btn-edit" data-toggle="modal" data-target="#show-modal-form-update" w_id="${e.web_id}">Chi Tiết</button></td>`;
          rs += `</tr>`;
          return rs;
        });
        $(".table-listing-website > tbody")
          .html(view)
          .ready(function () {
            activeWeb();
            getWebsiteByID(".btn-edit");
            update();
            $(".web_description").each(function () {
              if ($(this).text().length > 40) {
                var stringOriginal = $(this).text();
                var subString = $(this).text().substring(0, 40) + "...";
                $(this).text(subString);
                $(this).attr("title", stringOriginal);
              }
            });

            tooltip(".web_url", 30);
          });
      }
    },
    error: function (res) {
      console.log(res.responseText);
    },
  });
}

function create() {
  $("#submit").click(function () {
    var data = dataFormCreate();
    $(".loader-container").css("display", "flex");

    $.ajax({
      url: base_url + "api/Controller/createWebsite.php",
      method: "POST",
      async: false,
      data: JSON.stringify(data),
      success: function (res) {

        if(typeof(res) === 'string'){
          let obj = JSON.parse(res);
          if(obj.code == 403){
            window.location.href = '../../error.php';
          }
        }

        if (res.code == 200) {
          $(".loader-container").css("display", "none");
          showAlert("success", `<p>${res?.message}</p>`);
          $("#form")[0].reset();
          $("#image_icon_1").attr("src", "#");
          $("#image_icon_1").css("display", "none");
          $("#input_image_icon_1").children("svg").css("display", "inherit");
          $(".close-form-create").click();
        } else if (res.code == 403) {
          window.location.href = '../../error.php';
        } else {
          $(".loader-container").css("display", "none");
          showAlert("error", `<p>${res?.message}</p>`);
        }
      },
      error: function (res) {
        console.log(res.responseText);
      },
    });
    getDataTable();
    return false;
  });
}

function update() {
  $("#submit-update").click(function () {
    var data = dataFormUpdate();
    $(".loader-container").css("display", "flex");

    $.ajax({
      url: base_url + "api/Controller/updateWebsite.php",
      method: "POST",
      async: false,
      data: JSON.stringify(data),
      success: function (res) {
        if(typeof(res) === 'string'){
          let obj = JSON.parse(res);
          if(obj.code == 403){
            window.location.href = '../../error.php';
          }
        }

        if (res.code == 200) {
          $(".loader-container").css("display", "none");
          showAlert("success", `<p>${res?.message}</p>`);
          $(".close-form-update").click();
        } else if (res.code == 403) {
          window.location.href = '../../error.php';
        } else {
          $(".loader-container").css("display", "none");
          showAlert("error", `<p>${res?.message}</p>`);
        }
      },
      error: function (res) {
        console.log(res.responseText);
      },
    });
    getDataTable();
    return false;
  });
}

// toggle status
function activeWeb() {
  $(".btn-show-hide").click(function () {
    var data = {
      web_active: $(this).attr("status") == "1" ? "0" : "1",
      web_id: $(this).attr("w_id"),
    };
    $.ajax({
      url: base_url + "api/Controller/activeWebsite.php",
      method: "POST",
      async: false,
      data: JSON.stringify(data),
      success: function (res) {

        if(typeof(res) === 'string'){
          let obj = JSON.parse(res);
          if(obj.code == 403){
            window.location.href = '../../error.php';
          }
        }

        if (res.code == 200) {
          showAlert("success", `<p>${res.message}</p>`);
        } else if (res.code == 403) {
          window.location.href = '../../error.php';
        } else {
          showAlert("error", `<p>${res.message}</p>`);
        }
      },
      error: function (res) {
        console.log(res.responseText);
      },
    });
    getDataTable();
  });
}

function getWebsiteByID(element) {
  $(element).click(function () {
    web_id = $(this).attr("w_id");
    var data = {
      web_id: $(this).attr("w_id"),
    };
    $.ajax({
      url: base_url + "api/Controller/getWebsiteByID.php",
      method: "POST",
      data: JSON.stringify(data),
      success: function (res) {
        // console.log(res);
        if(typeof(res) === 'string'){
          let obj = JSON.parse(res);
          if(obj.code == 403){
            window.location.href = '../../error.php';
          }
        }

        if(res.code == 200){
          renderDataFormUpdate(res.result);
        }

        if(res.code == 403){
          window.location.href = '../../error.php';
        }
      },
      error: function (res) {
        console.log(res.responseText);
      },
    });
  });
}

function renderDataFormUpdate(data) {
  $("#web_name_update").val(data.web_name);
  setImageData(data.web_icon, "#image_icon_", 1);
  $("#web_description_update").val(data.web_description);
  if (data.web_url !== null && data.web_url !== "") {
    var web_url = data.web_url.split(",");
    var domain_status = data.domain_status.split(",");
    var html = "";
    web_url.forEach(function (val, key) {
      var status = "";
      if (domain_status[key] == 0) {
        status = `<span class="badge badge-danger">Vô Hiệu Hóa</span>`;
      }

      html += `<tr><td>` + val + status + `</td></tr>`;
    });
    $(".domain-listing tbody").html(html);
  } else {
    $(".domain-listing").css("display", "none");
    $("#domain-status").html(
      `<span class="badge badge-danger">Chưa Có Domain</span>`
    );
  }

  $("#redirect-domain-manage").removeAttr("href");
  $("#redirect-domain-manage").attr("data-toggle", "modal");
  $("#redirect-domain-manage").attr("data-target", "#modal-domain");

  //turn back button
  $(".btn-back-modal").attr("w_id", data.web_id);
  $(".modal").css("overflow-y", "auto");
}

function dataFormCreate() {
  return (data = {
    web_name: $("#web_name").val(),
    web_icon: $("#image_icon_1").attr("src"),
    web_description: $("#web_description").val(),
  });
}

function dataFormUpdate() {
  return (data = {
    web_id: web_id,
    web_name: $("#web_name_update").val(),
    web_icon: $("#image_icon_1_update").attr("src"),
    web_description: $("#web_description_update").val(),
  });
}

var exGetImg = function (extag, element) {
  var file = extag.files[0]; //The first file of the selected file (as a fixed format)
  var readers = new FileReader(); //Create a new file reading object to change the path
  var filename;
  readers.readAsDataURL(file); //Convert the read file path to a url type
  readers.onload = function () {
    //Call onload() method after conversion
    var imgsSrc = this.result; //After the image address is read out, the result result is DataURL //this.result is the URL path of the image conversion
    console.log(imgsSrc); //The url path of the displayed image can be directly assigned to the src attribute of img
    $(element).siblings("img").css("display", "block");
    $(element).siblings("svg").css("display", "none");
    $(element).siblings("img").attr("src", imgsSrc);
  };
};

//set default image which null value
function checkdefault(default_value, check_parameter) {
  if (check_parameter == null || check_parameter == "") {
    return default_value;
  }
  return check_parameter;
}

function setImageData(data, element, max = 0) {
  if (data && element) {
    if (max != 0) {
      var data_arr = data.split(",");
      if (data_arr.length <= 5) {
        var i = 1;
        data_arr.forEach(function (value, key) {
          value = value.trim();
          key = key + 1;
          $(element + key + "_update").attr("src", base_url + value);
          $(element + key + "_update")
            .siblings("svg")
            .css("display", "none");
          $(element + key + "_update").css("display", "block");
        });
      }
    } else {
      $(element).attr("src", base_url + data);
      $(element).siblings("svg").css("display", "none");
      $(element).css("display", "block");
    }
  }
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
  $(".alert").addClass("d-block");
  setTimeout(function () {
    $(".alert").removeClass("d-block");
  }, 3000);

  $(".alert button.close").on("click", function () {
    $(".alert").removeClass("d-block");
  });
}

// func handle tooltip
function tooltip(element, maxLength) {
  let description = $(element);
  $.each(description, function () {
    if ($(this).text().length > maxLength) {
      var stringOriginal = $(this).text();
      var subString = $(this).text().substring(0, maxLength) + "...";
      $(this).text(subString);
      $(this).attr("title", stringOriginal);
    }
  });
}

//Domain Information Get/Set/Update
function getDomain(webID) {
  $.ajax({
    data: JSON.stringify({ web_id: webID }),
    dataType: "JSON",
    type: "POST",
    url: base_url + "api/Controller/getDomainByWebID.php",
    success: function (data) {
      html = "";
      if (data.code == 404) {
        html = `<tr><td colspan = 3 style="color: red;">NOT FOUND</td></tr>`;
      } else if (data.code == 403) {
        showAlert(
          "warning",
          "Phiên đăng nhập hết hạn! Vui Lòng Tải Lại Trang Để Đăng Nhập Lại!"
        );
      } else {
        var html = data.map(function (value, index) {
          status = "";
          if (value.domain_active == 0) {
            status = `<button w_id="${value.web_id}" domain_id = "${value.domain_id}_hide" type="button" class="btn btn-danger btn-status-domain btn-sm">Đã Vô Hiệu Hóa</button>`;
          } else {
            status = `<button w_id="${value.web_id}" domain_id = "${value.domain_id}_show" type="button" class="btn btn-basic btn-status-domain btn-sm">Đã Kích Hoạt</button>`;
          }

          r = `<tr>
                          <td class = 'domain-name-info'>${value.domain_name}</td>
                          <td>${status}</td>
                          <td><button type="button" class="btn btn-info btn-sm btn-detail-domain" data-dismiss="modal" data-toggle="modal" data-target="#modal-domain-detail" domain_id="${value.domain_id}">Chỉnh Sửa</button></td>
                         </tr>`;
          return r;
        });
      }

      $(".listing-domain > tbody")
        .html(html)
        .ready(function () {
          tooltip(".domain-name-info", 20);
          $(".btn-detail-domain").click(function () {
            domain_id = $(this).attr("domain_id");
            $(".close-modal-domain").click();
            getDomainByID(domain_id);
          });

          $(".btn-status-domain").click(function () {
            domainID = $(this).attr("domain_id").split("_")[0];
            status = $(this).attr("domain_id").split("_")[1] == "show" ? 0 : 1;

            $.ajax({
              url: base_url + "api/Controller/ActiveInactiveDomain.php",
              data: JSON.stringify({
                domain_id: domainID,
                domain_active: status,
              }),
              dataType: "JSON",
              type: "POST",
              async: false,
              success: function (data) {
                switch (data.code) {
                  case 400:
                    showAlert(
                      "warning",
                      "Thiếu Dữ Liệu Không Thể Cập Nhật Trạng Thái."
                    );
                    break;
                  case 500:
                    showAlert(
                      "error",
                      "Hệ Thống Lỗi Không Thể Cập Nhật Trạng Thái."
                    );
                    break;
                  case 200:
                    showAlert(
                      "success",
                      "Cập Nhật Trạng Thái Tên Miền Thành Công."
                    );
                    getDomain(webID);
                    break;
                  case 403:
                    showAlert(
                      "warning",
                      "Phiên đăng nhập hết hạn! Vui Lòng Tải Lại Trang Để Đăng Nhập Lại!"
                    );
                    break;
                  default:
                    showAlert("error", "Lỗi Không Xác Định.");
                    break;
                }
              },
              error: function (data) {
                showAlert("error", data.responseText);
              },
            });
          });
        });
    },
    error: function (data) {
      showAlert("error", data.responseText);
    },
  });
}

function getDomainByID(domainID) {
  $.ajax({
    data: JSON.stringify({ domain_id: domainID }),
    dataType: "JSON",
    type: "POST",
    url: base_url + "api/Controller/getDomainByID.php",
    async: false,
    success: function (data) {
      if (data.code == 403) {
        showAlert(
          "warning",
          "Phiên đăng nhập hết hạn! Vui Lòng Tải Lại Trang Để Đăng Nhập Lại!"
        );
      } else {
        $("#input-domain-detail").val(data.domain_name);
        $("#update-domain-btn").attr("domain-id", data.domain_id);
      }
    },
    error: function (data) {
      showAlert("error", data.responseText);
    },
  });
}
