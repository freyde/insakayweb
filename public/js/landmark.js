
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

var mapAddLand = L.map('mapAddLandmark');
var layerLandmark = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets-v10',
    accessToken: 'map-main-routes'
});

layerLandmark.addTo(mapAddLand);
mapAddLand.setView([12.8797, 121.7740], 5);



function closeAddLandmark() {
    addLandModal.style.display = 'none';
    // landmarkName.value = '';
    // latitude.value = '';
    // longitude.value = '';
    // covArea.value = '';
}

function clickOutside(e) {
    if(e.target == addLandModal){
        addLandModal.style.display = 'none';
    //     landmarkName.value = '';
    //     latitude.value = '';
    //     longitude.value = '';
    //     covArea.value = '';
    // }
    }
}

function saveToFirebase() {
    
    if(landmarkName.value != "") {
        if(!lat.value== "" && !lng.value == "") {
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
                    // window.location.href = "/routes/".concat(routeID);
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
    // map.invalidateSize();
    addLandModal.style.display = 'block';

}

var selectedCovBbox;
function coverageSelected(id) {
    // alert(cov.value);
    Object.values(coverages).forEach(function (cov) {
        if(id == cov.name) {
            mapAddLand.setView([cov.coordinate[0], cov.coordinate[1]], 14);
            selectedCovBbox = cov.bbox;
            curCovName = cov.name;
        }
    });
}

var listener = L.featureGroup().addTo(mapAddLand);
mapAddLand.on("click", function(event) {
    var latitude = event.latlng.lat;
    var longitude = event.latlng.lng;
    if(selectedCovBbox != null) {
        if(latitude >= selectedCovBbox[1] && latitude <= selectedCovBbox[3] && longitude >= selectedCovBbox[0] && longitude <= selectedCovBbox[2]) {
            lat.value = latitude;
            lng.value = longitude;
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
