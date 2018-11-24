
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
                        <div class="shop-title-2">
                            <div class="col-md-12 col-sm-12">{{$accessaryPrioritize->code}}</div>
                            <div class="col-md-12 col-sm-12 top-sale-price">{{ $accessaryPrioritize->price !== null  ? number_format($accessaryPrioritize->price).' vnd' : 'N/A'}}</div>
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
