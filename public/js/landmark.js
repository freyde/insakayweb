$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

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

addLandBtn.addEventListener('click', openAddLandmark);
addLandClose.addEventListener('click', closeAddLandmark);
addLandClose2.addEventListener('click', closeAddLandmark);
addLand.addEventListener('click', saveToFirebase);
window.addEventListener('click', clickOutside);
var routeID = id.value;

function openAddLandmark() {
    addLandModal.style.display = 'block';
}

function closeAddLandmark() {
    addLandModal.style.display = 'none';
    landmarkName.value = '';
    latitude.value = '';
    longitude.value = '';
    covArea.value = '';
}

function clickOutside(e) {
    if(e.target == addLandModal){
        addLandModal.style.display = 'none';
        landmarkName.value = '';
        latitude.value = '';
        longitude.value = '';
        covArea.value = '';
    }
}

function saveToFirebase() {
    $.ajax ({
        url: "/routes/addlandmark",
        type: "POST",
        data: {
            name : landmarkName.value,
            lat : latitude.value,
            lng : longitude.value,
            coverage : covArea.value,
            routeID : id.value,
        }, 
        success:function(data) {
            window.location.href = "/routes/".concat(routeID);
        },error:function(data) {
          alert('Please');
        }
    });
}