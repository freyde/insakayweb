var config = {
    apiKey: "AIzaSyAGVpkWk3EEyRicdXwr9lI5OhRi9yEndds",
    authDomain: "insakay-198614.firebaseapp.com",
    databaseURL: "https://insakay-198614.firebaseio.com",
    projectId: "insakay-198614",
    storageBucket: "insakay-198614.appspot.com",
    messagingSenderId: "768233361294"
  };
  firebase.initializeApp(config);

  app_firebase = firebase;

var storage = firebase.storage();
var uid = document.getElementById('uid').value;
function download(filename) {
    var path = uid.concat('/daily_reports/').concat(filename);
    var ref = storage.ref(path);
    ref.getDownloadURL().then(function(url) {
        // Insert url into an <img> tag to "download"
        window.open(url, '_blank');
        
      }).catch(function(error) {
        alert(error.code);
        // A full list of error codes is available at
        // https://firebase.google.com/docs/storage/web/handle-errors
        switch (error.code) {
          case 'storage/object-not-found':
            // File doesn't exist
            alert(error.code);
            break;
      
          case 'storage/unauthorized':
            // User doesn't have permission to access the object
            break;
      
          case 'storage/canceled':
            // User canceled the upload
            break;
      
          case 'storage/unknown':
            // Unknown error occurred, inspect the server response
            break;
        }
      });
}