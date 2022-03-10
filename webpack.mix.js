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

mix.js(['resources/js/app.js',
    'resources/js/weather.js',
    'resources/js/axios-weather.js'], 'public/js')
    .autoload({
        "jquery": ['$', 'window.jQuery'],
    })
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .version();

    // mix.js([
    //     'resources/js/libs/jquery-3.6.0.min.js',
    //     // 'resources/smart/js/libs/jquery-ui.min.js',
    //     'resources/js/libs/bootstrap.js',
    //     'resources/js/libs/star-rating.min.js',
    //     'resources/js/libs/jquery.cookie.js',
    //     'resources/js/app.js',
    //     ], 'public/js/all.js')
    //     .sass('resources/sass/app.scss', 'public/css')
    //     .version();
