//@ts-ignore
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
   'resources/assets/plantilla/vendors/bootstrap/dist/css/bootstrap.min.css',
   'resources/assets/plantilla/vendors/font-awesome/css/font-awesome.min.css',
   'resources/assets/plantilla/vendors/nprogress/nprogress.css',
   'resources/assets/plantilla/vendors/iCheck/skins/flat/green.css',

   'resources/assets/plantilla/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
   'resources/assets/plantilla/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
   'resources/assets/plantilla/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
   'resources/assets/plantilla/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
   'resources/assets/plantilla/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css',
   'resources/assets/plantilla/bootstrap-glyphicons.css',

   'resources/assets/plantilla/build/css/custom.min.css'
], 'public/css/plantilla.css')
.scripts([
   'resources/assets/plantilla/vendors/jquery/dist/jquery.min.js',
   'resources/assets/plantilla/vendors/bootstrap/dist/js/bootstrap.min.js',
   'resources/assets/plantilla/vendors/fastclick/lib/fastclick.js',
   'resources/assets/plantilla/vendors/nprogress/nprogress.js',
   'resources/assets/plantilla/vendors/Chart.js/dist/Chart.min.js',

   'resources/assets/plantilla/vendors/iCheck/icheck.min.js',
   'resources/assets/plantilla/vendors/datatables.net/js/jquery.dataTables.min.js',
   'resources/assets/plantilla/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
   'resources/assets/plantilla/vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
   'resources/assets/plantilla/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
   'resources/assets/plantilla/vendors/datatables.net-buttons/js/buttons.flash.min.js',
   'resources/assets/plantilla/vendors/datatables.net-buttons/js/buttons.html5.min.js',
   'resources/assets/plantilla/vendors/datatables.net-buttons/js/buttons.print.min.js',
   'resources/assets/plantilla/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
   'resources/assets/plantilla/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js',
   'resources/assets/plantilla/vendors/datatables.net-responsive/js/dataTables.responsive.min.js',
   'resources/assets/plantilla/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',
   'resources/assets/plantilla/vendors/datatables.net-scroller/js/dataTables.scroller.min.js',
   'resources/assets/plantilla/vendors/jszip/dist/jszip.min.js',
   'resources/assets/plantilla/vendors/pdfmake/build/pdfmake.min.js',
   'resources/assets/plantilla/vendors/pdfmake/build/vfs_fonts.js',
   'resources/assets/plantilla/sweetalert2/sweetalert2.all.js',

   'resources/assets/plantilla/build/js/custom.min.js'
], 'public/js/plantilla.js')
.js(['resources/js/app.js'], 'public/js/app.js')
.copy('node_modules/font-awesome/fonts/', 'public/fonts')
.sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css')
.version();