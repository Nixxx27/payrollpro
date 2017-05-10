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
    // mix.less('app.less');


       mix.styles([
        'styles/payroll_pro_styles.css',
        'vendor/ace-master/css/bootstrap.min.css',
        'vendor/ace-master/font-awesome/4.5.0/css/font-awesome.min.css',
        'vendor/ace-master/css/ace.min.css',
        'vendor/ace-master/css/ace-skins.min.css',
        'vendor/ace-master/css/ace-rtl.min.css',
        
        ],'public/css/payroll_pro_ph_styles.css'); //3rd arg loc: def resources/assets  

    mix.scripts([
        'vendor/ace-master/ace-extra.min.js',
        'vendor/ace-master/jquery-2.1.4.min.js',
        'vendor/ace-master/bootstrap.min.js',
        'vendor/ace-master/ace-elements.min.js',
        'vendor/ace-master/ace.min.js',

    ],'public/js/payroll_pro_ph_scripts.js')
    
});
