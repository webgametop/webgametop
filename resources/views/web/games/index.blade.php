@props(['games'])

@section('title', 'Игры')

<x-layouts::main>
    <div class="container">
        <div class="page-content">
            <div class="most-popular m-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-section">
                            <h4><em>Игры</em> Яднекс.Игры</h4>
                        </div>
                        <div class="row">
                            @foreach($games as $game)
                            <div class="col-12">
                                <div class="item p-4">
{{--                                    <img src="/build/assets/images/popular-01.jpg" alt="">--}}
                                    <h4 class="m-0">
                                        {{ $game->title }}
                                        <span>{{ $game->developer->nickname }}</span>
                                    </h4>
                                    <ul class="m-0">
                                        <li><i class="fa fa-star"></i> 5.0</li>
                                        <li><i class="fa fa-download"></i> 2.3M</li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="main-button">
                            {{ $games->onEachSide(0)->links('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::main>
