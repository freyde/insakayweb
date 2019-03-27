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

function logout() {
    
    firebase.auth().signOut().then(function() {
        sessionStorage.clear();
        $.ajax ({
            url: "/logout",
            type: "POST",
            data: { id : 'none'},
            success:function(data) {
                window.location.replace("/");
            }
        });
    }).catch(function(error) {
        // An error happened.
    });
}