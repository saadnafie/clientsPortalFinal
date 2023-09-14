@extends('layouts/master-with-nav')
@section('main-title')
Search Application
@endsection

@section('username')
{{auth()->user()->name}}
@endsection

@section('page-style')
@endsection

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

        </div>
    </div>
</div>

@endsection

@section('page-script')
@endsection