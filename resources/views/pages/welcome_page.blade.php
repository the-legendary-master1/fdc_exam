@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Thank you for registering</h3>
                    <a href="{{ url('/') }}" class="btn btn-primary">continue</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
