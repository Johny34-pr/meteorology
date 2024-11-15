
$('#loginForm').on("submit", function (event) {
  event.preventDefault();

  let email = $("#email").val();
  let pass = $("#password").val();

  if (!validateEmail(email)) {
    if (pass.length == 0) {
      swAlert("error", "Minden mező kitöltése kötelező!", 2000);
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
        swAlert(result["result"], result["log"], 3000);
        if (result["result"] == "success") {
          window.setTimeout(function () {
            window.location = "/index.php";
          }, 2000);
        }
      });

      login.fail(function () {
        swAlert("error", "Sikertelen belépés :(", 2000);
      });
    }
  } else {
    swAlert("error", "Érvényes email címet adj meg!", 2000);
  }
});
function validateEmail(email) {
  error = false;
  if (email != 0) {
    if (isValidEmailAddress(email)) {
      error = false;
    } else {
      error = true;
    }
  } else {
    error = true;
  }

  function isValidEmailAddress(emailAddress) {
    var pattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return pattern.test(emailAddress);
  }

  return error;
}