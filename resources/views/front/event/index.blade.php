@extends('layouts.front')
@section('content')
    <style>
        .club-thumbnail {
            object-fit: cover;
            object-position: center;
            width: 100%;
            min-height: 540px;
        }

        .hire-btn {
            height: 35px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 25px;
            font-size: 20px;
            color: #fff;
            padding: 0 30px;
            text-transform: uppercase;
            box-sizing: border-box;
            display: block;
            line-height: 30px;
            background: transparent;
            transition: .25s;
            cursor: pointer;
            font-family: "Changa", sans-serif;
        }

        .hire-btn:hover {
            background: #e43a90;
            color: #fff;
            border-color: #e43a90;
        }

        .hire-btn:focus {
            outline: none;
        }


        .gap-1 {
            gap: 10px;
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
        .edit-profile:hover{
            color: #fff;
        }
        .mt-50 {
            margin-top: 50px;
        }
    </style>
    <section id="artist-two" class="section-padding section-dark mt-50" data-parallax="image"
             data-bg-image="{{asset('assets/front/assets/img/artist_bg.jpeg')}}">
        <div class="container">
            <div class="section-title title-three text-center">
                <h2>Event Details</h2>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-full-width">
                    <div class="club-image"><?php
                                            $thumbnail = $event->thumbnail ? asset('storage/uploads/events/'.$event->thumbnail) : asset('assets/front/images/artist_placeholder.jpeg')
                                            ?>
                        <img class="club-thumbnail" src="{{$thumbnail}}" alt="club">
                    </div>
                    <!-- /.artist-image -->
                </div>
                <!-- /.col-lg-6 col-md-6 col-full-width -->

                <div class="col-lg-6 col-md-6 col-full-width">
                    <div class="artist-details-two">

                        <p class="artist-name">{{ucwords($event->title)}},</p>
                        <h4 class="band-name">{{ $event->excerpt }}</h4>
                        <div class="details">
                            <h3>About Event</h3>
                            {!! $event->description !!}
                            @if(auth()->user()->isOrganizer() && $event->club->user->id === auth()->user()->id)
                                <a target="_blank" href="{{route('events.edit', $event->id)}}" class="edit-profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-2 h-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <h4 class="band-name"><span>Organized By: </span> <a style="color: #e43a90;" href="{{route('front.club.detail', \Illuminate\Support\Facades\Crypt::encrypt($event->club_id))}}">{{ $event->club->name }}</a></h4>
                        <h4 class="band-name"><span>Fee: </span> $ {{ $event->fee }}</h4>
                        <h4 class="band-name"><span>Address: </span>{{ $event->club->address }}</h4>
                        <h4 class="band-name"><span>Event Date: </span>{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d M, Y') }}</h4>
                        <h4 class="band-name"><span>Event Time: </span>{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('H A') }}</h4>
                        @if($event->event_date > now() && auth()->user()->isArtist())
                            <?php
                                $isAlreadyApplied =  auth()->user()->invitations->where('id', $event->id)->first();
                                $data = $isAlreadyApplied ? \Illuminate\Support\Facades\DB::table('invitation_user')->where('user_id', auth()->user()->id)
                                     ->where('event_id', $event->id)->first() : null;
                                   $status = $data ? "Request ". ucwords($data->status) : "Apply";
                            ?>
                        <button type="button" class="hire-btn" {{$isAlreadyApplied ? 'disabled' : ''}}>
                            {{$status}}
                        </button>
                        @endif
                    </div>
                    <!-- /.artist-details -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.tim-container -->
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', 'button.hire-btn', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are going to apply for {{ucwords($event->title)}} event",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e43a90',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Apply!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let btnText = $(".hire-btn").text();
                        const that = $(".hire-btn");
                        $.ajax({
                            "url": "{{route('artist.event.apply', $event->id)}}",
                            "dataType": "json",
                            "type": "POST",
                            "headers": {"X-CSRF-TOKEN": "{{csrf_token()}}"},
                            beforeSend: function () {
                                that.text("Loading...");
                                that.attr('disabled', true);
                            },
                            success: function (resp) {
                                toastSuccess(resp.message);
                                that.text("Request Pending");
                            },
                            error: function (xhr) {
                                that.text(btnText.trim());
                                that.attr('disabled', false);
                                const message = xhr.responseJSON?.message !== "" ? xhr.responseJSON?.message : "Something went wrong!!!";
                                toastError(message);
                            }
                        })
                    }
                })

            });
        });
    </script>
@endpush
