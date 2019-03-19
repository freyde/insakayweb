$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var addLandBtn = document.getElementById('addLand');
var addLandModal = document.getElementById('addLandmarkModal');
var addLandClose = document.getElementById('addLandClose');
var addLandClose2 = document.getElementsByClassName('close')[0];
var addLand = document.getElementById('addLandmark');
var landmarkName = document.getElementById('lName');
var latitude = document.getElementById('lat');
var longitude = document.getElementById('lng');
var covArea = document.getElementById('coverage');
var id = document.getElementById('rID');

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
// L.tileLayer('https://api.tiles.mapbox.com/v4/mapbox.streets-v10/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
//     maxZoom: 18,
//     attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
//                 '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
//                 'Imagery © <a href="http://mapbox.com">Mapbox</a>',
//     accessToken: 'map-main-routes'
// });

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
    $.ajax ({
        url: "/routes/addlandmark",
        type: "POST",
        data: {
            
        }, 
        success:function(data) {
            window.location.href = "/routes/".concat(routeID);
        },error:function(data) {
          alert('Please');
        }
    });
}

addLandBtn.onclick = function() {  
    L.Util.requestAnimFrame(mapAddLand.invalidateSize,mapAddLand,!1,mapAddLand._container);
    // map.invalidateSize();
    addLandModal.style.display = 'block';

}

function coverageSelected(coordinate) {
    alert(coordinate);
}

// mapboxgl.accessToken = 'pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ2eWF6azBsajI0NG05emk2dnlzcGUifQ.yD_bma0GaPOkG3ZuHyQV_w';
// const map = new mapboxgl.Map({
// container: 'map',
// style: 'mapbox://styles/mapbox/streets-v10',
// center: [121.7740, 12.8797],
// zoom: 5
// });