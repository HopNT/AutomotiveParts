@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/lightgallery.css') }}" rel="stylesheet">
    <style>
    </style>
@endsection
@section('content')
    @include('web.element.search')
    @if(!$accessary->count())
        <h3 class="mb-5px text-center text-danger">Không tìm thấy kết quả!</h3>
    @else
        <div class="row pt-20">
            <div class="col-md-12">
                <div class="product-col list clearfix">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-xs-6">
                            <div class="image" id="lightgallery">
                                <a href="{{asset($accessary[0]->photo_top)}}" title="{{$accessary[0]->photo_top_name}}">
                                    <img src="{{asset($accessary[0]->photo_top)}}"
                                         alt="{{$accessary[0]->photo_top_name}}"
                                         class="thumbnail img-responxsive -ezoom-part img-box">
                                </a>
                                <a href="{{asset($accessary[0]->photo_bottom)}}"
                                   title="{{$accessary[0]->photo_bottom_name}}">
                                    <img src="{{asset($accessary[0]->photo_bottom)}}"
                                         alt="Suzuki 083161008B NUT"
                                         class="img-ui thumbnail img-responsive -ezoom-part img-box-child">
                                </a>
                                <a href="{{asset($accessary[0]->photo_right)}}"
                                   title="{{asset($accessary[0]->photo_right_name)}}">
                                    <img src="{{asset($accessary[0]->photo_right)}}"
                                         alt="{{asset($accessary[0]->photo_right_name)}}"
                                         class="img-ui thumbnail img-responsive -ezoom-part img-box-child">
                                </a>
                                <a href="{{asset($accessary[0]->photo_left)}}"
                                   title="{{asset($accessary[0]->photo_left_name)}}">
                                    <img src="{{asset($accessary[0]->photo_left)}}"
                                         alt="{{asset($accessary[0]->photo_left_name)}}"
                                         class="img-ui thumbnail img-responsive -ezoom-part img-box-child">
                                </a>
                                <a href="{{asset($accessary[0]->photo_inner)}}"
                                   title="{{asset($accessary[0]->photo_inner_name)}}">
                                    <img src="{{asset($accessary[0]->photo_inner)}}"
                                         alt="{{asset($accessary[0]->photo_inner_name)}}"
                                         class="img-ui thumbnail img-responsive -ezoom-part img-box-child">
                                </a>
                                <a href="{{asset($accessary[0]->photo_outer)}}"
                                   title="{{asset($accessary[0]->photo_outer_name)}}">
                                    <img src="{{asset($accessary[0]->photo_outer)}}"
                                         alt="{{asset($accessary[0]->photo_outer_name)}}"
                                         class="img-ui thumbnail img-responsive -ezoom-part img-box-child">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-xs-6">
                            <div style="padding-bottom: 0px" class="caption">
                                <h4 class="part-col-list-h4">{{ $accessary[0]->name_vi ? $accessary[0]->name_vi : 'N/A' }}</h4>
                                <h5>Mã sản phẩm: {{ $accessary[0]->code ? $accessary[0]->code : 'N/A' }}</h5>
                                {{--<p class="mb-10px">--}}
                                {{--Số lượng hiện có:--}}
                                {{--<span--}}
                                {{--class="label label-pill label-success">{{ $accessary[0]->quantity ? number_format($accessary[0]->quantity) : 'N/A' }}</span>--}}
                                {{--</p>--}}
                                <p class="mb-10px">
                                    Xuất xứ:
                                    <span
                                        class="label label-pill label-success">{{ $accessary[0]->nation_name ? $accessary[0]->nation_name : 'N/A' }}</span>
                                </p>
                                <p class="mb-10px">
                                    Thương hiệu:
                                    <a data-container="body"
                                       data-title="{{ $accessary[0]->trademark_name ? $accessary[0]->trademark_name : 'N/A' }}"
                                       data-toggle="popover" data-trigger="hover" data-placement="right"
                                       data-html="true"
                                       data-content="<h2>{{ $accessary[0]->trademark_name ? $accessary[0]->trademark_name : 'N/A' }}</h2><p>{{ $accessary[0]->trademark_desc ? $accessary[0]->trademark_desc : 'N/A' }}</p>"
                                       class="sr-name withajaxpopover popup-ajax" href="/en/Suzuki-33.html"
                                       data-original-title=""
                                       title="">{{ $accessary[0]->trademark_name ? $accessary[0]->trademark_name : 'N/A' }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="text-center col-lg-4 col-md-12 col-xs-12">
                            <div class="caption">
                                {{--<div class="hidden-xs make-logo">--}}
                                {{--<img class="make-logo-dim make-logo" src="{{asset('/images/suzuki.jpg')}}">                        </div>--}}
                                <div class="price">
                                    <div class="sr-price"><span class="price-new">{{ $accessary[0]->price !== null ? number_format($accessary[0]->price) : 'N/A' }}
                                            <span data-toggle="tooltip"
                                                  data-original-title="U.S. Dollar">VND</span></span>
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
                                        <button class="btn-small btn btn-success" id="yw2" type="submit" name="yt1"><i
                                                class="fa fa-shopping-cart cart-black"></i>
                                            <span class="text-uppercase dxs dxs3">Thêm giỏ hàng</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="product-details top-tabs">
                    <!-- <h3 class="title mb-20px">About Partsouq</h3> -->
                    <ul class="nav nav-tabs row detail-product" style="background-color: #fff">
                        <li class="col-sm-4"><a href="#tab1" data-toggle="tab" class="active show">CHI TIẾT SẢN PHẨM</a>
                        </li>
                        <li class="col-sm-4"><a href="#tab2" data-toggle="tab">THÔNG SỐ KĨ THUẬT</a></li>
                    </ul>
                    <div class="product-details tab-content">
                        <div class="tab-pane fade active show" id="tab1">
                            @if(count($accessary[0]->accessaryLinks) > 0)
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <h5>Phụ tùng thay thế</h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Phân loại</th>
                                                <th class="text-center">Mã sản phẩm</th>
                                                <th class="text-center">Tên sản phẩm</th>
                                                <th class="text-center">Xuất xứ</th>
                                                <th class="text-center">Đơn giá</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($accessary[0]->accessaryLinks as $key => $sub)
                                                <tr>
                                                    <td>
                                                        @if($sub->type !== null and $sub->type === 0) {{trans('label.accessary.oem')}}
                                                        @elseif($sub->type !== null and $sub->type === 1) {{trans('label.accessary.options')}}
                                                        @else{{trans('label.accessary.genuine')}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $sub->code ? $sub->code : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {{ $sub->name_vi ? $sub->name_vi : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {{ $sub->nation_name ? $sub->nation_name : 'N/A' }}
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $sub->price !== null ? number_format($sub->price).' VND' : 'N/A' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                            @if (count($listCarUse) > 0)
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <h5>Danh sách xe dùng chung</h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Xe sử dụng</th>
                                                <th class="text-center">Năm sản xuất</th>
                                                <th class="text-center">Xuất xứ</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($listCarUse as $key => $carUse)
                                                <tr>
                                                    <td>{{ $carUse->name }}</td>
                                                    <td>{{ $carUse->year ? $carUse->year : 'N/A' }}</td>
                                                    <td>{{ $carUse->name_vi ? $carUse->name_vi : 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        {!! $accessary[0]->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('javascript')
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{asset('/js/lightgallery.js')}}"></script>
    <script src="{{asset('/js/lg-pager.js')}}"></script>
    <script src="{{asset('/js/lg-autoplay.js')}}"></script>
    <script src="{{asset('/js/lg-fullscreen.js')}}"></script>
    <script src="{{asset('/js/lg-zoom.js')}}"></script>
    <script src="{{asset('/js/lg-hash.js')}}"></script>
    <script src="{{asset('/js/lg-share.js')}}"></script>

    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery'));
    </script>
@endsection
