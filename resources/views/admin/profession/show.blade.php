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
            {{--<a href="{{ route('professions.create') }}" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                <i class="mdi mdi-plus-circle"></i> Profession Details </a>--}}
            </div>
        </div>

        <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">



                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profession Details <u style="color:red;">[{{ $profession->profession }}]</u></h4>
                        <p class="card-description"> Country, Package, Cost [Profession Country]
                        </p>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home"><i class="mdi mdi-home-map-marker menu-icon"></i> Profession Country</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1"><i class="mdi mdi-check-decagram menu-icon"></i> Profession Rule</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="home" class="container tab-pane active"><br>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Country</th>
                                            <th>Package Type</th>
                                            <th>Base Cost</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($professionCountries as $key=>$professionCountry)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $professionCountry->country->country_name }}</td>
                                                    <td>{{ $professionCountry->package_type_id }}</td>
                                                    <td>{{ $professionCountry->base_cost }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!--table responsive div -->

                            </div>

                            <div id="menu1" class="container tab-pane fade"><br>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Credential</th>
                                            <th>Country</th>
                                            <th>Certificates Number</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @php $counter=0; @endphp
                                            @foreach($professionCountries as $key=>$professionCountry)
                                                @if($professionCountry->professionRule->count() > 0)
                                                    @foreach($professionCountry->professionRule as $rule)
                                                    @php $counter++; @endphp
                                                    <tr>
                                                        <td>{{ $counter }}</td>
                                                        <td>{{ $rule->credential->credential_type }}</td>
                                                        <td>{{ $professionCountry->country->country_name }}</td>
                                                        <td>{{ $rule->certificates_number }}</td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!--table responsive div -->
                            </div>

                        </div>


                    </div> <!--card body div -->
                </div> <!--card div -->
            </div> <!--col div -->
        </div> <!-- row div -->


    </div>


@endsection