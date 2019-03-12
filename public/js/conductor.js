$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var addCondBtn = document.getElementById('addCond');
var addCondModal = document.getElementById('addCondModal');
var addCondClose = document.getElementById('addCondClose');
var addCondClose2 = document.getElementsByClassName('close')[0];
var saveConductor = document.getElementById('addConductor');

var cname = document.getElementById('name');
var cnumber = document.getElementById('number');
var pass = document.getElementById('password');
var cpass = document.getElementById('confirmPass');

addCondBtn.addEventListener('click', openAddCond);
addCondClose.addEventListener('click', closeAddCond);
addCondClose2.addEventListener('click', closeAddCond);
saveConductor.addEventListener('click', saveToFirebase);
window.addEventListener('click', clickOutside);

function openAddCond() {
    addCondModal.style.display = 'block';
}

function closeAddCond() {
    addCondModal.style.display = 'none';
    cname.value = "";
    cnumber.value = "";
    pass.value = "";
    cpass.value = "";
}

function clickOutside(e) {
    if(e.target == addCondModal){
        addCondModal.style.display = 'none';
        cname.value = "";
        cnumber.value = "";
        pass.value = "";
        cpass.value = "";
    }
}

function saveToFirebase() {
    var name = cname.value;
    var num = cnumber.value;
    var password = pass.value;
    var cpassword = cpass.value;
    if(password == cpassword) {
        $.ajax ({
            url: "/addconductor",
            type: "POST",
            data: {
                name : name,
                number : num,
                pass : password
            },
            success:function(data) {
                alert(data.success);
                addCondModal.style.display = 'none';
                window.location.href = "/conductors";
            },error:function(data) {
                alert(data.success);
            }
        });
    } else {
        alert("Password did not match!!");
        pass.value = "";
        cpass.value = "";
    }
}