@extends('layouts.auth')
@section('title', 'Select Genre')
@section('content')
    <!--begin::Select Genre-->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url({{Vite::asset('resources/img/auth/progress-hd.png')}})">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="{{route('front.index')}}" class="mb-10">
                <img alt="Logo" src="{{Vite::asset('resources/img/dashboard/logo-dark.png')}}" class="h-[130px]"/>
            </a>
            <!--end::Logo-->
            <!--begin::Heading-->
            <div class="text-center mb-4">
                <!--begin::Title-->
                <h1 class="text-dark text-2xl fw-bold mb-3">Select your genre</h1>
                <!--end::Title-->
            </div>
            <!--end::Heading-->
            <div class="w-[30%] bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                <div class="alert alert-danger p-5 mb-10 error-box hidden">
                    <ul class="error-text pl-3 list-disc">

                    </ul>
                </div>
                <div class="genre-list w-full">
                    @foreach($genres as $genre)
                        <div data-val="{{$genre->name}}" class="single-genre"
                             title="{{$genre->excerpt}}">
                            <span class="inline-block text-gray-800 fw-bold fs-6 lh-1 pointer-events-none overflow-hidden overflow-ellipsis w-full text-center">{{ucwords($genre->name)}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="text-right mt-8">
                    <button id="genre-submit-btn" type="button" class="btn btn-primary" data-kt-indicator="off">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Select Genre-->
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            /** genre selection box begins*/
            let selectedGenre = [];
            $('.single-genre').on('click', function () {
                const selectedSlug = $(this).attr('data-val');
                $(this).toggleClass('active');
                if ($(this).hasClass('active')) {
                    selectedGenre.push(selectedSlug);
                } else {
                    selectedGenre = selectedGenre.filter((el) => el !== selectedSlug);
                }
                if (selectedGenre.length ==  '{{config('app.settings.app_max_genre_count')}}') {
                    $('.single-genre').not('.single-genre.active').addClass('disabled');
                } else {
                    $('.single-genre').removeClass('disabled');
                }
            });
            const submitButton = $('#genre-submit-btn');
            submitButton.on('click', function () {
                $.ajax({
                    url: '{{route('front.store-genre')}}',
                    method: "POST",
                    accept: "application/json",
                    data: {
                        "_token": CSRF_TOKEN,
                        "genres": selectedGenre,
                    },
                    beforeSend: () => {
                        submitButton.attr("data-kt-indicator", "on");
                    },
                    success: (resp) => {
                        submitButton.attr("data-kt-indicator", "off");
                        window.location.replace(resp.url);
                    },
                    error: (xhr) => {
                        const errorList = JSON.parse(xhr.responseText);
                        const errors = errorList.errors;
                        if (xhr.status === 422) {
                            $('.error-box .error-text').html('');
                            Object.keys(errors).forEach(function (el) {
                                $('.error-box .error-text').append(
                                    '<li class="mb-1 text-danger font-bolder">' + errors[el] + '</li>'
                                );
                            });
                            $('.error-box').show();
                            document.body.scrollTop = 0; // For Safari
                            document.documentElement.scrollTop = 0;
                        } else {
                            toastError("Something went wrong !!!");
                        }
                        submitButton.attr("data-kt-indicator", "off");
                    }
                });
            });
            /** genre selection ends*/
        });
    </script>
@endpush
