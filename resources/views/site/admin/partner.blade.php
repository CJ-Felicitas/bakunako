@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <form action="/addPartner" method="post">
                    @csrf
                    <input name="name" type="text" class="form-control" placeholder="Name">
                    <br>
                    <input name="email" type="text" class="form-control" placeholder="Email">
                    <br>
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone_number">
                    <br>
                    <input type="text" class="form-control" name="address" placeholder="Address">
                    <br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
