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
                <img class="position-absolute w-100 h-100"  img src="{{URL::asset('frontassets/img/carousel-1.jpg')}}"style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Spa & Beauty Center</h6>
                        <h3 class="display-3 text-capitalize text-white mb-3">Massage Treatment</h3>
                        <p class="mx-md-5 px-5">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum labore diam</p>
                        <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Make Appointment</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item position-relative" style="min-height: 100vh;">
                <img class="position-absolute w-100 h-100" img src="{{URL::asset('frontassets/img/carousel-2.jpg')}}"style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Spa & Beauty Center</h6>
                        <h3 class="display-3 text-capitalize text-white mb-3">Facial Treatment</h3>
                        <p class="mx-md-5 px-5">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum labore diam</p>
                        <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Make Appointment</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item position-relative" style="min-height: 100vh;">
                <img class="position-absolute w-100 h-100" img src="{{URL::asset('frontassets/img/carousel-3.jpg')}}"style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Spa & Beauty Center</h6>
                        <h3 class="display-3 text-capitalize text-white mb-3">Cellulite Treatment</h3>
                        <p class="mx-md-5 px-5">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum labore diam</p>
                        <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Make Appointment</a>
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
            <h1>Spa & Beauty Services</h1>
        </div>
    </div>
    <div class="owl-carousel service-carousel">
        <div class="service-item position-relative">
            <img class="img-fluid" img src="{{URL::asset('frontassets/img/service-1.jpg')}}" alt="">
            <div class="service-text text-center">
                <h4 class="text-white font-weight-medium px-3">Body Massage</h4>
                <p class="text-white px-3 mb-3">Elitr labore sit dolor erat est lorem diam sea ipsum diam dolor duo sit ipsum</p>
                <div class="w-100 bg-white text-center p-4" >
                    <a class="btn btn-primary" href="">Make Order</a>
                </div>
            </div>
        </div>
        <div class="service-item position-relative">
            <img class="img-fluid" img src="{{URL::asset('frontassets/img/service-2.jpg')}}"  alt=">
            <div class="service-text text-center">
                <h4 class="text-white font-weight-medium px-3">Stone Therapy</h4>
                <p class="text-white px-3 mb-3">Elitr labore sit dolor erat est lorem diam sea ipsum diam dolor duo sit ipsum</p>
                <div class="w-100 bg-white text-center p-4" >
                    <a class="btn btn-primary" href="">Make Order</a>
                </div>
            </div>
        </div>
        <div class="service-item position-relative">
            <img class="img-fluid" img src="{{URL::asset('frontassets/img/service-3.jpg')}}" alt="">
            <div class="service-text text-center">
                <h4 class="text-white font-weight-medium px-3">Facial Therapy</h4>
                <p class="text-white px-3 mb-3">Elitr labore sit dolor erat est lorem diam sea ipsum diam dolor duo sit ipsum</p>
                <div class="w-100 bg-white text-center p-4" >
                    <a class="btn btn-primary" href="">Make Order</a>
                </div>
            </div>
        </div>
        <div class="service-item position-relative">
            <img class="img-fluid" img src="{{URL::asset('frontassets/img/service-4.jpg')}}" alt="">
            <div class="service-text text-center">
                <h4 class="text-white font-weight-medium px-3">Skin Care</h4>
                <p class="text-white px-3 mb-3">Elitr labore sit dolor erat est lorem diam sea ipsum diam dolor duo sit ipsum</p>
                <div class="w-100 bg-white text-center p-4" >
                    <a class="btn btn-primary" href="">Make Order</a>
                </div>
            </div>
        </div>
        <div class="service-item position-relative">
            <img class="img-fluid" img src="{{URL::asset('frontassets/img/service-5.jpg')}}" alt="">
            <div class="service-text text-center">
                <h4 class="text-white font-weight-medium px-3">Stream Bath</h4>
                <p class="text-white px-3 mb-3">Elitr labore sit dolor erat est lorem diam sea ipsum diam dolor duo sit ipsum</p>
                <div class="w-100 bg-white text-center p-4" >
                    <a class="btn btn-primary" href="">Make Order</a>
                </div>
            </div>
        </div>
        <div class="service-item position-relative">
            <img class="img-fluid" img src="{{URL::asset('frontassets/img/service-6.jpg')}}" alt="">
            <div class="service-text text-center">
                <h4 class="text-white font-weight-medium px-3">Face Masking</h4>
                <p class="text-white px-3 mb-3">Elitr labore sit dolor erat est lorem diam sea ipsum diam dolor duo sit ipsum</p>
                <div class="w-100 bg-white text-center p-4" >
                    <a class="btn btn-primary" href="">Make Order</a>
                </div>
            </div>
        </div>
    </div>
   
</div>
<!-- Service End -->

    
@endsection