@extends('front-layouts.main')

@section('content')


<!-- Product Details -->

<div class="product_details">
    <div class="container">
        <div class="row details_row">

            <!-- Product Image -->
            <div class="col-lg-6">
                <div class="details_image">
                    <div class="details_image_large"><img src="{{ URL::asset('frontassets/img/40158271_3-tresemme-hair-fall-defense-shampoo.jpg') }}" alt=""><div class="product_extra product_new"><a href="categories.html">New</a></div></div>
                    <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                        <div class="details_image_thumbnail active" data-image="{{ URL::asset('frontassets/img/40158271_3-tresemme-hair-fall-defense-shampoo.jpg') }}"><img src="{{ URL::asset('frontassets/img/40158271_3-tresemme-hair-fall-defense-shampoo.jpg') }}" alt=""></div>
                        <div class="details_image_thumbnail" data-image="{{ URL::asset('frontassets/img/tresemme1.jpg') }}"><img src="{{ URL::asset('frontassets/img/tresemme1.jpg') }}" alt=""></div>
                        <div class="details_image_thumbnail" data-image="{{ URL::asset('frontassets/img/tresemme4.jpg') }}"><img src="{{ URL::asset('frontassets/img/tresemme4.jpg') }}" alt=""></div>
                        <div class="details_image_thumbnail" data-image="{{ URL::asset('frontassets/img/tresemme3.jpg') }}"><img src="{{ URL::asset('frontassets/img/tresemme3.jpg') }}" alt=""></div>
                    </div>
                </div>
            </div>

            <!-- Product Content -->
            <div class="col-lg-6">
                <div class="details_content">
                    <div class="details_name">TRESemme</div>
                    <div class="details_discount">₹ 839</div>
                    <div class="details_price">₹ 503.40</div>

                    <!-- In Stock -->
                    <div class="in_stock_container">
                        <div class="availability">Availability:</div>
                        <span>In Stock</span>
                    </div>
                    <div class="details_text">
                        <p>sTRESemmé Hair Fall Defense Shampoo works best on damaged and breakage-prone hair. 
                            It helps reinforce hair strength and prevents hair fall due to breakage giving you longer and stronger hair. 
                            Enriched with Keratin protein, TRESemmé Hair Fall Defense Shampoo gives upto 97% less hair breakage after one wash. 
                            Its advance quality ingredients and scientifically constituted formula will leave you with longer, stronger and manageable hair. 
                            </p>
                    </div>

                    <!-- Product Quantity -->
                    <div class="product_quantity_container">
                        <div class="product_quantity clearfix">
                            <span>Qty</span>
                            <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                            <div class="quantity_buttons">
                                <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        <div class="button cart_button"><a href="#">Buy From Stores</a></div>
                    </div>

                    <!-- Share -->
                    <div class="details_share">
                        <span>Share:</span>
                        <ul>
                            <li><a href="pinterest.com"><i class="fa fa-pinterest"  aria-hidden="true"></i></a></li>
                            <li><a href="instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="http://www.fb.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row description_row">
            <div class="col">
                <div class="description_title_container">
                    <div class="description_title">Description</div>
                    <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div>
                </div>
                <div class="description_text">
                    <p>TRESemmé Hair Fall Defense Shampoo works best on damaged and breakage-prone hair. It helps reinforce hair strength and prevents hair fall due to breakage giving you longer and stronger hair.
                        Enriched with Keratin protein, TRESemmé Hair Fall Defense Shampoo gives upto 97% less hair breakage after one wash. Its advance quality ingredients and scientifically constituted formula will leave you with longer, stronger and manageable hair.
                        This range has been carefully selected for its advanced formula.
                        It is extremely beneficial for damaged hair prone to easy breakage.
                        The Keratin in this hair shampoo helps in strengthening your hair and provides hydration as well as elasticity to your hair.
                        TRESemmé Hair Fall Defense Shampoo is especially formulated for Indian hair and is suitable for use in conjunction with oil treatments.
                        Give your hair a luscious, confident bounce and salon quality smoothness without the salon price tag! Buy now to control hair breakage and prevent hair fall happening due to breakage.
                        For best results, use this shampoo along with the TRESemmé Hair Fall Defense Conditioner. Shampoo for men and women.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products -->

<div class="products">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="products_title">Related Products</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <figure class="card card-product">
                    <div class="img-wrap"> 
                        <img src="{{ URL::asset('frontassets/img/product-4.jpg') }}" style="object-fit: cover;">
                    </div>
                    <figcaption class="info-wrap">
                        <h6 class="title text-dots"><a href="#">SkinKraft</a></h6>
                        <div class="action-wrap">
                            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
                            <div class="price-wrap h5">
                                <span class="price-new">₹ 999</span>
                                <del class="price-old">₹ 1299</del>
                            </div> <!-- price-wrap.// -->
                        </div> <!-- action-wrap -->
                    </figcaption>
                </figure> <!-- card // -->
            </div> <!-- col // -->
            <div class="col-md-3">
                <figure class="card card-product">
                    <div class="img-wrap"> <img src="{{ URL::asset('frontassets/img/product-2.jpg') }}" style="object-fit: cover;">
                    </div>
                    <figcaption class="info-wrap">
                        <h6 class="title text-dots"><a href="#">Olay Total Effects</a></h6>
                        <div class="action-wrap">
                            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
                            <div class="price-wrap h5">
                                <span class="price-new">₹ 1100</span>
                                <del class="price-old">₹ 1400</del>
                            </div> <!-- price-wrap.// -->
                        </div> <!-- action-wrap -->
                    </figcaption>
                </figure> <!-- card // -->
            </div> <!-- col // -->
            <div class="col-md-3">
                <figure class="card card-product">
                    <div class="img-wrap"><img src="{{ URL::asset('frontassets/img/product-3.jpg') }}" style="object-fit: cover;">
                    </div>
                    <figcaption class="info-wrap">
                        <h6 class="title text-dots"><a href="#">Skeyndor</a></h6>
                        <div class="action-wrap">
                            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
                            <div class="price-wrap h5">
                                <span class="price-new">₹ 11020</span>
                                <del class="price-old">₹ 12000</del>
                            </div> <!-- price-wrap.// -->
                        </div> <!-- action-wrap -->
                    </figcaption>
                </figure> <!-- card // -->
            </div> <!-- col // -->
            <div class="col-md-3">
                <figure class="card card-product">
                    <div class="img-wrap"> <img src="{{ URL::asset('frontassets/img/product-6.jpg') }}" style="object-fit: cover;">
                    </div>
                    <figcaption class="info-wrap">
                        <h6 class="title text-dots"><a href="#">L'Oreal Paris 6 Oil</a></h6>
                        <div class="action-wrap">
                            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
                            <div class="price-wrap h5">
                                <span class="price-new">₹ 65</span>
                            </div> <!-- price-wrap.// -->
                        </div> <!-- action-wrap -->
                    </figcaption>
                </figure> <!-- card // -->
            </div> <!-- col // -->
            </div> 
    </div>
</div>


@endsection
