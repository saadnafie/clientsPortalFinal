<div class="w-100 p-3">
    <div class="p-6">
        <h2 class="fw-bold text-dark">Documents</h2>
        <div class="text-muted fw-semibold fs-6">
            Please provide all required documents
        </div>
    </div>
    <div class="d-flex flex-column fv-row p-6">
        <form method="post" id="basic_document" name="basic_document" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="0" name="app_id" id="app_basic_id">
            @foreach($basic_files->formFields as $key=>$file)

            <div class="overflow-auto pb-5">
                <div
                    class="notice d-flex bg-light-primary rounded border-primary border border-dashed flex-shrink-0 p-4">
                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <div class="mb-3 mb-md-0 fw-semibold">
                            <h4 class="text-gray-900 fw-bold">
                                {{$file->field_label}}
                            </h4>
                        </div>
                        <input type="file" id="images" name="{{$file->lable_name}}" required>
                    </div>
                    @if($basic_files->applicationDetail->count() > 0 && $basic_files->applicationDetail[0]->file_data !=
                    null)
                    <span>{{$basic_files->applicationDetail[0]->file_data[$file->lable_name]}}</span>
                    @endif
                </div>
            </div>

            @endforeach
            <div class="  ">
                <button type="submit" class="btn btn-success " style="float:right"
                    onclick="saveDocument('basic_document')">Save Main Documents</button>
            </div>

        </form>
        <hr>
    </div>

    <table class="table main" id="dynamicTable">

    </table>


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
            <button type="button" class="btn btn-lg btn-primary nxt__btn" onclick="documentStep();">
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