@extends('site.layout')

@section('content')
<!-- categoties-column -->
                    
                    <!-- top-search-content end -->					
                    <!-- col-list-wrap -->
                    <div class="col-list-wrap gray-bg ">
                        <div class="col-list-wrap_opt fl-wrap">
                            <div class="show-hidden-filter col-list-wrap_opt_btn color-bg">Show Filters</div>
                            <div class="show-hidden-map not-vis_lap col-list-wrap_opt_btn color-bg">Show Map</div>
                        </div>
                        <!-- list-main-wrap-header-->
                        <div class="list-main-wrap-header fl-wrap fixed-listing-header">
                            <div class="container">
                                <!-- list-main-wrap-title-->
                                <div class="list-main-wrap-title">
                                    <h2>Results For : <span>New York </span><strong>8</strong></h2>
                                </div>
                                <!-- list-main-wrap-title end-->
                                <!-- list-main-wrap-opt-->
                                <div class="list-main-wrap-opt">
                                    <!-- price-opt-->
                                    <div class="price-opt">
                                        <span class="price-opt-title">Sort   by:</span>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="Popularity" class="chosen-select no-search-select" >
                                                <option>Popularity</option>
                                                <option>Average rating</option>
                                                <option>Price: low to high</option>
                                                <option>Price: high to low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- price-opt end-->
                                    <!-- price-opt-->
                                    <div class="grid-opt">
                                        <ul class="no-list-style">
                                            <li class="grid-opt_act"><span class="two-col-grid act-grid-opt tolt" data-microtip-position="bottom" data-tooltip="Grid View"><i class="far fa-th"></i></span></li>
                                            <li class="grid-opt_act"><span class="one-col-grid tolt" data-microtip-position="bottom" data-tooltip="List View"><i class="far fa-list"></i></span></li>
                                        </ul>
                                    </div>
                                    <!-- price-opt end-->
                                </div>
                                <!-- list-main-wrap-opt end-->                    
                            </div>
                        </div>
                        <!-- list-main-wrap-header end-->					
                        <!-- listing-item-wrap-->
                        <div class="listing-item-container fl-wrap">
                            <!-- listing-item -->
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img fl-wrap">
                                        <a href="listing-single.html" class="geodir-category-img_item">
                                            <img src="images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="geodir-category-location">
                                            <a href="#1" class="map-item tolt" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i>  70 Bright St New York, USA</a>
                                        </div>
                                        <ul class="list-single-opt_header_cat">
                                            <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                            <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                        </ul>
                                        <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                        <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                        <div class="geodir-category-listing_media-list">
                                            <span><i class="fas fa-camera"></i> 8</span>
                                        </div>
                                    </div>
                                    <div class="geodir-category-content fl-wrap">
                                        <h3><a href="listing-single.html">Gorgeous house for sale</a></h3>
                                        <div class="geodir-category-content_price">$ 600,000</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                        <div class="geodir-category-content-details">
                                            <ul>
                                                <li><i class="fal fa-bed"></i><span>3</span></li>
                                                <li><i class="fal fa-bath"></i><span>2</span></li>
                                                <li><i class="fal fa-cube"></i><span>450 ft2</span></li>
                                            </ul>
                                        </div>
                                        <div class="geodir-category-footer fl-wrap">
                                            <a href="agent-single.html" class="gcf-company"><img src="images/avatar/1.jpg" alt=""><span>By Liza Rose</span></a>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- listing-item end-->	
                            <!-- listing-item -->
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img fl-wrap">
                                        <a href="listing-single.html" class="geodir-category-img_item">
                                            <img src="images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="geodir-category-location">
                                            <a href="#2" class="map-item tolt" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i>   40 Journal Square  , NJ, USA</a>
                                        </div>
                                        <ul class="list-single-opt_header_cat">
                                            <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                            <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                        </ul>
                                        <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                        <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                        <div class="geodir-category-listing_media-list">
                                            <span><i class="fas fa-camera"></i> 47</span>
                                        </div>
                                    </div>
                                    <div class="geodir-category-content fl-wrap">
                                        <h3><a href="listing-single.html">Luxury Family Home</a></h3>
                                        <div class="geodir-category-content_price">$ 320,000</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                        <div class="geodir-category-content-details">
                                            <ul>
                                                <li><i class="fal fa-bed"></i><span>4</span></li>
                                                <li><i class="fal fa-bath"></i><span>2</span></li>
                                                <li><i class="fal fa-cube"></i><span>460 ft2</span></li>
                                            </ul>
                                        </div>
                                        <div class="geodir-category-footer fl-wrap">
                                            <a href="agent-single.html" class="gcf-company"><img src="images/avatar/1.jpg" alt=""><span>By Anna Lips</span></a>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent" data-starrating2="5"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- listing-item end-->	
                            <!-- listing-item -->
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img fl-wrap">
                                        <a href="listing-single.html" class="geodir-category-img_item">
                                            <img src="images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="geodir-category-location">
                                            <a href="#3" class="map-item tolt" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> 34-42 Montgomery St , NY, USA</a>
                                        </div>
                                        <ul class="list-single-opt_header_cat">
                                            <li><a href="#" class="cat-opt blue-bg">Rent</a></li>
                                            <li><a href="#" class="cat-opt color-bg">House</a></li>
                                        </ul>
                                        <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                        <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                        <div class="geodir-category-listing_media-list">
                                            <span><i class="fas fa-camera"></i> 4</span>
                                        </div>
                                    </div>
                                    <div class="geodir-category-content fl-wrap">
                                        <h3><a href="listing-single.html">Family house for Rent</a></h3>
                                        <div class="geodir-category-content_price">$ 700 / per month</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                        <div class="geodir-category-content-details">
                                            <ul>
                                                <li><i class="fal fa-bed"></i><span>2</span></li>
                                                <li><i class="fal fa-bath"></i><span>1</span></li>
                                                <li><i class="fal fa-cube"></i><span>220 ft2</span></li>
                                            </ul>
                                        </div>
                                        <div class="geodir-category-footer fl-wrap">
                                            <a href="agent-single.html" class="gcf-company"><img src="images/avatar/1.jpg" alt=""><span>By Mark Frosty</span></a>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- listing-item end-->							
                            <!-- listing-item -->
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img fl-wrap">
                                        <a href="listing-single.html" class="geodir-category-img_item">
                                            <img src="images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="geodir-category-location">
                                            <a href="#4" class="map-item tolt" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i>  W 85th St, New York, USA </a>
                                        </div>
                                        <ul class="list-single-opt_header_cat">
                                            <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                            <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                        </ul>
                                        <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                        <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                        <div class="geodir-category-listing_media-list">
                                            <span><i class="fas fa-camera"></i> 13</span>
                                        </div>
                                    </div>
                                    <div class="geodir-category-content fl-wrap">
                                        <h3><a href="listing-single.html">Contemporary Apartment</a></h3>
                                        <div class="geodir-category-content_price">$ 1,600,000</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                        <div class="geodir-category-content-details">
                                            <ul>
                                                <li><i class="fal fa-bed"></i><span>4</span></li>
                                                <li><i class="fal fa-bath"></i><span>1</span></li>
                                                <li><i class="fal fa-cube"></i><span>550 ft2</span></li>
                                            </ul>
                                        </div>
                                        <div class="geodir-category-footer fl-wrap">
                                            <a href="agent-single.html" class="gcf-company"><img src="images/avatar/1.jpg" alt=""><span>By Bill Trust</span></a>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent
                                                " data-starrating2="5"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- listing-item end-->								
                            <!-- listing-item -->
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img fl-wrap">
                                        <a href="listing-single.html" class="geodir-category-img_item">
                                            <img src="images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="geodir-category-location">
                                            <a href="#5" class="map-item tolt" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> 75 Prince St, NY, USA</a>
                                        </div>
                                        <ul class="list-single-opt_header_cat">
                                            <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                            <li><a href="#" class="cat-opt color-bg">Villa</a></li>
                                        </ul>
                                        <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                        <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                        <div class="geodir-category-listing_media-list">
                                            <span><i class="fas fa-camera"></i> 12</span>
                                        </div>
                                    </div>
                                    <div class="geodir-category-content fl-wrap">
                                        <h3><a href="listing-single.html">Kayak Point House</a></h3>
                                        <div class="geodir-category-content_price">$ 500.000</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                        <div class="geodir-category-content-details">
                                            <ul>
                                                <li><i class="fal fa-bed"></i><span>5</span></li>
                                                <li><i class="fal fa-bath"></i><span>1</span></li>
                                                <li><i class="fal fa-cube"></i><span>510 ft2</span></li>
                                            </ul>
                                        </div>
                                        <div class="geodir-category-footer fl-wrap">
                                            <a href="agent-single.html" class="gcf-company"><img src="images/avatar/1.jpg" alt=""><span>By Andy Sposty</span></a>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Average" data-starrating2="3"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- listing-item end-->							
                            <!-- listing-item -->
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img fl-wrap">
                                        <a href="listing-single.html" class="geodir-category-img_item">
                                            <img src="images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="geodir-category-location">
                                            <a href="#6" class="map-item tolt" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> 70 Bright St, Jersey City, NJ USA</a>
                                        </div>
                                        <ul class="list-single-opt_header_cat">
                                            <li><a href="#" class="cat-opt blue-bg">Rent</a></li>
                                            <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                        </ul>
                                        <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                        <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                        <div class="geodir-category-listing_media-list">
                                            <span><i class="fas fa-camera"></i> 21</span>
                                        </div>
                                    </div>
                                    <div class="geodir-category-content fl-wrap">
                                        <h3><a href="listing-single.html">Urban House</a></h3>
                                        <div class="geodir-category-content_price">1500 / per month</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                        <div class="geodir-category-content-details">
                                            <ul>
                                                <li><i class="fal fa-bed"></i><span>5</span></li>
                                                <li><i class="fal fa-bath"></i><span>3</span></li>
                                                <li><i class="fal fa-cube"></i><span>1210 ft2</span></li>
                                            </ul>
                                        </div>
                                        <div class="geodir-category-footer fl-wrap">
                                            <a href="agent-single.html" class="gcf-company"><img src="images/avatar/1.jpg" alt=""><span>By Liza Kobart</span></a>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent
                                                " data-starrating2="5"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- listing-item end-->							
                        </div>
                        <!-- listing-item-wrap end-->
                        <!-- pagination-->
                        <div class="pagination">
                            <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                            <a href="#" >1</a>
                            <a href="#" class="current-page">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                        </div>
                        <!-- pagination end-->						
                        <div class="small-footer fl-wrap">
                            <div class="copyright"> © Homeradar 2020 .  All rights reserved.</div>
                            <a class="custom-to-top color-bg custom-scroll-link" href="#main"><i class="fas fa-caret-up"></i></a>
                        </div>
                    </div>
                    <!-- col-list-wrap end -->
                
                </div>
@endsection