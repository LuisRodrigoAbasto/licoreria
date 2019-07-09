<template>
<div>
        <div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-6">
						<div class="header-logo">
							<a href="" class="logo">
								<img :src="'img/logo.png'" alt="">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<!-- <div class="col-md-6">
						<div class="header-search">
							<form>
								<select class="input-select" v-model="criterio" >
									<option value="productos">Todos</option>
									<option value="productos">Productos</option>
									<option value="categorias">Categorias</option>-->
									<!-- <option v-for="dataCategoria in arrayCategoria" :key="dataCategoria.id" :value="dataCategoria.id" v-text="dataCategoria.nombre"></option> -->
							<!--	</select>
								<input class="input" placeholder="Search here" v-model="buscar" @keyup.enter="listar(1,buscar,criterio)">
								<button class="search-btn" @click="listar(1,buscar,criterio)">Search</button>
							</form>
						</div>
					</div> -->
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-6 clearfix">
						<div class="header-ctn">
							<!-- Wishlist -->
							<div>
								<a href="#">
									<i class="fa fa-heart-o"></i>
									<span >Your Wishlist</span>
									<div class="qty">2</div>
								</a>
							</div>
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
												<h4 class="product-price"><span class="qty">{{ detalle.cantidad }}</span>$ {{ detalle.precio*detalle.cantidad }}</h4>
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
										<small>3 Item(s) selected</small>
										<h5>SUBTOTAL: $2940.00</h5>
									</div>
									<div class="cart-btns">
										<a href="#">View Cart</a>
										<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
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
		<!-- NAVIGATION -->
				<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Hot Deals</a></li>
						<li><a href="#">Categories</a></li>
						<li><a href="#">Laptops</a></li>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Cameras</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- SECTION -->
		
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<template v-if="regargar">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
									<li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
									<li><a data-toggle="tab" href="#tab1">Cameras</a></li>
									<li><a data-toggle="tab" href="#tab1">Accessories</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->
					</template>
					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										<div  class="product" v-for="data in arrayData" :key="data.id" >
											<div class="product-img">
												<img :src="'imagenes/productos/'+data.imagen"  alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{ data.categoria }}</p>
												<h3 class="product-name"><a href="#">{{ data.producto }}</a></h3>
												<h4 class="product-price">${{ data.precio }} <del class="product-old-price">$00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<div class="add-to-cart" v-if="data.estado==1">
												<button class="add-to-cart-btn" @click="agregarDetalleModal(data)"><i class="fa fa-shopping-cart"></i> carrito</button>
											</div>
											<div class="add-to-cart" v-else>
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> agregado</button>
											</div>
										</div>
										<!-- /product -->

										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		
		<!-- /SECTION -->

		<!-- /SECTION -->


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
	   recargar:false
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
		  cantidad:1,
		  imagen:data["imagen"]
		});
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
    },

  },
mounted(){
// this.recargar=t;
this.listar(1, this.buscar, this.criterio);
this.listarCategoria();
this.recargar=true;
 }
};

Vue.component('v-select', vSelect)
</script>