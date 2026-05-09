@props(['viewable', 'delay' => 3000])

<span
    data-viewable="{{ json_encode([
        'type' => $viewable::class,
        'id' => $viewable->getKey(),
    ]) }}"
    data-delay="{{ $delay }}"
    hidden
></span>

@pushonce('body-script')
    <script type="module">
        $(function () {
            viewsRecord();
        });
    </script>
@endpushonce
