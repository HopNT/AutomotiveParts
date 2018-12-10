<div id="make-icons" class="shop-your-make mb-20px">
    <div class="row row-title" style="display: {{isset($title) ? '' : 'none'}}">
        <h5>{{isset($title) ? $title : ''}}</h5>
    </div>
    <div class="row mt-3">
        @foreach($listAccessaryPrioritize as $key => $accessaryPrioritize)
            <div class="col-md-3 col-sm-12 col-xs-6 mb-20px">
                <div class="item item-effect">
                    <!-- Item image -->
                    <a target="_blank" title="{{$accessaryPrioritize->name_vi}}" href="{{route('view-accessory-detail', ['accessary_id' => $accessaryPrioritize->accessary_id])}}">
                        <div class="shop-logo"><img src="{{asset($accessaryPrioritize->photo_top)}}" alt="BMW online catalog" class="img-responsive"></div>
                        <div class="shop-title">
                            {{$accessaryPrioritize->name_vi}}
                        </div>
                        <div class="shop-title-2">
                            {{--<table>--}}
                                {{--<tr>--}}
                                    {{--<td><div class="text-left col-md-12 col-sm-6">Model</div></td>--}}
                                    {{--<td><div class="text-left col-md-12 col-sm-6">: {{$modelCar = \App\Http\Common\Entities\Car::find($accessaryPrioritize->car_id)->name}}</div></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td><div class="text-left col-md-12 col-sm-6">Mã</div></td>--}}
                                    {{--<td><div class="text-left col-md-12 col-sm-6">: {{$accessaryPrioritize->code}}</div></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td><div class="text-left text-danger col-md-12 col-sm-6">Giá</div></td>--}}
                                    {{--<td><div class="text-left text-danger col-md-12 col-sm-6">: {{ $accessaryPrioritize->price !== null  ? number_format($accessaryPrioritize->price).' VND' : 'N/A'}}</div></td>--}}
                                {{--</tr>--}}
                            {{--</table>--}}
                            <div class="col-md-12 col-sm-12">Model:
                                {{$modelCar = \App\Http\Common\Entities\Car::find($accessaryPrioritize->car_id)->name}}
                            </div>
                            <div class="col-md-12 col-sm-12">Mã: {{$accessaryPrioritize->code}}</div>
                            <div class="col-md-12 col-sm-12 top-sale-price">Giá: {{ $accessaryPrioritize->price !== null  ? number_format($accessaryPrioritize->price).' VND' : 'N/A'}}</div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <!--row-->
</div>
