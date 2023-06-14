function displayDateTime() {
  var date = new Date();
  var optionsDate = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  var optionsTime = { hour: "numeric", minute: "numeric" };
  var formattedDate = date.toLocaleDateString("id-ID", optionsDate);
  var formattedTime = date.toLocaleTimeString("id-ID", optionsTime);

  var clock = document.getElementById("clock");
  clock.innerHTML =
    "<span class='tanggal'>" +
    formattedDate +
    "</span>" +
    "|" +
    "<span class='jam'>" +
    formattedTime +
    "</span>";

  setTimeout(displayDateTime, 1000); // Refresh setiap 1 detik
}

displayDateTime();
