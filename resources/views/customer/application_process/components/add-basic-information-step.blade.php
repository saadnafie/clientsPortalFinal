<style>
.error {
    margin-bottom: 10px;
}
</style>

<form enctype="multipart/form-data" class="card-body py-1 w-100 " id="add-credential-form000"
    name="add-credential-form000" method="post">
    @csrf
    <div class="w-100 p-3">
        <div class="row mb-5">
            @csrf
            @php $check_basic = ($basic_info->applicationDetail->count() > 0)? true : false ; @endphp
            @if($check_basic)
            @php $basic_data =$basic_info->applicationDetail[0]; @endphp
            @endif
            <input type="hidden" name="credential_id" value="{{$basic_info->id}}">
            <input type="hidden" name="application_id" value="{{$application->id}}">
            <input type="hidden" value="{{($check_basic)? $basic_data->id : 0}}" name="detail_id" id="detail000">

            @foreach($basic_info->formFields as $key=>$formField)

            @if(($formField->fieldType->field_type == "text") ||
            ($formField->fieldType->field_type == "email") ||
            ($formField->fieldType->field_type == "date"))
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                @if(auth()->user()->isIndividual() && $formField->field_label == "First Name")
                <input type="{{ $formField->fieldType->field_type }}" class="form-control form-control-solid"
                    id="{{$formField->lable_name}}" placeholder="{{ $formField->field_label }}"
                    name="{{str_replace(' ', '_', $formField->field_label)}}" value="{{$user->userDetails->First_Name}}"
                    readonly>
                @elseif(auth()->user()->isIndividual() && $formField->field_label == "Middle Name")
                <input type="{{ $formField->fieldType->field_type }}" class="form-control form-control-solid"
                    id="{{$formField->lable_name}}" placeholder="{{ $formField->field_label }}"
                    name="{{str_replace(' ', '_', $formField->field_label)}}"
                    value="{{$user->userDetails->Middle_Name}}" readonly>
                @elseif(auth()->user()->isIndividual() && $formField->field_label == "Last Name")
                <input type="{{ $formField->fieldType->field_type }}" class="form-control form-control-solid"
                    id="{{$formField->lable_name}}" placeholder="{{ $formField->field_label }}"
                    name="{{str_replace(' ', '_', $formField->field_label)}}" value="{{$user->userDetails->Last_Name}}"
                    readonly>
                @elseif(auth()->user()->isIndividual() && $formField->field_label == "Passport Number")
                <input type="{{ $formField->fieldType->field_type }}" class="form-control form-control-solid"
                    id="{{$formField->lable_name}}" placeholder="{{ $formField->field_label }}"
                    name="{{str_replace(' ', '_', $formField->field_label)}}" value="{{$user->userDetails->Passport}}"
                    readonly>
                @elseif(auth()->user()->isIndividual() && $formField->field_label == "ID or Residence Number")
                <input type="{{ $formField->fieldType->field_type }}" class="form-control form-control-solid"
                    id="{{$formField->lable_name}}" placeholder="{{ $formField->field_label }}"
                    name="{{str_replace(' ', '_', $formField->field_label)}}" value="{{$user->userDetails->Residency}}"
                    readonly>
                @else
                <input type="{{ $formField->fieldType->field_type }}" class="form-control form-control-solid"
                    id="{{$formField->lable_name}}" placeholder="{{ $formField->field_label }}"
                    name="{{str_replace(' ', '_', $formField->field_label)}}"
                    value="{{($check_basic)? $basic_data->form_data[str_replace(' ', '_', $formField->field_label)] :''}}"
                    required>
                @endif
            </div>


            @elseif($formField->fieldType->field_type == "select-profession")
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                <select name="profession_id" id="profession_id" data-control="" {{($check_basic)?'disabled':''}}
                    class="form-select form-select-solid form-select-lg fw-semibold">
                    @foreach($professions as $key=>$profession)
                    @if($check_basic)
                    <option value="{{$profession->id}}"
                        {{($application->profession_id == $profession->id)?'selected':''}}>
                        {{ $profession->profession }}
                    </option>
                    @else
                    <option value="{{$profession->id}}">{{ $profession->profession }}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            @elseif($formField->fieldType->field_type == "select-subprofession")
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                <select name="subprofession" id="subprofession" data-control=""
                    class="form-select form-select-solid form-select-lg fw-semibold">
                    @foreach($subProfessions as $key=>$subProfession)
                    @if($check_basic)

                    <option value="{{$subProfession->sub_profession}}"
                        {{($subProfession->sub_profession == $basic_data->form_data['subprofession'])?'selected':''}}>
                        {{ $subProfession->sub_profession }}</option>
                    @else
                    <option value="{{$subProfession->sub_profession}}">{{ $subProfession->sub_profession }}</option>
                    @endif
                    @endforeach
                </select>
            </div>


            @elseif($formField->fieldType->field_type == "select-country")
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                <select name="country_id" id="country_id" data-control=""
                    class="form-select form-select-solid form-select-lg fw-semibold" {{($check_basic)?'disabled':''}}>
                    @foreach($countries as $key=>$country)
                    @if($check_basic)
                    <option value="{{$country->id}}" {{($country->id == $application->country_id)?'selected':''}}>
                        {{ $country->country_name }}</option>
                    @else
                    <option value="{{$country->id}}">{{ $country->country_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>


            @elseif($formField->fieldType->field_type == "select-nationality")
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                <select name="nationality" id="nationality" aria-label="Select a Nationality" data-control=""
                    data-placeholder="Select a Nationality..."
                    class="form-select form-select-solid form-select-lg fw-semibold js-example-basic-single">
                    @foreach($countries as $key=>$nationality)
                    @if($check_basic)
                    <option value="{{$nationality->nationality}}"
                        {{($nationality->nationality == $basic_data->form_data['nationality'])?'selected':''}}>
                        {{ $nationality->nationality }}</option>
                    @else
                    <option value="{{$nationality->nationality}}">{{ $nationality->nationality }}</option>
                    @endif
                    @endforeach
                </select>
            </div>


            @elseif($formField->fieldType->field_type == "select")
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                <select id="{{str_replace(' ', '_', $formField->field_label)}}"
                    name="{{str_replace(' ', '_', $formField->field_label)}}" data-control=""
                    class="form-select form-select-solid form-select-lg fw-semibold">
                    @foreach($formField->fieldOption->option_value as $key=>$value)
                    @if($check_basic)
                    <option value="{{$value}}"
                        {{($value == $basic_data->form_data[str_replace(" ", "_", $formField->field_label)])?'selected':''}}>
                        {{$value}}</option>
                    @else
                    <option value="{{$value}}">{{$value}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            @elseif($formField->fieldType->field_type == "radio")
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                @foreach($formField->fieldOption->option_value as $key=>$value)
                @if($check_basic)
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="{{$value}}"
                        id="{{str_replace(' ', '_', $formField->field_label)}}"
                        name="{{str_replace(' ', '_', $formField->field_label)}}" required="required"
                        {{($value == $basic_data->form_data[str_replace(" ", "_", $formField->field_label)])?'checked':''}}>
                    <label class="form-check-label" for="defaultCheck1">
                        {{$value}}
                    </label>
                </div>
                @else
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="{{$value}}"
                        id="{{str_replace(' ', '_', $formField->field_label)}}"
                        name="{{str_replace(' ', '_', $formField->field_label)}}" required>
                    <label class="form-check-label" for="defaultCheck1">
                        {{$value}}
                    </label>
                </div>
                @endif
                @endforeach
            </div>

            @elseif($formField->fieldType->field_type == "checkbox")
            <div class="col-md-6 p-5 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-5">
                    <span class="required">{{ $formField->field_label }}</span>
                </label>
                @foreach($formField->fieldOption->option_value as $key=>$value)
                @if($check_basic)

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="{{$value}}"
                        id="{{str_replace(' ', '_', $formField->field_label)}}"
                        name="{{str_replace(' ', '_', $formField->field_label)}}[]" required="required"
                        {{( array_search($value, $basic_data->form_data[$formField->lable_name] ,true) === 0 || array_search($value, $basic_data->form_data[$formField->lable_name] ) != false ) ? 'checked' : ''}}>
                    <label class="form-check-label" for="defaultCheck1">
                        {{$value}}
                    </label><br>
                </div>
                @else
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$value}}"
                        id="{{str_replace(' ', '_', $formField->field_label)}}"
                        name="{{str_replace(' ', '_', $formField->field_label)}}[]" required="required">
                    <label class="form-check-label" for="defaultCheck1">
                        {{$value}}
                    </label>
                </div>
                @endif
                @endforeach
            </div>

            @endif
            @endforeach

            <div class="pt-10" style="text-align: right !important;">
                <button type="submit" class="btn btn-lg btn-primary nxt__btn pull-right" onclick="addBasic('00','0')">
                    Next
                    <span class="svg-icon svg-icon-4 ms-1 me-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                transform="rotate(-180 18 13)" fill="currentColor" />
                            <path
                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>