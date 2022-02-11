@extends('front-layouts.main')

@section('content')

    <!-- product Start -->
    
    <div class="container-fluid px-0 py-5 my-5">
        <div class="row mx-0 justify-content-center text-center">
            <div class="col-lg-6">
                <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Our Products</h6>
                <h1 style="color:rgb(0, 0, 0);">Check out our products</h1>
            </div>
        </div>
        <section id="services" class="services">

            

            <div class="container" data-aos="fade-up">


                <a href="/accessories">
                    @foreach ($products as $Product)
                    <div class="row">
                        @foreach ($products as $Product)

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 shadow-sm p-3 mb-5 bg-white rounded"
                            data-aos="zoom-in" data-aos-delay="300">
                            <div class="icon-box"><a href={{ url('/singleproduct') }}>

                                    <img src="{{ URL::asset('frontassets/img/product-1.jpg') }}"
                                        style="object-fit: cover;">
                                    <h4><a href={{ url('/singleproduct') }}>{{$Product->name}}</a></h4>
                                    <p> {{$Product->description}}</p>
                                    <h3><i class="fa fa-rupee"> ₹ {{$Product->mrp}}</i></h3>
                                    <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
                            </div>

                        </div>
                        @endforeach
                </a>

                
            </div>
            @endforeach
    </div>
    
    {{-- <div class="container" data-aos="fade-up">


        <a href="/accessories">
            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch shadow-sm p-3 mb-5 bg-white rounded"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <img src="{{ URL::asset('frontassets/img/product-4.jpg') }}" style="object-fit: cover;">

                        <h4><a href="/accessories"> SkinKraft</a></h4>
                        <p>SkinKraft Customized Skincare Regimen - Face Cleanser, Face Moisturizer & Active</p>
                        <h3><i class="fa fa-rupee"> ₹ 999</i></h3>
                        <a class="btn btn-primary" href="">View Details</a>
                    </div>
                </div>
        </a>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 shadow-sm p-3 mb-5 bg-white rounded"
            data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box"> <a href="/livemechanic">
                    <img src="{{ URL::asset('frontassets/img/product-5.jpg') }}" style="object-fit: cover;">

                    <h4><a href="/livemechanic">Wow Skin Science</a></h4>
                    <p>Onion Hair Oil Ultimate Hair Care Combo Kit (Shampoo + Hair Conditioner + Hair Oil)</p>
                    <h3><i class="fa fa-rupee"> ₹ 1099</i></h3>
                    <a class="btn btn-primary" href="">View Details</a>
            </div>
        </div></a>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 shadow-sm p-3 mb-5 bg-white rounded"
            data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box"><a href="/washing">
                    <img src="{{ URL::asset('frontassets/img/product-6.jpg') }}" style="object-fit: cover;">

                    <h4><a href="/washing">L'Oreal Paris 6 Oil</a></h4>
                    <p> Provide complete nourishment to your hair from root to tip with six micro oils</p>
                    <h3><i class="fa fa-rupee"> ₹ 65</i></h3>
                    <a class="btn btn-primary" href="">View Details</a>
            </div>
        </div></a>



    </div> 
 </div> --}}

    </section>
    </div>
    <!-- product End -->

@endsection
