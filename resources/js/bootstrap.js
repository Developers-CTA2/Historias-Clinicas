
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import "bootstrap";
import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("~jquery");


    
    require("~bootstrap");
} catch (e) {}
