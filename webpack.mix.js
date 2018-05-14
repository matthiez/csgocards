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
require('laravel-mix').mix
.sass('resources/assets/sass/app.scss', 'public/css/app.css')
.js('resources/assets/js/bootstrap.js', 'public/js/app.js');