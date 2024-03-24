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
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Edit Article</h4>
                  </div>
                </div>
              </div>

              <div class="tab-content pt-3">
                <div class="tab-pane active">

                  <form class="form" action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

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
                              value="{{ old('title', $article->title) }}">
                            </div>
                            @error('title')
                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="row">
                              <div class="col">
                                  <label>Text</label>
                                  <div class="form-group">
                                      <textarea class="ckeditor form-control" name="text">
                                          {{ old('text', $article->text) }}
                                      </textarea>
                                  </div>
                              </div>
                          </div>

                      </div>
                    </div>

                      <div class="row">
                          <div class="col d-flex justify-content-end">
                              <a href="{{ \URL::previous() }}" class="btn btn-primary mr-2">Back</a>
                              @if($article->publication_status_id !== \App\Enums\PublicationStatus::PENDING_REVIEW)
                                  <button class="btn btn-success mr-2" type="submit">Save</button>
                                  <div>
                                      <a href="{{ \URL::previous() }}" class="btn btn-warning submit-for-review">Submit For Review</a>
                                  </div>
                              @endif

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

        $(document).on('click', '.submit-for-review', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route("articles.submitted", [$article->id]) }}",
                type: 'POST',
                dataType: "json",
                data: {
                    '_token': "{{ csrf_token() }}"
                }
            }).done(function (response) {
                // srediti toaster
                console.log('radi')
                // toastr.success(response.notification, __('Training is successfully updated!'), {timeOut: 3000});
                window.location.href = "{{ route("articles.index") }}";
                // srediti toaster
            }).fail(function (response) {
                console.log(response)
            }).always(function () {

            })
        });

    </script>
@endpush
