var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');


    //bootstrap
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'public/js/bootstrap.js');

    //bootstrap-switch
    mix.copy('node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css', 'public/css/bootstrap-switch.css');
    mix.copy('node_modules/bootstrap-switch/dist/js/bootstrap-switch.js', 'public/js/bootstrap-switch.js');


    //theater
    mix.copy('bower_components/TheaterJS/build/theater.js', 'public/js/theater.js');

    //share button
    mix.copy('node_modules/share-button/dist/share-button.css', 'public/css/share-button.css');
    mix.copy('node_modules/share-button/dist/share-button.js',  'public/js/share-button.js');

});
