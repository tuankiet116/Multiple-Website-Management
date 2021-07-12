/**
 * Show alert with type of alert and message 
 * 
 * @param {string} type 
 * @param {string} message 
 */
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
  $('.alert').addClass('show');
  setTimeout(function(){ $('.alert').removeClass('show'); }, 3000);

  $('.alert button.close').on('click', function(){
    $('.alert').removeClass('show');
  });
}


/**
 * Call AJAX
 * 
 * @param {stringify Json object} data 
 * @param {string} url 
 * @param {function} success 
 * @param {function} error 
 * @param {string} type 
 * @param {string} dataType 
 * @param {boolean} async 
 */
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

