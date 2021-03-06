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

mix.options({
    processCssUrls: false
});

mix.js('resources/js/add-product.js', 'public/js')
mix.js('resources/js/add-order.js', 'public/js')
mix.js('resources/js/add-customer.js', 'public/js')
mix.js('resources/js/add-product-image.js', 'public/js')
mix.js('resources/js/order-update.js', 'public/js')
mix.js('resources/js/printassign.js', 'public/js')
mix.js('resources/js/printcustomer.js', 'public/js')
mix.js('resources/js/scan.js', 'public/js')
mix.js('resources/js/detail.js', 'public/js')
mix.js('resources/js/approvework.js', 'public/js')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/promotion.js', 'public/js')

// Graindashboard Assets 

// Copy Fonts
mix.copyDirectory('resources/graindashboard/gd-icons', 'public/graindashboard/css');

// CSS
mix.sass('resources/graindashboard/sass/graindashboard.scss', 'public/graindashboard/css');

// JS
mix.js(
    'resources/graindashboard/js/graindashboard.js',
    'public/graindashboard/js'
);

// JS Components
mix.scripts(
    [
        // Components
        'resources/graindashboard/js/components/gd.malihu-scrollbar.js',
        'resources/graindashboard/js/components/gd.side-nav.js',
        'resources/graindashboard/js/components/gd.unfold.js',
        // Init components
        'resources/graindashboard/js/components.js',

    ],
    'public/graindashboard/js/graindashboard.vendor.js'
);


mix.version();