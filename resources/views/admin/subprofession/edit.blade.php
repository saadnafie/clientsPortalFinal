@extends('admin.layouts.header')
@section('content')


          <!-- partial -->
          <div class="main-panel">
            <div class="content-wrapper pb-0">
              <div class="page-header flex-wrap">

              <div class="header-left">
                <!--<button class="btn btn-primary mb-2 mb-md-0 mr-2"> Create new document </button>
                <button class="btn btn-outline-primary bg-white mb-2 mb-md-0"> Import documents </button>-->
              </div>

              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
              <!--  <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Profession </button>-->
              </div>
            </div>

              <div class="row">
              <!-- Form card row starts here -->
              <div class="col-md-12 grid-margin stretch-card">

              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit SubProfession</h4>
                    <p class="card-description"> Update SubProfession
                    </p>

                    <form class="forms-sample" action="{{ route('subprofessions.update', $subprofession->id) }}" method="post">
                      @csrf
                      @method('PUT')

                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <select class="form-control" id="profession" name="profession">
                          @foreach($professions as $key=>$profession)
                              <option value="{{ $profession->id }}" {{ ($profession->id == $subprofession->profession_id) ? 'selected' : '' }}>{{ $profession->profession }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subprofession">Sub Profession</label>
                        <input type="text" class="form-control" id="subprofession" name="subprofession" value="{{ $subprofession->sub_profession }}" required/>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2"> Edit </button>
                  </form>

                  </div>
                </div>
                </div>
                </div>
                </div>



@endsection
