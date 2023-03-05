@extends('firebase.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Contact
                            <a href="{{ url('contacts') }}" class="btn btn-sm btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('update-contact', ['id' => $id]) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="form-group mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="{{ $contact['fname'] }}" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="{{ $contact['lname'] }}" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phone" value="{{ $contact['phone'] }}" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Email Address</label>
                                <input type="text" name="email" value="{{ $contact['email'] }}" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
