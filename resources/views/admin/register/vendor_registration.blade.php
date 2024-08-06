@extends('user.main.main')


@section('user-content')
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
            {{ Session::get('success') }}
        </div>
    @endif

    @if (session('fail'))
        <div class="alert alert-danger" id="error-message">
            {{ session('fail') }}
        </div>
    @endif

    <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Vendor Registration</b></h3>

    <div class="container block mt-4 mb-4">
        <form action="{{ url('request-report') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Vendor Trade Name</b></label>
                        <input type="text" class="form-control" id="entityName" name="vendor_name" placeholder="Enter vendor trade name">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Legal Name (As per GST/PAN)</b></label>
                      <input type="text" class="form-control" id="entityName" name="legal_name" placeholder="Enter your legal name">
                    </div>
                </div>

                <h5 class="text-center mt-2"><b>Address</b></h5>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Street/House No :</b></label>
                      <input type="text" class="form-control" id="entityName" name="street_no" placeholder="Enter your street/House number">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Postal Code/City</b></label>
                      <input type="text" class="form-control" id="entityName" name="postal_code" placeholder="Enter your postal code/city">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Country</b></label>  
                      <input type="text" class="form-control" id="entityName" name="country_name" placeholder="Enter you country name">
                    </div>
                </div>

                <h5 class="text-center mt-2"><b>Communication</b></h5>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Telephone</b></label>
                      <input type="text" class="form-control" id="entityName" name="telephone_number" placeholder="Enter your telephone number">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Mobile No.1</b></label>
                      <input type="text" class="form-control" id="entityName" name="mobile_number1" placeholder="Enter your mobile number">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Contact Person</b></label>
                      <input type="text" class="form-control" id="entityName" name="contact_person1" placeholder="Enter your contact person">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Mobile No.2</b></label>
                      <input type="text" class="form-control" id="entityName" name="mobile_number2" placeholder="Enter your alternate mobile number">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Contact Person</b></label>
                      <input type="text" class="form-control" id="entityName" name="contact_person2" placeholder="Enter your contact person">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>E-Mail</b></label>
                      <input type="email" class="form-control" id="entityName" name="email" placeholder="Enter your Email-Id">
                    </div>
                </div>
              

                <h5 class="text-center mt-2"><b>TAX Information</b></h5>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>GST Number</b></label>
                      <input type="text" class="form-control" id="entityName" name="gst_number" placeholder="Enter GST number">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>PAN Number</b></label>
                      <input type="text" class="form-control" id="entityName" name="pan_number" placeholder="Enter your PAN number">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>TIN Number</b></label>
                      <input type="text" class="form-control" id="entityName" name="tin_number" placeholder="Enter your TIN number">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>MSME Number, if any</b></label>
                      <input type="text" class="form-control" id="entityName" name="msme_number" placeholder="Enter MSME number">
                    </div>
                </div>

                {{-- <h5 class="text-center">FSSAI details, if Food Category</h5> --}}

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>FSSAI Number</b></label>
                      <input type="text" class="form-control" id="entityName" name="fssai_number" placeholder="Enter your FSSAI number">
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>RTV on Expiry</b></label>
                      <input type="text" class="form-control" id="entityName" name="rtv_expiry" placeholder="Enter RTV on Expiry">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>RTV on Damages</b></label>
                      <input type="text" class="form-control" id="entityName" name="rtv_damage" placeholder="Enter RTV on Damages">
                    </div>
                </div>

                <h5 class="text-center mt-2"><b>Payment Terms</b></h5>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Payment Cycle, if Payment on Sale</b></label>
                      <input type="text" class="form-control" id="entityName" name="payment_cycle" placeholder="Enter Payment Cycle">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Credit Days, if applicable</b></label>
                      <input type="text" class="form-control" id="entityName" name="credit_day" placeholder="Enter credit day">
                    </div>
                </div>

                <h5 class="text-center mt-2"><b>Bank Information</b></h5>

                <div class="col-3">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Cancelled Cheque</b></label>
                      <input type="text" class="form-control" id="entityName" name="cancelled_cheque" placeholder="Enter Cancelled Cheque">
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Beneficiary Name</b></label>
                      <input type="text" class="form-control" id="entityName" name="beneficiary_name" placeholder="Enter Beneficiary Name">
                    </div>
                </div>

                <div class="col-3">
                  <div class="form-group">
                    <label for="" class="mt-3"><b>Bank Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_name" placeholder="Enter your Bank Name">
                  </div>
              </div>

              <div class="col-3">
                  <div class="form-group">
                    <label for="" class="mt-3"><b>Branch Address</b></label>
                    <input type="text" class="form-control" id="entityName" name="branch_address" placeholder="Enter your Branch Address">
                  </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label for="" class="mt-3"><b>Postal/Zip Code</b></label>
                  <input type="text" class="form-control" id="entityName" name="postal_zip_code" placeholder="Enter your Postal/Zip Code">
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                  <label for="" class="mt-3"><b>Country</b></label>
                  <input type="text" class="form-control" id="entityName" name="country_name" placeholder="Enter your country name">
                </div>
            </div>

            <div class="col-3">
              <div class="form-group">
                <label for="" class="mt-3"><b>Beneficiary Account Type</b></label>
                <input type="text" class="form-control" id="entityName" name="beneficiary_account_type" placeholder="Enter Beneficiary A/C Type">
              </div>
          </div>

          <div class="col-3">
              <div class="form-group">
                <label for="" class="mt-3"><b>Beneficiary Account Name</b></label>
                <input type="text" class="form-control" id="entityName" name="beneficiary_account_name" placeholder="Enter Beneficiary A/C Name">
              </div>
          </div>

          <div class="col-3">
            <div class="form-group">
              <label for="" class="mt-3"><b>Beneficiary Account Number</b></label>
              <input type="text" class="form-control" id="entityName" name="beneficiary_account_number" placeholder="Enter Beneficiary A/C No.">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
              <label for="" class="mt-3"><b>Branch MICR Code (Optional)</b></label>
              <input type="text" class="form-control" id="entityName" name="branch_micr_code" placeholder="Enter Branch MICR Code">
            </div>
        </div>

        <div class="col-3">
          <div class="form-group">
            <label for="" class="mt-3"><b>Branch IFSC Code</b></label>
            <input type="text" class="form-control" id="entityName" name="branch_ifsc_code" placeholder="Enter Branch IFSC Code">
          </div>
      </div>

      <div class="col-3">
          <div class="form-group">
            <label for="" class="mt-3"><b>Listing Charges</b></label>
            <input type="text" class="form-control" id="entityName" name="listing_charges" placeholder="Enter Listing Charges">
          </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <label for="" class="mt-3"><b>Q-Mart Retail Pvt Limited</b></label>
          <input type="text" class="form-control" id="entityName" name="q-mart_retail" placeholder="Enter Q-mart Retail">
        </div>
    </div>
    </div>
  






        <button type="submit" class="btn-submit btn-report mr-3 mb-3">Report</button>
        <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>
      </form>
    </div>

    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
    </script>
@endsection
