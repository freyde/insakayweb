
var addRowBtn = document.getElementById('addRow');
var table = document.getElementById('coverage');
addRowBtn.addEventListener('click', addRow);
var rowcount = 0;
var modal = document.getElementById('addCoverage');
var span = document.getElementsByClassName("close")[0];


var mapMainView = document.getElementById('mapMain');
var mapAdd = L.map('mapAdd');



var mapMain = L.map('mapMain');
var layerMain = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'map-main-routes'
});
layerMain.addTo(mapMain);
mapMain.setView([51.505, -0.09], 13);


span.onclick = function() {
  modal.style.display = "none";
  mapMainView.style.display = 'block';

}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    mapMainView.style.display = 'block';
  }
}

function addRow() {
    // var func = "deleteRow".rowcount
    // alert("sad");
    var row = table.insertRow(-1);
    row.setAttribute("id", "row".concat(rowcount))
    // table.deleteCell(1);
    var coverageInput = document.createElement("input");
    coverageInput.setAttribute("id", "cov".concat(rowcount));
    coverageInput.setAttribute("readonly", "true");
    coverageInput.setAttribute("placeholder", "Click to add coverage");
    coverageInput.setAttribute("onClick", "showModal()")
    var deleteBtn = document.createElement("input");
    deleteBtn.setAttribute("id", rowcount);
    deleteBtn.setAttribute("name", "delete");
    deleteBtn.setAttribute("type", "button");
    deleteBtn.setAttribute("style", "border-radius: 10px");
    deleteBtn.setAttribute("value", "delete");
    deleteBtn.setAttribute("onClick", "deleteRow(this.id)");
    
    // deleteBtn.setAttribute("alt", "add");
    var cell1 = row.insertCell(0);
    cell1.appendChild(coverageInput);
    var cell2 = row.insertCell(1);
    cell2.appendChild(deleteBtn);
    rowcount = rowcount + 1;
    console.log(table);
}

function deleteRow(show) {
    var id = parseInt(show) + 1;
    table.deleteRow(id);
    rowcount = rowcount - 1

    var tableRows = document.getElementsByName("delete");
    for(var a = 0; a < rowcount; a++) {
        tableRows[a].setAttribute("id", a);
    }
    console.log(table);
}

function showModal() {


  

  var layerAdd = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets',
    // accessToken: 'map-add-routes'
  });

  layerAdd.addTo(mapAdd);

  L.Util.requestAnimFrame(mapAdd.invalidateSize,mapAdd,!1,mapAdd._container);
  mapMainView.style.display = 'none';
  
  mapAdd.setView([51.505, -0.09], 13);
  modal.style.display = "block";
}

