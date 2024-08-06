@extends('admin.main.main')


@section('admin-content')
    <style>
        .btn-view {
            letter-spacing: 1px;
            font-weight: 400;
            border: 1px solid #f38f21;
            color: #f38f21;
            margin: 0px;
            padding: 14px 14px;
            border-radius: 9px;
            vertical-align: top;
            display: inline-block;
            background: transparent;
            text-transform: uppercase;
            text-decoration: none;
            font-family: 'Silka-SemiBold';
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            background-color: #f38f21;
            color: #fff !important;
            text-decoration: none;
        }

        .btn-submit {
            letter-spacing: 1px;
            font-weight: 400;
            border: 1px solid #f38f21;
            color: #f38f21;
            margin: 0px;
            padding: 8px 10px;
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
            text-decoration: none;
        }

        .btn-edit {
            border: 1px solid #4caf50;
            /* Green border */
            color: #4caf50;
            /* Green text */
        }

        .btn-edit:hover {
            background-color: #4caf50;
            /* Green background on hover */
            color: #fff !important;
            /* White text on hover */
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


    <div class="container block mb-4 mt-3">

        <h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-SemiBold; letter-spacing:1px">
            <b>Vendor Registration Details</b>
        </h4>
        <div class="row mt-4" id="my Table">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Project Module Details</h4> --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Vendor Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">GSTIN</th>
                                        <th scope="col">Content Person</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Brands</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($vendorDetail as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item['vendor_name'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <td>{{ $item['gstin'] }}</td>
                                            <td>{{ $item['contact_person'] }}</td>
                                            <td>{{ $item['phone_number'] }}</td>
                                            <td>{{ $item['brands'] }}</td>
                                            <td>
                                                <a href="{{ url('edit-vendor-registration-detail/' . $item->id) }}"
                                                    class="btn-submit btn-edit mr-2"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>

                                                <a href="{{ url('delete-vendor-registration-detail/' . $item->id) }}"
                                                    class="btn-submit btn-remove" onclick="return confirmDelete()"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                            <td>
                                                @if ($item->status == 'Activate')
                                                    <a href="" class="btn-submit btn-edit" data-toggle="modal"
                                                        data-target="#updateModal{{ $item->id }}">{{ $item->status }}</a>
                                                @elseif($item->status == 'Deactivate')
                                                    <a href="" class="btn-submit btn-remove" data-toggle="modal"
                                                        data-target="#updateModal{{ $item->id }}">{{ $item->status }}</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for project status update -->
    @foreach ($vendorDetail as $item)
        <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Vendor Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="update-vendor-status" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="vendor_status" id="inlineRadio1"
                                    value="Activate" {{ $item->status == 'Activate' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Activate</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="vendor_status" id="inlineRadio2"
                                    value="Deactivate" {{ $item->status == 'Deactivate' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Deactivate</label>
                            </div>

                            <button type="submit" class="btn-submit mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function confirmDelete() {
            return confirm('Are You Sure you want to delete venor registration detail!');
        }


        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
    </script>
@endsection
