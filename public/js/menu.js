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