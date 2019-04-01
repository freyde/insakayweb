$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
var loader = document.getElementById('loader');
var dialog = document.getElementById('dialog');

//Displays
var addBusBtn = document.getElementById('addBs');
var addBusModal = document.getElementById('addBusModal');
var addBusClose = document.getElementById('addBusClose');
var addBusClose2 = document.getElementsByClassName('close')[0];
var saveBus = document.getElementById('addBus');

//Values
var driName = document.getElementById('dName');
var plate = document.getElementById('pNumber');


//Adding Listeners
addBusBtn.addEventListener('click', openAddBus);
addBusClose.addEventListener('click', closeAddBus);
addBusClose2.addEventListener('click', closeAddBus);
saveBus.addEventListener('click', saveToFirebase);
window.addEventListener('click', clickOutside);

//Functions
function openAddBus() {
    addBusModal.style.display = 'block';
}

function closeAddBus() {
    addBusModal.style.display = 'none';
}

function clickOutside(e) {
    if(e.target == addBusModal){
        addBusModal.style.display = 'none';
    }
    
}

function saveToFirebase() {
    var name = driName.value;
    var plateNo = plate.value;
    console.log(driName.value + " " + plate.value);
    loader.style.display = 'block';
    dialog.style.display = 'none';
    $.ajax ({
        url: "/addbus",
        type: "POST",
        data: {
            name : name,
            plate : plateNo
        },
        success:function(data) {
            window.location.href = "/buses";
        },error:function(data) {
            alert(data.success);
        }
    });
}