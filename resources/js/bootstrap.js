import axios from 'axios';
import Timer from 'easytimer.js'
import $ from 'jquery';
import 'jquery.cookie';

window.axios = axios;
window.easytimer = Timer;
window.$ = window.jQuery = $;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
