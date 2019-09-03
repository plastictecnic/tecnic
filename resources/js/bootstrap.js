// window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    // JQuerr Core JS
    //window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    // Bootstrap 3.3.6 or 3.4.1
    require('bootstrap');
    // Select plugin | fallback version if isu - v1.10.0
    // require('bootstrap-select');
    // Slimscroll plugin
    require('jquery-slimscroll');

    // multiselect
    require('./theme/jquery.multi-select.js');

    // wave effects
    require('node-waves');
    
    // Autosize Plugin Js
    require('autosize');
    // Moment Plugin Js
    window.moment = require('moment');
    // Bootstrap Material Datetime Picker Plugin Js
    require('./theme/bootstrap-material-datetimepicker.js');
    // Bootstrap Datepicker Plugin Js
    require('bootstrap-datepicker');

    // jquery - validation
    require('jquery-validation');

    //Datatables use datatables.net-bs@1.10.12 datatables.net-buttons-bs@1.2.2
    require('datatables.net-bs');
    require('datatables.net-buttons-bs');
    require('jszip');
    window.pdfMake = require('pdfmake/build/pdfmake.min');
    var vfs = require('pdfmake/build/vfs_fonts');
    window.pdfMake.vfs = vfs.pdfMake.vfs;
    require('datatables.net-buttons/js/buttons.colVis');
    require('datatables.net-buttons/js/buttons.flash');
    require('datatables.net-buttons/js/buttons.html5');
    require('datatables.net-buttons/js/buttons.print');

    // Admin theme style
    require('./theme/admin');
    // Demostyle
    require('./theme/demo');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
