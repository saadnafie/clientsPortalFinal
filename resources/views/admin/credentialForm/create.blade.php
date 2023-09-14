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
                    <h4 class="card-title">Add New Credential Form Field</h4>
                    <p class="card-description"> Create Credential Form Field
                    </p>

                    <form class="forms-sample" action="{{ route('credentialFormFields.store') }}" method="post">
                      @csrf
                      @method('POST')
                    <div class="form-group">
                      <label for="credential">Credential</label>
                      <select class="form-control" id="credential_id" name="credential_id">
                        @foreach($credentials as $key=>$credential)
                            <option value="{{ $credential->id }}">{{ $credential->credential_type }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="field_id">Field Name</label>
                    <select class="form-control" id="field_id" name="field_id">
                      @foreach($formFields as $key=>$formField)
                          <option value="{{ $formField->id }}">{{ $formField->field_label }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="mandatory">Mandatory</label>
                    <select class="form-control" id="mandatory" name="mandatory">
                          <option value="1">Required</option>
                          <option value="0">Not Required</option>
                    </select>
                  </div>
                    <button type="submit" class="btn btn-primary mr-2"> Add </button>
                  </form>

                  </div>
                </div>
                </div>
                </div>
                </div>



@endsection
