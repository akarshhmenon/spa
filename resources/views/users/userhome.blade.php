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

 <!-- About Start -->
 <div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 pb-5 pb-lg-0">
                <img class="img-fluid w-100"  src="{{URL::asset('frontassets/img/about.jpg')}}" alt="">
            </div>
            <div class="col-lg-6">
                <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">About Us</h6>
                <h1 class="mb-4">Your Best Spa, Beauty & Skin Care Center</h1>
                <p class="pl-4 border-left border-primary">Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd erat duo eos et erat</p>
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
                        <h1 class="mb-4">Best Relax And Spa Zone</h1>
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