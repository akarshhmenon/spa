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
                            <p class="mx-md-5 px-5">We provide a trained, certified medical professional (massage therapist)
                                manipulates the soft tissues of your body — muscle, connective tissue, tendons, ligaments and skin.</p>
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
                            <p class="mx-md-5 px-5">A facial is a beautifying skin treatment that cleanses pores, 
                                exfoliates dead skin cells, hydrates and moisturises the skin, and treats common skin concerns with a custom regime.</p>
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
                            <p class="mx-md-5 px-5">During one minimally invasive laser treatment called Cellulaze™, 
                                a tiny laser fiber is inserted beneath your skin./p>
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
   
    <section id="services">
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
                                                        <a class="btn btn-primary" href={{ url('/services') }}>View All</a>
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
                                                        <a class="btn btn-primary" href={{ url('/services') }}>View All</a>
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
                                                        <a class="btn btn-primary" href={{ url('/services') }}>View All</a>
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
                                                        <a class="btn btn-primary" href={{ url('/services') }}>View All</a>
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
                                                        <a class="btn btn-primary" href={{ url('/services') }}>View All</a>
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
                                                        <a class="btn btn-primary" href={{ url('/services') }}>View All</a>
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
        <section id="products">
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
                                            <p> Nourish Shampoo has been created to provide complete nourishment to your
                                                hair.</p>
                                            <h3><i class="fa fa-rupee"> ₹ 503.40</i></h3>
                                            <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
                                    </div>

                                </div>
                        </a>

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 shadow-sm p-3 mb-5 bg-white rounded"
                            data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon-box"> <a href={{ url('/singleproduct') }}>
                                    <img src="{{ URL::asset('frontassets/img/product-2.jpg') }}"
                                        style="object-fit: cover;">

                                    <h4><a href={{ url('/singleproduct') }}>Olay Total Effects</a></h4>
                                    <p>Olay Total Effects 7 In One Touch Of Foundation BB Cream Day SPF 15</p>
                                    <h3><i class="fa fa-rupee"> ₹ 1100</i></h3>
                                    <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
                            </div>
                        </div></a>

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 shadow-sm p-3 mb-5 bg-white rounded"
                            data-aos="zoom-in" data-aos-delay="300">
                            <div class="icon-box"><a href={{ url('/singleproduct') }}>
                                    <img src="{{ URL::asset('frontassets/img/product-3.jpg') }}"
                                        style="object-fit: cover;">
                                    <h4><a href={{ url('/singleproduct') }}>Skeyndor</a></h4>
                                    <p>Skeyndor Timeless Prodigy–For middle aged & mature skins, dry and very dry skin.</p>
                                    <h3><i class="fa fa-rupee"> ₹ 11020</i></h3>
                                    <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
                            </div>
                        </div></a>
                    </div>
            </div>
            

        <a href="/accessories">
            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch shadow-sm p-3 mb-5 bg-white rounded"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box"> <a href={{ url('/singleproduct') }}>
                        <img src="{{ URL::asset('frontassets/img/product-4.jpg') }}" style="object-fit: cover;">

                        <h4><a href={{ url('/singleproduct') }}> SkinKraft</a></h4>
                        <p>SkinKraft Customized Skincare Regimen - Face Cleanser, Face Moisturizer & Active</p>
                        <h3><i class="fa fa-rupee"> ₹ 999</i></h3>
                        <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
                    </div>
                </div>
        </a>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 shadow-sm p-3 mb-5 bg-white rounded"
            data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box"> <a href={{ url('/singleproduct') }}>
                    <img src="{{ URL::asset('frontassets/img/product-5.jpg') }}" style="object-fit: cover;">

                    <h4><a href={{ url('/singleproduct') }}>Wow Skin Science</a></h4>
                    <p>Onion Hair Oil Ultimate Hair Care Combo Kit (Shampoo + Hair Conditioner + Hair Oil)</p>
                    <h3><i class="fa fa-rupee"> ₹ 1099</i></h3>
                    <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
            </div>
        </div></a>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 shadow-sm p-3 mb-5 bg-white rounded"
            data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box"><a href={{ url('/singleproduct') }}>
                    <img src="{{ URL::asset('frontassets/img/product-6.jpg') }}" style="object-fit: cover;">

                    <h4><a href={{ url('/singleproduct') }}>L'Oreal Paris 6 Oil</a></h4>
                    <p> Provide complete nourishment to your hair from root to tip with six micro oils</p>
                    <h3><i class="fa fa-rupee"> ₹ 65</i></h3>
                    <a class="btn btn-primary" href={{ url('/singleproduct') }}>View Details</a>
            </div>

        </section>
        </div>
        <!-- product End -->

        <!-- About Start -->
        <section id="about">
            <div class="container-fluid py-5">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6 pb-5 pb-lg-0">
                            <img class="img-fluid w-100" img src="{{ URL::asset('frontassets/img/about.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-6">
                            <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">About Us</h6>
                            <h1 class="mb-4" style="color:rgb(0, 0, 0);">Your Best Spa, Beauty & Skin Care Center
                            </h1>
                            <p class="pl-4 border-left border-primary">At Spa Center, we have been on a mission to make selfcare a priority rather than a treat 
                                since 2021, when we first opened our doors at the quaint spa in the idyllic Himalayan hills of Manali.

                                We believe that in the hustle and bustle of urban life, a few moments of self care, woven into your daily regimen, 
                                have the potential to help you unwind and reconnect with yourself. Bring the Spa like serenity & tranquility in your daily lives.</p>
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
            </div>
        </section>

        <!-- Open Hours Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-6" style="min-height: 500px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100"
                                src="{{ URL::asset('frontassets/img/opening.jpg') }}" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-6 pt-5 pb-lg-5">
                        <div class="hours-text bg-light p-4 p-lg-5 my-lg-5">
                            <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Open Hours</h6>
                            <h1 class="mb-4" style="color:rgb(0, 0, 0);">Best Relax And Spa Zone</h1>
                            <p>We Provide our best services as much as we can to the people who love their healthy body.
                                And we are happy to serve you guys with full hearty pleasure. welcome to our Spa Center...  </p>
                            <ul class="list-inline">
                                <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Mon – Fri : 9:00
                                    AM - 7:00 PM</li>
                                <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Saturday : 9:00
                                    AM - 6:00 PM</li>
                                <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Sunday : Closed
                                </li>
                            </ul>
                            <a href="" class="btn btn-primary mt-2">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Open Hours End -->
        <!-- Contact Start -->
        <section id="contact">
            <div class="container-fluid py-5">
                <div class="row mx-0 justify-content-center text-center">
                    <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Contact Us</h6>

                </div>

                <div class="container py-5">

                    <div class="row">

                        <div class="col-lg-6" style="min-height: 500px;">
                            <div class="position-relative h-100">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62865.5581909634!2d76.31566121157238!3d10.008814168278752!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080d514abec6bf%3A0xbd582caa5844192!2sKochi%2C%20Kerala!5e0!3m2!1sen!2sin!4v1641577368100!5m2!1sen!2sin" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-6 pt-5 pb-lg-5">
                            <div class="contact-form bg-light p-4 p-lg-5 my-lg-5">
                                <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Contact</h6>
                                <h1 class="mb-4" style="color:rgb(0, 0, 0);">Contact For Any Query</h1>
                                <div id="success"></div>
                                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                                    <div class="form-row">
                                        <div class="col-sm-6 control-group">
                                            <input type="text" class="form-control border-0 p-4" id="name"
                                                placeholder="Your Name" required="required"
                                                data-validation-required-message="Please enter your name" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="col-sm-6 control-group">
                                            <input type="email" class="form-control border-0 p-4" id="email"
                                                placeholder="Your Email" required="required"
                                                data-validation-required-message="Please enter your email" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <input type="text" class="form-control border-0 p-4" id="subject"
                                            placeholder="Subject" required="required"
                                            data-validation-required-message="Please enter a subject" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <textarea class="form-control border-0 py-3 px-4" rows="3" id="message"
                                            placeholder="Message" required="required"
                                            data-validation-required-message="Please enter your message"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Send
                                            Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
        </section>


        </div>
        </div>
        </div>
        <!-- Contact End -->






    @endsection
