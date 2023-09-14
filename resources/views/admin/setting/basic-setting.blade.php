@extends('admin.layouts.header')
@section('content')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <!--<div class="page-header flex-wrap">
              <div class="header-left">
                Basic Settings
              </div>
            </div>-->

            <!-- Form card row starts here -->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Basic Settings</h4>
                    <p class="card-description">You can change basic setting information related to system from below section</p>
                    <form class="forms-sample" action="{{route('update-basic-setting')}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$basicSetting->name}}" required/>
                      </div>

                      <div class="form-group">
                        <label>Logo</label>
                        <input type="file" id="logo" name="logo" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="footer_text">Footer Text</label>
                        <input type="text" class="form-control" id="footer_text" name="footer_text" value="{{$basicSetting->footer_text}}" required/>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">System Language</label>
                        <select class="form-control" id="default_language" name="default_language" required>
                          <option value="en" {{($basicSetting->default_language == "en")?'selected':''}}>English</option>
                          <option value="ar" {{($basicSetting->default_language == "ar")?'selected':''}}>Arabic</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">System Currency</label>
                        <select class="form-control" id="default_currency" name="default_currency" required>
                          <option value = "usd" {{($basicSetting->default_currency == "usd")?'selected':''}}>Dollars (USD $)</option>
                          <option value = "sar" {{($basicSetting->default_currency == "sar")?'selected':''}}>Riyals (SAR ﷼)</option>
                          <option value = "egp" {{($basicSetting->default_currency == "egp")?'selected':''}}>Pounds (EGP £)</option>
                          <<option value = "eur" {{($basicSetting->default_currency == "eur")?'selected':''}}>Euro (EUR €)</option>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-primary mr-2"> Update </button>

                    </form>
                  </div>
                </div>
              </div>
@endsection
