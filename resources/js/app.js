import './bootstrap';
import '@tabler/core';

$('form').on('submit', function (e) {
    const $form = $(this);
    const $button = $(e.originalEvent.submitter);
    const text = $button.data('loading-text');

    if ($button.attr('name')) {
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

    $('[data-loading-text]').prop('disabled', true);

    $button.html(items);
});
