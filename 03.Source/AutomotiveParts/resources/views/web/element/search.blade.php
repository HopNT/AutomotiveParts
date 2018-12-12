<?php
    $key_search = request()->key_search;
    $car_name = request()->car_name;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="search-tabs">
            <!--Nav tabs-->
            <div class="intro-search-block mb-20px">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('search')}}" class="mb-10px clearfix">
                            <div class="white-container clearfix">
                                {{--<input name="q" id="parts-search-sm" type="text" onkeyup="javascript:addComma(this);" value="{{$q}}" spellcheck="false" autofocus="true" class="form-control input-search active" placeholder="Nhập mã phụ tùng">--}}
                                <input name="key_search" id="parts-search-sm" type="text" value="{{$key_search}}" spellcheck="false" autofocus="true" class="form-control input-search active" placeholder="Nhập mã phụ tùng">
                                <input name="car_name" id="parts-search-sm" type="text" value="{{$car_name}}" spellcheck="false" autofocus="true" class="form-control input-search active" placeholder="Nhập tên xe">
                            </div>
                            <button class="btn btn-success btn-sm" type="submit" style="font-size:16px">Tìm kiếm</button>
                        </form>
                        <div class="row mb-20px">
                            <div class="col-sm-8">
                                <div class="example-numbers">Ví dụ: <a class="example-number" href="javascript:void(0)">MB573783</a>, <a class="example-number" href="javascript:void(0)">MB242119</a>, <a class="example-number" href="javascript:void(0)">263304X000</a><span class="hidden-xs">, <a class="example-vin" href="javascript:void(0)">W0L0ZCF6841143485</a>, <a class="example-frame" href="javascript:void(0)">FD3-1200558</a></span></div>
                                <!--example-numbers-->
                            </div>
                            <!--col-sm - 6-->
                            <div class="col-sm-4">
                                <div class="text-right">
                                    <div class="informers"><img alt="Tìm số VIN" src="{{asset('/images/whereismyvin.png')}}" class="hidden"><a data-container="body" data-title="Tìm số VIN/FRAME ?" data-placement="bottom" data-content="<img alt='where is my vin' class='img-responsive' src='{{asset('/images/whereismyvin.png')}}' />" data-html="true" data-trigger="click" data-toggle="popover" style="cursor:pointer;" data-original-title="" title="">Tìm số VIN/FRAME ?                                </a></div>
                                </div>
                                <!--text-right-->
                            </div>
                            <!--col-sm-6-->
                        </div>
                        {{--<form action="{{route('search-car')}}" class="mb-10px clearfix">--}}
                            {{--<div class="row" style="padding-bottom:20px;">--}}
                                {{--<div class="col-md-5  mb-10px">--}}
                                    {{--<input type="text" value="{{$car_name}}" spellcheck="false" autofocus="true" class="form-control" name="car_name" placeholder="Nhập tên xe" style="border-radius:20px;border: 1px solid #ced4da !important;width:100%;">--}}
                                {{--</div>--}}
                                {{--<div class="col-md-5  mb-10px">--}}
                                    {{--<input type="text" value="{{$year}}" spellcheck="false" autofocus="true" class="form-control" name="year" placeholder="Nhập năm sản xuất" style="border-radius:20px;border: 1px solid #ced4da !important;width:100%;">--}}
                                {{--</div>--}}
                                {{--<div class="col-md-2 mb-10px">--}}
                                    {{--<button class="btn btn-success" type="submit" style="width: 100%; border-radius:30px;font-size:16px;height:38px;">Tìm kiếm</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                        <!--row-->
                    </div>
                    <!--col-sm-5-->
                </div>
                <!--row-->
            </div>
            <!--intro-search - block-->
        </div>
        <!--search-tabs-->
    </div>
    <!--col-sm-10-->
</div>
<script>
    function addComma(txt) {
        txt.value = txt.value.replace(/\s/g, ",");
    }
</script>
