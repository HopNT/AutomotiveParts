<?php
    $index = 0;
    $index_child = 0;
?>
<div id="catalog" class="top-tabs mb-20px">
    <!-- <h3 class="title mb-20px">About Partsouq</h3> -->
    <ul class="nav nav-tabs row">
        @foreach($listCatalogPartsParent as $key => $catalogPartsParent)
            <li class="col-sm-4"><a href="#tab{{$key + 1}}" data-toggle="tab" class="tab-class @if($index == 0)active show @endif ">{{$catalogPartsParent->name}}</a></li>
            <?php $index++; ?>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($listCatalogPartsParent as $key => $catalogPartsParent)
            <div class="tab-pane tab-class-child fade @if($index_child == 0) active show @endif" id="tab{{$key + 1}}">
                <div class="row">
                    @foreach($catalogPartsParent->child as $key => $c)
                        <div class="col-sm-6 col-md-3" id="group-item">
                            <a href="{{ route('list-accessory', ['catalog_parts_id' => $c->catalog_parts_id]) }}" class="catalog-icon" style="background: url('{{asset($c->icon)}}') no-repeat;">{{$c->name}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <?php $index_child++; ?>
        @endforeach
    </div>
</div>
