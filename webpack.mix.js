let mix = require('laravel-mix');

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

mix.scripts([
	//'resources/assets/js/jquery.js',
	//'resources/assets/js/bootstrap.js',
	'resources/assets/js/toastr.js',
	'resources/assets/js/vue.js',
	'resources/assets/js/axios.js',
	'resources/assets/js/sweetalert.js',
	'resources/assets/js/global.system.js',
	'resources/assets/js/tools-manager.js',
	'resources/assets/js/plugins/dropzone.js',
	'resources/assets/js/plugins/bootsnav.js',
	'resources/assets/js/plugins/viewportchecker.js',
	'resources/assets/js/plugins/bootstrap-select.min.js',
	'resources/assets/js/plugins/wysihtml5-0.3.0.js',
	'resources/assets/js/plugins/bootstrap-wysihtml5.js',
	'resources/assets/js/plugins/owl.carousel.min.js',
	'resources/assets/js/plugins/jquery.metisMenu.js',
	'resources/assets/js/plugins/jquery.slimscroll.js',
	'resources/assets/js/app.js',
	], 'public/js/app.js')
	.styles([
	//'resources/assets/css/bootstrap.css',
	'resources/assets/css/toastr.css',
	'resources/assets/css/sweetalert.css',
	'resources/assets/css/plugins/dropzone.css',
	'resources/assets/css/plugins/bootstrap-select.min.css',
	'resources/assets/css/plugins/bootstrap-theme.min.css',
	'resources/assets/css/plugins/bootstrap-wysihtml5.css',
	'resources/assets/css/plugins/owl.carousel.css',
	'resources/assets/css/plugins/owl.theme.css',
	'resources/assets/css/plugins/animate.css',
	'resources/assets/css/plugins/bootsnav.css',
	/*'resources/assets/css/plugins/style.css',
	'resources/assets/css/plugins/responsiveness.css',*/
	], 'public/css/app.css')
	.scripts([
		//'resources/assets/js/jquery.js',
		//'resources/assets/js/bootstrap.js',
		'resources/assets/js/toastr.js',
		'resources/assets/js/vue.js',
		'resources/assets/js/axios.js',
		//'resources/assets/js/sweetalert.js',
		'resources/assets/js/global.system.js',
		'resources/assets/js/tools-manager.js',
	],'public/js/app_admin.js')
	.styles([
		//'resources/assets/css/bootstrap.css',
		'resources/assets/css/toastr.css',
		//'resources/assets/css/sweetalert.css',
		'resources/assets/css/plugins/dropzone.css',
	],'public/css/app_admin.css');