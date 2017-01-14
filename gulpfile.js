var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
            'bootstrap/dist/css/bootstrap.css',
            'bootstrap/dist/css/bootstrap-theme.css',
            'bootstrap-form-helpers/dist/css/bootstrap-formhelpers.css',
            'MagicalFont/src/magicalfont.css',
            'jquery-datetextentry/jquery.datetextentry.css'
        ], 'public/css/all.css', 'resources/assets/')
        .scripts([
            'bootstrap/dist/js/bootstrap.js',
            'bootstrap-form-helpers/dist/js/bootstrap-formhelpers.js',
            'custom-js/meny.3dmenu.js',
            'custom-js/multi_level_navbar.js',
            'custom-js/typeahead/typeahead.bundle.js',
            'custom-js/handlebars.js',
            'jquery-datetextentry/jquery.datetextentry.js'
        ], 'public/js/app.js', 'resources/assets/')
        .less('custom.less')
        //jquery
        .copy('resources/assets/jquery/dist/jquery.min.js', 'public/js')
        //bootstrap fonts
        .copy('resources/assets/bootstrap/dist/fonts', 'public/fonts')
        //magical fonts # icons
        .copy('resources/assets/MagicalFont/fonts', 'public/fonts')
        //bootstrap form-helpers country flags images
        .copy('resources/assets/bootstrap-form-helpers/dist/img', 'public/img')

        //bootstrap fonts -- in build folder
        .copy('resources/assets/bootstrap/dist/fonts', 'public/build/fonts')
        //magical fonts # icons -- in build folder
        .copy('resources/assets/MagicalFont/fonts', 'public/build/fonts')
        //bootstrap form-helpers country flags images
        .copy('resources/assets/bootstrap-form-helpers/dist/img', 'public/build/img')


        .stylesIn('public/css')
        .scriptsIn('public/js')
        .version(["css/app.css", "css/all.css", "js/app.js"]);
});
