<!-- Sweet alert-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


@if(Session::has('success'))
  <script>
     toastr.success(" {{ Session::get('success') }} ");
  </script>
@endif

@if(Session::has('error'))
  <script>
     toastr.error(" {{ Session::get('error') }} ");
  </script>

@endif

@if(Session::has('warning'))
  <script>
     toastr.warning(" {{ Session::get('warning') }} ");
  </script>
@endif
