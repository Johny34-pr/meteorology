function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".file-upload-wrap").hide();
      $(".file-upload-content").show();
      $("#uploadBtn").removeClass("visually-hidden");

      $(".file-title").html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);
  } else {
    removeUpload();
  }
}

function removeUpload() {
  // For jQuery 1.10.2, replaceWith doesn't support cloning events, using direct val() and clone instead
  var inputField = $(".file-upload-input");
  inputField.replaceWith(inputField.val("").clone());
  $(".file-upload-content").hide();
  $(".file-upload-wrap").show();
  $(".file-upload-wrap").removeClass("file-dropping");
  $("#uploadBtn").addClass("visually-hidden");
}

// Use .on() instead of .bind() for drag events
$(".file-upload-wrap").on("dragover", function () {
  $(".file-upload-wrap").addClass("file-dropping");
});

$(".file-upload-wrap").on("dragleave", function () {
  $(".file-upload-wrap").removeClass("file-dropping");
});

$("#uploadFile").on("click", function (e) {
  e.preventDefault();

  // create FormData object
  var file = $("#file")[0].files[0];
  var extension = file["name"].replace(/^.*\./, "");

  var formData = new FormData($("#updateReport")[0]);

  if (extension == "xlsx") {
    // create AJAX request
    let upload = $.ajax({
      url: "/assets/php/api/reportUpload.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        return xhr;
      },
    });

    upload.done(function (res) {
      var result = JSON.parse(res); // Ensure 'var' for older compatibility
      alert(result["result"], result["log"], 2000);
      if (result["result"] == "success") {
        alert("success", "Sikeres jegyzőkönyszerkesztő feltöltés!", 2000);
        removeUpload();
      }
    });

    upload.fail(function () {
      alert("error", "A feltöltés nem sikerült!", 2000);
    });
  } else {
    alert("error", "Nem excel(xlsx) a feltölteni kívánt fájl!", 3000);
  }
});

function findStringInTable(panel, searchString) {
  var result = null;
  var panel = "#" + panel + " tr";
  $(panel).each(function () {
    var cell = $(this).find("td:nth-child(2)");
    if (cell.text().indexOf(searchString) !== -1) {
      result = $(this);
      return false; // Break loop by returning false in jQuery 1.10.2
    }
  });

  return result;
}

function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}

$("#phone").on('input', function(){
  let phone = $("#phone").val();
  $("#phone").val(formatPhone(phone));
});

function formatPhone(phone) {
    // Csak számokat tartalmazó változó
    phone = phone.replace(/\D/g, '');

    // Formátum +36 XX XXX XXXX vagy 06 XX XXX XXXX
    if (phone.startsWith("36") || phone.startsWith("06")) {
        if (phone.length >= 11) {
            return phone.replace(/^(\d{2})(\d{2})(\d{3})(\d{4})$/, "$1 $2 $3 $4");
        } else if (phone.length >= 10) {
            return phone.replace(/^(\d{2})(\d{2})(\d{3})(\d{3})$/, "$1 $2 $3 $4");
        }
    } else if (phone.startsWith("1") || phone.length >= 7) {
        // Vezetékes telefonszám formázása: XX XXX XXXX
        return phone.replace(/^(\d{2})(\d{3})(\d{4})$/, "$1 $2 $3");
    }

    // Eredeti formátum visszaadása, ha nincs elegendő karakter
    return phone;
}