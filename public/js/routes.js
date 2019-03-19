$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var addRouteBtn = document.getElementById('addRouteBtn');
addRouteBtn.addEventListener('click', gotoAddRoute);

// function checkRoutes() {
//     if(opt.value != null) {
//         if(opt.value == "-Select Operator-") {
//             hideMap();
//         } else {
//             inFlateMaps(opt.value);
//         }
//     } 
// }

// function hideMap(routes) {
//     var views = document.getElementsByClassName('view');
//     for(a=0; a < views.length; a++) {
//         views[a].style.display = 'none';
//     }
//     document.getElementById('map').style.display = 'none';
// }


// function inFlateMaps(route) {
//     var rName = document.getElementById(route);
//     var views = document.getElementsByClassName('view');
//     for(a=0; a < views.length; a++) {
//         views[a].style.display = 'none';
//     }
//     rName.style.display = 'block';
//     var pt1Lat = document.getElementById(route.concat('_p1Lat'));
//     var pt1Long = document.getElementById(route.concat('_p1Long'));
//     var pt2Lat = document.getElementById(route.concat('_p2Lat'));
//     var pt2Long = document.getElementById(route.concat('_p2Long'));
//     var p1Lt = parseFloat(pt1Lat.value);
//     var p1Lng = parseFloat(pt1Long.value);
//     var p2Lt = parseFloat(pt2Lat.value);
//     var p2Lng = parseFloat(pt2Long.value);

//     // The location of 
//     var p1 = {lat: p1Lt, lng: p1Lng};
//     var p2 = {lat: p2Lt, lng: p2Lng};
//     var center = {lat: (p1.lat+p2.lat)/2, lng: (p1.lng+p2.lng)/2};

//     mapMarkers.clearLayers();

//     map.setView([center.lat, center.lng], 10);
//     startPoint = L.marker([p1.lat, p1.lng]).addTo(mapMarkers);
//     endPoint = L.marker([p2.lat, p2.lng]).addTo(mapMarkers);
// }

function gotoAddRoute() {
    window.location.href = "/routes/addroute";
}
