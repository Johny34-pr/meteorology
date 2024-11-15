function displayRows(panel, startIndex, endIndex) {
  $("#" + panel + " tr").addClass("visually-hidden");
  showedRows = 0;

  for (var i = startIndex; i < endIndex; i++) {
    var row = $("#row-" + i);
    if (row.length) {
      row.removeClass("visually-hidden");
      showedRows++;
    }
  }

  $("#showedRows").html(showedRows);
}

function pagination(panel) {
  var totalPages = pageNumber;
  var startPage = Math.max(1, currPage - 2);
  var endPage = Math.min(startPage + 4, totalPages);

  if (1 < totalPages) {
    var field =
      "<li class='page-item' id='pagePrev'><button class='page-link'><u>Előző</u></button></li>";

    for (var i = startPage; i <= endPage; i++) {
      if (currPage == i) {
        field +=
          "<li class='page page-item active'><button class='page-link'>" +
          i +
          "</button></li>";
      } else {
        field +=
          "<li class='page page-item'><button class='page-link'>" +
          i +
          "</button></li>";
      }
    }
    field +=
      "<li class='page-item' id='pageNext'><button class='page-link'>Következő</button></li>";
  }

  $(".pagination").html(field);
  displayRows(panel, (currPage - 1) * 10, currPage * 10);
}
