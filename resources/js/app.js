import './bootstrap';
import '@tabler/core';

$('form').on('submit', function (e) {

    const $form = $(this);
    const $button = $(e.originalEvent.submitter);

    if ($form.data('confirm') && !confirm($form.data('confirm'))) {
        e.preventDefault();
        return false;
    }

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
        $('<span>', { 'class': 'spinner-border spinner-border-sm', 'aria-hidden': true })
    ];

    if ($button.data('loading-text')) {
        items.push($('<span>', { 'class': 'ms-2', 'role': 'status', 'text': $button.data('loading-text') }));
    }

    $('[data-loading-text]').prop('disabled', true);

    $button.html(items);

});
