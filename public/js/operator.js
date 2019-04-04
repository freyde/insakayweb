$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
var loader = document.getElementById('loader');

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
var opKey = document.getElementById('key');

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
  var opName = operatorName.value;
  var opSName = shortName.value;
  var fName = ownerFirstName.value;
  var lName = ownerLastName.value;
  var opEmail = email.value;
  var opPass = password.value;
  var opCPass = cPassword.value;
  var key = opKey.value;
  if(opName != "" && opSName != "" && fName != "" && lName != "" && opEmail != "" && key != "") {
    if(key.length >= 6) {
      if(opPass.length >= 6) {
        if(opPass == opCPass) {
          loader.style.display = "block";
          addOpModal.style.display = "none";
          $.ajax ({
            url: "/admin/addoperator",
            type: "POST",
            data: {
                fullName : opName,
                shortName : opSName,
                ownerFName : fName,
                ownerLName : lName,
                emailAddress : opEmail,
                pass : opPass,
                key : key
            }, 
            success:function(data) {
              window.location.href = "/admin/operators";
            },error:function(data) {
              alert('Error adding operator.');
            }
          });
        } else {
          alert("Password did not match!");
          password.value = "";
          cPassword.value = "";
        }
      } else {
        alert("Password is too short! (Minimum of 6 characters)");
        password.value = "";
        cPassword.value = "";
      }
    } else {
      alert("Key requires 6 character or longer");
      password.value = "";
      cPassword.value = "";
    }
  } else {
    alert("Please complete all information needed.");
    password.value = "";
    cPassword.value = "";
  }
}