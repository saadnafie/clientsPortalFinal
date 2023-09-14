<!-- The Modal -->
<div class="modal fade" id="myModal{{$key+1}}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New {{ $credential->credential_type }}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
@if(isset($credential->formFields))
  <form action="{{route('applicationDetails.store')}}" method="post" enctype="multipart/form-data">
    @csrf
      <input type="hidden" value="{{ $application->id }}" name="application_id">
      <input type="hidden" value="{{ $credential->id }}" name="credential_id">
        <div class="row">
            @foreach($credential->formFields as $fieldKey=>$credentialFormField)
              <div class="col-md-4">
                <div class="form-group">

                  @if(($credentialFormField->fieldType->field_type == "text") ||
                    ($credentialFormField->fieldType->field_type == "email") ||
                    ($credentialFormField->fieldType->field_type == "date"))
                  <label>{{ $credentialFormField->field_label }}</label>
                  <input type="{{ $credentialFormField->fieldType->field_type }}" class="form-control" id="{{str_replace(" ", "_", $credentialFormField->field_label)}}" name="{{str_replace(" ", "_", $credentialFormField->field_label)}}"  required>

                  @elseif($credentialFormField->fieldType->field_type == "select-country")
                      <label>{{ $credentialFormField->field_label }}</label>
                      <select class="form-control" id="{{str_replace(" ", "_", $credentialFormField->field_label)}}"  name="{{str_replace(" ", "_", $credentialFormField->field_label)}}">
                        @foreach($countries as $key=>$country)
                          <option value="{{$country->country_name}}">{{ $country->country_name }}</option>
                        @endforeach
                      </select>
                  @endif

                </div>
              </div>
            @endforeach
        </div>

        <hr>

        <div class="row">
        @foreach($credential->formFields as $fieldKeys=>$credentialFormField)
          @if($credentialFormField->fieldType->field_type === "file" )
            <div class="col-md-4">
              <div class="form-group">
                <label>{{ $credentialFormField->field_label }}</label>
                <input type="{{ $credentialFormField->fieldType->field_type }}" accept="image/*,.pdf, .doc, .docs" class="form-control" id="{{str_replace(" ", "_", $credentialFormField->field_label)}}" name="{{str_replace(" ", "_", $credentialFormField->field_label)}}"  required>
              </div>
            </div>
            @endif
        @endforeach
        </div>

            <button type="submit" class="btn btn-primary mb-2 pull-right"style="padding: 15px;font-size:22px;">Save</button>
        </form>
        @endif

    </div><!---modal body -->
  </div><!---modal content -->
</div><!---modal dialog -->
</div><!---modal -->
