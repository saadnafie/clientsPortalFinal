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
                <!--<a href="{{ route('countries.create') }}" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Country </a>-->
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Country</h4>
                    <p class="card-description"> Country list
                    </p>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Country</th>
                            <th>Nationality</th>
                            <th>isActive</th> 
                            <th>Settings</th>
                          </tr>
                        </thead>

                        <tbody>
                          @if(count($countries) > 0)
                          @foreach($countries as $key=>$country)
                          @if($country->activation)
                            <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $country->country_name }}</td>
                              <td>{{ $country->nationality }}</td>
                              <td>{!! $country->activation_status !!}</td>
                              <td>
                              <a href="{{route('countryActivation',['id'=>$country->id,'status'=>0])}}" class="btn btn-warning btn-icon-text">  <i class="mdi mdi-block-helper"></i></a>
                              </td>
                            </tr>
                              @else 
                              <tr class="table-danger">
                              <td>{{ $key+1 }}</td>
                              <td>{{ $country->country_name }}</td>
                              <td>{{ $country->nationality }}</td>
                              <td>{!! $country->activation_status !!}</td>
                              <td>
                              <a href="{{route('countryActivation',['id'=>$country->id,'status'=>1])}}" class="btn btn-success btn-icon-text">  <i class="mdi mdi-check"></i></a>
                              </td>
                            </tr>
                              
                            @endif
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan=5><i>No country found...</i></td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                </div>
                </div>
                </div>



@endsection
