@extends('front-layouts.main')

@section('content')

    <section class="u-backlink u-clearfix u-grey-80" style="color: salmon">

    </section>

    <section class="u-align-center u-clearfix u-custom-color-2 u-valign-top-xs u-section-1" id="carousel_665d">
        <div class="u-container-style u-expanded-width u-group u-white u-group-1">
            <div class="u-container-layout u-valign-top u-container-layout-1">
                <h1 class="u-align-center u-text u-text-custom-color-1 u-text-default u-text-2">WHAT WE DO</h1>
                <p class="u-align-center u-text u-text-default u-text-2">The Spa Center prides itself in offering a full
                    range of gender-neutral salon treatments and styling services provided by a team of professional
                    stylists in an inclusive and eco-conscious environment.
                </p>
            </div>
        </div>

        <div class="u-list u-list-1">
            <div class="u-repeater u-repeater-1">


                @foreach ($services as $service)
                    
               
                <div class="u-container-style u-list-item u-repeater-item">
                    <div
                        class="u-container-layout u-similar-container u-valign-bottom-md u-valign-bottom-sm u-valign-top-lg u-valign-top-xl u-container-layout-2">
                        <img src="{{ URL::asset('uploads/' . $service['images'][0]->image_name) }}"
                            alt="" class="u-image u-image-default u-image-1" data-image-width="626" data-image-height="417">
                        <div class="u-align-left u-container-style u-group u-white u-group-2">
                            <div class="u-container-layout u-valign-middle u-container-layout-3">
                                <h4 class="u-custom-font u-font-oswald u-text u-text-palette-1-base u-text-3">{{$service->name}} </h4>
                                <h6 class="u-text u-text-4"><b style="">INR {{$service->mrp}}/</b> - 1 Hour
                                </h6>
                                <p class="u-text u-text-grey-50 u-text-5">{{$service->description}}.&nbsp;</p>
                                <a href="/booking"
                                    class="u-border-none u-btn u-btn-rectangle u-button-style u-custom-color-1 u-btn-1">book
                                    now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>




@endsection
