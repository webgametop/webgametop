@props(['user'])

@section('title', "Профиль $user->nickname")

<x-layouts::main>
    <div class="container">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-profile ">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{ gravatar($user->email, 2048) }}" alt="" class="bg-info rounded-5">
                                @auth
                                @if($user->equals(request()->user()))
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-light rounded-5 w-100">
                                        <i class="fas fa-sign-out-alt" style="font-size: 16px;"></i>
                                        Выход
                                    </button>
                                </form>
                                @endif
                                @endauth
                            </div>
                            <div class="col-lg-5 align-self-start">
                                <div class="main-info header-text">
                                    <span>Online</span>
                                    <h4>{{ $user->nickname }} <small class="text-muted">{{ '@' . $user->username }}</small></h4>
                                    <p>Any details such as age, occupation or city. Example: 23 y.o. designer from San Francisco</p>
                                    <div class="main-border-button">
                                        <a href="#">Start Live Stream</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 align-self-start">
                                <ul>
                                    <li>Games Downloaded <span>3</span></li>
                                    <li>Friends Online <span>16</span></li>
                                    <li>Live Streams <span>None</span></li>
                                    <li>Clips <span>29</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="clips">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="heading-section">
                                                <h4><em>Your Most Popular</em> Clips</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="/build/assets/images/clip-01.jpg" alt="" style="border-radius: 23px;">
                                                    <a href="//www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                                                </div>
                                                <div class="down-content">
                                                    <h4>First Clip</h4>
                                                    <span><i class="fa fa-eye"></i> 250</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="/build/assets/images/clip-02.jpg" alt="" style="border-radius: 23px;">
                                                    <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                                                </div>
                                                <div class="down-content">
                                                    <h4>Second Clip</h4>
                                                    <span><i class="fa fa-eye"></i> 183</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="/build/assets/images/clip-03.jpg" alt="" style="border-radius: 23px;">
                                                    <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                                                </div>
                                                <div class="down-content">
                                                    <h4>Third Clip</h4>
                                                    <span><i class="fa fa-eye"></i> 141</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="/build/assets/images/clip-04.jpg" alt="" style="border-radius: 23px;">
                                                    <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                                                </div>
                                                <div class="down-content">
                                                    <h4>Fourth Clip</h4>
                                                    <span><i class="fa fa-eye"></i> 91</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="main-button">
                                                <a href="#">Load More Clips</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ***** Banner End ***** -->
        </div>
    </div>
</x-layouts::main>
