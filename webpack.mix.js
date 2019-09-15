const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');

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
    })
    .copy('./node_modules/open-sans-fonts/open-sans/Bold', 'public/fonts/open-sans/Bold')
;

if(mix.inProduction()) {
    mix
        .purgeCss()
        .version()
    ;
}

if (process.env.NODE_ENV === 'development') {
    mix.browserSync({
        proxy: 'http://robin.test/',
        host: 'robin.test',
        port: 3000,
        ui: false,
        open: false,
    });
}

