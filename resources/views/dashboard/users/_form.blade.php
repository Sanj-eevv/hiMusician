@csrf
<!--begin::Input group-->
<div class="row g-9 mb-8">
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2" for="first_name">
            First Name
        </label>
        <input type="text" name="first_name"
               class="form-control form-control-solid @error('first_name') is-invalid @enderror"
               value="{{ old('first_name', $user->first_name) }}"/>
        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2" for="last_name">Last Name</label>
        <input type="text" name="last_name"
               class="form-control form-control-solid @error('last_name') is-invalid @enderror"
               value="{{ old('last_name', $user->last_name) }}"/>
        @error('last_name')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <!--end::Col-->
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="row g-9 mb-8">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2" for="email">Email</label>
        <input type="text" name="email" class="form-control form-control-solid @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email) }}"/>
        @error('email')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2" for="email">User Name</label>
        <input type="text" name="user_name"
               class="form-control form-control-solid @error('user_name') is-invalid @enderror"
               value="{{ old('user_name', $user->email) }}"/>
        @error('user_name')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!--end::Input group-->

{{--$show varialbe is true for "POST" request i.e, create request --}}
@if($show)
    <!--begin::Input group-->
    <div class="row g-9 mb-8">
        <div class="col-md-6 fv-row">
            <label class="required fs-6 fw-bold mb-2" for="password">Password</label>
            <input type="password" name="password"
                   class="form-control form-control-solid @error('password') is-invalid @enderror"
                   value="{{ old('password') }}"/>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 fv-row">
            <label class="required fs-6 fw-bold mb-2" for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="form-control form-control-solid @error('password_confirmation') is-invalid @enderror"
                   value="{{ old('password_confirmation') }}"/>
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
@endif

<!--begin::Input group-->
<div class="row g-9 mb-8">
    <div class="col-md-6 fv-row">
        <label class="fs-6 fw-bold mb-2" for="role_id">
            <span>Gender</span>
            <i class="fas fa-exclamation-circle fs-7" data-bs-toggle="tooltip"
               title="Select your gender"></i></label>
        <select class="form-control form-control-solid @error('gender') is-invalid @enderror"
                name="gender">
            <option value="">{{ __('-- Select Gender --') }}</option>
            <option value="male" {{ old('gender', $user->gender) === "male" ? 'selected': '' }}>Male</option>
            <option value="female" {{ old('gender', $user->gender) === "female" ? 'selected': '' }}>Female</option>
            <option value="others" {{ old('gender', $user->gender) === "others" ? 'selected': '' }}>Others</option>
        </select>
        @error('gender')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <?php
        $isRoleFieldDisabled = !$show && $user->isSuperAdmin()
    ?>
    <div class="col-md-6 fv-row">
        <label class="fs-6 fw-bold mb-2" for="role_id">
            <span class="required">Role</span>
            <i class="fas fa-exclamation-circle fs-7" data-bs-toggle="tooltip"
               title="Different Role have different capabilities"></i></label>
        <select class="form-control form-control-solid @error('role') is-invalid @enderror" {{$isRoleFieldDisabled ? 'disabled' : ''}}
                name="role">
            @if(!$isRoleFieldDisabled)
            <option value="">{{ __('-- Select Role --') }}</option>
            @foreach($roles as $key => $name)
                <?php
                $selected = old('role', $user->role?->key) == $key ? 'selected' : '';
                ?>
                <option value="{{$key}}" {{ $selected }}>{{ $name }}</option>
            @endforeach
            @else
                <option value="" selected>{{ __('Could not change role for super admin') }}</option>
            @endIf
        </select>
        @error('role')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="row g-9 mb-8">
    <div class="col-md-6 fv-row">
        <label class="fs-6 fw-bold mb-2" for="email">Phone</label>
        <input type="text" name="phone" class="form-control form-control-solid @error('phone') is-invalid @enderror"
               value="{{ old('phone', $user->phone) }}"/>
        @error('phone')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2" for="email">Address</label>
        <input type="text" name="address"
               class="form-control form-control-solid @error('address') is-invalid @enderror"
               value="{{ old('address', $user->address) }}"/>
        @error('address')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!--end::Input group-->


<!--begin::Input group-->
<div class="row g-9 mb-8">
    <div class="col-md-6 fv-row">
        <label class="fs-6 fw-bold mb-2" for="email">Date of Birth</label>
        <input id="dob" name="dob" class="form-control form-control-solid @error('dob') is-invalid @enderror"
               value="{{ old('dob', $user->dob) }}"/>
        @error('dob')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6 fv-row preference
     {{old('role',$user->role?->key) === \App\Constants\UserRole::ARTIST   ? '' : 'hidden'}}">
        <label class="fs-6 fw-bold mb-2" for="role_id">
            <span>Preference</span>
            <i class="fas fa-exclamation-circle fs-7" data-bs-toggle="tooltip"
               title="Select your preference"></i></label>
        <select class="form-control form-control-solid @error('preference') is-invalid @enderror"
                name="preference">
            <option value="">{{ __('-- Select preference --') }}</option>
            @foreach(\App\Constants\PreferenceType::LIST as $key => $name)
                <?php
                    $selected = old('preference', $user->preference) == $key ? 'selected' : '';
                ?>
                <option value="{{$key}}" {{ $selected }}>{{ $name }}</option>
            @endforeach
        </select>
        @error('preference')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

</div>
<!--end::Input group-->


<div
    class="club mb-8 {{(old('role',$user->role?->key) === \App\Constants\UserRole::ORGANIZER && $user->role?->key === \App\Constants\UserRole::ORGANIZER) || old('role') === \App\Constants\UserRole::ORGANIZER   ? '' : 'hidden'}}">
    <!--begin::Input group-->
    <div class="row g-9 mb-8">
        <!--begin::Input group-->
        <div class="col-md-6 fv-row">
            <label class="required fs-6 fw-bold mb-2">Club Name</label>
            <input name="club_name" class="form-control form-control-solid @error('club_name') is-invalid @enderror"
                   value="{{ old('club_name', $user->club?->name) }}"/>
            @error('club_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="col-md-6 fv-row">
            <label class="required fs-6 fw-bold mb-2" for="email">Address</label>
            <input type="text" name="club_address"
                   class="form-control form-control-solid @error('club_address') is-invalid @enderror"
                   value="{{ old('club_address', $user->club?->address) }}"/>
            @error('club_address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Input group-->

    <div class="row g-9 mb-8">
        <div class="col-md-6 fv-row">
            <label class="required fs-6 fw-bold mb-2">Established Date</label>
            <input id="established_date" name="established_date"
                   class="form-control form-control-solid @error('established_date') is-invalid @enderror"
                   value="{{ old('established_date', $user->club?->established_date) }}"/>
            @error('established_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 fv-row">
            <label class="fs-6 fw-bold mb-2">Description</label>
            <textarea name="club_description" rows="1"
                      class="form-control form-control-solid @error('club_description') is-invalid @enderror">{{ old('club_description', $user->club?->description) }}</textarea>
            @error('club_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

</div>

<div
    class="user-genre {{(  old('role', $user->role?->key) != "" &&  !in_array(old('role', $user->role?->key), \App\Constants\UserRole::ADMIN_LIST)) ? '': 'hidden'}}">
    <!--begin::Title-->
    <label class="required fs-6 fw-bold mb-4">Select User genre</label>
    <!--end::Title-->
    <div class="bg-white rounded shadow-sm p-10 mx-auto w-full @error('genres') is-invalid @enderror">
        <div class="genre-list w-full">
            <?php
            $oldGenre = old('genres', $user->genres?->pluck('name')->toArray());
            ?>
                <!-- TODO: Replace env variable with config or pull it from settings -->
            @foreach($genres as $genre)
                <div data-val="{{$genre->name}}"
                     class="single-genre {{in_array($genre->name,$oldGenre) ? 'active'  : ''}}  {{!in_array($genre->name,$oldGenre) && count($oldGenre) == config('app.settings.app_max_genre_count') ? 'disabled' : ''}}"
                     title="{{$genre->excerpt}}">
                    <span
                        class="inline-block text-gray-800 fw-bold fs-6 lh-1 pointer-events-none overflow-hidden overflow-ellipsis w-full text-center">{{ucwords($genre->name)}}</span>
                    @if(in_array($genre->name,$oldGenre))
                        <input type="hidden" value="{{$genre->name}}" name="genres[]">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @error('genres')
    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<!--begin::Actions-->
<div class="submit-btn-row mt-5">
    <a href="{{route('users.index')}}" class="btn btn-dark btn-sm me-3">Cancel</a>
    <button type="submit" class="btn btn-sm btn-primary">{{$buttonText}}</button>
</div>
<!--end::Actions-->
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            /** role select */
            $('select[name="role"]').on('change', function () {
                const value = $(this).val();
                const adminList = @json(\App\Constants\UserRole::ADMIN_LIST);
                if (adminList.includes(value)) {
                    $('.user-genre').slideUp();
                } else {
                    $('.user-genre').slideDown();
                }
                if (value === "{{\App\Constants\UserRole::ORGANIZER}}") {
                    $('.club').slideDown();
                } else {
                    $('.club').slideUp();
                }
                if (value === "{{\App\Constants\UserRole::ARTIST}}") {
                    $('.preference').slideDown();
                }else{
                    $('.preference').slideUp();
                }
            });

            /** Flat picker starts here **/
            $("#dob,#established_date").flatpickr({
                dateFormat: "Y-m-d",
                maxDate: new Date(),
            });

            /** genre selection box begins*/
            let selectedGenre = [];
            $('.single-genre.active').each((idx, el) => {
                selectedGenre.push($(el).attr('data-val'));
            });

            $('.single-genre').on('click', function () {
                const selectedSlug = $(this).attr('data-val');
                $(this).toggleClass('active');
                if ($(this).hasClass('active')) {
                    selectedGenre.push(selectedSlug);
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'genres[]',
                        value: selectedSlug
                    }).appendTo(this);
                } else {
                    selectedGenre = selectedGenre.filter((el) => el !== selectedSlug);
                    $(this).find('input:hidden[name="genres[]"]').remove();
                }
                /*TODO: Replace env variable with setting or config value */
                if (selectedGenre.length == '{{config('app.settings.app_max_genre_count')}}') {
                    $('.single-genre').not('.single-genre.active').addClass('disabled');
                } else {
                    $('.single-genre').removeClass('disabled');
                }
            });
        });
    </script>
@endpush
