let rowNumber = 0;
let pageNumber = 0;
let currRowNum = 0;
let currPage = 1;
let y = 0;

$(document).ready(function () {
  let request = $.ajax({
    url: "/api/users-select.php",
    method: "post",
    data: {
      token: "SelectAllUserFromDBOnAdminPg5345",
      order: "ASC",
    },
  });

  request.done(function (res) {
    result = JSON.parse(res);

    let field = "";

    let userNumber = result["dataset"].length;
    let userPerPage = 10;
    pageNumber = Math.ceil(userNumber / userPerPage);
    let x = 0;

    for (i = 1; i <= pageNumber; i++) {
      field = "";
      for (j = x + 0; j < x + userPerPage; j++) {
        if (!$.isEmptyObject(result["dataset"][j])) {
          if (x != 0) {
            field += "<tr class='visually-hidden' id='row-" + j + "'>";
          } else {
            field += "<tr id='row-" + j + "'>";
          }
          let sn = j + 1;
          field +=
            "<td class='text-center'>" +
            sn +
            "</td><td><a href='#'><img src='/img/user/avatar.jpg" +
            "' class='avatar' alt='Avatar'>" +
            result["dataset"][j]["name"] +
            "</a></td><td>" +
            result["dataset"][j]["email"] +
            "</td><td>" +
            result["dataset"][j]["station_name"] +
            "</td><td>" +
            result["dataset"][j]["reg_time"] +
            "</td><td class='text-center'><span class='settings userEdit' title='Módosítás' data-toggle='tooltip'><i class='fa-solid fa-gear'></i></span><span class='deletePopUp' title='Törlés' data-toggle='tooltip'><i class='fa-regular fa-circle-xmark'></i></span></td></tr>";
          rowNumber++;
        } else {
          break;
        }
      }

      $("#users-panel").append(field);
      x += 10;
    }
    pagination("users-panel");

    $("#showedRows").html(showedRows);
    $("#allRows").html(rowNumber);
  });

  request.fail(function () {
    swAlert("error", "A felhaszálók betöltése sikertelen.", 2000);
  });
});

$(document).on("click", "#pagePrev", function () {
  if (currPage === 1) {
    return;
  }
  currPage--;
  pagination("users-panel");
});

$(document).on("click", "#pageNext", function () {
  if (currPage === pageNumber) {
    return;
  }
  currPage++;
  pagination("users-panel");
});

$(document).on("click", ".page", function () {
  currPage = $(this).text().trim();
  pagination("users-panel");
});

$(document).on("click", ".deletePopUp", function () {
  let row = $(this).closest("tr");
  name = row.find("td:nth-child(2)").text().trim();

  let request = $.ajax({
    url: "/api/user-select-name.php",
    method: "post",
    data: {
      token: "selectUserDataByNameFromDb5236",
      name: name,
    },
  });

  request.done(function (res) {
    let result = JSON.parse(res);
    userId = result["dataset"]["id"];
    userRank = result["dataset"]["rang"];
  });

  request.fail(function () {
    swAlert("error", "A felhasználó törlése sikertelen!", 2000);
  });

  $("#confirm").modal("toggle");
});

$(document).on("click", "#delete", function () {
  let request = $.ajax({
    url: "/api/user-select.php",
    method: "post",
    data: {
      token: "selectUserDataFromDb3241",
    },
  });

  request.done(function (res) {
    let result = JSON.parse(res);
    selfId = result["dataset"]["id"];
    selfRank = result["dataset"]["rang"];

    if (userRank < selfRank || userId === selfId) {
      let del = $.ajax({
        url: "/api/user-delete.php",
        type: "post",
        data: {
          token: "DeleteUserFromSiteByAdmin4234",
          id: userId,
        },
      });

      del.done(function (res) {
        console.log(res);
        result = JSON.parse(res);

        swAlert(result["result"], result["log"], 2000);

        if (result["result"] == "success") {
          let resultRow = findStringInTable("users-panel", name);

          if (resultRow) {
            resultRow.remove();
            $("#showedRows").html(showedRows - 1);
          } else {
            console.log("Nincs találat!");
          }

          $("#confirm").modal("toggle");

          if (userId === selfId) {
            window.setInterval(function () {
              window.location = "/admin/login.php";
            }, 2000);
          }
        } else {
          swAlert("error", "Hiba törlés közben.", 2000);
        }
      });

      del.fail(function () {
        swAlert("error", "Hiba törlés közben.", 2000);
      });
    }
  });

  request.fail(function () {
    swAlert("error", "A felhasználó törlése sikertelen!", 2000);
  });
});

$(document).on("click", ".userEdit", function () {
  let ranks = {
    Felhasználó: 1,
    Moderátor: 2,
    Adminisztrátor: 3,
    Webmester: 4,
  };

  let row = $(this).closest("tr");

  img = row.find("img");
  let name = row.find("td:nth-child(2)").text().trim();

  let request = $.ajax({
    url: "/api/user-select-name.php",
    method: "post",
    data: {
      token: "selectUserDataByNameFromDb5236",
      name: name,
    },
  });

  request.done(function (res) {
    let userData = JSON.parse(res);
    let id = userData["dataset"]["id"];

    let user = new User(
      id,
      row.find("td:nth-child(2)").text().trim(),
      row.find("td:nth-child(3)").text().trim(),
      row.find("td:nth-child(4)").text().trim(),
      row.find("td:nth-child(5)").text().trim(),
      row.find("td:nth-child(6)").text().trim()
    );

    request = $.ajax({
      url: "/api/user-select.php",
      method: "post",
      data: {
        token: "selectUserDataFromDb3241",
      },
    });

    request.done(function (res) {
      let userData = JSON.parse(res);
      id = userData["dataset"]["id"];
      let rank = userData["dataset"]["rang"];

      if (ranks[user.rank] < rank || user.id == id) {
        let field = row.find("td:nth-child(7)");
        let field_value =
          "<span class='settings saveUser' title='Mentés' data-toggle='tooltip'><i class='bx bxs-save text-primary'></i></span><span class='deletePopUp' title='Törlés' data-toggle='tooltip'><i class='bx bxs-x-circle'></i></span>";
        field.html(field_value);

        field = row.find("td:nth-child(2)");
        field_value =
          "<input type='text' class='form-control' value='" + user.name + "'>";
        field.html(field_value);

        field = row.find("td:nth-child(3)");
        field_value =
          "<input type='text' class='form-control' value='" + user.email + "'>";
        field.html(field_value);

        field = row.find("td:nth-child(5)");
        field_value = "<select class='form-control'>";
        if (rank == 4) {
          if (user.id == id) {
            field_value +=
              "<option selected value='4'>Webmester</option><option value='3'>Adminisztrátor</option><option value='2'>Moderátor</option><option value='1'>";
          } else if (ranks[user.rank] == ranks["Adminisztrátor"]) {
            field_value +=
              "<option selected value='3'>Adminisztrátor</option><option value='2'>Moderátor</option><option value='1'>";
          } else if (ranks[user.rank] == ranks["Moderátor"]) {
            field_value +=
              "<option value='3'>Adminisztrátor</option><option selected value='2'>Moderátor</option><option value='1'>";
          } else if (ranks[user.rank] == ranks["Felhasználó"]) {
            field_value +=
              "<option value='3'>Adminisztrátor</option><option value='2'>Moderátor</option><option selected value='1'>";
          }
        } else if (rank == 3) {
          if (id == user.id) {
            field_value +=
              "<option selected value='3'>Adminisztrátor</option><option value='2'>Moderátor</option><option value='1'>";
          } else if (ranks[user.rank] == ranks["Moderátor"]) {
            field_value +=
              "<option selected value='2'>Moderátor</option><option value='1'>";
          } else if (ranks[user.rank] == ranks["Felhasználó"]) {
            field_value +=
              "<option value='2'>Moderátor</option><option selected value='1'>";
          }
        } else if (rank == 2) {
          if (ranks[user.rank] == ranks["Moderátor"]) {
            field_value +=
              "<option selected value='2'>Moderátor</option><option value='1'>";
          } else {
            field_value += "<option selected value='1'>";
          }
        } else {
          window.location = "/error/404.php";
        }
        field_value += "Felhasználó</option></select>";
        field.html(field_value);

        field = row.find("td:nth-child(6)");
        field_value =
          "<select class='form-control'><option selected value='1'>Aktív</option><option value='0'>Inkatív</option>";
        field.html(field_value);
      } else {
        swAlert(
          "error",
          "Nincs jogosultságod a felhasználó módosításához!",
          2000
        );
      }
    });
  });
});

$(document).on("click", ".saveUser", function () {
  let ranks = ["Felhasználó", "Moderátor", "Adminisztrátor", "Webmester"];

  let row = $(this).closest("tr");

  td = row.find("td:nth-child(2)");
  let name = td.find("input").val();

  td = row.find("td:nth-child(3)");
  let email = td.find("input").val();

  td = row.find("td:nth-child(5)");
  rank_usr = td.find("select").val();

  td = row.find("td:nth-child(6)");
  let state = td.find("select").val();

  let request = $.ajax({
    url: "/api/user-select-name.php",
    method: "post",
    data: {
      token: "selectUserDataByNameFromDb5236",
      name: name,
    },
  });

  request.done(function (res) {

    userData = JSON.parse(res);
    let usr_id = userData["dataset"]["id"];

    request = $.ajax({
      url: "/api/user-select.php",
      method: "post",
      data: {
        token: "selectUserDataFromDb3241",
      },
    });

    request.done(function (res) {
      userData = JSON.parse(res);
      let id = userData["dataset"]["id"];
      let rank = userData["dataset"]["rang"];

      if (rank_usr < rank || usr_id == id) {
        save = $.ajax({
          url: "/api/user-update.php",
          type: "post",
          data: {
            token: "UserUpdateFromSite442538",
            id: usr_id,
            name: name,
            email: email,
            rank: rank_usr,
            state: state,
          },
        });

        save.done(function (res) {
          result = JSON.parse(res);
          if (result == "success") {
            let field_value =
              "<a href='#'><img class='avatar' src='" +
              img[0].src +
              "' alt='Avatar'>" +
              name +
              "</a>";
            row.find("td:nth-child(2)").html(field_value);
            row.find("td:nth-child(3)").html(email);
            row.find("td:nth-child(5)").html(ranks[rank_usr - 1]);

            if (state == 1) {
              field_value =
                "<span class='status text-success pe-1'>&bull;</span>Aktív";
            } else {
              field_value =
                "<span class='status text-danger pe-1'>&bull;</span>Inaktív";
            }

            row.find("td:nth-child(6)").html(field_value);

            field_value =
              "<span class='settings userEdit' title='Módosítás' data-toggle='tooltip'><i class='bx bxs-cog'></i></span><span class='deletePopUp' title='Törlés' data-toggle='tooltip'><i class='bx bxs-x-circle'></i></span>";
            row.find("td:nth-child(7)").html(field_value);
            swAlert("success", "A felhasználó adatai sikeresen frissítve!", 2000);
          } else {
            swAlert("error", "Hiba mentés közben.", 2000);
          }
        });
        save.fail(function () {
          swAlert("error", "Hiba mentés közben.", 2000);
        });
      } else {
        swAlert("error", "Nincs jogosultságod a felhasználó módosításához!", 2000);
      }
    });
  });
});

$("#newUser").on("click", function () {
  if (3 <= rank) {
    window.location = "/php/subsites/user-add.php";
  } else {
    alert("error", "Nincs jogosultságod felhasználót regisztrálni!", 2000);
  }
});
