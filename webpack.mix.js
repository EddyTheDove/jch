let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/assets/js')
mix.sass('resources/assets/sass/app.scss', 'public/assets/css')
.options({
    processCssUrls: false
});

// admin assets

// mix.js('resources/assets/js/admin.js', 'public/backend/js')
//     .scripts([
//         'node_modules/speakingurl/lib/speakingurl.js',
//         'node_modules/jquery-slugify/dist/slugify.js',
//         'node_modules/bootstrap-tokenfield/dist/bootstrap-tokenfield.js'
//     ], 'public/backend/js/scripts.js')
//     .sass('resources/assets/sass/admin.scss', 'public/backend/css');


if (mix.inProduction()) {
    mix.version();
}
