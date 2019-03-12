$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

var addOpBtn = document.getElementById('addOp');
var addOpModal = document.getElementById('addOpModal');
var addOpClose = document.getElementById('addOpClose');
var addOpClose2 = document.getElementsByClassName('close')[0];
var saveOp = document.getElementById('addOperator');

var operatorName = document.getElementById('fName');
var shortName = document.getElementById('sName');
var ownerFirstName  = document.getElementById('firstName');
var ownerLastName = document.getElementById('lastName');
var emailAdd = document.getElementById('email');
var password = document.getElementById('pass');
var cPassword = document.getElementById('cpass');

addOpBtn.addEventListener('click', openAddOp);
addOpClose.addEventListener('click', closeAddOp);
addOpClose2.addEventListener('click', closeAddOp);
saveOp.addEventListener('click', saveToFirebase);
window.addEventListener('click', clickOutside);


function openAddOp() {
  addOpModal.style.display = 'block';
}

function closeAddOp() {
  addOpModal.style.display = 'none';
  operatorName.value = "";
  shortName.value = "";
  ownerFirstName.value = "";
  ownerLastName.value = "";
  emailAdd.value = "";
  password.value = "";
  cPassword.value = "";
}

function clickOutside(e) {
  if(e.target == addOpModal){
    addOpModal.style.display = 'none';
    operatorName.value = "";
    shortName.value = "";
    ownerFirstName.value = "";
    ownerLastName.value = "";
    emailAdd.value = "";
    password.value = "";
    cPassword.value = "";
  }
}

function saveToFirebase() {
  $.ajax ({
    url: "/admin/addoperator",
    type: "POST",
    data: {
        fullName : operatorName.value,
        shortName : shortName.value,
        ownerFName : ownerFirstName.value,
        ownerLName : ownerLastName.value,
        emailAddress : email.value,
        pass : password.value,
    }, 
    success:function(data) {
      window.location.href = "/admin/operators";
    },error:function(data) {
      alert('Please');
    }
  });
}