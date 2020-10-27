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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
    // 我:"我们会不会一直在一起呀？"
        // 他:"会,要一直一直在一起！"
        //  我:"我们会不会分开啊？"
        //   他:"不会,你这辈子就栽我手里了"
        //    我:"我们会不会结婚?"
        //     他:"会,这辈子就林闹闹了"
        //        我:"我们会有自己的家和猫吗？"
        //         他:"会,我们俩一起努力,一起有一个小家,养一只猫,你在家做好饭等我下班回家,就一直平平淡淡的"
