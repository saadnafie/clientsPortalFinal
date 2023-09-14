<fieldset id="form1">
  <form action="{{route('application-detail-processes.update',['application_detail_process'=>1])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="credential_id" value="{{$basic_info->id}}">
    <input type="hidden" name="application_id" value="{{$application->id}}">
    <h5> Basic Information </h5>
    <hr>

      <div class="row">

          @foreach($basic_info->formFields as $key=>$formField)
              <div class="col-md-4">
                <div class="form-group">


              @if(($formField->fieldType->field_type == "text") ||
                ($formField->fieldType->field_type == "email") ||
                ($formField->fieldType->field_type == "date"))
                  <label>{{ $formField->field_label }}</label>
              <input type="{{ $formField->fieldType->field_type }}" class="form-control" id="{{str_replace(" ", "_", $formField->field_label)}}" name="{{str_replace(" ", "_", $formField->field_label)}}"  required>


              @elseif($formField->fieldType->field_type == "select-profession")
                <label>{{ $formField->field_label }}</label>
                  <select class="form-control" id="profession"  name="profession">
                    @foreach($professions as $key=>$profession)
                      <option value="{{$profession->id}}">{{ $profession->profession }}</option>
                    @endforeach
                  </select>

              @elseif($formField->fieldType->field_type == "select-subprofession")
                <label>{{ $formField->field_label }}</label>
                  <select class="form-control" id="subprofession"  name="subprofession">
                    @foreach($subProfessions as $key=>$subProfession)
                      <option value="{{$subProfession->sub_profession}}">{{ $subProfession->sub_profession }}</option>
                    @endforeach
                  </select>

              @elseif($formField->fieldType->field_type == "select-country")
                <label>{{ $formField->field_label }}</label>
                  <select class="form-control" id="{{str_replace(" ", "_", $formField->field_label)}}"  name="{{str_replace(" ", "_", $formField->field_label)}}">
                    @foreach($countries as $key=>$country)
                      <option value="{{$country->country_name}}">{{ $country->country_name }}</option>
                    @endforeach
                  </select>

              @elseif($formField->fieldType->field_type == "select-nationality")
                <label>{{ $formField->field_label }}</label>
                  <select class="form-control" id="nationality"  name="nationality">
                    @foreach($countries as $key=>$nationality)
                      <option value="{{$nationality->nationality}}">{{ $nationality->nationality }}</option>
                    @endforeach
                  </select>


              @elseif($formField->fieldType->field_type == "select")
                <label>{{ $formField->field_label }}</label>
                  <select class="form-control" id="{{str_replace(" ", "_", $formField->field_label)}}"  name="{{str_replace(" ", "_", $formField->field_label)}}">
                    @foreach($formField->fieldOption->option_value as $key=>$value)
                      <option value="{{$value}}">{{$value}}</option>
                      @endforeach
                  </select>
              @endif

            </div>
          </div>
          @endforeach

        </div>

        <button type="submit" class="btn btn-success mb-2 pull-right"style="padding: 15px;font-size:22px;">Next</button>

    </form>

</fieldset>
