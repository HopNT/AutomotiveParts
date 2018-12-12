@extends('layouts.app')
@section('content')
    @include('web.element.search')
    <div class="row pt-20">
        <div class="col-md-12">
            <h3 class="mb-5px">
                <?php
                    $text='';
                    if(isset($query->key_search)){
                        $text .= 'Key: ' . $query->key_search;
                    }
                    if(isset($query->car_name)){
                        $text .= ($text ? ', ' : '') . 'Tên xe: ' . $query->car_name;
                    }
                ?>
                Kết quả tìm kiếm cho: {{ $text}}
                {{--<img src="{{asset('/images/marks.png')}}">--}}
            </h3>
        </div>
        @if(!$accessary->count())
            <div class="col-md-12">
                <h3 class="mb-5px text-center text-danger">Không tìm thấy kết quả!</h3>
            </div>
        @else
            @foreach($accessary as $key => $item)
                <div class="col-md-12">
                    <div class="product-col list clearfix">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-xs-6">
                                <div class="image">
                                    <a alt="{{$item->photo_top_name}}" class="fancybox" href="{{route('view-accessory-detail', ['accessary_id' => $item->accessary_id])}}">
                                        @if($item->photo_top != null)
                                            <img data-zoom-image="{{ asset($item->photo_top) }}" style="width: 266px;"
                                                 src="{{ asset($item->photo_top) }}" alt="{{$item->photo_top_name}}"
                                                 class="thumbnail img-responsive -ezoom-part">
                                        @else
                                            <img data-zoom-image="../images/no_image.jpeg" style="width: 266px;"
                                                 src="../images/no_image.jpeg" class="thumbnail img-responsive -ezoom-part">
                                        @endif
                                    </a>
                                    <ul class="img-ui list-unstyled list-inline">
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-xs-6">
                                <div style="padding-bottom: 0px" class="caption">
                                    <h4 class="part-col-list-h4"><a style="text-decoration: none" href="{{route('view-accessory-detail', ['accessary_id' => $item->accessary_id])}}">{{ $item->name_vi ? $item->name_vi : 'N/A' }}</a></h4>
                                    <h5><a style="text-decoration: none" href="{{route('view-accessory-detail', ['accessary_id' => $item->accessary_id])}}">Mã sản phẩm: {{ $item->code ? $item->code : 'N/A' }}</a></h5>
                                    {{--<p class="mb-10px">--}}
                                        {{--Số lượng hiện có:--}}
                                        {{--<span--}}
                                            {{--class="label label-pill label-success">{{ $item->quantity ? number_format($item->quantity) : 'N/A' }}</span>--}}
                                    {{--</p>--}}
                                    <p class="mb-10px">
                                        Xuất xứ:
                                        <span
                                            class="label label-pill label-success">{{ $item->nation_name ? $item->nation_name : 'N/A' }}</span>
                                    </p>
                                    <p class="mb-10px">
                                        Thương hiệu:
                                        <a data-container="body"
                                           data-title="{{ $item->trademark_name ? $item->trademark_name : 'N/A' }}"
                                           data-toggle="popover" data-trigger="hover" data-placement="right"
                                           data-html="true"
                                           data-content="<h2>{{ $item->trademark_name ? $item->trademark_name : 'N/A' }}</h2><p>{{ $item->trademark_desc ? $item->trademark_desc : 'N/A' }}</p>"
                                           class="sr-name withajaxpopover popup-ajax" href="/en/Suzuki-33.html"
                                           data-original-title=""
                                           title="">{{ $item->trademark_name ? $item->trademark_name : 'N/A' }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="text-center col-lg-4 col-md-12 col-xs-12">
                                <div class="caption">
                                    {{--<div class="hidden-xs make-logo">--}}
                                    {{--<img class="make-logo-dim make-logo" src="../web/assets/suzuki.jpg">                        --}}
                                    {{--</div>--}}
                                    <div class="price">
                                        <div class="sr-price"><span class="price-new">{{ $item->price ? number_format($item->price) : 'N/A' }}
                                                <span data-toggle="tooltip" data-original-title="U.S. Dollar"> đ</span></span>
                                        </div>
                                    </div>
                                    <div class="cart-button button-group">
                                        <form class="form-vertical cr-form brace-it" style="" action="#" method="post">
                                            <input type="hidden" value="" name="YII_CSRF_TOKEN"><input type="hidden"
                                                                                                       value="13125080"
                                                                                                       name="product_id"
                                                                                                       id="product_id">
                                            <input size="3" class="form-control" type="text" value="1" name="amount"
                                                   id="amount">&nbsp;
                                            <button class="btn-small btn btn-success" id="yw2" type="submit" name="yt1">
                                                <i class="fa fa-shopping-cart cart-black"></i>
                                                <span class="text-uppercase dxs dxs3">Thêm giỏ hàng</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
