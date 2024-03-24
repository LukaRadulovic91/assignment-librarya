@extends('layout')

@section('content')

<div class="card no-border-top">
    <div class="tab-content">
        <div class="tab-pane fade in active show" role="tabpanel">
            <div class="card no-border">
                <div class="card-header">
                    <h2><i class="ion-android-social-user"></i> Article Details: </h2>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Article Title</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $article->title }}
                          </div>
                        </div>

                          <div class="row">
                              <div class="col">
                                  <label>Text</label>
                                  <div class="form-group">
                                      <p class="" name="text">
                                          {{ $article->text }}
                                      </p>
                                  </div>
                              </div>
                          </div>


                      </div>
                    </div>

                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <a href="{{ \URL::previous() }}" class="btn btn-primary">Back</a>
                      </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
