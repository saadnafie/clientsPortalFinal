<style>
div.item {
    vertical-align: top;
    display: inline-block;
    text-align: center;
    width: 120px;
}


.caption {
    display: block;
}
</style>
<div class="input__container review_main" id="review_main">

</div>


<div class="d-flex flex-stack pt-10 p-3">
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
        <button type="button" class="btn btn-lg btn-primary nxt__btn" onclick="reviewStep();">
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