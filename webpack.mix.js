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

mix.disableNotifications()
    .js('resources/js/app.js', 'public/js')
    .extract(['crypto-js', 'axios'])
    .sass('resources/sass/app.scss', 'public/css')
    .version();

mix.browserSync({
    proxy: 'http://robin.test/',
    host: 'robin.test',
    port: 3000,
    ui: false,
    open: false,
    files: [
        'resources/views/!**!/!*.php',
        'resources/js/!*.js',
        'resources/css/!*.scss',
    ],
});
