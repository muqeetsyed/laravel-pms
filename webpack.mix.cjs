const mix = require('laravel-mix');

mix.css('resources/css/app.css', 'public/css')
    .copyDirectory('resources/images', 'public/images');
