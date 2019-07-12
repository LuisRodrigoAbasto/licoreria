<div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item" @click="menu=0">
              <a class="nav-link" ref="#">
                <i class="nav-icon icon-speedometer"></i> Dashboard
                <span class="badge badge-primary">NEW</span>
              </a>
            </li>

            <li class="nav-title">Mantenimiento</li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle">
                <i class="nav-icon icon-puzzle"></i> Productos</a>
              <ul class="nav-dropdown-items">
                <li @click="menu=1" class="nav-item">
                  <a class="nav-link" ref="#" >
                    <i class="nav-icon icon-puzzle"></i>Producto</a>
                </li>
                <li class="nav-item" @click="menu=2">
                  <a class="nav-link" ref="#" >
                    <i class="nav-icon icon-pencil"></i> Categoria</a>
                </li>
              </ul>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" >
                  <i class="nav-icon icon-basket-loaded"></i> Ventas</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item" @click="menu=3">
                  <a class="nav-link" ref="#"  >
                    <i class="nav-icon icon-basket-loaded"></i> Venta</a>
                </li>
                <li class="nav-item" @click="menu=4">
                  <a class="nav-link" ref="#"  >
                    <i class="nav-icon icon-cursor"></i> Cliente</a>
                </li>
               
              </ul>
            </li>
            <li class="nav-item" @click="menu=5">
              <a class="nav-link"  ref="#" >
                <i class="nav-icon icon-location-pin"></i>Pedido</a>
            </li>
            <li class="nav-item" @click="menu=6">
              <a class="nav-link" href="#">
                <i class="nav-icon icon-calculator"></i> Usuarios
                <span class="badge badge-primary">NEW</span>
              </a>
            </li>
            <li class="divider"></li>
            <li class="nav-title">Extras</li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" >
                <i class="nav-icon icon-star"></i> Paginas</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="/" target="_top">
                    <i class="nav-icon icon-star"></i> Licoreria</a>
                </li>
              </ul>
            </li>
            <li class="nav-item mt-auto">
              <a class="nav-link nav-link-success" href="/" target="_top">
                <i class="nav-icon icon-cloud-download"></i> Licoreria</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-danger" href="/" target="_top">
                <i class="nav-icon icon-layers"></i> Tecnologia Web
                <strong>PRO</strong>
              </a>
            </li>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>