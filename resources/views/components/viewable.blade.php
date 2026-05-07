@props(['entity', 'delay' => 3000])

<span
    data-viewable="{{ json_encode([
        'type' => $entity->getMorphClass(),
        'id' => $entity->getKey(),
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
