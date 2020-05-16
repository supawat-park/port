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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/sweetalert.scss', 'public/css')
   .scripts([
      "public/js/admin.js"
   ], 'public/js/backend-custom.js')
   .scripts([
      "public/js/template.js"
   ], 'public/js/template-script.js')
   // .js([
   //    'resources/js/admin.js',
   // ], 'public/js/backend-custom.js')
   .js([
      'resources/js/custom.js',
   ], 'public/js/custom.js')
   .js([
      "resources/js/plugins.js"
   ], 'public/js/plugins.js')
   .js([
      'resources/js/sweetalert.min.js',
   ], 'public/js/sweetalert.js')
   .js([
      'resources/js/jquery.3.2.1.min.js',
   ], 'public/js/jquery.js')
   .version();
