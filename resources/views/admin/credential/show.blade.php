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
                <i class="mdi mdi-plus-circle"></i> ProfesCredential  Details </a>--}}
            </div>
        </div>

        <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">



                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Credential Details <u style="color:red;">[{{ $credential->credential_type }}]</u></h4>
                        <p class="card-description"> Credential Form Fields
                        </p>



                    <div class="row">
                        <div class="col-md-6">
                        <div class="card bg-primary text-white">
                        <div class="card-body">Add Form Fields</div>
                    </div>
                    
                            <form class="forms-sample" action="{{ route('credentialFormFields.store') }}" method="post" style="padding:20px;border:2px solid gray;">
                                @csrf
                                @method('POST')
                                <input type="hidden" value="{{ $credential->id }}" id="credential_id" name="credential_id" >
                                <div class="form-group">
                                    <label for="field_id">Field Name</label>
                                    <select class="form-control" id="field_id" name="field_id">
                                    @foreach($formFields as $key=>$formField)
                                        <option value="{{ $formField->id }}">{{ $formField->field_label }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label for="mandatory">Mandatory</label>
                                    <select class="form-control" id="mandatory" name="mandatory">
                                        <option value="1">Required</option>
                                        <option value="0">Not Required</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field_order">Field Order</label>
                                    <input type="text" name="field_order" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2"> Add </button>
                            </form>
                        </div>
                    </div>
                  
                
                  <br>

                  <div class="card bg-primary text-white">
                        <div class="card-body">Credential Form Fields Details</div>
                    </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="table-info">
                                            <th>#</th>
                                            <th>Field Name</th>
                                            <th>Field Type</th>
                                            <!--<th>Mandatory</th>-->
                                            <th>Field Order</th>
                                            <!--<th>name attribute</th>
                                            <th>Validation Rules</th>-->
                                            <th>Settings</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($credentialFormFields as $key=>$credentialFormField)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $credentialFormField->formField->field_label }}</td>
                                                <td>{{ $credentialFormField->formField->fieldType->field_type }}</td>
                                                {{--<td>{{ $credentialFormField->mandatory_value }}</td>--}}
                                                <td>{{ $credentialFormField->order_number }}</td>
                                                <td>
                                                <a href="{{route('fields-rules.show', ['fields_rule'=> $credentialFormField->id])}}" target="_blank" class="btn btn-primary btn-icon-text" >  <i class="mdi mdi-tooltip-plus"></i></a>
                                                <a href="#" class="btn btn-info btn-icon-text" data-bs-toggle="modal" data-bs-target="#myModal{{ $key }}">  <i class="mdi mdi-tooltip-edit"></i></a>
                                                <form method="POST" action="{{route('credentialFormFields.destroy',  $credentialFormField->id)}}" style="display: contents;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-icon-text"> <i class="mdi mdi-trash-can"></i></button>
                                                </form>
                                                </td>
                                            </tr>

                                            <div class="modal" id="myModal{{ $key }}">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Update {{ $credentialFormField->formField->field_label }}</h4>
                                                    <button type="button" class="btn btn-outline-info btn-sm" data-bs-dismiss="modal">
                                                        <i class="mdi mdi-close"></i></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form action="{{ route('credentialFormFields.update', $credentialFormField->id) }}" method="POST">
                                                            @csrf
                                                            @method("PUT")
                                                            <div class="form-group">
                                                                <label for="mandatory">Mandatory</label>
                                                                <select class="form-control" id="mandatory" name="mandatory" disabled>
                                                                    <option value="1" {{ ($credentialFormField->mandatory == 1) ? 'selected':'' }}>Required</option>
                                                                    <option value="0" {{ ($credentialFormField->mandatory == 0) ? 'selected':'' }}>Not Required</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="field_order">Field Order</label>
                                                                <input type="text" name="field_order" value="{{ $credentialFormField->order_number }}" class="form-control" required>
                                                            </div>
                                                        <button type="submit" class="btn btn-info" >Update</button>
                                                        </form> 
                                                    </div>

                                                </div>
                                                </div>
                                            </div>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div> <!--table responsive div -->


                    </div> <!--card body div -->
                </div> <!--card div -->
            </div> <!--col div -->
        </div> <!-- row div -->


    </div>


@endsection