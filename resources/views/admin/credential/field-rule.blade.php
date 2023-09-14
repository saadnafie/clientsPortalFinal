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
                        <h4 class="card-title">Field Rule <u style="color:red;">[{{ $credentialFormField->formField->field_label }}]</u></h4>
                        <p class="card-description"> Credential Form Fields Rules
                        </p>



                    <div class="row">
                        <div class="col-md-6">
                        <div class="card bg-primary text-white">
                        <div class="card-body">Add Form Field Rules ({{$credentialFormField->formField->field_label}})</div>
                    </div>
                    
                            <form class="forms-sample" action="{{ route('fields-rules.store') }}" method="post" style="padding:20px;border:2px solid gray;">
                                @csrf
                                @method('POST')
                                <input type="hidden" value="{{ $credentialFormField->id }}" id="credential_formField_ID" name="credential_formField_ID" >
                                <div class="form-group">
                                    <label for="field_id">Rule Type</label>
                                    <select class="form-control" id="rule_id" name="rule_id">
                                    @foreach($rulesList as $key=>$rule)
                                        <option value="{{ $rule->id }}">{{ $rule->rule_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mandatory">Rule Value</label>
                                    <input type="text" name="rule_value" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="field_order">Rule Validation Message</label>
                                    <input type="text" name="rule_message" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2"> Add </button>
                            </form>
                        </div>
                    </div>
                  
                
                  <br>

                  
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="table-info">
                                            <th>#</th>
                                            <th>Rule Type</th>
                                            <th>Rule Value</th>
                                            <th>Rule Message</th>
                                            <!--<th>Settings</th>-->
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($fieldsRules as $key=>$fieldRule)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $fieldRule->rule->rule_name }}</td>
                                                <td>{{ $fieldRule->rule_value }}</td>
                                                <td>{{ $fieldRule->rule_message }}</td>
                                               <!-- <td>
                                                <a href="#" class="btn btn-info btn-icon-text" data-bs-toggle="modal" data-bs-target="#myModal{{ $key }}">  <i class="mdi mdi-tooltip-edit"></i></a>
                                                </td>-->
                                                </tr>

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