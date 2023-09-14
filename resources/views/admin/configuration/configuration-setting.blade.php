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
                    <h4 class="card-title">{{ $thirdPartyConfiguration->third_party }} Settings</h4>
                    <p class="card-description">You can change basic setting information related to system from below section</p>
                    <form class="forms-sample" action="{{ route('configuration-settings.update', ['configuration_setting' => $thirdPartyConfiguration->id ]) }}" method="post">
                      @csrf
                      @method('PUT')

                      <div class="form-group row">
                     @foreach($thirdPartyConfiguration->config_value as $key=>$config_property)
                      <div class="col-md-6 mt-3">
                        <label>{{ str_replace("_"," ",$key) }}</label>
                        <div id="the-basics">
                          <input class="form-control" type="text"  id="{{ $key }}" name="{{ $key }}" value="{{ $config_property }}">
                        </div>
                      </div>

                      @endforeach
                      </div>

                      <button type="submit" class="btn btn-primary mr-2"> Update </button>

                    </form>
                  </div>
                </div>
              </div>
@endsection
