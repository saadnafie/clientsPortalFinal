@extends('admin.layouts.header')
@section('content')


          <!-- partial -->
          <div class="main-panel">
            <div class="content-wrapper pb-0">
              <div class="page-header flex-wrap">

              <div class="header-left">
                <!--<button class="btn btn-primary mb-2 mb-md-0 mr-2"> Create new document </button>
                <button class="btn btn-outline-primary bg-white mb-2 mb-md-0"> Import documents </button>-->
              </div>

              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
              <!--  <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Profession </button>-->
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New profession Rule</h4>
                    <p class="card-description"> Create profession Rule
                    </p>

                    <form class="forms-sample" action="{{ route('professionRules.store') }}" method="post">
                      @csrf
                      @method('POST')
                      <div class="form-group">
                        <label for="profession">Profession</label>
                        <select class="form-control" id="profession" name="profession">
                          @foreach($professions as $key=>$profession)
                              <option value="{{ $profession->id }}">{{ $profession->profession }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="credential">Credential</label>
                      <select class="form-control" id="credential" name="credential">
                        @foreach($credentials as $key=>$credential)
                            <option value="{{ $credential->id }}">{{ $credential->credential_type }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country">
                      @foreach($countries as $key=>$country)
                          <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                      @endforeach
                    </select>
                </div>
                    <div class="form-group">
                        <label for="certificates_number">certificates Number</label>
                        <input type="text" class="form-control" id="certificates_number" name="certificates_number" placeholder="certificates number" required/>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2"> Add </button>
                  </form>

                  </div>
                </div>
                </div>
                </div>
                </div>



@endsection
