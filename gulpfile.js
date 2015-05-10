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
	/**
	 * These find the .scss files located in
	 * ~/resources/assets/[name].scss and compiles it
	 * to a .css file located in ~/public/css/[name].css.
	 */
    mix.sass('materialize.scss');
    mix.sass('app.scss');

    /**
	 * This takes all listed .css files
	 * and compiles it in to one .css file.
     */
    mix.styles([
        'css/materialize.css',
        'css/app.css',
    ], 'public/output/final.css', 'public');

    /**
     * This takes all javascript files in
     * ~/resources/assets/js and compiles it to
     * a combined javascript file at ~/public/js/app.js.
     */
    // mix.scriptsIn('resources/assets/js', 'public/output/final.js');
    mix.scripts([
        "vendor/jquery-2.1.3.min.js",
        "vendor/pusher.min.js",
        "material/bin/materialize.min.js"
    ], "public/output/final.js", 'resources/assets/js/');
});
