const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/assets/js/dashboard.js")
    .sass("resources/scss/mix.scss", "public/assets/css/styles.css")
    .sass("resources/scss/pages/catalogue.scss", "public/assets/css/catalogue.css");