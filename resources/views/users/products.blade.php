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



                <div class="row">

                    @foreach ($products as $product)


                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 shadow-sm p-3 mb-5 bg-white rounded"
                            data-aos="zoom-in" data-aos-delay="300">
                            <div class="icon-box"><a href={{ url('/singleproduct/'.$product->id) }}>

                                    <img src="{{ URL::asset('uploads/' . $product['images'][0]->image_name) }}"
                                        style="object-fit: cover;">
                                    <h4><a href={{ url('/singleproduct') }}>{{ $product->name }}</a></h4>
                                    <p>  {{ Str::limit($product->description, 40) }}.. </p>
                                    <h3><i class="fa fa-rupee"> ₹ {{ $product->mrp }} </i></h3>
                                    <a class="btn btn-primary" href={{ url('/singleproduct/'.$product->id) }}>View Details</a>
                            </div>

                        </div>

                    @endforeach


                </div>
            </div>

        </section>
    </div>


   
    <!-- product End -->

@endsection
