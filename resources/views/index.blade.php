<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->

		 <link type="text/css" rel="stylesheet" href="css/inicio.css"/>
		 {{-- <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/> --}}
		 <link type="text/css" rel="stylesheet" href="css/btn_3d.css"/>
		 <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<div id="app">
		<!-- /HEADER -->
		@yield('inicio')
		<!-- FOOTER -->
		<div id="newsletter" class="section">
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
	</div>
			<div class="modal fade" id="maps" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content" id="modalcon">
				<div class="modal-header">
				  <h3 align="center" style="width:100%; padding: 0px;">
					Indica tu dirección
					<!--
						  <img src="../Resources/img/grido-logo.png" alt="Logo" style="width:80px;">
					-->
				  </h3>
				</div>
				<div class="modal-body">
				  <div id="div_maps">
					<!--  GOOGLE MAPS-->
					<div id="map"></div>
	  
					<div style="display: none;">
					  Nueva Ubiv.
					  <input type="text" id="coords" />
					  <br />Latitud
					  <input class="xy" type="text" id="longitud" name="longitud" />
					  <br />Longitud
					  <input class="xy" type="text" id="latitud" name="latitud" />
					  <br />
					  <br />
					</div>
	  
					<div class="clearfix"></div>
					<div id="ayuda" align="center">
					  <p id="nomDir">
						<b>No es tu ubicacion ?</b>
						<small
						  style="font-size: 10px;"
						>Recuerda que puedes modificar tu ubicación moviendo el icono que indica donde estas ahora.</small>
					  </p>
					</div>
					<input type="hidden" id="txtDir" name="txtDir" />
	  
					<!-- END ,MAPS -->
				  </div>
	  
				  <div class="clearfix"></div>
				  <div class="alert alert-info" style="padding: 5px; margin-bottom: 0px;" align="center">
					<b>Verifique su ubicación exacta para recibir su pedido</b>
				  </div>
				</div>
				<div class="modal-footer" stye="text-align: center !important;">
				  <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
				  <button
					style=" border-radius: 6px !important; font-size: 16px; width:220px;"
					type="button"
					name="confir_ubv"
					id="confir_ubv"
					onclick=addUbicacion(longitud.value,latitud.value,txtDir.value);
					class="btn btn-success btn-lg verde"
					data-dismiss="modal"
				  >ACEPTAR</button>
				</div>
			  </div>
			</div>
		  </div>
	  
		  <style>
			@media(max-width: 700px){
			  #div_maps {
					
					height: 320px;
				  
				  }
			
			}
			
			@media(min-width: 700px){
			 #div_maps {
					height: 380px;
				  
				  }
			
			}
				
				  
			
				  #map {
					width: 100%;
					height: 90%;
			
				  }
				
				 #modalcon{
					color: #16438e;
					line-height: 1.42857143;
					  font-family: "Frank";
				 }
			
				</style>
			
			  <!-- Modal -->
			  <div class="modal fade" id="maps" role="dialog">
				<div class="modal-dialog modal-lg">
				
				  <!-- Modal content-->
				  <div class="modal-content" id="modalcon" >
					<div class="modal-header" >
					 
					  <h3 align="center" style="width:100%; padding: 0px;">Indica tu dirección 
					   <!--
						<img src="../Resources/img/grido-logo.png" alt="Logo" style="width:80px;">
					  -->
			
					  </h3>
					</div>
					<div class="modal-body">
			  <div id="div_maps" >
						  <!--  GOOGLE MAPS-->
							  <div id="map"></div>
			
			<div style="display: none;" >
				<form action="/" method="post">
					Nueva Ubiv.<input type="text" id="coords" />
					<br>
					Latitud <input class="xy" type="text" id="longitud" name="longitud" />
				   <br>
					Longitud <input class="xy" type="text" id="latitud" name="latitud" />

					<div class="modal-footer" stye="text-align: center !important;">
						<button  type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
					   <input  style=" border-radius: 6px !important; font-size: 16px; width:220px;"  
					   type="submit" name="confir_ubv" id="confir_ubv" value="ACEPTAR"
					  onclick="addUbicacion(longitud.value,latitud.value,txtDir.value);" class="btn btn-success btn-lg verde" data-dismiss="modal"  />
					 </div>
				</form>
			<?php
if(isset($_post['confir_ubv']))
{
	$ubicacion=$_post['longitud'];
}
			?>
			<br>
			<br>
			</div>
			
			
			
			<div class="clearfix"></div>
			<div id="ayuda" align="center">
			 <p id="nomDir">
				 <b>No es tu ubicacion ? </b><small style="font-size: 10px;" >Recuerda que puedes modificar tu ubicación moviendo el icono que indica donde estas ahora. </small></p>
			 
				  </div>
				  <input  type="hidden" id="txtDir" name="txtDir" />
				   
						  <!-- END ,MAPS -->
					  </div>
			  
			<div class="clearfix"></div>
					  <div class="alert alert-info" style="padding: 5px; margin-bottom: 0px;" align="center" >
					   <b> Verifique su ubicación exacta para recibir su pedido</b>
					  </div>
			
			
					</div>
					
			
				  </div>
				  
				</div>
			
			

		<footer id="footer">
			<!-- top footer -->
			@include('plantilla.inicio')
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->
	</div>
	<script type="text/javascript">
		var marker;          //variable del marcador
		var coords = {};    //coordenadas obtenidas con la geolocalización
		var x=document.getElementById("nomDir");
		var options = {
		  enableHighAccuracy: true,
		  timeout: 6000,
		  maximumAge: 0
		};
		//Funcion principal
		initMap = function () 
		{
		
		   // navigator.geolocation.getCurrentPosition(viewMap,ViewError,{timeout:3000});
		
			//usamos la API para geolocalizar el usuario
				navigator.geolocation.getCurrentPosition(
				  function (position){
					coords =  {
					  lng: position.coords.longitude,
					  lat: position.coords.latitude,
					};
				  document.getElementById("longitud").value = position.coords.longitude;
				  document.getElementById("latitud").value = position.coords.latitude;
					setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
					
				   
				  },function(error){
				   
					  // El segundo parámetro es la función de error
			switch(error.code) {
				case error.PERMISSION_DENIED:
					// El usuario denegó el permiso para la Geolocalización.
					   console.log(error);
					   alert('ACTIVE SU GPS O USTED BLOQUEO EL PERMISO DE UBICACION');
					  // initMap();
					break;
				case error.POSITION_UNAVAILABLE:
					// La ubicación no está disponible.
					   console.log(error);
						alert('ACTIVE SU GPS Y RECARGE LA PAGINA');
					break;
				case error.TIMEOUT:
					// Se ha excedido el tiempo para obtener la ubicación.
					   console.log(error);
						 alert('ACTIVE SU GPS Y RECARGE LA PAGINA');
					break;
				case error.UNKNOWN_ERROR:
					// Un error desconocido.
					  alert('INTENTE MÁS TARDE');
					   console.log(error);
					break;
			}
			  coords =  {
					  lng: '-17.7719588',
					  lat: '-63.1835792'
		
		
					};
				  document.getElementById("longitud").value = '-17.7719588';
				  document.getElementById("latitud").value =  '-63.1835792';
					setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
					
					  
				  },options);
			
		}
		
		
		
		
		function setMapa (coords)
		{   
					//Se crea una nueva instancia del objeto mapa
			  var map = new google.maps.Map(document.getElementById('map'),
			  {
				zoom: 17,
				center:new google.maps.LatLng(coords.lat,coords.lng),
		
			  });
		
			  //Creamos el marcador en el mapa con sus propiedades
			  //para nuestro obetivo tenemos que poner el atributo draggable en true
			  //position pondremos las mismas coordenas que obtuvimos en la geolocalización
			  marker = new google.maps.Marker({
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				title:"Mi ubicación actual",
				position: new google.maps.LatLng(coords.lat,coords.lng),
		
			  });
			  //map.setCenter(pos);
			  //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
			  //cuando el usuario a soltado el marcador
			  marker.addListener('click', toggleBounce);
			  
			  marker.addListener( 'dragend', function (event)
			  {
				//escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
				document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
				  document.getElementById("longitud").value = this.getPosition().lng();
				  document.getElementById("latitud").value =  this.getPosition().lat();
		
				  var long=this.getPosition().lat();
				  var lat=this.getPosition().lng();
		
		var locApi="https://maps.googleapis.com/maps/api/geocode/json?latlng="+long+","+lat+"&sensor=true";
		//x.innerHTML=locApi+"<br>"+loc.loc +"<br>"+loc.city +"<br>"+loc.region +"<br>";
		var cadena="";
		$.get({
		url: locApi,
		success:function(data){
		  console.log(typeof data);
		  //console.log(data.results.length);
		  if (data.results.length > 0) {
		 cadena=data.results[0].address_components[0].long_name+", ";
		
		cadena+=data.results[0].address_components[1].long_name+", ";
		
		//cadena+=data.results[0].address_components[4].long_name;
		x.innerHTML=cadena;
		document.getElementById("txtDir").value=cadena;
		}
		else{
		x.innerHTML="La ubicacion no se reconoce, por favor intente de nuevo";
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
		
		
		</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgwFQtMtDvqg2Bgs8qEbqnOidRUL8sPgc&callback=initMap" >
	  </script>
	<script src="js/inicio.js"></script>
		<script src="js/app.js"></script>
		<script src="js/pedido.js" name="pedido"></script>
		
{{--

		<script async defer :src="'https://maps.googleapis.com/maps/api/js?key=AIzaSyCgwFQtMtDvqg2Bgs8qEbqnOidRUL8sPgc&callback=initMap'">
	</script>
	<script src="js/bootstrap.min.js"></script> --}}
	</body>
</html>
