require('./bootstrap');

let turbolinks = require("turbolinks");
turbolinks.start();

turbolinks.setProgressBarDelay(1);

$(document).on('turbolinks:load', function() {
    $('.dropdown-toggle').dropdown();
});