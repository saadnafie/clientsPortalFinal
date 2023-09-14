@php $condition = 0; $condition_count = 0; @endphp
<div class="w-100 p-3">
    <div class="mb-10 fv-row  ">
        <label class="d-flex align-items-center form-label p-3">Specify credential numbers
            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                title="Specify how many credentials you want to submit"></i></label>
        <div class="row">
            @foreach($rule as $key=>$credential)
            @php $condition_count += $credential->certificates_number; @endphp
            <div class="col-md-3 col-sm-6">
                <div class="card csg-border-color">
                    <div class="card-body text-center" style="padding: 0px;">
                        <img src="{{ url('certificate.png')}}" width="100px">
                        <br>
                        <small><b>{{$credential->credential->credential_type}}</b></small>
                        <br>


                        <div class="input-group"
                            style="width:fit-content;margin-left: auto;margin-right: auto; padding-bottom: 5px;">
                            <span class="input-group-btn">
                                <button type="button" class="btn  btn-sm btn-dark" id="decrease{{$key}}"
                                    onclick="decreaseValue({{$key}}, {{$credential->certificates_number}})">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </span>
                            <input type="number" id="number{{$key}}" class="form-control form-control-sm text-center"
                                value="{{($credential->certificates_number < $credential->credential->applicationDetail->count())? $credential->credential->applicationDetail->count() : $credential->certificates_number}}"
                                min="{{$credential->certificates_number}}" max="10" readonly>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-dark" id="increase{{$key}}"
                                    onclick="increaseValue({{$key}}, '{{$rule}}', '{{$countries}}');">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mb-0 fv-row">
        <label class="d-flex align-items-center form-label px-6">Please complete all mandatory fields in each
            credential
            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please complete all mandatory fields in each
            credential"></i></label>
        <hr>
        <div class="mb-0">
            @php $detail =''; @endphp
            @foreach($rule as $key=>$credential)
            <div class="accordion" id="accordion{{$key}}">
                <label class="d-flex align-items-center form-label p-6"> {{$credential->credential->credential_type}}
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                        title="{{$credential->credential->credential_type}}"></i></label>


                @if($credential->credential->applicationDetail->count() > 0)
                @foreach($credential->credential->applicationDetail as $i=> $detail)
                <div class="accordion-item">
                    <h2 class="accordion-header accordion-header-change-{{$key}}{{$i}}" id="kt_accordion_1_header_1">
                        <button id="additionalAccordionButton{{$key}}{{$i}}" class="accordion-button fs-4 fw-semibold"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}{{$i}}"
                            aria-expanded="false" aria-controls="collapseOne{{$key}}{{$i}}">
                            {{$credential->credential->credential_type}} #{{$i+1}}
                        </button>
                    </h2>
                    <div id="collapseOne{{$key}}{{$i}}"
                        class="accordion-collapse collapse border border-danger border-1"
                        aria-labelledby="collapseOne{{$key}}{{$i}}" data-bs-parent="#accordion{{$key}}">
                        <div class="accordion-body">
                            @include('customer.application_process.components.add-credential')
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                @php $detail =''; @endphp

                @if($credential->credential->applicationDetail->count() < $credential->certificates_number)
                    @for($i = $credential->credential->applicationDetail->count() ; $i < $credential->
                        certificates_number ;$i++ )

                        <div class="accordion-item">
                            <h2 class="accordion-header accordion-header-change-{{$key}}{{$i}}"
                                id="kt_accordion_1_header_1">
                                <button id="additionalAccordionButton{{$key}}{{$i}}"
                                    class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne{{$key}}{{$i}}" aria-expanded="false"
                                    aria-controls="collapseOne{{$key}}{{$i}}">
                                    {{$credential->credential->credential_type}} #{{$i+1}}
                                </button>
                            </h2>
                            <div id="collapseOne{{$key}}{{$i}}"
                                class="accordion-collapse collapse border border-danger border-1"
                                aria-labelledby="collapseOne{{$key}}{{$i}}" data-bs-parent="#accordion{{$key}}">
                                <div class="accordion-body">
                                    @include('customer.application_process.components.add-credential')
                                </div>
                            </div>
                        </div>
                        @endfor
                        @endif
                        <span id="additinal_credential_{{$key}}">
                        </span>
            </div>

            @endforeach
        </div>
    </div>

    <div class="d-flex flex-stack pt-10">
        <div class="mr-2">
            <button type="button" class="btn btn-lg btn-light-primary me-3 prev__btn" onclick="prevForm();">
                <span class="svg-icon svg-icon-4 me-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
                        <path
                            d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                            fill="currentColor" />
                    </svg>
                </span>
                Back
            </button>
        </div>
        <div>
            <button type="button" class="btn btn-lg btn-primary nxt__btn" onclick="credentialStep();">
                Continue
                <span class="svg-icon svg-icon-4 ms-1 me-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)"
                            fill="currentColor" />
                        <path
                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </button>
        </div>
    </div>
</div>