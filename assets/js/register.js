$("#registerForm").on("submit", function (event) {
  event.preventDefault();
  let surName = $("#sureName").val();
  let firstName = $("#firstName").val();
  let email = $("#email").val();
  let password = $("#password").val();
  let confirm_password = $("#confirm_password").val();

  if (
    surName.length == 0 ||
    firstName.length == 0 ||
    email.length == 0 ||
    password.length == 0 ||
    confirm_password.length == 0
  ) {
    swAlert("error", "Minden mező kitöltése kötelező!", 2000);
  } else {
    let name = surName + " " + firstName;

    if (!validateEmail(email)) {
      if (password != confirm_password) {
        swAlert("error", "A jelszavak nem egyeznek!", 2000);
      } else {
        let reg = $.ajax({
          url: "/api/reg.php",
          method: "post",
          data: {
            token: "RegisterUserFromSite6432",
            name: name,
            login: firstName,
            email: email,
            password: password,
            confirm_password: confirm_password,
          },
        });

        reg.done(function (res) {
          console.log(res);
          let result = JSON.parse(res);
          swAlert(result["result"], result["log"]);
          if (result["result"] == "success") {
            window.setTimeout(function () {
              window.location = "/";
            }, 2000);
          }
        });

        reg.fail(function () {
          swAlert("error", "Sikertelen regisztráció :(");
        });
      }
    } else {
      swAlert("error", "Érvényes email címet adj meg!");
    }
  }
});