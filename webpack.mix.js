let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss');

mix
    .setPublicPath('dist')
    .sass('resources/scss/package.scss', 'css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .version()
    .disableNotifications()
