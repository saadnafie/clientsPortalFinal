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
                <a href="{{ route('professionRules.create') }}" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Profession Rule </a>
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Professions Rules</h4>
                    <p class="card-description"> Professions Rules list
                    </p>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Profession</th>
                            <th>Credential</th>
                            <th>Country</th>
                            <th>Certificates Number</th>
                            <th>Settings</th>
                          </tr>
                        </thead>

                        <tbody>
                          @if(count($professionRules) > 0)
                          @foreach($professionRules as $key=>$professionRule)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $professionRule->profession_country->profession->profession }}</td>
                            <td>{{ $professionRule->credential->credential_type }}</td>
                            <td>{{ $professionRule->profession_country->country->country_name }}</td>
                            <td>{{ $professionRule->certificates_number }}</td>
                            <td>
                              <a href="{{route('professionRules.edit',  $professionRule->id)}}" class="btn btn-info btn-icon-text">  <i class="mdi mdi-tooltip-edit"></i></a>
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
