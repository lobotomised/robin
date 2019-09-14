const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');
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

mix
    .disableNotifications()
    .js('resources/js/app.js', 'public/js')
    .extract(['crypto-js', 'axios', 'vue'])
    .sass('resources/sass/app.scss', 'public/css')
    //.sourceMaps()
    .webpackConfig({
    //    devtool: 'source-map'
    })
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    });

if(mix.inProduction()) {
    mix
        .purgeCss()
        .version()
    ;
}

if (process.env.NODE_ENV === 'development') {
    mix.browserSync({
        port: 3000,
        proxy: 'http://localhost:8000/',
        ui: false,
        open: false,
    });
}

