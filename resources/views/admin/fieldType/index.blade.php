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
                <!--<a href="#" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Field Type </a>-->
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Field Types</h4>
                    <p class="card-description"> Field Types list
                    </p>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Field Type</th>
                            <!--<th>Settings</th>-->
                          </tr>
                        </thead>

                        <tbody>
                          @if(count($fieldTypes) > 0)
                          @foreach($fieldTypes as $key=>$fieldType)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $fieldType->field_type }}</td>
                            <!--<td>
                              <a href="#" class="btn btn-info btn-icon-text">  <i class="mdi mdi-tooltip-edit"></i></a>
                            </td>-->
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan=4><i>No Field Type found...</i></td>
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
