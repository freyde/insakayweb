$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
var loader = document.getElementById('loader');
var uid = document.getElementById('uid');
var deleteBtn = document.getElementById('delete');
var deleteModal = document.getElementById('deleteModal');
var deleteConfirm = document.getElementById('deleteConfirm');
var deletCancel = document.getElementById('deleteCancel');


deleteBtn.onclick = function() {
    deleteModal.style.display = "block";
}

deleteConfirm.onclick = function() {
    loader.style.display = "block";
    deleteModal.style.display = "none";
    $.ajax ({
        url: "/admin/deleteoperator",
        type: "POST",
        data: {
            uid : uid.value,
        }, 
        success:function(data) {
          window.location.href = "/admin/operators";
        },error:function(data) {
          alert('Error adding operator.');
        }
      });
}

deletCancel.onclick = function() {
    deleteModal.style.display = "none";
}