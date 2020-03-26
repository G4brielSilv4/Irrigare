/*  var firebaseConfig = {
    apiKey: "AIzaSyBWmhwg3Tp7NIBPTNLC6R0CouuirewKOI4",
    authDomain: "irrigare-ifc-2019.firebaseapp.com",
    databaseURL: "https://irrigare-ifc-2019.firebaseio.com",
    projectId: "irrigare-ifc-2019",
    storageBucket: "irrigare-ifc-2019.appspot.com",
    messagingSenderId: "126427625883",
    appId: "1:126427625883:web:15b7b4001ab9a8f75c493e"
  };

  firebase.initializeApp(firebaseConfig);
  var database = firebase.database();


var starCountRef = firebase.database().ref('temperatura');
starCountRef.on('value', function(snapshot) {
  top(postElement, snapshot.val());
});

console.log(starCountRef);
*/
  /* ESSE SCRIPT FUNCIONA POREM NAO GUARDA OS VALORES EM VARIAVEIS AÍ NÃO DA DE COMPARAR OU COLOCAR NOS GRAFICOS*/

 (function() {
     
 
    var config = {
    apiKey: "AIzaSyDiUfFeznTh7FJNd6p6rr2CUCPgi5SYfoM",
    authDomain: "irrigare-b395e.firebaseapp.com",
    databaseURL: "https://irrigare-b395e.firebaseio.com",
    projectId: "irrigare-b395e",
    storageBucket: "irrigare-b395e.appspot.com",
    messagingSenderId: "322834567750",
    appId: "1:322834567750:web:74c3bb433a932123167047",
    measurementId: "G-758QJKC0EN"
  };

  firebase.initializeApp(config);
  var db = firebase.database();


  
  var umiSolo = db.ref('umidadesolo');
  var umiAr = db.ref('umidade');
  var temperatura = db.ref('temperatura');
  


  umiAr.on('value', onNewData('valorUmidadeAr'));
  umiSolo.on('value', onNewData('valorUmidadeSolo'));
  temperatura.on('value', onNewData('valorTemperaturaAr'));
 
  })();
 
  function onNewData(currentValueEl, metric){
  return function(snapshot){
    var readings = snapshot.val();
    if(readings){
        var currentValue;
        var data = [];
        for(var key in readings){
          currentValue = readings[key]
          data.push(currentValue);
        }
 
        document.getElementById(currentValueEl).innerText = currentValue;
      }
    }
  }
  ('value', function(snapshot){   
  });
