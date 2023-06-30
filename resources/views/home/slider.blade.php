<section class="slider_section ">
    @if(!empty($bannerImg))
        <div class="slider_bg_box">
            <img
                src="{{asset('/images/'.$bannerImg->image)}}"
                alt=""
            >
        </div>
    @else
        <div class="slider_bg_box" style="background-color: #FDB494;">

        </div>
    @endif

    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-7 col-lg-6 ">
                            <div class="detail-box">
                                <h1>
                                    {{$banners[0]->title}}
                                </h1>
                                <p>
                                    {{$banners[0]->content}}
                                </p>
                                <div class="btn-box">
                                    <a href="" class="btn1">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($banners as $banner)
                @if($loop->first)
                    @continue
                @endif
                <div class="carousel-item ">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 ">
                                <div class="detail-box">
                                    <h1>
                                        {{$banner->title}}
                                    </h1>
                                    <p>
                                        {{$banner->content}}
                                    </p>
                                    <div class="btn-box">
                                        <a href="" class="btn1">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>


        <div class="container">
            <ol class="carousel-indicators">
                <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                <?php $bannerIndex = 1 ?>
                @foreach($banners as $banner)
                    @if($loop->first)
                        @continue
                    @endif
                    <li data-target="#customCarousel1" data-slide-to="{{$bannerIndex}}"></li>
                        <?php $bannerIndex++ ?>
                @endforeach
            </ol>
        </div>
    </div>
</section>
