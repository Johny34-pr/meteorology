let rowNumber = 0;
let pageNumber = 0;
let currRowNum = 0;
let currPage = 1;
let y = 0;

$(document).ready(function () {
  loadOperators();
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

$(document).on("click", ".deleteOperator", function () {
  let row = $(this).closest("tr");

  let name = row.find("td:nth-child(2)").text().trim();
  let email = row.find("td:nth-child(3)").text().trim();
  let station = row.find("td:nth-child(4)").text().trim();
  let regTime = row.find("td:nth-child(5)").text().trim();

  let operator = new Operator(name, email, station, regTime);
  let del = $.ajax({
    url: "/api/operator-delete.php",
    type: "post",
    data: {
      token: "DeleteOperatorFromSite4234",
      operator: operator,
    },
  });

  del.done(function (res) {
    result = JSON.parse(res);

    swAlert(result["result"], result["log"]);

    if (result["result"] == "success") {
      loadOperators();

    } else {
      swAlert("error", "Hiba törlés közben.");
    }
  });

  del.fail(function () {
    swAlert("error", "Hiba törlés közben.");
  });
});

$(document).on("click", ".userEdit", function () {
  let row = $(this).closest("tr");
  let request = $.ajax({
    url: "/api/listStations.php",
    method: "post",
    data: {
      token: "listStationsByOperator3242",
    },
  });

  request.done(function (result) {
    if (result["result"] === "error") {
      swAlert("error", result["result"]["log"]);
    } else {
      let nameField = row.find("td:nth-child(2)");
      let name = nameField.text().trim();
      let emailField = row.find("td:nth-child(3)");
      let email = emailField.text().trim();
      let stationField = row.find("td:nth-child(4)");
      let station = stationField.text().trim();
      let settings = row.find("td:nth-child(6)");

      let operator = new Operator(name, email, station);

      let field_value =
        "<span class='settings saveOperator' title='Módosítás' data-toggle='tooltip'><i class='fa-solid fa-floppy-disk'></i></span><span class='deletePopUp' title='Törlés' data-toggle='tooltip'><i class='fa-regular fa-circle-xmark'></i></span>";
      settings.html(field_value);

      field_value =
        "<input type='text' class='form-control' id='name' value='" +
        operator.name +
        "'>";
      nameField.html(field_value);

      field_value =
        "<input type='text' class='form-control' id='email' value='" +
        operator.email +
        "'>";
      emailField.html(field_value);

      field_value = "<select class='form-control' id='station'>";

      result["dataset"].forEach((station) => {
        field_value += "<option value='" + station["name"] + "'";

        if (station["name"] === operator.station_name) {
          field_value += "selected ";
        }
        field_value += ">" + station["name"] + "</option>";
      });

      field_value += "</select>";

      stationField.html(field_value);
    }
  });

  request.fail(function () {
    swAlert("error", "Nem sikerült az állomásnevek betöltése!");
  });
});

$(document).on("click", ".saveOperator", function () {
  let row = $(this).closest("tr");

  let nameField = $("#name");
  let name = nameField.val();
  let emailField = $("#email");
  let email = emailField.val();
  let stationField = $("#station");
  let station = stationField.val();
  let regDate = row.find("td:nth-child(5)").text().trim();

  let operator = new Operator(name, email, station, regDate);

  let save = $.ajax({
    url: "/api/operator-update.php",
    type: "post",
    data: {
      token: "OperatorUpdateFromSite442538",
      operator: operator,
    },
  });

  save.done(function (res) {
    result = JSON.parse(res);
    swAlert(result["result"], result["log"]);
    if (result["result"] == "success") {
      loadOperators();
    }
  });

  save.fail(function () {
    swAlert("error", "Hiba mentés közben.");
  });
});

function loadOperators() {
  $("#users-panel").empty();
  rowNumber = 0;
  let request = $.ajax({
    url: "/api/operators-select.php",
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
            "</td><td class='text-center'><span class='settings userEdit' title='Módosítás' data-toggle='tooltip'><i class='fa-solid fa-pen-to-square'></i></span><span class='deleteOperator' title='Törlés' data-toggle='tooltip'><i class='fa-regular fa-circle-xmark'></i></span></td></tr>";
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
}
