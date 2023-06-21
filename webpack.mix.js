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
    // js('resources/chatify/autosize.js', 'public/js')
    // js('resources/chatify/code.js', 'public/js')
    // js('resources/chatify/utils.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/font-awesome.scss', 'public/css')
    .sass('resources/sass/external/font.scss', 'public/css')
    .sourceMaps(true, 'inline-source-map')
    .disableSuccessNotifications(); //成功時の通知の制限
