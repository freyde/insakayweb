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

function login() {
    console.log("Login")
    var adminEmail = document.getElementById("email").value;
    var adminPass = document.getElementById("password").value;

    firebase.auth().signInWithEmailAndPassword(adminEmail, adminPass).then(function() {
        firebase.auth().onAuthStateChanged(function(user) {
            if(user) {
                var uid = user.uid;
                sessionStorage.setItem('uid', uid);
                $.ajax ({
                    url: "/verify",
                    type: "POST",
                    data: { id : uid },
                    success:function(data) {
                        window.location.replace("/");
                    }
                });
            }
        })
    }).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        window.alert("Error: " + errorMessage + "\nCode: " + errorCode);
    });
}

function adminlogin() {

    var adminEmail = document.getElementById("email").value;
    var adminPass = document.getElementById("password").value;

    firebase.auth().signInWithEmailAndPassword(adminEmail, adminPass).then(function() {
        firebase.auth().onAuthStateChanged(function(user) {
            if(user) {
                var uid = user.uid;
                sessionStorage.setItem('uid', uid);
                $.ajax ({
                    url: "/verifyadmin",
                    type: "POST",
                    data: { id : uid },
                    success:function(data) {
                        window.location.replace("/admin");
                    }
                });
            }
        })
    }).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        window.alert("Error: " + errorMessage + "\nCode: " + errorCode);
    });
}

function adminlogout() {
    firebase.auth().signOut().then(function() {
        sessionStorage.clear();
        $.ajax ({
            url: "/logout",
            type: "POST",
            data: { id : 'none'},
            success:function(data) {
                window.location.replace("/admin");
            }
        });
    }).catch(function(error) {
        // An error happened.
    });
}