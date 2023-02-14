$(document).ready(function () {
  $("#submit-btn").click(function (e) {
    e.preventDefault();
    createTable();
  });
});

function createTable() {
  var input = document.getElementById("number").value;
  $.ajax({
    type: "POST",
    url: "include/functions_dealer.php",
    data: { input: input, retriveTokenInfo: "success" },
    dataType: "text",
    success: function (data) {
      document.getElementById("tblToken").innerHTML = data;
    },
  });
}

function tokenClick() {
  if (confirm("Are you sure to perform this action")) {
    var id = document.getElementById("btn").value;
    let myTable = document.getElementById("result-table");
    var rowVal;
    for (var i = 0, row; (row = myTable.rows[i]); i++) {
      for (var j = 0, col; (col = row.cells[j]); j++) {
        if (col.innerText == id) {
          rowVal = i;
          break;
        }
      }
    }

    let email =
      document.getElementById("result-table").rows[rowVal].cells[0].innerHTML;
    let regNo =
      document.getElementById("result-table").rows[rowVal].cells[2].innerHTML;
    let qty =
      document.getElementById("result-table").rows[rowVal].cells[7].innerHTML;

    console.log(email, regNo, qty);

    $.ajax({
      type: "POST",
      url: "include/functions_dealer.php",
      data: {
        token: id,
        isPumped: "success",
        email: email,
        regNo: regNo,
        qty: qty,
      },
      dataType: "text",
      success: function (data) {
        alert(data);
        createTable();
      },
    });
  }
}

$('#number').change(function() {
  createTable();
});
