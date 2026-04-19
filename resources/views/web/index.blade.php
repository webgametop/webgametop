@section('title', 'Главная')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('home') }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Пользователи</div>
            <div class="text-secondary">В данном разделе представлены все пользователи сайта, отсортированные по дате последнего посещения.</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            <div><code>component::content</code></div>
        </div>
        <div id="discussion" class="bg-blue-lt mt-5">
            <div class="container">
                <div class="dis-wrap">
                    <div class="d_w-icon">
                        @php($d = [
                            asset('static/media/discussions/1.png'),
                            asset('static/media/discussions/2.png'),
                        ])
                        <img class="img-fluid" src="{{ $d[array_rand($d)] }}" alt="">
                    </div>
                    <div class="d_w-list">
                        <div class="d-flex flex-column">
                            <div class="nav nav-pills" id="v-pills-tab" role="tablist">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab">Новые комментарии</button>
                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">Популярные комментарии</button>
                            </div>
                            <div class="tab-content mt-3" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0"><code>component::comments::new</code></div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0"><code>component::comments::top</code></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div><code>component::content</code></div>
        </div>
    </div>
</x-layouts::main>
