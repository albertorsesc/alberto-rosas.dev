const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.webpackConfig({
    watchOptions: {
        ignored: /node_modules/
    }
})

mix.browserSync({
    proxy: 'http://localhost:8000',
    open: false,
    snippetOptions: {
        rule: {
            match: /<\/body>/i,
            fn: function (snippet, match) {
                return snippet + match;
            }
        }
    }
});
