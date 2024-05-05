@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                Manage Partners
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List of Partners</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Partner Since</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partners as $partner)
                                <tr>
                                    <td>{{ $partner->name }}</td>
                                    <td>{{ $partner->email }}</td>
                                    <td>{{ $partner->address }}</td>
                                    <td>{{ $partner->phone_number }}</td>
                                    <td>{{ $partner->created_at }}</td>
                                    <td>
                                        <a href="/admin/partner/{{ $partner->id }}" class="btn btn-primary">Manage</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($partners->isEmpty())
                <div class="alert alert-warning">
                    There are no partners available as of this moment.
                </div>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                Add Partner
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <form action="/admin/addPartner" method="post">
                    @csrf
                    <input name="name" type="text" class="form-control" placeholder="Name">
                    <br>
                    <input name="email" type="text" class="form-control" placeholder="Email">
                    <br>
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone_number">
                    <br>
                    <input type="text" class="form-control" name="address" placeholder="Address">
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
        @if (session('success'))
            <script>
                window.onload = function() {
                    iziToast.success({
                        title: 'Success',
                        message: 'The user has been added to the system successfully.',
                    });
                };
            </script>
        @endif
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
