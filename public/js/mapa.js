var marker; //variable del marcador
var coords = {}; //coordenadas obtenidas con la geolocalización
var x = document.getElementById("nomDir");
var options = {
  enableHighAccuracy: true,
  timeout: 6000,
  maximumAge: 0
};
//Funcion principal
initMap = function() {
  // navigator.geolocation.getCurrentPosition(viewMap,ViewError,{timeout:3000});

  //usamos la API para geolocalizar el usuario
  navigator.geolocation.getCurrentPosition(
    function(position) {
      coords = {
        lng: position.coords.longitude,
        lat: position.coords.latitude
      };
      document.getElementById("longitud").value = position.coords.longitude;
      document.getElementById("latitud").value = position.coords.latitude;
      setMapa(coords); //pasamos las coordenadas al metodo para crear el mapa
    },
    function(error) {
      // El segundo parámetro es la función de error
      switch (error.code) {
        case error.PERMISSION_DENIED:
          // El usuario denegó el permiso para la Geolocalización.
          console.log(error);
          alert("ACTIVE SU GPS O USTED BLOQUEO EL PERMISO DE UBICACION");
          // initMap();
          break;
        case error.POSITION_UNAVAILABLE:
          // La ubicación no está disponible.
          console.log(error);
          alert("ACTIVE SU GPS Y RECARGE LA PAGINA");
          break;
        case error.TIMEOUT:
          // Se ha excedido el tiempo para obtener la ubicación.
          console.log(error);
          alert("ACTIVE SU GPS Y RECARGE LA PAGINA");
          break;
        case error.UNKNOWN_ERROR:
          // Un error desconocido.
          alert("INTENTE MÁS TARDE");
          console.log(error);
          break;
      }
      coords = {
        lng: "-17.7719588",
        lat: "-63.1835792"
      };
      document.getElementById("longitud").value = "-17.7719588";
      document.getElementById("latitud").value = "-63.1835792";
      setMapa(coords); //pasamos las coordenadas al metodo para crear el mapa
    },
    options
  );
};

function setMapa(coords) {
  //Se crea una nueva instancia del objeto mapa
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 17,
    center: new google.maps.LatLng(coords.lat, coords.lng)
  });

  //Creamos el marcador en el mapa con sus propiedades
  //para nuestro obetivo tenemos que poner el atributo draggable en true
  //position pondremos las mismas coordenas que obtuvimos en la geolocalización
  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    title: "Mi ubicación actual",
    position: new google.maps.LatLng(coords.lat, coords.lng)
  });
  //map.setCenter(pos);
  //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica
  //cuando el usuario a soltado el marcador
  marker.addListener("click", toggleBounce);

  marker.addListener("dragend", function(event) {
    //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
    document.getElementById("coords").value =
      this.getPosition().lat() + "," + this.getPosition().lng();
    document.getElementById("longitud").value = this.getPosition().lng();
    document.getElementById("latitud").value = this.getPosition().lat();

    var long = this.getPosition().lat();
    var lat = this.getPosition().lng();

    var locApi =
      "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
      long +
      "," +
      lat +
      "&sensor=true";
    //x.innerHTML=locApi+"<br>"+loc.loc +"<br>"+loc.city +"<br>"+loc.region +"<br>";
    var cadena = "";
    $.get({
      url: locApi,
      success: function(data) {
        console.log(typeof data);
        //console.log(data.results.length);
        if (data.results.length > 0) {
          cadena = data.results[0].address_components[0].long_name + ", ";

          cadena += data.results[0].address_components[1].long_name + ", ";

          //cadena+=data.results[0].address_components[4].long_name;
          x.innerHTML = cadena;
          document.getElementById("txtDir").value = cadena;
        } else {
          x.innerHTML =
            "La ubicacion no se reconoce, por favor intente de nuevo";
        }
      }
    });
  });
}

//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
