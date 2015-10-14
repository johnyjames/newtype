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
    mix.copy('bower_components/TheaterJS/build/theater.js', 'public/js/theater.js');
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'public/js/bootstrap.js');
});
