<template>
<div>

		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						
						<!-- <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li> -->
						<li><a href="#"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-o"></i> Login</a></li>
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
							<a href="" class="logo">
								<img :src="'img/logo.png'" alt="">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form>
								<select class="input-select" v-model="criterio" >
									<option value="productos">Todos</option>
									<option value="productos">Productos</option>
									<option value="categorias">Categorias</option>
									<!-- <option v-for="dataCategoria in arrayCategoria" :key="dataCategoria.id" :value="dataCategoria.id" v-text="dataCategoria.nombre"></option> -->
								</select>
								<input class="input" placeholder="Search here" v-model="buscar" @keyup.enter="listar(1,buscar,criterio)">
								<button class="search-btn" @click="listar(1,buscar,criterio)">Search</button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							<!-- Wishlist -->
							<!-- <div>
								<a href="#">
									<i class="fa fa-heart-o"></i>
									<span >Your Wishlist</span>
									<div class="qty">2</div>
								</a>
							</div> -->
							<!-- /Wishlist -->

							<!-- Cart -->
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Carrito</span>
									<div class="qty">{{ arrayDetalle.length }}</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<div class="product-widget" v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
											<div class="product-img">
												<img :src="'imagenes/productos/'+detalle.imagen" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">{{ detalle.producto }}</a></h3>
												<h4 class="product-price"><span class="qty">{{ detalle.cantidad }}</span>Bs. {{ detalle.precio*detalle.cantidad }}</h4>
											</div>
											<button class="delete"  @click="eliminarDetalle(index)"><i class="fa fa-close"></i></button>
										</div>

										<!-- <div class="product-widget">
											<div class="product-img">
												<img :src="'img/product02.png'" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div> -->
									</div>
									<div class="cart-summary">
										<small>{{ arrayDetalle.length }} productos marcados</small>
										<h5>TOTAL: Bs. {{ totalPedido }}</h5>
									</div>
									<div class="cart-btns">
										<a href="#">Ver Carrito</a>
										<a href="#">Continuar<i class="fa fa-arrow-circle-right"></i></a>
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


		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					
					<!-- /ASIDE -->
					<div class="col-md-1">

					</div>
					<!-- STORE -->
					<div id="store" class="col-md-10">
						
						<div class="row"  >
							<!-- product -->
							<div v-for="(data,index) in arrayData" :key="data.id">
							<div class="col-md-4 col-xs-6" >
								<div class="product">
									<div class="product-img">
										<img :src="'imagenes/productos/'+data.imagen" whith="200" height="200" alt="">
										<div class="product-label">
											<!-- <span class="sale">-30%</span> -->
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">{{ data.categoria }}</p>
										<h3 class="product-name"><a href="#">{{ data.producto }}</a></h3>
										<h4 class="product-price">Bs. {{ data.precio }}
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
											<button class="add-to-wishlist" @click="disminuirCarrito(index)"><i class="icon-close"></i><span class="tooltipp">disminuir</span></button>
											<button class="add-to-compare fa-satck"><i class="fa fa-stack" v-text="data.cantidad"></i><span class="tooltipp">Cantidad</span></button>
											<button class="quick-view" @click="aumentarCarrito(index)" ><i class="icon-plus"></i><span class="tooltipp">aumentar</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn" @click="agregarDetalleModal(data)"><i class="fa fa-shopping-cart"></i> add to cart</button>
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
                  :class="[page == isActived ? 'active' : '']">
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
					<div class="col-md-1">

					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
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
                  <input
                    type="password"
                    v-model="password"
                    class="form-control"
                  />
                </div>
              </div>
             <div v-if="!errorUsuario">
				 <label for="" class="form-control-label">Los Datos no Son Correctos</label>
			 </div>
            </form>             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Iniciar</button>
      </div>
    </div>
  </div>
</div>

</div>

</template>


<script>
import Vue from 'vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
export default {
data() {
	return {
		idProducto:0,
		idCategoria:0,
		producto:"",
		precio:0,
		categoria:"",
		arrayData:[],
		arrayDetalle:[],
		arrayCategoria:[],
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
	   criterio:"productos",
	   buscar:"",
	   mirar:0,
	   totalPedido:0,
	   email:"",
	   password:""
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
	    listar(page, buscar, criterio) {
      let me = this;
      var url =
        "/producto/listarProducto?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
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
      var url =
        "/categoria/listarCategoria";
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
          categoria:data["categoria"] ,
          precio: data["precio"],
		  cantidad:data["cantidad"],
		  imagen:data["imagen"]
		});
		me.totalPedido=me.totalPedido+(data["precio"]*data["cantidad"]);
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
	  me.arrayDetalle.splice(index, 1);
	  me.totalPedido=me.totalPedido-(arrayDetalle["precio"]*arrayDetalle["cantidad"]);
	},
	aumentarCarrito(index) {
		let me =this;
		me.arrayData[index].cantidad=me.arrayData[index].cantidad+1;
	},
	disminuirCarrito(index) {
		let me =this;
		if(me.arrayData[index].cantidad==1){
	  	Swal.fire({
                  position: "center",
                  type: "error",
                  title: "No puede Disminuir",
                  showConfirmButton: false,
                  timer: 1000
                });
		}
		else{
	  me.arrayData[index].cantidad=me.arrayData[index].cantidad-1;
	  }
	},
	login()
	{
      let me = this;
      var url =
        "/usuario/login?email="+this.email+"&paswword"+this.password;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayCategoria = respuesta.categorias;
        })
        .catch(function(error) {
          console.log(error);
        });
	}

  },
mounted(){
// this.recargar=t;
this.listar(1, this.buscar, this.criterio);
this.listarCategoria();
 }
};

Vue.component('v-select', vSelect)
</script>