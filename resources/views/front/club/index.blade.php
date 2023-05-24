@extends('layouts.front')
@section('content')
    <style>
        .club-thumbnail {
            object-fit: cover;
            object-position: center;
            width: 100%;
            min-height: 540px;
        }
        .swal2-title {
            font-size: 18px;
        }

        .swal2-html-container {
            font-size: 15px;
        }

        .swal2-styled.swal2-confirm,
        .swal2-styled.swal2-cancel {
            font-size: 13px;
        }

        .swal2-icon {
            height: 4em;
            width: 4em;
        }

        .swal2-popup {
            width: 27em;
        }
        .h-2{
            height: 20px;
        }
        .w-2{
            width: 20px;
        }
        .edit-profile{
            display: inline-block;
            position: relative;
            top: 2px;
            cursor: pointer;
            color: #e43a90;
            transition: all 0.3s;
        }
        .edit-profile {
            display: inline-block;
            position: relative;
            top: 2px;
            cursor: pointer;
            color: #e43a90;
            transition: all 0.3s;
        }

        .edit-profile:hover {
            color: #fff;
        }
        .full-h-w {
            height: 100%;
        }

        .max-h-full {
            max-height: 100vh;
            overflow: hidden;
        }

        .object-cover {
            object-position: center;
            object-fit: cover;
        }

        .relative {
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 10;
            background: rgba(0, 0, 0, 0.2);
        }

        .mt-50 {
            margin-top: 50px;
        }

        .video-controls {
            position: absolute;
            bottom: 50px;
            right: 50px;
            z-index: 20;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sound-btn {
            cursor: pointer;
            color: #fff;
            position: relative;
            top: 5px;
        }

        .sound-btn svg {
            height: 20px;
        }

        .play-pause-div {
            border-radius: 100%;
            border: 2px solid #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            padding: 8px;
            cursor: pointer;
        }

        .hidden{
            display: none;
        }

        .play-pause-btn {
            height: 24px;
            width: 24px;
        }
        #artistVideo{
            width: 100%;
        }
    </style>
    @if($club->user->intro_video)
        <section id="banner-one" class="max-h-full relative header-video">
            <div class="overlay"></div>
            <video class="full-h-w object-cover" autoplay muted loop id="artistVideo">
                <source src="{{asset('storage/uploads/'.$club->user->intro_video)}}"
                        type="video/mp4">
            </video>
            <div class="video-controls">
                <div class="sound-btn">
                    <svg class="svg-inline fa fa-volume-xmark volume-mute" aria-hidden="true" focusable="false" data-prefix="fas"
                         data-icon="volume-xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                         data-fa-i2svg="">
                        <path fill="currentColor"
                              d="M301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3zM425 167l55 55 55-55c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-55 55 55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-55-55-55 55c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l55-55-55-55c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0z"></path>
                    </svg>
                    <svg class="svg-inline--fa fa-volume-high volume-full hidden" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="volume-high" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M533.6 32.5C598.5 85.3 640 165.8 640 256s-41.5 170.8-106.4 223.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C557.5 398.2 592 331.2 592 256s-34.5-142.2-88.7-186.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zM473.1 107c43.2 35.2 70.9 88.9 70.9 149s-27.7 113.8-70.9 149c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C475.3 341.3 496 301.1 496 256s-20.7-85.3-53.2-111.8c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zm-60.5 74.5C434.1 199.1 448 225.9 448 256s-13.9 56.9-35.4 74.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C393.1 284.4 400 271 400 256s-6.9-28.4-17.7-37.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zM301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3z"></path></svg>
                </div>
                <div class="play-pause-div">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="play-pause-btn hidden play">
                        <path fill-rule="evenodd"
                              d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                         stroke="currentColor" class="play-pause-btn pause">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5"></path>
                    </svg>
                </div>
            </div>
        </section>
    @endif
    <section id="artist-two" class="section-padding section-dark  {{!$club->user->intro_video ? 'mt-50' : ""}}" data-parallax="image"
             data-bg-image="{{asset('assets/front/assets/img/artist_bg.jpeg')}}">
        <div class="container">
            <div class="section-title title-three text-center">
                <h2>Club Details</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-full-width">
                  <div class="club-image"><?php
                              $thumbnail = $club->user->thumbnail ? asset('storage/uploads/'.$club->user->thumbnail) : asset('assets/front/images/artist_placeholder.jpeg')
                       ?>
                        <img class="club-thumbnail" src="{{$thumbnail}}" alt="club">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-full-width">
                    <div class="artist-details-two">
                        <div class="d-flex align-items-center">
                            <h3 class="artist-name">{{ucwords($club->name)}},</h3>
                            <div class="star-box">
                                <div class="stars d-flex">
                                    <div class="single-star-box" data-value="1">
                                        <i class="fa {{$rating >= 1 ? "fa-star" : "fa-star-o" }} star"></i>
                                    </div>
                                    <div class="single-star-box" data-value="2">
                                        <i class="fa {{$rating >= 2 ? "fa-star" : "fa-star-o" }} star"></i>
                                    </div>
                                    <div class="single-star-box" data-value="3">
                                        <i class="fa {{$rating >= 3 ? "fa-star" : "fa-star-o" }} star"></i>
                                    </div>
                                    <div class="single-star-box" data-value="4">
                                        <i class="fa {{$rating >= 4 ? "fa-star" : "fa-star-o" }} star"></i>
                                    </div>
                                    <div class="single-star-box" data-value="5">
                                        <i class="fa {{$rating >= 5 ? "fa-star" : "fa-star-o" }} star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-5 artist-address text-white">{{ucwords($club->address)}}</h5>
                        <div class="details" style="margin-bottom: 40px">
                            <h3>About Club</h3>
                                <span style="color: #fff">{!! $club->description !!}</span>
                                @if(auth()->user()->id === $club->user->id)
                                    <span type="button" class="edit-profile" data-toggle="modal"
                                          data-target="#edit-profile">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-2 h-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                        </svg>
                                    </span>
                                @endif
                        </div>
                        <h4 class="band-name"><span>Club Owner:</span> {{$club->user->first_name}} {{$club->user->last_name}}</h4>
                        <h4 class="band-name"><span>Established Date:</span> {{\App\Helpers\AppHelper::formatDate($club->established_date, 'd M, Y')}}</h4>
                        <h4 class="band-name"><span>Email:</span> {{$club->user->email}}</h4>
                        <h4 class="band-name"><span>Phone:</span> {{$club->user->phone}}</h4>

                    </div>
                    <!-- /.artist-details -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.tim-container -->
    </section>

    @if(!$clubEvents->isEmpty())
        @include('front.home._segments.recommended_events', ['recommended_events' => $clubEvents, 'title' => "Our Upcoming Events"])
    @endif

    @if(auth()->user()->id === $club->user->id)
        @include('front.club._segments._edit_profile', ['club' => $club])
    @endif
@endsection
@push('scripts')
    <script>
        $(document).ready(function (e) {
            $(document).on('click', '.play-pause-btn', function (e) {
                e.preventDefault();
                let videoEl = $(this).closest('.header-video').find('video').get(0);
                videoEl.paused ? (videoEl.play(), $(".play-pause-btn.play").hide(), $(".play-pause-btn.pause").show())
                        : (videoEl.pause(), $(".play-pause-btn.play").show(), $(".play-pause-btn.pause").hide());
            });

            $(document).on('click', '.sound-btn', function (e) {
                e.preventDefault();
                let videoEl = $(this).closest('.header-video').find('video').get(0);
                videoEl.muted ? ($(videoEl).prop('muted', false), $(".volume-full").show(), $('.volume-mute').hide())
                        : ($(videoEl).prop('muted', true),  $(".volume-full").hide(), $('.volume-mute').show());
            })
        });
    </script>
    @if(auth()->user()->id !== $club->user->id )
        <script>
            $(document).on({
                mouseover: function(event) {
                    $(this).find('.star').addClass('star-over');
                    $(this).prevAll().find('.star').addClass('star-over');
                },
                mouseleave: function(event) {
                    $(this).find('.star').removeClass('star-over');
                    $(this).prevAll().find('.star').removeClass('star-over');
                }
            }, '.single-star-box');

            $('.single-star-box').on('click', function() {
                $(this).nextAll().find('.star').removeClass('fa-star').addClass('fa-star-o');
                $(this).find('.star').removeClass('fa-star-o star-over').addClass('fa-star')
                $(this).prevAll().find('.star').removeClass('fa-star-o star-over').addClass('fa fa-star');
                $.ajax({
                    url: '{{route('front.user.rate')}}',
                    type: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": "{{csrf_token()}}"
                    },
                    data: {
                        "user_id": "{{\Illuminate\Support\Facades\Crypt::encrypt($club->user->id)}}",
                        "rating": $(this).attr('data-value'),
                    },
                    error: function (){
                        toastr.error("Something went wrong!!!");
                    },
                    success: function (){
                        toastr.success("Club rated successfully");
                    }
                })
            });
        </script>
    @endif
@endpush
