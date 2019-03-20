$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
var saveAll = document.getElementById('saveRoute');
var cancelAll = document.getElementById('cancelAddRoute');


var addRowBtn = document.getElementById('addRow');
var table = document.getElementById('coverage');
addRowBtn.addEventListener('click', addRow);
var rowcount = 0;
var modal = document.getElementById('addCoverage');
var close = document.getElementById('addCovClose');
var span = document.getElementsByClassName("close")[0];
var addCov = document.getElementById('addCov');
var results;
var searchButton = document.getElementById('searchBtn');
var box = document.getElementById('searchbox');
var mapMainView = document.getElementById('mapMain');
var mapAdd = L.map('mapAdd');
var highlightLayerMapAdd = L.layerGroup().addTo(mapAdd);
var resultView = document.getElementById("searchResult");
var curID = "";
var chosenCov = "";
var covList = {coverageList : []};
var circleList = {circleList : []};
var centerList = {centerList : []};
var mapMain = L.map('mapMain');
var highlightLayerMapMain = L.layerGroup().addTo(mapMain);
var layerMain = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'map-main-routes'
});
layerMain.addTo(mapMain);
mapMain.setView([12.8797, 121.7740], 5);


span.onclick = function() {
  modal.style.display = "none";
  mapMainView.style.display = 'block';
  resultView.innerHTML = "";
  box.value = "";
  highlightLayerMapAdd.clearLayers();
  chosenCov = "";
}

close.onclick = function() {
  modal.style.display = "none";
  mapMainView.style.display = 'block';
  resultView.innerHTML = "";
  box.value = "";
  highlightLayerMapAdd.clearLayers();
  chosenCov = "";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    mapMainView.style.display = 'block';
    resultView.innerHTML = "";
    box.value = "";
    highlightLayerMapAdd.clearLayers();
    chosenCov = "";
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
    coverageInput.setAttribute("name", "coveInptBox");
    coverageInput.setAttribute("readonly", "true");
    coverageInput.setAttribute("placeholder", "Click to add coverage");
    coverageInput.setAttribute("style", "width: 28rem");
    coverageInput.setAttribute("onClick", "showModal(this.id)")
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
    
}

function deleteRow(show) {
    var id = parseInt(show) + 1;
    var rowValue = document.getElementById("cov".concat(show));
    for(var c = 0; c < circleList.circleList.length; c++) {
      if(rowValue.value == circleList.circleList[c].name) {
        highlightLayerMapMain.removeLayer(circleList.circleList[c].circle);
        delete circleList.circleList[c];
      }
    }
    var tempArr = { circleList : []};
    for(var d = 0; d < circleList.circleList.length; d++) {
      if(circleList.circleList[d] != null) {
        tempArr['circleList'].push(circleList.circleList[d])
      }
    }
    circleList.circleList.pop();
    circleList.circleList = tempArr.circleList;
//---------------------------------------------------------------------------
    for(var c = 0; c < covList.coverageList.length; c++) {
      if(rowValue.value == covList.coverageList[c].name) {
        delete covList.coverageList[c];
      }
    }
    tempArr = { coverageList : []};
    for(var d = 0; d < covList.coverageList.length; d++) {
      if(covList.coverageList[d] != null) {
        tempArr['coverageList'].push(covList.coverageList[d])
      }
    }
    covList.coverageList.pop();
    covList.coverageList = tempArr.coverageList;

    table.deleteRow(id);
    rowcount = rowcount - 1

    var deleteRows = document.getElementsByName("delete");
    for(var a = 0; a < rowcount; a++) {
      deleteRows[a].setAttribute("id", a);
    }

    var inputRows = document.getElementsByName("coveInptBox");
    for(var b = 0; b < rowcount; b++) {
      inputRows[b].setAttribute("id", "cov".concat(b));
    }


}

function showModal(addBoxID) {
    var layerAdd = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets',
    // accessToken: 'map-add-routes'
  });
  curID = addBoxID;
  layerAdd.addTo(mapAdd);
  L.Util.requestAnimFrame(mapAdd.invalidateSize,mapAdd,!1,mapAdd._container);
  mapMainView.style.display = 'none';
  mapAdd.setView([12.8797, 121.7740], 5);
  modal.style.display = "block";
  box.focus();
}

searchButton.onclick = function() {
  chosenCov = "";
  var data = box.value;
  var access_token = "pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ2eWF6azBsajI0NG05emk2dnlzcGUifQ.yD_bma0GaPOkG3ZuHyQV_w";
  var country = "PH"
  if(data != "") {
    $.ajax ({
      url: "https://api.mapbox.com/geocoding/v5/mapbox.places/" + data + ".json?access_token=" + access_token + "&country=" + country +"&autocomplete=false&limit=10&types=place,locality",
      type: "GET"
      ,success:function(data) {
          console.log(data);
          highlightLayerMapAdd.clearLayers();
          mapAdd.setView([12.8797, 121.7740], 5);
          results = data.features;
          resultView.innerHTML = "";
          var headRow = resultView.insertRow(-1);
          if(results.length > 0) {
            var headTitle = document.createElement("th");
            headTitle.innerHTML = "Search Result";
            var head =  document.createElement("thead");
            head.appendChild(headTitle);
            headRow.appendChild(head);
          } else {
            var headTitle = document.createElement("th");
            headTitle.innerHTML = "Not Found - try to be more specific";
            var head =  document.createElement("thead");
            head.appendChild(headTitle);
            headRow.appendChild(head);
          }
  
          for(var a = 0; a < results.length; a++) {
            
            var cell = resultView.insertRow(-1);
            cell.setAttribute("id",a);
            cell.setAttribute("class", "form-control form-control-sm");
            cell.setAttribute("style", "border: none")
            cell.setAttribute("onClick", "placeOnMap(this.id)");
            cell.innerHTML = results[a].place_name;
            // console.log(results[a].geometry.coordinates);
            L.circle([results[a].center[1], results[a].center[0]], {
              color: 'red',
              fillColor: '#f03',
              fillOpacity: 0.5,
              radius: 3000
            }).addTo(highlightLayerMapAdd);
          }
        },error:function(data) {
            alert(data.success);
        }
    });
  } else {
    alert("Define a place");
  }
}

function placeOnMap(id) {
  highlightLayerMapAdd.clearLayers();
  var center = [results[id].center[1], results[id].center[0]];
  mapAdd.setView(center, 13)
  L.circle(center, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 2000
  }).addTo(highlightLayerMapAdd);
  chosenCov = {
    name : results[id].place_name,
    coordinate : center,
    bbox : results[id].bbox
  };
  // console.log(center);
  // console.log(L.GeometryUtil.length([center, center]));
}

addCov.onclick = function() {
  if(chosenCov == "") {
    alert("Please choose a coverage");
  } else {
    var added = false;
    for(var x = 0; x < circleList.circleList.length; x++) {
      if(chosenCov.name == circleList.circleList[x].name)
        added = true;
    }
    if(!added) {
      covList['coverageList'].push({name : chosenCov.name,
                                    coordinate : chosenCov.coordinate,
                                    bbox: chosenCov.bbox});
      var circ = L.circle(chosenCov.coordinate, {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 2000
      }).addTo(highlightLayerMapMain);
      circleList['circleList'].push({name : chosenCov.name, circle: circ});
      console.log(circleList);
      var newCovBox = document.getElementById(curID);
      newCovBox.value = chosenCov.name;
      modal.style.display = "none";
      mapMainView.style.display = 'block';
      resultView.innerHTML = "";
      box.value = "";
      highlightLayerMapAdd.clearLayers();
    } else {
      alert("Coverage already added");
    }
  }
  console.log(covList);
}

saveAll.onclick = function() {
  var name = document.getElementById("routeName");
  var list = covList.coverageList;
  console.log(list);
  $.ajax ({
    url: "/routes/addroute/save",
    type: "POST",
    data: {
      name : name.value,
      list : list,
    },
    success:function(data) {
        window.location.href = "/routes";
    },error:function(data) {
        alert(data.success);
    }
  });
}

cancelAll.onclick = function() {
  window.location.href = "/routes";
}