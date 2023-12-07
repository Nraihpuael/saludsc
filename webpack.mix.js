const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/analisis/mapaCalor.js', 'public/js/analisis/mapaCalor.js')
    .js('resources/js/users/mapa.js', 'public/js/users/mapa.js')
    .js('resources/js/helpers/button_flotante.js', 'public/js/helpers/button_flotante.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ]);
