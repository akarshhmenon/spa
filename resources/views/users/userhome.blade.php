@extends('front-layouts.main')

@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" img src="{{ URL::asset('frontassets/img/carousel-1.jpg') }}"
                        style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown"
                                style="letter-spacing: 3px;">Spa & Beauty Center</h6>
                            <h3 class="display-3 text-capitalize text-white mb-3">Massage Treatment</h3>
                            <p class="mx-md-5 px-5">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet.
                                Sadips duo stet amet amet ndiam elitr ipsum labore diam</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp"
                                href="#">Make Appointment</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" img
                        src="{{ URL::asset('frontassets/img/carousel-2.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown"
                                style="letter-spacing: 3px;">Spa & Beauty Center</h6>
                            <h3 class="display-3 text-capitalize text-white mb-3">Facial Treatment</h3>
                            <p class="mx-md-5 px-5">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet.
                                Sadips duo stet amet amet ndiam elitr ipsum labore diam</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp"
                                href="#">Make Appointment</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" img
                        src="{{ URL::asset('frontassets/img/carousel-3.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown"
                                style="letter-spacing: 3px;">Spa & Beauty Center</h6>
                            <h3 class="display-3 text-capitalize text-white mb-3">Cellulite Treatment</h3>
                            <p class="mx-md-5 px-5">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet.
                                Sadips duo stet amet amet ndiam elitr ipsum labore diam</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp"
                                href="#">Make Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Service Start -->
    <div class="container-fluid px-0 py-5 my-5">
        <div class="row mx-0 justify-content-center text-center">
            <div class="col-lg-6">
                <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Our Service</h6>
                <h1 style="color:rgb(0, 0, 0);">Spa & Beauty Services</h1>
            </div>
        </div>
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button"
                            data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-12">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="{{ URL::asset('frontassets/img/service-1.jpg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Body Massage</h4>
                                                    <p class="card-text">Just like the morning, let yourself shine with
                                                        tender skin exfoliation.</p>
                                                    <div class="w-100 bg-white text-center p-4">
                                                        <a class="btn btn-primary" href="">Book Now</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="{{ URL::asset('frontassets/img/service-2.jpg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Stone Therapy</h4>
                                                    <p class="card-text">used to help you relax and ease tense muscles
                                                        and damaged soft tissues</p>
                                                    <div class="w-100 bg-white text-center p-4">
                                                        <a class="btn btn-primary" href="">Book Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="{{ URL::asset('frontassets/img/service-3.jpg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Facial Therapy</h4>
                                                    <p class="card-text">Rhythmical sequence of double facial cleanse,
                                                        exfoliation, skin stimulating.</p>
                                                    <div class="w-100 bg-white text-center p-4">
                                                        <a class="btn btn-primary" href="">Book Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="{{ URL::asset('frontassets/img/service-4.jpg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Skin Care</h4>
                                                    <p class="card-text">The deep cleansing and exfoliation keeps your
                                                        skin clear and smooth.</p>
                                                    <div class="w-100 bg-white text-center p-4">
                                                        <a class="btn btn-primary" href="">Book Now</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="{{ URL::asset('frontassets/img/service-5.jpg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Steam Bath</h4>
                                                    <p class="card-text">A steam bath is beneficial and therapeutic for
                                                        your body.</p>
                                                    <div class="w-100 bg-white text-center p-4">
                                                        <a class="btn btn-primary" href="">Book Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="{{ URL::asset('frontassets/img/service-6.jpg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Face Masking</h4>
                                                    <p class="card-text">Hydrate skin, remove excess oils & improve the
                                                        appearance of pores.</p>
                                                    <div class="w-100 bg-white text-center p-4">
                                                        <a class="btn btn-primary" href="">Book Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>






    </div>
    <!-- Service End -->
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
                    <div class="row">

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 shadow-sm p-3 mb-5 bg-white rounded"
                            data-aos="zoom-in" data-aos-delay="300">
                            <div class="icon-box"><a href={{ url('/singleproduct') }}>

                                    <img src="{{ URL::asset('frontassets/img/product-1.jpg') }}"
                                        style="object-fit: cover;">
                                    <h4><a href={{ url('/singleproduct') }}>TRESemme</a></h4>
                                    <p> Nourish Shampoo has been created to provide complete nourishment to your hair.</p>
                                    <h3><i class="fa fa-rupee"> ₹ 503.40</i></h3>
                                    <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
                            </div>

                        </div>
                </a>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 shadow-sm p-3 mb-5 bg-white rounded"
                    data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box"> <a href="/pro">
                            <img src="{{ URL::asset('frontassets/img/product-2.jpg') }}" style="object-fit: cover;">

                            <h4><a href="/pro">Olay Total Effects</a></h4>
                            <p>Olay Total Effects 7 In One Touch Of Foundation BB Cream Day SPF 15</p>
                            <h3><i class="fa fa-rupee"> ₹ 1100</i></h3>
                            <a class="btn btn-primary" href="/pro">View Details</a>
                    </div>
                </div></a>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 shadow-sm p-3 mb-5 bg-white rounded"
                    data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box"><a href="/washing">
                            <img src="{{ URL::asset('frontassets/img/product-3.jpg') }}" style="object-fit: cover;">
                            <h4><a href="/washing">Skeyndor</a></h4>
                            <p>Skeyndor Timeless Prodigy–For middle aged & mature skins, dry and very dry skin.</p>
                            <h3><i class="fa fa-rupee"> ₹ 11020</i></h3>
                            <a class="btn btn-primary" href="">View Details</a>
                    </div>
                </div></a>
            </div>
    </div>
    <div class="container" data-aos="fade-up">


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

    </div>

    </section>
    </div>
    <!-- product End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" img src="{{ URL::asset('frontassets/img/about.jpg') }}" alt="">
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">About Us</h6>
                    <h1 class="mb-4" style="color:rgb(0, 0, 0);">Your Best Spa, Beauty & Skin Care Center</h1>
                    <p class="pl-4 border-left border-primary">Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam
                        dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et
                        kasd erat duo eos et erat</p>
                    <div class="row pt-3">
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up">99</h3>
                                <h6 class="text-uppercase">Spa Specialist</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up">999</h3>
                                <h6 class="text-uppercase">Happy Clients</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Open Hours Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{URL::asset('frontassets/img/opening.jpg')}}" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="hours-text bg-light p-4 p-lg-5 my-lg-5">
                        <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Open Hours</h6>
                        <h1 class="mb-4" style="color:rgb(0, 0, 0);">Best Relax And Spa Zone</h1>
                        <p>Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et erat sed diam duo</p>
                        <ul class="list-inline">
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Mon – Fri : 9:00 AM - 7:00 PM</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Saturday : 9:00 AM - 6:00 PM</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Sunday : Closed</li>
                        </ul>
                        <a href="" class="btn btn-primary mt-2">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Open Hours End -->






@endsection
