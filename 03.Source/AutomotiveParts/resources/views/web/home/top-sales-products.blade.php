
<div id="make-icons" class="shop-your-make mb-20px">
<!--    <h3 class="title">Genuine Parts Online Catalogs</h3>-->
    <div class="row">
        @foreach($listAccessaryPrioritize as $key => $accessaryPrioritize)
            <div class="col-md-3 col-sm-4 col-xs-6 mb-20px">
                <div class="item item-effect">
                    <!-- Item image -->
                    <a title="{{$accessaryPrioritize->name_vi}}" href="{{route('view-accessory-detail', ['accessary_id' => $accessaryPrioritize->accessary_id])}}">
                        <div class="shop-logo"><img src="{{asset($accessaryPrioritize->photo_top)}}" alt="BMW online catalog" class="img-responsive"></div>
                        <div class="shop-title-2">
                            <div class="sp-left">{{$accessaryPrioritize->code}}</div>
                            <div class="sp-right">{{ $accessaryPrioritize->price ? number_format($accessaryPrioritize->price).'vnd' : 'N/A'}}</div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="shop-title">
                                {{$accessaryPrioritize->name_vi}}
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <!--row-->
</div>
