@extends('admin.main.main')

@section('admin-content')

<style>
    .block {
        box-shadow: 0px 0px 10px rgb(171, 161, 161);
    }

    .btn-submit {
        letter-spacing: 1px;
        font-weight: 400;
        border: 1px solid #f38f21;
        color: #f38f21;
        margin: 0px;
        padding: 6px 14px;
        border-radius: 9px;
        vertical-align: top;
        display: inline-block;
        background: transparent;
        text-transform: uppercase;
        text-decoration: none;
        font-family: 'Silka-SemiBold';
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #f38f21;
        color: #fff !important;
    }

    .btn-reset {
        border: 1px solid #f44336;
        /* Red border */
        color: #f44336;
        /* Red text */
    }

    .btn-reset:hover {
        background-color: #f44336;
        /* Red background on hover */
        color: #fff !important;
        /* White text on hover */
    }
</style>

@if (Session::has('success'))
<div class="alert alert-success" role="alert" id="success-message">
    {{Session::get('success')}}
</div>
@endif

@if(session('fail'))        
  <div class="alert alert-danger" id="error-message">
      {{session('fail')}}
  </div>          
@endif

<h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-SemiBold; letter-spacing:1px">
    <b>Edit Vendor Registration Form</b></h4>

<div class="container block mt-4 mb-4">
    <form action="{{ url('edit-vendor-registration-detail') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <p></p>
                    <h6>Vendor Entity Name</h6>
                    
                    <input type="hidden" name="id" value="{{$vendorDetail->id}}">
    
                    <input type="text" class="form-control" id="entityName"
                    value="{{ $vendorDetail->vendor_name }}" name="vendor_name">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <p></p>
                    <h6>Vendor Email</h6>
                    <input type="email" class="form-control" id="entityName"
                    value="{{ $vendorDetail->email}}" name="email">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <h6>GSTIN</h6>
                    <input type="number" class="form-control" id="entityName"
                    value="{{ $vendorDetail->gstin }}" name="gstin">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <h6>Contact Person</h6>
                    <input type="text" class="form-control" id="entityName"
                    value="{{ $vendorDetail->contact_person }}" name="contact_person">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <h6>Phone Number</h6>
                    <input type="text" class="form-control" id="entityName"
                    value="{{ $vendorDetail->phone_number }}" name="phone_number">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <h6>Brands Supplied</h6>
                    <input type="number" class="form-control" id="entityName"
                    value="{{ $vendorDetail->brands }}" name="brands">
                </div>
            </div>

          

        </div>
        <button type="submit" class="btn-submit btn-report mr-3 mb-3">Report</button>
        {{-- <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button> --}}
    </form>
</div>


<script>
   setTimeout(function() {
        $('#success-message').fadeOut('fast')
    },4000);

    setTimeout(function() {
        $('#error-message').fadeOut('fast')
    },4000);
</script>
@endsection