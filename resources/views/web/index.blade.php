@extends('layouts.template')
@section('title')
    @lang('web.home')
@endsection
@section('meta')

@endsection
@section('stylesheet')

@endsection
@section('content')
index
    <!-- #section 03 start -->
    <section id="section-03" class="pb-8 our-directory">
        <div class="container">
            <div class="mb-7">
                <h2 class="mb-0">
                    <span class="font-weight-light">@lang('web.product')</span>
                </h2>
            </div>
        </div>
        <div class="container container-1720">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all">
                    <div class="slick-slider arrow-top full-slide custom-nav equal-height"
                         data-slick-options='{"slidesToShow": 5,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 2000,"settings": {"slidesToShow": 4}},{"breakpoint": 1500,"settings": {"slidesToShow": 3}},{"breakpoint": 1000,"settings": {"slidesToShow": 2}},{"breakpoint": 770,"settings": {"slidesToShow": 1}}]}'>
                        @foreach ($products as $item)
                        <div class="box" data-animate="fadeInUp">
                            <div class="store card border-0 rounded-0">
                                <div class="position-relative store-image">
                                    <a href="{{ route('productdetail',['alias'=>$item->alias]) }}">
                                        @if ($item->thumbnail != '')
                                            <img src="{{$item->thumbnail}}" alt="{{ $item->title }}"
                                                 class="card-img-top rounded-0">
                                        @else
                                            <img src="/images/default-thumbnail.jpg" alt="{{ $item->title }}"
                                                 class="card-img-top rounded-0">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body px-0 pb-0 pt-3">
                                    <a href="{{ route('productdetail',['alias'=>$item->alias]) }}"
                                       class="card-title h5 text-dark d-inline-block mb-2"><span
                                            class="letter-spacing-25">{{ $item->title }}</span></a>
                                    <div class="media">
                                        <div class="media-body lh-14 font-size-sm">{{$item->intro}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /#section-03 end -->
    <!-- #section 05 start -->
    <section id="section-05" class="pt-11 pb-11">
        <div class="container">
            <div class="d-flex align-items-center mb-7 flex-wrap flex-sm-nowrap">
                <h2 class="mb-3 mb-sm-0">
                    <span class="font-weight-light">@lang('web.client')</span>
                </h2>
            </div>
            <div class="row">
                @foreach ($contents as $item)
                    <div class="col-md-4 mb-4" data-animate="zoomIn">
                        <div class="card border-0">
                            <a href="{{ route('clientdetail',['alias'=>$item->alias]) }}" class="hover-scale">
                                @if ($item->thumbnail != '')
                                    <img src="{{$item->thumbnail}}" alt="{{ $item->title }}"
                                         class="card-img-top rounded-0">
                                @else
                                    <img src="/images/default-thumbnail.jpg" alt="{{ $item->title }}"
                                         class="card-img-top rounded-0">
                                @endif
                            </a>
                            <div class="card-body px-0">
                                <h5 class="card-title lh-13 letter-spacing-25">
                                    <a href="{{ route('clientdetail',['alias'=>$item->alias]) }}"
                                       class="link-hover-dark-primary text-capitalize">
                                        {{ $item->title }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /#section-05 end -->
@endsection
@section('scripts')
    <script type="text/javascript">

    </script>
@endsection
