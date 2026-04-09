import './bootstrap';
import '@tabler/core';

$('form').on('submit', function () {
    const $button = $(this).find('button[data-loading-text]');
    const text = $button.data('loading-text');
    $button.prop('disabled', true);
    $button.html([
        $('<span>', {'class': 'spinner-border spinner-border-sm', 'aria-hidden': true}),
        $('<span>', {'class': 'ms-2', 'role': 'status', 'text': text}),
    ]);
});
