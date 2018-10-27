@extends('layouts.app')

@section('content')
    @include('web.element.search')
    @include('web.home.catalog')
    @include('web.home.top-sales-products',['title'=>'PHỤ TÙNG BÁN CHẠY'])
    {{--<div class="top-tabs">--}}
        {{--<ul class="nav nav-tabs row">--}}
            {{--<li class="col-sm-3"><a href="#tt1" data-toggle="tab" class="active show">PHỤ TÙNG ĐỘNG CƠ</a></li>--}}
            {{--<li class="col-sm-3"><a href="#tt2" data-toggle="tab">PHỤ TÙNG GẮN MÁY</a></li>--}}
            {{--<li class="col-sm-3"><a href="#tt3" data-toggle="tab">PHỤ TÙNG THÂN VỎ</a></li>--}}
            {{--<li class="col-sm-3"><a href="#tt4" data-toggle="tab">ĐIỆN - ĐIỀU HÒA</a></li>--}}
            {{--<li class="col-sm-3"><a href="#tt5" data-toggle="tab">PHỤ KIỆN - ĐỒ CHƠI</a></li>--}}
        {{--</ul>--}}
        {{--<div class="tab-content">--}}
            {{--<div class="tab-pane fade active show" id="tt1">--}}
                {{--<p>First of all we take care of comfort for our customers. With PartSouq.com, purchasing OEM body parts, engine parts, etc. will be fluent and pleasant process. It will be no problem foryou to find and order, for example, OEM Subaru parts, Honda Civic OEM parts, Toyota UK parts or any other auto spare parts. If you need bearings, for instance, it will be easyfor you to find the necessary ones in our Toyota catalog or catalogs of other manufacturers. </p>--}}
                {{--<p>Why it is so easy to buy with PartSouq.com? Easy-to-use online catalogue will help you quickly find needed parts. Making order on our website is easy and intuitive. For your information wehave prepared FAQ section where you can find replies to the most popular questions. If necessary, our online consultants will personally help you. We are not limited by the stock of productskept on our warehouses as we have large chain of sub-suppliers who immediately supply ordered items available at their warehouses. Flexible logistics allows us to deliver goods to our buyerswithin shortest time. We also accept online payments so it will be easy for our clients not only to order but also to pay for the order staying at home and using only Internet. </p>--}}
                {{--<p>Range of genuine auto parts will not disappoint you as well. With PartSouq.com you will not have to order one spare part in one shop and another spare part in another shop. You willlikely find here all you need to purchase. </p>--}}
                {{--<p>Convenient online catalog will let you quickly find necessary parts. For example, if you are owner of Mitsubishi, genuine parts can be easily bought on our website. BuyingMitsubishi parts online is great solution in contemporary conditions. If you sort our catalogue by "Brand" category, you will see full list of available Mitsubishi car parts.For all Mitsubishi auto parts you will see title, description, price, availability and number of ship in days. It is very convenient when complete information about OEM Mitsubishiparts is gathered in one table. You will find not only Mitsubishi engine parts and body parts but also spare parts for electrical system, finishing, gearbox, etc. as well as widerange of accessories. When dealing with repair of a car, time is usually of great importance. Our online catalogue allows you to see how long you will have to wait for ordered Mitsubishiparts (OEM). Other Japanese car brands are also well represented on our website; therefore it will be no problem for you to order Subaru parts (OEM) or OEM civic parts by Honda Motor Co.</p>--}}
                {{--<p>If you are happy owner of Kia vehicle, PartSouq.com website will also be useful for you as Kia brand is widely represented in our online catalogue. Korean company Kia Motors is the 4thlargest automotive group of the world and its cars are successfully by automobilists on all continents. Great popularity of these cars explains increasing demand for Kia spare parts asin spite of high quality and durability of this brand, Kia auto parts are needed from time to time by many car owners. In our online catalogue you will find wide range of Kia car parts for affordable prices. </p>--}}
            {{--</div>--}}
            {{--<div class="tab-pane fade" id="tt2">--}}
                {{--<p>Each automobilist from time to time faces the necessity to repair his car, even in case of expensive cars and careful maintenance. He will need not only qualified service station but alsoreliable new auto parts stores able to supply quickly necessary spare parts of high quality. PartSouq.com can cope with this task on high professional level. On our website you willfind convenient online catalogue where it is easy to see spare part description, title, brand, price, availability of the products as well as shipment term. Our online catalogue allowssorting products by any of above-mentioned categories: for example, if you push "Brand" button you will see separately <a href="/en/catalog/toyota">Toyota catalog</a>, <a href="/en/catalog/lexus">Lexus catalog</a>,   Mazda catalog, Hyundai catalog, Nissan parts catalogue, Subaru catalog, Kia parts catalog, etc. If you sort by "Description" you will see spare parts catalogue in alphabetical order: from A to Z or on the contrary. If you sortby "Price" you will see spare parts catalogue from the cheapest price to the most expensive or on the contrary. And so on. This convenient system is very easy to use.</p>--}}
                {{--<p>Owners of various car brands will easily find on our website spare parts they need. For instance, if you are owner of Nissan car you know that this brand's cars are famous by relativeunpretentiousness from the point of view of maintenance. Therefore cars of this Japanese brand can be often seen on the streets of various cities all over the world. Car owners of variouscountries got assured by their own experience in reliability and high quality of these cars. However, severe conditions of operation, poor roads, road accidents and other factors can resultin necessity of Nissan car repair; and the owner will need to buy spare parts. Online purchase is the most quick and convenient method to buy auto spare parts. On PartSouq.com website youwill find extensive range of Nissan online parts. With the help of our online catalogue you will quickly see available parts for Nissan Pathfinder, Nissan Xtrail parts and partsfor other models. In the past it was possible to by genuine spare parts for Nissan in Japan only, but now manufacturers of other countries also produces genuine Nissan parts: UK, USA,etc. Searching for the competent Nissan parts dealer can be a problem as on the auto spare parts market counterfeit products are not rarity and there is often lack of needed productrange on service stations and in the qualified shops. In this situation PartSouq.com can become perfect OEM parts finder for you. </p>--}}
                {{--<p>If we speak about luxury vehicles, like Infinity by Nissan Motor Company or Lexus by Toyota Motor, the situation is even sharper. Extremely expensive cars cannot be seen on the streets veryoften, unlike medium-class vehicles. They are usually used in favorable road conditions and breakage of such cars is rarity. Infiniti OEM parts and OEM Lexus parts are not inmass demand, unlike Audi OEM parts or Mazda parts (OEM), for example. It is the reason why it is so difficult to find needed spare part in case of repair. In our onlinecatalogue you will find Infiniti parts (OEM), Lexus OEM parts as well as parts for other luxury vehicle brands in extensive range.</p>--}}
                {{--<p>Conveniently, easily, quickly and safe - these are the main advantages of making purchase with the help of online catalogue on PartSouq.com website. Online purchase will let you buy spareparts of high quality for your car manufactured in another part of the world without coming out of your home. </p>--}}
            {{--</div>--}}
            {{--<div class="tab-pane fade" id="tt3">--}}
                {{--<p>PartSouq.com provides wide range of genuine auto parts manufactured by over three hundred reliable and esteemed suppliers from various places of the world. Such an expanded network ofbusiness partners as well as large scopes of orders allows us to get discounts and special prices from the manufacturing plants and suppliers of spare parts. In its turn, this mode of workprovides us with a possibility to propose relatively cheap OEM parts to our customers. Competitive prices form one of the main factors making us leading and successful supplier of autoparts.  </p>--}}
                {{--<p>In our catalogue you can find, for example, rather cheap Toyota parts. There is no need to speak about reliability and high quality of Toyota cars and original Toyota parts forthem. Toyota brand is one of the best examples of Japan motor industry; its motor cars are able to compete with the first world leaders of motor industry. Actually, German automobile magazine"Auto Bild" awarded Toyota the name of the most reliable car in the whole world. Victory of Toyota in this rating is especially interesting due to the fact that this research referred not tonew cars just having come from the conveyor but to "aged" cars being in operation from 3 to 5 years. These cars are not exacting from the point of view of maintenance, however they can alsoneed post-damage repair requiring Toyota repair parts of high quality. Our company has well-arranged business connections with the most competent Toyota parts dealers able toprovide new Toyota parts for affordable prices. Therefore we are able to propose our customers competitive terms and conditions for purchase of Toyota parts: cheap and reliableat the same time. Our product range allows us to satisfy needs of the owners of various models of this brand: we can propose Toyota Yaris parts, Toyota Sequoia parts, Toyota Avensis parts,Toyota FJ parts, Toyota Avalon parts, Toyota Hilux parts, Toyota Highlander parts, Toyota Rav 4 parts, etc. for competitive prices. At the same time, without any compromise for thequality, we can provide you discount: Toyota parts of high quality for cheap price can be reality with our company. Toyota discount parts will be great opportunity for you torepair your car without huge expenses.</p>--}}
                {{--<p>We also provide cheap Nissan parts. Nissan motor cars, among which there is famous off-road vehicle Nissan X-Trail and popular models Nissan Tiida e Nissan Almera, established areputation of extremely reliable vehicles; however Nissan original parts remain needed for all seasons. It is not surprising as in spite of superb reliability, replacement of brokendown genuine Nissan parts is inevitable for repairs after road accidents or just repairs after certain numbers of years of operation. Nissan is one of the most demanded Japanese carsall over the world. These safe and reliable cars demonstrate enviable endurance of Nissan genuine parts but even the most wear-resistant parts can come out of action as a result oflong operation or road accident, therefore new Nissan parts from reliable manufacturers and for affordable prices are always in demand from the side of the automobilists all over theworld.</p>--}}
                {{--<p>Toyota and Nissan are just examples of car brands for which we can offer relatively cheap certified spare parts of high quality. Long-term collaboration with the biggest suppliers allows usto work with them on special conditions and with special prices and discounts. In our turn, we are happy to propose these special prices and discounts to our regular clients to guarantee forthem not only safe and reliable but also saving purchases.  </p>--}}
            {{--</div>--}}
            {{--<div class="tab-pane fade" id="tt4">--}}
                {{--<div class="row-fluid">--}}
                    {{--<p>One of our main competitive advantages is extensive range of new and used auto parts proposed for our clients. Mainly we focus on Japanese and Korean parts; however we also ableto supply the most demanded items for European automobile brands.</p>--}}
                    {{--<p>PartSouq.com offers wide range of spare parts for Japanese brand Nissan. Nissan Motor Co., Ltd. established in 1933 took the sixth place in the world motor industry in 2011. Customers chooseNissan cars due to their excellent technical characteristics, solid appearance, safe operation, and, of course, high reliability and durability. These properties allow users to bring repairto minimum. However, road accidents and minor breakdowns are sometimes inevitable, and users may need spare parts of high quality. Purchasing Nissan parts online on PartSouq.comwebsite will be efficient and affordable decision. In our Nissan parts catalog you will find Nissan Pathfinder parts, Nissan Patrol parts, Nissan Xterra parts, Nissan X Trail parts,Nissan Murano parts, Nissan Skyline parts, Nissan 350z parts, etc.</p>--}}
                    {{--<p>Mitsubishi parts catalog also contains extensive range of spare parts. Mitsubishi Group established in 1870 is one of the oldest Japanese motor car manufacturers. Surely, itshuge experience and rich Japanese manufacturing traditions result if the highest reliability of the cars. However even the most reliable car requires repair from time to time. And in thiscase users need spare parts from esteemed supplier able to guarantee high quality and competitive price. We can propose you Mitsubishi Pajero parts, Mitsubishi Galant parts, MitsubishiOutlander parts, etc.</p>--}}
                    {{--<p>Speaking about other Japanese brands supported by our company, we can propose Mazda OEM parts, Subaru OEM parts, Toyota original parts, etc.</p>--}}
                    {{--<p>Kia is one more brand widely supported by PartSouq.com. Invariably excellent quality of the cars of South Korean brand Kia now doesn't call any doubts even from the side of the mostinveterate skeptics and critics of Asian car brands. In spite of this fact, Kia performance parts sometimes need replacement. Our Kia catalog contains Kia Sportage parts, KiaSorento parts, Kia Rio parts, Kia Optima parts, Kia Forte parts as well as parts for other models of this South Korean brand. We offer both genuine and aftermarket Kia parts.Speaking about Korean cars, we can also offer Hyundai OEM parts. </p>--}}
                    {{--<p>As for the field of application, our range of spare parts covers all parts of a car:</p>--}}
                    {{--<ul>--}}
                        {{--<li> engine: fuel tank, instruments, underframe, gaskets, fuel pump, driving belts, filters, accumulators, hoses, etc.</li>--}}
                        {{--<li> gearbox: cardan shaft, housing, throw-over gear, etc.</li>--}}
                        {{--<li> chassis: brake gears, rear axle, brake booster, steering wheel, braking cylinder, steering column, etc.</li>--}}
                        {{--<li> body: removable panel, front side structure, chassis frame, rear panel, etc.</li>--}}
                        {{--<li> finishing: back glass, floor coating, safety belts, door sealant, front bumper, noise insulation, emblems, hood finishing, etc.</li>--}}
                        {{--<li> electrical systems: switch, electric wiring, screen washer, dash panel, headlamps, air ducts, radio, heater, etc.    </li>--}}
                    {{--</ul>--}}
                    {{--<p>Quality of all OEM replacement parts is confirmed by the certificates. Our product range is constantly renewed and OEM catalog is added by new items to be in conformity withtrends of contemporary world spare parts market. Our website always contains up-to-date information about available range of OEM car parts.</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="tab-pane fade" id="tt5">--}}
                {{--<p>Worldwide shipping is one more important competitive advantage of PartSouq.com. We supply new OEM parts to the customers from 160 countries of the world. In spite of expanded geographyof shipping we supply the products very quickly. Usually ordered products are shipped to the client the next day after placing the order. Duration of shipment depends on the distance betweenour supplier and our nearest warehouse. So, if you order several items you should refer to the longest "ship in time" in our online catalogue. </p>--}}
                {{--<p>We use only reliable methods of shipment and collaborate with esteemed and experiences courier companies (DHL, UPS, TNT, etc.). Our clients have possibility to choose available method ofshipment by themselves according to their country. We ship all our products by air; every parcel has separate tracking number. Such a system guarantees reliable and unmistaken productsdelivery to the customers.</p>--}}
                {{--<p>Our worldwide shipping allows us to satisfy needs of the owners of various car brands. However we focus on Japanese and Korean brands. One of the brands widely supported by PartSouq.com isToyota. We have really expanded geography of shipment of Toyota parts: Canada, USA, Australia, Europe, etc. Toyota is one of the most famous and recognizable car brands not only inJapan but all over the world. Furthermore, in 2012 Toyota Motors was the biggest auto manufacturer in the world having pressed even legendary General Motors. Like all Japanese cars, Toyotademonstrates excellent durability and reliability of its cars; however almost each owner sometimes faces the necessity to buy factory Toyota parts for repair as even happy owners ofhigh-end Japanese cars may need post-damage repair of their cars for which Toyota custom parts are needed. It can be caused by bad roads with pits and pothole, road accidents and otherfactors. As Toyota is rather popular car, demand for after market Toyota parts is constantly high. Absence of timely replacement of damaged Toyota parts can result in carbreakage in the most inappropriate moment as well as risks for driver and passengers.  On PartSouq.com Toyota parts store you will find wide range of Toyota engine parts, bodyparts, etc. We have rather large geography of suppliers of Toyota parts: UK, Japan and other European countries.It provides a possibility for our clients to buy needed Toyota dealerparts at any moment as it is usually very difficult to find Toyota parts for sale in your particular city and even service stations often don't have necessary parts. More oftenthey prepare a list of Toyota dealers parts based on Toyota parts diagram and a clients all over the world should independently solve a problem of search and purchase ofToyota parts: Australia, Unites Kingdom and other developed countries are not exclusions. </p>--}}
                {{--<p>We don't have any geographical limits: our customers live all over the world and our subsuppliers are also located in various countries on different continents. Such a global approach allowsus to satisfy needs of the buyers from various points of the world in OEM parts: Canada or Australia, USA or United Kingdom, etc.</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
