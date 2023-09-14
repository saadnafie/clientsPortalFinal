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
                <a href="{{ route('credentials.create') }}" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Credential </a>
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Credentials</h4>
                    <p class="card-description"> Credentials Classification list
                    </p>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Credential</th>
                            <th>Additional Cost</th>
                            <!--<th>isSoftDeleted</th>-->
                            <th>Activation</th>
                            <th>Settings</th>
                          </tr>
                        </thead>

                        <tbody>
                          @if(count($credentials) > 0)
                          @foreach($credentials as $key=>$credential)
                          
                          @if($credential->activation)
                          <tr>
                          @else
                          <tr class="table-danger">
                          @endif
                            <td>{{ $key+1 }}</td>
                            <td>{{ $credential->credential_type }}</td>
                            <td>{{ $credential->credential_cost }}</td>
                            {{--<td>{{ ($credential->deleted_at) ? 'Yes':'No' }}</td>--}}
                            <td>{{ $credential->activation_status }}</td>
                            <td>
                              <!----Admin rule: not change for fields during an open application exist to avoid errors -->
                              @if($currentOpenApplicationsCount == 0)
                              <a href="{{route('credentials.show',  $credential->id)}}" class="btn btn-primary btn-icon-text">  <i class="mdi mdi-eye"></i></a>
                              @endif
                              <a href="{{route('credentials.edit',  $credential->id)}}" class="btn btn-info btn-icon-text">  <i class="mdi mdi-tooltip-edit"></i></a>
                              @if($credential->activation)
                                 <a href="{{route('credentialActivation',['id'=>$credential->id,'status'=>0])}}" class="btn btn-danger btn-icon-text"> <i class="mdi mdi-block-helper"></i></a>
                              @else
                                 <a href="{{route('credentialActivation',['id'=>$credential->id,'status'=>1])}}" class="btn btn-success btn-icon-text">  <i class="mdi mdi-check"></i></a>
                              @endif 
                            </td>  
                            </tr> 

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
                                        <form action="{{ route('credentials.destroy', $credential->id) }}" method="POST">
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
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan=5><i>No Credential found...</i></td>
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
