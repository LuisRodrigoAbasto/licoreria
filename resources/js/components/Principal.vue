<template>
  <div>
    <header>
      <!-- TOP HEADER -->
      <div id="top-header">
        <div class="container">
          <ul class="header-links pull-left">
            <li>
              <a href="#">
                <i class="fa fa-phone"></i> +021-95-51-84
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-envelope-o"></i> email@email.com
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-map-marker"></i> 1734 Stonecoal Road
              </a>
            </li>
          </ul>
          <ul class="header-links pull-right">
            <li class="nav-item d-md-down-none">
              <a class="nav-link">
                <span class="caret"></span>
              </a>
            </li>
            <li class="nav-item dropdown" v-if="arrayUsuario!=0">
              <a
                class="nav-link"
                data-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <img
                  class="img-avatar"
                  :src="'img/avatars/user.ico'"
                  alt="admin@bootstrapmaster.com"
                />
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item">
                  <i class="fa fa-shield" @click="cerrarLogin()">Cerrar Sesion</i>
                </a>
              </div>
            </li>
            <!-- <li v-if="arrayUsuario.length==1"><a href="#"><i class="fa fa-dollar"></i> USD</a></li> -->
            <li v-else>
              <a href="#" data-toggle="modal" data-target="#loginModal">
                <i class="fa fa-user-o"></i> Login
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- /TOP HEADER -->

      <div id="header">
        <!-- container -->
        <div class="container">
          <!-- row -->
          <div class="row">
            <!-- LOGO -->
            <div class="col-md-3">
              <div class="header-logo">
                <a href class="logo">
                  <img :src="'img/logo.png'" alt />
                </a>
              </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-md-6">
              <div class="header-search">
                <form>
                  <select class="input-select" v-model="criterio">
                    <option value="productos">Todos</option>
                    <option value="productos">Productos</option>
                    <option value="categorias">Categorias</option>
                    <!-- <option v-for="dataCategoria in arrayCategoria" :key="dataCategoria.id" :value="dataCategoria.id" v-text="dataCategoria.nombre"></option> -->
                  </select>
                  <input
                    class="input"
                    placeholder="Search here"
                    v-model="buscar"
                    @keyup.enter="listar(1,buscar,criterio)"
                  />
                  <button class="search-btn" @click="listar(1,buscar,criterio)">Search</button>
                </form>
              </div>
            </div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->
            <div class="col-md-3 clearfix">
              <div class="header-ctn">
                <div class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Carrito</span>
                    <div class="qty">{{ arrayDetalle.length }}</div>
                  </a>
                  <div class="cart-dropdown">
                    <div class="cart-list">
                      <div
                        class="product-widget"
                        v-for="(detalle,index) in arrayDetalle"
                        :key="detalle.id"
                      >
                        <div class="product-img">
                          <img :src="'imagenes/productos/'+detalle.imagen" alt />
                        </div>
                        <div class="product-body">
                          <h3 class="product-name">
                            <a href="#">{{ detalle.producto }}</a>
                          </h3>
                          <h4 class="product-price">
                            <span class="qty">{{ detalle.cantidad }}</span>
                            Bs. {{ detalle.precio*detalle.cantidad }}
                          </h4>
                        </div>
                        <button class="delete" @click="eliminarDetalle(index)">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>
                    </div>
                    <div class="cart-summary">
                      <small>{{ arrayDetalle.length }} productos marcados</small>
                      <h5>TOTAL: Bs. {{ totalPedido }}</h5>
                    </div>
                    <div class="cart-btns">
                      <a href="#" @click="atras()">Ver Productos</a>
                      <a href="#" @click="adelante()">
                        Continuar
                        <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- /Cart -->

                <!-- Menu Toogle -->
                <div class="menu-toggle">
                  <a href="#">
                    <i class="fa fa-bars"></i>
                    <span>Menu</span>
                  </a>
                </div>
                <!-- /Menu Toogle -->
              </div>
            </div>
            <!-- /ACCOUNT -->
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
    </header>

    <template v-if="siguiente==0">
      <div class="section">
        <!-- container -->
        <div class="container">
          <!-- row -->
          <div class="row">
            <!-- ASIDE -->

            <!-- /ASIDE -->
            <div class="col-md-1"></div>
            <!-- STORE -->
            <div id="store" class="col-md-10">
              <div class="row">
                <!-- product -->
                <div v-for="(data,index) in arrayData" :key="data.id">
                  <div class="col-md-4 col-xs-6">
                    <div class="product">
                      <div class="product-img">
                        <img :src="'imagenes/productos/'+data.imagen" whith="200" height="200" alt />
                        <div class="product-label">
                          <!-- <span class="sale">-30%</span> -->
                          <span class="new">NEW</span>
                        </div>
                      </div>
                      <div class="product-body">
                        <p class="product-category">{{ data.categoria }}</p>
                        <h3 class="product-name">
                          <a href="#">{{ data.producto }}</a>
                        </h3>
                        <h4 class="product-price">
                          Bs. {{ data.precio }}
                          <!-- <del class="product-old-price">$990.00</del>-->
                        </h4>
                        <div class="product-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                        <div class="product-btns">
                          <button class="add-to-wishlist" @click="disminuirCarrito(index)">
                            <i class="icon-close"></i>
                            <span class="tooltipp">disminuir</span>
                          </button>
                          <button class="add-to-compare fa-satck">
                            <i class="fa fa-stack" v-text="data.cantidad"></i>
                            <span class="tooltipp">Cantidad</span>
                          </button>
                          <button class="quick-view" @click="aumentarCarrito(index)">
                            <i class="icon-plus"></i>
                            <span class="tooltipp">aumentar</span>
                          </button>
                          <!-- <button
                            class="quick-view"
                            data-toggle="modal"
                            data-target="#ModalProducto"
                            @click="verProducto(data)"
                          >
                            <i class="fa fa-eye"></i>
                            <span class="tooltipp">Ver Producto</span>
                          </button> -->
                        </div>
                      </div>
                      <div class="add-to-cart">
                        <button class="add-to-cart-btn" @click="agregarDetalleModal(data)">
                          <i class="fa fa-shopping-cart"></i> Agregar A Carrito
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="store-filter clearfix">
                <span class="store-qty">productos</span>
                <ul class="store-pagination">
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
              </div>
              <!-- /store bottom filter -->
            </div>
            <div class="col-md-1"></div>
            <!-- /STORE -->
          </div>
          <!-- /row -->
        </div>
        <!-- /container -->
      </div>
    </template>

    <template v-if="siguiente==1">
      <div class="section">
        <div class="container">
          <!-- row -->
          <div class="row">
            <div class="col-md-6">
              <!-- Billing Details -->
              <div class="billing-details">
                <div class="section-title">
                  <h3 class="title">Datos y Ubicacion</h3>
                </div>
                <div class="form-group">
                  <label class="col-md-3 form-control-label" for="text-input">NOMBRE</label>
                  <input
                    class="form-control"
                    type="text"
                    name="first-name"
                    v-model="cliente"
                    placeholder="First Name"
                  />
                </div>Ubicacion
                <input type="text" class="form-control" v-model="ubicacion" />
                <br />Latitud
                <input class="form form-control" type="text" v-model="latitud" />
                <br />Longitud
                <input class="form-control" type="text" v-model="longitud" />
                <br />
                <div class="form-group">
                  <button
                    class="btn btn-primary mb-1"
                    type="button"
                    data-toggle="modal"
                    data-target="#largeModal"
                    @click="abrirMapa()"
                  >Ubicacion</button>
                  <!-- <label class="custom-file-label" for="customFileLang">Ubicacion</label> -->
                </div>
              </div>
              <!-- 
              <div class="order-notes">
                <textarea class="input" placeholder="Nota Para la Orden"></textarea>
              </div>-->
              <!-- /Order notes -->
            </div>
            <!-- Order Details -->
            <div class="col-md-6 order-details">
              <div class="section-title text-center">
                <h3 class="title">Su Orden</h3>
              </div>
              <div class="order-summary">
                <div class="order-col">
                  <div>
                    <strong>PRODUCTO</strong>
                  </div>
                  <div>
                    <strong>TOTAL</strong>
                  </div>
                  <div>
                    <strong>OPCIONES</strong>
                  </div>
                </div>
                <div class="order-products">
                  <!-- <div class="order-col">
									<div>1x Product Name Goes Here</div>
									<div>$980.00</div>
                  </div>-->
                  <div class="order-col" v-for="(data,index) in arrayDetalle" :key="data.id">
                    <div class="product-widget">
                      <div class="product-img">
                        <img :src="'/imagenes/productos/'+data.imagen" alt />
                      </div>
                      <div class="product-body">
                        <p class="product-category">{{ data.categoria }}</p>
                        <h3 class="product-name">
                          <a href="#">{{ data.producto }}</a>
                        </h3>
                        <h4 class="product-price">BS. {{ data.precio }}</h4>

                        <div>
                          <label
                            class="form-control-label"
                            for="text-input"
                          >Cantidad: {{ data.cantidad }}</label>
                        </div>
                      </div>
                    </div>

                    <div>{{ data.cantidad*data.precio }}</div>
                    <div class="product-btns">
                      <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger">
                        <i class="icon-close"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="order-col">
                  <div>
                    <strong>TOTAL</strong>
                  </div>
                  <div>
                    <strong class="order-total">Bs. {{ totalPedido }}</strong>
                  </div>
                </div>
              </div>

              <div class="input-checkbox">
                <input type="checkbox" id="terms" />
                <label for="terms">
                  <span></span>
                  He Leido y Acepto Los
                  <a href="#">Terminos & Condiciones</a>
                </label>
              </div>

              <a
                href="#"
                class="primary-btn order-submit"
                data-toggle="modal"
                data-target="#loginModal"
                v-if="idCliente==0"
              >Loguearse</a>
              <a
                href="#"
                class="primary-btn order-submit"
                @click="registrarPedido()"
                v-else
              >Ordenar Pedido</a>
            </div>
            <!-- /Order Details -->
          </div>
          <!-- /row -->
        </div>
        <!-- /container -->
      </div>
      <!-- /SECTION -->
    </template>

    <div
      class="modal fade"
      id="loginModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="loginModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">LOGIN</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="email"
                    class="form-control"
                    placeholder="example@email.com"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Contraseña</label>
                <div class="col-md-9">
                  <input type="password" v-model="password" class="form-control" />
                </div>
              </div>
              <div v-if="errorUsuario">
                <label for class="form-control-label">Los Datos no Son Correctos</label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="login(email,password)"
              :data-dismiss="cerrar"
            >Iniciar</button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="largeModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ubicacion</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <gmap-map :center="center" :zoom="8" style="width:100%;  height: 400px;">
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
            <button
              class="btn btn-primary"
              type="button"
              data-dismiss="modal"
              @click="agregarUbicacion()"
            >Aceptar</button>
          </div>
        </div>
        <!-- /.modal-content-->
      </div>
      <!-- /.modal-dialog-->
    </div>
    <!-- /.modal-->
    <div
      class="modal fade"
      id="ModalProducto"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">PRODUCTO</h5>
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

<div class="row">
                <!-- product -->
                <div v-for="(data,index) in arrayProducto" :key="data.id">
                  <div class="col-md-12 col-xs-12">
                    <div class="product">
                      <div class="product-img">
                        <img :src="'imagenes/productos/'+data.imagen" whith="200" height="200" alt />
                        <div class="product-label">
                          <!-- <span class="sale">-30%</span> -->
                          <span class="new">NEW</span>
                        </div>
                      </div>
                      <div class="product-body">
                        <p class="product-category">{{ data.categoria }}</p>
                        <h3 class="product-name">
                          <a href="#">{{ data.producto }}</a>
                        </h3>
                        <h4 class="product-price">
                          Bs. {{ data.precio }}
                          <!-- <del class="product-old-price">$990.00</del>-->
                        </h4>
                        <div class="product-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                        <div class="product-btns">
                          <button class="add-to-wishlist" @click="disminuirCarrito(index)">
                            <i class="icon-close"></i>
                            <span class="tooltipp">disminuir</span>
                          </button>
                          <button class="add-to-compare fa-satck">
                            <i class="fa fa-stack" v-text="data.cantidad"></i>
                            <span class="tooltipp">Cantidad</span>
                          </button>
                          <button class="quick-view" @click="aumentarCarrito(index)">
                            <i class="icon-plus"></i>
                            <span class="tooltipp">aumentar</span>
                          </button>
                          <button
                            class="quick-view"
                            data-toggle="modal"
                            data-target="#ModalProducto"
                            @click="verProducto(data)"
                          >
                            <i class="fa fa-eye"></i>
                            <span class="tooltipp">Ver Producto</span>
                          </button>
                        </div>
                      </div>
                      <div class="add-to-cart">
                        <button class="add-to-cart-btn" @click="agregarDetalleModal(data)">
                          <i class="fa fa-shopping-cart"></i> Agregar A Carrito
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>

          <div class="modal-footer">
            <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
            <button
              class="btn btn-primary"
              type="button"
              data-dismiss="modal"
              @click="agregarUbicacion()"
            >Aceptar</button>-->
          </div>
        </div>
      </div>
    </div>
  </div>
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

export default {
  name: "GoogleMap",
  data() {
    return {
      idCategoria: 0,
      producto: "",
      precio: 0,
      categoria: "",
      arrayData: [],
      arrayDetalle: [],
      arrayCategoria: [],
      arrayProducto: [],
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
      offset: 3,
      criterio: "productos",
      buscar: "",
      mirar: 0,
      totalPedido: 0,
      email: "",
      password: "",
      arrayUsuario: [],
      cerrar: "",
      errorUsuario: false,
      idCliente: 0,
      cliente: "",
      siguiente: 0,
      ubicacion: "",
      latitud: 0,
      longitud: 0,
      stock: 0,
      center: { lat: -17.3436487, lng: -63.2544467 },
      markers: [
        {
          position: { lat: -17.3436487, lng: -63.2544467 }
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
          position: { lat: -17.3436487, lng: -63.2544467 }
        }
      ];
      this.markers.push({ position: this.center });
    },
    abrirMapa() {
      this.geolocate();
      this.mapaUbicado();
    },
    agregarUbicacion() {
      this.latitud = this.markers[1].position.lat;
      this.longitud = this.markers[1].position.lng;
      this.ubicacion = this.latitud + "," + this.longitud;
    },

    ///// MAPAS

    listar(page, buscar, criterio) {
      let me = this;
      var url =
        "/producto/listarProducto?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayData = respuesta.productos.data;
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
    listarCategoria() {
      let me = this;
      var url = "/categoria/listarCategoria";
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayCategoria = respuesta.categorias;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    verProducto(data = []) {
      let me = this;
      me.arrayProducto = [];
      me.arrayProducto.push({
        id: data["id"],
        producto: data["producto"],
        categoria: data["categoria"],
        precio: data["precio"],
        cantidad: data["cantidad"],
        imagen: data["imagen"],
        stock: data["stock"]
      });
    },
    registrarPedido() {
      let me = this;
      axios
        .post("/pedido/registrar", {
          latitud: me.latitud,
          longitud: me.longitud,
          idCliente: this.idCliente,
          monto: this.totalPedido,
          data: this.arrayDetalle
        })
        .then(function(response) {
          Swal.fire({
            position: "center",
            type: "success",
            title: "Su Pedido esta Siendo Procesado",
            showConfirmButton: false,
            timer: 1500
          });
          me.listar(1, "", "productos");
          me.atras();
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    agregarDetalleModal(data = []) {
      let me = this;
      if (me.encuentra(data["id"])) {
        Swal.fire({
          position: "center",
          type: "error",
          title: "Se encuentra Agregado",
          showConfirmButton: false,
          timer: 1000
        });
      } else {
        me.arrayDetalle.push({
          id: data["id"],
          producto: data["producto"],
          categoria: data["categoria"],
          precio: data["precio"],
          cantidad: data["cantidad"],
          imagen: data["imagen"],
          stock: data["stock"]
        });
        me.totalPedido = me.totalPedido + data["precio"] * data["cantidad"];
        Swal.fire({
          position: "center",
          type: "success",
          title: "Agregado al Carrito",
          showConfirmButton: false,
          timer: 1000
        });
      }
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

      me.totalPedido =
        me.totalPedido -
        me.arrayDetalle[index].precio * me.arrayDetalle[index].cantidad;
      me.arrayDetalle.splice(index, 1);
    },
    aumentarCarrito(index) {
      let me = this;
      me.arrayData[index].cantidad = me.arrayData[index].cantidad + 1;
    },
    disminuirCarrito(index) {
      let me = this;
      if (me.arrayData[index].cantidad == 1) {
        Swal.fire({
          position: "center",
          type: "error",
          title: "No puede Disminuir",
          showConfirmButton: false,
          timer: 1000
        });
      } else {
        me.arrayData[index].cantidad = me.arrayData[index].cantidad - 1;
      }
    },
    login(email, password) {
      let me = this;
      var url = "/usuario/login?email=" + email + "&password=" + password;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayUsuario = respuesta.usuario;
          if (me.arrayUsuario.length > 0) {
            me.cliente =
              me.arrayUsuario[0]["nombre"] +
              " " +
              me.arrayUsuario[0]["apellido"];
            me.idCliente = me.arrayUsuario[0]["id"];
            me.cerrar = "modal";
            me.errorUsuario = false;
          } else {
            me.errorUsuario = true;
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    cerrarLogin() {
      let me = this;
      me.arrayUsuario = [];
    },
    adelante() {
      let me = this;
      me.siguiente = 1;
    },
    atras() {
      let me = this;
      me.siguiente = 0;
    }
  },
  mounted() {
    this.listar(1, this.buscar, this.criterio);
    this.listarCategoria();
    this.geolocate();
    // this.mapaUbicado();
  }
};
</script>
  
