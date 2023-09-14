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
                    <h4 class="card-title">Edit Form Field</h4>
                    <p class="card-description"> Update Form Field
                    </p>

                    <form class="forms-sample" action="{{ route('formFields.update', $formField->id) }}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                          <label for="credential">Field Label</label>
                          <input type="text" class="form-control" id="field_label" name="field_label" value="{{$formField->field_label}}" required/>
                      </div>
                      <div class="form-group">
                        <label for="Field">Field Type</label>
                        <select class="form-control" id="type_id" name="type_id" disabled>
                        @foreach($fieldTypes as $key=>$fieldType)  
                          <option value="{{ $fieldType->id }}" {{ ($fieldType->id == $formField->type_id) ? 'selected':'' }}>{{ $fieldType->field_type }}</option>
                        @endforeach
                        </select>
                      </div>


                        <div id="optionControlShow" style="display:{{ ($formField->fieldOption != null) ? 'block' : 'none' }};">
                            <div class="card bg-light text-dark">
                                <div class="card-body">
                                    <h6>Options Control: 
                                      <button type="button" class="btn btn-info mr-2 pull-right" onclick="addRows()"><i class="mdi mdi-plus" ></i></button></h6>
                                    <br>
                                        <table class="table table-hover" id="optionTable">
                                              <thead>
                                                <tr>
                                                  <th>Options Value</th>
                                                  <th>Settings</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @if($formField->fieldOption != null)
                                                @foreach($formField->fieldOption->option_value as $optVal)
                                                <tr>
                                                  <td id="col0"><input type="text"  class="form-control" name="optionsVal[]" value="{{ $optVal }}" required></td>
                                                  <td id="col1"><button type="button" class="btn btn-danger mr-2" onclick="deleteRows()" ><i class="mdi mdi-delete" ></i></button></td>
                                                </tr>
                                                @endforeach
                                                @endif
                                              </tbody>
                                        </table>
                                        <br><br>
                              </div>
                          </div>
                      </div>
                      


                    <button type="submit" class="btn btn-primary mr-2"> Edit </button>
                  </form>

                  </div>
                </div>
                </div>
                </div>
                </div>

  <script type="text/javascript">
  function addRows(){ 
    var table = document.getElementById('optionTable');
    var rowCount = table.rows.length;
    var cellCount = table.rows[2].cells.length; 
    var row = table.insertRow(rowCount);
    for(var i =0; i <= cellCount; i++){
      var cell = 'cell'+i;
      cell = row.insertCell(i);
      var copycel = document.getElementById('col'+i).innerHTML;
      cell.innerHTML=copycel;
      
    }
  }

  function deleteRows(){
    var table = document.getElementById('optionTable');
    var rowCount = table.rows.length;
    if(rowCount > '3'){
      var row = table.deleteRow(rowCount-1);
      rowCount--;
    }
    else{
      alert('There should be at least two options');
    }
  }

  function getFieldType()
  {
    var selectElemnt = document.getElementById("fieldType");
    var selectTextValue = selectElemnt.options[selectElemnt.selectedIndex].text;
    console.log(selectTextValue);
    if(selectTextValue === "select" || selectTextValue === "radio" || selectTextValue === "checkbox")
      document.getElementById('optionControlShow').style.display = "block";
    else
      document.getElementById('optionControlShow').style.display = "none";
  }
</script>

@endsection
