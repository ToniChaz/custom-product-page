// Declare vars
var $ = jQuery;
var Product = {};

// Add rows in table
Product.addRow = function(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  if (rowCount < 5) { // limit the user from creating fields more than your limits
    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    for (var i = 0; i < colCount; i++) {
      var newcell = row.insertCell(i);
      newcell.innerHTML = table.rows[0].cells[i].innerHTML;
    }
  } else {
    alert("Maximum data per product is 5");

  }
};

// Delete rows from table
Product.deleteRow = function(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  for (var i = 0; i < rowCount; i++) {
    var row = table.rows[i];
    var chkbox = row.cells[0].childNodes[1];
    if (null != chkbox && true == chkbox.checked) {
      if (rowCount <= 1) { // limit the user from removing all the fields
        alert("Cannot remove all the data.");
        break;
      }
      table.deleteRow(i);
      rowCount--;
      i--;
    }
  }
};

// When document is ready
$(document).ready(function() {

  // Initialize tabs
  $(function() {      
    $("#tabs").tabs();    
  });

});