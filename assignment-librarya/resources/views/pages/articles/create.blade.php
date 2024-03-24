@extends('layout')

@section('content')

<div class="col">
  <div class="row">
    <div class="col mb-3">
      <div class="card">
        <div class="card-body">
          <div class="e-profile">
            <div class="row">

              <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                <div class="text-center text-sm-left mb-2 mb-sm-0">
                  <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Create Article</h4>
                </div>
              </div>
            </div>

            <div class="tab-content pt-3">
              <div class="tab-pane active">

                <form class="form" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('POST')

                  <div class="row">
                    <div class="col">

                        <div class="col">
                          <div class="form-group">
                            <label>Title</label>
                            <input class="form-control"
                            type="text"
                            name="title"
                            required="required"
                            placeholder="Title"
                            value="{{ old('title') }}">
                          </div>
                          @error('title')
                              <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="row">
                          <div class="col">
                              <label>Text</label>
                              <div class="form-group">
                                  <textarea class="ckeditor form-control" name="text"></textarea>
                              </div>
                          </div>
                        </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col d-flex justify-content-end">
                        <a href="{{ \URL::previous() }}" class="btn btn-primary mr-2">Back</a>
                        <button class="btn btn-success mr-2" type="submit">Save</button>
                    </div>
                  </div>

                </form>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endpush
