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


var table = document.getElementById('matrix');
var load = document.getElementById('matrixLoader');
load.style.display = 'block';
var uid = document.getElementById('uid').value;
var routeID = document.getElementById('routeID').value;
var save = document.getElementById('saveMatrix');
var ok = true;
console.log(uid +", "+ routeID);
var covs;
var snap;
var sortedCoverage = [];
var ep1;
var ep1Coor;
var len;
var fareObject = {list : []};

function getDistance(origin, destination) {
    // return distance in meters
    var lon1 = toRadian(origin[1]),
        lat1 = toRadian(origin[0]),
        lon2 = toRadian(destination[1]),
        lat2 = toRadian(destination[0]);

    var deltaLat = lat2 - lat1;
    var deltaLon = lon2 - lon1;

    var a = Math.pow(Math.sin(deltaLat/2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon/2), 2);
    var c = 2 * Math.asin(Math.sqrt(a));
    var EARTH_RADIUS = 6371;
    return c * EARTH_RADIUS * 1000;
}
function toRadian(degree) {
    return degree*Math.PI/180;
}

firebase.database().ref('users/' + uid + '/routes')
.once("value")
.then(function(snapshot) {
    snap = snapshot.val();
    Object.values(snap).forEach(function (route) {
        // console.log(route)
        if(route.routeID == routeID) {
            covs = route.coverage;
            ep1 = route.endPoint1;
        }
    });
    Object.values(covs).forEach(function (cov) {
        if(cov.name == ep1) {
            ep1Coor = cov.coordinate;
        }
    })
    var o,p;
    var name;
    var ref = ep1Coor;
    for(j = 0; j <covs.length; j++) {
        for(k = j + 1; k < covs.length; k++) {
            p = getDistance(ref, covs[j].coordinate);
            o = getDistance(ref, covs[k].coordinate);
            if(o < p) {
                var temp = covs[j];
                covs[j] = covs[k];
                covs[k] = temp;
            }
            name = covs[j].name;
        }
    }
    for(l = 0; l < covs.length; l++) {
        sortedCoverage[l] = covs[l].name;
        console.log(sortedCoverage[l]);
    }
    len = sortedCoverage.length;
    // console.log(sortedCoverage);
    var firstRow = table.insertRow(-1);
    firstRow.insertCell(-1);
    for(f = 0; f < sortedCoverage.length; f++) {
        var place = sortedCoverage[f].split(", ");
        var cell = firstRow.insertCell(-1);
        cell.innerHTML = place[0];
    }

    for(x = 0; x < sortedCoverage.length; x++) {
        var place = sortedCoverage[x].split(", ");
        var row = table.insertRow(-1);
        var cell = row.insertCell(-1);
        cell.innerHTML = place[0];
        for(y = 0; y < sortedCoverage.length; y++) {
            var put = document.createElement("input");
            put.setAttribute('id', x +"-"+ y);
            put.setAttribute('placeholder', "Price");
            put.setAttribute('style', 'width: 6rem');
            put.setAttribute('onkeypress', 'return isNumberKey(event)');
            
            // put.setAttribute('value', "1");
            var blank = row.insertCell();
            blank.appendChild(put);
        }
    }
    load.style.display = 'none';
});

console.log(len);
save.onclick = function() {
    ok = true;
    for(p = 0; p < len; p++) {
        for(q = 0; q < len; q++) {
            var curCell = document.getElementById(p+'-'+q);
            console.log(curCell.value);
            if(curCell.value == "") {
                curCell.focus();
                ok = false;
                break;
            }
        }
        if(!ok)
            break;
    }

    if(ok) {
        load.style.display = 'block';
        fareObject = {};
        for(b = 0; b < sortedCoverage.length; b++) {
            // var temp = { [sortedCoverage[b]] : []};
            fareObject[sortedCoverage[b]] = {};
            for(a = 0; a < sortedCoverage.length; a++) {
                var curCell = document.getElementById(b+'-'+a);
                // temp[sortedCoverage[b]].push({
                //     [sortedCoverage[a]] : curCell.value
                // });
                fareObject[sortedCoverage[b]][sortedCoverage[a]] = curCell.value;
            }
        }
        console.log(fareObject);
        $.ajax ({
            url: "/fare/savematrix",
            type: "POST",
            data: {
              routeID : routeID,
              list : fareObject,
            },
            success:function(data) {
                window.location.href = "/fare/manage/".concat(routeID);
            },error:function(data) {
                console.log("There is an error.");
            }
          });
    } else {
        alert("Missing value!")
    }

}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

