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
                <a href="{{ route('professionCountries.create') }}" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Profession Country </a>
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Professions with Country</h4>
                    <p class="card-description"> Professions Country list
                    </p>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Profession</th>
                            <th>Country</th>
                            <th>Package Type</th>
                            <th>Package Cost</th>
                            <th>Settings</th>
                          </tr>
                        </thead>

                        <tbody>
                          @if(count($professionCountries) > 0)
                          @foreach($professionCountries as $key=>$professionCountry)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $professionCountry->profession->profession }}</td>
                            <td>{{ $professionCountry->country->country_name }}</td>
                            <td>{{ $professionCountry->package_type_id }}</td>
                            <td>{{ $professionCountry->base_cost }}</td>
                            <td>
                              <a href="{{route('professionCountries.edit',  $professionCountry->id)}}" class="btn btn-info btn-icon-text">  <i class="mdi mdi-tooltip-edit"></i></a>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan=5><i>No Profession Rule found...</i></td>
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
