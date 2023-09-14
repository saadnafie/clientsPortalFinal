@php $check_detail = (isset($detail) && $detail != null) ? true : false; @endphp
<form method="post" enctype="multipart/form-data" class="card-body py-1 w-100 mw-xl-700px "
    id="add-credential-form{{$key}}{{$i}}" name="add-credential-form{{$key}}{{$i}}">
    @csrf
    <div class="row">
        <input type="hidden" value="{{ $application->id }}" name="application_id">
        <input type="hidden" value="{{ $credential->credential->id }}" name="credential_id">
        <input type="hidden" value="{{($check_detail)? $detail->id : 0}}" name="detail_id" id="detail{{$key}}{{$i}}">
        @foreach($credential->credential->formFields as $fieldKey=>$credentialFormField)
        @if(($credentialFormField->fieldType->field_type == "text") ||
        ($credentialFormField->fieldType->field_type == "email") ||
        ($credentialFormField->fieldType->field_type == "date"))
        <div class="col-md-6 p-5 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="">{{ $credentialFormField->field_label }}</span>
            </label>
            <input type="{{ $credentialFormField->fieldType->field_type }}" class="form-control form-control-solid"
                id="{{str_replace(' ', '_', $credentialFormField->field_label)}}"
                value="{{($check_detail)?$detail->form_data[str_replace(' ', '_', $credentialFormField->field_label)]:''}}"
                name="{{str_replace(' ', '_', $credentialFormField->field_label)}}" required>
        </div>

        @elseif($credentialFormField->fieldType->field_type == "select-country")
        <div class="col-md-6 p-5 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="">{{ $credentialFormField->field_label }}</span>
            </label>
            <select id="{{str_replace(' ', '_', $credentialFormField->field_label)}}"
                name="{{str_replace(' ', '_', $credentialFormField->field_label)}}" data-control=""
                class="form-select form-select-solid form-select-lg fw-semibold">
                @foreach($countries as $country)
                @if($check_detail)
                <option value="{{$country->country_name}}"
                    {{($country->country_name == $detail->form_data[str_replace(' ', '_', $credentialFormField->field_label)])? 'selected':''}}>
                    {{ $country->country_name }}
                </option>
                @else
                <option value="{{$country->country_name}}">
                    {{ $country->country_name }}
                </option>
                @endif
                @endforeach
            </select>
        </div>

        @elseif($credentialFormField->fieldType->field_type == "select")
        <div class="col-md-6 p-5 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">{{ $credentialFormField->field_label }}</span>
            </label>
            <select id="{{str_replace(' ', '_', $credentialFormField->field_label)}}"
                name="{{str_replace(' ', '_', $credentialFormField->field_label)}}" data-control=""
                class="form-select form-select-solid form-select-lg fw-semibold">

                @foreach($credentialFormField->fieldOption->option_value as $crevalue)
                @if($check_detail)
                <option value="{{$crevalue}}"
                    {{ ($crevalue == $detail->form_data[str_replace(" ", "_", $credentialFormField->field_label)]) ? 'selected' : '' }}>
                    {{$crevalue}}</option>
                @else
                <option value="{{$crevalue}}">{{$crevalue}}</option>
                @endif
                @endforeach
            </select>
        </div>

        @elseif($credentialFormField->fieldType->field_type == "radio")
        <div class="col-md-6 p-5 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">{{ $credentialFormField->field_label }}</span>
            </label>
            @foreach($credentialFormField->fieldOption->option_value as $value)
            @if($check_detail)
            <div class="form-check">
                <input class="form-check-input" type="radio" value="{{$value}}"
                    id="{{str_replace(' ', '_', $credentialFormField->field_label)}}"
                    name="{{str_replace(' ', '_', $credentialFormField->field_label)}}" required="required"
                    {{($value == $detail->form_data[str_replace(" ", "_", $credentialFormField->field_label)])?'checked':''}}>
                <label class="form-check-label" for="defaultCheck1">
                    {{$value}}
                </label>
            </div>
            @else
            <div class="form-check">
                <input class="form-check-input" type="radio" value="{{$value}}"
                    id="{{str_replace(' ', '_', $credentialFormField->field_label)}}"
                    name="{{str_replace(' ', '_', $credentialFormField->field_label)}}">
                <label class="form-check-label" for="defaultCheck1" required="required">
                    {{$value}}
                </label>
            </div>
            @endif
            @endforeach
        </div>

        @elseif($credentialFormField->fieldType->field_type == "checkbox")
        <div class="col-md-6 p-5 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">{{ $credentialFormField->field_label }}</span>
            </label>
            @foreach($credentialFormField->fieldOption->option_value as $value)
            @if($check_detail)

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$value}}"
                    id="{{str_replace(' ', '_', $credentialFormField->field_label)}}"
                    name="{{str_replace(' ', '_', $credentialFormField->field_label)}}[]" required="required"
                    {{( array_search($value, $detail->form_data[$credentialFormField->lable_name] ,true) === 0 || array_search($value, $detail->form_data[$credentialFormField->lable_name] ) != false ) ? 'checked' : ''}}>
                <label class="form-check-label" for="defaultCheck1">
                    {{$value}}
                </label>
            </div>
            @else
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$value}}"
                    id="{{str_replace(' ', '_', $credentialFormField->field_label)}}"
                    name="{{str_replace(' ', '_', $credentialFormField->field_label)}}[]" required="required">
                <label class="form-check-label" for="defaultCheck1">
                    {{$value}}
                </label>
            </div>
            @endif
            @endforeach
        </div>



        @endif
        @endforeach
    </div>
    <div class="pt-5" style="text-align: right !important;">
        <button type="submit" class="btn btn-lg btn-sm btn-primary pull-right" onclick="addBasic({{$key}},{{$i}})">
            Add
        </button>
    </div>
</form>