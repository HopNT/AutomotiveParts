@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/lightgallery.css') }}" rel="stylesheet">
    <style>
    </style>
@endsection
@section('content')
    @include('web.element.search')
    <div class="row pt-20">
        <div class="col-md-12">
            <div class="product-col list clearfix">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-xs-6">
                        <div class="image" id="lightgallery" >
                            <a href="{{asset('/images/083161008B.jpg')}}" title="Suzuki 083161008B NUT">
                                <img src="{{asset('/images/083161008B.jpg')}}" alt="Suzuki 083161008B NUT" class="thumbnail img-responsive -ezoom-part">
                            </a>
                            <ul class="img-ui list-unstyled list-inline">
                                <li>
                                    <a class="fancybox" data-fancybox-group="gallery" rel="example_group" href="{{asset('/images/083161008B.jpg')}}" title="Suzuki 083161008B NUT">
                                        <img width="65px" src="{{asset('/images/083161008B.jpg')}}" alt="Suzuki 083161008B NUT" class="thumbnail img-responsive -ezoom-part">
                                    </a>
                                </li>
                                <li>
                                    <a class="fancybox" data-fancybox-group="gallery" rel="example_group" href="{{asset('/images/083161008B.jpg')}}" title="Suzuki 083161008B NUT">
                                        <img width="65px" src="{{asset('/images/083161008B.jpg')}}" alt="Suzuki 083161008B NUT" class="thumbnail img-responsive -ezoom-part">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-xs-6">
                        <div style="padding-bottom: 0px" class="caption">
                            <h4 class="part-col-list-h4">NUT</h4>
                            <h5>Part number: 083161008B </h5>
                            <p class="mb-10px">
                                Availability:
                                <span class="label label-pill label-success">10</span>
                            </p>
                            <p class="mb-10px">Weight, kg: 0.06</p>
                            <p class="mb-10px">Ship In, Days: 1</p>
                            <p class="mb-10px">
                                Make: <a data-container="body" data-title="Suzuki" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img src=&quot;../images/suzuki.jpg&quot; alt=&quot;suzuki&quot; align=&quot;left&quot;>
											<h2>Suzuki Motor Co.</h2>
												  <p>
													Suzuki car brand dates back to the factory, which has been engaged in production of textile machinery. In 1937, the owners of the company decided to reorganize and ordered the developing of several prototype cars. Plans to produce cars were ruined due to outbreak of war, but in 1950s, Suzuki has decided to re-engage in the release of vehicles. Thus, in 1951, original motor-assisted bicycles came into the market, and Suzuki Motor Corporation was engaged in their production. 4 years later the first car of this brand rolled off the production line, called Suzulight.
												  </p>
												  <p>
													In 1985 the company opened an office in America, which focused on the production of sports models. Suzuki cars are well recognized among customers in different countries, but they have been especially successful on the U.S. car market.
												  </p>" class="sr-name withajaxpopover popup-ajax" href="/en/Suzuki-33.html" data-original-title="" title="">Suzuki</a>
                            </p>
                        </div>
                    </div>
                    <div class="text-center col-lg-4 col-md-12 col-xs-12">
                        <div class="caption">
                            <div class="hidden-xs make-logo">
                                <img class="make-logo-dim make-logo" src="{{asset('/images/suzuki.jpg')}}">                        </div>
                            <div class="price">
                                <div class="sr-price"><span class="price-new">0.81<span data-toggle="tooltip" data-original-title="U.S. Dollar">$</span></span></div>
                            </div>
                            <div class="cart-button button-group">
                                <form class="form-vertical cr-form brace-it" style="" action="#" method="post">
                                    <input type="hidden" value="" name="YII_CSRF_TOKEN"><input type="hidden" value="13125080" name="product_id" id="product_id">
                                    <input size="3" class="form-control" type="text" value="1" name="amount" id="amount">&nbsp;
                                    <button class="btn-small btn btn-success" id="yw2" type="submit" name="yt1"><i class="fa fa-shopping-cart cart-black"></i>
                                        <span class="text-uppercase dxs dxs3">Add to cart</span>
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
                    <li class="col-sm-4"><a href="#tab1" data-toggle="tab" class="active show">CHI TIẾT SẢN PHẨM</a></li>
                    <li class="col-sm-4"><a href="#tab2" data-toggle="tab">THÔNG SỐ KĨ THUẬT</a></li>
                </ul>
                <div class="product-details tab-content">
                    <div class="tab-pane fade active show" id="tab1">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <h5>Phụ tùng thay thế</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Phân loại</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Xuất xứ</th>
                                        <th>Đơn giá</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>OEM</td>
                                        <td>123456789</td>
                                        <td>NUT</td>
                                        <td>Japan</td>
                                        <td>1.000.000đ</td>
                                    </tr>
                                    <tr>
                                        <td>Thay thế ngoài</td>
                                        <td>987654321</td>
                                        <td>NUT</td>
                                        <td>China</td>
                                        <td>10.000.000đ</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <h5>Danh sách xe sử dụng</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Xe sử dụng</th>
                                        <th>Năm sản xuất</th>
                                        <th>Xuất xứ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ACCORD</td>
                                        <td>2011</td>
                                        <td>Japan</td>
                                    </tr>
                                    <tr>
                                        <td>Civic</td>
                                        <td>2012</td>
                                        <td>China</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <h5>Thông số kĩ thuật</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Phân loại</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Xuất xứ</th>
                                            <th>Đơn giá</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>OEM</td>
                                            <td>123456789</td>
                                            <td>NUT</td>
                                            <td>Japan</td>
                                            <td>1.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td>Thay thế ngoài</td>
                                            <td>987654321</td>
                                            <td>NUT</td>
                                            <td>China</td>
                                            <td>10.000.000đ</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{asset('/js/lightgallery.js')}}" ></script>
    <script src="{{asset('/js/lg-pager.js')}}" ></script>
    <script src="{{asset('/js/lg-autoplay.js')}}" ></script>
    <script src="{{asset('/js/lg-fullscreen.js')}}" ></script>
    <script src="{{asset('/js/lg-zoom.js')}}" ></script>
    <script src="{{asset('/js/lg-hash.js')}}" ></script>
    <script src="{{asset('/js/lg-share.js')}}" ></script>

    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery'));
    </script>
@endsection
