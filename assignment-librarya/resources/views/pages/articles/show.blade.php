@extends('layout')

@section('content')

<div class="card no-border-top">
    <div class="tab-content">
        <div class="tab-pane fade in active show" role="tabpanel">
            <div class="card no-border">
                <div class="card-header">
                    <h2><i class="ion-android-social-user"></i> Ship Details: </h2>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Ship Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $ship->name }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Serial Number</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $ship->serial_number }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Image</h6>
                            <div class="d-flex flex-column align-items-center text-center">
                              
                              <div class="product-details-image-holder bg-shade-whisper">
                                <img src="{{ $ship->image ? asset('storage/' . str_replace("public/","",$ship->image)) : "https://dummyimage.com/825x478/999999/000000&text=630x400" }}">
                              </div>
                              
                            </div>
                          </div>
                        </div>

                        @if(!$users->isEmpty())
                        <label>Crew</label>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">First Name</th>
                              <th scope="col">Last Name</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($users as $user)
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->surname }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                        @endif

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