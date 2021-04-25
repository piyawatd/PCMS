@extends('layouts.template')
@section('title')
    @lang('web.product')
@endsection
@section('meta')

@endsection
@section('stylesheet')
<style>
    .blog-listing-grid .page-title {
        background-image: none;
    }
    .page-title-style-background {
        height: 250px;
        margin-top: 50px;
    }
    .blog-listing-grid .wrapper-content {
        padding-top: 0 !important;
    }
</style>
<link href="{{asset('/public/css/pagination.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-container">
        <ul class="nav nav-pills tab-style-01 text-capitalize font-size-lg text-dark"
            role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-capitalize" id="all-tab" data-toggle="tab" href="#all" role="tab"
                   aria-controls="all" aria-selected="true" onclick="loadData('all')">@lang('web_product.all')</a>
            </li>
            @foreach ($categoryList as $item)
                <li class="nav-item">
                    <a class="nav-link text-capitalize" id="{{$item->alias}}-tab" data-toggle="tab" href="#{{$item->alias}}" role="tab"
                       aria-controls="{{$item->alias}}" aria-selected="false" onclick="loadData('{{$item->alias}}')"> {{$item->name}} </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all">
                <div class="row" id="content-all">

                </div>
                <div id="pagination-all" class="mt-9 pb-8">
                </div>
            </div>
            @foreach ($categoryList as $item)
                <div class="tab-pane fade" id="{{$item->alias}}" role="tabpanel"
                     aria-labelledby="{{$item->alias}}">
                    <div class="row" id="content-{{$item->alias}}">

                    </div>
                    <div id="pagination-{{$item->alias}}" class="mt-9 pb-8">
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/public/js/pagination.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            loadData('all')
        })

        function loadData(alias){
            var container = $('#pagination-'+alias);
            container.pagination({
                dataSource: '/categoryproduct/'+alias,
                locator: 'items',
                totalNumberLocator: function(response) {
                    return response.total;
                },
                pageSize: 20,
                ajax: {
                    beforeSend: function() {
                        var dataHtml = '<div class="col-lg-12 text-center"><div>Loading data ...</div></div>';
                        $('#content-'+alias).html(dataHtml)
                    }
                },
                callback: function(response, pagination) {
                    var dataHtml = '';
                    $.each(response, function (index, item) {
                        dataHtml += item;
                    });
                    $('#content-'+alias).html(dataHtml);
                }
            })
        }
    </script>
@endsection
