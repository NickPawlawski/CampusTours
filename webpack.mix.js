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
/*
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
*/
   mix.js('resources/assets/js/MonthPicker/MonthPicker.js', 'public/js/MonthPicker')
.js('resources/assets/js/MonthPicker/MonthPicker.min.js', 'public/js/MonthPicker')
.js('resources/assets/js/MonthPicker/jquery.maskedinput.min.js', 'public/js/MonthPicker')
.sass('resources/assets/sass/test.css', 'public/css/MonthPicker')
.sass('resources/assets/sass/MonthPicker.scss', 'public/css/MonthPicker')
.sass('resources/assets/sass/MonthPicker.min.css', 'public/css/MonthPicker');
