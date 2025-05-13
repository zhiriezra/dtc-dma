@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Access Denied</div>

                <div class="card-body">
                    <div class="alert alert-danger">
                        <h4 class="alert-heading">Permission Denied!</h4>
                        <p>You do not have permission to access this page.</p>
                        <hr>
                        <p class="mb-0">Please contact your administrator if you believe this is an error.</p>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 