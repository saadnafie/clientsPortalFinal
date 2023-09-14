<!DOCTYPE html>
<html lang="en">
<head>
  <title>Application Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 100%;
}
td {
  text-align: center;
  height: 30px;
  vertical-align: center;
}
    </style>
</head>
<body>

<div class="container">
  <center>
  <h2>INVOICE</h2>
  <p>Your application invoice details</p>
  @php echo DNS2D::getBarcodeHTML($application->application_serial, 'QRCODE',4,4); @endphp
    </center>
  <p>
    To: {{auth()->user()->name}} <br>
    ID: {{$application->application_serial}} <br>
    Issued Date: {{$invoice->created_at}} <br>
    status: Paid
  </p>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Main Credentials</th>
        <th>Quantity</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($credentials as $key=>$credential)
      @if($key > 0)
      <tr>
        <td>{{$key}}</td>
        <td>{{$credential->credential_type}}</td>
        @if($credential->id == 5 && $invoice->checkEmploymentExist)
        <td>1</td>
        @else
        <td>{{$credential->rule->certificates_number}}</td>
        @endif
        @if($key == 1)
        <td rowspan="{{$credentials->count() - 1}}" style="vertical-align: center;">${{$invoice->base_cost_val }}</td>
        @endif
      </tr>
      @endif
      @endforeach

    </tbody>
  </table>


<br>
@php $check = false; $additionalTotal =0; @endphp
@foreach($credentials as $key=>$credential)
@if($key > 0)
@php $qty = $credential->applicationDetail->count() - $credential->rule->certificates_number; @endphp
  @if($credential->id == 5 && $invoice->checkEmploymentExist)
    @php $qty -= 1; @endphp
  @endif
  @if($qty > 0)
  @php $check = true; @endphp
  @endif
  @endif
  @endforeach
@if($check)
  <table class="table table-striped" id="ifExistShow">
    <thead>
      <tr>
        <th>#</th>
        <th>Additional Credentials</th>
        <th>Quantity</th>
        <th>price/item</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($credentials as $key=>$credential)
        @if($key > 0)
          @php $qty = $credential->applicationDetail->count() - $credential->rule->certificates_number; @endphp
          @if($credential->id == 5 && $invoice->checkEmploymentExist)
            @php $qty -= 1; @endphp
          @endif
          @if($qty > 0)
          @php $additional = $credential->credential_cost * $qty; @endphp
          @php $additionalTotal  +=$additional; @endphp
          <tr>
            <td>{{$key}}</td>
            <td>{{$credential->credential_type}}</td>
            <td>{{$qty}}</td>
            <td>${{$credential->credential_cost}}</td>
            <td>${{$additional}}</td>
          </tr>
          @endif
        @endif
      @endforeach
      @if($additionalTotal == 0)
      <tr>
            <td colspan="5">-</td>
      </tr>
      @endif

    </tbody>
  </table>
  @endif

<br><br>
      <hr>
      <p>
        Main Cost: <span style="float:right;">${{$invoice->base_cost_val}}</span> 
      </p>
      <p>
        Additional Cost: <span style="float:right;">${{$additionalTotal}}</span>
      </p>
      <hr>
      <p>
        Total Amount: <span style="float:right;">${{$invoice->total_cost}}</span>
      </p>
      <hr>
</div>

</body>
</html>
