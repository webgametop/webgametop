import axios from 'axios';
import Timer from 'easytimer.js'
import Swiper from 'swiper/bundle';
import 'jquery.cookie';
import $ from 'jquery';

import 'swiper/css/bundle';

window.axios = axios;
window.easytimer = Timer;
window.swiper = Swiper;

window.$ = window.jQuery = $;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$.ajaxSetup({ 'headers': { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

window.viewsRecord = function () {
    $('[data-viewable]').each(function () {
        const $el = $(this);
        const viewable = $el.data('viewable');
        const delay = parseInt($el.data('delay'));
        const user = $('body').data('user');
        setTimeout(function () {
            $.post('/api/views', { viewable_type: viewable.type, viewable_id: viewable.id, user_id: user.id });
        }, delay);
    });
};
