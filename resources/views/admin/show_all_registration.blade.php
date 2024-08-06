@extends('admin.main.main')

@section('admin-content')
<style>
    .btn-submit {
        letter-spacing: 1px;
        font-weight: 400;
        border: 1px solid #f38f21;
        color: #f38f21;
        margin: 0px;
        padding: 12px 12px;
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

    .btn-approved {
        border: 1px solid #4caf50;
        /* Green border */
        color: #4caf50;
        /* Green text */
    }

    .btn-approved:hover {
        background-color: #4caf50;
        /* Green background on hover */
        color: #fff !important;
        /* White text on hover */
    }

    .btn-pending {
        border: 1px solid #f44336;
        /* Red border */
        color: #f44336;
        /* Red text */
    }

    .btn-pending:hover {
        background-color: #f44336;
        /* Red background on hover */
        color: #fff !important;
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

<div class="container block mb-4 mt-3">
    <h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-Black; letter-spacing:1px">
        <b>Sku Registration Details</b>
    </h4>
    <div class="row mt-4" id="my Table">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Vendor Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($sortedMerge as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <td>{{ $item['vendor_name'] }}</td>
                                        <td>{{ $item['description'] }}</td>
                                        <td>
                                            @if ($item->status == 'Pending' || $item->status == 'Deactivate')
                                                <a href="" class="btn-submit btn-pending" data-toggle="modal" data-target="#updateModal{{ $item->id }}">
                                                    <b>{{ $item->status }}</b>
                                                </a>
                                            @elseif($item->status == 'Approved' || $item->status == 'Activate')
                                                <a href="" class="btn-submit btn-approved" data-toggle="modal" data-target="#updateModal{{ $item->id }}">
                                                    <b>{{ $item->status }}</b>
                                                </a>
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

@foreach ($sortedMerge as $item)
    <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Vendor Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update-sku-registration-status" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sku_status" id="inlineRadio1" value="Pending" {{ $item->status == 'Pending' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Pending</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sku_status" id="inlineRadio2" value="Approved" {{ $item->status == 'Approved' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Approved</label>
                        </div>
                        <button type="submit" class="btn-submit mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    setTimeout(function() {
        $('#success-message').fadeOut('fast');
    }, 4000);

    setTimeout(function() {
        $('#error-message').fadeOut('fast');
    }, 4000);
</script>

@endsection
