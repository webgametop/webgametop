@props(['viewable', 'delay' => 3000])

<span
    data-views-increment
    data-viewable-id="{{ $viewable->getKey() }}"
    data-viewable-type="{{ $viewable->getMorphClass() }}"
    data-delay="{{ $delay }}"
    hidden
></span>

@pushonce('body-script')
    <script type="module">$(function () { viewsIncrement() });</script>
@endpushonce
