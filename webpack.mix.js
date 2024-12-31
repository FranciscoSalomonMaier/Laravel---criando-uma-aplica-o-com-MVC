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

mix
    .sass('resources/css/app.scss', 'public/css');
    //.js('resources/js/app.js', 'public/js'); // Não é necessário pois o bootstrap já trás diversas das 
    // funcionalidades que esse arquivo tammbém possui.
    // Estão sendo importados através do app.js o bootstrap, incluindo o axios e lodash.
    // C:\Users\Chico\Documents\Curso - Alura\Laravel - criando uma aplicação com MVC\controle-series\resources\js\app.js
    // e C:\Users\Chico\Documents\Curso - Alura\Laravel - criando uma aplicação com MVC\controle-series\resources\js\bootstrap.js. 
