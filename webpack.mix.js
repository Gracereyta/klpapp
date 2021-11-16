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
    .js('resources/js/datatables-simple-demo.js', 'public/js')
    .js('resources/js/scripts.js', 'public/js')
    .js('resources/js/demo/datatables-demo.js', 'public/js/demo')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/styles.css', 'public/css');
