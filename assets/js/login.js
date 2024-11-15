
$('#loginForm').on("submit", function (event) {
  event.preventDefault();

  let email = $("#email").val();
  let pass = $("#password").val();

  if (!validateEmail(email)) {
    if (pass.length == 0) {
      swAlert("error", "Minden mező kitöltése kötelező!");
    } else {
      var login = $.ajax({
        url: "/api/login.php",
        method: "post",
        data: {
          email: email,
          password: pass
        },
      });

      login.done(function (res) {
        var result = JSON.parse(res);
        swAlert(result["result"], result["log"]);
        if (result["result"] == "success") {
          window.setTimeout(function () {
            window.location = "/";
          }, 2000);
        }
      });

      login.fail(function () {
        swAlert("error", "Sikertelen belépés :(");
      });
    }
  } else {
    swAlert("error", "Érvényes email címet adj meg!");
  }
});