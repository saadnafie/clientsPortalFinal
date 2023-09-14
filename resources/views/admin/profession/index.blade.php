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
                <a href="{{ route('professions.create') }}" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Profession </a>
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Professions</h4>
                    <p class="card-description"> Professions list
                    </p>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Profession</th>
                            <th>isActive</th>
                            <th>Settings</th>
                          </tr>
                        </thead>

                        <tbody>
                          @if(count($professions) > 0)
                          @foreach($professions as $key=>$profession)
                          
                              @if($profession->deleted_at)
                                <tr class="table-danger">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $profession->profession }}</td>
                                <td>{!! $profession->activation_status !!}</td>
                                <td>
                                  <a href="{{route('professionRestore',  $profession->id)}}" class="btn btn-info btn-icon-text">  <i class="mdi mdi-backup-restore"></i></a>
                                </td>
                                </tr>

                              @elseif(!$profession->activation)
                              <tr class="table-danger">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $profession->profession }}</td>
                                <td>{!! $profession->activation_status !!}</td>
                                <td>
                                <a href="{{route('professions.show',  $profession->id)}}" class="btn btn-primary btn-icon-text">  <i class="mdi mdi-eye"></i></a>
                                  <a href="{{route('professions.edit',  $profession->id)}}" class="btn btn-info btn-icon-text">  <i class="mdi mdi-tooltip-edit"></i></a>
                                  <a href="{{route('professionActivation',['id'=>$profession->id,'status'=>1])}}" class="btn btn-success btn-icon-text">  <i class="mdi mdi-check"></i></a>
                                </td>
                                </tr>

                              @else
                                <tr>
                                  <td>{{ $key+1 }}</td>
                                  <td>{{ $profession->profession }}</td>
                                  <td>{!! $profession->activation_status !!}</td>
                                  <td>
                                  <a href="{{route('professions.show',  $profession->id)}}" class="btn btn-primary btn-icon-text">  <i class="mdi mdi-eye"></i></a>
                                  <a href="{{route('professions.edit',  $profession->id)}}" class="btn btn-info btn-icon-text">  <i class="mdi mdi-tooltip-edit"></i></a>
                                  @if($profession->activation)
                                    <a href="{{route('professionActivation',['id'=>$profession->id,'status'=>0])}}" class="btn btn-warning btn-icon-text">  <i class="mdi mdi-block-helper"></i></a>
                                  @else
                                    <a href="{{route('professionActivation',['id'=>$profession->id,'status'=>1])}}" class="btn btn-success btn-icon-text">  <i class="mdi mdi-check"></i></a>
                                  @endif

                                <!--<a href="#" class="btn btn-danger btn-icon-text" data-bs-toggle="modal" data-bs-target="#myModal{{ $key }}">  <i class="mdi mdi-trash-can"></i></a>-->
                                  <!-- The Modal -->
                                  <div class="modal" id="myModal{{ $key }}">
                                    <div class="modal-dialog modal-sm">
                                      <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Warning</h4>
                                          <button type="button" class="btn btn-outline-info btn-sm" data-bs-dismiss="modal">
                                            <i class="mdi mdi-close"></i></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                          Are you sure ? <br> You want to delete this profession
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <form action="{{ route('professions.destroy', $profession->id) }}" method="POST">
                                          @csrf
                                          @method("DELETE")
                                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
                                        </form> 
                                          <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                                        </div>

                                      </div>
                                    </div>
                                  </div>

                              </td>
                            </tr>
                          @endif
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan=4><i>No profession found...</i></td>
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
