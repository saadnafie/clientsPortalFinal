<style>
.text-right {
    float: right;
}
</style>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card">
            <div class="card-body p-2">
                <div class="mw-lg-950px mx-auto w-100">

                    <div class="d-flex justify-content-between flex-column flex-sm-row p-2 px-6">
                        <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>
                        @php echo DNS2D::getBarcodeHTML($application->application_serial, 'QRCODE',5,5); @endphp
                        <div class="text-sm-end">
                            <a href="#" class="d-block mw-150px ms-sm-auto">
                                <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="w-100" />
                            </a>
                            <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                                <!-- <div> One Central, DWTC Level 3, The offices 3
                                </div>
                                <div>دبي - الإمارات العربية المتحدة</div> -->

                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="d-flex flex-column gap-7 gap-md-10">
                            <div class="separator"></div>
                            <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Billing To</span>
                                    <span class="fs-5">{{ Auth()->user()->name }}</span>
                                </div>
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Application ID</span>
                                    <span class="fs-5">#{{ $application->application_serial }}</span>
                                </div>
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Issued Date</span>
                                    <span class="fs-5">{{ now() }}</span>
                                </div>
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Status</span>
                                    <span class="fs-5"><span class="badge badge-warning">Unpaid</span></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between flex-column">
                                <div class="table-responsive border-bottom mb-2">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <thead>
                                            <tr class="border-bottom fs-6 fw-bold text-muted">
                                                <th class="pb-2">#</th>
                                                <th class="pb-2">Main Credentials</th>
                                                <th class="pb-2">Quantity</th>
                                                <th class="text-end pb-2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600" id="basic_credential_price">

                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <thead id="additionalCredentialTableShow">
                                            <tr class="border-bottom fs-6 fw-bold text-muted">
                                                <th class="pb-2">#</th>
                                                <th class="pb-2"> Additional Credentials</th>
                                                <th class="pb-2">Quantity</th>
                                                <th class="pb-2">price/item</th>
                                                <th class="text-end pb-2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600" id="additional_credential_price">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <br>

            <div class="d-flex flex-stack p-2">
                <div class="mr-2">
                    <button type="button" class="btn btn-lg btn-light-primary me-3 prev__btn" onclick="prevForm();">
                        <span class="svg-icon svg-icon-4 me-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
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
                    <button type="button" class="btn btn-lg btn-success " onclick="showPaymentMethod();">
                        Pay Now
                        <span class="svg-icon svg-icon-4 ms-1 me-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
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
    </div>
</div>