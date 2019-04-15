$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var loader = document.getElementById('loader');
var done = document.getElementById('done');
var config = {
    apiKey: "AIzaSyAGVpkWk3EEyRicdXwr9lI5OhRi9yEndds",
    authDomain: "insakay-198614.firebaseapp.com",
    databaseURL: "https://insakay-198614.firebaseio.com",
    projectId: "insakay-198614",
    storageBucket: "insakay-198614.appspot.com",
    messagingSenderId: "768233361294"
  };
firebase.initializeApp(config);
var routeID = document.getElementById("routeID").value;
var uid = document.getElementById("uid").value;
var coverages;
firebase.database().ref('users/' + uid + '/routes').once("value").then(function(snapshot) {
    var snap = snapshot.val();
    Object.values(snap).forEach(function (route) {
        if(route.routeID == routeID) {
            coverages = route.coverage;
        } 
    }); 
});
var updated = false;
var addLandBtn = document.getElementById('addLand');
var addLandModal = document.getElementById('addLandmarkModal');
var addLandClose = document.getElementById('addLandClose');
var addLandClose2 = document.getElementsByClassName('close')[0];
var addLand = document.getElementById('addLandmark');
var landmarkName = document.getElementById('lmarkName');
var latitude = document.getElementById('lat');
var longitude = document.getElementById('lng');
var covArea = document.getElementById('coverage');
var id = document.getElementById('rID');

var curCovName;
var lat = document.getElementById('lmarkLat'),
    lng = document.getElementById('lmarkLng');

// addLandBtn.addEventListener('click', openAddLandmark);
addLandClose.addEventListener('click', closeAddLandmark);
addLandClose2.addEventListener('click', closeAddLandmark);
addLand.addEventListener('click', saveToFirebase);
window.addEventListener('click', clickOutside);
// var routeID = id.value;

var mapAddLand = L.map('mapAddLandmark', {
    zoomSnap: 0.5
});
var areaLayerMap = L.layerGroup().addTo(mapAddLand);
var markerLayerMap = L.layerGroup().addTo(mapAddLand);
var layerLandmark = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets-v10',
    accessToken: 'map-main-routes'
});

layerLandmark.addTo(mapAddLand);
mapAddLand.setView([12.8797, 121.7740], 5);
mapAddLand.scrollWheelZoom.disable();


function closeAddLandmark() {
    if(updated) {
        addLandModal.style.display = 'none';
        epLoader.style.display = 'block';
        window.location.href = '/routes/manage/'.concat(routeID);
    } else {
        addLandModal.style.display = 'none';
        landmarkName.value = '';
        lat.value = '';
        lng.value = '';
    }
}

function clickOutside(e) {
    if(e.target == addLandModal){
        if(updated) {
            addLandModal.style.display = 'none';
            epLoader.style.display = 'block';
            window.location.href = '/routes/manage/'.concat(routeID);
        } else {
            addLandModal.style.display = 'none';
            landmarkName.value = '';
            lat.value = '';
            lng.value = '';
        }
    }
}

function saveToFirebase() {
    if(landmarkName.value != "") {
        if(!lat.value== "" && !lng.value == "") {
            loader.style.display = 'block';
            $.ajax ({
                url: "/routes/addlandmark",
                type: "POST",
                data: {
                    landmarkName : landmarkName.value, 
                    coverage : curCovName,
                    coordinate : {
                        lat : lat.value,
                        lng : lng.value
                    },
                    routeID : routeID
                }, 
                success:function(data) {
                    loader.style.display = 'none';
                    done.style.display = 'block';
                    sleep(2000).then(() => {
                        done.style.display = 'none';
                      });
                    lat.value = "";
                    lng.value = "";
                    landmarkName.value = "";
                    updated = true;
                    addLandClose.value = "Done";
                },error:function(data) {
                    alert('Please');
                }
            });
        } else {
            alert("Please click the coordinate of the landmark");
        }
    } else {
        alert("Please provide the name of the landmark");
    }
}

addLandBtn.onclick = function() {  
    L.Util.requestAnimFrame(mapAddLand.invalidateSize,mapAddLand,!1,mapAddLand._container);
    addLandModal.style.display = 'block';
}

var selectedCovBbox;
function coverageSelected(id) {
    // alert(cov.value);
    var allContainer = document.getElementsByClassName("covContainer");
    for(z = 0; z < allContainer.length; z++) {
        allContainer[z].setAttribute('style', 'color: black');
    }
    areaLayerMap.clearLayers();
    Object.values(coverages).forEach(function (cov) {
        if(id == cov.name) {
            mapAddLand.setView([cov.coordinate[0], cov.coordinate[1]], 14);
            selectedCovBbox = cov.bbox;
            curCovName = cov.name;
            L.polygon([
                [selectedCovBbox[1], selectedCovBbox[0]],
                [selectedCovBbox[1], selectedCovBbox[2]],
                [selectedCovBbox[3], selectedCovBbox[2]],
                [selectedCovBbox[3], selectedCovBbox[0]],
            ]).addTo(areaLayerMap);

        }
    });
    var a = document.getElementById(id);
    a.setAttribute('style', 'color: green');
}

var listener = L.featureGroup().addTo(mapAddLand);
mapAddLand.on("click", function(event) {
    markerLayerMap.clearLayers();
    var latitude = event.latlng.lat;
    var longitude = event.latlng.lng;
    if(selectedCovBbox != null) {
        if(latitude >= selectedCovBbox[1] && latitude <= selectedCovBbox[3] && longitude >= selectedCovBbox[0] && longitude <= selectedCovBbox[2]) {
            lat.value = latitude;
            lng.value = longitude;
            L.marker([latitude, longitude]).addTo(markerLayerMap);

        } else {
            alert("Clicked location is out the coverage BBOX");
            lat.value = "";
            lng.value = "";
        }
    } else {
        alert("Please select a coverage");
    }
    // $.ajax ({
    //     url: "https://api.mapbox.com/geocoding/v5/mapbox.places/14.19507980391708,120.8778932657135.json?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA&types=place",
    //     type: "POST",
    //     data: {

    //     }, 
    //     success:function(data) {
    //         console.log(data)
    //     },error:function(data) {
    //         console.log(data)
    //     }
    // });

    
    console.log(event.latlng);
});
var ep1Modal = document.getElementById('ep1Modal');
var ep2Modal = document.getElementById('ep2Modal');
var addEP1 = document.getElementById('ep1');
var addEP2 = document.getElementById('ep2');
var ep1Close = document.getElementById('ep1ModalClose');
var ep2Close = document.getElementById('ep2ModalClose');
var ep1Done = document.getElementById('ep1ModalDone');
var ep2Done = document.getElementById('ep2ModalDone');
var epLoader = document.getElementById('epLoader');
var endPoint1;
var endPoint2;
addEP1.onclick = function() {
    endPoint1 = null;
    ep1Modal.style.display = "block";
}

addEP2.onclick = function() {
    endPoint2 = null;
    ep2Modal.style.display = "block";
}

ep1Close.onclick = function() {
    ep1Modal.style.display = "none";
    var ep1CovContainer = document.getElementsByClassName("ep1Cov");
    for(z = 0; z < ep1CovContainer.length; z++) {
        ep1CovContainer[z].setAttribute('style', 'color: black');
    }
}

ep2Close.onclick = function() {
    ep2Modal.style.display = "none";
    var ep2CovContainer = document.getElementsByClassName("ep2Cov");
    for(z = 0; z < ep2CovContainer.length; z++) {
        ep2CovContainer[z].setAttribute('style', 'color: black');
    }
}

window.onclick = function(e) {
    if(e.target == ep1Modal){
        ep1Modal.style.display = 'none';
        var ep1CovContainer = document.getElementsByClassName("ep1Cov");
        for(z = 0; z < ep1CovContainer.length; z++) {
            ep1CovContainer[z].setAttribute('style', 'color: black');
        }
    }

    if(e.target == ep2Modal){
        ep2Modal.style.display = 'none';
        var ep2CovContainer = document.getElementsByClassName("ep2Cov");
        for(z = 0; z < ep2CovContainer.length; z++) {
            ep2CovContainer[z].setAttribute('style', 'color: black');
        }
    }
}

function ep1Selected(id) {
    var ep1CovContainer = document.getElementsByClassName("ep1Cov");
    for(z = 0; z < ep1CovContainer.length; z++) {
        ep1CovContainer[z].setAttribute('style', 'color: black');
    }
    var raw = id.split('-')
    endPoint1 = raw[1];
    var a = document.getElementById(id);
    a.setAttribute('style', 'color: green');
}


function ep2Selected(id) {
    var ep2CovContainer = document.getElementsByClassName("ep2Cov");
    for(z = 0; z < ep2CovContainer.length; z++) {
        ep2CovContainer[z].setAttribute('style', 'color: black');
    }
    var raw = id.split('-')
    endPoint2 = raw[1];
    var a = document.getElementById(id);
    a.setAttribute('style', 'color: green');
}

ep1Done.onclick = function () {
    if(endPoint1 != null) {
        ep1Modal.style.display = "none";
        epLoader.style.display = 'block';
        $.ajax ({
            url: "/routes/addendpoint",
            type: "POST",
            data: {
                type : 'ep1',
                name : endPoint1,
                routeID : routeID
            }, 
            success:function(data) {
                if(data.result == "Success!") {
                    ep1Modal.style.display = "none";
                    window.location.href = '/routes/manage/'.concat(routeID);
                }
                else
                    alert(data.result);
            },error:function(data) {
                console.log(data);
            }
        });
    } else {
        alert("Please select a coverage!");
    }
}

ep2Done.onclick = function () {
    if(endPoint2 != null) {
        ep2Modal.style.display = "none";
        epLoader.style.display = 'block';
        $.ajax ({
            url: "/routes/addendpoint",
            type: "POST",
            data: {
                type : 'ep2',
                name : endPoint2,
                routeID : routeID
            }, 
            success:function(data) {
                if(data.result == "Success!") {
                    ep2Modal.style.display = "none";
                    window.location.href = '/routes/manage/'.concat(routeID);
                }
                else
                    alert(data.result);
            },error:function(data) {
                alert('Error');
            }
        });
    } else {
        alert("Please select a coverage!");
    }
}

const sleep = (milliseconds) => {
    return new Promise(resolve => setTimeout(resolve, milliseconds))
}