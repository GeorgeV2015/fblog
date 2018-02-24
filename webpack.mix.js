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

mix.styles([
    'resources/assets/admin/vendor/bootstrap/css/bootstrap.min.css',
    'resources/assets/admin/vendor/metisMenu/metisMenu.min.css',
    'resources/assets/admin/dist/css/sb-admin-2.min.css',
    'resources/assets/admin/vendor/font-awesome/css/font-awesome.min.css',
    'resources/assets/admin/vendor/datatables-plugins/dataTables.bootstrap.css',
    'resources/assets/admin/vendor/datatables-responsive/dataTables.responsive.css',
    'resources/assets/admin/vendor/select2/select2.min.css',
    'resources/assets/admin/vendor/datepicker/datepicker3.css',
    'resources/assets/admin/dist/css/styles.css'
], 'public/css/admin.css');

mix.styles([
    'resources/assets/front/css/bootstrap-theme.min.css',
    'resources/assets/admin/vendor/font-awesome/css/font-awesome.min.css',
    'resources/assets/front/css/blog-home.css'
], 'public/css/front.css');

mix.scripts([
    'resources/assets/admin/vendor/jquery/jquery.min.js',
    'resources/assets/admin/vendor/bootstrap/js/bootstrap.min.js',
    'resources/assets/admin/vendor/metisMenu/metisMenu.min.js',
    'resources/assets/admin/vendor/raphael/raphael.min.js',
    'resources/assets/admin/vendor/datatables/js/jquery.dataTables.min.js',
    'resources/assets/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js',
    'resources/assets/admin/vendor/datatables-responsive/dataTables.responsive.js',
    'resources/assets/admin/vendor/select2/select2.full.min.js',
    'resources/assets/admin/vendor/datepicker/bootstrap-datepicker.js',
    'resources/assets/admin/vendor/uploadPreview/uploadPreview.js',
    'resources/assets/admin/dist/js/sb-admin-2.min.js',
    'resources/assets/admin/vendor/scripts.js'
], 'public/js/admin.js');

mix.scripts([
    'resources/assets/admin/vendor/jquery/jquery.min.js',
    'resources/assets/front/js/bootstrap.bundle.min.js',
    'resources/assets/admin/vendor/uploadPreview/uploadPreview.js',
    'resources/assets/front/js/scripts.js'
], 'public/js/front.js');

mix.copy(
    'resources/assets/admin/vendor/bootstrap/fonts',
    'public/fonts'
);

mix.copy(
    'resources/assets/admin/vendor/font-awesome/fonts',
    'public/fonts'
);


