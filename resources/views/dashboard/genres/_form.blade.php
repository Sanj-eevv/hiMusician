@csrf
<!--begin::Input group-->
<div class="row g-9 mb-8">
    <!--begin::Col-->
    <div class="fv-row">
        <label class="required fs-6 fw-bold mb-2" for="name">
            Name
        </label>
        <input type="text" name="name"
               class="form-control form-control-solid @error('name') is-invalid @enderror"
               value="{{ old('name', $genre->name) }}"/>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row g-9 mb-8">
    <!--begin::Col-->
    <div class="col-md-12 fv-row">
        <label class="required fs-6 fw-bold mb-2" for="excerpt">Excerpt</label>
        <textarea name="excerpt"
                  class="form-control form-control-solid @error('excerpt') is-invalid @enderror">{{ old('excerpt', $genre->excerpt) }}</textarea>
        @error('excerpt')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="row g-9 mb-8">
    <!--begin::Col-->
    <div class="col-md-12 fv-row">
        <label class="required fs-6 fw-bold mb-2">
            Upload Image
        </label>
        <input type="hidden" name="image_hidden_value" class="image_hidden_value"
               value="{{ old('image', $genre->symbol) }}">
        <input type="file" name="image" onchange="loadPreview(this);"
               class="form-control form-control-solid @error('image') is-invalid @enderror" id="image"
               value="{{ old('image', $genre->symbol) }}" />
        <div class="hi_preview_image_container {{ empty($genre->symbol) ? 'd-none' : '' }}">
            <img id="hi_preview_img"
                 src="{{ empty($genre->symbol) ? '' : asset('storage/uploads/' . $genre->symbol) }}"
                 class="img-fluid " />
            <a href="!#" class="hi_preview_image_close"><i class="fas fa-times"></i></a>
        </div>
        @error('image')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->


<!--begin::Actions-->
<div class="submit-btn-row mt-5">
    <a href="{{route('genres.index')}}" class="btn btn-dark btn-sm me-3">Cancel</a>
    <button type="submit" class="btn btn-sm btn-primary">{{$buttonText}}</button>
</div>
<!--end::Actions-->
@section('page_level_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(){
            $('.hi_preview_image_container').removeClass('d-none');
        });
    });
</script>
@endsection