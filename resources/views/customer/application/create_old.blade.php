<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Application') }}
        </h4>
    </x-slot>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">


    </head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- MultiStep Form -->
                    <div class="container">
                      <h4> Start New Application </h4>
                      <hr>
                          <div class="row">
                            <form action="{{route('application-processes.store')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <br>

                              <div class="tab" id="step1">
                                <center>
                                <h3><b>Are you a Physician ?</b></h3><br>
                                <div class="form-check-inline">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" oninput="this.className = ''" id="physician_val_yes" name="physician_val" value="true" style="height:35px;width:35px;vertical-align:middle;" checked>&nbsp; <span style="font-size:25px;">Yes</span>
                                  </label>
                                </div>
                                <div class="form-check-inline">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" oninput="this.className = ''" id="physician_val_no" name="physician_val" value="false" style="height:35px;width:35px;vertical-align:middle;">&nbsp; <span style="font-size:25px;">No</span>
                                  </label>
                                </div>
                                <br><br><br><br>
                                <h3><b>Are you a Equivalency ?</b></h3><br>
                                <div class="form-check-inline">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" oninput="this.className = ''" id="equivalency_val_yes" name="equivalency_val" value="true" style="height:35px;width:35px;vertical-align:middle;" checked>&nbsp; <span style="font-size:25px;">Yes</span>
                                  </label>
                                </div>
                                <div class="form-check-inline">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" oninput="this.className = ''" id="equivalency_val_no" name="equivalency_val" value="false" style="height:35px;width:35px;vertical-align:middle;">&nbsp; <span style="font-size:25px;">No</span>
                                  </label>
                                </div>
                              </center>
                              <br><br>
                              <button type="button" class="btn btn-primary" onclick="display_next_step()">Next<button>
                              </div>

                              <div class="tab" id="step2">
                              <h4> Do you have license issues with MOHK ?</h4>
                              <br>
                              <div class="form-check">
                               <label class="form-check-label" for="application_type">
                                 <input type="radio" class="form-check-input" id="application_type_new" onclick="display_license_detail()" name="application_type" style="height:25px;width:25px;vertical-align:middle;" value="1" checked>&nbsp; <span style="font-size:25px;">No</span>
                               </label>
                               </div>
                               <div class="form-check">
                                 <label class="form-check-label" for="application_type">
                                   <input type="radio" class="form-check-input" id="application_type_renew" onclick="display_license_detail()" name="application_type" style="height:25px;width:25px;vertical-align:middle;" value="2">&nbsp; <span style="font-size:25px;">Yes</span>
                                 </label>
                               </div>
                                <br><br>
                                <div id="license_detail">
                                  <div class="form-group">
                                    <label for="usr">license No:</label>
                                    <input type="text" class="form-control" name="license_no">
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Issue Date:</label>
                                    <input type="date" class="form-control" name="issue_date">
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Expiry Date:</label>
                                    <input type="date" class="form-control" name="expiry_date">
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Upload license:</label>
                                    <input type="file" class="form-control" name="license_file" disabled>
                                  </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Next</button>
                              </div>
                              </form>
                          </div>
                      </div>
  <!-- /.MultiStep Form -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script>
$(document).ready(function(){
    document.getElementById("license_detail").style.display = "none";

    var accountType = "{{ auth()->user()->isCompany()}}";
    console.log(accountType);
    if(accountType == true){
      document.getElementById("step1").style.display = "block";
      document.getElementById("step2").style.display = "none";
    }else{
      document.getElementById("step1").style.display = "none";
      document.getElementById("step2").style.display = "block";
    }
});

function display_license_detail() {
  if(document.getElementById('application_type_renew').checked){
    document.getElementById("license_detail").style.display = "block";
  }else{
    document.getElementById("license_detail").style.display = "none";
  }
}

function display_next_step(){
    if(document.getElementById('physician_val_no').checked && document.getElementById('equivalency_val_no').checked){
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
      }else{
        window.location.href = "{{ url('notqualified') }}";
      }
}



</script>
