import './bootstrap';
import '@tabler/core';

$('form').on('submit', function () {
    const $form = $(this);
    const $button = $form.find('button[data-loading-text]');
    const text = $button.data('loading-text');

    if ($button.length && $button.attr('name')) {
        $form.find(`input[type="hidden"][name="${$button.attr('name')}"]`).remove();

        $('<input>').attr({
            type: 'hidden',
            name: $button.attr('name'),
            value: $button.attr('value'),
            autocomplete: 'off',
        }).appendTo($form);
    }

    let items = [
        $('<span>', {'class': 'spinner-border spinner-border-sm', 'aria-hidden': true})
    ];

    if (text) {
        items.push($('<span>', {'class': 'ms-2', 'role': 'status', 'text': text}));
    }

    $button.prop('disabled', true);
    $button.html(items);
});
