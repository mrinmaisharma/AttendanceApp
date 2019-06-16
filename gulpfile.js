var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

var gulp = require('gulp');

elixir(function (mix) {
    //compile sass to css
    
    mix.sass('resources/assets/sass/app.scss', 'resources/assets/css');
    
    
    //combine css file
    mix.styles(
        [
            'css/app.css'
            // ,'css/styles.css'            
            
        ],'public/css/all.css',//output file
        'resources/assets' //source dir
    );
    
    
    //mix scripts
    var bowerPath = 'bower/vendor';
    
    mix.scripts(
        [
            //jQuery
            'js/jquery.min.js',
            'js/jquery-migrate.min.js',
            
            //other dependencies
            // bowerPath+'/axios/dist/axios.min.js',
            
            'js/cf.js',
            'js/app/*.js',
//            
            'js/init.js'
            
        ], 'public/js/all.js', 'resources/assets'
    );
    
});