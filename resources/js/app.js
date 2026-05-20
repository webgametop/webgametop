import './bootstrap';
import '@tabler/core';

$('form').on('submit', function () {
    const $button = $(this).find('button[data-loading-text]');
    const text = $button.data('loading-text');
    let items = [$('<span>', {'class': 'spinner-border spinner-border-sm', 'aria-hidden': true})];
    if (text) items.push($('<span>', {'class': 'ms-2', 'role': 'status', 'text': text}));
    $button.prop('disabled', true);
    $button.html(items);
});
