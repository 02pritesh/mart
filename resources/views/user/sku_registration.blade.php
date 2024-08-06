@extends('user.main.main')

@section('user-content')
    <style>
        .block {
            box-shadow: 0px 0px 10px rgb(171, 161, 161);
            padding: 20px;
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

        .add-row {
            border: 1px solid #4caf50;
            /* Green border */
            color: #4caf50;
            /* Green text */
        }

        .add-row:hover {
            background-color: #4caf50;
            /* Green background on hover */
            color: #fff !important;
            /* White text on hover */
        }

        .btn-reset {
            border: 1px solid #f38f21;
            color: #f38f21;
            /* Orange text */
        }

        .btn-reset:hover {
            background-color: ;
            color: #fff !important;
        }

        .btn-remove {
            border: 1px solid #f44336;
            /* Red border */
            color: #f44336;
            /* Red text */
        }

        .btn-remove:hover {
            background-color: #f44336;
            /* Red background on hover */
            color: #fff !important;
            /* White text on hover */
        }



        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        tr,
        th {
            border: 1px solid #96C9F4;
        }

        table,
        td {
            border: 2px solid #505050;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #96C9F4;
        }

        table,
        .change-row-color-blue {
            background-color: #fff; 
        }

        table,
        .change-row-color-white {
            background-color: #cadef3;

        }
    </style>

    <div class="container">
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
    </div>

    <h3 class="text-center" style="color:#000; font-family: Silka-Black;"><b>SKU Registration</b></h3>
    <div class="container block mt-4 mb-4">
        <form id="skuForm" action="{{ url('sku-registration') }}" method="POST">
            @csrf
            <div class="form-group">
                <h6>Vendor Entity Name</h6>
                <input type="text" class="form-control" id="entityName" placeholder="Enter entity name"
                    name="vendor_name">
                @error('vendor_name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="row mt-4" id="my Table">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SKU Name</th>
                                            <th>SKU Code</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="skuRows">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="sku_name[]">
                                                @error('sku_name.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="sku_code[]">
                                                @error('sku_code.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="category[]">
                                                @error('category.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="quantity[]">
                                                @error('quantity.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="price[]">
                                                @error('price.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td><button type="button" class="btn-submit btn-remove remove-row" disabled><i
                                                        class="fa-solid fa-trash-can"></i></button></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}




            {{-- /*********************** Excel Sheet Sku Registration ************************** --}}


            <div class="row mt-4" id="my Table">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>RTV</th>
                                            <th>Unit</th>
                                            <th>Case QTY</th>
                                            <th>EAN Code</th>
                                            <th>Brand</th>
                                            <th>Shelf Life</th>
                                            <th>HSN Code</th>
                                            <th>GST%</th>
                                            <th>Margin%</th>
                                            <th>MRP</th>
                                            <th>Margin</th>
                                            <th>Landing Price</th>
                                            <th>GST</th>
                                            <th>Basic Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="skuRows">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="category[]">
                                                @error('category.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="RTV[]">
                                                @error('RTV.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="unit[]">
                                                @error('unit.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="case_qty[]">
                                                @error('case_qty.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="EAN_Code[]">
                                                @error('EAN_Code.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="brand[]">
                                                @error('brand.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="shelf_life[]">
                                                @error('shelf_life.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="HSN_Code[]">
                                                @error('HSN_Code.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="gst[]">
                                                @error('gst.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="margin[]">
                                                @error('margin.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="MRP[]">
                                                @error('MRP.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="margin_price[]">
                                                @error('margin_price.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="Landing_price[]">
                                                @error('Landing_price.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="gst_price[]">
                                                @error('gst_price.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="basic_cost[]">
                                                @error('basic_cost.*')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </td>

                                            <td><button type="button" class="btn-submit btn-remove remove-row" disabled><i
                                                        class="fa-solid fa-trash-can"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="addRow" class="btn-submit add-row mt-3"><b>Add More Rows</b></button>
            <hr>
            <button type="submit" class="btn-submit mr-3 mb-3">Submit SKU</button>
            <button type="reset" class="btn-submit btn-reset mb-3">Reset</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let i = 1;
            // Function to add a new row
            $('#addRow').click(function() {

                if (i % 2 == 0) {
                    var newRow = `
                    <tr class="change-row-color-white">
                        
                        <td>
                            <input type="text" class="form-control" name="category[]">
                             @error('category.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control" name="RTV[]">
                            @error('RTV.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="unit[]">
                            @error('unit.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="case_qty[]">
                            @error('case_qty.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="EAN_Code[]">
                            @error('EAN_Code.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="brand[]">
                            @error('brand.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="shelf_life[]">
                            @error('shelf_life.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="HSN_Code[]">
                            @error('HSN_Code.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="gst[]">
                            @error('gst.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="margin[]">
                            @error('margin.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="MRP[]">
                            @error('MRP.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="margin_price[]">
                            @error('margin_price.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="Landing_price[]">
                            @error('Landing_price.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control" name="gst_price[]">
                            @error('gst_price.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control" name="basic_cost[]">
                            @error('basic_cost.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>

                        <td ><button type="button" class="btn-submit btn-remove remove-row"><i class="fa-solid fa-trash-can"></i></button></td>
                        i++;
                    </tr>
                    `;
                    console.log(i++);
                    $('#skuRows').append(newRow);
                } else {
                    var newRow = `
                    <tr class="change-row-color-blue">
                        
                        <td>
                            <input type="text" class="form-control" name="category[]">
                             @error('category.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control" name="RTV[]">
                            @error('RTV.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="unit[]">
                            @error('unit.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="case_qty[]">
                            @error('case_qty.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="EAN_Code[]">
                            @error('EAN_Code.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="brand[]">
                            @error('brand.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="shelf_life[]">
                            @error('shelf_life.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="HSN_Code[]">
                            @error('HSN_Code.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="gst[]">
                            @error('gst.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="margin[]">
                            @error('margin.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="MRP[]">
                            @error('MRP.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="margin_price[]">
                            @error('margin_price.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="Landing_price[]">
                            @error('Landing_price.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control" name="gst_price[]">
                            @error('gst_price.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control" name="basic_cost[]">
                            @error('basic_cost.*')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                        <td style="background-color:white;"><button type="button" class="btn-submit btn-remove remove-row"><i class="fa-solid fa-trash-can"></i></button></td>
                        i++;
                    </tr>
                    `;
                    console.log(i++);
                    $('#skuRows').append(newRow);
                }
            });

            // Function to remove a row
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });
        });

        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
    </script>
@endsection
