<div class="w-100 p-3">
    <div class="pb-2 pb-lg-2">
        <h2 class="p-6 fw-bold text-dark text-center">
            Letter of Authorization
        </h2>
        <div class="p-6 text-muted fw-semibold fs-6">
            <p class="text-justify">
                I the undersigned, authorize Optimum
                Verification Company, and its authorized
                affiliates, agents, and subsidiaries, to
                verify my information and documents which
                includes Educational and employment
                certificates.
            </p>
            <p class="text-justify">
                Based on this letter, I hereby grant the
                authority for the bearer of this letter, with
                immediate effect to release all necessary
                information, to the official authorized to
                conduct the verification process, and I
                acknowledge and agree to all the services
                provided by Optimum Verification Company for
                data verification and data validation
                services.
            </p>
            <p class="text-justify">
                This information / documentation may contain
                grades, dates of attendance, grade point
                average, degree / diploma certification,
                letter of employment, employment title,
                employment tenure, license attained, status of
                the license, place of issue I also pledge that
                all the data provided below are correct.
            </p>
            <p class="text-justify">
                I hereby release all persons or entities
                requesting or supplying such information from
                any liability arising from such disclosure. I
                confirm and acknowledge that a photocopy of
                this authorization be accepted with the same
                authority as the original.
            </p>
            <p class="text-justify">
                I acknowledge the right for the Information
                Recipient to disclose my information to any
                relevant third party.
            </p>
            <p class="text-justify">
                I acknowledge that I have read the
                authorization letter, and I pledge to bring
                and deliver clear copy of documents incase its
                requested by the company, and it should be
                within 20 working days maximum.
            </p>
        </div>
    </div>
    <div class="fv-row pb-1 mb-1">
        <div class="row show-loa">
            <div class="row">
                <div class="col">
                    <div class="p-0  text-center show-loa-file">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="p-0  text-center ">
                        <button class="btn btn-warning" id="change-loa"><i class="fa fa-edit"></i>Update Your Letter of
                            Authorization</button>
                        <input type="hidden" value="{{ $application->id }}" name="app_id" id="app_id">
                        <input type="hidden" value="{{ $application->loa_pdf }}" name="loaFileExist" id="loaFileExist">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />

                    </div>
                </div>
            </div>
        </div>
        <div class="row show-signature">
            <div class="col">
                <form name="letter_auth" id="letter_auth" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="isSubmitted" id="isSubmitted" value="Yes">
                    <input type="hidden" value="{{ $application->id }}" name="application_id">
                    <label class="p-6 d-flex justify-content-center form-label mb-1 text-center">Please enter your own
                        signature
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Please enter your own signature"></i></label>

                    <div class="p-0  text-center">
                        <canvas class="p-0 canvas-width" id="signature" width="350" height="150"
                            style="border: 1px solid #ddd;" onChange="checkSignature()"></canvas>
                        <small><span class="p-6  d-flex text-center">
                                <div class="error_signature_en p-0 d-flex justify-content-center  mb-1 text-center">
                                </div>
                            </span></small>
                        <span class="d-flex pt-0 justify-content-center">
                            <div class="px-8">
                                <button id="clear-signature" class="btn btn-danger btn-sm">Clear</button>
                            </div>
                            <div class="px-8">
                                <input type='hidden' id='outputBase64FormInput' name='mybase64image'>
                                <div class="row text-center">
                                    <div class="col-12 padding-left-custom">
                                        <button class="btn btn-success btn-sm" id="btn-save"> <span
                                                class="fas fa-save fa-sm"></span>
                                            Save</button>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>

                </form>
            </div>
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
            <button type="button" class="next-loa btn btn-lg btn-primary nxt__btn" onclick="loaStep();">
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