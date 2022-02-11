@extends('front-layouts.main')

@section('content')


    <!-- Product Details -->

    <div class="product_details">
        <div class="container">



            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="details_image">

                        <div class="details_image_large"><img
                                src="{{ URL::asset('uploads/' . $product['images'][0]->image_name) }}" alt="">
                            <div class="product_extra product_new"><a href="categories.html">New</a></div>
                        </div>

                        @foreach ($product['images'] as $image)


                            <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                                <div class="details_image_thumbnail active"
                                    data-image="{{ URL::asset('uploads/' . $image->image_name) }}">
                                    <img src="{{ URL::asset('uploads/' . $image->image_name) }}" alt="">
                                </div>



                            </div>
                        @endforeach

                    </div>

                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name"> {{ $product->name }}</div>
                        <div class="details_discount">₹ {{ $product->mrp + 20 }}</div>
                        <div class="details_price">₹ {{ $product->mrp }}</div>

                        <!-- In Stock -->
                        <div class="in_stock_container">
                            {{-- <div class="availability">Availability:</div>
                        <span>In Stock</span> --}}
                        </div>
                        <div class="details_text">
                            <p>{{ $product->description }} </p>
                        </div>

                        <!-- Product Quantity -->
                        <div class="product_quantity_container">

                            <div class="button cart_button"><a href="#">Buy From Stores</a></div>
                        </div>

                        <!-- Share -->
                        {{-- <div class="details_share">
                        <span>Share:</span>
                        <ul>
                            <li><a href="pinterest.com"><i class="fa fa-pinterest"  aria-hidden="true"></i></a></li>
                            <li><a href="instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="http://www.fb.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        </ul>
                    </div> --}}
                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        <div class="description_title">Description</div>
                        {{-- <div class="reviews_title"><a href="#">Reviews <span></span></a></div> --}}
                    </div>
                    <div class="description_text">
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    {{-- <div class="products">
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
                            </div>->
                        </div> 
                    </figcaption>
                </figure> 
            </div>
       
         
      
            </div> 
    </div>
</div> --}}


@endsection
