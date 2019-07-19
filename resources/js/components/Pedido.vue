<template>
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item">
        <a href="#">Admin</a>
      </li>
      <li class="breadcrumb-item active">Dashboard</li>
      <!-- Breadcrumb Menu-->
      <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
          <a class="btn" href="#">
            <i class="icon-speech"></i>
          </a>
          <a class="btn" href="#">
            <i class="icon-graph"></i> Dashboard
          </a>
          <a class="btn" href="#">
            <i class="icon-settings"></i> Settings
          </a>
        </div>
      </li>
    </ol>

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Pedido
          <button
            type="button"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>

        <template v-if="listado==1">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="cliente">Cliente</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keyup.enter="listar(1,buscar,criterio)"
                    class="form-control"
                    placeholder="Buscar Producto"
                  />
                  <button type="submit" @click="listar(1,buscar,criterio)" class="btn btn-primary">
                    <i class="fa fa-search"></i> Buscar
                  </button>
                  <div></div>
                </div>
              </div>
            </div>

            <table class="table table-responsive-sm table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Fecha</th>
                  <th>Monto Total</th>
                  <th>Ubicacion</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="data in arrayData" :key="data.id">
                  <td>{{ data.id }}</td>
                  <td>{{ data.cliente }}</td>
                  <td>{{ data.fechaPedido }}</td>
                  <td>{{ data.monto }}</td>
                  <td>
                    <button
                      type="button"
                      data-toggle="modal"
                    data-target="#ModalMapa"
                      @click="mostrarMapa(data.latitud,data.longitud)"
                      class="btn btn-success form-control"
                    >
                      <i class="icon-check"></i>
                    </button>
                  </td>
                  <td>
                    <div v-if="data.estado">
                      <span class="badge badge-success">Activo</span>
                    </div>
                    <div v-else>
                      <span class="badge badge-danger">Desactivado</span>
                    </div>
                  </td>
                  <td>
                    <button
                      type="button"
                      @click="mostrarDetalle(data)"
                      class="btn btn-warning btn-sm"
  data-toggle="modal"
            data-target="#ModalDetalle"
                    >
                      <i class="icon-pencil"></i>
                    </button> &nbsp;
                    <template v-if="data.estado">
                      <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        @click="desactivar(data.id)"
                      >
                        <i class="icon-trash"></i>
                      </button>
                    </template>
                    <template v-else>
                      <button type="button" class="btn btn-info btn-sm" @click="activar(data.id)">
                        <i class="icon-check"></i>
                      </button>
                    </template>
                  </td>
                </tr>
              </tbody>
            </table>
            <nav>
              <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                  >Ant</a>
                </li>
                <li
                  class="page-item"
                  v-for="page in pagesNumber"
                  :key="page"
                  :class="[page == isActived ? 'active' : '']"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(page,buscar,criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                  >Sig</a>
                </li>
              </ul>
            </nav>
          </div>
        </template>
        <!-- Aquiii -->
     
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade bd-example-modal-lg"
      tabindex="-1"
      id="ModalDetalle"
      role="dialog"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="data in arrayDetalle" :key="data.idProducto">
           <td><div class="product-widget" >
									<div class="product-img">
										<img :src="'imagenes/productos/'+data.imagen" width="100" height="100" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{ data.categoria }}</p>
										<h3 class="product-name"><a href="#">{{ data.producto }}</a></h3>
										<!-- <h4 class="product-price">Bs. {{ data.precioP }} <del class="product-old-price"></del></h4>
                    <h5 class="product-price">Cantidad. {{ data.cantidad }} <del class="product-old-price"></del> </h5> -->
									</div>
								</div>
           </td>
           <td>
             <div class="product-body">
										<h4 class="product-price">Bs. {{ data.precioP }} <del class="product-old-price"></del></h4>
                    <h5 class="product-price">Cantidad. {{ data.cantidad }} <del class="product-old-price"></del> </h5>
									</div>
             	<h4 class="product-price">Bs. {{ data.precio }} <del class="product-old-price">$</del></h4>
           </td>
            </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="cerrarModal()"
            >Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- MAPA -->
    <div
      class="modal fade bd-example-modal-lg"
      tabindex="-1"
      id="ModalMapa"
      role="dialog"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle" v-text="tituloModal"></h5>
            <button
              type="button"
              class="close"
              @click="cerrarModal()"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <gmap-map :center="center" :zoom="12" style="width:100%;  height: 400px;">
                <gmap-marker
                  :key="index"
                  v-for="(m, index) in markers"
                  :position="m.position"
                  @click="center=m.position"
                ></gmap-marker>
              </gmap-map>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
            <!-- <button
              class="btn btn-primary"
              type="button"
              data-dismiss="modal"
              @click="agregarUbicacion()"
            >Aceptar</button>-->
          </div>
        </div>
      </div>
    </div>

    
  </main>
</template>
<script>
import Vue from "vue";
import vSelect from "vue-select";

import "vue-select/dist/vue-select.css";

import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyCgwFQtMtDvqg2Bgs8qEbqnOidRUL8sPgc",
    libraries: "places" // necessary for places input
  }
});


Vue.component("v-select", vSelect);
export default {
  data() {
    return {
      id: 0,
      idCliente: "",
      descripcion: "",
      producto: "",
      stock: 0,
      cantidad: 0,
      precio: 0,
      idCategoria: 0,
      idProducto: 0,
      categoria: "",
      arrayData: [],
      arrayCliente: [],
      arrayProducto: [],
      arrayDetalle: [],
      listado: 1,
      monto: 0,
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorMostrar: 0,
      errorMostrarMsj: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      selectedCliente: null,
      offset: 3,
      criterio: "cliente",
      buscar: "",
      buscarP: "",
      criterioP: "productos",
       center: { lat:-17.3436487, lng: -63.2544467 },
      markers: [
        {
           position: { lat:-17.3436487, lng: -63.2544467 }
        }
      ],
      places: [],
      currentPlace: null
    };
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {

////MAPAS
    setPlace(place) {
      this.currentPlace = place;
    },
    addMarker() {
      if (this.currentPlace) {
        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        };
        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
      }
    },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    },
    mapaUbicado() {
      this.markers = [
        {
          position: { lat:-17.3436487, lng: -63.2544467 }
        }
      ];
      this.markers.push({ position: this.center });
    },
    abrirMapa() {
      this.geolocate();
      this.mapaUbicado();
    },
    mostrarMapa(latitud,longitud) {
      this.markers = [
        {
          position: { lat:-17.3436487, lng: -63.2544467 }
        },
        {
           position: { lat:latitud, lng:longitud }
        }
      ];
     
    },
    agregarUbicacion()
    {
      this.latitud=this.markers[1].position.lat;
      this.longitud=this.markers[1].position.lng;
      this.ubicacion=this.latitud+','+this.longitud;
    },

    ///// MAPAS


    listar(page, buscar, criterio) {
      let me = this;
      var url = "/pedido?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayData = respuesta.pedidos.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      // actualizar la Pagina
      me.pagination.current_page = page;
      // enviar la peticion para visualizar la data de esta pagina
      me.listar(page, buscar, criterio);
    },
    selectProducto(search, loading) {
      let me = this;
      loading(true);
      var url = "/producto/selectProducto?criterio=productos&buscar=" + search;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          q: search;
          me.arrayProducto = respuesta.productos;
          loading(false);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getDatosProducto(val1) {
      let me = this;
      me.loading = true;
      me.idProducto = val1.id;
      me.producto = val1.producto;
      me.categoria = val1.categoria;
      me.precio = val1.precio;
      me.stock = val1.stock;
    },
    selectCliente(search, loading) {
      let me = this;
      loading(true);
      var url = "/cliente/selectCliente?filtro=" + search;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          q: search;
          me.arrayCliente = respuesta.clientes;
          loading(false);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getDatosCliente(val1) {
      let me = this;
      me.loading = true;
      me.idCliente = val1.id;
      me.cliente = val1.cliente;
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    eliminarDetalle(index) {
      let me = this;
      me.arrayDetalle.splice(index, 1);
    },
    agregarDetalle() {
      let me = this;
      if (me.idProducto == 0) {
      } else {
        if (me.encuentra(me.idProducto)) {
          Swal.fire({
            position: "center",
            type: "El Producto ya se Encuentra Agregado",
            title: "Error",
            showConfirmButton: false,
            timer: 1000
          });
        } else {
          me.arrayDetalle.push({
            id: me.idProducto,
            producto: me.producto,
            cantidad: me.cantidad,
            categoria: me.categoria,
            precio: me.precio,
            stock: me.stock
          });
          me.cantidad = 0;
        }
      }
    },
    agregarDetalleModal(data = []) {
      let me = this;
      if (me.encuentra(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "Este Producto ya se Encuentra Agregado!"
        });
      } else {
        me.arrayDetalle.push({
          id: data["id"],
          producto: data["producto"],
          cantidad: 1,
          categoria: data["categoria"],
          precio: data["precio"],
          stock: data["stock"]
        });
      }
    },
    listarProducto() {
      let me = this;
      var url =
        "/producto/selectProducto?criterio=" +
        this.criterioP +
        "&buscar=" +
        this.buscarP;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayProducto = respuesta.productos;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarTotal() {
      let me = this;
      me.monto = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        me.monto =
          this.arrayDetalle[i].cantidad * this.arrayDetalle[i].precio +
          me.monto;
      }
      me.monto = me.monto.toFixed(2);
    },
    registrar() {
      if (this.validar()) {
        return;
      }
      let me = this;

      axios
        .post("/pedido/registrar", {
          idCliente: this.idCliente,
          descripcion: this.descripcion,
          monto: this.monto,
          data: this.arrayDetalle
          // idUsuario: 1,
        })
        .then(function(response) {
          me.listar(1, "", "cliente");
          me.limpiarRegistro();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    limpiarRegistro() {
      let me = this;
      me.id = 0;
      me.idProducto = 0;
      me.idCliente = 0;
      me.cliente = "";
      me.monto = 0;
      me.descripcion = "";
      me.producto = "";
      me.categoria = "";
      me.idCategoria = 0;
    },
    actualizar() {
      if (this.validar()) {
        return;
      }
      let me = this;
      axios
        .put("/pedido/actualizar", {
          idCliente: this.idCliente,
          descripcion: this.descripcion,
          monto: this.monto
          // idUsuario: 1
        })
        .then(function(response) {
          me.listar(1, "", "nombre");
          me.limpiarRegistro(1);
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    desactivar(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });

      swalWithBootstrapButtons
        .fire({
          title: "Estas Seguro de Desactivar el Registro?",
          text: "Si Desactiva no estara en la Lista!",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Desactivar!",
          cancelButtonText: "No, Cancelar!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
            let me = this;

            axios
              .put("/pedido/desactivar", {
                id: id
              })
              .then(function(response) {
                me.listar(1, "", "nombre");
                Swal.fire({
                  position: "center",
                  type: "success",
                  title: "El Registro ha sido Desactivado",
                  showConfirmButton: false,
                  timer: 1000
                }).catch(function(error) {
                  console.log(error);
                });
              });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              position: "center",
              type: "error",
              title: "Cancelado",
              showConfirmButton: false,
              timer: 1000
            });
          }
        });
    },
    activar(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });

      swalWithBootstrapButtons
        .fire({
          title: "Estas Seguro de Desactivar el Registro?",
          text: "Si Desactiva no estara en la Lista!",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Desactivar!",
          cancelButtonText: "No, Cancelar!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
            let me = this;

            axios
              .put("/pedido/activar", {
                id: id
              })
              .then(function(response) {
                me.listar(1, "", "nombre");
                Swal.fire({
                  position: "center",
                  type: "success",
                  title: "El Registro ha sido Desactivado",
                  showConfirmButton: false,
                  timer: 1000
                }).catch(function(error) {
                  console.log(error);
                });
              });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              position: "center",
              type: "error",
              title: "Cancelado",
              showConfirmButton: false,
              timer: 1000
            });
          }
        });
    },
    validar() {
      this.errorMostrar = 0;
      this.errorMostrarMsj = [];

      if (!this.idCliente)
        this.errorMostrarMsj.push("Ingrese el Nombre del Producto");
      if (this.arrayDetalle.length)
        this.errorMostrarMsj.push("No tiene Ningun Producto");
      if (this.monto) this.errorMostrarMsj.push("Calcule el Precio Total");
      if (this.errorMostrarMsj.length) this.errorMostrar = 1;
      return this.errorMostrar;
    },
    cerrarModal() {
      (this.modal = 0), (this.tituloModal = "");
      this.nombre = "";
      this.idCategoria = 0;
      this.categoria = "";
      this.descripcion = "";
      this.imagen = "";
      this.stock = "";
      this.selectedCliente = null;
    },
    mostrarDetalle(data=[]) {
      
              this.limpiarRegistro();
              this.tipoAccion = 2;
              this.id = data["id"];
              this.cliente = data["cliente"];
              this.idCliente = data["idCliente"];
              this.monto = data["monto"];
              this.descripcion = data["descripcion"];             
              let me = this;
              var url = "/pedido/mostrarDetalle?id=" + data["id"];
              axios
                .get(url)
                .then(function(response) {
                  var respuesta = response.data;
                  me.arrayDetalle = respuesta.detalles;
                })
                .catch(function(error) {
                  console.log(error);
                });
          },
    ocultarDetalle() {
      this.listado = 1;
    },

    ocultarDetalle() {
      this.listado = 1;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
    },
    abrirModal() {
      this.arrayProducto = [];
      this.arrayFormulaProducto = [];
      this.modal = 1;
      this.tituloModal = "Selecione uno o varios Productos";
    }
  },
  mounted() {
    this.listar(1, this.buscar, this.criterio);
  }
};
Vue.component("v-select", vSelect);
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
</style>
