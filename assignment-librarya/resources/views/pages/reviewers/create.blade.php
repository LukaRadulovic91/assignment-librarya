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
                  <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Create Ship</h4>
                </div>
              </div>
            </div>
            
            <div class="tab-content pt-3">
              <div class="tab-pane active">

                <form class="form" action="{{ route('ships.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  
                  <div class="row">
                    <div class="col">
                      
                        <div class="col">
                          <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" 
                            type="text" 
                            name="name"
                            required="required" 
                            placeholder="Name" 
                            value="{{ old('name') }}">
                          </div>
                          @error('name')
                              <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label>Serial number</label>
                            <input class="form-control" 
                            type="text" 
                            name="serial_number" 
                            required="required" 
                            placeholder="Serial number" 
                            value="{{ old('serial_number') }}">
                            @error('serial_number')
                              <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      
                        <div class="col">
                          <div class="form-group">
                            <label>Image</label>
                            
                            <input type="file" 
                                   class="form-control" 
                                   name="image"/>
                          </div>
                          @error('image')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Choose Crew</label>
                                  
                                  {{ Form::select('user_ids[]', $users, $ship->user_ids ?? null, 
                                  ['class' => 'form-control', 'multiple' => 'multiple']) }}
      
                                  @error('rank_id')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                  @enderror
    
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col d-flex justify-content-end">
                      <a href="{{ \URL::previous() }}" class="btn btn-primary">Back</a>
                    </div>
                    <button class="btn btn-success" type="submit">Save</button>
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