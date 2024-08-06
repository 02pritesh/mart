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

    <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Request Monthly Sales Report/Statement</b></h3>

    <div class="container block mt-4 mb-4">
        <form action="{{ url('request-report') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group">

                    <h6 class="mt-3">Vendor Entity Name</h6>

                    <input type="hidden" name="vendor_id" value="{{ Session::get('vendor_id') }}">

                    <input type="text" class="form-control" id="entityName" value="{{ Session::get('vendor_name') }}"
                        name="vendor_name" readonly>

                </div>

                <div class="form-group">
                    <h6>Message (maximum:300 words)</h6>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                        placeholder="Write Your Message"></textarea>
                    @error('vendor_message')
                        <span style="color: red; font-size:18px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h6>File</h6>

                    <input type="file" class="form-control" id="entityName" name="vendor_file">
                    @error('vendor_file')
                        <span style="color: red; font-size:18px">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <button type="submit" class="btn-submit btn-report mr-3 mb-3">Report</button>
            <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>
        </form>
    </div>



    {{-- @foreach ($messages as $message)
        <div class="container block mt-4 mb-4">
            <h3 class="text-center pt-3" style="color:#000;font-family: Silka-Black;"><b>Admin Message</b></h3>
            <div class="row">
                <div class="form-group col-md-12">
                    <h6 class="mt-1">Vendor Entity Name</h6>
                    <input type="hidden" name="vendor_id" value="{{ Session::get('vendor_id') }}">
                    <input type="text" class="form-control" id="entityName" value="{{ Session::get('vendor_name') }}"
                        name="vendor_name" readonly>
                </div>

                <div class="form-group col-md-12">
                    <h6>Message (maximum: 300 words)</h6>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ old('admin_message', isset($message) ? $message->admin_message : '') }}</textarea>
                </div>

                <div class="form-group col-md-12">            
                    @if ($message->admin_file)
                        @if (in_array(pathinfo($message->admin_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Display image if file is an image -->
                            <img src="{{ asset('assets/upload/' . $message->admin_file) }}" alt="Uploaded File" style="max-width: 5%; height: auto;">
                        @else
                            <!-- Display file if it is not an image -->
                            <a href="{{ asset('assets/upload/' . $message->admin_file) }}" target="_blank" download>View Uploaded File</a>
                        @endif
                    @else
                        <p>No file uploaded.</p>
                    @endif
                </div>                                          
            </div>

            <button type="submit" class="btn-submit btn-report mr-3 mb-3">Report</button>
            <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>
           
        </div>
    @endforeach --}}





    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
    </script>
@endsection
