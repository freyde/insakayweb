$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var opt = document.getElementById('routes');
var addRouteBtn = document.getElementById('addRouteBtn');
opt.addEventListener('change', checkRoutes);
addRouteBtn.addEventListener('click', gotoAddRoute);

var map = L.map('map');

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJleWRlIiwiYSI6ImNqdDZ3MGJlZDBqcWg0NG1zbWphMDBlZ2UifQ.uVop-nTgkAx-ZOpr9CEIqA', {
    maxZoom: 18,
    id: 'mapbox.streets',
    // accessToken: ''
}).addTo(map);

function checkRoutes() {
    if(opt.value != null) {
        if(opt.value == "-Select Operator-") {
            hideMap();
        } else {
            inFlateMaps(opt.value);
        }
    } 
}

function hideMap(routes) {
    var views = document.getElementsByClassName('view');
    for(a=0; a < views.length; a++) {
        views[a].style.display = 'none';
    }
    document.getElementById('map').style.display = 'none';
}


function inFlateMaps(route) {
    var rName = document.getElementById(route);
    var views = document.getElementsByClassName('view');
    for(a=0; a < views.length; a++) {
        views[a].style.display = 'none';
    }
    rName.style.display = 'block';
    var pt1Lat = document.getElementById(route.concat('_p1Lat'));
    var pt1Long = document.getElementById(route.concat('_p1Long'));
    var pt2Lat = document.getElementById(route.concat('_p2Lat'));
    var pt2Long = document.getElementById(route.concat('_p2Long'));
    var p1Lt = parseFloat(pt1Lat.value);
    var p1Lng = parseFloat(pt1Long.value);
    var p2Lt = parseFloat(pt2Lat.value);
    var p2Lng = parseFloat(pt2Long.value);

    // The location of 
    var p1 = {lat: p1Lt, lng: p1Lng};
    var p2 = {lat: p2Lt, lng: p2Lng};
    var center = {lat: (p1.lat+p2.lat)/2, lng: (p1.lng+p2.lng)/2};



    map.setView([center.lat, center.lng], 10);
    var startPoint = L.marker([p1.lat, p1.lng]).addTo(map);
    var endPoint = L.marker([p2.lat, p2.lng]).addTo(map);
}

//     // The map 
//     var map = new google.maps.Map(
//         document.getElementById('map'),{
//             zoom: 10, 
//             center: center, 
//             zoomControl: false, 
//             scrollwheel: false, 
//             disableDoubleClickZoom: true
//     });

//     //The marker, positioned at 
//     var marker1 = new google.maps.Marker({
//         position: p1, 
//         map: map,
//     });
//     var marker2 = new google.maps.Marker({
//         position: p2, 
//         map: map,
//         title: 'PITX'
//     });

// }

// function initMap() {
    
// }


function gotoAddRoute() {
    window.location.href = "/routes/addroute";
}
