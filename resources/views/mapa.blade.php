<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link href="css/btn_3d.css" rel="stylesheet" />

    <link href="bootstrap.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>
  <body>
    <style>
  @media (max-width: 700px) {
    #div_maps {
      height: 320px;
    }
  }

  @media (min-width: 700px) {
    #div_maps {
      height: 380px;
    }
  }

  #map {
    width: 100%;
    height: 90%;
  }

  #modalcon {
    color: #16438e;
    line-height: 1.42857143;
    font-family: "Frank";
  }
    </style>

    <!-- Modal -->
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
              onclick="addUbicacion(longitud.value,latitud.value,txtDir.value);"
              class="btn btn-success btn-lg verde"
              data-dismiss="modal"
            >ACEPTAR</button>
          </div>
        </div>
      </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/mapa.js"></script>
    <script
    async
    defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgwFQtMtDvqg2Bgs8qEbqnOidRUL8sPgc&callback=initMap"
  ></script>

  </body>
</html>