var config = {
    apiKey: "AIzaSyAGVpkWk3EEyRicdXwr9lI5OhRi9yEndds",
    authDomain: "insakay-198614.firebaseapp.com",
    databaseURL: "https://insakay-198614.firebaseio.com",
    projectId: "insakay-198614",
    storageBucket: "insakay-198614.appspot.com",
    messagingSenderId: "768233361294"
};
firebase.initializeApp(config);

var mapMain = L.map('map', {
    zoomSnap: 0.5
});
var markers = L.layerGroup().addTo(mapMain);
var layerMain = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'map-main-routes'
});
layerMain.addTo(mapMain);
mapMain.setView([12.8797, 121.7740], 5);
mapMain.scrollWheelZoom.disable();

var uid = document.getElementById('uid').value;
console.log(uid);
var a = 'users/'.concat(uid.concat('/info'));
var opID;
console.log(a);
firebase.database().ref(a)
.once("value")
.then(function(snapshot) {
    console.log(snapshot.val());
    var info = snapshot.val();
    opID = info.operatorID;
    
});


firebase.database().ref('onOperation')
.on('value', function(snapshot) {
    markers.clearLayers();
    if(snapshot.val() != null) {
        console.log(snapshot.val())
        snap = snapshot.val();
        Object.keys(snap).forEach(function (conductor) {
            console.log(conductor);
            console.log(opID);
            markers.clearLayers();
            if(conductor.startsWith(opID)) {
                console.log("MERON");
                markers.clearLayers();
                firebase.database().ref('onOperation/'.concat(conductor))
                .once("value")
                .then(function(snapshot) {
                    var info = snapshot.val();
                    console.log(info.lat);
                    var marker = L.marker([info.lat, info.long]).addTo(markers);
                    marker.bindPopup(
                        "<b>Plate No.:</b> ".concat(info.busPlate).concat(
                        "<br><b>Driver:</b> ".concat(info.busDriver).concat(
                        "<br><b>Conductor:</b> ".concat(info.conductorName)))
                    );
                });
                
            }
        });
    }
});

