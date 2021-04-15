const finish = document.getElementById("finish-alert");
const finish_remove = document.getElementById("finish-remove");

finish_remove.addEventListener("click", () => (finish.style.opacity = "0"));
finish.addEventListener("transitionend", () => finish.remove());

setTimeout(() => {
  const finish_alert = document.getElementById("finish-alert");
  finish_alert.style.opacity = "0";
  finish_alert.addEventListener("transitionend", () => finish_alert.remove());
}, 3000);

const start = document.getElementById("start-alert");
const start_remove = document.getElementById("start-remove");

start_remove.addEventListener("click", () => (start.style.opacity = "0"));
start.addEventListener("transitionend", () => start.remove());

setTimeout(() => {
  const start_alert = document.getElementById("start-alert");
  start_alert.style.opacity = "0";
  start_alert.addEventListener("transitionend", start_alert.remove());
}, 3000);

function searchBtn() {
  document.getElementById("member_id").value = "0";
  document.getElementById("name").value = "";
  document.getElementById("time-total").value = "";
  document.getElementById("checkin_time").value = "";
  document.getElementById("checkout_time").value = "";
}

function month() {
  var month_select = document.getElementById("month_id");
  var button_select = document.getElementById("export_excel");

  button_select.disabled = !month_select.value;
}

var start = 1900;
var end = new Date().getFullYear();
var options = "";

for (var year = start; year <= end; year++) {
  options += "<option value='" + year + "'>" + year + "</option>";
}
document.getElementById("year_id").innerHTML = options;

(function () {
  var default_select = (document.getElementById("year_id").value = end);
})();