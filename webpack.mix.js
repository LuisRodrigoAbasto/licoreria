const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.styles([
    'resources/plantilla/registro/css/coreui-icons.min.css',
    'resources/plantilla/registro/css/flag-icon.min.css',
    'resources/plantilla/registro/css/font-awesome.min.css',
    'resources/plantilla/registro/css/simple-line-icons.css',
    'resources/plantilla/registro/css/style.css',
    'resources/plantilla/registro/css/pace.min.css'
   ],'public/css/plantilla.css')
   .styles([
    'resources/plantilla/inicio/css/bootstrap.min.css',
    'resources/plantilla/inicio/css/btn_3d.css',
   'resources/plantilla/inicio/css/slick.css',
   'resources/plantilla/inicio/css/slick-theme.css',
   'resources/plantilla/inicio/css/nouislider.min.css',
   'resources/plantilla/inicio/css/font-awesome.min.css',
   'resources/plantilla/inicio/css/simple-line-icons.css',
   'resources/plantilla/inicio/css/style.css'
  ],'public/css/inicio.css')
   .scripts(['resources/plantilla/registro/js/pace.min.js',
   'resources/plantilla/registro/js/jquery.min.js',
    // 'resources/plantilla/registro/js/popper.min.js',
    'resources/plantilla/registro/js/bootstrap.min.js',
     'resources/plantilla/registro/js/perfect-scrollbar.min.js',
     'resources/plantilla/registro/js/coreui.min.js',
     'resources/plantilla/registro/js/Chart.min.js',
     'resources/plantilla/registro/js/custom-tooltips.min.js',
     'resources/plantilla/registro/js/main.js',
    //  'resources/plantilla/registro/js/template.js',
     'resources/plantilla/registro/js/sweetalert2.all.min.js'
   ],'public/js/plantilla.js')
    .scripts([
        'resources/plantilla/inicio/js/jquery.min.js',
         'resources/plantilla/inicio/js/bootstrap.min.js',
         'resources/plantilla/inicio/js/mapa.js',
         'resources/plantilla/inicio/js/slick.min.js',
         'resources/plantilla/inicio/js/nouislider.min.js',
         'resources/plantilla/inicio/js/jquery.zoom.min.js',
         'resources/plantilla/inicio/js/sweetalert2.all.min.js',
         'resources/plantilla/inicio/js/main.js'],'public/js/inicio.js')
   .js(['resources/js/app.js'],'public/js/app.js');