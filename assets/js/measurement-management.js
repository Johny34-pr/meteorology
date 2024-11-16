let rowNumber = 0;
let pageNumber = 0;
let currRowNum = 0;
let currPage = 1;
let y = 0;

$(document).ready(function () {
  loadMeasurements();
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

$(document).on("click", ".deleteMeasure", function () {
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

function loadMeasurements() {
  $("#users-panel").empty();
  rowNumber = 0;
  let request = $.ajax({
    url: "/api/measurements-select.php",
    method: "post",
    data: {
      token: "SelectAllMEasurementsFromDBOnAdminPg5345",
      order: "ASC",
    },
  });

  request.done(function (result) {
    console.log(result);

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
          let station_name = ((result["dataset"][j]["station_name"]) ? result["dataset"][j]["station_name"] : "N/A");

          let sn = j + 1;
          field +=
            "<td class='text-center'>" +
            sn +
            "</td><td>" +
            result["dataset"][j]["operator_name"] +
            "</a></td><td>" +
            result["dataset"][j]["instrument_name"] +
            "</td><td>" +
            result["dataset"][j]["value"] +
            " " +
            result["dataset"][j]["unit"] +
            "</td><td>" +
            result["dataset"][j]["timestamp"] +
            "</td><td>" + 
            station_name +
            "</td><td class='text-center'><span class='deleteMeasure' title='Törlés' data-toggle='tooltip'><i class='fa-regular fa-circle-xmark'></i></span></td></tr>";
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
