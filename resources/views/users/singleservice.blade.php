@extends('front-layouts.main')

@section('content')


<!-- Service Details -->

<div class="product_details">
    <div class="container">
        <div class="row details_row">

            <!-- Service Image -->
            <div class="col-lg-6">
                <div class="details_image">
                    <div class="details_image_large"><img src="{{ URL::asset('uploads/' . $service['images'][0]->image_name) }}" alt=""><div class="product_extra product_new"><a href="categories.html">New</a></div></div>
                    <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                        {{-- <div class="details_image_thumbnail active" data-image="{{ URL::asset('frontassets/img/40158271_3-tresemme-hair-fall-defense-shampoo.jpg') }}"><img src="{{ URL::asset('frontassets/img/40158271_3-tresemme-hair-fall-defense-shampoo.jpg') }}" alt=""></div>
                        <div class="details_image_thumbnail" data-image="{{ URL::asset('frontassets/img/tresemme1.jpg') }}"><img src="{{ URL::asset('frontassets/img/tresemme1.jpg') }}" alt=""></div>
                        <div class="details_image_thumbnail" data-image="{{ URL::asset('frontassets/img/tresemme4.jpg') }}"><img src="{{ URL::asset('frontassets/img/tresemme4.jpg') }}" alt=""></div>
                        <div class="details_image_thumbnail" data-image="{{ URL::asset('frontassets/img/tresemme3.jpg') }}"><img src="{{ URL::asset('frontassets/img/tresemme3.jpg') }}" alt=""></div> --}}
                    </div>
                </div>
            </div>

            <!-- Service Content -->
            <div class="col-lg-6">
                <div class="details_content">
                    <div class="details_name">{{$service->name}}</div>
                    
                    <div class="details_price">₹ {{$service->mrp}}</div>

                
                    <div class="details_text">
                        <p>{{$service->description}}</p>
                    </div>

                    <!-- Service Quantity -->
                    <div class="product_quantity_container">
                    
                        <div class="button cart_button"><a href="/booking">Book Now</a></div>
                    </div>

                    <!-- Share -->
           
                </div>
            </div>
        </div>

        <div class="row description_row">
            <div class="col">
                <div class="description_title_container">
                    <div class="description_title">Description</div>
                    
                </div>
                <div class="description_text">
                    <p>{{$service->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
