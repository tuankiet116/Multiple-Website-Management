$(document).ready(function () {
  $(".loader-container").css("display", "none");
  $('b[role="presentation"]').hide();
  $(".select2-arrow").append('<i class="fa fa-angle-down"></i>');
  //Select2 For Pick Website
  $(".pick_website_select").select2({
    ajax: {
      url: "../../../api/Controller/searchTerm.php",
      type: "POST",
      dataType: "json",
      delay: 250,
      data: function (params) {
        if (params.term == null) {
          var obj = {
            term: "",
          };
        } else {
          var obj = {
            term: params.term.trim(),
          };
        }

        return JSON.stringify(obj);
      },
      processResults: function (data, params) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.web_name,
              id: item.web_id,
              image: checkdefault(
                "data/web_icon/icon_default/default.png",
                item.web_icon
              ),
              description: item.web_description,
              data: item,
            };
          }),
        };
      },
      cache: false,
    },
    placeholder: "Search for a Website",
    minimumInputLength: 0,
    templateResult: formatRepoWebsite,
    templateSelection: formatRepoSelectionWebsite,
  });

  ajaxSearchingPayment(null);

  $("#search_button").on("click", function () {
    var data = {
      web_id: $(".pick_website_select").select2("val"),
      payment_method:
        $("#payment-method").val() != "#" ? $("#payment-method").val() : null,
      payment_active:
        $("#payment-status").val() == "1" || $("#payment-status").val() == "0"
          ? $("#payment-status").val()
          : null,
    };

    ajaxSearchingPayment(data);
  });

  $("#clear_button").on("click", function () {
    $(".pick_website_select").empty();
    $("#payment-method").val("#").niceSelect("update");
    $("#payment-status").val("#").niceSelect("update");
  });

  //Nice Select
  $("#payment-status").niceSelect();
  $("#payment-method").niceSelect();
  $('#payment_method_add').niceSelect();
  addPaymentForWebsite();
  checkPaymentMethod();
});

/**
 * Base URL is used to define URL of API
 */
var base_url = "../../../";

/**
 * format function is used to define result list of select2 components
 *
 * @param {object} repo
 * @returns html
 */
function formatRepoWebsite(repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-website clearfix' id='result_website_" +
      repo.id +
      "'>" +
      "<div class='select2-result-website__icon'><img src='" +
      base_url +
      repo.image +
      "' /></div>" +
      "<div class='select2-result-website__meta'>" +
      "<div class='select2-result-website__title'></div>" +
      "<div class='select2-result-website__description'></div>" +
      "</div>" +
      "</div>"
  );

  $container.find(".select2-result-website__title").text(repo.text);
  $container
    .find(".select2-result-website__description")
    .text(repo.description);

  return $container;
}

/**
 * format function is used to define result selection of select2 components
 *
 * @param {object} state
 * @returns html
 */
function formatRepoSelectionWebsite(state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<span id = "website_' +
      state.id +
      '"><img class="img-flag" /> <span></span></span>'
  );

  // Use .text() instead of HTML string concatenation to avoid script injection issues
  $state.find("span").text(state.text);
  $state.find("img").attr("src", base_url + state.image);

  return $state;
} //End Of Function Website Select2

//set default image which null value
function checkdefault(default_value, check_parameter) {
  if (check_parameter == null || check_parameter == "") {
    return default_value;
  }
  return check_parameter;
}

/**
 * Used to search payment data
 * If data == null will searching for all data
 * If data != null will searching by data parameter
 *
 * @param {JSON object} data
 */
function ajaxSearchingPayment(data) {
  $.ajax({
    type: "POST",
    dataType: "JSON",
    url: "../../../api/Controller/getAllPayment.php",
    data: JSON.stringify(data),
    async: false,
    success: function (data) {
      paymentSuccess(data);
    },
    error: function (data) {
      paymentError(data);
    },
  });
  $(".loader-container").css("display", "none");
}

/**
 * Function is used to action when the system's got successed searching
 * @param {JSON object} data
 */
function paymentSuccess(data) {
  if (data.code == 404) {
    html = `<tr>
                <td colspan = 6 style="
                text-align: center;
                font-size: 20px;
                color: red;
                "> 
                NOT FOUND</td>
            </tr>`;
    $("tbody").html(html);
    return;
  } else {
    html = "";
    stt = 0;
    data.forEach(function (value, key) {
      var action = "";
      var status = "";
      var post_type_status = "";

      if (value.payment_access_key == null || value.payment_access_key == "") {
        value.payment_access_key = "<p style = 'color: red'>Nah</p>";
      }

      if (value.payment_secret_key == null || value.payment_secret_key == "") {
        value.payment_secret_key = "<p style = 'color: red'>Nah</p>";
      }

      if (
        value.payment_partner_code == null ||
        value.payment_partner_code == ""
      ) {
        value.payment_partner_code = "<p style = 'color: red'>Nah</p>";
      }

      if (value.payment_active == 1) {
        status =
          '<button style = "width: 100px;" id="payment_show_' +
          value.payment_id +
          '" type="button" class="btn btn-basic status_button">Đã Kích Hoạt</button>';
      } else {
        status =
          '<button style = "width: 100px;" id="payment_hide_' +
          value.payment_id +
          '" type="button" class="btn btn-danger status_button">Đã Vô Hiệu Hóa</button>';
      }

      action =
        '<a style = "color: white; text-decoration: none;" href="payment_detail.php?record_id=' +
        value.payment_id +
        "&web_id=" +
        value.web_id +
        '">' +
        '<button style = "margin-left: 10px; width: 60px;" id = "info_payment_' +
        value.payment_id +
        '" type="button" class="btn btn-info">Chi Tiết</button></a>';

      stt++;
      html +=
        `<tr>
                  <th style="width: 30px; text-align: center" scope="row">` +
        stt +
        `</th>
                  <td style="text-align: center;"><div><p style = 'word-wrap: break-word'>` +
        value.web_name +
        `</p></div></td>
                  <td style="text-align: center;"><div><p style = 'word-wrap: break-word'>` +
        value.payment_method +
        `</p></div></td>
                  <td style="width: 100px; text-align: center;"><div><p style = 'word-wrap: break-word'>` +
        value.payment_partner_code +
        `</p></div></td>
                  <td style="width: 100px; text-align: center;"><div><p style = 'word-wrap: break-word'>` +
        value.payment_access_key +
        `</p></div></td>
                  <td style="width: 100px; text-align: center;"><div><p style = 'word-wrap: break-word'>` +
        value.payment_secret_key +
        `</p></div></td>
                  <td style="text-align: center;">` +
        status +
        `</td>
                  <td style="text-align: center;">` +
        action +
        ` </td>
              </tr>`;
    });
    $("tbody")
      .html(html)
      .ready(function () {
        IActiveButton();
      });
  }
}

/**
 * The function is used to catch error of searching payment data
 *
 * @param {JSON object} data
 */
function paymentError(data) {
  if (data.code == 404) {
    html = `<tr>
                  <td colspan = 6 style="
                  text-align: center;
                  font-size: 20px;
                  color: red;
                  "> 
                  NOT FOUND</td>
              </tr>`;
    $("tbody").html(html);
  } else {
    html =
      `<tr>
                  <td colspan = 6 style="
                  text-align: center;
                  font-size: 20px;
                  color: red;
                  "> 
                  ` +
      data.responseText +
      `</td>
              </tr>`;
    $("tbody").html(html);
  }
}

/**
 * Function is used to active or inactive payment method
 */
function IActiveButton() {
  $(".status_button").on("click", function () {
    element = $(this).attr("id");
    id = element.split("_")[2];
    type = element.split("_")[1] == "show" ? 0 : 1;

    $(".loader-container").css("display", "flex");
    data = {
      payment_id: id,
      payment_active: type,
    };
    $.ajax({
      type: "POST",
      dataType: "JSON",
      data: JSON.stringify(data),
      async: false,
      url: "../../../api/Controller/ActiveInactivePayment.php",
      success: function (data) {
        if (data.code == 200) {
          showAlert("success", data.message);
        } else {
          showAlert("error", data.code + ": " + data.message);
        }
      },
      error: function (request, status, error) {
        showAlert("error", request.responseText);
      },
    });

    ajaxSearchingPayment(null);
  });
}

function addPaymentForWebsite(){
  $('#btn-payment-add').click(function(){
    let data = {
      'web_id': $('.pick_website_select.add').select2('val'),
      'payment_method': $('#payment_method_add').val(),
      'payment_partner_code': $('#payment_partner_code').val(),
      'payment_access_key': $('#payment_access_key').val(),
      'payment_secret_key': $('#payment_secret_key').val(),
    }
    console.log(data);
    $(".loader-container").css("display", "flex");

    $.ajax({
      type: "POST",
      url: base_url+"api/Controller/createPayment.php",
      data: JSON.stringify(data),
      dataType: "JSON",
      success: function (res) {
          $(".loader-container").css("display", "none");
          if(res.code == 200){
            showAlert('success', `<p>${res.message}</p>`);
            $('#btn-close-bottom').click();
            $('.modal-backdrop').css("display", "none");
            $('#form-add')[0].reset();
          }
          else{
            showAlert('error', `<p>${res?.message}</p>`);
          }
      },
      error: function(res){
        $(".loader-container").css("display", "none");
        console.log(res.responseText);
      }
    });
  })
}

function checkPaymentMethod(){
  $('#payment_method_add').change(function(){
    if($(this).val() == "2"){
      $('#payment_partner_code').removeAttr('disabled');
      $('#payment_access_key').removeAttr('disabled');
      $('#payment_secret_key').removeAttr('disabled');
    }
    else{
      $('#payment_partner_code').prop('disabled', true);
      $('#payment_access_key').prop('disabled', true);
      $('#payment_secret_key').prop('disabled', true);
    }
  })
}



